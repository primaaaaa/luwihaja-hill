<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdminController extends Controller{
    public function Dashboard(){
        return view('pages.admin.dashboard');
    }

    public function Kamar(){
        return view('pages.admin.manajemenkamar');
    }

    public function Reservasi(){
        return view('pages.admin.manajemenreservasi');
    }

    public function Ulasan(){
        return view('pages.admin.manajemenulasan');
    }   
}