<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuency extends Model
{
    protected $table = 'frecuency_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frecuency(){
        return $this->belongsTo(Frecuency::class);
    }
}
