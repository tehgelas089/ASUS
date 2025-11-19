<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>


  <style>
    .container {
      max-width: 1100px;
      margin: 50px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: #F57D1F;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      padding: 15px;
      transition: all 0.3s ease;
      border: 2px solid;

    }

    .card h3 {
      margin: 10px 0 5px;
      font-size: 1.2rem;
    }

    .card p {
      margin: 0;
      font-size: 1rem;
      color: black;
    }

    .summary {
      max-width: 1100px;
      margin: 20px auto;
      padding: 0 20px;
      background-color: #F57D1F;
      border-radius: 12px;
      padding: 20px;
      border: 2px solid;
    }

    .summary label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
      font-weight: bold;

    }

    .summary input {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: none;
      /* font-size: 1rem; */
      background-color: #fff;
      color: #000000;
    }

    .btn-primary {
      margin-top: 15px;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 10px;
      /* background-color: #ff0066; */
      color: #fff;
      font-size: 1.1rem;
      cursor: pointer;
      transition: 0.3s;
    }


    /* .btn-primary:hover {
      background-color: #ff3385;
    } */
  </style>
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

    <!-- TEMPAT TAMPIL PESANAN -->
    <div class="container text-white" id="orderContainer"></div>

    <!-- DATA UNTUK DIKIRIM KE LARAVEL -->
    <input type="hidden" name="items" id="itemsField">
    <input type="hidden" name="total_bayar" id="totalBayarField">
    <input type="hidden" name="kembalian" id="kembalianField">

    <div class="summary" id="warna">
      <label>Total Bayar</label>
      <input type="number" name="total" id="totalBayar" readonly>

      <label>Uang Pelanggan</label>
      <input type="number" name="uang" id="uangPelanggan" min="0">

      <label>Kembalian</label>
      <input type="number" name="hasil" id="kembalian" readonly>

      <button type="submit" class="btn bg-success p-3 w-100 mt-4 text-black fs-5 fw-bold" id="btnSimpan">
        Simpan
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
        const subtotal = item.price * item.qty;
        totalBayar += subtotal;

        orderContainer.innerHTML += `
      <div class="card">
        <h3>${item.name}</h3>
        <p>Harga: ${item.price} | Jumlah: ${item.qty}</p>
        <p>Subtotal: ${subtotal}</p>
      </div>
    `;
      });

      totalBayarInput.value = totalBayar;
      totalBayarField.value = totalBayar;

      uangPelanggan.addEventListener("input", () => {
        const uang = parseInt(uangPelanggan.value) || 0;
        const kembali = Math.max(0, uang - totalBayar);

        kembalianInput.value = kembali;
        kembalianField.value = kembali;
      });

      document.getElementById("formTransaksi").addEventListener("submit", function(e) {
        const uang = parseInt(uangPelanggan.value) || 0;

        // 🚫 Validasi uang kurang
        if (uang < totalBayar) {
          e.preventDefault();
          alert("⚠️ Uang pelanggan kurang dari total bayar!");
          return false;
        }

        itemsField.value = JSON.stringify(pesanan);
        localStorage.removeItem("pesanan");
      });
    });


    // AMBIL WARNA DARI SESSION STORAGE
    // const primary = sessionStorage.getItem('primaryColor');
    // const secondary = sessionStorage.getItem('secondaryColor');

    // if (primary) {
    //   const colorElement = document.getElementById('color');
    //   if (colorElement) colorElement.style.backgroundColor = primary;
    // }

    // if (secondary) {
    //   const warnaElement = document.getElementById('warna');
    //   if (warnaElement) warnaElement.style.backgroundColor = secondary;
    // }
  </script>

</x-layout>