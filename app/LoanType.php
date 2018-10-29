<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{

    protected $table = 'loan_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'min_loan_payments', 'max_loan_payments', 'loan_fee', 'frecuency_type_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function frecuency(){
        return $this->belongsTo(Frecuency::class);
    }
}
