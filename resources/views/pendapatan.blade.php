<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <link rel="stylesheet" href="{{ asset('css/pendapatan.css') }}">
  <!-- 
  <div class="flex justify-center items-center">
    <div class="card">
      <div class="card__side card__side_front">
        <div class="flex__1">
          <p class="card__side__name-bank">Asusbank</p>
          <div class="card__side__chip"></div>
          <p class="card__side__name-person">{{ $user->name }}</p>
        </div>
      </div>
      <div class="card__side card__side_back">
        <div class="card__side__black"></div>
        <p class="card__side__number text-green-400">Rp{{ number_format($total, 0, ',', '.') }}</p>
        <div class="flex__2">

          <div class="card__side__photo"> <img src="{{ asset('img/Qr.png')}}" class="size-14"></div>
          <div class="card__side__debit">debit</div>
        </div>
        <p class="card__side__other-info">
          MONOBANK.UA | 0 800 205 205 |
          АТ "УНІВЕРСАЛ БАНК". ЛІЦЕНЗІЯ
          НБУ №92 ВІД 20.01.1994 |
          PCE PC100650 WORLD DEBIT
        </p>
      </div>
    </div>
  </div> -->

  <div class="text-center mb-3">
    <h3 class="text-xl font-bold text-green-600">
      Total Pendapatan: Rp{{ number_format($total, 0, ',', '.') }}
    </h3>
  </div>

  <div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Riwayat Transaksi</h2>

    <div class="overflow-x-auto w-full">
      <table class="min-w-full bg-neutral-200 rounded-lg shadow border border-black">
        <thead>
          <tr class="bg-teal-400 text-gray-700 text-left text-sm">
            <th class="py-3 px-4 border-b">No</th>
            <th class="py-3 px-4 border-b">Nama Produk</th>
            <th class="py-3 px-4 border-b">Total</th>
            <th class="py-3 px-4 border-b">Uang Diterima</th>
            <th class="py-3 px-4 border-b">Kembalian</th>
            <th class="py-3 px-4 border-b">Pendapatan</th>
            <th class="py-3 px-4 border-b">Tanggal</th>
          </tr>
        </thead>

        <tbody class="text-sm text-gray-800">
          @foreach($revenues as $index => $rev)
          <tr class="hover:bg-white transition">
            <td class="py-3 px-4 border-b text-gray-600">
              {{ $index + 1 }}
            </td>

            <td class="py-3 px-4 border-b">
              @php
              $items = json_decode($rev->transaction->product_name, true);
              if(!is_array($items)) {
              $items = json_decode($rev->transaction->items ?? '', true);
              }
              @endphp

              @if(is_array($items))
              @foreach($items as $item)
              <div>{{ $item['name'] }}</div>
              @endforeach
              @else
              {{ $rev->transaction->product_name }}
              @endif
            </td>

            <td class="py-3 px-4 border-b">
              Rp{{ number_format($rev->transaction->price, 0, ',', '.') }}
            </td>

            <td class="py-3 px-4 border-b">
              Rp{{ number_format($rev->transaction->money_received ?? 0, 0, ',', '.') }}
            </td>

            <td class="py-3 px-4 border-b">
              Rp{{ number_format($rev->transaction->change ?? 0, 0, ',', '.') }}
            </td>

            <td class="py-3 px-4 border-b text-green-500 font-semibold">
              Rp{{ number_format($rev->income, 0, ',', '.') }}
            </td>

            <td class="py-3 px-4 border-b">
              {{ $rev->created_at->format('d M Y H:i') }}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-4 flex justify-center text-black ">
    {{ $revenues->links() }}
  </div>


</x-layout>