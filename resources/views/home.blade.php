<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Drone Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css" />
  <link rel="icon" type="image/png" href="..\assets\icon-ptpn.ico">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 fixed-top shadow">
    <span class="navbar-brand fw-bold">Drone Inventory</span>
    <div class="ms-auto">
    @if (session('is_logged_in'))
     <a href="{{ route('logout') }}" class="btn btn-link text-white text-decoration-none">LOGOUT <i class="bi bi-box-arrow-right"></i></a>
    @endif
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container" style="margin-top: 90px;">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
      <div>
        <h5 class="mb-0 fw-bold">TOTAL DRONE : <span>{{ $totalDrone }}</span></h5>
        <small class="text-muted">BAGUS: {{ $droneBagus }} &nbsp;&nbsp;&nbsp; RUSAK: {{ $droneRusak }}</small>
      </div>
    </div>

    <!-- Drone Cards -->
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row g-3">
    @foreach ($merks as $merk)
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <img src="{{ asset($merk->gambar) }}" class="card-img-top" alt="{{ $merk->nama_merk }}" />
          <div class="card-body">
            <h6 class="card-title">{{ $merk->nama_merk }}</h6>
            <p class="card-text mb-2">Jumlah stok: {{ $merk->drones_count }} </p>
            <a href="{{ route('drone.details', $merk->id) }}" class="btn btn-outline-primary btn-sm float-end"><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>


  <!-- Floating Add Button -->
  <a href="#" class="btn btn-primary rounded-circle shadow-lg add-button" data-bs-toggle="modal" data-bs-target="#addDroneModal">
  <i class="bi bi-plus fs-4 text-white"></i>
  </a>

<!-- Modal -->
<div class="modal fade" id="addDroneModal" tabindex="-1" aria-labelledby="addDroneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDroneModalLabel">Add New Merk Drone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('merk.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="droneName" class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" name="nama_merk" id="droneName" required>
          </div>
          <div class="mb-3">
            <label for="editGambar" class="form-label fw-bold">Unggah Gambar</label>
            <input type="file" class="form-control" name="gambar" id="editGambar" accept="image/*" required>
          </div>
          <div class="modal-footer p-0 pt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add Drone</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  // Setelah 3 detik, hilangkan alert dengan animasi
  setTimeout(function() {
    let alert = document.querySelector('.alert');
    if (alert) {
      // Mulai fade out
      alert.classList.remove('show');
      alert.classList.add('fade');
      // Hapus dari DOM setelah animasi selesai (300ms)
      setTimeout(() => alert.remove(), 300);
    }
  }, 3000); // 3000ms = 3 detik
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
