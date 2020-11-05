<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Country;
use Illuminate\Http\Request;
use Storage;

class CountriesController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Country $country)
   {
    $countries = Country::orderBy('id','DESC')->get();
    return view('admin.countries.index', ['title' => trans('admin.countries'),
    'countries' => $countries]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.countries.create', ['title' => trans('admin.create_countries')]);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store()
   {

      $data = $this->validate(request(),
         [
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob'             => 'required',
            'code'            => 'required',
            'currency_ar'     => 'required',
            'currency_en'     => 'required',
            'logo'            => 'sometimes|nullable|' . v_image(),
         ], [], [
            'country_name_ar' => trans('admin.country_name_ar'),
            'country_name_en' => trans('admin.country_name_en'),
            'mob'             => trans('admin.mob'),
            'code'            => trans('admin.code'),
            'currency_ar'        => trans('admin.currency_ar'),
            'currency_en'        => trans('admin.currency_en'),
            'logo'            => trans('admin.country_flag'),
         ]);
            // dd($data);
      if (request()->hasFile('logo')) {
         $data['logo'] = up()->upload([
            'file'        => 'logo',
            'path'        => 'countries',
            'upload_type' => 'single',
            'delete_file' => '',
         ]);
      }

      Country::create($data);
      session()->flash('success', trans('admin.record_added'));
      return redirect(aurl('countries'));
   }


   public function show($id)
   {
      //
   }

   public function edit($id)
   {
      $country = Country::find($id);
      $title   = trans('admin.edit');
      return view('admin.countries.edit', compact('country', 'title'));
   }

   public function update(Request $r, $id)
   {

      $data = $this->validate(request(),
         [
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob'             => 'required',
            'code'            => 'required',
            'currency_ar'        => 'required',
            'currency_en'        => 'required',
            'logo'            => 'sometimes|nullable|' . v_image(),
         ], [], [
            'country_name_ar' => trans('admin.country_name_ar'),
            'country_name_en' => trans('admin.country_name_en'),
            'mob'             => trans('admin.mob'),
            'code'            => trans('admin.code'),
            'currency_ar'        => trans('admin.currency_en'),
            'currency_en'        => trans('admin.currency_en'),
            'logo'            => trans('admin.logo'),
         ]);

      if (request()->hasFile('logo')) {
         $data['logo'] = up()->upload([
            'file'        => 'logo',
            'path'        => 'countries',
            'upload_type' => 'single',
            'delete_file' => Country::find($id)->logo,
         ]);
      }

      Country::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated_record'));
      return redirect(aurl('countries'));
   }


   public function destroy($id)
   {
      $countries = Country::find($id);
      if($countries->logo){
        Storage::delete('public/' . $countries->logo);
      }
      $countries->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('countries'));
   }

   public function delete($id) {
    $countries = Country::find($id);
    if($countries->logo){
      Storage::delete('public/' . $countries->logo);
    }
    return $countries->delete();
    session()->flash('success', trans('admin.deleted_record'));
    return redirect(aurl('countries'));
  }

   public function multi_delete()
   {
      if (is_array(request('item'))) {
         foreach (request('item') as $id) {
            $countries = Country::find($id);
            if($countries->logo){
              Storage::delete('public/' . $countries->logo);
            }
            $countries->delete();
         }
      } else {
         $countries = Country::find(request('item'));
         Storage::delete('public/' . $countries->logo);
         $countries->delete();
      }
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('countries'));
   }
}
