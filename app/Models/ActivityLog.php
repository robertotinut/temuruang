<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'event_type',
        'user_id',
        'template_id',
        'subject',
        'description',
        'ip_address',
        'user_agent',
        'url',
        'is_telegram_sent',
    ];

    protected function casts(): array
    {
        return [
            'is_telegram_sent' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
