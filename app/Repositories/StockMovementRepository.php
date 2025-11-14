<?php

namespace App\Repositories;

use App\Interfaces\StockMovementRepositoryInterface;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Exception;

class StockMovementRepository implements StockMovementRepositoryInterface
{
    /**
     * Mencatat Barang Masuk dan mengupdate stok produk.
     */
    public function recordStockIn(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::findOrFail($data['product_id']);
            $quantity = $data['quantity'];

            // 1. Catat pergerakan stok
            $movement = StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $data['user_id'], // ID Staff/Manajer yang mencatat
                'type' => 'in',
                'quantity' => $quantity,
                'notes' => $data['notes'] ?? null,
            ]);

            // 2. Update stok produk
            $product->increment('current_stock', $quantity);

            return $movement;
        });
    }

    /**
     * Mencatat Barang Keluar dan mengupdate stok produk.
     */
    public function recordStockOut(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = Product::findOrFail($data['product_id']);
            $quantity = $data['quantity'];

            // 1. Catat pergerakan stok
            $movement = StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $data['user_id'],
                'type' => 'out',
                'quantity' => $quantity,
                'notes' => $data['notes'] ?? null,
            ]);

            // 2. Update stok produk
            $product->decrement('current_stock', $quantity);
            
            return $movement;
        });
    }
}