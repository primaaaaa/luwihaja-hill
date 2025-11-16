<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Dashboard()
    {
        return view('pages.admin.dashboard');
    }

    public function Kamar()
    {
        return view('pages.admin.manajemenkamar', [
            'rooms' => Kamar::showAll(),
            'tableHeader' => ['Kode Kamar', 'Unit', 'Kapasitas', 'Kategori', 'Status']
        ]);
    }

    public function Reservasi()
    {
        return view('pages.admin.manajemenreservasi', [
            'tableHeader' => ['Kode Reservasi', 'Nama Tamu', 'Tanggal Check-In', 'Tanggal Check-Out', 'Status']
        ]);
    }

    public function Ulasan()
    {
        return view('pages.admin.manajemenulasan', [
            'tableHeader' => ['Nama Tamu', 'Kode Reservasi', 'Rating', 'Komentar', 'Tanggal Ulasan']
        ]);
    }
    public function CMS()
    {
        return view('pages.admin.cms', [
            'tableHeader' => ['Kode Galeri', 'File', 'Tanggal Upload']
        ]);
    }
    public function Refund()
    {
        return view('pages.admin.manajemenrefund', [
            'tableHeader' => ['Kode Refund', 'Kode Reservasi', 'Nama Tamu', 'Tanggal Pengajuan', 'Status']
        ]);
    }
    public function Pembayaran()
    {
        return view('pages.admin.manajemenpembayaran', [
            'tableHeader' => ['Kode Reservasi', 'Nama Tamu', 'Tanggal Pembayaran', 'Jumlah', 'Status']
        ]);
    }

    public function DetailKamar()
    {
        return view('pages.admin.kamar-detail');
    }

    public function DetailPembayaran()
    {
        return view('pages.admin.pembayaran-detail');
    }

    public function DetailRefund()
    {
        return view('pages.admin.refund-detail');
    }

    public function DetailReservasi()
    {
        return view('pages.admin.reservasi-detail');
    }

    public function DetailUlasan()
    {
        return view('pages.admin.ulasan-detail');
    }
}
