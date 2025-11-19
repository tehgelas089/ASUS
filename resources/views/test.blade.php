<x-layout>
  <x-slot:title>{{$title}}</x-slot:title>

  <div class="container">
    <div class="row g-3">
      <!-- Card Input Warna -->
      <!-- <div class="col-12 col-lg-6">
        <div class="card h-100">
          <div class="row g-0">
            <div class="col-md-5 p-4 d-flex justify-content-center align-items-center">
              <h5 class="card-title fw-bold">Input Tema Warna</h5>
            </div>
            <div class="col p-3">
              <input id="primaryColor" type="text" class="form-control mb-2" placeholder="warna utama (contoh: #F72798)">
              <input id="secondaryColor" type="text" class="form-control" placeholder="warna sekunder">
            </div>
          </div>
        </div>
      </div> -->

      <!-- Preview Warna -->
      <div class="col-12 col-lg-6">
        <div class="card h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold">Preview Warna</h5>
            <input id="colorPicker" type="color" class="form-control form-control-color mb-3">
            <p id="text" class="text-muted" style="white-space: pre-line;">Pilih warna di atas untuk melihat efeknya.</p>
            <button id="saveColor" class="btn btn-primary mt-3 w-100" style="background-color: green;">Simpan & Terapkan</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
  </div>

  <script>
    const colorPicker = document.getElementById('colorPicker');
    const text = document.getElementById('text');
    const saveBtn = document.getElementById('saveColor');

    // realtime preview
    colorPicker.addEventListener('input', e => {
      text.style.color = e.target.value;
      text.textContent = `Preview warna: ${e.target.value}`;
    });

    // simpan warna ke sessionStorage & terapkan ke halaman target
    saveBtn.addEventListener('click', () => {
      const chosenColor = colorPicker.value;
      sessionStorage.setItem('themeColor', chosenColor);

      // update langsung jika halaman target terbuka di tab lain
      const colorElement = document.getElementById('color');
      if (colorElement) colorElement.style.backgroundColor = chosenColor;

      alert('Warna tema disimpan & diterapkan!');
    });
  </script>
</x-layout>