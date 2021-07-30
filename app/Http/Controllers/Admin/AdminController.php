<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Customers;
use App\Models\Admin\Admin;
use App\Models\Admin\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    /**
    $sesller_id = session()->get('ADMIN_ID');
    
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (session()->has('ADMIN_LOGIN') || session()->has('SELLER_LOGIN')) {
           return redirect('admin/dashboard');
        }else{
            $data = session()->get('ADMIN_LOGIN');
            $data = session()->get('SELLER_LOGIN');
            return view('admin/login');
        }
    }

    public function authentication(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->post('email');
        $password = $request->post('password');

       $result = Admin::where(['email'=> $email])->get();
        if (isset($result[0])) {
            if (Hash::check($request->post('password'), $result[0]->password)) {
                if ($result[0]->status == "Active") {
                    if ($request->rememberme === null) {
                        setcookie('login_email', $request->email, 100);
                        setcookie('login_pwd', $request->password, 100);
                    }else{
                        setcookie('login_email', $request->email, time()+60*60*24*100);
                        setcookie('login_pwd', $request->password, time()+60*60*24*100);
                    }
                    $admin_session = [
                        'ADMIN_ID'    => $result[0]->id,
                        'ADMIN_ROLE'    => $result[0]->role,
                        'ADMIN_LOGIN' => true,
                    ];
                    $request->session()->put($admin_session);
                    return redirect('admin/dashboard');

                }else{
                    $request->session()->flash('error', 'Your Account is not Verified by Admin');
                    return redirect('admin'); 
                }
        
            }else{
               $request->session()->flash('error', 'Please Enter Correct Password');
                return redirect('admin'); 
            }
        }else{
            $request->session()->flash('error', 'Sorry ! Incorrect Login Details');
            return redirect('admin');
        }
    } 

    public function dashboard(){
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $data['products'] = Products::all();
            $data['income'] = $this->getallwebsiteincome(); 
        }else{
            $data['products']=DB::table('products')->where(['seller_id'=>session()->get('ADMIN_ID')])->get(); 
            $data['income'] =   $this->getsellerincome();
        }
        $data['customers'] = Customers::all();
        return view('admin.dashboard', $data);
    } 


    public function getsellerincome(){
        $orders = DB::table('orders')->select('products.seller_id','orders.*')
                ->leftJoin('order_details','order_details.order_id','=','orders.order_id')
                ->leftJoin('products','order_details.product_id','=','products.id')
                ->where(['products.seller_id'=>session()->get('ADMIN_ID')])
                ->orderBy('id', 'desc')
                ->get();
        $income = 0;
        foreach($orders as $ord){
            $income += $ord->total_amount;
        }
        return $income;        
    } 
    public function getallwebsiteincome(){
        $orders =DB::table('orders')->select('*')->get(); 
        $income = 0;
        foreach($orders as $ord){
            $income += $ord->total_amount;
        }
        return $income;
    }



    public function updatepassword(){
        $pass = Admin::find(1);
        $pass->password = Hash::make('123456');
        $pass->save();
    }

    public function verifyselleraccount(){
         $result['sellers']=DB::table('admins')
                ->where(['role'=>'Seller'])
                ->orderBy('id', 'desc')
                ->get();
         return view('admin.verifyselleraccount', $result);       
    }

    

    public function changeselleraccount(Request $request, $id, $status){
        DB::table('admins')->where(['id'=>$id])->update(['status'=>$status]);
        $request->session()->flash('message', 'Seller Account Status Change Successfully');
        return redirect('admin/verifyselleraccount');
    }

    public function delete(Request $request, $id){
        DB::table('admins')->where(['id'=>$id])->delete();
        $request->session()->flash('message', 'Seller Account Deleted Successfully');
        return redirect('admin/verifyselleraccount');
    }

}
