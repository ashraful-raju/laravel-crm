<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
        'inv_number',
        'notes',
        'total_amount',
        'status'
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


    /**
     * Relation with the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relation with the purchased products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price');
    }
}
