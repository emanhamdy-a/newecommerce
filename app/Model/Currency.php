<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
	protected $table    = 'currencies';
	protected $fillable = [
		'currency_name_ar',
		'currency_name_en',
		'currency_code',
	];
}
