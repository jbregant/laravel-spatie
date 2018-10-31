<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGranted extends Model
{
    protected $table = 'loans_granted';

    protected $fillable = [
        'client_id', 'loan_type_id', 'payments', 'loan_fee', 'amount', 'updated_amount', 'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client(){
        return $this->belongsTo(Client::class);
    }

}
