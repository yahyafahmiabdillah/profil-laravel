<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VaultController extends Controller
{
    public function index()
    {
        $defaultSnippets = [
            [
                'title'    => 'Glow Gradient Button',
                'category' => 'Button',
                'code'     => '<button class="px-5 py-2.5 rounded-xl font-medium text-sm text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-lg shadow-indigo-500/30 hover:scale-105 active:scale-95 transition">Explore UI</button>',
            ],
            [
                'title'    => 'Live Status Pulse Badge',
                'category' => 'Badge',
                'code'     => '<span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20"><span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>Available for Work</span>',
            ],
            [
                'title'    => 'Glassmorphism Stat Card',
                'category' => 'Card',
                'code'     => '<div class="p-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 w-56"><p class="text-xs text-slate-400">Lighthouse Score</p><p class="text-2xl font-bold text-white mt-1">100 / 100</p></div>',
            ],
        ];

        $customSnippets = session('vault_snippets', []);
        $snippets = array_merge($customSnippets, $defaultSnippets);

        return view('vault', compact('snippets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:80',
            'category' => 'required|string|max:30',
            'code'     => 'required|string|max:3000',
        ]);

        $snippets = session('vault_snippets', []);
        array_unshift($snippets, $validated);
        session(['vault_snippets' => $snippets]);

        return redirect()->route('vault.index');
    }
}