<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Storage;

class HomeBannerController extends Controller
{
   public function index(){
        $data['banners'] = HomeBanner::all();
        return view('admin/banners', $data);
    }

    public function manage_home_banner(Request $request, $id = ""){
        if($id > 0){
            $arr = HomeBanner::where(['id'    => $id])->get();
            $result['image'] = $arr[0]->image;
            $result['btn_text'] = $arr[0]->btn_txt;
            $result['btn_link'] = $arr[0]->btn_link;
            $result['btn_title'] = $arr[0]->btn_title;
            $result['btn_disc'] = $arr[0]->btn_disc;
            $result['id'] = $arr[0]->id;
        }else{
            $result['image'] = "";
            $result['btn_text'] = "";
            $result['btn_link'] = "";
            $result['btn_title'] = "";
            $result['btn_disc'] = "";
            $result['id'] = 0;
        }
        return view('admin/manage_home_banner', $result);
    }

    public function managehome_bannerprocess(Request $request ){
        if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        }else{
            $image_validation = "required|mimes:jpeg,jpg,png";
        }
        $request->validate([
            'image' =>  $image_validation,
        ]);
        

        if ($request->post('id') > 0) {
            $model = HomeBanner::find($request->post('id'));

            $msg = "Banner  Updated Successfully";
        }else{
            $model = new HomeBanner();
            $msg = "Banner Inserted Successfully";
        }

        

        if ($request->hasfile('image')) {
            if ($request->post('id') > 0) {
                $arrImage = DB::table('home_banners')->where(['id' => $request->post('id')])->get();
                if (Storage::exists('/public/banner/'.$arrImage[0]->image)) {
                   Storage::delete('/public/banner/'.$arrImage[0]->image);
                }
            }
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/banner/', $image_name); 
            $model->image =  $image_name;
        }

      $model->btn_txt   =  $request->post('btn_text');
        $model->btn_link =  $request->post('btn_link');
        $model->btn_title =  $request->post('btn_title');
        $model->btn_disc =  $request->post('btn_disc');
        $model->status  = 'Active';
        $model->save();
        $request->session()->flash('message', $msg);
        return redirect('admin/home_banner');
    }

    public function changehome_bannerstatus(Request $request, $id, $status){
        $model = HomeBanner::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Banner Status Updated Successfully');
        return redirect('admin/home_banner');
    }

    public function delete(Request $request, $id){
        $data =  $id;
        $model = HomeBanner::find($id);
        $model->delete();
        $request->session()->flash('message', 'Banner Deleted Successfully');
        return redirect('admin/home_banner');
    }
}
