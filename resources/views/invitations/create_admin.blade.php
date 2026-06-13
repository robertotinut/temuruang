@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Buat Undangan Baru</h4>
            <div class="page-title-right">
                <a href="{{ route('invitations.index') }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Informasi Undangan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('invitations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Pilih Customer <span class="text-danger">*</span></label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">-- Pilih Customer --</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('user_id', request('user_id')) == $customer->id ? 'selected' : '' }}>{{ $customer->name }} ({{ $customer->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Undangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Pernikahan Andi & Sari" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="event_type_id" class="form-label">Tipe Event <span class="text-danger">*</span></label>
                                <select class="form-select @error('event_type_id') is-invalid @enderror" id="event_type_id" name="event_type_id" required>
                                    <option value="">-- Pilih Tipe Event --</option>
                                    @foreach($eventTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('event_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @error('event_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="template_id" class="form-label">Template Standar (Bawaan)</label>
                                <select class="form-select @error('template_id') is-invalid @enderror" id="template_id" name="template_id">
                                    <option value="">-- Pilih Template --</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                    @endforeach
                                </select>
                                @error('template_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="custom_view_path" class="form-label text-primary"><i class="mdi mdi-folder-star"></i> Template Custom (forcustomer)</label>
                                <select class="form-select @error('custom_view_path') is-invalid @enderror" id="custom_view_path" name="custom_view_path">
                                    <option value="">-- Tidak Pakai Custom --</option>
                                    @foreach($customFiles as $customFile)
                                        <option value="{{ $customFile }}" {{ old('custom_view_path') == $customFile ? 'selected' : '' }}>{{ $customFile }}.blade.php</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Jika diisi, template standar diabaikan.</small>
                                @error('custom_view_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="event_date" class="form-label">Tanggal Event <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" value="{{ old('event_date') }}" required>
                                @error('event_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="event_time" class="form-label">Waktu Event <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('event_time') is-invalid @enderror" id="event_time" name="event_time" value="{{ old('event_time') }}" required>
                                @error('event_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Lokasi / Venue <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Gedung Graha Sativa" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="Jl. Raya No.123, Kota...">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="google_maps_url" class="form-label">Link Google Maps</label>
                        <input type="url" class="form-control @error('google_maps_url') is-invalid @enderror" id="google_maps_url" name="google_maps_url" value="{{ old('google_maps_url') }}" placeholder="https://goo.gl/maps/...">
                        @error('google_maps_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi / Pesan Undangan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Tulis pesan sambutan untuk para tamu...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md"><i class="mdi mdi-content-save me-1"></i> Simpan sebagai Draft</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0"><i class="mdi mdi-information-outline me-1"></i> Panduan</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="mdi mdi-check-circle text-success me-1"></i> Undangan akan disimpan sebagai <strong>Draft</strong>.</li>
                    <li class="mb-2"><i class="mdi mdi-check-circle text-success me-1"></i> Anda bisa menambahkan <strong>Galeri</strong> dan <strong>Story</strong> setelah undangan dibuat.</li>
                    <li class="mb-2"><i class="mdi mdi-check-circle text-success me-1"></i> Klik <strong>Publish</strong> ketika undangan siap untuk dikirim.</li>
                    <li class="mb-2"><i class="mdi mdi-check-circle text-success me-1"></i> Link undangan unik akan otomatis di-generate.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
