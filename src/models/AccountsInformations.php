<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class AccountsInformations extends Model {

    protected $table = 'accounts_informations';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'accountId', 'firstName', 'lastName', 'birthDate', 'sex', 'lang', 'newsletter', 'knowGame', 'country'];
    public $timestamps = false;

}