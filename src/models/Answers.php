<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model {

    protected $table = 'answers';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'answer'];
    public $timestamps = false;

}
