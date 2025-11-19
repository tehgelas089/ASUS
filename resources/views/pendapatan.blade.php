<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Riwayat Transaksi</h2>

    <table class="w-full border-collapse border border-gray-300 text-sm">
      <thead>
        <tr class="bg-gray-200 text-gray-700">
          <th class="border p-2">ID</th>
          <th class="border p-2">Nama Produk</th>
          <th class="border p-2">Harga / Total</th>
          <th class="border p-2">Uang Diterima</th>
          <th class="border p-2">Kembalian</th>
          <th class="border p-2">Pendapatan</th>
          <th class="border p-2">Tanggal</th>
        </tr>
      </thead>

      <tbody>
        @foreach($revenues as $rev)
        <tr class="text-center">
          <td class="border p-2">
            {{ $rev->transaction->id }}
          </td>

          <td class="border p-2">
            {{ $rev->transaction->product_name === 'MULTI ITEM' 
                            ? 'Transaksi Banyak Item'
                            : $rev->transaction->product_name }}
          </td>

          <td class="border p-2">
            Rp{{ number_format($rev->transaction->price, 0, ',', '.') }}
          </td>

          <td class="border p-2">
            Rp{{ number_format($rev->transaction->money_received ?? 0, 0, ',', '.') }}
          </td>

          <td class="border p-2">
            Rp{{ number_format($rev->transaction->change ?? 0, 0, ',', '.') }}
          </td>

          <td class="border p-2 text-green-600 font-semibold">
            Rp{{ number_format($rev->income, 0, ',', '.') }}
          </td>

          <td class="border p-2">
            {{ $rev->created_at->format('d M Y H:i') }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</x-layout>