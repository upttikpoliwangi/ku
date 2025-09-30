@extends('ppid::landing-page.app')

@section('title', 'Profil - Profil PPID')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Profil PPID
            </h1>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="text-left max-w-3xl mx-auto mb-12">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 text-center">Profil PPID</h4>
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $profil->ppid !!}
            </div>
        </div>

        <!-- Struktur Organisasi -->
        <div class="text-left max-w-3xl mx-auto mb-12">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 text-center">Struktur Organisasi</h4>

            @php
                $link = $profil->foto_organisasi;

                // cek apakah link YouTube
                if ($link) {
                    if (Str::contains($link, 'youtube.com/watch?v=')) {
                        $link = str_replace('watch?v=', 'embed/', $link);
                    } elseif (Str::contains($link, 'youtu.be/')) {
                        $link = str_replace('youtu.be/', 'youtube.com/embed/', $link);
                    }
                }

                // cek apakah link gambar
                $isImage = $link && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $link);
            @endphp

            @if ($link)
                @if ($isImage)
                    <img src="{{ $link }}" alt="Struktur Organisasi"
                        class="w-180 h-96 object-cover rounded-lg mx-auto shadow-lg">
                @else
                    <div class="w-full h-96 rounded-lg mx-auto shadow-lg">
                        <iframe width="100%" height="100%"
                                src="{{ $link }}"
                                frameborder="0" allowfullscreen>
                        </iframe>
                    </div>
                @endif
            @else
                <p class="text-center text-gray-500 italic">Belum ada media struktur organisasi.</p>
            @endif
        </div>

        <div class="text-left max-w-3xl mx-auto">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tugas & Fungsi</h4>
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                {!! $profil->tugas_fungsi !!}
            </div>
        </div>
    </section>
@endsection

