<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use App\Models\Image;
use DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
            'status' => ['required'],
            'post_thumb' => ['required'],
        ];
        $validate = Validator::make(request()->all(), $rules);
        if($validate->fails())
        {
            $data['error'][] = $validate->errors()->first('name');
            $data['error'][] = $validate->errors()->first('email');
            $data['error'][] = $validate->errors()->first('password');
            $data['error'][] = $validate->errors()->first('role_id');
            $data['error'][] = $validate->errors()->first('status');
            $data['error'][] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check your input';
            DB::rollback();
        }
        else
        {
            $attributes = $validate->validated();
            $attributes['password'] = Hash::make($attributes['password']);
            $user = User::create($attributes);
            if($attributes['post_thumb'][0] == '/'){
                $attributes['post_thumb'] = substr($attributes['post_thumb'],1);
            }
            $img = explode('/',$attributes['post_thumb']);
            $user->images()->save(Image::create([
                'name' => explode('.',$img[count($img)-1])[0],
                'extension' => explode('.',end($img))[1],
                'path' => $attributes['post_thumb'],
                'imageable_id' => $user->id,
                'imageable_type' => User::class,
            ]));
            $user->save();
            $data['success'] = 1;
            $data['message'] = 'User created successfully';
            DB::commit();
        }
        return response()->json($data);
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
            'status' => ['required'],
            'post_thumb' => ['required'],
        ];
        $validate = Validator::make(request()->all(), $rules);
        if($validate->fails())
        {
            $data['error'][] = $validate->errors()->first('name');
            $data['error'][] = $validate->errors()->first('email');
            $data['error'][] = $validate->errors()->first('password');
            $data['error'][] = $validate->errors()->first('role_id');
            $data['error'][] = $validate->errors()->first('status');
            $data['error'][] = $validate->errors()->first('post_thumb');
            $data['message'] = 'Please check your input';
            DB::rollback();
        }
        else
        {
            $attributes = $validate->validated();
            $attributes['password'] = Hash::make($attributes['password']);
            $user->update($attributes);
            if($attributes['post_thumb'][0] == '/'){
                $attributes['post_thumb'] = substr($attributes['post_thumb'],1);
            }
            $image = Image::where('imageable_id',$user->id)->first();
            $img = explode('/',$attributes['post_thumb']);
            $image->update([
                'name' => explode('.',$img[count($img)-1])[0],
                'extension' => explode('.',end($img))[1],
                'path' => $attributes['post_thumb'],
            ]);
            $user->images()->save($image);
            $user->save();
            $data['success'] = 1;
            $data['message'] = 'User update successfully';
            DB::commit();
        }
        return response()->json($data);
    }
    public function destroy($id)
    {
        // // DB::beginTransaction();
        // // $data = array();
        // $user = User::find($id);
        // // if ($user) {
        // //     $data['message'] = 'Delete user successfully';
        // //     $data['success'] = 1;
        // //     DB::commit();
        // // }
        // // else
        // // {
        // //     $data['message'] = 'Delete user failed';
        // //     $data['success'] = 0;
        // //     DB::rollback();
        // // }
        // return response()->json($user);
    }
}
