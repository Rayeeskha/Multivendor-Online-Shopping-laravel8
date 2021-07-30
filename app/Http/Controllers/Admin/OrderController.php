<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index(){
		if(session()->get('ADMIN_ROLE') == 'admin'){
            $result['orders']=get_all_orders();
        }else{
            $result['orders']=get_all_orders();
        }
        return view('admin.orders', $result);
	}

	 public function order_detail(Request $request, $order_id){
        $result['orders_details']=
                DB::table('order_details')
                ->select('orders.*','order_details.price','order_details.qty','products.name as pname','products_attr.attr_image','sizes.size','colors.color','orders_status.order_status')
                ->leftJoin('orders','orders.order_id','=','order_details.order_id')
                ->leftJoin('products_attr','products_attr.id','=','order_details.products_attr_id')
                ->leftJoin('products','products.id','=','products_attr.products_id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('orders_status','orders_status.order_status','=','orders.order_status')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['orders.order_id'=>$order_id])
               ->get();

        $result['order_status'] = DB::table('orders_status')->get();
        $result['payment_status']= ['Pending', 'Success', 'Failed'];      
        return view('admin.order_detail', $result);
    }


    public function update_payment_status(Request $request, $order_id, $status){
    	DB::table('orders')->where(['order_id'=>$order_id])->update(['payment_status'=> $status]);
    	return redirect('/admin/order_detail/'.$order_id);
    }
    
    public function update_order_status(Request $request, $order_id, $status){
    	DB::table('orders')->where(['order_id'=>$order_id])->update(['order_status'=> $status]);
    	return redirect('/admin/order_detail/'.$order_id);
    }

    
    public function update_track_detail(Request $request, $order_id){

    	$track_details = $request->post('track_details');
    	DB::table('orders')->where(['order_id'=>$order_id])->update(['track_details'=> $track_details]);
    	return redirect('/admin/order_detail/'.$order_id);
    }

    public function Searchorder(){
        $order_id = $_GET['order_id'];
        $result['orders'] = DB::table('orders')->where('order_id', 'LIKE','%'.$order_id.'%')->get();
        return view('admin.orders', $result);
    }


}