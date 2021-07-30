<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductReviewController extends Controller
{
	public function index(){
		 $result['data']=
                DB::table('product_review')
                ->leftJoin('customers','customers.id','=','product_review.customer_id')
                ->leftJoin('products','products.id','=','product_review.product_id')
                ->orderBy('product_review.added_on','desc')
                ->select('product_review.id','product_review.rating','product_review.review','product_review.added_on','customers.name','products.name as pname','product_review.status')
                ->get();
        return view('admin.product_review',$result);
	}

	public function update_product_review_status(Request $request,$status,$id){
        DB::table('product_review')
        ->where(['id'=>$id])
        ->update(['status'=>$status]);
        return redirect('/admin/product_review/');
    } 

}