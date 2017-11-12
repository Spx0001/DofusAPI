<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model {

    protected $table = 'gifts';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'description', 'url', 'gift', 'cmntt'];

}
