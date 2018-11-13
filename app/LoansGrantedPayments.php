<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGrantedPayments extends Model
{
    protected $fillable = [
        'loan_granted_id', 'payment_number', 'due_date', 'payment_amount', 'amount', 'updated_amount', 'description', 'status'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanGranted(){
        return $this->belongsTo(LoansGranted::class);
    }
}
