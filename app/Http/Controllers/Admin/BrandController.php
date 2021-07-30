<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
   public function index(){
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $data['brands'] = Brand::all();
        }else{
            $data['brands']=DB::table('brands')
                ->where(['seller_id'=>session()->get('ADMIN_ID')])
                ->get(); 
        }
        return view('admin/brand', $data);
    }

    public function manage_brand(Request $request, $id = ""){
        if($id > 0){
            $arr = Brand::where(['id'  => $id])->get();
            $result['name'] = $arr[0]->name;
            $result['image'] = $arr[0]->image;
            $result['is_home'] = $arr[0]->is_home;
            $result['is_home_selected'] = "";
            if ($arr[0]->is_home == 1) {
                $result['is_home_selected'] = "checked";
            }
            $result['id'] = $arr[0]->id;
        }else{
            $result['name'] = "";
            $result['image'] = "";
            $result['is_home_selected'] = "";
            $result['id'] = 0;
        }
        return view('admin/manage_brand', $result);
    }

    public function managebrandprocess(Request $request){
       $id = $request->post('id');
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        }else{
            $image_validation = "mimes:jpeg,jpg,png";
        }
        $request->validate([
            'image'      => $image_validation,
            'name'          => 'required|unique:brands,name,'.$request->post('id'),
        ]);

        if ($id > 0) {
            $model = Brand::find($id);
            $msg = "Brand Updated Successfully";
        }else{
            $model = new Brand();
            $msg = "Brand Inserted Successfully";
        }
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/brands', $image_name); 
            $model->image =  $image_name;
        }

        if(session()->get('ADMIN_ROLE') == 'admin'){
            $model->seller_id = 1;
        }else{
            $model->seller_id =session()->get('ADMIN_ID');
        }

        $model->name =  $request->post('name');
        $model->status = 'Active';
        $model->is_home = 0;
        if ($request->post('is_home') !== null) {
            $model->is_home = 1;
        }
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/brand');
    }

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Brand::find($id);
        $model->delete();
        $request->session()->flash('message', 'Brand Deleted Successfully');
        return redirect('admin/brand');
    }

    public function changebrandsstatus(Request $request, $id, $status){
        $model = Brand::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Brand Status Updated Successfully');
        return redirect('admin/brand');
    }
}
