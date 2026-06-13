<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $fillable = ['name', 'description', 'is_active'];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
