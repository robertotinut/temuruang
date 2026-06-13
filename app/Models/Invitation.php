<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_type_id',
        'template_id',
        'custom_view_path',
        'title',
        'slug',
        'event_date',
        'event_time',
        'location',
        'address',
        'google_maps_url',
        'description',
        'cover_image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function galleries()
    {
        return $this->hasMany(InvitationGallery::class);
    }

    public function stories()
    {
        return $this->hasMany(InvitationStory::class);
    }

    public function rsvps()
    {
        return $this->hasMany(Rsvp::class);
    }

    public function guestBooks()
    {
        return $this->hasMany(GuestBook::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}
