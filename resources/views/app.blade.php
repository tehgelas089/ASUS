<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link rel="stylesheet" href="{{ asset('css/transaksi.css') }}">



  @if (session('success'))
  <div id="notifBox"
    style="background: #28a745; padding: 15px; border-radius: 8px; color: white; 
              font-weight: bold; margin-bottom: 15px; text-align:center;">
    {{ session('success') }}
  </div>

  <script>
    setTimeout(() => {
      const box = document.getElementById('notifBox');
      if (box) box.style.display = 'none';
    }, 3000);
  </script>
  @endif



  <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
    @csrf


    <div class="konten text-black " id="orderContainer"></div>


    <input type="hidden" name="items" id="itemsField">
    <input type="hidden" name="total_bayar" id="totalBayarField">
    <input type="hidden" name="kembalian" id="kembalianField">

    <div class="summary bg-gray-500 text-white" id="warna">
      <label>Total Bayar</label>
      <input type="number" name="total" id="totalBayar" readonly>

      <label>Uang Pelanggan</label>
      <input type="number" name="uang" id="uangPelanggan" min="0">
      <p id="notifError" class="text-red-700 fw-bold mt-2"></p>

      <label>Kembalian</label>
      <input type="number" name="hasil" id="kembalian" readonly>

      <!-- <button type="submit" class="btn bg-success p-3 w-100 mt-4 text-black fs-5 fw-bold" id="btnSimpan">
        Simpan
      </button> -->

      <button type="submit" class="container mt-4" id="cardBtn">

        <div class="left-side">
          <div class="kartu">
            <div class="kartu-line"></div>
            <div class="buttons"></div>
          </div>

          <div class="post">
            <div class="post-line"></div>
            <div class="screen">
              <div class="dollar">$</div>
            </div>
            <div class="numbers"></div>
            <div class="numbers-line2"></div>
          </div>
        </div>

        <div class="right-side">
          <div class="new">Simpan Transaksi</div>

          <svg viewBox="0 0 451.846 451.847" height="512" width="512" xmlns="http://www.w3.org/2000/svg" class="arrow">
            <path fill="#cfcfcf" d="M345.441 248.292L151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373z"></path>
          </svg>
        </div>

      </button>



    </div>
  </form>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const orderContainer = document.getElementById("orderContainer");
      const totalBayarInput = document.getElementById("totalBayar");
      const uangPelanggan = document.getElementById("uangPelanggan");
      const kembalianInput = document.getElementById("kembalian");

      const itemsField = document.getElementById("itemsField");
      const totalBayarField = document.getElementById("totalBayarField");
      const kembalianField = document.getElementById("kembalianField");

      const pesanan = JSON.parse(localStorage.getItem("pesanan") || "[]");

      let totalBayar = 0;

      pesanan.forEach(item => {

        const price = parseInt(String(item.price).replace(/\./g, ''));

        const subtotal = price * item.qty;
        totalBayar += subtotal;

        orderContainer.innerHTML += `
      <div class="card">
        <h3>${item.name}</h3>
        <p>Harga: ${price} | Jumlah: ${item.qty}</p>
        <p>Subtotal: ${subtotal}</p>
      </div>
    `;
      });

      totalBayarInput.value = totalBayar;
      totalBayarField.value = totalBayar;

      uangPelanggan.addEventListener("input", () => {
        const uang = parseInt(uangPelanggan.value) || 0;

        
        const MAX_UANG = 999999999999;
        if (uang > MAX_UANG) {
          document.getElementById("notifError").textContent = "⚠️ Uang pelanggan terlalu besar!";
          kembalianInput.value = 0;
          kembalianField.value = 0;
          return;
        }

        const kembali = Math.max(0, uang - totalBayar);

        kembalianInput.value = kembali;
        kembalianField.value = kembali;
        document.getElementById("notifError").textContent = "";

      });

      document.getElementById("formTransaksi").addEventListener("submit", function(e) {
        const uang = parseInt(uangPelanggan.value) || 0;

       
        const MAX_UANG = 999999999999;
        if (uang > MAX_UANG) {
          e.preventDefault();
          const notif = document.getElementById("notifError");
          notif.textContent = "⚠️ Uang pelanggan terlalu besar!";
          return false;
        }

        if (uang < totalBayar) {
          e.preventDefault();

          const notif = document.getElementById("notifError");
          notif.textContent = "⚠️ Uang pelanggan kurang !";

          return false;
        }

        itemsField.value = JSON.stringify(pesanan);
        localStorage.removeItem("pesanan");
      });
    });


    document.getElementById('cardBtn').addEventListener('click', function() {
      this.classList.toggle('active');
    });



    
  </script>

</x-layout>