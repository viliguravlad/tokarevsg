<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $primarykey = 'id';
    protected $fillable = ['id', 
					       'spamOrClient', 
					       'lastName', 
					       'firstName', 
					       'surName', 
					       'nickName', 
					       'state', 
					       'birthDate', 
					       'mobNum', 
					       'photo'];

    public $timestamps = false;
}
