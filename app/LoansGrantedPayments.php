<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoansGrantedPayments extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function loanGranted(){
        return $this->belongsTo(LoansGranted::class);
    }
}
