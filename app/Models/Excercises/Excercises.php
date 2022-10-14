<?php

namespace App\Models\Excercises;

use App\Models\MuscleGroup;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excercises extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function gif(): Attribute
    {
        return  new Attribute(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => str_replace(' ', '_', $value)
        );
    }


    /* RELATIONSHIPS */

    public function muscleGroup()
    {
        return $this->hasMany(MuscleGroup::class, 'muscle_groups_id');
    }
}
