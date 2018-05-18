<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $fillable = array('name','position','company','email','phone');
    public function members(){
        return $this->hasMany('App\Member');
    }
}
