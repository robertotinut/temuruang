@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Package</h4>
            <div class="page-title-right">
                <a href="{{ route('master.packages.index') }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('master.packages.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Package</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Harga (Rp)</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', 0) }}" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="max_guest" class="form-label">Max Guest</label>
                                <input type="number" class="form-control @error('max_guest') is-invalid @enderror" id="max_guest" name="max_guest" value="{{ old('max_guest') }}" min="0" placeholder="Kosongkan = Unlimited">
                                @error('max_guest')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="max_gallery" class="form-label">Max Gallery</label>
                                <input type="number" class="form-control @error('max_gallery') is-invalid @enderror" id="max_gallery" name="max_gallery" value="{{ old('max_gallery') }}" min="0" placeholder="Kosongkan = Unlimited">
                                @error('max_gallery')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="max_template" class="form-label">Max Template</label>
                                <input type="number" class="form-control @error('max_template') is-invalid @enderror" id="max_template" name="max_template" value="{{ old('max_template') }}" min="0" placeholder="Kosongkan = Unlimited">
                                @error('max_template')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-check form-switch form-switch-md" dir="ltr">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
