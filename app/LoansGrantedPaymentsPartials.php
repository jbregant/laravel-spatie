<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGrantedPaymentsPartials extends Model
{
    protected $fillable = [
        'loan_granted_payments_id', 'amount_paid',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanGrantedPayments(){
        return $this->belongsTo(LoansGrantedPayments::class);
    }
}
