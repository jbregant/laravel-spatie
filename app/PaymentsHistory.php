<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentsHistory extends Model
{
    protected $table = 'payments_history';
    protected $fillable = [
        'loan_granted_id', 'payment_date', 'payment_amount_paid'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanGranted(){
        return $this->belongsTo(LoansGranted::class);
    }
}
