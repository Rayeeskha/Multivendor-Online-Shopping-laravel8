<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorsController extends Controller
{
    public function index(){
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $data['colors'] = Colors::orderBy('id', 'desc')->get();
        }else{
            $data['colors']=DB::table('colors')
                ->where(['seller_id'=>session()->get('ADMIN_ID')])
                ->get(); 
        }
        return view('admin/colors', $data);
    }

    public function manage_colors(Request $request, $id = ""){
        if($id > 0){
            $arr = Colors::where(['id'  => $id])->orderBy('id','desc')->get();
            $result['color'] = $arr[0]->color;
            $result['id'] = $arr[0]->id;
        }else{
            $result['color'] = "";
            $result['size'] = "";
            $result['id'] = 0;
        }
        return view('admin/manage_colors', $result);
    }

    public function managecolorsprocess(Request $request){
        $id = $request->post('id');
        $request->validate([
            'color'      => 'required|unique:colors,color,'.$request->post('id'),
         ]);
        if ($id > 0) {
            $model = Colors::find($id);
            $msg = "Colors Updated Successfully";
        }else{
            $model = new Colors();
            $msg = "Colors Inserted Successfully";
        }
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $model->seller_id =  1;
        }else{
            $model->seller_id =  session()->get('ADMIN_ID');
        }
        $model->color =  $request->post('color');
        $model->status = 'Active';
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/colors');
    }

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Colors::find($id);
        $model->delete();
        $request->session()->flash('message', 'Colors Deleted Successfully');
        return redirect('admin/colors');
    }

    public function changecolorsstatus(Request $request, $id, $status){
        $model = Colors::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Colors Status Updated Successfully');
        return redirect('admin/colors');
    }

   
}
