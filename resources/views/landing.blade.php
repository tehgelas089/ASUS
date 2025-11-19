<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>


  <style>
    /* === Reset & Body === */
    /* body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      
      color: #fff;
      min-height: 100vh;
      
      display: flex;
      flex-direction: column;
    } */



    /* === Product Grid === */
    .product-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      /* Lebar kartu sedikit dilebarkan */
      gap: 25px;
      /* Jarak antar kartu ditingkatkan */
      max-width: 1200px;
      /* Lebar maksimum ditingkatkan */
      margin: 40px auto;
      padding: 0 20px;
      flex-grow: 1;


    }

    /* .product-card img {
      width: 100%;
      height: 250px;

      
      object-fit: contain;
      background-color: #fff;
      
      display: block;
    } */

    /* === Product Card Style (Ditingkatkan) === */
    .product-card {
      /* background-color: #EEEEEE; */
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      cursor: pointer;
      border: 2px solid transparent;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
      /* Shadow lebih tebal */
      text-align: center;
      display: flex;
      flex-direction: column;
      display: flex;

      align-items: center;
      justify-content: flex-start;
      overflow: hidden;

    }

    .product-card:hover {
      transform: translateY(-8px);
      /* Efek hover lebih menonjol */
      box-shadow: 0 10px 25px #9B5DE0;
    }

    .product-card.selected {
      border-color: #ff3385;
      /* Ungu terang */
      box-shadow: 0 0 20px #ff0066;
      /* Glow lebih kuat */
    }

    .product-card img {
      width: 100%;
      height: 250px;

      object-fit: cover;
      border-bottom: 2px solid #1f1b2e;
    }

    .product-card-content {
      padding: 15px 10px;
      flex-grow: 1;
    }

    .product-card h3 {
      margin: 0 0 5px;
      font-size: 1.25rem;
      /* Ukuran font lebih besar */
      color: black;
      font-weight: 600;
    }

    .product-card p {
      margin: 0;
      color: #000000;
      /* Warna harga lebih menonjol */
      font-size: 1.1rem;
      font-weight: bold;
    }


    /* === Badge jumlah (Ditingkatkan) === */
    .quantity-badge {
      position: absolute;
      top: 15px;
      /* Posisi di geser ke dalam */
      right: 15px;
      background: #ff0066;
      color: #fff;
      font-weight: 700;
      border-radius: 50%;
      width: 30px;
      /* Ukuran badge diperbesar */
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
      z-index: 10;
    }

    /* === Popup (Ditingkatkan) === */
    .popup {
      position: fixed;
      bottom: -250px;
      /* Geser lebih jauh ke bawah */
      left: 0;
      width: 100%;
      background: rgba(34, 32, 45, 0.98);
      /* Lebih solid */
      backdrop-filter: blur(12px);
      /* Blur lebih kuat */
      padding: 30px 20px 40px;
      /* Padding ditingkatkan */
      box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.7);
      border-top-left-radius: 20px;
      border-top-right-radius: 20px;
      text-align: center;
      transition: bottom 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      /* Animasi pantulan yang menarik */
      z-index: 1000;
    }

    .popup.active {
      bottom: 0;
    }

    .popup p {
      font-size: 1.3rem;
      /* Teks lebih besar */
      color: #fff;
      margin-bottom: 25px;
      font-weight: 500;
    }

    .btn-lanjut {
      display: block;
      /* text-align: center; */
      text-decoration: none;
      /* height: 55px; */
      /* Tombol lebih besar */
      line-height: 55px;
      border-radius: 12px;
      background-color: #ff0066;
      color: #fff;


      transition: background-color 0.3s, transform 0.2s;
      margin-bottom: 15px;
    }

    .btn-lanjut:hover {
      background-color: #ff3385;
      transform: translateY(-2px);
    }

    .btn-batal {
      background-color: transparent;
      border: 2px solid #985ad7;
      color: #985ad7;
      padding: 12px 25px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn-batal:hover {
      background-color: #985ad7;
      color: #fff;
    }
  </style>

  <div class="product-list ">
    @foreach ($products as $product)
    <div class="product-card" data-price="{{ $product->price }}">
      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
      <div class="product-card-content">
        <h3>{{ $product->name }}</h3>
        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
      </div>
    </div>
    @endforeach
  </div>

  <div class="popup" id="popup">
    <p id="popupText">0 item dipilih</p>
    <a href="{{ url('/app') }}" class="btn-lanjut w-100 h-50 fw-bold fs-5" id="btnLanjut">Lanjutkan ke Pemesanan</a>
    <button class="btn-batal w-100 h-50 text-center fw-bold fs-5" id="btnBatal">Batalkan Pilihan</button>
  </div>

  <script>
    const cards = document.querySelectorAll(".product-card"); // ✅ pakai .product-card

    const popup = document.getElementById("popup");
    const popupText = document.getElementById("popupText");
    const btnLanjut = document.getElementById("btnLanjut");
    const btnBatal = document.getElementById("btnBatal");

    let selectedItems = new Map();

    cards.forEach(card => {
      card.addEventListener("click", () => {
        const title = card.querySelector("h3").textContent;
        let count = selectedItems.get(title) || 0;
        count++;
        selectedItems.set(title, count);

        card.classList.add("selected");

        let badge = card.querySelector(".quantity-badge");
        if (!badge) {
          badge = document.createElement("div");
          badge.classList.add("quantity-badge");
          card.appendChild(badge);
        }
        badge.textContent = count;

        updatePopup();
      });
    });

    function updatePopup() {
      // Mengambil jumlah item unik (selectedItems.size)
      const totalUniqueItems = selectedItems.size;
      // Menghitung total porsi (sum of quantities)
      const totalQty = Array.from(selectedItems.values()).reduce((a, b) => a + b, 0);

      if (totalUniqueItems > 0) {
        popup.classList.add("active");
        popupText.textContent = `${totalUniqueItems} menu dipilih (${totalQty} porsi)`;

        // ✅ Tambahkan ruang di bawah halaman supaya popup tidak menutupi konten
        document.body.style.paddingBottom = popup.offsetHeight + "px";
      } else {
        popup.classList.remove("active");

        // ✅ Hapus ruang bawah ketika popup disembunyikan
        document.body.style.paddingBottom = "0";
      }
    }

    // === Simpan pesanan ke localStorage dan lanjutkan ===
    btnLanjut.addEventListener("click", (e) => {
      // Mencegah navigasi default jika keranjang kosong
      if (selectedItems.size === 0) {
        e.preventDefault();
        return;
      }

      const order = Array.from(selectedItems, ([name, qty]) => {
        const card = Array.from(cards).find(c => c.querySelector("h3").textContent === name);
        // Pastikan price diambil sebagai integer
        const price = parseInt(card.dataset.price);
        return {
          name,
          qty,
          price
        };
      });

      localStorage.setItem("pesanan", JSON.stringify(order));
      // Navigasi akan dilanjutkan oleh link <a> default, tidak perlu window.location.href di sini
    });

    // Batalkan semua pilihan
    btnBatal.addEventListener("click", () => {
      selectedItems.clear();
      cards.forEach(c => {
        c.classList.remove("selected");
        const b = c.querySelector(".quantity-badge");
        if (b) b.remove();
      });
      popup.classList.remove("active");

      // ✅ Hapus ruang bawah ketika popup ditutup
      document.body.style.paddingBottom = "0";
    });
  </script>
</x-layout>