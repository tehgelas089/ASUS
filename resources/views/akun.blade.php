<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <div class="garis bg-body min-h-screen flex items-center justify-center ">


    <div class="w-full max-w-4xl bg-white shadow-lg shadow-teal-900 rounded-xl p-8 mx-auto border-3 border-black">

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


        <!-- INFORMASI USER -->
        <div class="col-12 col-md-8 d-flex flex-column justify-content-between" style="min-height: 180px;">

          <div class="card-body text-start">

            <div class="mt-5">
              <strong>Nama:</strong>
              <span class="ms-2">{{ $user->name }}</span>
            </div>

            <div class="mt-2">
              <strong>Pendapatan hari ini:</strong>
              <!-- <span class="ms-2">{{ $user->usr_no_wa }}</span> -->
            </div>

          </div>

          <!-- TOMBOL EDIT DI BAGIAN BAWAH -->
          <div class="flex justify-end gap-3">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Simpan</button>
          </div>

        </div>

      </div>

    </div>
    <script>
      const fileInput = document.querySelector('input[type="file"]');
      const changeLink = document.querySelector('label a');

      // Ambil semua foto user di halaman
      const profileImgs = document.querySelectorAll('img[alt="UserProfile"]');

      // Klik ganti foto
      changeLink.addEventListener('click', (e) => {
        e.preventDefault();
        fileInput.click();
      });

      // Upload + preview + simpan ke localStorage
      fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (event) => {
          const imageData = event.target.result;

          // Update semua foto di halaman
          profileImgs.forEach(img => img.src = imageData);

          // Simpan permanen
          localStorage.setItem('userProfileImage', imageData);
        };
        reader.readAsDataURL(file);
      });

      // Saat halaman loading
      window.addEventListener('load', () => {
        const savedImage = localStorage.getItem('userProfileImage');

        if (savedImage) {
          profileImgs.forEach(img => img.src = savedImage);
        }
      });
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

      /* From Uiverse.io by themrsami */
      /* .garis {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0000 18.75%, #7C3AED 0 31.25%, #0000 0),
          linear-gradient(45deg, #0000 18.75%, #7C3AED 0 31.25%, #0000 0),
          linear-gradient(135deg, #0000 18.75%, #7C3AED 0 31.25%, #0000 0),
          linear-gradient(45deg, #0000 18.75%, #7C3AED 0 31.25%, #0000 0);
        background-size: 60px 60px;
        background-position:
          0 0,
          0 0,
          30px 30px,
          30px 30px;
        animation: slide 4s linear infinite;
      }

      @keyframes slide {
        to {
          background-position:
            60px 0,
            60px 0,
            90px 30px,
            90px 30px;
        }
      } */
    </style>


  </div>
</x-layout>