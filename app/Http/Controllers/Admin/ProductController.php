<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService; 
use App\Services\SupplierService; 
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.index', compact('products'));
    }

    public function create(CategoryService $categoryService, SupplierService $supplierService)
    {
        $categories = $categoryService->getAllCategories();
        $suppliers = $supplierService->getAllSuppliers();
        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        try {
            $this->productService->createProduct($request->all());
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }
    
    public function edit($id, CategoryService $categoryService, SupplierService $supplierService)
    {
        $product = $this->productService->findProduct($id);
        $categories = $categoryService->getAllCategories();
        $suppliers = $supplierService->getAllSuppliers();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->productService->updateProduct($id, $request->all());
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (Exception $e) {
            return back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}