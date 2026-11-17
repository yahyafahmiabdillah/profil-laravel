<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BentoController extends Controller
{
    public function index()
    {
        $defaultCards = [
            [
                'title'    => 'GitHub',
                'subtitle' => '@username — Open Source & Repositories',
                'url'      => 'https://github.com',
                'span'     => 'md:col-span-2',
                'badge'    => 'Code',
                'color'    => 'from-slate-800/90 to-slate-900',
            ],
            [
                'title'    => 'Dribbble / Behance',
                'subtitle' => 'UI/UX Explorations',
                'url'      => 'https://dribbble.com',
                'span'     => 'md:col-span-1',
                'badge'    => 'Design',
                'color'    => 'from-pink-500/20 to-rose-500/10',
            ],
            [
                'title'    => 'Tech Stack',
                'subtitle' => 'HTML • Tailwind • Alpine • Laravel',
                'url'      => '#stack',
                'span'     => 'md:col-span-1',
                'badge'    => 'Tools',
                'color'    => 'from-sky-500/20 to-indigo-500/10',
            ],
        ];

        $customCards = session('bento_cards', []);
        $cards = array_merge($defaultCards, $customCards);

        return view('bento', compact('cards'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:60',
            'subtitle' => 'required|string|max:120',
            'url'      => 'required|string|max:255',
            'span'     => 'required|in:md:col-span-1,md:col-span-2',
            'badge'    => 'required|string|max:20',
        ]);

        $validated['color'] = 'from-indigo-500/20 to-purple-500/10';

        $cards = session('bento_cards', []);
        $cards[] = $validated;
        session(['bento_cards' => $cards]);

        return redirect()->route('bento.index');
    }
}