<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Drone</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="details.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="..\assets\icon-ptpn.ico">
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
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

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
    <td><img src="{{ asset($drone->gambar) }}" class="img-thumbnail" width="100"></td>
    <td>{{ $drone->nama_drone }}</td>
    <td>{{ \Carbon\Carbon::parse($drone->tanggal_pengadaan)->translatedFormat('d F Y') }}</td>
    <td>{{ $drone->umur_tahun }} Tahun {{ $drone->umur_bulan }} Bulan</td>
    <td><button class="btn btn-sm btn-outline-secondary">Rp {{ number_format($drone->harga, 0, ',', '.') }}</button></td>
    <td>
    @if($drone->keterangan)
      <button class="btn btn-success btn-sm">Bagus</button>
    @else
      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetailRusak{{ $drone->id }}">Rusak</button>
    @endif
    </button>
  </td>
    <td>
      <div class="d-flex gap-1">
      <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditDrone{{ $drone->id }}"><i class="bi bi-pencil-square"></i></button>
      <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteDrone{{ $drone->id }}"><i class="bi bi-trash"></i></button>
      </div>
    </td>
  </tr>

  <!-- Modal Detail Rusak -->
<div class="modal fade" id="modalDetailRusak{{ $drone->id }}" tabindex="-1" aria-labelledby="modalDetailRusakLabel{{ $drone->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDetailRusakLabel{{ $drone->id }}">Detail Drone Rusak</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div class="mb-2">
          <label class="form-label fw-bold">Status</label>
          <input type="text" class="form-control text-danger fw-bold" value="Rusak" disabled>
        </div>

        <div class="mb-2">
          <label class="form-label fw-bold">Umur</label>
          <input type="text" class="form-control" value="{{ $drone->umur_tahun }} Tahun {{ $drone->umur_bulan }} Bulan" disabled>
        </div>

        <div class="mb-2">
          <label class="form-label fw-bold">Keterangan</label>
          <input type="text" class="form-control" value="{{ $drone->deskripsi_kerusakan ?? 'Tidak ada keterangan kerusakan.' }}" disabled>
        </div>
      </div>
    </div>
  </div>
</div>


  <!-- Modal Edit Drone -->
<div class="modal fade" id="modalEditDrone{{ $drone->id }}" tabindex="-1" aria-labelledby="modalEditDroneLabel{{ $drone->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header" style="background-color: #007bff; color: white;">
        <h5 class="modal-title" id="modalEditDroneLabel{{ $drone->id }}">Edit Drone</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('drone.update', $drone->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="hidden" name="merk_id" value="{{ $merk->id }}">
          <div class="mb-3">
            <label class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" name="nama_drone" value="{{ $drone->nama_drone }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Tanggal Pengadaan</label>
            <input type="date" class="form-control" name="tanggal_pengadaan" value="{{ $drone->tanggal_pengadaan }}">
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Harga</label>
            <input type="number" class="form-control" name="harga" value="{{ $drone->harga }}">
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <select class="form-select" name="keterangan" required>
              <option value="1" {{ $drone->keterangan == 1 ? 'selected' : '' }}>Bagus</option>
              <option value="0" {{ $drone->keterangan == 0 ? 'selected' : '' }}>Rusak</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Unggah Gambar Baru (Opsional)</label>
            <input type="file" class="form-control" name="gambar" accept="image/*">
            @if($drone->gambar)
              <small class="text-muted">Gambar sekarang: <a href="{{ asset($drone->gambar) }}" target="_blank">Lihat</a></small>
            @endif
          </div>
          <div class="mb-3">
          <label class="form-label fw-bold">Deskripsi Kerusakan (Opsional)</label>
          <textarea name="deskripsi_kerusakan" class="form-control" rows="3">{{ $drone->deskripsi_kerusakan }}</textarea>
          </div>
          <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-outline-primary me-2" data-bs-dismiss="modal"><strong>BATAL</strong></button>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete Drone -->
<div class="modal fade" id="modalDeleteDrone{{ $drone->id }}" tabindex="-1" aria-labelledby="modalDeleteDroneLabel{{ $drone->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modalDeleteDroneLabel{{ $drone->id }}">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <p>Apakah Anda yakin ingin menghapus <strong>{{ $drone->nama_drone }}</strong>?</p>
      </div>

      <div class="modal-footer d-flex justify-content-center">
        <form action="{{ route('drone.destroy', $drone->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

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
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
        <form action="{{ route('drone.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="merk_id" value="{{ $merk->id }}">
          
          <div class="mb-3">
            <label for="addNamaDrone" class="form-label fw-bold">Nama Drone</label>
            <input type="text" class="form-control" id="addNamaDrone" name="nama_drone" placeholder="Masukkan nama drone" required>
          </div>

          <div class="mb-3">
            <label for="addTanggalPengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
            <input type="date" class="form-control" id="addTanggalPengadaan" name="tanggal_pengadaan" required>
          </div>

          <div class="mb-3">
            <label for="addHarga" class="form-label fw-bold">Harga</label>
            <input type="number" class="form-control" id="addHarga" name="harga" placeholder="Masukkan harga" required>
          </div>

          <div class="mb-3">
            <label for="addStatus" class="form-label fw-bold">Status</label>
            <select class="form-select" id="addStatus" name="keterangan" required>
              <option selected disabled value="">Pilih Status</option>
              <option value="1">Bagus</option>
              <option value="0">Rusak</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="editGambar" class="form-label fw-bold">Unggah Gambar</label>
            <input type="file" class="form-control" id="editGambar" name="gambar" accept="image/*">
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-outline-danger me-2" data-bs-dismiss="modal"><strong>BATAL</strong></button>
            <button type="submit" class="btn btn-primary">TAMBAH</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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

</body>
</html>
