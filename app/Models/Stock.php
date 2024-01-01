<?php

namespace App\Models;

use App\Models\Product;
use App\Models\LogStock;
use App\Models\Accessory;
use App\Models\HistoryStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stocks';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_accessory_stock')
            ->withPivot('quantity')->withTimestamps();
    }

    public function accessories()
    {
        return $this->belongsToMany(Accessory::class, 'product_accessory_stock')
            ->withPivot('quantity')->withTimestamps();
    }

    public function logstocks()
    {
        return $this->hasMany(LogStock::class);
    }
}
