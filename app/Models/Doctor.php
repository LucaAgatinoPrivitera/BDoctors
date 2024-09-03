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

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'doctor_specialization', 'doctor_id', 'specialization_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class, 'doctor_sponsorship')
            ->withPivot('name', 'price', 'date_start', 'date_end');
    }

    public function activeSponsorship()
    {
        return $this->sponsorships()->where('date_start', '<=', now())
            ->where('date_end', '>=', now())
            ->first();
    }

    // per togliere i timestamps
    public $timestamps = false;
}
