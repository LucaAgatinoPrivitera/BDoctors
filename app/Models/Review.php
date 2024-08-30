<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Definisce i campi che possono essere massivamente assegnati
    protected $fillable = [
        'doctor_id',
        'stars',
        'review_text',
        'name_reviewer',
        'email_reviewer'
    ];

    // Definisce la relazione con il modello Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
