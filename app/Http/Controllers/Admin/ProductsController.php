<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductsController extends Controller
{
   public function index(){
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $data['products'] = Products::all();
        }else{
            $data['products']=DB::table('products')
                ->where(['seller_id'=>session()->get('ADMIN_ID')])
                ->get(); 
        }
        
        return view('admin/products', $data);
    }

    public function manage_products(Request $request, $id = ""){
        if($id > 0){
            $arr = Products::where(['id'    => $id])->get();
            $result['category_id']   = $arr[0]->category_id;
            $result['name']   = $arr[0]->name;
            $result['slug']   = $arr[0]->slug;
            $result['brand_id']   = $arr[0]->brand;
            $result['descreption']   = $arr[0]->descreption;
            $result['short_desc']   = $arr[0]->short_desc;
            $result['keywords'] = $arr[0]->keywords;
            $result['model'] = $arr[0]->model;
            $result['technical_specification'] = $arr[0]->technical_specification;
            $result['uses'] = $arr[0]->uses;
            $result['warrenty'] = $arr[0]->warrenty;
            $result['image'] = $arr[0]->image;
            $result['status'] = $arr[0]->status;

            $result['lead_time'] = $arr[0]->lead_time;
            $result['tax_id'] = $arr[0]->tax_id;
            $result['is_promo'] = $arr[0]->is_promo;
            $result['is_feature'] = $arr[0]->is_feature;
            $result['is_discounted'] = $arr[0]->is_discounted;
            $result['is_tranding'] = $arr[0]->is_tranding;

            $result['id'] = $arr[0]->id;

            $result['productAttrArr'] = DB::table('products_attr')->where(['products_id'=>$id])->get();
            $productImagesArr = DB::table('products_images')->where(['products_id'=>$id])->get();
            //$result['productImagesArr']
            if (!isset($productImagesArr)) {
               $result['productImagesArr']['0']['id'] = '';
               $result['productImagesArr']['0']['images'] = '';
            }else{
                $result['productImagesArr']= $productImagesArr;
              
            }
        }else{
            $result['category_id'] = "";
            $result['name'] = "";
            $result['slug'] = "";
            $result['brand_id'] ="";
            $result['descreption'] = "";
            $result['short_desc'] = "";
            $result['keywords'] = "";
            $result['model'] = "";
            $result['technical_specification'] = "";
            $result['uses'] = "";
            $result['warrenty'] = "";
            $result['image'] = "";
            $result['status'] = "";
            $result['id'] = 0;

            $result['lead_time']     = "";
            $result['tax_id']        = "";
            $result['is_promo']      = "";
            $result['is_feature']    = "";
            $result['is_discounted'] = "";
            $result['is_tranding']   = "";

            $result['productAttrArr'][0]['id'] = ""; 
            $result['productAttrArr'][0]['products_id'] = ""; 
            $result['productAttrArr'][0]['sku'] = ""; 
            $result['productAttrArr'][0]['attr_image'] = ""; 
            $result['productAttrArr'][0]['mrp'] = ""; 
            $result['productAttrArr'][0]['price'] = ""; 
            $result['productAttrArr'][0]['qty'] = ""; 
            $result['productAttrArr'][0]['size_id'] = ""; 
            $result['productAttrArr'][0]['color_id'] = ""; 
            $result['productImagesArr'][0]['images']  = "";
            $result['productImagesArr'][0]['id']  = "";
        }
        $result['categories'] = DB::table('categories')->where(['status'=>'Active'])->get();
        $result['sizes']      = DB::table('sizes')->where(['status'=>'Active'])->get();
        $result['colors']     = DB::table('colors')->where(['status'=>'Active'])->get();
        $result['brands']     = DB::table('brands')->where(['status'=>'Active'])->get();
        $result['taxes']     = DB::table('taxes')->where(['status'=>'Active'])->get();
        return view('admin/manage_products', $result);
    }

    public function manageproductsprocess(Request $request ){
       if ($request->post('id') > 0) {
            $image_validation = "mimes:jpeg,jpg,png";
        }else{
            $image_validation = "required|mimes:jpeg,jpg,png";
        }
        $request->validate([
            'category_id'   => 'required',
            'proimage'      => $image_validation,
            'name'      => 'required',
            'slug'          => 'required|unique:products,slug,'.$request->post('id'),
            'attr_image.*'  => 'mimes:jpg,jpeg,png',
            'images.*'      => 'mimes:jpg,jpeg,png'
        ]);
        $paidArr = $request->post('prodAtrId');
        $skuArr = $request->post('sku');
        $mrpArr = $request->post('MRP');
        $priceArr = $request->post('Price');
        $qtyArr = $request->post('qty');
        $size_idArr = $request->post('sizes_id');
        $color_idArr = $request->post('color_id');

        if ($skuArr) {
           foreach ($skuArr as $key => $val) {
                $check = DB::table('products_attr')
                        ->where('sku', '=',$skuArr[$key])
                        ->where('id', '!=', $paidArr[$key])
                        ->get();

                if (isset($check[0])) {
                    $request->session()->flash('sku_error',$skuArr[$key].',SKU Already Used');

                    return redirect(request()->headers->get('referer'));
                }       
            }
        }
        if ($request->post('id') > 0) {
            $model = Products::find($request->post('id'));
            $msg = "Products Updated Successfully";
        }else{
            $model = new Products();
            $msg = "Products Inserted Successfully";
        }

        if ($request->hasfile('proimage')) {
            $image = $request->file('proimage');
            $ext = $image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/products', $image_name); 
            $model->image =  $image_name;
        }
        if(session()->get('ADMIN_ROLE') == 'admin'){
            $model->seller_id =  0;
        }else{
            $model->seller_id =  session()->get('ADMIN_ID');
        }
        $model->category_id =  $request->post('category_id');
        $model->name        =  $request->post('name');
        $model->slug        =  $request->post('slug');
        $model->brand       =  $request->post('brand');
        $model->descreption =  $request->post('descreption');
        $model->short_desc  =  $request->post('short_desc');
        $model->keywords    =  $request->post('keywords');
        $model->technical_specification =  $request->post('technical_specification');
        $model->uses        =  $request->post('uses');
        $model->model       =  $request->post('model');
        $model->warrenty    =  $request->post('warrenty');

        $model->lead_time   =  $request->post('lead_time');
        $model->tax_id      =  $request->post('tax_id');
        $model->is_promo    =  $request->post('is_promo');
        $model->is_feature  =  $request->post('is_feature');
        $model->is_discounted =  $request->post('is_discounted');
        $model->is_tranding   =  $request->post('is_tranding');

        $model->status =  'Active';
        $model->save();
        $pid = $model->id;

        /* Products Attribute Starts */
       
       if ($skuArr) {
            foreach ($skuArr as $key => $val) {
                $productAttrArr=[];
               $productAttrArr = [
                    'products_id'  => $pid,
                    'sku'          => $skuArr[$key],
                    'mrp'          => (int)$mrpArr[$key],
                    'price'        => (int)$priceArr[$key],
                    'qty'          => (int)$qtyArr[$key],
                    'size_id'      => $size_idArr[$key],
                    'color_id'     => $color_idArr[$key]
                ];

                //  'attr_image'   => 'testing',

                if ($request->hasfile("attr_image.$key")) {
                    if ($paidArr[$key]!='') {
                        $arrImage = DB::table('products_attr')->where(['id' => $paidArr[$key]])->get();
                        if (Storage::exists('/public/pro_attr_img/'.$arrImage[0]->attr_image)) {
                           Storage::delete('/public/pro_attr_img/'.$arrImage[0]->attr_image);
                        }
                    }
                    $rand = rand('111111111', '999999999');
                    $attr_image = $request->file("attr_image.$key");
                    $ext = $attr_image->extension();
                    $image_name = $rand.'.'.$ext;
                    $request->file("attr_image.$key")->storeAs('/public/pro_attr_img', $image_name); 
                    $productAttrArr['attr_image'] = $image_name;

                }else{
                    $productAttrArr['attr_image'] = '';
                }

                if ($paidArr[$key] =='') {
                    DB::table('products_attr')->insert($productAttrArr);
                }else{
                    DB::table('products_attr')->where(['id'=> $paidArr[$key]])->update($productAttrArr);
                }
                
            }
       }
       
        /* Products Attribute End */

        /* Products Images Section Start */
         $piidArr = $request->post('piid');
         if ($piidArr) {
            foreach ($piidArr as $key => $val) {
                $productImagesArr['products_id'] = $pid;
                //  'attr_image'   => 'testing',
                if ($request->hasfile("images.$key")) {
                    if ($piidArr[$key]!='') {
                        $arrImage = DB::table('products_images')->where(['id' => $piidArr[$key]])->get();
                        if (Storage::exists('/public/pro_attr_img/'.$arrImage[0]->images)) {
                           Storage::delete('/public/pro_attr_img/'.$arrImage[0]->images);
                        }
                    }

                    $rand = rand('111111111', '999999999');
                    $images = $request->file("images.$key");
                    $ext = $images->extension();
                    $images_name = $rand.'.'.$ext;
                    $request->file("images.$key")->storeAs('/public/pro_attr_img', $images_name); 
                    $productImagesArr['images'] = $images_name;


                    if ($piidArr[$key] =='') {
                        DB::table('products_images')->insert($productImagesArr);
                    }else{
                        DB::table('products_images')->where(['id'=> $piidArr[$key]])->update($productImagesArr);
                    }
                }else{
                    $productImagesArr['images'] = '';
                }
            }
         }
      
        /* Products Images Section End */
        $request->session()->flash('message', $msg);
        return redirect('admin/products');
    }

    public function products_attr_delete(Request $request, $paid, $pid){
        $arrImage = DB::table('products_attr')->where(['id' => $paid])->get();
        if (Storage::exists('/public/pro_attr_img/'.$arrImage[0]->attr_image)) {
           Storage::delete('/public/pro_attr_img/'.$arrImage[0]->attr_image);
        }
        DB::table('products_attr')->where(['id'=> $paid])->delete();
        return redirect('admin/products/manage_products/'.$pid);
    }

    public function products_images_delete(Request $request, $paid, $pid){
        $arrImage = DB::table('products_images')->where(['id' => $paid])->get();

        if (Storage::exists('/public/pro_attr_img/'.$arrImage[0]->images)) {
           Storage::delete('/public/pro_attr_img/'.$arrImage[0]->images);
        }
        DB::table('products_images')->where(['id'=> $paid])->delete();
        return redirect('admin/products/manage_products/'.$pid);
    }

    

    public function delete(Request $request, $id){
        $data =  $id;
        $model = Products::find($id);
        $model->delete();
        $request->session()->flash('message', 'Products Deleted Successfully');
        return redirect('admin/products');
    }


    public function changeproductsstatus(Request $request, $id, $status){
        $model = Products::find($id);
        $model->status =  $status;
        $model->save();
        $request->session()->flash('message', 'Products Status Updated Successfully');
        return redirect('admin/products');
    }
}
