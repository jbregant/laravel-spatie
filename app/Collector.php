<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'phone', 'address', 'zone_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone(){
        return $this->belongsTo(Zone::class);
    }
}
