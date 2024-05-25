<?php

namespace App\Models;

use App\Traits\CommonScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Customer extends Model
{
    use HasFactory;
    use CommonScope;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'organisation',
        'address',
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
