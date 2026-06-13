@extends('layouts.app')

@push('styles')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Users / Customers</h4>
            <div class="page-title-right">
                <a href="{{ route('master.users.create') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus me-1"></i> Tambah User</a>
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
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Paket Aktif</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone ?? '-' }}</td>
                            <td>
                                @if($item->role === 'Owner')
                                    <span class="badge bg-primary">{{ $item->role }}</span>
                                @elseif($item->role === 'Admin')
                                    <span class="badge bg-info">{{ $item->role }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->role }}</span>
                                @endif
                            </td>
                            <td>
                                @if($item->role === 'Customer')
                                    @php
                                        $activeSub = $item->subscriptions->first();
                                    @endphp
                                    @if($activeSub && $activeSub->package)
                                        <span class="badge bg-success">{{ $activeSub->package->name }}</span>
                                        <br><small title="Berlaku hingga">s.d {{ \Carbon\Carbon::parse($activeSub->end_date)->format('d M Y') }}</small>
                                    @else
                                        <span class="badge bg-secondary">Tidak Ada</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('master.users.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                
                                @if($item->role === 'Customer')
                                <a href="{{ route('invitations.create', ['user_id' => $item->id]) }}" class="btn btn-sm btn-success" title="Buatkan Undangan">
                                    <i class="mdi mdi-email-plus-outline"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#assignPackageModal{{ $item->id }}" title="Beri Paket">
                                    <i class="mdi mdi-crown"></i>
                                </button>
                                
                                <!-- Modal Assign Package -->
                                <div class="modal fade" id="assignPackageModal{{ $item->id }}" tabindex="-1" aria-labelledby="assignPackageModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('master.users.assign_package', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="assignPackageModalLabel{{ $item->id }}">Beri Paket Langganan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Pilih paket yang ingin diaktifkan untuk customer <strong>{{ $item->name }}</strong>.</p>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="package_id">Pilih Paket</label>
                                                        <select class="form-select" id="package_id" name="package_id" required>
                                                            <option value="" disabled selected>-- Pilih Paket --</option>
                                                            @foreach($packages as $pkg)
                                                                <option value="{{ $pkg->id }}">{{ $pkg->name }} (Rp {{ number_format($pkg->price, 0, ',', '.') }}) - {{ $pkg->duration_days }} Hari</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Aktifkan Paket</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if($item->id !== auth()->id())
                                <form action="{{ route('master.users.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can"></i></button>
                                </form>
                                @endif
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
