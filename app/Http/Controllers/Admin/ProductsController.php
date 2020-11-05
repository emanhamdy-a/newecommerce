<?php
namespace App\Http\Controllers\Admin;

use App\File as FileTbl;
use App\Http\Controllers\Controller;
use App\Model\OtherData;
use App\Model\Product;
use App\Model\RelatedProudct;
use App\Model\Size;
use App\Model\Weight;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Str;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResource;
class ProductsController extends Controller {

  public function index(Product $product) {
    $products=Product::orderBy('id','DESC')->get();
    // $products=new ProductResource($productss);
      // $products=new ProductCollection($productss);
		return view('admin.products.index',['title'=>trans('admin.products'),
		'products'=>$products]);
	}

	public function prepare_weight_size() {
    // return get_parent(request('dep_id'));
    // $dep_list = explode(',', get_parent(request('dep_id')));
    // return $dep_list;
    // array_unique();
    $dep_list = array_diff(explode(',', get_parent(request('dep_id'))), [request('dep_id')]);

    if (request()->ajax() and request()->has('dep_id')) {
      $dep_list = array_diff(explode(',', get_parent(request('dep_id'))), [request('dep_id')]);

			$sizes = Size::where('is_public', 'yes')
				->whereIn('department_id', $dep_list)
				->orWhere('department_id', request('dep_id'))
				->pluck('name_'.session('lang'), 'id');

			$weights = Weight::pluck('name_'.session('lang'), 'id');
			return view('admin.products.ajax.size_weight', [
					'sizes'   => $sizes,
					'weights' => $weights,
					'product' => Product::find(request('product_id')),
				])->render();
		} else {
			return 'برجاء اختيار قسم';
		}

    if (request()->ajax() and request()->has('dep_id')) {

			$sizes1 = Size::where('is_public', 'yes')
				->whereIn('department_id', $dep_list)
        ->pluck('name_'.session('lang'), 'id');
			$sizes2 = Size::Where('department_id', request('dep_id'))
        ->pluck('name_'.session('lang'), 'id');
      $sizes=array_merge(json_decode($sizes1,true),json_decode($sizes2,true));

			$weights = Weight::pluck('name_'.session('lang'), 'id');
			return view('admin.products.ajax.size_weight', [
					'sizes'   => $sizes,
					'weights' => $weights,
					'product' => Product::find(request('product_id')),
				])->render();
		} else {
			return 'برجاء اختيار قسم';
    }

	}

	public function create() {
    // $product=Product::findOrFail(1);
		// return view('admin.products.create',compact('product'), ['title' => trans('admin.add')]);
		// return redirect(aurl('products.creat'));
		$product = Product::create(['title' => '']);
		if (!empty($product)) {
			return redirect(aurl('products/'.$product->id.'/edit'));
		}
    return redirect(aurl('products'));
  }

	public function delete_main_image($id) {
    $product = Product::find($id);
    // $folderNm='/' . $id . '/';
    // if($contains = str_contains($product->photo, $folderNm)){
    // }
      Storage::delete('public/' . $product->photo);
      $product->photo = null;
      $product->save();
      //, 'photo' => $product->photo
		return response(['status' => true], 200);
	}

	public function update_product_image($id) {
		$product = Product::where('id', $id)->update([
				'photo'         => up()->upload([
						'file'        => 'file',
						'path'        => 'products/'.$id,
						'upload_type' => 'single',
						'delete_file' => '',
					]),
			]);
		//, 'photo' => $product->photo
		return response(['status' => true], 200);
	}

	public function show($id) {
		//
	}

	public function edit($id) {
		$product = Product::find($id);

		return view('admin.products.product', ['title' => trans('admin.create_or_edit_product', ['title' => $product->title]), 'product' => $product]);
	}

	public function upload_file($id) {
		if (request()->hasFile('file')) {
			$fid = up()->upload([
					'file'        => 'file',
					'path'        => 'products/'.$id,
					'upload_type' => 'files',
					'file_type'   => 'product',
					'relation_id' => $id,
        ]);
      // $photo = Product::findOrFail($id)->photo()->get();
      // Storage::has('public/' . $photo)?Storage::delete('public/' . $photo):'';
			return response(['status' => true, 'id' => $fid], 200);
		}
	}

	public function delete_file() {
		if (request()->has('id')) {
			up()->delete(request('id'));
		}
	}

	public function update($id) {
		$data = $this->validate(request(),
			[
				'title'          => 'required',
				'content'        => 'required',
				'department_id'  => 'required|numeric',
				'trade_id'       => 'required|numeric',
				'manu_id'        => 'required|numeric',
				'color_id'       => 'sometimes|nullable|numeric',
				'size_id'        => 'sometimes|nullable|numeric',
				'size'           => 'sometimes|nullable',
				'currency_id'    => 'sometimes|nullable|numeric',
				'price'          => 'required|numeric',
				'stock'          => 'required|numeric',
				'start_at'       => 'required|date',
				'end_at'         => 'required|date',
				'start_offer_at' => 'sometimes|nullable|date',
				'end_offer_at'   => 'sometimes|nullable|date',
				'price_offer'    => 'sometimes|nullable|numeric',
				'weight'         => 'sometimes|nullable',
				'weight_id'      => 'sometimes|nullable|numeric',
				'status'         => 'sometimes|nullable|in:pending,refused,active',
				'reason'         => 'sometimes|nullable|numeric',
			], [], [
				'title'          => trans('admin.title'),
				'content'        => trans('admin.content'),
				'department_id'  => trans('admin.department_id'),
				'trade_id'       => trans('admin.trade_id'),
				'manu_id'        => trans('admin.manu_id'),
				'color_id'       => trans('admin.color_id'),
				'size_id'        => trans('admin.size_id'),
				'size'           => trans('admin.size'),
				'currency_id'    => trans('admin.currency_id'),
				'price'          => trans('admin.price'),
				'stock'          => trans('admin.stock'),
				'start_at'       => trans('admin.start_at'),
				'end_at'         => trans('admin.end_at'),
				'start_offer_at' => trans('admin.start_offer_at'),
				'end_offer_at'   => trans('admin.end_offer_at'),
				'price_offer'    => trans('admin.price_offer'),
				'weight'         => trans('admin.weight'),
				'weight_id'      => trans('admin.weight_id'),
				'status'         => trans('admin.status'),
				'reason'         => trans('admin.reason'),
			]);


		if (request()->has('related')) {
			RelatedProudct::where('product_id', $id)->delete();
			foreach (request('related') as $related) {
				RelatedProudct::create([
					'product_id'      => $id,
					'related_product' => $related,
				]);
			}
		}
		if (request()->has('input_value') && request()->has('input_key')) {
			$i          = 0;
			// $other_data = '';
			OtherData::where('product_id', $id)->delete();
			foreach (request('input_key') as $key) {
				$data_value = !empty(request('input_value')[$i])?request('input_value')[$i]:'';
        if($key !='' && $key !== null){
          OtherData::create([
              'product_id' => $id,
              'data_key'   => $key,
              'data_value' => $data_value,
            ]);
          $i++;
        }
			}
			// $data['other_data'] = rtrim($other_data, '|');
		}
		Product::where('id', $id)->update($data);
		return response(['status' => true, 'message' => trans('admin.updated_record')], 200);

	}

	public function copy_product($id) {
		if (request()->ajax()) {
			$releation_data = Product::find($id);
			$copy           = Product::find($id)->toArray();
			unset($copy['id']);
			$create = Product::create($copy);
			if (!empty($copy['photo'])) {
				$ext      = \File::extension($copy['photo']);
        $new_path = 'products/'.$create->id.'/'.Str::random(30).'.'.$ext;
        
				\Storage::copy('public/' . $copy['photo'], 'public/'.$new_path);
				$create->photo = $new_path;
        $create->save();
			}
      // return $new_path;

			// Mall Product //

      // Other Data k=>v Product //
      if($releation_data->other_data()){
        foreach ($releation_data->other_data()->get() as $otherdata) {
          OtherData::create([
              'product_id' => $create->id,
              'data_key'   => $otherdata->data_key,
              'data_value' => $otherdata->data_value,
            ]);
        }
      }
			// Other Data k=>v Product //
      if($releation_data->files()){
        foreach ($releation_data->files()->get() as $file) {
          $hashname = Str::random(30);
          $ext      = \File::extension('public/' . $file->full_file);
          $new_path = 'products/'.$create->id.'/'.$hashname.'.'.$ext;
          \Storage::copy('public/' . $file->full_file,'public/'. $new_path);
          // return('public/' . $file->full_file);
          $add = FileTbl::create([
              'name'        => $file->name,
              'size'        => $file->size,
              'file'        => $hashname,
              'path'        => 'products/'.$create->id,
              'full_file'   => 'products/'.$create->id.'/'.$hashname.'.'.$ext,
              'mime_type'   => $file->mime_type,
              'file_type'   => 'product',
              'relation_id' => $create->id,
            ]);
        }
      }

			return response([
					'status'  => true,
					'message' => trans('admin.product_created'),
					'id'      => $create->id,
				], 200);
		} else {
			return redirect(aurl('/'));
		}
	}

	public function deleteProduct($id) {
		$products = Product::find($id);
		!empty($products->photo)?Storage::delete('public/' . $products->photo):'';
		up()->delete_files($id);
		return $products->delete();
	}
	public function destroy($id) {
		//return $id;
		$this->deleteProduct($id);
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('products'));
	}
	public function delete($id) {
		//return $id;
		return $this->deleteProduct($id);
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('products'));
	}

	public function multi_delete() {
		if (is_array(request('item'))) {
			foreach (request('item') as $id) {
				$this->deleteProduct($id);
			}
		} else {
			$this->deleteProduct(request('item'));
		}
		session()->flash('success', trans('admin.deleted_record'));
		return redirect(aurl('products'));
	}

	public function product_search() {
		if (request()->ajax()) {
			if (!empty(request('search')) && request()->has('search')) {
				$related_product = RelatedProudct::where('product_id', request('id'))
					->get(['related_product']);

				$products = Product::where('title', 'LIKE', '%'.request('search').'%')
					->where('id', '!=', request('id'))
					->whereNotIn('id', $related_product)
					->limit(10)
					->orderBy('id', 'desc')
					->get();

				return response(['status' => true,
						'result'                => count($products) > 0?$products:'',
						'count'                 => count($products),
					], 200);
			}
		}
	}
}
