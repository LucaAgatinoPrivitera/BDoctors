<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = ['name', 'price', 'duration'];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_sponsorship')
            ->withPivot('name', 'price', 'date_start', 'date_end')
            ->withTimestamps();
    }
    public $timestamps = false;
}
