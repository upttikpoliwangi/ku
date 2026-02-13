@extends('ppid::landing-page.app')

@section('title', 'Profil - Visi Misi')

@section('content')
    <!-- Header Section -->
    <section class="py-20" style="background: linear-gradient(135deg, var(--primary-blue) 0%, #0066a3 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Visi & Misi
            </h1>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="text-left max-w-3xl mx-auto mb-12">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 text-center">VISI</h4>
            <div class="bg-blue-50 rounded-lg p-8">
                <p class="text-lg text-gray-700 leading-relaxed text-center italic">
                    {!! $profil->visi !!}
                </p>
            </div>
        </div>

        <div class="text-left max-w-3xl mx-auto">
            <h4 class="text-2xl font-bold text-gray-800 mb-6 text-center">MISI</h4>
            <div class="bg-gray-50 rounded-lg p-8">
                <div class="prose prose-lg max-w-none text-gray-700 [&_ul]:list-disc [&_ul]:pl-5 [&_li]:my-2">
                    {!! $profil->misi !!}
                </div>
            </div>
        </div>
    </section>
@endsection