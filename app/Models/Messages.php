<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    // La tabella associata al modello
    protected $table = 'messages';

    // I campi che possono essere massivamente assegnati
    protected $fillable = [
        'doctor_id',
        'message',
        'email',
        'name',
    ];

    // Definizione della relazione con il modello Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
