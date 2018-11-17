<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGranted extends Model
{
    protected $table = 'loans_granted';

    protected $attributes = [
        'status' => 'activo'
    ];

    protected $fillable = [
        'client_id', 'loan_type_id', 'collector_id','payments', 'loan_fee', 'amount', 'updated_amount', 'description', 'status','payment_amount','total_amount'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(){
        return $this->belongsTo(Client::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanType(){
        return $this->belongsTo(LoanType::class);
    }

}
