<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use app\models\Product;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Illuminate\Database\Eloquent\Model;

class Product extends Model implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "sanpham";
    protected $fillable = [
        'MaSP',
        'TenSP',
        'Hang',
        'SoLuong',
        'Color',
        'Gia',
        'Image',
        'Size',
        'Note',
        'Loai',
        'DanhMuc',
    ];

}
