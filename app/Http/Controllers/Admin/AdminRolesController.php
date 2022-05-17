<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use DB;

class AdminRolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.role.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = array();
        $data['success'] = 0;
        $data['error'] = [];
        $rule = [
            'name' => 'required|unique:roles,name',
        ];
        $validator = Validator::make($request->all(), $rule);
        if($validator->fails())
        {
            $data['error'] = $validator->errors()->first('name');
            $data['message'] = 'Role name is required and unique';
            DB::rollback();
        }
        else
        {
            $role = Role::create(['name' => $request->name]);
            if(json_decode($request->permission))
            {
                $role->permissions()->sync($request->permission);
            }
            $role->save();
            DB::commit();
            $data['success'] = 1;
            $data['message'] = 'Role created successfully';
        }
        return response()->json($data);
    }
    public function show($id)
    {
        $users = User::where('role_id', $id)->get();
        return view('admin.user.index', compact('users'));
    }
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        return view('admin.role.edit', compact('role', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $data = array();
        $data['success'] = 0;
        $data['error'] = [];
        $rule = [
            'name' => 'required|unique:roles,name,'.$id,
        ];
        $validator = Validator::make($request->all(), $rule);

        if($validator->fails())
        {
            $data['error'][] = $validator->errors()->first('name');
            $data['message'] = 'Role name is required and unique';
            DB::rollback();
        }
        else
        {
            $role = Role::find($id);
            $role->update([
                'name' => $request->name,
            ]);
            if($request->permission)
            {
                $role->permissions()->sync($request->permission);
            }
            else
            {
                $role->permissions()->detach();
            }
            $role->save();
            DB::commit();
            $data['success'] = 1;
            $data['message'] = 'Role update successfully';
        }
        return response()->json($data);
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        $data = array();
        $data['success'] = 0;
        $data['error'] = [];
        $role = Role::find($id);
        if($role->users()->count() > 0)
        {
            $role_user = Role::where('name', 'user')->first();
            if(!$role_user)
            {
                $role_user = Role::create([
                    'name' => 'user',
                ]);
            }
            foreach($role->users as $user)
            {
                $user->role_id = $role_user->id;
                $user->save();
            }
        }
        $role->delete();
        DB::commit();
        $data['success'] = 1;
        $data['message'] = 'Role deleted successfully';
        return response()->json($data);
    }
}
