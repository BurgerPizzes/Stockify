@extends('layouts.app') 

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Laporan Stok Barang Saat Ini</h1>

        <form method="GET" action="{{ route('admin.reports.stock') }}" class="mb-6">
            <div class="flex space-x-4 items-end">
                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter Kategori</label>
                    <select name="category_id" id="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Filter</button>
                <a href="{{ route('admin.reports.stock') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Reset</a>
            </div>
        </form>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Produk</th>
                        <th scope="col" class="px-6 py-3">Kategori</th>
                        <th scope="col" class="px-6 py-3">Supplier</th>
                        <th scope="col" class="px-6 py-3 text-center">Stok Saat Ini</th>
                        <th scope="col" class="px-6 py-3 text-center">Stok Min.</th>
                        <th scope="col" class="px-6 py-3 text-right">Harga Jual</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4">{{ $product->category->name }}</td>
                        <td class="px-6 py-4">{{ $product->supplier->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-center font-bold">{{ $product->current_stock }}</td>
                        <td class="px-6 py-4 text-center">{{ $product->min_stock }}</td>
                        <td class="px-6 py-4 text-right">Rp{{ number_format($product->selling_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($product->current_stock <= $product->min_stock)
                                <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Stok Kritis</span>
                            @else
                                <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr class="bg-white dark:bg-gray-800"><td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data produk yang ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection