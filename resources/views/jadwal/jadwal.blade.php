@extends("layouts.app")

@section("main")
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Pembuatan Jadwal</h4>

            <form action="#" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Pilih kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="">-- Pilih kategori --</option>
                        <option value="Posyandu">Posyandu</option>
                        <option value="Pemeriksaan">Pemeriksaan</option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control">
                    </div>
                    <div class="col">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control">
                    </div>
                    <div class="col">
                        <label for="tanggal" class="form-label">Hari & Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="#" class="btn btn-outline-dark text-black bg-white border-black">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
