<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
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

    public function detailAkomodasi()
    {
        return view('pages.detailakomodasi');
    }

    public function Fasilitas()
    {
        return view('pages.fasilitas');
    }

    public function Galeri(Request $request)
    {
        $images = [
            'api unggun.jpg',
            'cafe.jpg',
            'deluexeroomm.jpg',
            'familit roiom fr1.jpg',
            'fasil4.jpg',
            'gazebo.jpg',
            'hiasan.jpg',
            'hiasan1.jpg',
            'hiasan3.jpg',
            'hiasan22.jpg',
            'home.jpg',
            'kamar.jpg',
            'kamar1.jpg',
            'kamartwinbed1.jpg',
            'kamartwinbed2.jpg',
            'luwiahaja.webp',
            'market.webp',
            'mushola.webp',
            'queenbed1.jpg',
            'sungai.jpg'
        ];

        $perPage = 8; // banyak gambar per halaman
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        $pagedData = array_slice($images, $offset, $perPage);

        $photos = new LengthAwarePaginator(
            $pagedData,
            count($images),
            $perPage,
            $currentPage,
            ['path' => $request->url()]
        );

        return view('pages.galeri', compact('photos'));
    }
}
