<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends  AbstractRepository
{
    protected static $model = Product::class;

    static function filter($category_id): array|Collection
    {
       return self::loadModel()::query()->where(['category_id' => $category_id])->get();
    }
}
