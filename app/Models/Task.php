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

    public function instruction()
    {
        return $this->belongsTo(Instruction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
