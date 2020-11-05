<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Merchant;
use Illuminate\Http\Request;
use Storage;

class MerchantsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Merchant $merchants) {
        $merchants=Merchant::orderBy('id','DESC')->get();
        return view('admin.merchants.index', ['title' => trans('admin.merchants'),'merchants'=>$merchants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.merchants.create', ['title' => trans('admin.add')]);
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
                'country_id'   => 'required|numeric',
                'address'      => 'sometimes|nullable',
                'facebook'     => 'sometimes|nullable|url',
                'twitter'      => 'sometimes|nullable|url',
                'website'      => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat'          => 'sometimes|nullable',
                'lng'          => 'sometimes|nullable',
                'icon'         => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar'      => trans('admin.name_ar'),
                'name_en'      => trans('admin.name_en'),
                'country_id'   => trans('admin.country_id'),
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
                'path'        => 'merchants',
                'upload_type' => 'single',
                'delete_file' => '',
            ]);
        }

        Merchant::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('merchants'));
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
        $merchant  = Merchant::find($id);
        $title = trans('admin.edit');
        return view('admin.merchants.edit', compact('merchant', 'title'));
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
                'name_ar'      => 'required',
                'name_en'      => 'required',
                'mobile'       => 'required|numeric',
                'email'        => 'required|email',
                'country_id'   => 'required|numeric',
                'address'      => 'sometimes|nullable',
                'facebook'     => 'sometimes|nullable|url',
                'twitter'      => 'sometimes|nullable|url',
                'website'      => 'sometimes|nullable|url',
                'contact_name' => 'sometimes|nullable|string',
                'lat'          => 'sometimes|nullable',
                'lng'          => 'sometimes|nullable',
                'icon'         => 'sometimes|nullable|' . v_image(),
            ], [], [
                'name_ar'      => trans('admin.name_ar'),
                'name_en'      => trans('admin.name_en'),
                'country_id'   => trans('admin.country_id'),
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
                'path'        => 'merchants',
                'upload_type' => 'single',
                'delete_file' => Merchant::find($id)->icon,
            ]);
        }

        Merchant::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('merchants'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $merchants = Merchant::find($id);
        Storage::delete('public/' . $merchants->icon);
        $merchants->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('merchants'));
    }
    public function delete($id) {
        $merchants = Merchant::find($id);
        if($merchants->icon){
            Storage::delete('public/' . $merchants->icon);
        }
        $merchants->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('merchants'));
    }

    public function multi_delete() {
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $merchants = Merchant::find($id);
                Storage::delete('public/' . $merchants->icon);
                $merchants->delete();
            }
        } else {
            $merchants = Merchant::find(request('item'));
            Storage::delete('public/' . $merchants->icon);
            $merchants->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('merchants'));
    }
}
