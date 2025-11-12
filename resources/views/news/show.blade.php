@extends('layouts.main')

@section('container')
    {{-- Judul Halaman --}}
    <h1 class="text-3xl font-bold mb-6">Detail Berita</h1>

    {{-- Kontainer Isi Berita --}}
    <div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-md mb-10">
        {{-- Judul Utama --}}
        <h1 class="text-3xl font-bold mb-2 text-gray-900">{{ $news->judul }}</h1>

        {{-- Info Wartawan --}}
        <p class="text-gray-600 mb-6 text-sm">
            Oleh <span class="font-semibold">{{ $news->wartawan->nama }}</span> |
            Dipublikasikan pada {{ $news->created_at->translatedFormat('d F Y') }}
        </p>

        {{-- Isi Berita --}}
        <div class="leading-relaxed text-gray-800 mb-8 text-justify">
            {!! $news->isi !!}
        </div>

        {{-- Tombol Kembali --}}
        <div class="pt-4 border-t border-gray-200">
            <a href="{{ route('news.index') }}"
               class="text-blue-600 hover:underline font-semibold">
               ← Kembali ke Daftar Berita
            </a>
        </div>
    </div>

    {{-- Kontainer Komentar --}}
    <div class="max-w-5xl mx-auto bg-white p-10 rounded-2xl shadow-md">
        {{-- Form Komentar --}}
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Tinggalkan Komentar</h2>
        <form action="{{ route('komentar.store', $news->id) }}" method="POST" class="space-y-4 mb-10">
            @csrf
            <div>
                <label for="nama" class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" id="nama" name="nama"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                       required>
            </div>
            <div>
                <label for="isi" class="block text-gray-700 font-medium mb-1">Komentar</label>
                <textarea id="isi" name="isi" rows="3"
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none"
                          required></textarea>
            </div>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                Kirim Komentar
            </button>
        </form>

        {{-- Daftar Komentar --}}
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Komentar Pembaca</h2>

        @if ($news->komentar->isEmpty())
            <p class="text-gray-500">Belum ada komentar.</p>
        @else
            <div class="border-t border-gray-200 pt-4 space-y-3">
                @foreach ($news->komentar as $komentar)
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <p class="font-semibold text-gray-800">{{ $komentar->nama }}</p>
                        <p class="text-gray-700">{{ $komentar->isi }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $komentar->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
