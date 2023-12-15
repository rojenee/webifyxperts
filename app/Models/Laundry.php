<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laundry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'laundry_name',
        'weight_laundry',
        'base_price_per_weight',
        'total_laundry_price',
        'status'
    ];

    /**
     * Get the user that owns the Laundry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the payments for the Laundry
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * The orders that belong to the Laundry
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'laundry_order', 'laundry_id', 'order_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function setBasePricePerWeightAttribute($value)
    {
        $this->attributes['base_price_per_weight'] = number_format((float)$value, 2, '.', '');
    }

    public function setTotalLaundryPriceAttribute($value)
    {
        $this->attributes['total_laundry_price'] = number_format((float)$value, 2, '.', '');
    }

    public function setWeightLaundryAttribute($value)
    {
        $this->attributes['weight_laundry'] =  number_format((float)$value, 2, '.', '');
    }
}
