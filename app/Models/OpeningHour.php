<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'space_id', 'week_day', 'opening_time', 'closing_time', 'on_request',
    ];

    protected $casts = [
        'on_request' => 'boolean',
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }
}
