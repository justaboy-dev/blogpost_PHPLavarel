<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function edit_about_us()
    {
        $settings = Setting::all();
        return view('admin.setting.edit_about_us', compact('settings'));
    }
    public function update_about_us(Request $request)
    {
        $rule = [
            'about_tittle' => 'required|min:3',
            'about_description' => 'required|min:3',
            'about_image' => 'required',
            'about_sub_tittle' => 'required|min:3',
            'about_sub_description' => 'required|min:3',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ];
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $validate = Validator::make(request()->all(), $rule);
        if($validate->fails())
        {
            $data['error'][] = $validate->errors()->first('about_tittle');
            $data['error'][] = $validate->errors()->first('about_description');
            $data['error'][] = $validate->errors()->first('about_image');
            $data['error'][] = $validate->errors()->first('about_sub_tittle');
            $data['error'][] = $validate->errors()->first('about_sub_description');
            $data['error'][] = $validate->errors()->first('address');
            $data['error'][] = $validate->errors()->first('phone');
            $data['error'][] = $validate->errors()->first('email');
            $data['success'] = 0;
            $data['message'] = 'Please check the form again';
        }
        else
        {
            $attribute = $validate->validated();
            if($attribute['about_image'][0] == '/')
            {
                $attribute['about_image'] = substr($attribute['about_image'], 1);
            }
            if(str_contains($attribute['about_image'],'//'))
            {
                $attribute['about_image'] = str_replace('//','/',$attribute['about_image']);
            }
            foreach($attribute as $key => $value)
            {
                $keys[] = $key;
                $values[] = $value;
                Setting::where('key',$key)->update(['value'=>$value]);
            }
            $data['success'] = 1;
            $data['message'] = 'Update success';
        }
        return response()->json($data);
    }
    public function edit_contact_us()
    {
        return view('admin.setting.contact_us');
    }
    public function update_contact_us(Request $request, $id)
    {

    }
}
