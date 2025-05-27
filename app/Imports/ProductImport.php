<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'slug' => Product::generateUniqueSlug($row['name']),
            'category_id' => $row['category_id'],
            'stock' => $row['stock'],
            'price' => $row['price'],
            'is_active' => $row['is_active'],
            'barcode' => $row['barcode'],
            'image' => $row['image'],
        ]);
    }
}
