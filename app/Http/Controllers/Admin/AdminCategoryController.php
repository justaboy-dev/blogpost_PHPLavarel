<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Image;
use DB;

class AdminCategoryController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->has('per_page') ? $request->get('per_page') : 10;
        $categories = Category::when($request->has("name"),function($q)use($request){
            return $q->where("name","like","%".$request->get("name")."%");
        })->get();
        if($request->ajax()) {
            return view('admin_dashboard.category.paginate', compact('categories'))->render();
        }
        return view('admin_dashboard.category.index', compact('categories'));
    }
    public function create()
    {
        return view('admin_dashboard.category.create');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'name' => 'required|min:3|max:255',
            'slug' => 'required|unique:categories',
            'category_thumb' => 'required',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            $data['error'][] = $validate->errors()->first('name');
            $data['error'][] = $validate->errors()->first('slug');
            $data['error'][] = $validate->errors()->first('category_thumb');
            $data['message'] = 'Please check the form again';
            DB::rollback();
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            $category = Category::create($attribute);

            $img = explode('/',$attribute['category_thumb']);

            $data =

            $category->images()->save(Image::create([
                'imageable_id' => $category->id,
                'name' => explode('.',$img[count($img)-1])[0],
                'extension' => explode('.',end($img))[1],
                'path' => $attribute['category_thumb'],
                'imageable_type' => Category::class,
            ]));
            $category->save();
            $data['success'] = 1;
            $data['message'] = 'Create category successfully';
            DB::commit();
        }
        return response()->json($data);
    }
    public function show($id)
    {
        //
    }
    public function edit(Category $category)
    {
        // dd($category->images);
        return view('admin_dashboard.category.edit', compact('category'));
    }
    public function update(Request $request,Category $category)
    {
        DB::beginTransaction();
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'name' => 'required|min:3|max:255',
            'slug' => 'required|unique:categories,slug,' . $category->id,
            'category_thumb' => 'required',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            $data['error'][] = $validate->errors()->first('name');
            $data['error'][] = $validate->errors()->first('slug');
            $data['error'][] = $validate->errors()->first('category_thumb');
            $data['message'] = 'Please check the form again';
            DB::rollback();
        } else {
            $attribute = $validate->validated();
            $attribute['user_id'] = auth()->user()->id;
            $category->update($attribute);

            if($attribute['category_thumb'][0] == '/'){
                $attribute['category_thumb'] = substr($attribute['category_thumb'],1);
            }
            $image = Image::where('imageable_id',$category->id)->first();
            $img = explode('/',$attribute['category_thumb']);
            $image->update([
                'name' => explode('.',$img[count($img)-1])[0],
                'extension' => explode('.',end($img))[1],
                'path' => $attribute['category_thumb'],
            ]);

            $category->images()->save($image);
            $category->save();
            $data['success'] = 1;
            $data['message'] = 'Update category successfully';
            DB::commit();
        }
        return response()->json($data);
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        $data = array();
        $uncategoried = Category::where('name', 'Uncategorized')->first()->id;
        if (!$uncategoried) {
            $uncategoried = Category::create(['name' => 'Uncategorized'])->id;
        }
        $category = Category::find($id);
        $category->posts()->update(['category_id' => $uncategoried]);
        if ($category->delete()) {
            $data['message'] = 'Delete category successfully';
            $data['success'] = 1;
            DB::commit();
        }
        else
        {
            $data['message'] = 'Delete post failed';
            $data['success'] = 0;
            DB::rollBack();
        }
        return response()->json($data);
    }
}
