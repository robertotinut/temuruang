<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'guest_name',
        'phone',
        'attendance_status',
        'guest_count',
        'message',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
