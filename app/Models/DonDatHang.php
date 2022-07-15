<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use app\models\Product;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

use Illuminate\Database\Eloquent\Model;

class  DonDatHang extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "dondathang";
    protected $fillable = [
        'MaDon',
        'MaKH',
        'MaSP',
        'TongTien',
        'SoLuongDH',
        'Phuongthuc',
        'ThoiGianDH',
        'status',
        'ThoiGianNH'
    ];

}
