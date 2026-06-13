<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name', 'price', 'max_guest', 'max_gallery', 'max_template', 'is_active'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'max_guest' => 'integer',
            'max_gallery' => 'integer',
            'max_template' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
