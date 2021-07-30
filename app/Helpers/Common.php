<?php
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Customers;
function prx($arr){
    echo "<pre>";
    print_r($arr);
    die();
}

function getTopNavCat(){
    $result=DB::table('categories')
            ->where(['status'=>'Active'])
            ->get();
            $arr=[];

    foreach($result as $row){
        $arr[$row->id]['category_name']=$row->category_name;
        $arr[$row->id]['parent_id']=$row->parent_category_id;
        $arr[$row->id]['category_slug']=$row->category_slug;
    }
    $str=buildTreeView($arr,0);
    return $str;
}

$html='';
function buildTreeView($arr,$parent,$level=0,$prelevel= -1){
	global $html;
	foreach($arr as $id=>$data){
		// var_dump($parent);
		if($parent==$data['parent_id']){
			if($level>$prelevel){
				if($html==''){
					$html.='<ul class="nav navbar-nav">';
				}else{
					$html.='<ul class="dropdown-menu">';
				}
				
			}
			if($level==$prelevel){
				$html.='</li>';
			}
			$url=url("/category/".$data['category_slug']);
			$html.='<li><a href="'.$url.'">'.$data['category_name'].'<span class="caret"></span></a>';
			if($level>$prelevel){
				$prelevel=$level;
			}
			$level++;
			buildTreeView($arr,$id,$level,$prelevel);
			$level--;
		}
	}
	if($level==$prelevel){
		$html.='</li></ul>';
	}
	return $html;
}


function getUserTempId(){
	if(!session()->has('USER_TEMP_ID')){
		$rand=rand(111111111,999999999);
		session()->put('USER_TEMP_ID',$rand);
		return $rand;
	}else{
		return session()->get('USER_TEMP_ID');
	}
}

function getAddtoCartTotalItem(){
	if (session()->has('FRONT_USER_LOGIN')) {
        $uid = session()->get('FRONT_USER_ID');
        $user_type = "Reg";
    }else{
        $uid = getUserTempId();
        $user_type = "Not-Reg";
    }
    $result=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('products_attr','products_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftJoin('colors','colors.id','=','products_attr.color_id')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('cart.qty','products.name','products.image','sizes.size','colors.color','products_attr.price','products.slug','products.id as pid','products_attr.id as attr_id')
            ->get();
    return $result;       
}


function apply_coupon_code($coupon_code){
	$totalprice = 0;
    $result=DB::table('coupons')->where(['code'=>$coupon_code])->get();
    if (isset($result[0])) {
        $type = $result[0]->coupon_type;
        $value = $result[0]->value;
        $getAddtoCartTotalItem = getAddtoCartTotalItem();
        foreach($getAddtoCartTotalItem as $list){
            $totalprice += $list->qty * $list->price;
        }
        if ($result[0]->status == "Deactivate") {
             $status = "error";
             $msg = "Coupon Code is Deactivated";
        }elseif ($result[0]->expirydate < date('Y-m-d')) {
             $status = "error";
            $msg = "Coupon Code is Expired";
        }else{
			if ($result[0]->is_one_time == 1) {
                $status = "error";
                $msg = "Coupon Code Already Used";
            }else{
                $min_order_amt = $result[0]->min_order_amnt;
                if ($min_order_amt>0) {
                    if ($min_order_amt<$totalprice) {
                        $status = "success";
                        $msg = "Coupon Applied Successfully";
                    }else{
                        $status = "error";
                        $msg = "Cart Amount Must be Greater than $min_order_amt";
                    }
                }else{
                    $status = "success";
                    $msg = "Coupon Applied Successfully";
                }
            }
        }
    }else{
        $status = "error";
        $msg = "Please enter valid coupon code";
    } 
    $coupon_code_value = 0;
	if ($status == "success") {
        if ($type == "Value") {
        	$totalprice = $totalprice - $value;
            $coupon_code_value = $value;
        }
        if ($type == "Percentage") {
            $newprice = ($value/100)*$totalprice;
            $totalprice = round($totalprice - $newprice);
            $coupon_code_value = $newprice;
		}
	} 
    return json_encode(['status' => $status,'msg' => $msg, 'totalprice' => $totalprice,'coupon_code_value' =>$coupon_code_value]);  
}

function getAvaliableQty($product_id,$attr_id){
    $result=DB::table('order_details')
            ->leftJoin('orders','orders.id','=','order_details.order_id')
            ->leftJoin('products_attr','products_attr.id','=','order_details.products_attr_id')
            ->where(['order_details.product_id'=>$product_id])
            ->where(['order_details.products_attr_id'=>$attr_id])
            ->select('order_details.qty','products_attr.qty as pqty')
            ->get();
    return $result;
}

function get_seller_details($seller_id){
    $args = [
        'id'     => $seller_id,
        'status' => 'Active'
    ];
    $result=DB::table('admins')
            ->where($args)
            ->get();
    return $result;
}

function get_seller_verification(){
    $args = [
        'status' => 'AdminVerification',
        'role'   => 'Seller'
    ];
    $result=DB::table('admins')
            ->where($args)
            ->get();
    return $result;
}

function get_all_orders(){
    if(session()->get('ADMIN_ROLE') == 'admin'){
        $result=DB::table('orders')
            ->select('*')
            ->where(['order_status' => 'Pending'])
            ->orderBy('id', 'desc')
            ->get(); 
        return $result;    
    }else{
        $result= DB::table('orders')
            ->select('products.seller_id','orders.*')
            ->leftJoin('order_details','order_details.order_id','=','orders.order_id')
            ->leftJoin('products','order_details.product_id','=','products.id')
            ->where(['products.seller_id'=>session()->get('ADMIN_ID')])
            ->where(['order_status' => 'Pending'])
            ->orderBy('id', 'desc')
            ->get();
        return $result;     
    }
}


function get_user_details($id){
     $result=DB::table('admins')
            ->where(['id' => $id])
            ->get();
    return $result;
}


function dashboardchart(){
    if(session()->get('ADMIN_ROLE') == 'admin'){
        //Order Chart data
        $args  = [ 'added_on'   => date('Y-m-d') ];
        $today_orders_data =DB::table('orders')->where($args)->get();
        $args  = ['added_on'   => date('Y-m-d', strtotime("-1 day")) ];
        $yesterday_orders_data =DB::table('orders')->where($args)->get();
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-2 day")) ];
        $last_3days_orders =DB::table('orders')->where($args)->get();
        $args  = [  'added_on'   => date('Y-m-d', strtotime("-3 day")) ];
        $last_4days_orders =DB::table('orders')->where($args)->get();
        $args  = [  'added_on'   => date('Y-m-d', strtotime("-4 day")) ];
        $last_5days_orders =DB::table('orders')->where($args)->get();
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-5 day")) ];
        $last_6days_orders =DB::table('orders')->where($args)->get();
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-6 day")) ];
        $last_7days_orders =DB::table('orders')->where($args)->get();
    }else{
        $args  = [ 'added_on'   => date('Y-m-d') ];
        $today_orders_data =getsellerorders($args);
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-1 day"))];
        $yesterday_orders_data =getsellerorders($args);
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-2 day"))];
        $last_3days_orders =getsellerorders($args);
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-3 day"))];
        $last_4days_orders =getsellerorders($args);
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-4 day"))];
        $last_5days_orders =getsellerorders($args);
        $args  = [ 'added_on'   => date('Y-m-d', strtotime("-5 day"))];
        $last_6days_orders =getsellerorders($args);
         $args  = [ 'added_on'   => date('Y-m-d', strtotime("-6 day"))];
        $last_7days_orders =getsellerorders($args);
    }
    $data['chart_data']  = [
            'ch_today_order'        => $today_orders_data ? count($today_orders_data): '0',
            'ch_yesterday_order'    => $yesterday_orders_data ? count($yesterday_orders_data): '0',
            'ch_last_3_days_order'  => $last_3days_orders ? count($last_3days_orders): '0',
            'ch_last_4_days_order'  => $last_4days_orders ? count($last_4days_orders): '0',
            'ch_last_5_days_order'  => $last_5days_orders ? count($last_5days_orders): '0',
            'ch_last_6_days_order'  => $last_6days_orders ? count($last_6days_orders): '0',
            'ch_last_7_days_order'  => $last_7days_orders ? count($last_7days_orders): '0'
        ];
    return $data['chart_data'];    
}

function getsellerorders($orderdate){
    $orders = DB::table('orders')->select('products.seller_id','orders.*')
            ->leftJoin('order_details','order_details.order_id','=','orders.order_id')
            ->leftJoin('products','order_details.product_id','=','products.id')
            ->where(['products.seller_id'=>session()->get('ADMIN_ID')])
            ->where(['orders.added_on'=>$orderdate])
            ->orderBy('id', 'desc')
            ->get();
    return $orders;
}


function getsellerandbuyerchart(){
    $buyers = Customers::all();
    $sellers = DB::table('admins')->where(['role'=>'Seller'])->get();
    $data['chart_data_second']  = [
        'ch_buyers'      => $buyers? count($buyers) :'0',
        'ch_sellers'     => $sellers ? count($sellers):'0'
    ]; 
    return $data['chart_data_second'];
}

?>