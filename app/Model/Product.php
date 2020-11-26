<?php

namespace App\Model;

use Carbon\Carbon;
use App\Model\Country;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table    = 'products';
	protected $fillable = [
		'title_ar',
		'title_en',
		'photo',
		'content_ar',
		'content_en',
		'department_id',
		'trade_id',
    'manu_id',
    'country_id',
		'color_id',
		'size_id',
		'currency_id',
		'merchant_id',
		'price',
		'stock',
		'start_at',
		'end_at',
		'start_offer_at',
		'end_offer_at',
		'price_offer',
		'other_data',
		'weight',
		'weight_id',
		'status',
		'reason',
	];

	public function related() {
		return $this->hasMany(\App\Model\RelatedProudct::class , 'product_id', 'id');
	}

	public function other_data() {
    return $this->hasMany(\App\Model\OtherData::class , 'product_id', 'id');
  }

  public function expired($dat=null)
  {
    if($dat===null){
      return 'open';
    }
    $date = new Carbon;
    if($date > $dat)
    {
        return trans('admin.expired');
      } else {
        return trans('admin.vaild');
    }
  }
  public function offer($dat=null)
  {
    if($dat===null){
      return trans('admin.open');
    }
    $date = new Carbon;
    if($date > $dat)
    {
        return trans('admin.expired');
      } else {
        return trans('admin.vaild');
    }
  }

  public function country_id($all=null)
  {
    if($all!== null){
      return $this->hasOne(Country::class, 'id', 'country_id')
      ;
    }
    if(lang()=='ar'){
      return $this->hasOne(Country::class, 'id', 'country_id')

      ->value('country_name_ar');
    }else{
      return $this->hasOne(Country::class, 'id', 'country_id')

      ->value('country_name_en');
    }
  }

  public function department_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Department','id', 'department_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Department','id', 'department_id')->value('dep_name_ar');
    }else{
      return $this->hasOne('App\Model\Department','id', 'department_id')->value('dep_name_en');
    }
  }

  public function trade_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\TradeMark','id', 'trade_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\TradeMark','id', 'trade_id')->value('name_ar');
    }else{
      return $this->hasOne('App\Model\Trademark','id', 'trade_id')->value('name_en');
    }
  }

  public function manu_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Manufactures','id', 'manu_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Manufactures','id', 'manu_id')->value('name_ar');
    }else{
      return $this->hasOne('App\Model\Manufactures','id', 'manu_id')->value('name_en');
    }
  }

  public function color_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Color','id','color_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Color','id','color_id')->value('name_ar');
    }else{
      return $this->hasOne('App\Model\Color','id','color_id')->value('name_en');
    }
  }

  public function size_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Size','id','size_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Size','id','size_id')->value('name_ar');
    }else{
      return $this->hasOne('App\Model\Size','id','size_id')->value('name_en');
    }
  }

  public function currency_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Currency','id','currency_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Currency','id','currency_id')->value('currency_name_ar');
    }else{
      return $this->hasOne('App\Model\Currency','id','currency_id')->value('currency_name_en');
    }
  }
  public function merchant_id($all=null) {
    if($all!== null){
      return $this->hasOne('App\Model\Merchant','id','merchant_id');
    }
    if(lang()=='ar'){
      return $this->hasOne('App\Model\Currency','id','merchant_id')->value('name_ar');
    }else{
      return $this->hasOne('App\Model\Merchant','id','merchant_id')->value('name_en');
    }
  }

	public function files() {
		return $this->hasMany('App\File', 'relation_id', 'id')->where('file_type', 'product');
	}
}
