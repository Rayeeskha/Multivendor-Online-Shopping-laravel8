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
class SellerController extends Controller
{
	public function index(){
		return view('seller.register');
	}

	public function selleraccount_process(Request $request){
        $valid = Validator::make($request->all(),[
            "email"     => 'required|email|unique:admins,email',
            "phone"    => 'required|digits:10|numeric',
            'password'       => 'required|min:6',
 			'confirmpassword' => 'required|same:password'
        ]); 

        if (!$valid->passes()) {
            return response()->json(['status' => 'error', 'error' => $valid->errors()->toArray()]);
        }else{
        	$rand_id=rand(22222222,88888888);
            $seller=rand(22222222,999999999);
            $seller_id = "SELLER ".$seller;

            $arr = [
            	"seller_id"   => $seller_id,
                "fname"       => $request->fname,
                "lname"       => $request->lname,
                "phone"       => $request->phone,
                "email"       => $request->email,
                "company"     => $request->company,
                "gstumber"    => $request->gstumber,
                "aadharnumber"=> $request->aadharnumber,
                "pannumber"   => $request->pannumber,
                "city"        => $request->city,
                "state"       => $request->state,
                "zip"         => $request->zip,
                "address"     => $request->address,
                "website"     => $request->website,
                "password"    => Hash::make($request->password),
                'status'      => 'Pending',
                'role'        => 'Seller',
                'is_verified' => '0',
                'verification_id' => $rand_id,
                'created_at'  => date('Y-m-d h:i:s'),
                'updated_at'  => date('Y-m-d h:i:s')
            ];
            $query=DB::table('admins')->insert($arr);
            if ($query) {
                $data=['name'=>$request->name,'verification_id'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('seller/email_verification',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Account Verification');
                });

                return response()->json(['status' => 'success','msg' => 'Registration Successfully, Please Check your email Id for Verification']);
            }
        } 
    }


    public function email_verification(Request $request,$id) {
        $result=DB::table('admins')->where(['verification_id'=>$id])->where(['is_verified'=>0])->get(); 
        if(isset($result[0])){
            DB::table('admins')->where(['id'=>$result[0]->id])->update(['is_verified'=>1,'verification_id'=>'','status'=>'AdminVerification']);
            return view('admin.login');
        }else{
            return redirect('/');
        }
    }

}