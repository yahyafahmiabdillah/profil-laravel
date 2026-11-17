<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevHub — Bento & UI Vault')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen font-sans antialiased selection:bg-indigo-500 selection:text-white"
      x-data="{ toast: '' }"
      @notify.window="toast = $event.detail; setTimeout(() => toast = '', 2200)">

    <!-- Floating Glass Navbar -->
    <nav class="sticky top-4 z-40 max-w-xl mx-auto px-4">
        <div class="flex items-center justify-between bg-slate-900/80 backdrop-blur-xl border border-slate-800 rounded-2xl px-4 py-2.5 shadow-xl">
            <a href="{{ route('bento.index') }}" class="font-bold text-sm tracking-tight text-white flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span> DevHub
            </a>
            <div class="flex items-center gap-1 bg-slate-950/80 p-1 rounded-xl border border-slate-800/80 text-xs font-medium">
                <a href="{{ route('bento.index') }}"
                   class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('bento.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-white' }}">
                    Bento Profile
                </a>
                <a href="{{ route('vault.index') }}"
                   class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('vault.*') ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:text-white' }}">
                    UI Vault
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="max-w-5xl mx-auto px-4 py-10">
        @yield('content')
    </main>

    <!-- Toast Notifikasi -->
    <div x-show="toast" x-transition
         class="fixed bottom-6 right-6 bg-emerald-600 text-white text-xs font-medium px-4 py-2.5 rounded-xl shadow-lg">
        <span x-text="toast"></span>
    </div>

</body>
</html>