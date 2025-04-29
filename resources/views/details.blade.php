<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Drone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="details.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-primary px-4 fixed-top shadow">
  <span class="navbar-brand fw-bold">{{ $merk->nama_merk }}</span>
  <div class="ms-auto">
    <a href="{{ route('home') }}" class="btn text-white"><i class="bi bi-house-fill"></i></a>
  </div>
</nav>

<!-- Spacer untuk fixed navbar -->
<div style="margin-top: 70px;"></div>

<!-- Tabel Data -->
<div class="container mt-4">
  <div class="table-responsive">
    <table class="table align-middle table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Gambar</th>
          <th>Nama Drone</th>
          <th>Tanggal Pengadaan</th>
          <th>Umur</th>
          <th>Harga</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

  @foreach ($drones as $index => $drone)
  <tr>
    <td>{{ $index + 1 }}</td>
    <td><img src="{{ asset('storage/' . $drone->gambar) }}" class="img-thumbnail" width="100"></td>
    <td>{{ $drone->nama_drone }}</td>
    <td>{{ \Carbon\Carbon::parse($drone->tanggal_pengadaan)->translatedFormat('d F Y') }}</td>
    <td>{{ $drone->umur_tahun }} Tahun {{ $drone->umur_bulan }} Bulan</td>
    <td><button class="btn btn-sm btn-outline-secondary">Rp {{ number_format($drone->harga, 0, ',', '.') }}</button></td>
    <td>
    @if($drone->keterangan)
      <button class="btn btn-success btn-sm">Bagus</button>
    @else
      <button class="btn btn-danger btn-sm">Rusak</button>
    @endif
    </button>
  </td>
    <td>
      <div class="d-flex gap-1">
      <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditDrone"><i class="bi bi-pencil-square"></i></button>
      <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteDrone"><i class="bi bi-trash"></i></button>
      </div>
    </td>
  </tr>
@endforeach

    <!-- Modal Detail Rusak -->
<div class="modal fade" id="modalDetailRusak" tabindex="-1" aria-labelledby="modalDetailRusakLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailRusakLabel">DRONE 1 - B</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="../assets/drone-baling.jpeg" class="img-fluid rounded mb-3" style="max-height: 250px; object-fit: cover;">
        <div class="mb-2">
          <label class="form-label fw-bold">Status</label>
          <input type="text" class="form-control" value="Rusak" disabled>
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold">Umur</label>
          <input type="text" class="form-control" value="5 Tahun 7 Bulan" disabled>
        </div>
        <div class="mb-2">
          <label class="form-label fw-bold">Keterangan</label>
          <input type="text" class="form-control" value="Drone ini baling-balingnya patah" disabled>
        </div>
      </div>
    </div>
  </div>
</div>

  </div>
</div>

<!-- Modal Edit Drone -->
<div class="modal fade" id="modalEditDrone" tabindex="-1" aria-labelledby="modalEditDroneLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header" style="background-color: #007bff; color: white;">
        <h5 class="modal-title" id="modalEditDroneLabel">Edit Drone</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="editNamaDrone" class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" id="editNamaDrone">
          </div>
          <div class="mb-3">
            <label for="editTanggalPengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
            <input type="date" class="form-control" id="editTanggalPengadaan">
          </div>
          <div class="mb-3">
            <label for="editHarga" class="form-label fw-bold">Harga</label>
            <input type="text" class="form-control" id="editHarga">
          </div>
          <div class="mb-3">
            <label for="editStatus" class="form-label fw-bold">Status</label>
            <select class="form-select" id="editStatus">
              <option selected disabled>Pilih Status</option>
              <option value="Aktif">Bagus</option>
              <option value="Rusak">Rusak</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editCatatan" class="form-label fw-bold">Catatan</label>
            <textarea class="form-control" id="editCatatan" rows="2"></textarea>
          </div>
          <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal"><strong>CANCEL</strong></button>
            <button type="submit" class="btn btn-primary">SAVE</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Delete -->
<div class="modal fade" id="modalDeleteDrone" tabindex="-1" aria-labelledby="modalDeleteDroneLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDeleteDroneLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <p>Apakah Anda yakin ingin menghapus jenis drone ini?</p>
      </div>

      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger">Hapus</button>
      </div>

    </div>
  </div>
</div>

<!-- Floating Add Button -->
<button class="btn btn-primary rounded-circle position-fixed" 
  style="bottom: 20px; right: 20px; width: 60px; height: 60px;"
  data-bs-toggle="modal" data-bs-target="#modalAddDrone">
  <i class="bi bi-plus-lg fs-4"></i>
</button>

<!-- Modal Add Drone -->
<div class="modal fade" id="modalAddDrone" tabindex="-1" aria-labelledby="modalAddDroneLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalAddDroneLabel">Tambah Drone</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="addNamaDrone" class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" id="addNamaDrone" placeholder="Masukkan nama drone">
          </div>
          <div class="mb-3">
            <label for="addTanggalPengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
            <input type="date" class="form-control" id="addTanggalPengadaan">
          </div>
          <div class="mb-3">
            <label for="addHarga" class="form-label fw-bold">Harga</label>
            <input type="text" class="form-control" id="addHarga" placeholder="Masukkan harga">
          </div>
          <div class="mb-3">
            <label for="addStatus" class="form-label fw-bold">Status</label>
            <select class="form-select" id="addStatus">
              <option selected disabled>Pilih Status</option>
              <option value="Bagus">Bagus</option>
              <option value="Rusak">Rusak</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="addCatatan" class="form-label fw-bold">Unggah Gambar</label>
            <input type="file" class="form-control" id="editGambar" accept="image/*">
          </div>
          <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal"><strong>BATAL</strong></button>
            <button type="submit" class="btn btn-primary">TAMBAH</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
