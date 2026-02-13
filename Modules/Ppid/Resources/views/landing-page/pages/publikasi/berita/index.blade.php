@extends('ppid::landing-page.app')

@section('title', 'Berita - PPID Poliwangi')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Berita PPID
            </h1>
            {{-- <p class="text-xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate fugit eius hic repellat est veniam
                perferendis sunt, placeat deserunt odit, dolorem, quibusdam aspernatur? Nam fuga labore molestias?
                Accusantium, vero! Officiis?
            </p> --}}
        </div>
    </section>

    <!-- News Grid Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (count($news) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($news as $newsItem)
                        <article
                            class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden cursor-pointer group"
                            onclick="window.location.href='{{ route('publikasi.berita.show', $newsItem->id) }}'">
                            <!-- Image Section -->
                            <div class="relative overflow-hidden">
                                @if ($newsItem->gambar)
                                    <img src="{{ asset('storage/' . $newsItem->gambar) }}"
                                        alt="{{ $newsItem->judul }}"class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500">No banner available</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content Section -->
                            <div class="p-6">
                                <!-- Title -->
                                <h3 class="text-lg font-semibold mb-3 leading-tight group-hover:text-blue-600 transition-colors duration-200"
                                    style="color: var(--primary-blue);">
                                    {{ $newsItem->judul }}
                                </h3>

                                <!-- Date -->
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    @php
                                        $date = \Carbon\Carbon::parse($newsItem->created_at);
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
                                        $formattedDate =
                                            $dayName .
                                            ', ' .
                                            $date->format('d') .
                                            ' ' .
                                            $monthName .
                                            ' ' .
                                            $date->format('Y');
                                    @endphp
                                    {{ $formattedDate }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full flex items-center justify-center text-gray-400"
                        style="background-color: #f3f4f6;">
                        <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Berita PPID akan segera hadir di halaman ini.</p>
                </div>
            @endif

            <!-- Pagination Section -->
            @if ($last_page > 1)
                <div class="mt-16 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <!-- Previous Button -->
                        @if ($current_page > 1)
                            <a href="{{ route('publikasi.berita.index') }}?page={{ $current_page - 1 }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                <svg class="h-4 w-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Sebelumnya
                            </a>
                        @else
                            <span
                                class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                <svg class="h-4 w-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Sebelumnya
                            </span>
                        @endif

                        <!-- Page Numbers -->
                        @php
                            $start = max(1, $current_page - 2);
                            $end = min($last_page, $current_page + 2);

                            // Adjust if we're near the beginning or end
                            if ($current_page <= 3) {
                                $end = min($last_page, 5);
                            }
                            if ($current_page > $last_page - 3) {
                                $start = max(1, $last_page - 4);
                            }
                        @endphp

                        <!-- First page if not in range -->
                        @if ($start > 1)
                            <a href="{{ route('publikasi.berita.index') }}?page=1"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                1
                            </a>
                            @if ($start > 2)
                                <span class="px-2 py-2 text-sm text-gray-500">...</span>
                            @endif
                        @endif

                        <!-- Page number range -->
                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $current_page)
                                <span class="px-4 py-2 text-sm font-medium text-white rounded-lg"
                                    style="background-color: var(--primary-blue);">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ route('publikasi.berita.index') }}?page={{ $i }}"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor

                        <!-- Last page if not in range -->
                        @if ($end < $last_page)
                            @if ($end < $last_page - 1)
                                <span class="px-2 py-2 text-sm text-gray-500">...</span>
                            @endif
                            <a href="{{ route('publikasi.berita.index') }}?page={{ $last_page }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                {{ $last_page }}
                            </a>
                        @endif

                        <!-- Next Button -->
                        @if ($current_page < $last_page)
                            <a href="{{ route('publikasi.berita.index') }}?page={{ $current_page + 1 }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                Selanjutnya
                                <svg class="h-4 w-4 ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @else
                            <span
                                class="px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                Selanjutnya
                                <svg class="h-4 w-4 ml-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        @endif
                    </nav>
                </div>

                <!-- Pagination Info -->
                <div class="mt-6 text-center">
                    @php
                        $start_item = ($current_page - 1) * $per_page + 1;
                        $end_item = min($current_page * $per_page, $total);
                    @endphp
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold">{{ $start_item }}-{{ $end_item }}</span>
                        dari <span class="font-semibold">{{ $total }}</span> berita
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
