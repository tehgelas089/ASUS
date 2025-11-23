<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <div class="garis bg-body min-h-screen flex items-center justify-center ">


    <div class="garis bg-body min-h-screen flex items-center justify-center">

      <div class="w-full max-w-4xl bg-white shadow-lg shadow-teal-900 rounded-xl p-8 mx-auto flex flex-col md:flex-row items-center md:items-start gap-8 border-3 border-black">

        <!-- Foto Profil -->
        <div class="flex flex-col items-center md:w-1/3">
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-4 border-gray-500">
            <img
              src="{{ asset($user->usr_card_url ?? '/logo/user_placeholder.jpg') }}"
              class="w-full h-full object-cover"
              alt="Foto Profil">
          </div>

          <label class="mt-3 text-sm font-medium cursor-pointer">
            <span class="text-indigo-600 hover:text-indigo-800">Ganti Foto</span>
            <input type="file" name="usr_card_url" id="fotoInput" class="hidden" accept="image/*" form="formEditAkun">
          </label>
        </div>

        <!-- Form Edit -->
        <form id="formEditAkun" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="md:w-2/3">
          @csrf
          @method('PUT')

          <!-- Input Nama -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengguna</label>
            <input
              type="text"
              name="name"
              value="{{ $user->name }}"
              class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
          </div>

          <!-- Input Password -->
          <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
              Password (kosongkan jika tidak ingin mengubah)
            </label>
            <input
              type="password"
              name="password"
              class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 outline-none">
          </div>

          <!-- Buttons -->
          <div class="flex justify-end gap-3 mt-4">
            <button
              type="button"
              onclick="history.back()"
              class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
              Batal
            </button>

            <button
              type="submit"
              class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
              Simpan
            </button>
          </div>
        </form>

      </div>
    </div>>

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

    <script>
      const fileInput = document.querySelector('input[type="file"]');
      const profileImg = document.querySelector('img[alt="Foto Profil"]');
      const changeLink = document.querySelector('label a');

      // Saat klik "Ganti Foto", buka input file
      changeLink.addEventListener('click', (e) => {
        e.preventDefault();
        fileInput.click();
      });

      // Saat ada file baru di-upload
      fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(event) {
            const imageData = event.target.result;
            profileImg.src = imageData;
            localStorage.setItem('savedProfileImage', imageData); // simpan ke localStorage
          };
          reader.readAsDataURL(file);
        }
      });

      // Saat halaman dimuat, tampilkan foto yang tersimpan
      window.addEventListener('load', () => {
        const savedImage = localStorage.getItem('savedProfileImage');
        if (savedImage) {
          profileImg.src = savedImage;
        }
      });
    </script>

  </div>
</x-layout>