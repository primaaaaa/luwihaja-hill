<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Kamar extends Model{
    protected $table = 'villa_types';
    // protected $primaryKey = 'kode_tipe';
  
    protected $fillable = ['kode_tipe' ,'name', 'main_image', 'quantity', 'price_per_night', 'capacity', 'description'];
    
} 

?>