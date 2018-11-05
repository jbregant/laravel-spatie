<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGrantedPaymentsPartials extends Model
{
    protected $table = 'loans_granted_payments_partial';

    protected $fillable = [
        'loan_granted_payments_id', 'amount_paid',
    ];

    protected $attributes = [
        'status' => 'activo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanGrantedPayments(){
        return $this->belongsTo(LoansGrantedPayments::class);
    }
}
