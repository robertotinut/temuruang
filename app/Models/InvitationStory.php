<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationStory extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'title',
        'description',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
