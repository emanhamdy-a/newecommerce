<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\TradeMark;
use Illuminate\Http\Request;
use Storage;

class TradeMarksController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(TradeMark $trade) {
		$trademarks = TradeMark::orderBy('id','DESC')->get();
		return view('admin.trademarks.index', ['title' => trans('admin.trademarks'),
		'trademarks' => $trademarks]);
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.trademarks.create', ['title' => trans('admin.create_trademarks')]);
	}

	public function store() {

		$data = $this->validate(request(),
			[
				'name_ar' => 'required',
				'name_en' => 'required',
				'logo'    => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
				'logo'    => trans('admin.trade_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'trademarks',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		TradeMark::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('trademarks'));
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$trademark = TradeMark::find($id);
		$title     = trans('admin.edit');
		return view('admin.trademarks.edit', compact('trademark', 'title'));
	}

	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'name_ar' => 'required',
				'name_en' => 'required',
				'logo'    => 'sometimes|nullable|'.v_image(),
			], [], [
				'name_ar' => trans('admin.name_ar'),
				'name_en' => trans('admin.name_en'),
				'logo'    => trans('admin.trade_icon'),
			]);

		if (request()->hasFile('logo')) {
			$data['logo'] = up()->upload([
					'file'        => 'logo',
					'path'        => 'trademarks',
					'upload_type' => 'single',
					'delete_file' => TradeMark::find($id)->logo,
				]);
		}

		TradeMark::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('trademarks'));
	}

	public function destroy($id) {
		$trademarks = TradeMark::find($id);
		Storage::delete('public/' . $trademarks->logo);
		$trademarks->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('trademarks'));
	}
	public function delete($id) {
		$trademarks = TradeMark::find($id);
		if($trademarks->logo){
			Storage::delete('public/' . $trademarks->logo);
		}
		return $trademarks->delete();
		
		session()->flash('success', trans('admin.deleted_record'));
		 redirect(aurl('trademarks'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$trademarks = TradeMark::find($id);
				Storage::delete('public/' . $trademarks->logo);
				$trademarks->delete();
			}
		} else {
			$trademarks = TradeMark::find(request('item'));
			Storage::delete('public/' . $trademarks->logo);
			$trademarks->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('trademarks'));
	}
}
