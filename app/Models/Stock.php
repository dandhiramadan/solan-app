<?php

namespace App\Models;

use App\Models\Product;
use App\Models\HistoryStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stocks';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
