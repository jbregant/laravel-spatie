<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id', 'role_id', 'updated_at'
    ];
}
