<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/akun.css') }}">
  <div class="garis bg-body min-h-screen flex items-center justify-center">
    <div class="w-full max-w-4xl">

      <div class="relative group overflow-hidden bg-amber-300 shadow-lg shadow-green-300 rounded-xl p-8 mx-auto border-3 border-black">

        <!-- SHIMMER -->
        <div class="shine absolute inset-0 -translate-x-full skew-x-12 bg-gradient-to-r from-transparent via-green-400/20 to-transparent transition-all duration-[1200ms] pointer-events-none"></div>

        <!-- GRADIENT OVERLAY -->
        <div class="absolute inset-0 bg-gradient-to-br from-green-400/5 to-green-300/10 opacity-0 group-hover:opacity-50 transition-opacity duration-700 pointer-events-none"></div>

        <!-- BUBBLE BOTTOM RIGHT -->
        <div class="absolute w-48 h-48 rounded-full bg-green-400/20 blur-3xl bottom-[-60px] right-[-60px] opacity-0 group-hover:opacity-70 transition-opacity duration-700 pointer-events-none"></div>

        <!-- BUBBLE TOP LEFT -->
        <div class="absolute w-32 h-32 rounded-full bg-green-400/10 blur-2xl top-[-30px] left-[-30px] opacity-0 group-hover:opacity-60 transition-opacity duration-700 pointer-events-none"></div>


        <div class="row g-0 align-items-center">

          <div class="col-12 col-md-4 d-flex justify-content-center p-3">

            <!-- From Uiverse.io by vinodjangid07 -->
            <div class="loader">
              <div class="panWrapper">
                <div class="pan">
                  <div class="food"></div>
                  <div class="panBase"></div>
                  <div class="panHandle"></div>
                </div>
                <div class="panShadow"></div>
              </div>
            </div>

          </div>

          <div class="col-12 col-md-8 d-flex flex-column justify-content-between" style="min-height: 180px;">

            <div class="card-body text-start">
              <div class="mt-5">
                <strong class="text-xl">Nama:</strong>
                <span class="ms-2 text-xl">{{ $user->name }}</span>
              </div>

              <div class="mt-2 text-xl">
                <strong>Pendapatan hari ini: Rp{{ number_format($total, 0, ',', '.') }} </strong>
              </div>
            </div>

            <div class="flex justify-end gap-3">

              <!-- <button class="button bg-body flex-center" title="Riwayat Data" onclick="toggleHistory()">
                <i class="bi bi-clock-history text-primary fs-4"></i>
              </button> -->

              <button class="Btn title=" Riwayat Data" onclick="toggleHistory()">

                <div class="sign"> <i class="bi bi-clock-history text-primary fs-4"></i></div>

                <div class="text text-primary">Riwayat data</div>
              </button>




            </div>

          </div>

        </div>

      </div>

    </div>
  </div>

  <style>
    .group:hover .shine {
      transform: translateX(200%);
    }
  </style>



  <div id="historyWrapper" class="mt-8 hidden">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <table class="w-full text-left">

        <thead class="bg-teal-500">
          <tr>
            <th class="px-4 py-2 text-center">Tanggal</th>
            <th class="px-4 py-2 text-center">Total Pendapatan</th>

          </tr>
        </thead>

        <tbody>
          @foreach($history7days as $h)
          <tr class="border-b">
            <td class="px-4 py-2 text-center">{{ $h->date }}</td>
            <td class="px-4 py-2 text-center">Rp{{ number_format($h->total_income) }}</td>

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

    function formatProductName(transaction) {
      if (!transaction) return "-";

      let items = [];

      // Coba decode product_name
      try {
        items = JSON.parse(transaction.product_name);
      } catch (e) {}

      // Kalau kosong → coba items
      if (!Array.isArray(items) || items.length === 0) {
        try {
          items = JSON.parse(transaction.items || '[]');
        } catch (e) {}
      }

      // Kalau array berisi
      if (Array.isArray(items) && items.length > 0) {
        return items.map(i => i.name).join(', ');
      }

      // fallback
      return transaction.product_name || "-";
    }



    function openModal(date) {
      fetch(`/pendapatan-detail/${date}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('modalTitle').innerText = "Pendapatan tanggal " + date;


          let html = `
        <div class="max-h-72 overflow-y-auto border rounded"> 
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-teal-200 sticky top-0">
                        <th class="px-3 py-2">Nama Produk</th>
                        <th class="px-3 py-2">Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
      `;

          data.forEach(item => {
            html += `
            <tr class="border-b">
                <td class="px-3 py-2">${item.product_names}</td>


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





</x-layout>