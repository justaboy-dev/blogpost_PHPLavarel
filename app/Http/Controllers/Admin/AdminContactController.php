<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use DB;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }
    public function destroy($id)
    {
        $data = array();
        DB::beginTransaction();
        $contact = Contact::find($id);
        if($contact)
        {
            $contact->delete();
            DB::commit();
            $data['success'] = 1;
            $data['message'] = 'Delete contact successfully';
        }
        else
        {
            DB::rollBack();
            $data['status'] = 0;
            $data['message'] = 'Delete contact failed';
        }
        return response()->json($data);
    }
}
