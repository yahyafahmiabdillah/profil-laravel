@extends('layouts.app')
@section('title', 'UI Component & Snippet Vault')

@section('content')
<div x-data="{ search: '', category: 'All', openModal: false }">

    <!-- Header, Search & Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-white tracking-tight">UI Component Vault</h1>
            <p class="text-xs text-slate-400 mt-1">Pratinjau langsung komponen HTML/Tailwind dan salin kodenya dalam sekali klik.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <input type="text" x-model="search" placeholder="Cari komponen..."
                   class="bg-slate-900 border border-slate-800 rounded-xl px-3.5 py-2 text-xs focus:outline-none focus:border-indigo-500">
            <select x-model="category" class="bg-slate-900 border border-slate-800 rounded-xl px-3 py-2 text-xs">
                <option value="All">Semua Kategori</option>
                <option value="Button">Button</option>
                <option value="Badge">Badge</option>
                <option value="Card">Card</option>
                <option value="Other">Other</option>
            </select>
            <button @click="openModal = true"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium px-4 py-2 rounded-xl transition cursor-pointer">
                + Simpan Snippet
            </button>
        </div>
    </div>

    <!-- Grid Kartu Komponen -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach ($snippets as $item)
            <div x-data="{ tab: 'preview' }"
                 data-title="{{ strtolower($item['title']) }}"
                 data-category="{{ $item['category'] }}"
                 x-show="(category === 'All' || category === $el.dataset.category) && $el.dataset.title.includes(search.toLowerCase())"
                 class="bg-slate-900/80 border border-slate-800 rounded-2xl overflow-hidden flex flex-col">

                <!-- Top Bar Kartu -->
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-800 bg-slate-900">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold text-white">{{ $item['title'] }}</span>
                        <span class="text-[10px] px-2 py-0.5 rounded bg-slate-800 text-slate-400">{{ $item['category'] }}</span>
                    </div>

                    <div class="flex items-center gap-1.5 text-xs">
                        <button @click="tab = 'preview'" :class="tab === 'preview' ? 'bg-slate-800 text-white' : 'text-slate-400'"
                                class="px-2.5 py-1 rounded-lg transition cursor-pointer">Preview</button>
                        <button @click="tab = 'code'" :class="tab === 'code' ? 'bg-slate-800 text-white' : 'text-slate-400'"
                                class="px-2.5 py-1 rounded-lg transition cursor-pointer">Code</button>
                        <button data-code="{{ $item['code'] }}"
                                @click="navigator.clipboard.writeText($el.dataset.code); $dispatch('notify', 'Kode berhasil disalin!')"
                                class="ml-1 px-2.5 py-1 rounded-lg bg-indigo-600/20 text-indigo-300 hover:bg-indigo-600 hover:text-white transition cursor-pointer">
                            Copy
                        </button>
                    </div>
                </div>

                <!-- Area Live Preview -->
                <div x-show="tab === 'preview'" class="p-8 min-h-[170px] flex items-center justify-center bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:16px_16px]">
                    {!! $item['code'] !!}
                </div>

                <!-- Area Source Code -->
                <div x-show="tab === 'code'" class="p-4 min-h-[170px] bg-slate-950 overflow-x-auto text-xs">
                    <pre class="!bg-transparent !m-0 !p-0"><code class="language-markup">{{ $item['code'] }}</code></pre>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Tambah Snippet -->
    <div x-show="openModal" x-transition class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div @click.outside="openModal = false" class="bg-slate-900 border border-slate-800 rounded-2xl p-6 w-full max-w-lg">
            <h3 class="text-base font-bold text-white mb-4">Simpan Komponen UI Baru</h3>
            <form action="{{ route('vault.store') }}" method="POST" class="space-y-3 text-sm">
                @csrf
                <div class="grid grid-cols-3 gap-2">
                    <input type="text" name="title" placeholder="Nama Komponen" required class="col-span-2 bg-slate-950 border border-slate-800 rounded-xl px-3.5 py-2">
                    <select name="category" class="bg-slate-950 border border-slate-800 rounded-xl px-3 py-2">
                        <option value="Button">Button</option>
                        <option value="Badge">Badge</option>
                        <option value="Card">Card</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <textarea name="code" rows="5" placeholder="Tempel kode HTML + Tailwind CSS di sini..." required
                          class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3.5 font-mono text-xs"></textarea>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openModal = false" class="px-4 py-2 text-xs text-slate-400">Batal</button>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium px-4 py-2 rounded-xl cursor-pointer">Simpan ke Vault</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection