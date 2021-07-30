<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Helper;
use Crypt;
use Mail;
class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['home_categories']=DB::table('categories')
                ->where(['status'=>1])
                ->where(['is_home'=>1])
                ->get();


        foreach($result['home_categories'] as $list){
            $result['home_categories_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>'Active'])
                ->where(['category_id'=>$list->id])
                ->get();

            foreach($result['home_categories_product'][$list->id] as $list1){
                $result['home_product_attr'][$list1->id]=
                    DB::table('products_attr')
                    ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                    ->leftJoin('colors','colors.id','=','products_attr.color_id')
                    ->where(['products_attr.products_id'=>$list1->id])
                    ->get();
                
            }
        }

        $result['home_brand']=DB::table('brands')
                ->where(['status'=>'Active'])
                ->where(['is_home'=>1])
                ->get();
        

        $result['home_featured_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>'Active'])
                ->where(['is_feature'=>1])
                ->get();

        foreach($result['home_featured_product'][$list->id] as $list1){
            $result['home_featured_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
            
        }

        $result['home_tranding_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>'Active'])
            ->where(['is_tranding'=>1])
            ->get();

        foreach($result['home_tranding_product'][$list->id] as $list1){
            $result['home_tranding_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
            
        }

        $result['home_discounted_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>'Active'])
            ->where(['is_discounted'=>1])
            ->get();

        foreach($result['home_discounted_product'][$list->id] as $list1){
            $result['home_discounted_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
            
        }
         
        $result['home_banner']=DB::table('home_banners')
            ->where(['status'=>'Active'])
            ->get();
            
        return view('front.index',$result);
    }

    public function category(Request $request,$slug)
    {   
        $sort="";
        $sort_txt="";
        $filter_price_start="";
        $filter_price_end="";
        $color_filter="";
        $colorFilterArr=[];
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }    
        
        $query=DB::table('products');
        $query=$query->leftJoin('categories','categories.id','=','products.category_id');
        $query=$query->leftJoin('products_attr','products.id','=','products_attr.products_id');
        $query=$query->where(['products.status'=>'Active']);
        $query=$query->where(['categories.category_slug'=>$slug]);
        if($sort=='name'){
            $query=$query->orderBy('products.name','asc');
            $sort_txt="Product Name";
        }
        if($sort=='date'){
            $query=$query->orderBy('products.id','desc');
            $sort_txt="Date";
        }
        if($sort=='price_desc'){
            $query=$query->orderBy('products_attr.price','desc');
            $sort_txt="Price - DESC";
        }if($sort=='price_asc'){
            $query=$query->orderBy('products_attr.price','asc');
            $sort_txt="Price - ASC";
        }
        if($request->get('filter_price_start')!==null && $request->get('filter_price_end')!==null){
            $filter_price_start=$request->get('filter_price_start');
            $filter_price_end=$request->get('filter_price_end');

            if($filter_price_start>0 && $filter_price_end>0){
                $query=$query->whereBetween('products_attr.price',[$filter_price_start,$filter_price_end]);
            }
        }  

        if($request->get('color_filter')!==null){
            $color_filter=$request->get('color_filter');        
            $colorFilterArr=explode(":",$color_filter);
            $colorFilterArr=array_filter($colorFilterArr);
           
            $query=$query->where(['products_attr.color_id'=>$request->get('color_filter')]);
            
        }

        $query=$query->distinct()->select('products.*');
        $query=$query->get();
        $result['product']=$query;
        
        foreach($result['product'] as $list1){
           
            $query1=DB::table('products_attr');
            $query1=$query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
            $query1=$query1->leftJoin('colors','colors.id','=','products_attr.color_id');
            $query1=$query1->where(['products_attr.products_id'=>$list1->id]);
            $query1=$query1->get();
            $result['product_attr'][$list1->id]=$query1;
        }

        $result['colors']=DB::table('colors')
        ->where(['status'=>'Active'])
        ->get();


        $result['category_left']=DB::table('categories')
        ->where(['status'=>'Active'])
        ->get();
        
        $result['slug']=$slug;
        $result['sort']=$sort;
        $result['sort_txt']=$sort_txt;
        $result['filter_price_start']=$filter_price_start;
        $result['filter_price_end']=$filter_price_end;
        $result['color_filter']=$color_filter;
        $result['colorFilterArr']=$colorFilterArr;
        return view('front.category',$result);
    }
    public function product(Request $request,$slug){
        $result['product']=
            DB::table('products')
            ->where(['products.status'=>'Active'])
            ->where(['slug'=>$slug])
            //->leftJoin('admins','admins.id','=','products.seller_id')
            ->get();

        foreach($result['product'] as $list1){
            $result['product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

        foreach($result['product'] as $list1){
            $result['product_images'][$list1->id]=
                DB::table('products_images')
                ->where(['products_images.products_id'=>$list1->id])
                ->get();
        }
        $result['related_product']=
            DB::table('products')
            ->where(['status'=>'Active'])
            ->where('slug','!=',$slug)
            ->where(['category_id'=>$result['product'][0]->category_id])
            ->get();
        foreach($result['related_product'] as $list1){
            $result['related_product_attr'][$list1->id]=
                DB::table('products_attr')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['products_attr.products_id'=>$list1->id])
                ->get();
        }

        $result['product_review']=
                DB::table('product_review')
                ->leftJoin('customers','customers.id','=','product_review.customer_id')
                ->where(['product_review.product_id'=>$result['product'][0]->id])
                ->where(['product_review.status'=>1])
                ->orderBy('product_review.added_on','desc')
                ->select('product_review.rating','product_review.review','product_review.added_on','customers.name')
                ->get();
        //prx($result['product_review']); 

        //prx($result['product']);       
        return view('front.product',$result);
    }

    public function add_to_cart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }else{
            $uid=getUserTempId();
            $user_type="Not-Reg";
        }
        
        $size_id=$request->post('size_id');
        $color_id=$request->post('color_id');
        $pqty=$request->post('pqty');
        $product_id=$request->post('product_id');
        $result=DB::table('products_attr')
            ->select('products_attr.id')
            ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftJoin('colors','colors.id','=','products_attr.color_id')
            ->where(['products_id'=>$product_id])
            ->where(['sizes.size'=>$size_id])
            ->where(['colors.color'=>$color_id])
            ->get();
            
        if (isset($result[0])) {
            $product_attr_id=$result[0]->id;
            $getAvaliableQty=getAvaliableQty($product_id,$product_attr_id);
            if (isset($getAvaliableQty[0])) {
                $finalAvaliable=$getAvaliableQty[0]->pqty-$getAvaliableQty[0]->qty;
                if($pqty>$finalAvaliable){
                    return response()->json(['msg'=>"not_avaliable",'data'=>"Only $finalAvaliable left"]);
                }
            }
        }
        $check=DB::table('cart')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->where(['product_id'=>$product_id])
            ->where(['product_attr_id'=>$product_attr_id])
            ->get();
        if(isset($check[0])){
            $update_id=$check[0]->id;
            if($pqty==0){
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->delete();
                $msg="removed";
            }else{
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$pqty]);
                $msg="updated";
            }
            
        }else{
            $id=DB::table('cart')->insertGetId([
                'user_id'=>$uid,
                'user_type'=>$user_type,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id,
                'qty'=>$pqty,
                'added_on'=>date('Y-m-d h:i:s')
            ]);
            $msg="added";
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
        return response()->json(['msg'=>$msg,'data'=>$result,'totalItem'=>count($result)]);
    }

    public function carts(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $user_type="Reg";
        }else{
            $uid=getUserTempId();
            $user_type="Not-Reg";
        }
        $result['list']=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('products_attr','products_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
            ->leftJoin('colors','colors.id','=','products_attr.color_id')
            ->where(['user_id'=>$uid])
            ->where(['user_type'=>$user_type])
            ->select('cart.qty','products.name','products.image','sizes.size','colors.color','products_attr.price','products.slug','products.id as pid','products_attr.id as attr_id')
            ->get();
        return view('front.carts',$result);
    }

    public function search(Request $request,$str){
        $result['product']=
            $query=DB::table('products');
            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('products_attr','products.id','=','products_attr.products_id');
            $query=$query->where(['products.status'=>1]);
            $query=$query->where('name','like',"%$str%");
            $query=$query->orwhere('model','like',"%$str%");
            $query=$query->orwhere('short_desc','like',"%$str%");
            $query=$query->orwhere('desc','like',"%$str%");
            $query=$query->orwhere('keywords','like',"%$str%");
            $query=$query->orwhere('technical_specification','like',"%$str%") ;
            $query=$query->distinct()->select('products.*');
            $query=$query->get();
            $result['product']=$query;
            
            foreach($result['product'] as $list1){
                $query1=DB::table('products_attr');
                $query1=$query1->leftJoin('sizes','sizes.id','=','products_attr.size_id');
                $query1=$query1->leftJoin('colors','colors.id','=','products_attr.color_id');
                $query1=$query1->where(['products_attr.products_id'=>$list1->id]);
                $query1=$query1->get();
                $result['product_attr'][$list1->id]=$query1;
            }
        
        return view('front.search',$result);
    }

    public function registration(Request $request) {
        if ($request->session()->has('FRONT_USER_LOGIN') != null) {
            return redirect('/');
        }
       $result=[];
        return view('front.registration',$result);
    }

    public function registration_process(Request $request){
        $valid = Validator::make($request->all(),[
            "name"      => 'required',
            "email"     => 'required|email|unique:customers,email',
            "password"  => 'required',
            "mobile"    => 'required|digits:10|numeric',
            "address"   => 'required'
        ]); 

        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
        }else{
            $rand_id=rand(111111111,999999999);

            $arr = [
                "name"        => $request->name,
                "email"       => $request->email,
                "mobile"      => $request->mobile,
                "password"    => Crypt::encrypt($request->password),
                "address"     => $request->address,
                'status'      => 'Active',
                'is_verified' => '0',
                'rand_id'     => $rand_id,
                'created_at'  => date('Y-m-d h:i:s'),
                'updated_at'  => date('Y-m-d h:i:s')
            ];
            $query=DB::table('customers')->insert($arr);
            if ($query) {
                $data=['name'=>$request->name,'rand_id'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('front/email_verification',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Email Id Verification');
                });

                return response()->json(['status' => 'success','msg' => 'Registration Successfully, Please Check your email Id for Verification']);
            }
        } 
    }

    
    public function login_process(Request $request){
        $result=DB::table('customers')
                ->where(['email'=>$request->str_login_email])
                ->get();
        if (isset($result[0])) {
            $db_pwd = decrypt($result[0]->password);
            $status = $result[0]->status;
            $is_verified = $result[0]->is_verified;
            if ($is_verified  == 0) {
                $msg = "Your Email is Not Verify Please Verify Your Email Id";
                return response()->json(['status' => 'error','msg' => $msg]);   
            }
            if ($status  == 'DeActivate') {
                $msg = "Your Account is DeActivated Please Contact to Admin";
                return response()->json(['status' => 'error','msg' => $msg]);   
            }
            if ($db_pwd == $request->str_login_password) {
                if ($request->rememberme === null) {
                    setcookie('login_email', $request->str_login_email, 100);
                    setcookie('login_pwd', $request->str_login_password, 100);
                }else{
                    setcookie('login_email', $request->str_login_email, time()+60*60*24*100);
                    setcookie('login_pwd', $request->str_login_password, time()+60*60*24*100);
                }
                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $result[0]->id);
                $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                $request->session()->put('FRONT_USER_EMAIL', $result[0]->email);
                $request->session()->put('FRONT_USER_MOBILE', $result[0]->mobile);
                $status = "success";
                $msg = "Login Successfully";
                $getUserTempId = getUserTempId();
                $args= ['user_id' => $getUserTempId, 'user_type' =>'Not-Reg'];
                DB::table('cart')->where($args)->update(['user_id' => $result[0]->id, 'user_type' => 'Reg']);
            }else{
                $status = "error";
                $msg = "Please Enter Valid Password";
            }
           
        }else{
            $status = "error";
            $msg = "Invalid Email ! Please Enter Valid Email Id";
        }  
        return response()->json(['status' => $status,'msg' => $msg]);   
           
    }


    public function email_verification(Request $request,$id) {
        $result=DB::table('customers')->where(['rand_id'=>$id])->where(['is_verified'=>0])->get(); 
        if(isset($result[0])){
            DB::table('customers')->where(['id'=>$result[0]->id])->update(['is_verified'=>1,'rand_id'=>'']);
            return view('front.verification');
        }else{
            return redirect('/');
        }
    }


    public function forgot_password(Request $request){
        $result=DB::table('customers')->where(['email'=>$request->str_forgot_email])->get();
        if (isset($result[0])) {
            $rand_id=rand(111111111,999999999);
            DB::table('customers')->where(['email'=>$request->str_forgot_email])->update(['is_forgot_password'=>1,'rand_id'=>$rand_id]);

            $data=['name'=>$result[0]->name,'rand_id'=>$rand_id];
            $user['to']=$request->str_forgot_email;
            Mail::send('front/forgot_email',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Forgot Password');
            });
            return response()->json(['status' => 'success','msg' => 'Please Check your Email If for Password ']);
        }else{
            return response()->json(['status' => 'error','msg' => 'Email id Not Registered']); 
        }     
    }


    
    public function forgot_password_change(Request $request,$id) {
        $result=DB::table('customers')->where(['rand_id'=>$id])->where(['is_forgot_password'=>1])->get(); 
        if(isset($result[0])){
            $request->session()->put('FORGOT_PASSWORD_USER_ID', $result[0]->id);
            return view('front.forgot_password_change');
        }else{
            return redirect('/');
        }
    }


    
    public function forgot_password_change_process(Request $request) {
        $valid = Validator::make($request->all(),[
            "newpassword"      => 'required|min:6',
            "confirmpassword"      => 'required|same:newpassword|min:6',
        ]); 
        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
        }else{
            $args = [ 'id'  => $request->session()->get('FORGOT_PASSWORD_USER_ID') ];
            $data = [
                'is_forgot_password'=> 0,
                'password'          => Crypt::encrypt($request->newpassword),
                'rand_id'           =>''
            ];
             
            DB::table('customers')->where($args)->update($data);
            return response()->json(['status' => 'success','msg' => 'Password Change Successfully']); 
        }
        $result=DB::table('customers')  
            ->where(['rand_id'=>$id])
            ->where(['is_forgot_password'=>1])
            ->get(); 
        if(isset($result[0])){
            return view('front.forgot_password_change');
        }else{
            return redirect('/');
        }
    }

    public function Checkout(Request $request){
        $result['cart_data'] = getAddtoCartTotalItem();
        if (isset($result['cart_data'][0])) {
            if($request->session()->has('FRONT_USER_LOGIN')){
                $uid=$request->session()->get('FRONT_USER_ID');
                $user_type="Reg";

                $customer_info=DB::table('customers')  
                    ->where(['id'=> $uid])
                     ->get(); 
                $result['customers']['name']=$customer_info[0]->name;
                $result['customers']['email']=$customer_info[0]->email;
                $result['customers']['mobile']=$customer_info[0]->mobile;
                $result['customers']['address']=$customer_info[0]->address;
                $result['customers']['city']=$customer_info[0]->city;
                $result['customers']['state']=$customer_info[0]->state;
                $result['customers']['zip']=$customer_info[0]->zip;

            }else{
                $result['customers']['name']='';
                $result['customers']['email']='';
                $result['customers']['mobile']='';
                $result['customers']['address']='';
                $result['customers']['city']='';
                $result['customers']['state']='';
                $result['customers']['zip']='';
            }
            return view('front.Checkout', $result);
        }else{
            return redirect('/');
        }
    }

    public function apply_coupon_code(Request $request){
        $arr=apply_coupon_code($request->coupon_code);
        $arr=json_decode($arr,true);
        return response()->json(['status'=>$arr['status'],'msg'=>$arr['msg'],'totalprice'=>$arr['totalprice']]);
    }

    public function remove_coupon_code(Request $request){
        $totalprice = 0;
        $result=DB::table('coupons')
                ->where(['code'=>$request->coupon_code])
                ->get();
        $getAddtoCartTotalItem = getAddtoCartTotalItem();
        $totalprice = 0;
        foreach($getAddtoCartTotalItem as $list){
            $totalprice += $list->qty * $list->price;
        }
        return response()->json(['status' => 'success','msg' => 'Coupon code removed', 'totalprice' => $totalprice]);  
    }

    public function place_order(Request $request){
        $payment_url = "";
        if($request->session()->has('FRONT_USER_LOGIN')){

        }else{
             $valid = Validator::make($request->all(),[
                "email"     => 'required|email|unique:customers,email',
            ]); 

            if (!$valid->passes()) {
                return response()->json(['status' => 'error', 'msg' =>'The email has already been taken']);
            }else{
                $randpass =rand(111111111,999999999);
                $rand_id =rand(222222,555555);
                 $arr = [
                    "name"        => $request->name,
                    "email"       => $request->email,
                    "mobile"      => $request->mobile,
                    "password"    => Crypt::encrypt($randpass),
                    "address"     => $request->address,
                    "city"        => $request->city,
                    "state"       => $request->state,
                    "zip"         => $request->zip,
                    'status'      => 'Active',
                    'is_verified' => '1',
                    'is_forgot_password' => '0',
                    'rand_id'     => $rand_id,
                    'created_at'  => date('Y-m-d h:i:s'),
                    'updated_at'  => date('Y-m-d h:i:s')
                ];
                //$query=DB::table('customers')->insert($arr);
                $user_id=DB::table('customers')->insertGetId($arr);

                $request->session()->put('FRONT_USER_LOGIN', true);
                $request->session()->put('FRONT_USER_ID', $user_id);
                $request->session()->put('FRONT_USER_NAME', $request->name);
                $request->session()->put('FRONT_USER_EMAIL', $request->email);
                $request->session()->put('FRONT_USER_MOBILE', $request->mobile);

                $data=['name'=>$request->name,'password'=>$randpass];
                $user['to']=$request->email;
                Mail::send('front/password_send',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('New Password');
                });

                $getUserTempId = getUserTempId();
                $args= ['user_id' => $getUserTempId, 'user_type' =>'Not-Reg'];
                DB::table('cart')->where($args)->update(['user_id' => $user_id, 'user_type' => 'Reg']);


            }
        }
            $coupon_value = 0;
            if ($request->coupon_code != "") {
                $arr = apply_coupon_code($request->coupon_code);
                $arr = json_decode($arr, true);
                if ($arr['status'] == 'success') {
                    $coupon_value = $arr['coupon_code_value'];
                }else{
                    return response()->json(['status' => 'error','msg' => $arr['msg']]); 
                }
            }
            $uid=$request->session()->get('FRONT_USER_ID');
            $getAddtoCartTotalItem = getAddtoCartTotalItem();
            $totalprice = 0;
            foreach($getAddtoCartTotalItem as $list){
                $totalprice += $list->qty * $list->price;
            }
            $order_id=rand(2222222,888888);
            $arr = [
                "customers_id"    => $uid,
                'order_id'        => $order_id,
                "name"            => $request->name,
                "email"           => $request->email,
                "mobile"          => $request->mobile,
                "address"         => $request->address,
                "city"            => $request->city,
                "state"           => $request->state,
                "pincode"         => $request->zip,
                "coupon_code"     => $request->coupon_code,
                "coupon_value"    => $coupon_value,
                "payment_type"    => $request->payment_type,
                'order_status'    => 'Pending',
                'payment_status'  => 'Pending',
                'total_amount'    => $totalprice,
                'added_on'        => date('Y-m-d h:i:s')
               
            ];
            $return_id=DB::table('orders')->insertGetId($arr);
            if ($return_id >0) {
                foreach($getAddtoCartTotalItem as $list){
                    $productDetailArr['product_id'] = $list->pid;
                    $productDetailArr['products_attr_id']= $list->attr_id;
                    $productDetailArr['price']= $list->price;
                    $productDetailArr['order_id']= $order_id;
                    $productDetailArr['ret_order_id']= $return_id;
                    $productDetailArr['qty']= $list->qty;
                    $ret_order_id=DB::table('order_details')->insert($productDetailArr);
                }

                if ($request->payment_type == "Gateway") {
                    $final_amt=$totalprice-$coupon_value;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,
                        array("X-Api-Key:test_543040b61acc2833c25e91cdd3a",
                            "X-Auth-Token:test_58c83373aafe6e03c905bb0e6be"));
                    $payload = Array(
                        'purpose' => 'Buy Product',
                        'amount' => $final_amt,
                        'phone' => $request->mobile,
                        'buyer_name' =>$request->name,
                        'redirect_url' => 'http://127.0.0.1:8000/instamojo_payment_redirect',
                        'send_email' => true,
                        'send_sms' => true,
                        'email' => $request->email,
                        'allow_repeated_payments' => false
                    );
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch); 
                    $response=json_decode($response);
                    if(isset($response->payment_request->id)){
                        $txn_id=$response->payment_request->id;
                        DB::table('orders')
                        ->where(['order_id'=>$order_id])
                        ->update(['txn_id'=>$txn_id]);
                        $payment_url=$response->payment_request->longurl;
                    }else{
                        $msg="";
                        foreach($response->message as $key=>$val){
                            $msg.=strtoupper($key).": ".$val[0].'<br/>';
                        }
                        return response()->json(['status'=>'error','msg'=>$msg,'payment_url'=>'']); 
                    }
                }
                DB::table('cart')->where(['user_id'=>$uid,'user_type' => 'Reg'])->delete();
                $request->session()->put('ORDER_ID', $order_id);
                $request->session()->put('REUTN_ORDER_ID', $return_id);

                $status = "success";
                $msg = "Order Placed Successfully";
            }else{
                $status = "error";
                $msg = "Please Try After Some time";
            }
        return response()->json(['status' => $status,'msg' => $msg, 'payment_url'=>$payment_url]); 
    }


    public function instamojo_payment_redirect(Request $request){
        if($request->get('payment_id')!==null && $request->get('payment_status')!==null && $request->get('payment_request_id')!==null){
            if($request->get('payment_status')=='Credit'){
                $status='Success';
                $redirect_url='/order_placed';
            }else{
                $status='Fail';
                $redirect_url='/order_fail';
            }
            $request->session()->put('ORDER_STATUS',$status);
            DB::table('orders')
                ->where(['txn_id'=>$request->get('payment_request_id')])
                ->update(['payment_status'=>$status,'payment_id'=>$request->get('payment_id')]);
                return redirect($redirect_url);
        }else{
            die('Something went wrong');
        }
    }
    public function order_fail(Request $request) {
        if($request->session()->has('ORDER_ID')){
            return view('front.order_fail');
        }else{
            return redirect('/');
        }
    }


    public function order_placed(Request $request){
        if($request->session()->has('ORDER_ID')){
            return view('front.order_placed');
        }else{
            return redirect("/");
        }
    }

    public function order(Request $request){
        $result['orders']=DB::table('orders')
                ->select('orders.*')
                ->where(['orders.customers_id'=>$request->session()->get('FRONT_USER_ID')])
                ->orderBy('orders.id', 'desc')
                ->get(); 
        return view('front.orders', $result);
    }

    public function order_detail(Request $request, $order_id){
        $result['orders_details']=
                DB::table('order_details')
                ->select('orders.*','order_details.price','order_details.qty','products.name as pname','products_attr.attr_image','sizes.size','colors.color')
                ->leftJoin('orders','orders.order_id','=','order_details.order_id')
                ->leftJoin('products_attr','products_attr.id','=','order_details.products_attr_id')
                ->leftJoin('products','products.id','=','products_attr.products_id')
                ->leftJoin('sizes','sizes.id','=','products_attr.size_id')
                ->leftJoin('colors','colors.id','=','products_attr.color_id')
                ->where(['orders.order_id'=>$order_id])

                 ->where(['orders.customers_id'=>$request->session()->get('FRONT_USER_ID')])
                ->get();
        if (!isset($result['orders_details'][0])) {
            return redirect('/');
        }           
        return view('front.order_detail', $result);
    }

    public function product_review_process(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
             $arr=[
                "rating"=>$request->rating,
                "review"=>$request->review,
                "product_id"=>$request->product_id,
                "status"=>1,
                "customer_id"=>$uid,
                "added_on"=>date('Y-m-d h:i:s')
            ];
            $query=DB::table('product_review')->insert($arr);

            $status = "success";
           $msg = "Thanku you for providing your review";
        }else{
           $status = "error";
           $msg = "Please login to submit your review";
        }
        return response()->json(['status' => $status,'msg' => $msg]);
    }

    public function cancelorder(Request $request, $order_id){
        $args = ['order_id'  => $order_id];
        $query=DB::table('orders')->where($args)->update(['order_status' => 'Cancel']);
        $request->session()->flash('message', 'Order Cancel Successfully');
        return redirect('order');
    }


    
}
