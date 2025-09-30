@extends('adminlte::page')
@section('title', 'Menu Management')
@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Menu Management</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('admin.menus.create') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Tambah Menu
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-info">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Menu Item</th>
                                {{-- <th>Type</th> --}}
                                <th>Target</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach ($menus as $menu)
                                <!-- Parent Menu Row -->
                                <tr data-id="{{ $menu->id }}" data-parent="0" class="sortable-row parent-row">
                                    <td class="text-center">
                                        <i class="fas fa-arrows-alt handle" style="cursor: move;"></i>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <strong>
                                            <i class="fas fa-folder text-warning mr-2"></i>
                                            {{ $menu->title }}
                                        </strong>
                                        @if ($menu->children->count() > 0)
                                            <span class="badge badge-info ml-2">
                                                {{ $menu->children->count() }} submenu
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <span class="badge badge-primary">{{ $menu->type }}</span>
                                    </td> --}}
                                    <td>
                                        @if ($menu->type == 'route')
                                            <code>{{ $menu->route_name }}</code>
                                        @else
                                            {{ $menu->url }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">-</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $menu->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $menu->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="btn btn-warning"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Hapus menu ini beserta semua submenunya?')"
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            {{-- @if ($menu->has_children)
                                                <a href="{{ route('admin.menus.show', $menu->id) }}" class="btn btn-info"
                                                    title="View Submenus">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif --}}
                                        </div>
                                    </td>
                                </tr>

                                <!-- Children Rows -->
                                @foreach ($menu->children as $child)
                                    <tr data-id="{{ $child->id }}" data-parent="{{ $menu->id }}"
                                        class="sortable-row child-row">
                                        <td class="text-center">
                                            <i class="fas fa-arrows-alt handle ml-3" style="cursor: move;"></i>
                                        </td>
                                        <td>
                                            <span class="ml-4">
                                                <i class="fas fa-file text-secondary mr-2"></i>
                                                {{ $child->title }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <span class="badge badge-primary">{{ $child->type }}</span>
                                        </td> --}}
                                        <td>
                                            @if ($child->type == 'route')
                                                <code>{{ $child->route_name }}</code>
                                            @else
                                                {{ $child->url }}
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light">{{ $menu->title }}</span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $child->is_active ? 'badge-success' : 'badge-danger' }}">
                                                {{ $child->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.menus.edit', $child->id) }}"
                                                    class="btn btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.menus.destroy', $child->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Hapus submenu ini?')" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .sortable-row {
            cursor: move;
            transition: all 0.3s ease;
        }

        .handle {
            cursor: move;
            color: #6c757d;
            transition: color 0.2s ease;
        }

        .handle:hover {
            color: #007bff;
        }

        .parent-row {
            background-color: #f8f9fa !important;
            font-weight: 600;
        }

        .child-row {
            background-color: #ffffff !important;
        }

        .ui-sortable-helper {
            background-color: #e3f2fd !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .ui-sortable-placeholder {
            background-color: #e9ecef !important;
            border: 2px dashed #dee2e6;
            visibility: visible !important;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            let isDragging = false;

            $('#sortable').sortable({
                handle: '.handle',
                items: '.sortable-row',
                tolerance: 'pointer',
                cursor: 'move',
                opacity: 0.8,
                delay: 100, // Small delay to prevent accidental drags
                start: function(event, ui) {
                    isDragging = true;
                    ui.item.addClass('dragging');

                    if (ui.item.hasClass('child-row')) {
                        ui.item.data('original-parent', ui.item.data('parent'));
                    }
                },
                stop: function(event, ui) {
                    isDragging = false;
                    ui.item.removeClass('dragging');

                    // Update the order and parent relationships
                    updateMenuOrder();
                },
                change: function(event, ui) {
                    // Prevent invalid placements
                    handlePlacementValidation(ui);
                }
            }).disableSelection();

            function handlePlacementValidation(ui) {
                const placeholder = ui.placeholder;
                const draggedItem = ui.item;

                if (draggedItem.hasClass('parent-row')) {
                    // Parents can only be placed among parents
                    $('.child-row').addClass('no-drop');
                    placeholder.addClass('parent-placeholder');
                } else if (draggedItem.hasClass('child-row')) {
                    // Children can be placed among children or after parents
                    $('.parent-row').removeClass('no-drop');
                    placeholder.addClass('child-placeholder');
                }
            }

            function updateMenuOrder() {
                const menuData = [];
                let parentOrder = 1;
                let currentParentId = null;

                $('.sortable-row').each(function() {
                    const $row = $(this);
                    const isParent = $row.hasClass('parent-row');
                    const menuId = $row.data('id');

                    if (isParent) {
                        // This is a parent menu
                        currentParentId = menuId;
                        menuData.push({
                            id: menuId,
                            order: parentOrder,
                            parent_id: null
                        });
                        parentOrder++;

                        // Process its children
                        let childOrder = 1;
                        $row.nextUntil('.parent-row').each(function() {
                            if ($(this).hasClass('child-row')) {
                                menuData.push({
                                    id: $(this).data('id'),
                                    order: childOrder,
                                    parent_id: currentParentId
                                });
                                childOrder++;
                            }
                        });
                    }
                });

                // Send AJAX request to update order
                $.ajax({
                    url: '{{ route('admin.menus.reorder') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        menus: menuData
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update row numbers
                            updateRowNumbers();
                            showSuccessMessage('Menu order updated successfully');
                        }
                    },
                    error: function(xhr) {
                        showErrorMessage('Error updating menu order');
                        console.error('Error:', xhr.responseText);
                    }
                });
            }

            function updateRowNumbers() {
                let parentCount = 1;
                $('.parent-row').each(function() {
                    $(this).find('td:first').html(
                        '<i class="fas fa-arrows-alt handle" style="cursor: move;"></i> ' + parentCount
                    );
                    parentCount++;
                });
            }

            function showSuccessMessage(message) {
                // You can use toastr or a simple alert
                const $alert = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button></div>');

                $('.card-body').prepend($alert);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    $alert.alert('close');
                }, 3000);
            }

            function showErrorMessage(message) {
                const $alert = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button></div>');

                $('.card-body').prepend($alert);

                setTimeout(() => {
                    $alert.alert('close');
                }, 5000);
            }
        });
    </script>
@endpush
