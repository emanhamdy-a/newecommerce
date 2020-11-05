<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Weight;
use Illuminate\Http\Request;
use Storage;

class WeightsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Weight $trade)
   {
      $weights=Weight::orderBy('id','DESC')->get();
      return view('admin.weights.index',['title'=>trans('admin.weights'),
      'weights'=>$weights]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      return view('admin.weights.create', ['title' => trans('admin.add')]);
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
            'name_ar' => 'required',
            'name_en' => 'required',

         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),

         ]);

      Weight::create($data);
      session()->flash('success', trans('admin.record_added'));
      return redirect(aurl('weights'));
   }

   public function show($id)
   {
      //
   }


   public function edit($id)
   {
      $weight = Weight::find($id);
      $title  = trans('admin.edit');
      return view('admin.weights.edit', compact('weight', 'title'));
   }

   public function update(Request $r, $id)
   {

      $data = $this->validate(request(),
         [
            'name_ar' => 'required',
            'name_en' => 'required',
         ], [], [
            'name_ar' => trans('admin.name_ar'),
            'name_en' => trans('admin.name_en'),
         ]);

      Weight::where('id', $id)->update($data);
      session()->flash('success', trans('admin.updated_record'));
      return redirect(aurl('weights'));
   }

   public function destroy($id)
   {
      $weights = Weight::find($id);
      $weights->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('weights'));
   }

   public function delete($id)
   {
      $weights = Weight::find($id);
      return $weights->delete();
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('weights'));
   }

   public function multi_delete()
   {
      if (is_array(request('item'))) {
         foreach (request('item') as $id) {
            $malls = Weight::find($id);
            $malls->delete();
         }
      } else {
         $malls = Weight::find(request('item'));
         $malls->delete();
      }
      session()->flash('success', trans('admin.deleted_record'));
      return redirect(aurl('weights'));
   }
}
