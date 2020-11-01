<?php
namespace App\Http\Controllers\Admin;
// use App\DataTables\UsersDatatable;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {
  // sDatatable
	public function index(User $admin) {
    // return $admin->render('admin.users.index', ['title' => trans('admin.users')]);
    $users = User::all();
    return view('admin.users.index', ['title' => trans('admin.users'),
    'users' => $users]);
	}

	public function create() {
		return view('admin.users.create', ['title' => trans('admin.add')]);
	}

	public function store() {
		$data = $this->validate(request(),
			[
				'name'     => 'required',
				'level'    => 'required|in:user,company,vendor', //user / company / vendor
				'email'    => 'required|email|unique:users',
				'password' => 'required|min:6'
			], [], [
				'name'     => trans('admin.name'),
				'level'    => trans('admin.level'),
				'email'    => trans('admin.email'),
				'password' => trans('admin.password'),
			]);
		$data['password'] = bcrypt(request('password'));
		User::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('users'));
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$user  = User::find($id);
		$title = trans('admin.edit');
		return view('admin.users.edit', compact('user', 'title'));
	}

	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'name'     => 'required',
				'level'    => 'required|in:user,company,vendor',
				'email'    => 'required|email|unique:users,email,'.$id,
				'password' => 'sometimes|nullable|min:6'
			], [], [
				'name'     => trans('admin.name'),
				'level'    => trans('admin.level'),
				'email'    => trans('admin.email'),
				'password' => trans('admin.password'),
			]);
		if (request()->has('password')) {
			$data['password'] = bcrypt(request('password'));
		}
		User::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('users'));
	}

	public function destroy($id) {
    dd($id);
		User::find($id)->delete();
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('users'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			User::destroy(request('item'));
		} else {
			User::find(request('item'))->delete();
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('users'));
	}
}
