<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'event_type_id',
        'name',
        'slug',
        'thumbnail',
        'preview_image',
        'description',
        'is_premium',
        'is_active',
        'theme_category',
        'views_count',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    /**
     * Publicly displayed views count (Real DB views multiplied by 5).
     */
    public function getDisplayViewsAttribute(): int
    {
        return ((int) ($this->views_count ?? 0)) * 5;
    }

    protected function casts(): array
    {
        return [
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
            'views_count' => 'integer',
        ];
    }
}
