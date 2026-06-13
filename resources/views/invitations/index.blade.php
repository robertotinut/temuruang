@extends('layouts.app')

@push('styles')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">
                @if(Auth::user()->isOwner() || Auth::user()->isAdmin())
                    Kelola Undangan
                @else
                    Undangan Saya
                @endif
            </h4>
            <div class="page-title-right">
                <a href="{{ route('invitations.create') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus me-1"></i> Buat Undangan</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Judul</th>
                            <th>Event Type</th>
                            @if(Auth::user()->isOwner() || Auth::user()->isAdmin())
                            <th>Customer</th>
                            @endif
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invitations as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->cover_image)
                                    <img src="{{ asset('storage/' . $item->cover_image) }}" alt="{{ $item->title }}" class="rounded avatar-sm">
                                @else
                                    <span class="badge bg-light text-muted">No Cover</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                                <br><small class="text-muted">{{ $item->slug }}</small>
                                <br>
                                @if($item->custom_view_path)
                                    <span class="badge bg-primary-subtle text-primary"><i class="mdi mdi-folder-star"></i> {{ $item->custom_view_path }}</span>
                                @elseif($item->template)
                                    <span class="badge bg-light text-dark"><i class="mdi mdi-application"></i> {{ $item->template->name }}</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger"><i class="mdi mdi-alert-circle-outline"></i> Belum Set Template</span>
                                @endif
                            </td>
                            <td>{{ $item->eventType->name ?? '-' }}</td>
                            @if(Auth::user()->isOwner() || Auth::user()->isAdmin())
                            <td>{{ $item->user->name ?? '-' }}</td>
                            @endif
                            <td>{{ $item->event_date->format('d M Y') }}</td>
                            <td>{{ Str::limit($item->location, 25) }}</td>
                            <td>
                                @if($item->status === 'published')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($item->status === 'expired')
                                    <span class="badge bg-secondary">Expired</span>
                                @else
                                    <span class="badge bg-warning text-dark">Proses Admin</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('invitation.public', $item->slug) }}" target="_blank" class="btn btn-sm btn-dark" title="Lihat Web Undangan"><i class="mdi mdi-web"></i></a>

                                    @if($item->status === 'published' || Auth::user()->isAdmin() || Auth::user()->isOwner())
                                        <a href="{{ route('invitations.show', $item->id) }}" class="btn btn-sm btn-primary" title="Detail / Kelola Tamu"><i class="mdi mdi-eye"></i></a>
                                    @else
                                        <button class="btn btn-sm btn-secondary" title="Menunggu Admin" disabled><i class="mdi mdi-eye-off"></i></button>
                                    @endif

                                    @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
                                        <a href="{{ route('invitations.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                        @if($item->status === 'draft')
                                        <form action="{{ route('invitations.publish', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Publikasikan undangan ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success" title="Publish"><i class="mdi mdi-send"></i></button>
                                        </form>
                                        @endif
                                        <form action="{{ route('invitations.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus undangan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>
@endpush
