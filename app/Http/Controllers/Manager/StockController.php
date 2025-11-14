<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Services\StockService;
use App\Services\ProductService; // Untuk dropdown produk
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class StockController extends Controller
{
    protected $stockService;
    protected $productService;

    public function __construct(StockService $stockService, ProductService $productService)
    {
        $this->stockService = $stockService;
        $this->productService = $productService;
    }

    // Tampilan Form Barang Masuk
    public function indexIn()
    {
        $products = $this->productService->getAllProducts();
        return view('manager.stock.in', compact('products'));
    }

    // Proses Penyimpanan Barang Masuk
    public function storeIn(Request $request)
    {
        try {
            $data = $request->only(['product_id', 'quantity', 'notes']);
            $data['user_id'] = Auth::id(); // Ambil ID user yang login
            
            $this->stockService->processStockIn($data);
            return redirect()->route('manager.stock.in')->with('success', 'Barang Masuk berhasil dicatat dan stok diupdate.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Gagal mencatat Barang Masuk: ' . $e->getMessage());
        }
    }
    
    // Tampilan Form Barang Keluar
    public function indexOut()
    {
        $products = $this->productService->getAllProducts();
        return view('manager.stock.out', compact('products'));
    }

    // Proses Penyimpanan Barang Keluar
    public function storeOut(Request $request)
    {
        try {
            $data = $request->only(['product_id', 'quantity', 'notes']);
            $data['user_id'] = Auth::id();
            
            $this->stockService->processStockOut($data);
            return redirect()->route('manager.stock.out')->with('success', 'Barang Keluar berhasil dicatat dan stok diupdate.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Gagal mencatat Barang Keluar: ' . $e->getMessage());
        }
    }
}