<?php
namespace App\Http\Controllers;

// use App\File;
use App\File;
use Storage;

class Upload extends Controller {

  /*
    'name','size','file','path','full_file','mime_type','file_type','relation_id',
  */

  public static function store_as($data = []) {
    if (in_array('new_name', $data)) {
      $new_name = $data['new_name'] === null?time():$data['new_name'];
    }
    if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {
      Storage::has('public/' . $data['delete_file'])?Storage::delete('public/' . $data['delete_file']):'';
      $string = random_int(000000000,999999999);
      $name = request()->file($data['file'])->getClientOriginalName();
      $path = request()->file($data['file'])
      ->storeAs('public/' . $data['path'], $string .$name);
      return str_replace('public/' , '' , $path);
    }
  }

	public function delete($id) {
    // dd($id);
		$file = File::find($id);
		if (!empty($file)) {
			Storage::has('public/' . $file->full_file)?Storage::delete('public/' . $file->full_file):"";
			$file->delete();
		}
	}

	public function delete_files($product_id) {
		$files = File::where('file_type', 'product')->where('relation_id', $product_id)->get();
		if (count($files) > 0) {
			foreach ($files as $file) {
				$this->delete($file->id);
				Storage::deleteDirectory('public/' . $file->path);
			}
		}
	}

	public function upload($data = []) {

    if (in_array('new_name', $data)) {
      $new_name = null === $data['new_name']?time():$data['new_name'];
		}

		if (request()->hasFile($data['file']) && 'single' == $data['upload_type']) {

      Storage::has('public/' . $data['delete_file'])?Storage::delete('public/' . $data['delete_file']):'';
      return str_replace('public/' , '' , request()->file($data['file'])->store('public/' . $data['path']));

		} elseif (request()->hasFile($data['file']) && 'files' == $data['upload_type']) {
			$file      = request()->file($data['file']);
			$size      = $file->getSize();
			$mime_type = $file->getMimeType();
			$name      = $file->getClientOriginalName();
			$hashname  = $file->hashName();

			$file->store('public/' . $data['path']);
			$add = File::create([
					'name'        => $name,
					'size'        => $size,
					'file'        => $hashname,
					'path'        => $data['path'],
					'full_file'   => $data['path'].'/'.$hashname,
					'mime_type'   => $mime_type,
					'file_type'   => $data['file_type'],
					'relation_id' => $data['relation_id'],
				]);
			return $add->id;
		}
	}
}
