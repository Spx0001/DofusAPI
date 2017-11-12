<?php

namespace dofus\models;

use Illuminate\Database\Eloquent\Model;

class ServerStatusProblems extends Model {

    protected $table = 'serverstatus_problems';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_status', 'event'];
    public $timestamps = true;

    public function getStatus() {
    	return $this->belongsTo(ServerStatus::class, 'id');
    }

}
