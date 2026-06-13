<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'event_type_id', 'name', 'slug', 'thumbnail', 'preview_image', 'description', 'is_premium', 'is_active'
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    protected function casts(): array
    {
        return [
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
