<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>


  <style>
    /* CSS Kustom (dipertahankan dan diperbarui untuk estetika) */
    .wrapper {
      display: flex;
      gap: 24px;
      /* Mengurangi gap */
      align-items: flex-start;
      flex-wrap: wrap;
    }

    /* Styling Form */
    form {
      background: #ffffff;
      padding: 24px;
      border-radius: 12px;
      /* box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); */
      /* Shadow lebih menonjol */
      width: 100%;
      /* Default 100% untuk mobile */
      max-width: 320px;
      /* Batasan lebar untuk desktop */
      flex-shrink: 0;
      transition: all 0.3s ease;
      /* Transisi untuk display:none/block */
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="file"] {
      width: 100%;
      margin-bottom: 12px;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #d1d5db;
      /* Border abu-abu muda */
      font-size: 14px;
      transition: border-color 0.2s;
    }

    form input:focus {
      outline: none;
      border-color: #4f46e5;
      /* Border ungu saat focus */
    }

    form button {
      width: 100%;
      padding: 10px 12px;
      border: none;
      color: white;
      border-radius: 8px;
      font-weight: 600;
      /* semi-bold */
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 8px;
    }

    /* Tombol Tambah/Simpan */
    form button[type="submit"] {
      background-color: #4f46e5;
      /* ungu/indigo */
    }

    form button[type="submit"]:hover {
      background-color: #4338ca;
    }

    /* Tombol Batal */
    form button.cancel {
      background-color: #6b7280;
      /* abu-abu gelap */
      margin-top: 10px;
    }

    form button.cancel:hover {
      background-color: #4b5563;
    }

    /* Daftar Produk - Container */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      /* Responsif grid */
      gap: 16px;
      flex-grow: 1;
      /* Memungkinkan grid mengambil sisa ruang */
    }

    /* Kartu Produk */
    .product-card {
      background: #ffffff;
      border-radius: 12px;
      /* box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06); */
      padding: 10px;
      text-align: center;
      /* transition: transform 0.2s, box-shadow 0.2s; */
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow: hidden;
      /* Pastikan konten tidak meluber */
    }

    .product-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .product-card-info {
      cursor: pointer;
      /* Menandakan area yang bisa di-klik untuk edit */
      padding: 5px;
      flex-grow: 1;
    }

    .product-card-info img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .product-card-info h4 {
      margin: 0 0 5px 0;
      font-size: 16px;
      font-weight: 600;
      color: #1f2937;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .product-card-info p {
      margin: 0 0 10px 0;
      font-size: 14px;
      color: #4f46e5;
      /* Warna harga */
      font-weight: bold;
    }

    .product-card form {
      margin-top: 5px;
      /* box-shadow: none; */
      padding: 0;
      background: none;
      max-width: none;
    }

    /* Tombol Hapus */
    .product-card form button {
      background-color: #ef4444;
      /* Merah */
      padding: 8px;
      font-size: 14px;
      margin: 0;
      font-weight: 500;
    }

    .product-card form button:hover {
      background-color: #dc2626;
    }

    /* Alert (notifikasi sukses) */
    .alert {
      background: #d1fae5;
      /* Hijau muda */
      color: #065f46;
      /* Hijau tua */
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 24px;
      font-weight: 500;
    }


    .bin {
      /* ubah warna pake variabel */
      --black: #DD0303;
      --binbg: #e6e6e6;
      --width: 40px;
      --height: 50px;
      background-image: repeating-linear-gradient(to right,
          transparent,
          transparent 5px,
          var(--black) 5px,
          var(--black) 7px,
          transparent 7px);
      background-size: 11px calc(var(--height) / 2);
      background-position: 2px center;
      background-repeat: repeat-x;
      margin: auto;
      position: relative;
      background-color: var(--binbg);
      border: 0;
      color: transparent;
      width: var(--width);
      height: var(--height);
      border: 2px solid var(--black);
      border-radius: 0 0 6px 6px;
    }

    .bin::after,
    .bin::before {
      content: "";
      position: absolute;
      transform-origin: left bottom;
      transition: 200ms ease-in-out;
      border-width: 2px;
      border-style: solid;
      margin: auto;
      right: 0;
    }

    .bin::after {
      left: -4px;
      top: -5px;
      height: 7px;
      width: var(--width);
      border: 2px solid var(--black);
      background-color: var(--binbg);
      border-radius: 5px 5px 0 0;
    }

    .bin::before {
      top: -8px;
      height: 2px;
      width: 10px;
      border-color: var(--black) var(--black) transparent var(--black);
      left: 0;
    }

    .bin:focus,
    .bin:active {
      outline: none;
      cursor: none;
    }

    .bin:focus::before,
    .bin:focus::after,
    .bin:active::before,
    .bin:active::after {
      animation: binled 500ms 30ms cubic-bezier(0.215, 0.61, 0.355, 0.3) forwards;
    }

    @keyframes binled {
      0% {
        transform-origin: left bottom;
        transform: rotate(0deg);
      }

      50% {
        transform-origin: left bottom;
        transform: rotate(-45deg);
      }

      100% {
        transform: rotate(0deg);
      }
    }

    .bin:focus::before,
    .bin:active::before {
      animation: ledhead 500ms 30ms cubic-bezier(0.215, 0.61, 0.355, 0.3) forwards;
    }

    @keyframes ledhead {
      0% {
        top: -10px;
        left: 5px;
        right: 7px;
        transform-origin: left bottom;
        transform: rotate(0deg);
      }

      50% {
        top: -18px;
        left: -23px;
        right: 3px;
        transform-origin: left bottom;
        transform: rotate(-45deg);
      }

      100% {
        top: -8px;
        left: 7px;
        right: 7px;
        transform: rotate(0deg);
      }
    }

    .bin:focus~.div,
    .bin:active~.div {
      cursor: none;
      z-index: 1;
    }

    .bin:focus~.div:hover,
    .bin:active~.div:hover {
      cursor: none;
    }

    .bin:focus~.overlay,
    .bin:active~.overlay {
      pointer-events: inherit;
      z-index: 2;
      cursor: none;
    }

    .bin:focus~.div>small,
    .bin:active~.div>small {
      opacity: 1;
      animation: throw 300ms 30ms cubic-bezier(0.215, 0.61, 0.355, 0.3) forwards;
    }

    .div:focus,
    .div:active,
    .div:hover {
      z-index: 1;
      cursor: none;
    }

    .div>small {
      position: absolute;
      width: 20px;
      height: 16px;
      left: 0;
      right: -58px;
      margin: auto;
      top: 27px;
      bottom: 0;
      border-left: 1px solid black;
      opacity: 0;
    }

    .div>small::before,
    .div>small::after {
      content: "";
      position: absolute;
      width: 1px;
      border-right: 1px solid black;
    }

    .div>small::before {
      height: 17px;
      transform: rotate(-42deg);
      top: -3px;
      right: 13px;
    }

    .div>small::after {
      height: 4px;
      transform: rotate(-112deg);
      top: 18px;
      right: 11px;
    }

    .div>small>i::before,
    .div>small>i::after {
      content: "";
      position: absolute;
      border-top: 1px solid black;
    }

    .div>small>i::before {
      border-left: 1px solid black;
      width: 4px;
      bottom: -4px;
      height: 4px;
      transform: rotate(66deg);
    }

    .div>small>i::after {
      border-right: 1px solid black;
      width: 5px;
      bottom: -2px;
      height: 5px;
      transform: rotate(-114deg);
      right: 6px;
    }

    @keyframes throw {
      0% {
        transform: translate(0, 0);
      }

      50% {
        transform: translate(0, -30px) rotate(-10deg);
      }

      60% {
        transform: translate(0, -40px) rotate(-30deg);
      }

      70% {
        transform: translate(-5px, -50px) rotate(-40deg) scale(1);
        opacity: 1;
      }

      80% {
        transform: translate(-10px, -60px) rotate(-60deg) scale(0.9);
        opacity: 1;
      }

      90% {
        transform: translate(-20px, -50px) rotate(-100deg) scale(0.5);
        opacity: 0.8;
      }

      100% {
        transform: translate(-30px, -20px) rotate(-80deg) scale(0.4);
        opacity: 0;
      }
    }

    button.bin {
      position: fixed;
      right: 16px;
      bottom: 16px;
      z-index: 1000;
    }
  </style>

  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 ">
    @if(session('success'))
    <div class="alert relative pr-10" role="alert" id="successAlert">
      {{ session('success') }}

      <!-- Tombol Close -->
      <button
        type="button"
        id="closeAlertBtn"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-700 hover:text-gray-900">
        ✕
      </button>
    </div>
    @endif



    <div class="wrapper ">
      <form class="shadow-lg shadow-teal-700 rounded-xl p-6" id="formTambah" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="text-lg font-bold text-gray-900 mb-4 ">Tambah Produk Baru</h3>
        <input type="text" name="name" placeholder="Nama Produk" required class="text-gray-900">
        <input type="number" name="price" placeholder="Harga (Rp)" required class="text-gray-900">
        <div class="my-3">
          <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk (Opsional)</label>
          <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>
        <button type="submit">Tambah Produk</button>
      </form>

      <form id="formEdit" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        @method('POST')
        <h3 class="text-lg font-bold text-gray-900 mb-4">Edit Produk</h3>
        <input type="text" name="name" id="editName" placeholder="Nama Produk" required class="text-gray-900">
        <input type="number" name="price" id="editPrice" placeholder="Harga (Rp)" required class="text-gray-900">
        <div class="my-3">
          <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (Kosongkan jika tidak)</label>
          <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>
        <button type="submit">Simpan Perubahan</button>
        <button type="button" class="cancel" onclick="batalEdit()">Batal</button>
      </form>

      <div class="products-grid ">
        @forelse($products as $product)
        <div class="product-card shadow-lg shadow-teal-700 rounded-xl p-6">
          <div class="product-card-info">
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @else
            <img src="{{ asset('img/noimage.png') }}" alt="No Image">
            @endif
            <h4>{{ $product->name }}</h4>
            <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          </div>

          <!-- 🔽 Tambahkan tombol Edit -->
          <button type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded"
            onclick="editProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
            Edit
          </button>

          <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }} ini?')">
            @csrf
            @method('DELETE')
          </form>
        </div>
        @empty
        <div class="col-span-full p-4 bg-white rounded-lg shadow-md text-center text-gray-500">
          Tidak ada produk yang tersedia saat ini. Silakan tambahkan satu!
        </div>
        @endforelse
      </div>
    </div>

    <button class="bin">🗑</button>
    <div class="div">
      <small>
        <i></i>
      </small>
    </div>


    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-[2000]">
      <div class="bg-white rounded-xl p-6 w-[90%] max-w-md shadow-lg">
        <div class="alert mx-4 mt-4 alert-warning d-flex text-start align-items-center" role="alert">
          <i class="bi bi-exclamation-triangle me-2"></i>
          <div class="text-wrap">
            Anda yakin menghapus <strong id="deleteItemName">produk ini</strong>?
          </div>
        </div>
        <div class="flex justify-end gap-3 mt-4">
          <button id="cancelDelete" class="bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded">Tidak</button>
          <button id="confirmDelete" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Ya</button>
        </div>
      </div>
    </div>

    <!-- Alert native setelah delete -->
    <!-- <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 hidden" id="successAlert">
      <div class="alert bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded relative" role="alert">
        Produk berhasil dihapus!
      </div>
    </div> -->

  </div>


  <script>
    function editProduct(id, name, price) {
      document.getElementById('formTambah').style.display = 'none';
      const formEdit = document.getElementById('formEdit');
      formEdit.style.display = 'block';

      // 🔽 Sembunyikan semua tombol hapus
      document.querySelectorAll('.product-card form').forEach(form => {
        form.style.display = 'none';
      });

      // Mengatur action form dengan URL yang benar
      formEdit.action = `{{ url('/product/update') }}/${id}`;

      // Mengisi nilai input
      document.getElementById('editName').value = name;
      document.getElementById('editPrice').value = price;
    }

    function batalEdit() {
      document.getElementById('formEdit').style.display = 'none';
      document.getElementById('formTambah').style.display = 'block';
      // Bersihkan form edit saat dibatalkan
      document.getElementById('formEdit').reset();

      // 🔽 Tampilkan kembali tombol hapus
      document.querySelectorAll('.product-card form').forEach(form => {
        form.style.display = 'block';
      });
    }
    // delete
    document.querySelectorAll('.product-card').forEach(card => {
      let isDragging = false;
      let offsetX = 0,
        offsetY = 0;
      let originLeft = 0,
        originTop = 0;

      card.addEventListener('mousedown', e => {
        e.preventDefault();
        isDragging = true;
        const rect = card.getBoundingClientRect();
        offsetX = e.clientX - rect.left;
        offsetY = e.clientY - rect.top;
        originLeft = card.offsetLeft;
        originTop = card.offsetTop;

        card.style.position = 'fixed';
        card.style.zIndex = 1000;
        card.style.transition = 'none';
      });

      document.addEventListener('mousemove', e => {
        if (!isDragging) return;

        // posisi baru kartu
        let newX = e.clientX - offsetX;
        let newY = e.clientY - offsetY;

        // batasi dalam jangkauan window (supaya gak keluar page)
        const maxX = window.innerWidth - card.offsetWidth;
        const maxY = window.innerHeight - card.offsetHeight;
        if (newX < 0) newX = 0;
        if (newY < 0) newY = 0;
        if (newX > maxX) newX = maxX;
        if (newY > maxY) newY = maxY;

        card.style.left = newX + 'px';
        card.style.top = newY + 'px';

        // deteksi overlap dengan tong sampah
        const bin = document.querySelector('button.bin');
        const binRect = bin.getBoundingClientRect();
        const cardRect = card.getBoundingClientRect();

        if (
          cardRect.left < binRect.right &&
          cardRect.right > binRect.left &&
          cardRect.top < binRect.bottom &&
          cardRect.bottom > binRect.top
        ) {
          bin.classList.add('active-by-js');
          bin.focus();

          const productId = card.querySelector('form').action.split('/').pop();
          const productName = card.querySelector('h4')?.textContent || 'produk ini';
          showDeleteModal(productId, productName, card); // 🔹 ubah di sini

          cleanup();
          setTimeout(() => {
            bin.classList.remove('active-by-js');
            bin.blur();
          }, 300);
        } else {
          bin.classList.remove('active-by-js');
          bin.blur();
        }
      });

      document.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;

        // reset animasi balik ke posisi awal
        card.style.transition = 'left 0.25s ease, top 0.25s ease';
        card.style.left = originLeft + 'px';
        card.style.top = originTop + 'px';

        setTimeout(() => {
          card.style.position = '';
          card.style.left = '';
          card.style.top = '';
          card.style.zIndex = '';
          card.style.transition = '';
        }, 250);
      });

      function cleanup() {
        isDragging = false;
      }

      card.ondragstart = () => false;
    });

    // Modal handler (dengan animasi balik posisi jika pilih Tidak)
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');
    const deleteItemName = document.getElementById('deleteItemName');

    let currentDeleteId = null;
    let currentDraggedCard = null;
    let originalLeft = 0;
    let originalTop = 0;

    function showDeleteModal(id, name, card) {
      currentDeleteId = id;
      currentDraggedCard = card;
      originalLeft = card.offsetLeft;
      originalTop = card.offsetTop;
      deleteItemName.textContent = name;
      deleteModal.classList.remove('hidden');
    }

    cancelDeleteBtn.addEventListener('click', () => {
      deleteModal.classList.add('hidden');
      if (currentDraggedCard) {
        // animasi balik ke posisi semula
        currentDraggedCard.style.transition = 'left 0.25s ease, top 0.25s ease';
        currentDraggedCard.style.left = originalLeft + 'px';
        currentDraggedCard.style.top = originalTop + 'px';
        setTimeout(() => {
          currentDraggedCard.style.position = '';
          currentDraggedCard.style.left = '';
          currentDraggedCard.style.top = '';
          currentDraggedCard.style.zIndex = '';
          currentDraggedCard.style.transition = '';
          currentDraggedCard = null;
        }, 250);
      }
      currentDeleteId = null;
    });

    confirmDeleteBtn.addEventListener('click', () => {
      if (!currentDeleteId) return;
      deleteModal.classList.add('hidden');

      // 🔥 HAPUS KARTU LANGSUNG (sebelum fetch)
      if (currentDraggedCard) {
        currentDraggedCard.remove();
        currentDraggedCard = null;
      }

      fetch(`/product/delete/${currentDeleteId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
          'X-Requested-With': 'XMLHttpRequest',
        },
        body: new URLSearchParams({
          '_method': 'DELETE'
        }),
      }).then(() => {
        const successAlert = document.getElementById('successAlert');
        successAlert.classList.remove('hidden');

        setTimeout(() => {
          location.reload();
        }, 1000);
      });
    });


    // event default tong sampah (tidak diubah)
    const bin = document.querySelector('button.bin');
    bin.addEventListener('dragover', function(e) {
      e.preventDefault();
      bin.classList.add('active-by-js');
      bin.focus();
    });
    bin.addEventListener('dragleave', function() {
      bin.classList.remove('active-by-js');
      bin.blur();
    });
    bin.addEventListener('drop', function(e) {
      e.preventDefault();
      bin.classList.remove('active-by-js');
      bin.blur();
      const productId = e.dataTransfer.getData('product-id');
      if (productId) {
        showDeleteModal(productId, 'produk ini');
      }
    });


    //button x
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('closeAlertBtn');
      const alertBox = document.getElementById('successAlert');

      if (btn && alertBox) {
        btn.addEventListener('click', () => {
          alertBox.style.transition = "opacity 0.3s ease";
          alertBox.style.opacity = 0;

          setTimeout(() => {
            alertBox.remove();
          }, 300);
        });
      }
    });
  </script>

</x-layout>