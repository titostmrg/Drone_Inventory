<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Drone Inventory</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-4 fixed-top shadow">
    <span class="navbar-brand fw-bold">Drone Inventory</span>
    <div class="ms-auto">
     <a href="{{ route('login') }}" class="btn btn-link text-white text-decoration-none">LOGOUT <i class="bi bi-box-arrow-right"></i></a>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container" style="margin-top: 90px;">
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
      <div>
        <h5 class="mb-0 fw-bold">TOTAL DRONE : <span>20</span></h5>
        <small class="text-muted">BAGUS: 15 &nbsp;&nbsp;&nbsp; RUSAK: 5</small>
      </div>
      <div class="d-flex align-items-center">
        <label class="me-2">Cari</label>
        <input type="text" class="form-control form-control-sm" placeholder="Nama Drone" />
      </div>
    </div>

    <!-- Drone Cards -->
    
    <div class="row g-3">
    @foreach ($drones as $drone)
      <div class="col-6 col-md-3">
        <div class="card h-100">
          <img src="../assets/drone-bg.jpg" class="card-img-top" alt="Drone" />
          <div class="card-body">
            <h6 class="card-title">{{ $drone->nama_drone }}</h6>
            <p class="card-text mb-2">Jumlah stok: 5</p>
            <a href="{{ route('drones.show', $drone->merk->id) }}" class="btn btn-outline-primary btn-sm float-end"><i class="bi bi-arrow-right"></i></a>
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
        <h5 class="modal-title" id="addDroneModalLabel">Add New Drone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addDroneForm">
          <div class="mb-3">
            <label for="droneName" class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" id="droneName" required>
          </div>
          <div class="mb-3">
          <label for="addCatatan" class="form-label fw-bold">Unggah Gambar</label>
          <input type="file" class="form-control" id="editGambar" accept="image/*">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
