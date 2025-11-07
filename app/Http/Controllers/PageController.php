<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

class PageController extends Controller
{
    public function Beranda()
    {
        return view('pages.beranda');
    }

    public function Tentang()
    {
        return view('pages.tentang');
    }

    public function Kebijakan()
    {
        return view('pages.kebijakan');
    }

    public function Akomodasi()
    {
        return view('pages.akomodasi');
    }

    public function Fasilitas()
    {
        return view('pages.fasilitas');
    }

    public function Galeri()
    {
        return view('pages.galeri');
    }
}
