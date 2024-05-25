<?php

namespace App\Models;

use App\Traits\CommonScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    use CommonScope;

    protected $fillable = [
        'user_id',
        'customer_id',
        'date',
        'inv_number',
        'notes',
        'status'
    ];

    protected $with = ['products'];

    protected $appends = ['total_amount'];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    function getTotalAmountAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }

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
