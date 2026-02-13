@extends('adminlte::page')
@section('title', 'Detail Menu - ' . $menu->title)
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Detail Menu: {{ $menu->title }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Judul:</strong> {{ $menu->title }}<br>
                        <strong>Tipe:</strong>
                        <span class="badge badge-primary">{{ $menu->type }}</span><br>
                        <strong>Status:</strong>
                        <span class="badge {{ $menu->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $menu->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Target:</strong><br>
                        @if ($menu->type == 'route')
                            <code>{{ $menu->route_name }}</code><br>
                            <small class="text-muted">URL: {{ $menu->actual_url }}</small>
                        @else
                            {{ $menu->url }}
                        @endif
                    </div>
                </div>

                @if ($menu->children->count() > 0)
                    <hr>
                    <h6>Submenus ({{ $menu->children->count() }})</h6>
                    <div class="table-responsive mt-3">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tipe</th>
                                    <th>Target</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menu->children as $child)
                                    <tr>
                                        <td>{{ $child->title }}</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $child->type }}</span>
                                        </td>
                                        <td>
                                            @if ($child->type == 'route')
                                                <code>{{ $child->route_name }}</code>
                                            @else
                                                {{ $child->url }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $child->is_active ? 'badge-success' : 'badge-danger' }}">
                                                {{ $child->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Menu
                    </a>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
