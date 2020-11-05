<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Validation\ValidationException;
class AdminController extends Controller {

	public function index(Admin $admin) {
    $admins = Admin::orderBy('id','DESC')->get();
    return view('admin.admins.index', ['title' => trans('admin.admins'),
    'admins' => $admins]);
	}

	public function create() {
		return view('admin.admins.create', ['title' => trans('admin.create_admin')]);
	}

	public function store() {

		$data =$this->validate(request(),
    [
				'name'     => 'required',
				'email'    => 'required|email|unique:admins,email',
				'password' => 'required|min:6'
			], [], [
        'name'     => trans('admin.name'),
				'email'    => trans('admin.email'),
				'password' => trans('admin.password'),
        ]);
		$data['password'] = bcrypt(request('password'));
		Admin::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('admins'));
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
		$admin = Admin::find($id);
		$title = trans('admin.edit');
		return view('admin.admins.edit', compact('admin', 'title'));
	}

	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'name'     => 'required',
				'email'    => 'required|email|unique:admins,email,'.$id,
				'password' => 'sometimes|nullable|min:6'
			], [], [
				'name'     => trans('admin.name'),
				'email'    => trans('admin.email'),
				'password' => trans('admin.password'),
			]);
		if (request()->has('password')) {
			$data['password'] = bcrypt(request('password'));
		}
		Admin::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('admins'));
  }

	public function destroy($id) {
		Admin::find($id)->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('admins'));
	}
  public function delete($id) {
    return Admin::find($id)->delete();
    session()->flash('success', trans('admin.deleted_record'));
    return redirect(aurl('users'));
  }
	public function multi_delete() {
    // dd(request('item'));
		if (is_array(request('item'))) {
			Admin::destroy(request('item'));
		} else {
			Admin::find(request('item'))->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('admins'));
	}
}
