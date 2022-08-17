<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckSupplierExistsRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * @param CheckSupplierExistsRequest $request
     * @return JsonResponse
     */
    public function checkSupplierExistsInCategoryAreaPair(CheckSupplierExistsRequest $request): JsonResponse
    {
        $areaId = $request->input('area_id');
        $categoryId = $request->input('category_id');

        if (!$areaId || !$categoryId) {
            return response()->json([
                'status' => false
            ]);
        }

        $suppliers = Supplier::enabled()
            ->whereHas('areas', function (Builder $query) use ($areaId) {
                $query->where('id', $areaId);
            })
            ->whereHas('categories', function (Builder $query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->exists();

        return response()->json([
            'status' => true,
            'exists' => $suppliers
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filterAreasByCategoryId(Request $request): JsonResponse
    {
        $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:categories,id']
        ]);

        $categoryId = $request->input('category_id');

        if (!$categoryId) {
            $areas = Area::orderBy('name')->get()->map(function (Area $item) {
                return [
                    'label' => $item->name,
                    'value' => $item->id,
                    'disabled' => !$item->has_suppliers,
                ];
            });

            return response()->json([
                'status' => true,
                'areas' => [
                    [
                        'value' => '',
                        'label' => __('Area'),
                        'placeholder' => true,
                    ],
                    ...$areas
                ]
            ]);
        }

        $suppliers = Supplier
            ::where('disabled', false)
            ->whereHas('categories', function (Builder $query) use ($categoryId) {
                $query->where('id', $categoryId);
            })
            ->with('areas:id')
            ->get();

        $availableAreas = $suppliers->map(function (Supplier $supplier) {
            return $supplier->areas->map(fn (Area $area) => $area->id);
        })->flatten()->unique();

        $areas = Area::orderBy('name')->get()->map(function (Area $category) use ($availableAreas) {
            return [
                'value' => $category->id,
                'label' => $category->name,
                'disabled' => !$availableAreas->contains($category->id),
            ];
        })->values();

        return response()->json([
            'status' => true,
            'areas' => [
                [
                    'value' => '',
                    'label' => __('Area'),
                    'placeholder' => true,
                ],
                ...$areas,
            ],
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function filterCategoriesByAreaId(Request $request): JsonResponse
    {
        $request->validate([
            'area_id' => ['nullable', 'integer', 'exists:areas,id']
        ]);

        $areaId = $request->input('area_id');

        if (!$areaId) {
            // Return all available categories
            $categories = Category::orderBy('name')->get()->map(function (Category $item) {
                return [
                    'label' => $item->name,
                    'value' => $item->id,
                    'disabled' => !$item->has_suppliers,
                ];
            })->reject(fn ($item) => $item['disabled'] === true);

            return response()->json([
                'status' => true,
                'categories' => [
                    [
                        'value' => '',
                        'label' => __('Category'),
                        'disabled' => true,
                        'placeholder' => true,
                    ],
                    ...$categories,
                ]
            ]);
        }

        $suppliers = Supplier::enabled()
            ->whereHas('areas', function (Builder $query) use ($areaId) {
                $query->where('id', $areaId);
            })
            ->with('categories:id')
            ->get();

        $availableCategories = $suppliers->map(function (Supplier $supplier) {
            return $supplier->categories->map(fn (Category $category) => $category->id);
        })->flatten()->unique();

        $categories = Category::orderBy('name')->get()->map(function (Category $category) use ($availableCategories) {
            return [
                'value' => $category->id,
                'label' => $category->name,
                'disabled' => !$availableCategories->contains($category->id),
            ];
        })->reject(fn ($item) => $item['disabled'] === true)->values();

        return response()->json([
            'status' => true,
            'categories' => [
                [
                    'value' => '',
                    'label' => __('Category'),
                    'disabled' => true,
                    'placeholder' => true,
                ],
                ...$categories,
            ],
        ]);
    }
}
