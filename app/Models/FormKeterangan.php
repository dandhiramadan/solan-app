<?php

namespace App\Models;

use App\Models\Instruction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormKeterangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'form_keterangans';
    protected $guarded = [];

    public function instruction()
    {
        return $this->belongsTo(Instruction::class);
    }
}
