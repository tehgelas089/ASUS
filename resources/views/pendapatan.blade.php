<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>



  <div class="text-center mb-3">
    <h3 class="text-xl font-bold text-green-600">
      Total Pendapatan: Rp{{ number_format($total, 0, ',', '.') }}
    </h3>
  </div>
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


  <div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Riwayat Transaksi</h2>

    <div class="overflow-x-auto w-full">
      <table class="min-w-full bg-white rounded-lg shadow">
        <thead>
          <tr class="bg-teal-400 text-gray-700 text-left text-sm">
            <th class="py-3 px-4 border-b">No</th>
            <th class="py-3 px-4 border-b">Nama Produk</th>
            <th class="py-3 px-4 border-b">Harga / Total</th>
            <th class="py-3 px-4 border-b">Uang Diterima</th>
            <th class="py-3 px-4 border-b">Kembalian</th>
            <th class="py-3 px-4 border-b">Pendapatan</th>
            <th class="py-3 px-4 border-b">Tanggal</th>
          </tr>
        </thead>

        <tbody class="text-sm text-gray-800">
          @foreach($revenues as $index => $rev)
          <tr class="hover:bg-gray-50 transition">
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

            <td class="py-3 px-4 border-b text-green-600 font-semibold">
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

  <div class="mt-4 flex justify-center ">
    {{ $revenues->links() }}
  </div>
  <style>
    .flex__1 {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
    }

    .flex__2 {
      width: 100%;
      height: 50%;
      display: flex;
      flex-direction: row;
    }

    .card {
      height: 50mm;
      width: 84mm;
      position: relative;
      perspective: 800px;
    }

    .card__side {
      width: 100%;
      height: 100%;
      border-radius: 3.18mm;
      position: absolute;
      top: 0;
      left: 0;
      backface-visibility: hidden;
      transition: transform 0.7s ease-out;
      cursor: pointer;
      padding: 10px;
    }

    .card__side__photo {
      width: 1.4cm;
      height: 1.4cm;
      position: absolute;
      left: 12px;
      bottom: 15px;
      background: grey;
      border-radius: 8%;
    }

    .card__side_front {
      background: linear-gradient(90deg, rgb(0, 0, 0) 0%, #242424 100%);
      transform: rotateY(0deg);
    }

    .card__side_back {
      background: linear-gradient(-90deg, rgb(0, 0, 0) 0%, #242424 100%);
      transform: rotateY(-180deg);
      color: #eeeeee;
    }

    .card__side__name-bank {
      font-family: Inter, sans-serif;
      font-weight: 500;
      position: relative;
      font-size: 22px;
      margin-left: 8px;
      color: white;
    }

    .card__side__name-bank::after {
      content: "Universal Bank";
      position: absolute;
      font-size: 6px;
      top: 105%;
      left: 21%;
      color: #635c77;
    }

    .card__side__name-bank::before {
      content: "₴";
      position: absolute;
      top: 0;
      right: 0;
      color: #635c77;
    }

    .card__side__chip {
      width: 1.3cm;
      height: 1cm;
      margin-left: 22px;
      margin-top: -35px;
      background: rgb(226, 175, 35);
      border-radius: 8px;
    }

    .card__side__chip:after {
      content: "";
      display: block;
      position: absolute;
      height: 24px;
      width: 24px;
      top: 80px;
      right: 15px;
      transform: scale(1.3);
    }

    .card__side__name-person {
      text-transform: uppercase;
      font-family: Roboto Mono, sans-serif;
      font-size: 14px;
      margin-bottom: 10px;
      margin-left: 20px;
      position: relative;
      display: block;
      color: white;
    }

    .card__side__name-person::before {
      content: "";
      display: block;
      position: absolute;
      width: 45px;
      aspect-ratio: 1 / 1;
      background: red;
      bottom: -10px;
      right: 0px;
      border-radius: 50%;
    }

    .card__side__name-person::after {
      content: "";
      display: block;
      position: absolute;
      width: 45px;
      aspect-ratio: 1 / 1;
      background: orange;
      bottom: -10px;
      right: 23px;
      border-radius: 50%;
    }

    .card__side__black {
      background: black;
      width: 100%;
      height: 50px;
      border-radius: 3.18mm 3.18mm 0 0;
      position: absolute;
      top: 0;
      right: 0;
    }

    .card__side__number {
      font-size: 18px;
      font-family: Roboto Mono, sans-serif;
      color: #eeeeee;
      margin: 45px 0px 15px 10px;
    }

    .card__side__other-numbers {
      font-family: Roboto Mono, sans-serif;
      color: #eeeeee;
      display: block;
      margin-left: 10px;
      font-size: 12px;
      backface-visibility: hidden;
      position: relative;
    }

    .card__side__other-numbers::after {
      color: #635c77;
      position: absolute;
      font-size: 8px;
      left: 0;
      bottom: 60px;
    }

    .card__side__other-numbers_1::after {
      content: "СТРОК";
    }

    .card__side__other-numbers_2::after {
      content: "КОД";
    }

    .card__side__other-info {
      color: #635c77;
      font-size: 4px;
      text-align: center;
      font-family: Roboto Mono, sans-serif;
      position: absolute;
      bottom: 10px;
      left: 38px;
      backface-visibility: hidden;
    }

    .card__side__debit {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 1.8cm;
      height: 1cm;
      border-radius: 1cm;
      background: #c0c0c0;
      position: absolute;
      right: 12px;
      bottom: 25px;
      font-family: Inter;
      color: #666666;
    }

    .card__side__debit::after {
      content: "";
      display: block;
      position: absolute;
      background: rgba(166, 163, 163, 0.7);
      width: 30px;
      height: 30px;
      border-radius: 50%;
      right: 0;
    }

    .card:hover .card__side_front {
      transform: rotateY(180deg);
    }

    .card:hover .card__side_back {
      transform: rotateY(0deg);
    }
  </style>

</x-layout>