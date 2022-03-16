<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'consult_address',
        'age',
        'gender',
        'medical_history',
        'consulting_text',
        'doctor_reply'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
