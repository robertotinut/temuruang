@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Template</h4>
            <div class="page-title-right">
                <a href="{{ route('master.templates.index') }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('master.templates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="event_type_id" class="form-label">Kategori Acara (Event Type)</label>
                        <select class="form-select @error('event_type_id') is-invalid @enderror" id="event_type_id" name="event_type_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($eventTypes as $et)
                                <option value="{{ $et->id }}" {{ old('event_type_id') == $et->id ? 'selected' : '' }}>{{ $et->name }}</option>
                            @endforeach
                        </select>
                        @error('event_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3" id="theme_category_wrapper">
                        <label for="theme_category" class="form-label">Tema Desain (Khusus Pernikahan/Umum)</label>
                        <select class="form-select @error('theme_category') is-invalid @enderror" id="theme_category" name="theme_category">
                            <option value="">-- Pilih Tema Desain (Opsional) --</option>
                            <option value="Tradisional (Jawa, Sunda, dll)" {{ old('theme_category') == 'Tradisional (Jawa, Sunda, dll)' ? 'selected' : '' }}>Tradisional (Jawa, Sunda, dll)</option>
                            <option value="Modern & Elegan" {{ old('theme_category') == 'Modern & Elegan' ? 'selected' : '' }}>Modern & Elegan</option>
                            <option value="Minimalis & Klasik" {{ old('theme_category') == 'Minimalis & Klasik' ? 'selected' : '' }}>Minimalis & Klasik</option>
                            <option value="Rustic & Nature" {{ old('theme_category') == 'Rustic & Nature' ? 'selected' : '' }}>Rustic & Nature</option>
                            <option value="Vintage & Retro" {{ old('theme_category') == 'Vintage & Retro' ? 'selected' : '' }}>Vintage & Retro</option>
                            <option value="Religi / Islami" {{ old('theme_category') == 'Religi / Islami' ? 'selected' : '' }}>Religi / Islami</option>
                            <option value="Unik & Kreatif" {{ old('theme_category') == 'Unik & Kreatif' ? 'selected' : '' }}>Unik & Kreatif</option>
                        </select>
                        @error('theme_category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Template</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                                @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="preview_image" class="form-label">Preview Image</label>
                                <input type="file" class="form-control @error('preview_image') is-invalid @enderror" id="preview_image" name="preview_image" accept="image/*">
                                @error('preview_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 form-check form-switch form-switch-md" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="is_premium" name="is_premium" value="1" {{ old('is_premium') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_premium">Premium Template</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 form-check form-switch form-switch-md" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktif</label>
                            </div>
                        </div>
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
