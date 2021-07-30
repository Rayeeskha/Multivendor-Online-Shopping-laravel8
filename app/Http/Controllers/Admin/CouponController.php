<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
	public function index(){
		if(session()->get('ADMIN_ROLE') == 'admin'){
            $data['coupon'] = Coupon::all();
        }else{
            $data['coupon']=DB::table('coupons')
                ->where(['seller_id'=>session()->get('ADMIN_ID')])
                ->get(); 
        }
		return view('admin/coupon', $data);
	}

	public function manage_coupon(Request $request, $id = ""){
		if($id > 0){
			$arr = Coupon::where(['id'	=> $id])->get();
			$result['title'] = $arr[0]->title;
			$result['code'] = $arr[0]->code;
			$result['value'] = $arr[0]->value;
			$result['coupon_type'] = $arr[0]->coupon_type;
			$result['min_order_amnt'] = $arr[0]->min_order_amnt;
			$result['is_one_time'] = $arr[0]->is_one_time;
			$result['expirydate'] = $arr[0]->expirydate;
			$result['id'] = $arr[0]->id;
		}else{
			$result['title'] = "";
			$result['code'] = "";
			$result['value'] = "";
			$result['coupon_type'] = "";
			$result['min_order_amnt'] = "";
			$result['is_one_time'] = "";
			$result['expirydate'] = "";
			$result['id'] = 0;
		}
		return view('admin/manage_coupon', $result);
	}

	public function managecouponprocess(Request $request ){
		$request->validate([
            'title'     => 'required',
            'code'      => 'required|unique:coupons,code,'.$request->post('id'),
            'value'     => 'required',
            'expirydate'    => 'required',
        ]);
		
		if ($request->post('id') > 0) {
			$model = Coupon::find($request->post('id'));
			$msg = "Coupon Updated Successfully";
		}else{
			$model = new Coupon();
			$msg = "Coupon Inserted Successfully";
		}

		if(session()->get('ADMIN_ROLE') == 'admin'){
            $model->seller_id =  1;
        }else{
            $model->seller_id =  session()->get('ADMIN_ID');
        }

		$model->title =  $request->post('title');
		$model->code  =  $request->post('code');
		$model->value =  $request->post('value');
		$model->coupon_type =  $request->post('coupon_type');
		$model->min_order_amnt =  $request->post('min_order_amnt');
		$model->is_one_time =  $request->post('is_one_time');
		$model->expirydate =  $request->post('expirydate');
		$model->save();
		$request->session()->flash('message', $msg);
		return redirect('admin/coupon');
	}

	public function delete(Request $request, $id){
		$data =  $id;
		$model = Coupon::find($id);
		$model->delete();
		$request->session()->flash('message', 'Coupon Deleted Successfully');
		return redirect('admin/coupon');
	}

	public function changecouponstatus(Request $request, $id, $status){
		$model = Coupon::find($id);
		$model->status =  $status;
		$model->save();
		$request->session()->flash('message', 'Coupon Status Updated Successfully');
		return redirect('admin/coupon');
	}


}