<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
protected $fillable = [

    'domain', 'paydate', 'expiredate', 'paysumma','paymethod', 'email'


];


}

