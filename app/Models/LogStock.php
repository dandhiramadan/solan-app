<?php

namespace App\Models;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogStock extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'log_stocks';
    protected $guarded = [];

    public function stocks()
    {
        return $this->belongsTo(Stock::class);
    }
}
