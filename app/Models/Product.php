<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Accessory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', '%' . $keyword . '%')
                     ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                     ->orWhere('panjang', 'like', '%' . $keyword . '%')
                     ->orWhere('lebar', 'like', '%' . $keyword . '%')
                     ->orWhere('catatan', 'like', '%' . $keyword . '%');
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'product_accessory_stock')
            ->withPivot('quantity')->withTimestamps();
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'product_accessory_stock')
            ->withPivot('quantity')->withTimestamps();
    }
}
