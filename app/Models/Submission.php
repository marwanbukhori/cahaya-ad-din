<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Added this line for the User relationship

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'form_type',
        'applicant_name',
        'applicant_ic',
        'phone',
        'address',
        'participant_name',
        'participant_ic',
        'package_type',
        'animal_type',
        'quantity',
        'relationship',
        'notes',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
