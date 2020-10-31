<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Department;
use Illuminate\Http\Request;
use Storage;

class DepartmentsController extends Controller {

	public function index() {
		return view('admin.departments.index', ['title' => trans('admin.departments')]);
	}

	public function create() {
		return view('admin.departments.create', ['title' => trans('admin.add')]);
	}

	public function store() {

		$data = $this->validate(request(),
			[
				'dep_name_ar' => 'required',
				'dep_name_en' => 'required',
				'parent'      => 'sometimes|nullable|numeric',
				'icon'        => 'sometimes|nullable|'.v_image(),
				'description' => 'sometimes|nullable',
				'keyword'     => 'sometimes|nullable',

			], [], [
				'dep_name_ar' => trans('admin.dep_name_ar'),
				'dep_name_en' => trans('admin.dep_name_en'),
				'parent'      => trans('admin.parent'),
				'icon'        => trans('admin.icon'),
				'description' => trans('admin.description'),
				'keyword'     => trans('admin.keyword'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => '',
				]);
		}

		Department::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('departments'));
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$department = Department::find($id);
		$title      = trans('admin.edit');
		return view('admin.departments.edit', compact('department', 'title'));
	}

	public function update(Request $r, $id) {

		$data = $this->validate(request(),
			[
				'dep_name_ar' => 'required',
				'dep_name_en' => 'required',
				'parent'      => 'sometimes|nullable|numeric',
				'icon'        => 'sometimes|nullable',
				'description' => 'sometimes|nullable',
				'keyword'     => 'sometimes|nullable',

			], [], [
				'dep_name_ar' => trans('admin.dep_name_ar'),
				'dep_name_en' => trans('admin.dep_name_en'),
				'parent'      => trans('admin.parent'),
				'icon'        => trans('admin.icon'),
				'description' => trans('admin.description'),
				'keyword'     => trans('admin.keyword'),
			]);

		if (request()->hasFile('icon')) {
			$data['icon'] = up()->upload([
					'file'        => 'icon',
					'path'        => 'departments',
					'upload_type' => 'single',
					'delete_file' => Department::find($id)->icon,
				]);
		}

		Department::where('id', $id)->update($data);
		session()->flash('success', trans('admin.updated_record'));
		return redirect(aurl('departments'));
	}

	public static function delete_parent($id) {
		$department_parent = Department::where('parent', $id)->get();
		foreach ($department_parent as $sub) {
			self::delete_parent($sub->id);
			if (!empty($sub->icon)) {
				Storage::has('public/' . $sub->icon)?Storage::delete('public/' . $sub->icon):'';
			}
			$subdepartment = Department::find($sub->id);
			if (!empty($subdepartment)) {
				$subdepartment->delete();
			}
		}
		$dep = Department::find($id);

		if (!empty($dep->icon)) {
			Storage::has('public/' . $dep->icon)?Storage::delete('public/' . $dep->icon):'';
		}
		$dep->delete();
	}

	public function destroy($id) {
		self::delete_parent($id);
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('departments'));
	}
}
