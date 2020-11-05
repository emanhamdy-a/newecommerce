<?php
if (!function_exists('setting')) {
	function setting() {
    $setting=\App\Model\Setting::orderBy('id', 'desc')->first();
    return $setting;
	}
}

if (!function_exists('aurl')) {
	function aurl($url = null) {
		return url('admin/'.$url);
	}
}

if (!function_exists('admin')) {
	function admin() {
		return auth()->guard('admin');
	}
}

if (!function_exists('admin_prefix')) {
	function admin_prefix() {
		return 'admin';
	}
}

if (!function_exists('active_menu')) {
	function active_menu($link) {

		if (preg_match('/'.$link.'/i', Request::segment(2))) {
			return ['menu-open', 'display:block'];
		} else {
			return ['', ''];
		}
	}
}

if (!function_exists('lang')) {
	function lang() {
		if (session()->has('lang')) {
			return session('lang');
		} else {
      if(function_exists('setting') && isset(setting()->main_lang)){
        session()->put('lang', setting()->main_lang);
        return setting()->main_lang;
      }else{
        // session()->has('lang')?session()->forget('lang'):'';
        session()->put('lang', 'ar');
        return 'ar';
      }
		}
	}
}

if (!function_exists('direction')) {
	function direction() {
		if (session()->has('lang')) {
			if (session('lang') == 'ar') {
				return 'rtl';
			} else {
				return 'ltr';
			}
		} elseif(isset(setting()->main_lang)) {
      if(setting()->main_lang=='ar'){
        return 'rtl';
      }else{
        return 'ltr';
      }
		}else{
      return 'rtl';
    }
	}
}

if (!function_exists('datatable_lang')) {
	function datatable_lang() {
		return ['sProcessing' => trans('admin.sProcessing'),
			'sLengthMenu'        => trans('admin.sLengthMenu'),
			'sZeroRecords'       => trans('admin.sZeroRecords'),
			'sEmptyTable'        => trans('admin.sEmptyTable'),
			'sInfo'              => trans('admin.sInfo'),
			'sInfoEmpty'         => trans('admin.sInfoEmpty'),
			'sInfoFiltered'      => trans('admin.sInfoFiltered'),
			'sInfoPostFix'       => trans('admin.sInfoPostFix'),
			'sSearch'            => trans('admin.sSearch'),
			'sUrl'               => trans('admin.sUrl'),
			'sInfoThousands'     => trans('admin.sInfoThousands'),
			'sLoadingRecords'    => trans('admin.sLoadingRecords'),
			'oPaginate'          => [
				'sFirst'            => trans('admin.sFirst'),
				'sLast'             => trans('admin.sLast'),
				'sNext'             => trans('admin.sNext'),
				'sPrevious'         => trans('admin.sPrevious'),
			],
			'oAria'            => [
				'sSortAscending'  => trans('admin.sSortAscending'),
				'sSortDescending' => trans('admin.sSortDescending'),
			],
		];
	}
}

if (!function_exists('v_image')) {
	function v_image($ext = null) {
		if ($ext === null) {
			return 'image|mimes:jpg,jpeg,png,gif,bmp';
		} else {
			return 'image|mimes:'.$ext;
		}

	}
}

if (!function_exists('up')) {
	function up() {
		return new \App\Http\Controllers\Upload;
	}
}

if (!function_exists('load_dep')) {
	function load_dep($select = null, $dep_hide = null) {

		$departments = \App\Model\Department::selectRaw('dep_name_'.lang().' as text')
			->selectRaw('id as id')
			->selectRaw('parent as parent')
			->get(['text', 'parent', 'id']);
		$dep_arr = [];
		foreach ($departments as $department) {
			$list_arr             = [];
			$list_arr['icon']     = '';
			$list_arr['li_attr']  = '';
			$list_arr['a_attr']   = '';
			$list_arr['children'] = [];

			if ($select !== null and $select == $department->id) {

				$list_arr['state'] = [
					'opened'   => true,
					'selected' => true,
					'disabled' => false,
				];
			}

			if ($dep_hide !== null and $dep_hide == $department->id) {

				$list_arr['state'] = [
					'opened'   => false,
					'selected' => false,
					'disabled' => true,
					'hidden'   => true,
				];
			}

			$list_arr['id']     = $department->id;
			$list_arr['parent'] = $department->parent > 0?$department->parent:'#';
			$list_arr['text']   = $department->text;
			array_push($dep_arr, $list_arr);
		}

		return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
	}
}
if (!function_exists('get_parent')) {
	function get_parent($dep_id) {
		$department = \App\Model\Department::findOrFail($dep_id);
    if($department->parent !== null && $department->parent > 0 ){
      return get_parent($department->parent) . ',' . $dep_id;
    }else{
      return $dep_id;
    }
    // return json_encode($dep_arr, JSON_UNESCAPED_UNICODE);
	}
}

if(!function_exists('get_dep')){
  function get_dep($select = null,$dep_hide = null) {
    $dprtmnts=App\Model\Department::selectRaw('dep_name_'.session('lang').' as text')
    ->selectRaw('id as id')
    ->selectRaw('parent as parent')
    ->selectRaw('icon as icon')
    ->get(['text', 'parent', 'id','icon']);
    $data=[];
    $obj=[];
    foreach ($dprtmnts as $key => $dprtmnt) {
      // $obj['icon']     = Storage::url($dprtmnt->icon);
      // $obj['icon']     = "'<i class='fa fa-tags'></i>'";
      // $obj['icon']     = "glyphicon glyphicon-plus";
      $obj['icon']     = "";
			$obj['li_attr']  = '';
			$obj['a_attr']   = '';
			$obj['children'] = [];
      if($select !== null && $select==$dprtmnt->id){
        $obj['state']=[
          'opend'   =>true,
          'selected'=>true,
          'disabled' => false,
        ];
      }else{
        $obj['state']=[
        'opend'   =>false,
        'selected'=>false,
        // 'disabled' => true,
        ];
      }
      if ($dep_hide !== null and $dep_hide == $dprtmnt->id) {

				$obj['state'] = [
					'opened'   => false,
					'selected' => false,
					'disabled' => true,
					'hidden'   => true,
				];
			}
      $dprtmnt->parent = $dprtmnt->parent ? $dprtmnt->parent :'#';
      $obj['id']=$dprtmnt->id;
      $obj['text']=$dprtmnt->text;
      $obj['parent']=$dprtmnt->parent;
      array_push($data,$obj);
    }
    return json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
/////// Scan Mall Id Exists /////
if (!function_exists('check_mall')) {
	function check_mall($id, $pid) {
		return \App\Model\MallProduct::where('product_id', $pid)->where('mall_id', $id)->count() > 0?true:false;
	}
}
if (!function_exists('relation_id')) {
  function relation_id($table,$id,$column=null,$lang=null)
  {
    if($column){
      return DB::table($table)
      ->where('id',$id)
      ->first();
    }else{
      return DB::table($table)
      ->where('id',$id)
      ->value('country_name_ar');
    }
  }
}