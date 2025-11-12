<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdminController extends Controller{
    public function Dashboard(){
        return view('pages.admin.dashboard');
    }   
}