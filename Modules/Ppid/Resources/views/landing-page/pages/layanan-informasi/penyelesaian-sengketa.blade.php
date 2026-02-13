@extends('ppid::landing-page.app')

@section('title', 'Beranda - Prosedur Pengajuan Penyelesaian Sengketa')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Prosedur Pengajuan Penyelesaian Sengketa
            </h1>
            {{-- <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus distinctio, autem qui doloribus vel nobis
                quidem, neque, illum quam officiis omnis voluptatibus voluptatem numquam quae laborum explicabo impedit
                deleniti eaque.
            </p> --}}
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Statistics Card -->
            {{-- <div class="bg-white rounded-lg shadow-md p-6 mb-8 border-l-4" style="border-left-color: #004878;">
                <div class="flex items-center justify-between">
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
                            <h3 class="text-lg font-semibold" style="color: #004878;">Total Dokumen Maklumat</h3>
                            <p class="text-3xl font-bold" style="color: #004878;">{{ $dataDokumen->count() }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Terakhir Update</p>
                        <p class="text-lg font-semibold" style="color: #004878;">
                            {{ $dataDokumen->max('updated_at') ? \Carbon\Carbon::parse($dataDokumen->max('updated_at'))->format('d M Y') : '-' }}
                        </p>
                    </div>
                </div>
            </div> --}}

            @forelse($dataDokumen as $index => $dokumen)
                <!-- Document Card -->
                <div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
                    <!-- Document Header -->
                    <div class="px-6 py-4 border-b border-gray-200" style="background-color: #004878;">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-xl font-semibold text-white">{{ $dokumen->nama_dokumen }}</h2>
                                <div class="flex items-center mt-2 space-x-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-white"
                                        style="background-color: #f2b11a;">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z">
                                            </path>
                                        </svg>
                                        {{ $dokumen->jenisDokumens->jenis_dokumen ?? 'Tidak Dikategorikan' }}
                                    </span>
                                    <span class="text-blue-100 text-sm">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V8a1 1 0 011-1h3z">
                                            </path>
                                        </svg>
                                        Tahun: {{ \Carbon\Carbon::parse($dokumen->tahun)->format('Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                @if ($dokumen->file_path && file_exists(public_path('storage/' . $dokumen->file_path)))
                                    <a href="{{ asset('storage/' . $dokumen->file_path) }}" download
                                        class="inline-flex items-center px-3 py-2 border border-white text-sm font-medium rounded-md text-white hover:bg-white hover:text-blue-900 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Unduh
                                    </a>
                                    <button onclick="toggleFullscreen('pdf-viewer-{{ $index }}')"
                                        class="inline-flex items-center px-3 py-2 border border-white text-sm font-medium rounded-md text-white hover:bg-white hover:text-blue-900 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 8V4a1 1 0 011-1h4M4 16v4a1 1 0 001 1h4m8-16h4a1 1 0 011 1v4m-4 12h4a1 1 0 001-1v-4">
                                            </path>
                                        </svg>
                                        Fullscreen
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- PDF Viewer -->
                    <div class="p-6">
                        @if ($dokumen->file_path && file_exists(public_path('storage/' . $dokumen->file_path)))
                            <div class="relative">
                                <div class="bg-gray-100 rounded-lg overflow-hidden" style="height: 600px;">
                                    <iframe id="pdf-viewer-{{ $index }}"
                                        src="{{ asset('storage/' . $dokumen->file_path) }}#toolbar=1&navpanes=1&scrollbar=1"
                                        class="w-full h-full border-0" type="application/pdf">
                                        <p class="p-4 text-center text-gray-600">
                                            Browser Anda tidak mendukung tampilan PDF.
                                            <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                Klik di sini untuk membuka PDF
                                            </a>
                                        </p>
                                    </iframe>
                                </div>

                                <!-- PDF Controls -->
                                <div class="mt-4 flex items-center justify-between bg-gray-50 px-4 py-2 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <span class="text-sm text-gray-600">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            {{ basename($dokumen->file_path) }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="printPDF('{{ asset('storage/' . $dokumen->file_path) }}')"
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium rounded text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                                </path>
                                            </svg>
                                            Print
                                        </button>
                                        <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium rounded text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                </path>
                                            </svg>
                                            Buka Tab Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">Dokumen tidak tersedia</p>
                                <p class="text-gray-400 text-sm mt-1">File dokumen tidak ditemukan atau belum diunggah</p>
                            </div>
                        @endif
                    </div>

                    <!-- Document Info Footer -->
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <span>Dokumen #{{ $index + 1 }}</span>
                            <span>Diperbarui:
                                {{ \Carbon\Carbon::parse($dokumen->updated_at)->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada dokumen Prosedur Pengajuan Penyelesaian
                        Sengketa</h3>
                    <p class="text-gray-500">Dokumen Prosedur Pengajuan Penyelesaian Sengketa akan ditampilkan di sini
                        ketika
                        tersedia.</p>
                </div>
            @endforelse

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
                            <strong>Catatan:</strong> Prosedur Pengajuan Penyelesaian Sengketa ini merupakan komitmen PPID Politeknik Negeri
                            Banyuwangi dalam memberikan pelayanan informasi publik yang berkualitas. Jika mengalami kendala
                            dalam mengakses dokumen, silakan hubungi petugas PPID.
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- JavaScript for PDF Controls -->
    <script>
        function toggleFullscreen(elementId) {
            const element = document.getElementById(elementId);
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        function printPDF(pdfUrl) {
            const printWindow = window.open(pdfUrl, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }

        // Handle PDF loading errors
        document.addEventListener('DOMContentLoaded', function() {
            const iframes = document.querySelectorAll('iframe[id^="pdf-viewer-"]');
            iframes.forEach(function(iframe) {
                iframe.onerror = function() {
                    const container = iframe.parentElement;
                    container.innerHTML = `
                <div class="flex items-center justify-center h-full bg-gray-100 rounded-lg">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <p class="text-gray-600 mb-2">Tidak dapat memuat PDF</p>
                        <a href="${iframe.src}" target="_blank" class="text-blue-600 hover:underline">Buka di tab baru</a>
                    </div>
                </div>
            `;
                };
            });
        });
    </script>

    <style>
        :root {
            --primary-blue: #004878;
            --accent-yellow: #f2b11a;
        }

        /* Custom scrollbar for PDF viewer */
        iframe::-webkit-scrollbar {
            width: 8px;
        }

        iframe::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        iframe::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        iframe::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endsection
