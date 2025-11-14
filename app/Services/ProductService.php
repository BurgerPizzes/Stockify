<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts() { return $this->productRepository->allWithRelations(); }
    public function findProduct($id) { return $this->productRepository->find($id); }

    protected function validateProduct(array $data, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:products,name,'.$id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            // Kritis: Harga jual harus >= harga beli
            'selling_price' => 'required|numeric|min:0|gte:purchase_price', 
            'current_stock' => 'nullable|integer|min:0',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) { throw new Exception($validator->errors()->first()); }
    }

    public function createProduct(array $data)
    {
        $this->validateProduct($data);
        $data['current_stock'] = $data['current_stock'] ?? 0;
        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        $this->validateProduct($data, $id);
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id) { $this->productRepository->delete($id); }
}