<?php

namespace App\Models;

use App\Models\Stock;
use App\Models\Accessory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $guarded = [];

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'product_accessory');
    }
}
