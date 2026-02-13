@extends('ppid::landing-page.app')

@section('title', 'Beranda - Regulasi')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Regulasi
            </h1>
            {{-- <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex eligendi exercitationem laboriosam ipsa quae
                repellendus, voluptates error velit, impedit officia ratione laudantium consequatur et optio est voluptate
                quod cum corporis.
            </p> --}}
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4" style="border-left-color: #004878;">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center"
                                style="background-color: #004878;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Total Informasi</p>
                            <p class="text-2xl font-bold" style="color: #004878;">{{ $datainformasi->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4" style="border-left-color: #f2b11a;">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center"
                                style="background-color: #f2b11a;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Terakhir Update</p>
                            <p class="text-lg font-bold" style="color: #004878;">
                                {{ $datainformasi->max('updated_at') ? \Carbon\Carbon::parse($datainformasi->max('updated_at'))->format('d M Y') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6 border-l-4" style="border-left-color: #28a745;">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-green-600 flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-600">Status</p>
                            <p class="text-lg font-bold text-green-600">Aktif</p>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Search and Filter Section -->
            {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Informasi</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" placeholder="Masukkan kata kunci..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="md:ml-4">
                        <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Jenis</label>
                        <select id="filter" name="filter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Jenis</option>
                            @foreach ($datainformasi->groupBy('nama_dokumen.nama_jenis') as $jenis => $items)
                                <option value="{{ $jenis }}">{{ $jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> --}}

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Table Header -->
    <div class="px-6 py-4 border-b border-gray-200" style="background-color: #004878;">
        <h2 class="text-xl font-semibold text-white">Daftar Regulasi</h2>
    </div>

    <!-- Table Content -->
            <div class="overflow-x-auto">
                <div class="min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Informasi
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tahun
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                            @forelse($dataDokumen as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200"
                                    data-jenis="{{ $item->nama_dokumen->nama_jenis ?? '' }}"
                                    data-nama="{{ strtolower($item->nama_dokumen) }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $item->nama_dokumen }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{-- Ambil kolom tahun dari database, misal field "tahun" --}}
                                        {{ $item->tahun ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        @if ($item->file_path && file_exists(public_path('storage/' . $item->file_path)))
                                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white transition-colors duration-200 hover:opacity-90"
                                                style="background-color: #004878;">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Unduh PDF
                                            </a>
                                        @else
                                            <span
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 rounded-md">
                                                Tidak Tersedia
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <p class="text-gray-500 text-lg font-medium">Tidak ada data informasi</p>
                                            <p class="text-gray-400 text-sm mt-1">Data informasi akan ditampilkan di sini
                                                ketika tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Information Note -->
            {{-- <div class="mt-8 bg-blue-50 border-l-4 p-4 rounded-r-lg" style="border-left-color: #004878;">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5" style="color: #004878;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm" style="color: #004878;">
                            <strong>Catatan:</strong> Informasi yang tersedia dapat diakses setiap saat sesuai dengan
                            ketentuan peraturan perundang-undangan.
                            Jika mengalami kesulitan dalam mengakses informasi, silakan hubungi PPID Politeknik Negeri
                            Banyuwangi.
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- JavaScript for Search and Filter -->
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const searchInput = document.getElementById('search');
        //     const filterSelect = document.getElementById('filter');
        //     const tableBody = document.getElementById('table-body');
        //     const showingCount = document.getElementById('showing-count');
        //     const rows = tableBody.querySelectorAll('tr[data-jenis]');

        //     function filterTable() {
        //         const searchTerm = searchInput.value.toLowerCase();
        //         const filterValue = filterSelect.value;
        //         let visibleCount = 0;

        //         rows.forEach(row => {
        //             const nama = row.getAttribute('data-nama');
        //             const jenis = row.getAttribute('data-jenis');

        //             const matchesSearch = nama.includes(searchTerm);
        //             const matchesFilter = !filterValue || jenis === filterValue;

        //             if (matchesSearch && matchesFilter) {
        //                 row.style.display = '';
        //                 visibleCount++;
        //             } else {
        //                 row.style.display = 'none';
        //             }
        //         });

        //         showingCount.textContent = visibleCount;
        //     }

        //     searchInput.addEventListener('input', filterTable);
        //     filterSelect.addEventListener('change', filterTable);
        // });
    </script>

    <style>
        :root {
            --primary-blue: #004878;
            --accent-yellow: #f2b11a;
        }
    </style>
@endsection
