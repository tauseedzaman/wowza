<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users_roles extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'role_id'];
    protected $table="users_roles";

    public function role()
    {
        return $this->hasOne(role::class,'id','role_id');
    }
}
