<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class ServerStatus extends Model {

    protected $table = 'serverstatus';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'state', 'type', 'event', 'visible', 'cmntt'];
    public $timestamps = true;

    public function getProblems() {
    	return $this->hasMany(ServerStatusProblems::class, 'id_status');
    }

}
