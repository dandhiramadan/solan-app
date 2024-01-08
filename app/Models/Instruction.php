<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Catatan;
use App\Models\Document;
use App\Models\LayoutBahan;
use App\Models\LayoutSetting;
use App\Models\FormKeterangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instruction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'instructions';
    protected $guarded = [];

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function catatan()
    {
        return $this->hasMany(Catatan::class);
    }

    public function layoutSetting()
    {
        return $this->hasMany(LayoutSetting::class);
    }

    public function formKeterangan()
    {
        return $this->hasMany(FormKeterangan::class);
    }

    public function layoutBahan()
    {
        return $this->hasMany(LayoutBahan::class);
    }
}
