<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
     public function index(){
        $data['customers'] = Customers::all();
        return view('admin/customers', $data);
    }

    public function show(Request $request, $id = ""){
        if($id > 0){
            $data = Customers::where(['id'  => $id])->get();
            $result['customer_list'] = $data[0];
        }
        return view('admin/show_customers', $result);
    }

 

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Customers::find($id);
        $model->delete();
        $request->session()->flash('message', 'Customer Deleted Successfully');
        return redirect('admin/customers');
    }

    public function changecustomersstatus(Request $request, $id, $status){
        $model = Customers::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Customers Status Updated Successfully');
        return redirect('admin/customers');
    }

}
