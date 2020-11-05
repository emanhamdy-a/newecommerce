<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Manufactures;
use Illuminate\Http\Request;
use Storage;

class ManufacturesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Manufactures $trade) {
		$Manufactures=Manufactures::orderBy('id','DESC')->get();
		return view('admin.manufactures.index', ['title' => trans('admin.manufactures'),'manufactures'=>$Manufactures]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.manufactures.create', ['title' => trans('admin.add')]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store() {

		$data = $this->validate(request(),
			[
				'name_ar'      => 'required',
				'name_en'      => 'required',
				'mobile'       => 'required|numeric',
				'email'        => 'required|email',
				'address'      => 'sometimes|nullable',
				'facebook'     => 'sometimes|nullable|url',
				'twitter'      => 'sometimes|nullable|url',
				'website'      => 'sometimes|nullable|url',
				'contact_name' => 'sometimes|nullable|string',
				'lat'          => 'sometimes|nullable',
				'lng'          => 'sometimes|nullable',
				'icon'         => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar'      => trans('admin.name_ar'),
				'name_en'      => trans('admin.name_en'),
				'mobile'       => trans('admin.mobile'),
				'email'        => trans('admin.email'),
				'address'      => trans('admin.address'),
				'facebook'     => trans('admin.facebook'),
				'twitter'      => trans('admin.twitter'),
				'website'      => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'          => trans('admin.lat'),
				'lng'          => trans('admin.lng'),
				'icon'         => trans('admin.icon'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'manufactures',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Manufactures::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('manufactures'));
	}


	public function show($id) {
		//
	}

	public function edit($id) {
		$manufact = Manufactures::find($id);
		$title    = trans('admin.edit');
		return view('admin.manufactures.edit', compact('manufact', 'title'));
	}

	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'name_ar'      => 'required',
				'name_en'      => 'required',
				'mobile'       => 'required|numeric',
				'email'        => 'required|email',
				'address'      => 'sometimes|nullable',
				'facebook'     => 'sometimes|nullable|url',
				'twitter'      => 'sometimes|nullable|url',
				'website'      => 'sometimes|nullable|url',
				'contact_name' => 'sometimes|nullable|string',
				'lat'          => 'sometimes|nullable',
				'lng'          => 'sometimes|nullable',
				'icon'         => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar'      => trans('admin.name_ar'),
				'name_en'      => trans('admin.name_en'),
				'address'      => trans('admin.address'),
				'mobile'       => trans('admin.mobile'),
				'email'        => trans('admin.email'),
				'facebook'     => trans('admin.facebook'),
				'twitter'      => trans('admin.twitter'),
				'website'      => trans('admin.website'),
				'contact_name' => trans('admin.contact_name'),
				'lat'          => trans('admin.lat'),
				'lng'          => trans('admin.lng'),
				'icon'         => trans('admin.icon'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'manufactures',
					'upload_type' => 'single',
					'delete_file' => Manufactures::find($id)->icon,
				]);
		}

		Manufactures::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('manufactures'));
	}


	public function destroy($id) {
		$manufactures = Manufactures::find($id);
		Storage::delete('public/' . $manufactures->icon);
		$manufactures->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('manufactures'));
	}
	public function delete($id) {
		$manufactures = Manufactures::find($id);
		if($manufactures->icon){
			Storage::delete('public/' . $manufactures->icon);
		}
		return $manufactures->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('manufactures'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$manufactures = Manufactures::find($id);
				if($manufactures->icon){
					Storage::delete('public/' . $manufactures->icon);
				}
				$manufactures->delete();
			}
		} else {
			$manufactures = Manufactures::find(request('item'));
			if($manufactures->icon){
				Storage::delete('public/' . $manufactures->icon);
			}
			$manufactures->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('manufactures'));
	}
}
