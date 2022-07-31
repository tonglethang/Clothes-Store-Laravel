<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use app\models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "sanpham";
    protected $fillable = [
        'TenSP',
        'Hang',
        'SoLuong',
        'Soluongcon',
        'Color',
        'Gia',
        'Image',
        'Size',
        'Note',
        'Loai',
        'DanhMuc',
    ];

}
