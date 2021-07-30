<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $data['tax'] = Tax::all();
        return view('admin/tax', $data);
    }

    public function manage_tax(Request $request, $id = ""){
        if($id > 0){
            $arr = Tax::where(['id'  => $id])->get();
            $result['tax_desc'] = $arr[0]->tax_desc;
            $result['tax_value'] = $arr[0]->tax_value;
            $result['id'] = $arr[0]->id;
        }else{
            $result['tax_desc'] = "";
            $result['tax_value'] = "";
            $result['id'] = 0;
        }
        return view('admin/manage_tax', $result);
    }

    public function managetaxprocess(Request $request){
        $id = $request->post('id');
        $request->validate([
            'tax_value'      => 'required|unique:taxes,tax_value,'.$request->post('id'),
            'tax_desc'      => 'required',
        ]);
        if ($id > 0) {
            $model = Tax::find($id);
            $msg = "Tax Updated Successfully";
        }else{
            $model = new Tax();
            $msg = "Tax Inserted Successfully";
        }
        $model->tax_desc =  $request->post('tax_desc');
        $model->tax_value =  $request->post('tax_value');
        $model->status = 'Active';
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/tax');
    }

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Tax::find($id);
        $model->delete();
        $request->session()->flash('message', 'Tax Deleted Successfully');
        return redirect('admin/tax');
    }

    public function changetaxstatus(Request $request, $id, $status){
        $model = Tax::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Tax Status Updated Successfully');
        return redirect('admin/tax');
    }
}
