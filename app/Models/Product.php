<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'supplier_id', 'name', 'description', 
        'purchase_price', 'selling_price', 'current_stock', 'min_stock', 'image'
    ];

    // Relationship: Produk dimiliki oleh satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Produk disuplai oleh satu Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    // Relationship: Produk memiliki banyak pergerakan stok
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}