<?php

namespace App\Interfaces;

interface StockMovementRepositoryInterface
{
    public function recordStockIn(array $data);
    public function recordStockOut(array $data);
}