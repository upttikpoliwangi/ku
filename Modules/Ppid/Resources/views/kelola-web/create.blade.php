@extends('adminlte::page')
@section('title', isset($menu) ? 'Edit Menu' : 'Tambah Menu')
@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header {{ isset($menu) ? 'bg-warning' : 'bg-success' }} text-white">
                        <h5 class="mb-0">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu Baru' }}</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}"
                            method="POST">
                            @csrf
                            @if (isset($menu))
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="title">Judul Menu *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $menu->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="route-field">
                                <label for="route_name">Route Name</label>
                                <select class="form-control @error('route_name') is-invalid @enderror" id="route_name"
                                    name="route_name">
                                    <option value="">Pilih Route</option>
                                    @foreach ($availableRoutes as $route)
                                        <option value="{{ $route }}"
                                            {{ old('route_name', $menu->route_name ?? '') == $route ? 'selected' : '' }}>
                                            {{ $route }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('route_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Parent Menu</label>
                                <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                                    name="parent_id">
                                    <option value="">-- Tidak ada (Menu Utama) --</option>
                                    @foreach ($parentMenus as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}
                                            {{ isset($menu) && $menu->id == $parent->id ? 'disabled' : '' }}>
                                            {{ $parent->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                        value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Aktif</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    {{ isset($menu) ? 'Update Menu' : 'Simpan Menu' }}
                                </button>
                                <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const typeSelect = document.getElementById('type');
        //     const routeField = document.getElementById('route-field');
        //     const urlField = document.getElementById('url-field');

        //     function toggleFields() {
        //         const type = typeSelect.value;

        //         // routeField.style.display = type === 'route' ? 'block' : 'none';
        //         // urlField.style.display = (type === 'external' || type === 'static') ? 'block' : 'none';

        //         // // Set required attributes
        //         // document.getElementById('route_name').required = type === 'route';
        //         // document.getElementById('url').required = type === 'external' || type === 'static';
        //     }

        //     typeSelect.addEventListener('change', toggleFields);
        //     toggleFields(); // Initial call
        // });
    </script>
@endpush
