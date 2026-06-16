@extends('layouts.app')

@push('styles')
    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Master Templates</h4>
            <div class="page-title-right">
                <a href="{{ route('master.templates.create') }}" class="btn btn-primary btn-sm"><i class="mdi mdi-plus me-1"></i> Tambah Template</a>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->

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
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Kategori</th>
                            <th>Tema</th>
                            <th>Slug</th>
                            <th>Premium</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($templates as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->name }}" class="rounded avatar-sm">
                                @else
                                    <span class="badge bg-light text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->eventType ? $item->eventType->name : '-' }}</td>
                            <td>
                                @if($item->theme_category)
                                    <span class="badge bg-success bg-soft text-success">{{ $item->theme_category }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td><code>{{ $item->slug }}</code></td>
                            <td>
                                @if($item->is_premium)
                                    <span class="badge bg-warning">Premium</span>
                                @else
                                    <span class="badge bg-info">Free</span>
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
                                <a href="{{ route('templates.preview', $item->slug) }}" target="_blank" class="btn btn-sm btn-dark" title="Preview">
                                    <i class="mdi mdi-eye-outline"></i>
                                </a>
                                <a href="{{ route('master.templates.edit', $item->id) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                <form action="{{ route('master.templates.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus template ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="mdi mdi-trash-can"></i></button>
                                </form>
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
