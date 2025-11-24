<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <div class="garis bg-body min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl">

      <div class="bg-white shadow-lg shadow-teal-900 rounded-xl p-8 mx-auto border-3 border-black">

        <div class="row g-0 align-items-center">

          <div class="col-12 col-md-4 d-flex justify-content-center p-3">
            <div class="text-center">
              <img
                alt="Foto Profil"
                src="{{ asset($user->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
                class="rounded-circle shadow object-fit-cover"
                style="width: 180px; height: 180px; object-fit: cover;">
              <br>

              <label class="mt-3 text-sm font-medium">
                <a href="#" class="text-decoration-none text-indigo-600 cursor-pointer hover:text-indigo-800">
                  Ganti Foto
                </a>
                <input type="file" name="usr_card_url" class="hidden" accept="image/*">
              </label>
            </div>
          </div>

          <div class="col-12 col-md-8 d-flex flex-column justify-content-between" style="min-height: 180px;">

            <div class="card-body text-start">
              <div class="mt-5">
                <strong>Nama:</strong>
                <span class="ms-2">{{ $user->name }}</span>
              </div>

              <div class="mt-2">
                <strong>Pendapatan hari ini: Rp{{ number_format($total, 0, ',', '.') }} </strong>
              </div>
            </div>

            <div class="flex justify-end gap-3">
              <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                <a href="#">Edit</a>
              </button>

              <button class="button bg-body flex-center" title="Riwayat Data" onclick="toggleHistory()">
                <i class="bi bi-clock-history text-primary fs-4"></i>
              </button>

            </div>

          </div>

        </div>

      </div>

    </div>
  </div>


  <div id="historyWrapper" class="mt-8 hidden">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <table class="w-full text-left">

        <thead class="bg-teal-500">
          <tr>
            <th class="px-4 py-2 text-center">Tanggal</th>
            <th class="px-4 py-2 text-center">Total Pendapatan</th>
            <th class="px-4 py-2 text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @foreach($history7days as $h)
          <tr class="border-b">
            <td class="px-4 py-2 text-center">{{ $h->date }}</td>
            <td class="px-4 py-2 text-center">Rp{{ number_format($h->total_income) }}</td>
            <td class="px-4 py-2 text-center">
              <button
                onclick="openModal('{{ $h->date }}')"
                class="bg-teal-600 text-white px-3 py-1 rounded">
                <i class="bi bi-menu-up"></i>
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>

  <div id="modalPendapatan" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-11/12 max-w-xl p-6 rounded-lg shadow-lg">

      <h3 class="text-lg font-bold mb-4" id="modalTitle">Detail Pendapatan</h3>

      <div id="modalContent">
      </div>

      <button onclick="closeModal()" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">
        Tutup
      </button>
    </div>
  </div>

  <script>
    const fileInput = document.querySelector('input[type="file"]');
    const changeLink = document.querySelector('label a');
    const profileImgs = document.querySelectorAll('img[alt="UserProfile"]');


    changeLink.addEventListener('click', (e) => {
      e.preventDefault();
      fileInput.click();
    });


    fileInput.addEventListener('change', (e) => {
      const file = e.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = (event) => {
        const imageData = event.target.result;


        profileImgs.forEach(img => img.src = imageData);


        localStorage.setItem('userProfileImage', imageData);
      };
      reader.readAsDataURL(file);
    });


    window.addEventListener('load', () => {
      const savedImage = localStorage.getItem('userProfileImage');

      if (savedImage) {
        profileImgs.forEach(img => img.src = savedImage);
      }
    });

    function openModal(date) {
      fetch(`/pendapatan-detail/${date}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('modalTitle').innerText = "Pendapatan tanggal " + date;


          let html = `
        <div class="max-h-72 overflow-y-auto border rounded"> 
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-200 sticky top-0">
                        <th class="px-3 py-2">Transaksi ID</th>
                        <th class="px-3 py-2">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
      `;

          data.forEach(item => {
            html += `
            <tr class="border-b">
                <td class="px-3 py-2">${item.transaction_id}</td>
                <td class="px-3 py-2">Rp${Number(item.income).toLocaleString()}</td>
            </tr>
        `;
          });

          html += `
                </tbody>
            </table>
        </div>
      `;

          document.getElementById('modalContent').innerHTML = html;
          document.getElementById('modalPendapatan').classList.remove('hidden');
          document.getElementById('modalPendapatan').classList.add('flex');
        });
    }


    function closeModal() {
      document.getElementById('modalPendapatan').classList.add('hidden');
      document.getElementById('modalPendapatan').classList.remove('flex');
    }

    function toggleHistory() {
      const box = document.getElementById('historyWrapper');
      box.classList.toggle('hidden');
    }
  </script>

  <style>
    .button {
      cursor: pointer;
      text-decoration: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: white;
      border: 2px solid #2d2e32;
      transition: all 0.45s;
    }

    .button:hover {
      transform: rotate(360deg);
      transform-origin: center center;
      background-color: gray;
      color: #2d2e32;
    }

    .button:hover .btn-svg {
      filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(305deg) brightness(103%) contrast(103%);
    }

    .flex-center {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>



</x-layout>