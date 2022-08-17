<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function created(Category $category): void
    {
        Category::clearCache();
    }

    public function updated(Category $category): void
    {
        Category::clearCache();
    }

    public function saved(Category $category): void
    {
        Category::clearCache();
    }

    public function deleted(Category $category): void
    {
        Category::clearCache();
    }
}
