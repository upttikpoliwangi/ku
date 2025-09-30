@extends('ppid::landing-page.app')

@section('title', 'Profil - Sambutan Direktur')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Sambutan Direktur
            </h1>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            @php
                $link = $profil->media;

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

            <div class="mb-8">
                @if ($link)
                    @if ($isImage)
                        <img src="{{ $link }}" alt="Foto Direktur"
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
                    <p class="text-center text-gray-500 italic">Belum ada media sambutan direktur.</p>
                @endif

                <h2 class="text-sm md:text-md mt-4 italic font-bold text-gray-800">
                    {{ $profil->nama_direktur ?? 'Nama Direktur' }}
                </h2>
            </div>

            <div class="text-left max-w-3xl mx-auto">
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                    {!! $profil->sambutan !!}
                </div>
            </div>
        </div>
    </section>
@endsection
