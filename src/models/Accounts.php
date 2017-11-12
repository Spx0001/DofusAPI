<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model {

    protected $table = 'accounts';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'username', 'password', 'nickname', 'email', 'secretQuestion', 'secretAnswer', 'subscribeTime', 'community'];
    public $timestamps = false;

}