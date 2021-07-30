<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
   
   public function index(){
        if(session()->get('ADMIN_ROLE') == 'admin'){
             $data['size'] = Size::all();
        }else{
            $data['size']=DB::table('sizes')
                ->where(['seller_id'=>session()->get('ADMIN_ID')])
                ->get(); 
        }
        return view('admin/size', $data);
    }

    public function manage_size(Request $request, $id = ""){
        if($id > 0){
            $arr = Size::where(['id'  => $id])->get();
            $result['size'] = $arr[0]->size;
            $result['id'] = $arr[0]->id;
        }else{
            $result['size'] = "";
            $result['id'] = 0;
        }
        return view('admin/manage_size', $result);
    }

    public function managesizeprocess(Request $request ){
        $request->validate([
            'size'      => 'required|unique:sizes,size,'.$request->post('id'),
        ]);
        if ($request->post('id') > 0) {
            $model = Size::find($request->post('id'));
            $msg = "Size Updated Successfully";
        }else{
            $model = new Size();
            $msg = "Size Inserted Successfully";
        }
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $model->seller_id =  0;
        }else{
            $model->seller_id =  session()->get('ADMIN_ID');
        }
        $model->size =  $request->post('size');
        $model->status = 'Active';
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/size');
    }

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Size::find($id);
        $model->delete();
        $request->session()->flash('message', 'Size Deleted Successfully');
        return redirect('admin/size');
    }

    public function changesizestatus(Request $request, $id, $status){
        $model = Size::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Size Status Updated Successfully');
        return redirect('admin/size');
    }


}
