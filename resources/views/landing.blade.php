<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link rel="stylesheet" href="{{ asset('css/dasbor.css') }}">


  <div class="product-list ">
    @foreach ($products as $product)
    <div class="product-card overflow-hidden text-center flex justify-content-flex-start align-items-center" data-price="{{ $product->price }}">
      <img class="w-100 h-[250px] object-cover border-bottom-2" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
      <div class="product-card-content">
        <h3 class="fs-5 text-black fw-bold">{{ $product->name }}</h3>
        <p class="fs-5 fw-bold text-black m-0">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
      </div>
    </div>
    @endforeach
  </div>

  <div class="popup w-100 bg-gray-700 shadow-sm text-center" id="popup">
    <p id="popupText" class="fs-5 text-white mb-6 fw-bold">0 item dipilih</p>
    <a href="{{ url('/app') }}" class="btn-lanjut w-100 h-50 fw-bold fs-5 bg-teal-500 hover:bg-teal-700 text-decoration-none text-white" id="btnLanjut">Lanjutkan ke Pemesanan</a>
    <button class="btn-batal w-100 h-50 text-center fw-bold fs-5 bg-red-600 hover:bg-red-800 border-red-500 border-2 text-red-700 hover:text-white fs-5 fw-bold" id="btnBatal">Batalkan Pilihan</button>
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