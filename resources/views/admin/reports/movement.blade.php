<h1 class="text-3xl font-bold mb-6">Laporan Pergerakan Stok</h1>

<form method="GET" action="{{ route('admin.reports.movement') }}" class="mb-6 space-y-4 md:space-y-0 md:space-x-4 flex flex-col md:flex-row items-end">
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Tampilkan Laporan</button>
</form>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left">
        <tbody>
            @forelse ($movements as $movement)
            <tr class="{{ $movement->type == 'in' ? 'bg-green-50' : 'bg-red-50' }} border-b">
                <td class="px-6 py-4 font-bold">{{ $movement->type == 'in' ? 'MASUK' : 'KELUAR' }}</td>
                <td class="px-6 py-4">{{ $movement->product->name }}</td>
                <td class="px-6 py-4">{{ $movement->quantity }} unit</td>
                <td class="px-6 py-4">{{ $movement->user->name }}</td>
                <td class="px-6 py-4">{{ $movement->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-4 text-center">Tidak ada pergerakan stok dalam periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>