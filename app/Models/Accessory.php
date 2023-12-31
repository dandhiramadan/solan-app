<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'accessories';
    protected $guarded = [];

    public function scopeSearch($query, $keyword)
    {
        return $query->where('description', 'like', '%' . $keyword . '%')
                     ->orWhere('catatan', 'like', '%' . $keyword . '%');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_accessory');
    }
}
