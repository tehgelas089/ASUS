<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link rel="stylesheet" href="{{ asset('css/kelola.css') }}">



  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 ">


    @if(session('success'))
    <div class="relative">
      <div class="p-3 mb-3 rounded bg-emerald-400 text-white text-center" id="successAlert">
        {{ session('success') }}
      </div>

      <button
        type="button"
        id="closeSuccessBtn"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-white hover:text-gray-300">
        ✕
      </button>
    </div>
    @endif

    @if (session('error'))
    <div class="relative">

      <div class="p-3 mb-3 rounded bg-red-700 text-white text-center" id="errorAlert">
        {{ session('error') }}
      </div>

      <button
        type="button"
        id="closeErrorBtn"
        class="absolute right-2 top-1/2 -translate-y-1/2 text-white hover:text-gray-300">
        ✕
      </button>

    </div>
    @endif









    <div class="wrapper flex gap-5 ">
      <form class="shadow-lg shadow-teal-700 rounded-xl p-6 bg-white w-100" id="formTambah" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="text-lg font-bold text-gray-900 mb-4 ">Tambah Produk Baru</h3>
        <input type="text" name="name" placeholder="Nama Produk" required class="text-gray-900">
        <input type="number" name="price" placeholder="Harga (Rp)" required class="text-gray-900">
        <div class="my-3">
          <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Produk (Opsional)</label>
          <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>

        <button type="submit" class="w-100 text-white fw-bold mt-2 border-none bg-green-600 hover:bg-green-800">Tambah Produk</button>
      </form>

      <form id="formEdit" class="shadow-lg shadow-teal-700 rounded-xl p-6 bg-white w-100" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        @method('POST')
        <h3 class="text-lg font-bold text-gray-900 mb-4">Edit Produk</h3>
        <input type="text" name="name" id="editName" placeholder="Nama Produk" required class="text-gray-900">
        <input type="number" name="price" id="editPrice" placeholder="Harga (Rp)" required class="text-gray-900">
        <div class="my-3">
          <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (Kosongkan jika tidak)</label>
          <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        </div>
        <button type="submit" class="w-100 text-white fw-bold mt-2 border-none bg-green-600 hover:bg-green-800">Simpan Perubahan</button>
        <button type="button" class="cancel bg-gray-500 hover:bg-gray-700 mt-3 w-100 text-white fs-5" onclick="batalEdit()">Batal</button>
      </form>

      <div class="products-grid ">
        @forelse($products as $product)
        <div class="product-card shadow-lg shadow-teal-700 rounded-xl p-6 bg-white text-center flex overflow-hidden">
          <div class="product-card-info">
            @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @else
            <img src="{{ asset('img/noimage.png') }}" alt="No Image">
            @endif
            <h4 class="fs-5 fw-bold text-gray-600 overflow-hidden">{{ $product->name }}</h4>
            <p class="fs-7 text-teal-500 fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
          </div>

          <!-- 🔽 Tambahkan tombol Edit -->
          <!-- <button type="button" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded"
            onclick="editProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }})">
            Edit
          </button> -->

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

      document.querySelectorAll('.product-card form').forEach(form => {
        form.style.display = 'none';
      });

      formEdit.action = `{{ url('/product/update') }}/${id}`;

      document.getElementById('editName').value = name;
      document.getElementById('editPrice').value = price;
    }

    function batalEdit() {
      document.getElementById('formEdit').style.display = 'none';
      document.getElementById('formTambah').style.display = 'block';

      document.getElementById('formEdit').reset();

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

        let newX = e.clientX - offsetX;
        let newY = e.clientY - offsetY;

        const maxX = window.innerWidth - card.offsetWidth;
        const maxY = window.innerHeight - card.offsetHeight;
        if (newX < 0) newX = 0;
        if (newY < 0) newY = 0;
        if (newX > maxX) newX = maxX;
        if (newY > maxY) newY = maxY;

        card.style.left = newX + 'px';
        card.style.top = newY + 'px';


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
          showDeleteModal(productId, productName, card);

          cleanup();
          setTimeout(() => {
            bin.classList.remove('active-by-js');
            bin.blur();
          }, 300);
        } else {
          bin.classList.remove('active-by-js');
          bin.blur();
        }


        const formTambah = document.getElementById('formTambah');
        const tambahRect = formTambah.getBoundingClientRect();

        if (
          cardRect.left < tambahRect.right &&
          cardRect.right > tambahRect.left &&
          cardRect.top < tambahRect.bottom &&
          cardRect.bottom > tambahRect.top
        ) {
          const productId = card.querySelector('form').action.split('/').pop();
          const productName = card.querySelector('h4')?.textContent;
          const productPrice = card.querySelector('p')?.textContent.replace(/\D/g, "");


          editProduct(productId, productName, productPrice);

          cleanup();
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

          return;
        }


      });

      document.addEventListener('mouseup', () => {
        if (!isDragging) return;
        isDragging = false;

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

    document.addEventListener('DOMContentLoaded', () => {

      const closeSuccessBtn = document.getElementById('closeSuccessBtn');
      const successAlert = document.getElementById('successAlert');

      if (closeSuccessBtn && successAlert) {
        closeSuccessBtn.addEventListener('click', () => {
          successAlert.remove();
        });
      }

      const closeErrorBtn = document.getElementById('closeErrorBtn');
      const errorAlert = document.getElementById('errorAlert');

      if (closeErrorBtn && errorAlert) {
        closeErrorBtn.addEventListener('click', () => {
          errorAlert.remove();
        });
      }

    });
  </script>

</x-layout>