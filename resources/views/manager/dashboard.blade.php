@extends('layouts.app') // Asumsi Anda menggunakan layout utama

@section('content')

    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2.586l.293.293a1 1 0 001.414-1.414L10 12.586l.293-.293a1 1 0 001.414 0l.293.293V17a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293-.293a1 1 0 000-1.414l-7-7z"></path></svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Manajemen Stok</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard Operasional Gudang</h1>
            </div>
        </div>
    </div>
    
    <div class="p-4 w-full grid grid-cols-1 gap-4 xl:grid-cols-3 2xl:grid-cols-3">
        
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-red-600 dark:text-red-500">{{ $stokMenipisCount }}</span>
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Produk Stok Menipis</h3>
                </div>
                <div class="ml-auto w-full text-right">
                    <svg class="w-6 h-6 inline text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
            </div>
            <p class="text-sm text-red-500 mt-2">Perlu segera diproses / dipesan</p>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-green-600 dark:text-green-500">{{ $barangMasukHariIni }}</span>
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Transaksi Barang Masuk Hari Ini</h3>
                </div>
                <div class="ml-auto w-full text-right">
                    <svg class="w-6 h-6 inline text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v2.5m14-5v2.5m0-2.5v2.5m-11-2v2.5m0-2.5v2.5m7-10V7h2V5h-2zM5 14h2m12 0h2M3 17h18M5 10H3V5h2zM19 10h2V5h-2z"></path></svg>
                </div>
            </div>
            <a href="{{ route('manager.stock.in') }}" class="text-sm text-blue-500 hover:underline mt-2 block">Lihat Detail Transaksi Masuk</a>
        </div>

        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <span class="text-2xl sm:text-3xl leading-none font-bold text-yellow-600 dark:text-yellow-500">{{ $barangKeluarHariIni }}</span>
                    <h3 class="text-base font-normal text-gray-500 dark:text-gray-400">Transaksi Barang Keluar Hari Ini</h3>
                </div>
                <div class="ml-auto w-full text-right">
                    <svg class="w-6 h-6 inline text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10V7h2V5h-2V3H5v2H3v2h2v3H3v2h2v3H3v2h2v3h14v-7h-2v-3h-2v-3h-2zM5 14h2m12 0h2M3 17h18M5 10H3V5h2zM19 10h2V5h-2z"></path></svg>
                </div>
            </div>
            <a href="{{ route('manager.stock.out') }}" class="text-sm text-blue-500 hover:underline mt-2 block">Lihat Detail Transaksi Keluar</a>
        </div>
        
    </div>
    
    <div class="p-4 w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-2 gap-4">
        
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
            <h3 class="text-xl font-semibold mb-4 dark:text-white">Grafik Stok Barang</h3>
            <div id="stock-chart">
                <div class="text-gray-500 dark:text-gray-400 h-64 flex items-center justify-center border border-dashed rounded">Placeholder untuk Grafik Stok</div>
            </div>
        </div>
        
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 dark:bg-gray-800">
            <h3 class="text-xl font-semibold mb-4 dark:text-white">5 Produk Paling Kritis</h3>
            <div class="flow-root">
                <p class="text-gray-500 dark:text-gray-400">Tabel ringkasan produk yang mencapai batas stok minimum.</p>
                <div class="h-64 flex items-center justify-center border border-dashed rounded mt-2">Placeholder untuk Tabel Produk Kritis</div>
            </div>
        </div>
        
    </div>

@endsection