@extends('ppid::landing-page.app')

@section('title', 'Detail Pengumuman - PPID Poliwangi')

@section('content')
    <!-- Article Header Section -->
    <section class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-500">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-gray-700 transition-colors duration-200">
                            Beranda
                        </a>
                    </li>
                    <li>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li>
                        <a href="{{ route('publikasi.pengumuman.index') }}" class="hover:text-gray-700 transition-colors duration-200">
                            Pengumuman
                        </a>
                    </li>
                    <li>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                    <li class="text-gray-900 font-medium">Detail Pengumuman</li>
                </ol>
            </nav>


            <h1 class="text-xl md:text-2xl lg:text-3xl font-bold leading-tight mb-6" style="color: var(--primary-blue);">
                {{ $pengumuman->judul }}
            </h1>

            <!-- Date and Meta Info -->
            <div class="flex items-center text-gray-600 mb-8">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                @php
                    $date = \Carbon\Carbon::parse($pengumuman->created_at);
                    $dayNames = [
                        'Sunday' => 'Minggu',
                        'Monday' => 'Senin',
                        'Tuesday' => 'Selasa',
                        'Wednesday' => 'Rabu',
                        'Thursday' => 'Kamis',
                        'Friday' => 'Jumat',
                        'Saturday' => 'Sabtu',
                    ];
                    $monthNames = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ];
                    $dayName = $dayNames[$date->format('l')];
                    $monthName = $monthNames[$date->format('n')];
                    $formattedDate = $dayName . ', ' . $date->format('d') . ' ' . $monthName . ' ' . $date->format('Y');
                @endphp
                <span class="text-lg">{{ $formattedDate }}</span>
                <span class="mx-3">•</span>
                <span class="text-lg">PPID Poliwangi</span>
            </div>
        </div>
    </section>

    <!-- Yellow Divider Line -->
    {{-- <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-1 rounded-full mb-8" style="background-color: var(--primary-yellow);"></div>
    </div> --}}

    <!-- Main Image Section -->
    <section class="mb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                <img src="{{ asset('storage/' . $pengumuman->gambar) }}" alt="{{ $pengumuman->judul }}"
                    class="w-full h-96 md:h-[500px] lg:h-[600px] object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>
            <p class="text-sm text-gray-500 mt-4 text-center italic">
                {{$pengumuman->sumber}}
            </p>
        </div>
    </section>

    <!-- Article Content -->
    <section class="pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <div class="text-gray-800 leading-relaxed space-y-6 text-justify">
                    {!! $pengumuman->deskripsi !!}
                </div>
            </div>


            <!-- Article Footer -->
            {{-- <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <!-- Tags -->
                    <div class="mb-4 md:mb-0">
                        <span class="text-sm text-gray-600 mr-2">Tags:</span>
                        <span class="inline-block px-3 py-1 text-sm font-medium text-white rounded-full mr-2 mb-2"
                            style="background-color: var(--primary-blue);">
                            MoU
                        </span>
                        <span class="inline-block px-3 py-1 text-sm font-medium text-white rounded-full mr-2 mb-2"
                            style="background-color: var(--primary-blue);">
                            Kerjasama Internasional
                        </span>
                        <span class="inline-block px-3 py-1 text-sm font-medium text-white rounded-full mr-2 mb-2"
                            style="background-color: var(--primary-blue);">
                            Artificial Intelligence
                        </span>
                        <span class="inline-block px-3 py-1 text-sm font-medium text-white rounded-full mr-2 mb-2"
                            style="background-color: var(--primary-blue);">
                            Machine Learning
                        </span>
                    </div>

                    <!-- Share Buttons -->
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-600">Bagikan:</span>
                        <button class="p-2 text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-green-600 transition-colors duration-200">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div> --}}

            <!-- Navigation to Other Articles -->
            <div class="mt-16 pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                    <a href="{{ route('publikasi.pengumuman.index') }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-white rounded-lg transition-all duration-200 hover:shadow-lg transform hover:scale-105"
                        style="background-color: var(--primary-blue);">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Pengumuman
                    </a>

                    <div class="flex space-x-4">
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            ← Pengumuman Sebelumnya
                        </button>
                        <button
                            class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                            Pengumuman Selanjutnya →
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection