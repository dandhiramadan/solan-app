<?php

namespace App\Models;

use App\Models\User;
use App\Models\Instruction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tasks';
    protected $appends = ['open'];
    protected $guarded = [];

    public function getOpenAttribute()
    {
        return true;
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('text', 'like', '%' . $keyword . '%')
                  ->orWhere('status', 'like', '%' . $keyword . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $keyword . '%')
                  ->orWhere('state', 'like', '%' . $keyword . '%')
                  ->orWhereHas('instruction', function ($query) use ($keyword) {
                      $query->where('spk_number', 'like', '%' . $keyword . '%')
                      ->orWhere('spk_type', 'like', '%' . $keyword . '%')
                      ->orWhere('taxes_type', 'like', '%' . $keyword . '%')
                      ->orWhere('customer_name', 'like', '%' . $keyword . '%')
                      ->orWhere('spk_number_fsc', 'like', '%' . $keyword . '%')
                      ->orWhere('order_date', 'like', '%' . $keyword . '%')
                      ->orWhere('delivery_date', 'like', '%' . $keyword . '%')
                      ->orWhere('purchase_order', 'like', '%' . $keyword . '%')
                      ->orWhere('order_name', 'like', '%' . $keyword . '%')
                      ->orWhere('code_style', 'like', '%' . $keyword . '%')
                      ->orWhere('quantity', 'like', '%' . $keyword . '%')
                      ->orWhere('followup', 'like', '%' . $keyword . '%');
                  });
        });
    }

    public function instruction()
    {
        return $this->belongsTo(Instruction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
