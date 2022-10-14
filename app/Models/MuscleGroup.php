<?php

namespace App\Models;

use App\Models\Excercises\Excercises;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuscleGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    /* RELACIONES */
    public function excercises()
    {
        return $this->belongsTo(Excercises::class, 'foreign_key');
    }
}
