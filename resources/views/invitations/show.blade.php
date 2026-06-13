@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Detail Undangan</h4>
            <div class="page-title-right">
                <a href="{{ route('invitations.index') }}" class="btn btn-secondary btn-sm"><i class="mdi mdi-arrow-left me-1"></i> Kembali</a>
                <a href="{{ route('invitations.edit', $invitation->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-pencil me-1"></i> Edit</a>
            </div>
        </div>
    </div>
</div>

<!-- Invitation Info -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    @if($invitation->cover_image)
                        <img src="{{ asset('storage/' . $invitation->cover_image) }}" alt="Cover" class="rounded me-3" style="width:120px; height:120px; object-fit:cover;">
                    @endif
                    <div class="flex-grow-1">
                        <h4 class="mb-1">{{ $invitation->title }}</h4>
                        <p class="text-muted mb-2">
                            <span class="badge bg-info">{{ $invitation->eventType->name ?? '-' }}</span>
                            <span class="badge bg-primary">{{ $invitation->template->name ?? '-' }}</span>
                            @if($invitation->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($invitation->status === 'expired')
                                <span class="badge bg-secondary">Expired</span>
                            @else
                                <span class="badge bg-warning text-dark">Draft</span>
                            @endif
                        </p>
                        <p class="mb-1"><i class="mdi mdi-calendar me-1"></i> {{ $invitation->event_date->format('d M Y') }} — {{ \Carbon\Carbon::parse($invitation->event_time)->format('H:i') }} WIB</p>
                        <p class="mb-1"><i class="mdi mdi-map-marker me-1"></i> {{ $invitation->location }}</p>
                        @if($invitation->address)
                            <p class="text-muted mb-1">{{ $invitation->address }}</p>
                        @endif
                        @if($invitation->google_maps_url)
                            <a href="{{ $invitation->google_maps_url }}" target="_blank" class="text-primary"><i class="mdi mdi-google-maps me-1"></i> Buka di Google Maps</a>
                        @endif
                    </div>
                </div>
                @if($invitation->description)
                    <hr>
                    <p class="mb-0">{{ $invitation->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Ringkasan</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total RSVP</span>
                    <span class="badge bg-primary rounded-pill">{{ $invitation->rsvps->count() }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Hadir</span>
                    <span class="badge bg-success rounded-pill">{{ $invitation->rsvps->where('attendance_status', 'Hadir')->count() }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tidak Hadir</span>
                    <span class="badge bg-danger rounded-pill">{{ $invitation->rsvps->where('attendance_status', 'Tidak Hadir')->count() }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Masih Ragu</span>
                    <span class="badge bg-warning rounded-pill">{{ $invitation->rsvps->where('attendance_status', 'Masih Ragu')->count() }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Tamu</span>
                    <span class="fw-bold">{{ $invitation->rsvps->sum('guest_count') }} orang</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Guest Book</span>
                    <span class="badge bg-info rounded-pill">{{ $invitation->guestBooks->count() }} pesan</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Galeri</span>
                    <span class="badge bg-secondary rounded-pill">{{ $invitation->galleries->count() }} foto</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabs: Gallery, Story, RSVP, Guest Book -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#guests" role="tab">
                            <i class="mdi mdi-account-group me-1"></i> Daftar Tamu ({{ $invitation->guests->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#gallery" role="tab">
                            <i class="mdi mdi-image-multiple me-1"></i> Galeri ({{ $invitation->galleries->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#stories" role="tab">
                            <i class="mdi mdi-book-open-variant me-1"></i> Story ({{ $invitation->stories->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#rsvp" role="tab">
                            <i class="mdi mdi-account-check me-1"></i> RSVP ({{ $invitation->rsvps->count() }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#guestbook" role="tab">
                            <i class="mdi mdi-message-text me-1"></i> Guest Book ({{ $invitation->guestBooks->count() }})
                        </a>
                    </li>
                </ul>

                <div class="tab-content p-3">
                    <!-- Gallery Tab -->
                    <div class="tab-pane" id="gallery" role="tabpanel">
                        @if($invitation->galleries->count() > 0)
                            <div class="row">
                                @foreach($invitation->galleries as $gallery)
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery" class="img-fluid rounded">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-image-off font-size-24"></i>
                                <p class="mt-2">Belum ada foto di galeri.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Stories Tab -->
                    <div class="tab-pane" id="stories" role="tabpanel">
                        @if($invitation->stories->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invitation->stories as $story)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $story->title }}</td>
                                            <td>{{ $story->event_date->format('d M Y') }}</td>
                                            <td>{{ $story->description }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-book-off font-size-24"></i>
                                <p class="mt-2">Belum ada story / timeline.</p>
                            </div>
                        @endif
                    </div>

                    <!-- RSVP Tab -->
                    <div class="tab-pane" id="rsvp" role="tabpanel">
                        @if($invitation->rsvps->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tamu</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th>Jumlah</th>
                                            <th>Pesan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invitation->rsvps as $rsvp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rsvp->guest_name }}</td>
                                            <td>{{ $rsvp->phone ?? '-' }}</td>
                                            <td>
                                                @if($rsvp->attendance_status === 'Hadir')
                                                    <span class="badge bg-success">{{ $rsvp->attendance_status }}</span>
                                                @elseif($rsvp->attendance_status === 'Tidak Hadir')
                                                    <span class="badge bg-danger">{{ $rsvp->attendance_status }}</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">{{ $rsvp->attendance_status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $rsvp->guest_count }}</td>
                                            <td>{{ $rsvp->message ?? '-' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-account-off font-size-24"></i>
                                <p class="mt-2">Belum ada RSVP yang masuk.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Guest Book Tab -->
                    <div class="tab-pane" id="guestbook" role="tabpanel">
                        @if($invitation->guestBooks->count() > 0)
                            @foreach($invitation->guestBooks as $book)
                                <div class="d-flex border-bottom py-3">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                {{ strtoupper(substr($book->guest_name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $book->guest_name }}</h6>
                                        <p class="text-muted mb-1">{{ $book->message }}</p>
                                        <small class="text-muted">{{ $book->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-message-off font-size-24"></i>
                                <p class="mt-2">Belum ada pesan di buku tamu.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Guests List Tab -->
                    <div class="tab-pane active" id="guests" role="tabpanel">
                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Tambah Tamu Undangan</h5>
                                <form action="{{ route('guests.store', $invitation->id) }}" method="POST">
                                    @csrf
                                    <div class="row gx-2 gy-2 align-items-end">
                                        <div class="col-md-4">
                                            <label class="form-label mb-1">Nama Tamu <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Susanto" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1">Grup / Kategori</label>
                                            <input type="text" name="group" class="form-control" placeholder="Contoh: VIP / Teman Kantor">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label mb-1">No. WhatsApp</label>
                                            <input type="text" name="phone" class="form-control" placeholder="62812345678">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary w-100"><i class="mdi mdi-plus"></i> Tambah</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if($invitation->guests->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Tamu</th>
                                            <th>Grup</th>
                                            <th>No. WA</th>
                                            <th width="10%">Status</th>
                                            <th width="25%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invitation->guests as $guest)
                                        @php
                                            $link = url('/' . $invitation->slug . '?kpd=' . urlencode($guest->name) . ($guest->group ? '&group=' . urlencode($guest->group) : ''));
                                            $waText = "Halo {$guest->name},\n\nKami mengundang Bapak/Ibu/Saudara/i untuk hadir di acara pernikahan kami.\n\nBerikut link undangan untuk Anda:\n{$link}\n\nTerima kasih.";
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $guest->name }}</td>
                                            <td>{{ $guest->group ?? '-' }}</td>
                                            <td>{{ $guest->phone ?? '-' }}</td>
                                            <td>
                                                @if($guest->is_sent)
                                                    <span class="badge bg-success">Terkirim</span>
                                                @else
                                                    <span class="badge bg-secondary">Belum Dikirim</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary" title="Copy Link" onclick="copyToClipboard('{{ $link }}')">
                                                        <i class="mdi mdi-content-copy"></i>
                                                    </button>
                                                    <a href="https://api.whatsapp.com/send?phone={{ $guest->phone }}&text={{ urlencode($waText) }}" target="_blank" class="btn btn-sm btn-success" title="Kirim WA" onclick="markAsSent({{ $guest->id }})">
                                                        <i class="mdi mdi-whatsapp"></i> WA
                                                    </a>
                                                    <form id="form-sent-{{ $guest->id }}" action="{{ route('guests.sent', $guest->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                    
                                                    <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" onsubmit="return confirm('Hapus tamu ini?')" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="mdi mdi-trash-can"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <script>
                                function copyToClipboard(text) {
                                    navigator.clipboard.writeText(text).then(function() {
                                        alert('Link disalin ke clipboard!');
                                    });
                                }
                                function markAsSent(id) {
                                    setTimeout(() => {
                                        document.getElementById('form-sent-' + id).submit();
                                    }, 1000);
                                }
                            </script>
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="mdi mdi-account-group-outline font-size-24"></i>
                                <p class="mt-2">Belum ada daftar tamu yang ditambahkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
