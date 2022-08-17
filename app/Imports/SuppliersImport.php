<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;

class SuppliersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id = $row[0];

        if ($id === 'id') {
            /* If first row is header */
            return null;
        }

        $fieldArray = collect([
            'email' => $row[1],
            'password' => \Hash::make($row[2]),
            'name' => $row[3],
            'phone' => $row[4],
            'disabled' => (string)$row[5] === '1',
            'created_at' => now(),
            'updated_at' => now(),
            'last_logged_in' => $row[8],
        ])->filter(fn ($item) => !empty($item));

        $supplier = Supplier::updateOrCreate(
            ['id' => $id ?? 0],
            $fieldArray->toArray()
        );

        $supplier->quick_notify = (string)$row[9] === '1';

        return $supplier;
    }
}
