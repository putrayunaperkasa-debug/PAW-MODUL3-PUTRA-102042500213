@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Transaksi Peminjaman Buku</h3>
                <p class="text-muted small mb-0">Catat peminjaman buku oleh anggota perpustakaan.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    {{-- TODO:- Buat dropdown select 'anggota_id' untuk memilih anggota peminjam --}}
                    {{--      - Buat dropdown select 'buku_id' untuk memilih buku yang akan dipinjam --}}
                    {{--      - Buat input field 'tanggal_pinjam' bertipe date --}}
                    {{--      - Tampilkan pesan error validasi di bawah setiap input jika ada error (@error) --}}
                    {{--      - Buat tombol submit untuk menyimpan transaksi peminjaman --}}
                        <div class="mb-3">
                            <label class="form-label">Pilih Anggota *</label>
                            <select name="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror">
                                <option value="">-- Pilih Anggota Peminjam --</option>
                                @foreach ($anggota as $a)
                                    <option value="{{ $a->id }}" @selected(old('anggota_id') == $a->id)>{{ $a->nama }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pilih Buku *</label>
                            <select name="buku_id" class="form-select @error('buku_id') is-invalid @enderror">
                                <option value="">-- Pilih Buku yang Dipinjam --</option>
                                @foreach ($buku as $b)
                                    <option value="{{ $b->id }}" @selected(old('buku_id') == $b->id)>
                                        {{ $b->judul }} (stok: {{ $b->stok }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Hanya buku dengan stok > 0 yang muncul. Stok berkurang 1.</div>
                            @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Pinjam *</label>
                            <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                                class="form-control @error('tanggal_pinjam') is-invalid @enderror">
                            @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="text-end">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                        </div>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
