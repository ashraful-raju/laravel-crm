<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'unit_price',
        'pre_quantity',
        'available',
        'image'
    ];

    /**
     * Relation with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function getAvatarAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return 'https://ui-avatars.com/api/?name=' . $this->name;
    }
}
