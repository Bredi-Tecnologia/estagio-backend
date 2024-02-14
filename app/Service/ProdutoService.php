<?php

namespace App\Service;

use App\Repository\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;



class ProdutoService
{
    // Attributes
    private ProductRepository $productRepository;

    // Methods
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(): Collection
    {
       return $this->productRepository::all();
    }

    public function filterByCategory($category_id): array|Collection
    {
        if ($category_id != null){
            return $this->productRepository::filter($category_id);
        }
        return $this->getAllProducts();
    }

    public function createProduct($product): Model | null
    {
        return $this->productRepository::create($product);
    }

    public function editProduct($product_id,$newProduct): int
    {
        return $this->productRepository::update($product_id,$newProduct);
    }

    public function deleteProduct($product_id)
    {
        return $this->productRepository::delete($product_id);
    }
}
