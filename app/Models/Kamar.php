<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Kamar{
    protected $kode_tipe;
    protected $unit;
    protected $kapasitas;
    protected $kategori;
    protected $status;
    
    public static function showAll() {
        return [
                [
                    'kode_tipe' => 'K101',
                    'unit' => 'Single Bed',
                    'kapasitas' => 2,
                    'kategori' => 'Single Bed',
                    'status' => 'Tersedia'
                ]
            ];
    }
} 

?>