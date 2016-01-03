<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
	protected $table = 'logging';
	protected $primarykey = 'id';
	protected $fillable = [
		'activity',
		'user',
		'created_at',
		'updated_at'];

	//public $timestamps = false;  
}
