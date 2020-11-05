<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Model\Currency;
use Illuminate\Http\Request;

class CurrenciesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Currency $currency) {
		$currencies=Currency::orderBy('id','DESC')->get();
		return view('admin.currencies.index', ['title' => trans('admin.currencies'),'currencies'=>$currencies]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.currencies.create', ['title' => trans('admin.create_currencies')]);
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
				'currency_name_ar' => 'required',
				'currency_name_en' => 'required',
				'currency_code'   => 'required',

			], [], [
				'currency_name_ar' => trans('admin.currency_name_ar'),
				'currency_name_en' => trans('admin.currency_name_en'),
				'currency_code'   => trans('admin.currency_code'),

			]);

		Currency::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('currencies'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$title   = trans('admin.edit');
		$currency = Currency::find($id);
		return view('admin.currencies.edit',
		['title' => $title,'currency'=>$currency]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'currency_name_ar' => 'required',
				'currency_name_en' => 'required',
				'currency_code'   => 'required',

			], [], [
				'currency_name_ar' => trans('admin.currency_name_ar'),
				'currency_name_en' => trans('admin.currency_name_en'),
				'currency_code'   => trans('admin.currency_code'),
			]);

		Currency::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('currencies'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$currencies = Currency::findOrfial($id);

		$currencies->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('currencies'));
	}

	public function delete($id) {
		 $currencies = Currency::find($id);
		return $currencies->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('currencies'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$currencies = Currency::find($id);
				$currencies->delete();
			}
		} else {
			$currencies = Currency::find(request('item'));
			$currencies->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('currencies'));
	}
}
