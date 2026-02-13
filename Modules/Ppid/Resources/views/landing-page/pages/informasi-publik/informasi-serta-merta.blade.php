@extends('ppid::landing-page.app')

@section('title', 'Beranda - Informasi Serta-Merta')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Informasi Serta-Merta
            </h1>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Informasi publik yang wajib diumumkan secara serta-merta oleh PPID Politeknik Negeri Banyuwangi
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Table Section -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Table Header -->
                <div class="px-6 py-4 border-b border-gray-200" style="background-color: #004878;">
                    <h2 class="text-xl font-semibold text-white">Daftar Informasi Serta-Merta</h2>
                </div>

                <!-- Table Content -->
                <div class="overflow-x-auto">
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
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                            @forelse($datainformasi as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200"
                                    data-jenis="{{ $item->jenisInformasi->nama_jenis ?? '' }}"
                                    data-nama="{{ strtolower($item->nama_informasi) }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $item->nama_informasi }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        @if ($item->link)
                                            <a href="{{ $item->link }}" target="_blank"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white transition-colors duration-200 hover:opacity-90"
                                                style="background-color: #004878;">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                Lihat Informasi
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
                                    <td colspan="3" class="px-6 py-12 text-center">
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
        </div>
    </section>

    <style>
        :root {
            --primary-blue: #004878;
            --accent-yellow: #f2b11a;
        }
    </style>
@endsection
