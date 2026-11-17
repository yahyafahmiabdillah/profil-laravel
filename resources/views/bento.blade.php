@extends('layouts.app')
@section('title', 'Bento Profile — Frontend Developer')

@section('content')
<div x-data="{ accent: 'border-indigo-500/40', openModal: false }">

    <!-- Kontrol Tema & Tombol Tambah Kartu -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <span>Accent Glow:</span>
            <button @click="accent = 'border-indigo-500/50'" class="w-5 h-5 rounded-full bg-indigo-500 cursor-pointer"></button>
            <button @click="accent = 'border-emerald-500/50'" class="w-5 h-5 rounded-full bg-emerald-500 cursor-pointer"></button>
            <button @click="accent = 'border-pink-500/50'" class="w-5 h-5 rounded-full bg-pink-500 cursor-pointer"></button>
            <button @click="accent = 'border-amber-500/50'" class="w-5 h-5 rounded-full bg-amber-500 cursor-pointer"></button>
        </div>

        <button @click="openModal = true"
                class="bg-slate-900 hover:bg-slate-800 border border-slate-700 text-xs font-medium px-3.5 py-2 rounded-xl transition cursor-pointer">
            + Tambah Kartu Bento
        </button>
    </div>

    <!-- Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 auto-rows-[170px]">

        <!-- Kartu Profil Utama (2x2) -->
        <div :class="accent"
             class="md:col-span-2 md:row-span-2 bg-gradient-to-br from-slate-900 to-slate-950 border rounded-3xl p-7 flex flex-col justify-between transition">
            <div>
                <span class="inline-flex items-center gap-2 text-xs font-medium px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Frontend Developer
                </span>
                <h1 class="text-2xl md:text-3xl font-bold text-white mt-4 tracking-tight">
                    Halo, saya Frontend Dev.
                </h1>
                <p class="text-sm text-slate-400 mt-2 leading-relaxed">
                    Fokus membangun antarmuka web yang cepat, responsif, dan interaktif dengan sentuhan backend Laravel.
                </p>
            </div>
            <div class="flex items-center gap-3 text-xs text-slate-400">
                <span>Malang, Indonesia</span>
                <span>•</span>
                <span>PHP & Modern UI</span>
            </div>
        </div>

        <!-- Kartu Shortcut ke UI Component Vault (2x1) -->
        <a href="{{ route('vault.index') }}"
           class="md:col-span-2 bg-gradient-to-r from-indigo-600/20 via-purple-600/20 to-pink-600/20 border border-indigo-500/30 hover:border-indigo-400 rounded-3xl p-6 flex flex-col justify-between group transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-indigo-300">Featured Space</span>
                <span class="text-indigo-300 group-hover:translate-x-1 transition">→</span>
            </div>
            <div>
                <h2 class="text-lg font-bold text-white">UI Component & Snippet Vault</h2>
                <p class="text-xs text-slate-300 mt-1">Koleksi komponen Tailwind CSS & kode siap pakai dengan Live Preview.</p>
            </div>
        </a>

        <!-- Kartu Dinamis dari Controller -->
        @foreach ($cards as $card)
            <a href="{{ $card['url'] }}" target="_blank"
               class="{{ $card['span'] }} bg-gradient-to-br {{ $card['color'] }} border border-slate-800 hover:border-slate-600 rounded-3xl p-6 flex flex-col justify-between transition group">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-medium px-2.5 py-0.5 rounded-full bg-slate-950/60 text-slate-300 border border-slate-800">
                        {{ $card['badge'] }}
                    </span>
                    <span class="text-slate-500 group-hover:text-white text-xs transition">↗</span>
                </div>
                <div>
                    <h3 class="font-semibold text-white text-base">{{ $card['title'] }}</h3>
                    <p class="text-xs text-slate-400 mt-1 truncate">{{ $card['subtitle'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Modal Tambah Kartu Bento -->
    <div x-show="openModal" x-transition class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.outside="openModal = false" class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-base font-bold text-white mb-4">Tambah Kartu Bento Baru</h3>
            <form action="{{ route('bento.store') }}" method="POST" class="space-y-3 text-sm">
                @csrf
                <input type="text" name="title" placeholder="Judul Kartu (misal: LinkedIn)" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2">
                <input type="text" name="subtitle" placeholder="Deskripsi singkat" required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2">
                <input type="text" name="url" placeholder="https://..." required class="w-full bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2">
                <div class="grid grid-cols-2 gap-2">
                    <select name="span" class="bg-slate-950 border border-slate-800 rounded-xl px-3 py-2">
                        <option value="md:col-span-1">Ukuran 1x1 (Kecil)</option>
                        <option value="md:col-span-2">Ukuran 2x1 (Lebar)</option>
                    </select>
                    <input type="text" name="badge" placeholder="Label (Social/Project)" value="Link" required class="bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openModal = false" class="px-4 py-2 text-xs text-slate-400">Batal</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium px-4 py-2 rounded-xl cursor-pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection