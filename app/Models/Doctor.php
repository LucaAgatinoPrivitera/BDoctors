<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'surname',
        'address',
        'cv',
        'pic',
        'phone',
        'bio',
        'user_id',
        'user_name'
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specialization');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // per togliere i timestamps
    public $timestamps = false;
}