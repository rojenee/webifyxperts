<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status'];

    const PENDING = 0;
    const ONGOING = 1;
    const FINISHED = 2;
    const CANCELLED = 3;

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The laundries that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function laundries()
    {
        return $this->belongsToMany(Laundry::class, 'laundry_order', 'order_id', 'laundry_id')
            ->withPivot('price')
            ->withTimestamps();
    }
}
