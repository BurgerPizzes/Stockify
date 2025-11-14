@extends('layouts.app') 

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Tambah Produk Baru</h1>

        @if (session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">{{ session('error') }}</div>
        @endif
        
        <form action="{{ route('admin.products.store') }}" method="POST" class="max-w-4xl mx-auto">
            @csrf
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Produk</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900">Harga Beli (Rp)</label>
                    <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900">Harga Jual (Rp)</label>
                    <input type="number" step="0.01" name="selling_price" id="selling_price" value="{{ old('selling_price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="current_stock" class="block mb-2 text-sm font-medium text-gray-900">Stok Awal</label>
                    <input type="number" name="current_stock" id="current_stock" value="{{ old('current_stock', 0) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900">Supplier (Opsional)</label>
                    <select name="supplier_id" id="supplier_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="">Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <label for="min_stock" class="block mb-2 text-sm font-medium text-gray-900">Stok Minimum</label>
                    <input type="number" name="min_stock" id="min_stock" value="{{ old('min_stock', 10) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>
            </div>

            <div class="relative z-0 w-full mb-5 group">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi (Opsional)</label>
                <textarea name="description" id="description" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Simpan Produk</button>
            <a href="{{ route('admin.products.index') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ml-3">Batal</a>
        </form>

    </div>
</div>
@endsection