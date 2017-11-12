<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class RSS extends Model {

    protected $table = 'rss';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'title', 'link', 'icon', 'cmntt'];
    public $timestamps = true;

}
