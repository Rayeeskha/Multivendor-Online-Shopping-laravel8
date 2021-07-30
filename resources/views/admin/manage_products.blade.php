@extends('admin/layout')
@section('page_title', 'Manage Products')
@section('product_select','active')
@section('container')


@if($id>0)
    {{$image_required = ""}}
@else
    {{$image_required = "required"}}
@endif


<form class="new-added-form" action="{{route('products.manageproductsprocess')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="card height-auto">

    <span style="color: red;font-weight: 500;">{{session('sku_error')}}</span>



    @error('attr_image.*')
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @enderror


    @error('images.*')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{$message}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @enderror

    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Products</h3>
                <a href="{{url('admin/products')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
            <script type="text/javascript" src="{{asset('admin_assets/ckeditor/ckeditor.js')}}"></script>
        </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Product Name*</label>
                    <input type="text" name="name" value="{{$name}}" class="form-control">

                     @error('name')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Category*</label>
                    <select name="category_id" class="form-control">
                        <option selected="" disabled="">Select Category</option>
                        @foreach($categories as $list)
                        @if($category_id == $list->id)
                        <option value="{{$list->id}}" selected>{{$list->category_name}}</option>
                        @else
                            <option value="{{$list->id}}" >{{$list->category_name}}</option>
                            @endif
                        @endforeach;
                    </select>
                   @error('category_id')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>Product Slug*</label>
                            <input type="text" name="slug" value="{{$slug}}" class="form-control">
                            @error('slug')
                                <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>Product Brand*</label>
                            <select name="brand" class="form-control">
                                <option selected="" disabled="">Select Category</option>
                                @foreach($brands as $brand)
                                @if($brand_id == $brand->id)
                                <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                @else
                                    <option value="{{$brand->id}}" >{{$brand->name}}</option>
                                    @endif
                                @endforeach;
                            </select>
                           @error('brand')
                                <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                 </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>Warrenty*</label>
                            <input type="text" name="warrenty" value="{{$warrenty}}" class="form-control">
                            @error('warrenty')
                                <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>Keywords*</label>
                            <input type="text" name="keywords" value="{{$keywords}}" class="form-control">
                            @error('keywords')
                                <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Product Image*</label>
                    <input type="file" name="proimage"  class="form-control" {{$image_required}}>
                    @if($image != '')
                        <img src="{{asset('storage/products/'.$image)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                    @endif
                    @error('proimage')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>  
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Model*</label>
                    <input type="text" name="model" value="{{$model}}" class="form-control">
                    @error('model')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div> 
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Uses*</label>
                    <input type="text" name="uses" value="{{$uses}}" class="form-control">
                    @error('uses')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Short descreption*</label>
                    <textarea name="short_desc" type="text"  class="form-control" aria-required="true" aria-invalid="false">{{$short_desc}}</textarea>
                     @error('short_desc')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-6 form-group">
                    <label>Lead Team</label>
                    <input type="text" name="lead_time" value="{{$lead_time}}" class="form-control">
                </div>
                 
                <div class="col-xl-6 col-lg-6 col-6 form-group">
                    <label>Tax Type</label>
                    <select name="tax_id" class="form-control">
                        <option selected="" disabled="">Select Taxes</option>
                        @foreach($taxes as $txt)
                        @if($tax_id == $txt->id)
                        <option value="{{$txt->id}}" selected>{{$txt->tax_desc}} - {{$txt->tax_value}}</option>
                        @else
                            <option value="{{$txt->id}}" >{{$txt->tax_desc}}- {{$txt->tax_value}}</option>
                            @endif
                        @endforeach;
                    </select>
                   @error('brand')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-3 col-lg-3 col-3 form-group">
                    <label>Is Promo</label>
                    <select name="is_promo" class="form-control">
                        @if($is_promo == 1)
                        <option value="1" selected="">Yes</option>
                        <option value="0">No</option>
                        @else
                         <option value="1" >Yes</option>
                        <option value="0" selected="">No</option>
                        @endif
                    </select>
                </div>
                 <div class="col-xl-3 col-lg-3 col-3 form-group">
                    <label>Is Featured</label>
                    <select name="is_feature" class="form-control">
                        @if($is_feature == 1)
                        <option value="1" selected="">Yes</option>
                        <option value="0">No</option>
                        @else
                         <option value="1" >Yes</option>
                        <option value="0" selected="">No</option>
                        @endif
                    </select>
                </div>
                 <div class="col-xl-3 col-lg-3 col-3 form-group">
                    <label>Is Discounted</label>
                    <select name="is_discounted" class="form-control">
                        @if($is_discounted == 1)
                        <option value="1" selected="">Yes</option>
                        <option value="0">No</option>
                        @else
                         <option value="1" >Yes</option>
                        <option value="0" selected="">No</option>
                        @endif
                    </select>
                </div>
                 <div class="col-xl-3 col-lg-3 col-3 form-group">
                    <label>Is Tranding</label>
                    <select name="is_tranding" class="form-control">
                        @if($is_tranding == 1)
                        <option value="1" selected="">Yes</option>
                        <option value="0">No</option>
                        @else
                         <option value="1" >Yes</option>
                        <option value="0" selected="">No</option>
                        @endif
                    </select>
                </div>

                 <div class="col-xl-12 col-lg-12 col-12 form-group">
                    <label>descreption*</label>
                    <textarea  type="text" name="descreption" class="form-control" aria-required="true" aria-invalid="false">{{$descreption}}</textarea>
                    @error('descreption')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                 
                 <div class="col-xl-12 col-lg-12 col-12 form-group">
                    <label>Technical Specification*</label>
                    <input type="text" name="technical_specification" value="{{$technical_specification}}" class="form-control">
                    @error('technical_specification')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

               


                 
                      
            </div>
     </div>
   
</div>

 <!------Start Products Images Attribute Cards Section ----->
<h4> Products Images</h4>
<div id="products_images_box">
  
 <div class="card height-auto" id="">
    <div class="card-body">
      
            <div class="row" id="images_more_box">
                 @php 
                    $loop_count_num = 1;
                @endphp
              @foreach($productImagesArr as $key => $val)
                <?php 
                 $loop_count_prev = $loop_count_num;
                    //With the help of type Costing Convert Object Value to Array Format
                    $pIArr = (array)$val;
                ?>  
            <input type="hidden" id="piid" name="piid[]" value="{{$pIArr['id']}}">
                <div class="col-xl-4 col-md-4 col-lg-4 form-group" class="pro_images_loop_count_{{$loop_count_num++}}">
                    <label>Image*</label>

                    <input type="file" name="images[]"  class="form-control" {{$image_required}}>
                    @error('images')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror

                     @if($pIArr['images'] != '')
                        <a href="{{asset('storage/pro_attr_img/'.$pIArr['images'])}}" target="_blank"><img src="{{asset('storage/pro_attr_img/'.$pIArr['images'])}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                            </a>
                    @endif
                </div>
                <div class="col-xl-2 col-md-2 col-lg-2 form-group">
                    <!-----Check if two box then remove add mode button and add Remove button ---->
                    @if($loop_count_num == 2)
                    <button type="button" class="btn btn-success btn-lg" style="padding: 10px;margin-top: 30px;color: white" onclick="add_images_more();"><span class="fa  fa-plus"></span>&nbsp;Add More Images</button>
                    @else
                         <a href="{{url('admin/products/products_images_delete/')}}/{{$pIArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg" style="padding: 10px;margin-top: 30px;color: white"><span class="fa  fa-minus"></span>&nbsp;Removes</button></a>
                    @endif
                </div>
                @endforeach
        </div>
    </div>

  
<!------End Product Images  Section ----->
</div>
<!---pro attr Images div Closed-->


 <!------Start Products  Attribute Cards Section ----->
<h4> Products Attributes</h4>
<div id="products_attr_box">
   @php 
        $loop_count_num = 1;
    @endphp
  @foreach($productAttrArr as $key => $val)
    <?php 
     $loop_count_prev = $loop_count_num;
        //With the help of type Costing Convert Object Value to Array Format
        $pAArr = (array)$val;
    ?>  
 <input type="hidden" id="paid" name="prodAtrId[]" value="{{$pAArr['id']}}">
 <div class="card height-auto" id="pro_attr_loop_count_{{$loop_count_num++}}">
  <div class="card-body">
        <div class="row">
             <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-lg-4">
                            <label>SKU*</label>
                            <input type="text" name="sku[]" value="{{$pAArr['sku']}}" class="form-control" required="">
                        </div>
                        <div class="col-xl-4 col-md-4 col-lg-4">
                            <label>MRP*</label>
                            <input type="text" name="MRP[]" value="{{$pAArr['mrp']}}" class="form-control" required="">
                        </div>
                         <div class="col-xl-4 col-md-4 col-lg-4">
                            <label>Price*</label>
                            <input type="text" name="Price[]" value="{{$pAArr['price']}}" class="form-control" required="">
                        </div>
                    </div>
                 </div>

                 <!---copied --->
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>QTY*</label>
                            <input type="text" name="qty[]" value="{{$pAArr['qty']}}" class="form-control" required="">
                        </div>
                        <div class="col-xl-6 col-md-6 col-lg-6">
                            <label>Size*</label>
                            <select name="sizes_id[]" id="attr_size_id" class="form-control">
                            <option selected="" disabled="">Select</option>
                            @foreach($sizes as $size)
                                @if($pAArr['size_id'] == $size->id)
                                <option value="{{$size->id}}" selected="" >{{$size->size}}</option>
                                @else
                                    <option value="{{$size->id}}">{{$size->size}}</option>
                                @endif
                            @endforeach;
                        </select>
                       </div>
                    </div>
                </div>
         </div>
        <div class="row">
             <div class="col-xl-4 col-md-4 col-lg-4 form-group">
                 <label>Color*</label>
                <select name="color_id[]" id="attr_color_id" class="form-control">
                <option selected="" disabled="">Select</option>
                    @foreach($colors as $color)
                    @if($pAArr['color_id'] == $color->id)
                        <option value="{{$color->id}}" selected="">{{$color->color}}</option>
                    @else
                        <option value="{{$color->id}}">{{$color->color}}</option>
                    @endif
                    @endforeach;
                </select>
            </div>
            <div class="col-xl-4 col-md-4 col-lg-4 form-group" >
                <label>Image*</label>
                <input type="file" name="attr_image[]"  class="form-control" {{$image_required}}>
                @error('attr_image')
                    <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                @enderror


                @if($pAArr['attr_image'] != '')
                    <img src="{{asset('storage/pro_attr_img/'.$pAArr['attr_image'])}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                @endif
            </div>
            <div class="col-xl-4 col-md-4 col-lg-4 form-group">

                <!-----Check if two box then remove add mode button and add Remove button ---->
                @if($loop_count_num == 2)

                <button type="button" class="btn btn-success btn-lg" style="padding: 10px;margin-top: 30px;color: white" onclick="add_more_pro_attriute();"><span class="fa  fa-plus"></span>&nbsp;Add More Pro Attributes</button>

                @else
                     <a href="{{url('admin/products/products_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger btn-lg" style="padding: 10px;margin-top: 30px;color: white"><span class="fa  fa-minus"></span>&nbsp;Removes</button></a>
                @endif
            </div>
        </div>
       
    </div>
</div>
  @endforeach
<!------End Attribute Cards Section ----->
<!---pro attr div -->
</div>






<!---pro attr div -->
<div class="card">
    <div class="card-body" style="padding: 5px">
        <div class="col-12 form-group mg-t-8">
            <center>    
                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
            </center>        
        </div>
        <input type="hidden" name="id" value="{{$id}}" />
    </div>
</div>
</form>


<script>
    let loop_count = 1;
    function add_more_pro_attriute(){
        loop_count++;
        let html = '<input type="hidden" id="paid" name="prodAtrId[]" value=""><div class="card height-auto" id="pro_attr_loop_count_'+loop_count+'"> <div class="card-body"> <div class="row">';

        html += '<div class="col-xl-6 col-lg-6 col-12 form-group"> <div class="row"> <div class="col-xl-4 col-md-4 col-lg-4"> <label>SKU*</label> <input type="text" name="sku[]" value="" class="form-control" required> </div> <div class="col-xl-4 col-md-4 col-lg-4"> <label>MRP*</label> <input type="text" name="MRP[]" value="" class="form-control" required> </div> <div class="col-xl-4 col-md-4 col-lg-4"> <label>Price*</label> <input type="text" name="Price[]" value="" class="form-control" required> </div> </div></div>';

        let  attr_size_id_html = $('#attr_size_id').html();
        attr_size_id_html = attr_size_id_html.replace("selected", " ");



        html += '<div class="col-xl-6 col-lg-6 col-12 form-group"> <div class="row"> <div class="col-xl-6 col-md-6 col-lg-6"> <label>QTY*</label> <input type="text" name="qty[]" value="" class="form-control" required> </div> <div class="col-xl-6 col-md-6 col-lg-6"> <label>Size*</label><select name="sizes_id[]" id="attr_size_id" class="form-control" >'+attr_size_id_html+' </select> </div> </div> </div> </div>';

        let  color_id_html = $('#attr_color_id').html();
        color_id_html = color_id_html.replace("selected", " ");

        html += ' <div class="row"> <div class="col-xl-4 col-md-4 col-lg-4 form-group"> <label>Color*</label> <select name="color_id[]" id="attr_color_id" class="form-control"> <option selected="" disabled="">Select</option><option>'+color_id_html+'</option>  </select></div>';


        html +=' <div class="col-xl-4 col-md-4 col-lg-4 form-group" > <label>Image*</label> <input type="file" name="attr_image[]"  class="form-control" required></div> <div class="col-xl-4 col-md-4 col-lg-4 form-group"> <button type="button" class="btn btn-danger btn-lg" style="padding: 10px;margin-top: 30px;color: white" onclick=remove_attribute("'+loop_count+'");><span class="fa  fa-minus"></span>&nbsp;Remove</button> </div> </div>  </div> <div>';

        html += '</div></div></div>';
        $("#products_attr_box").append(html);
    }

    function remove_attribute(loop_count){
        $("#pro_attr_loop_count_"+loop_count).remove();
    }

    let loop_image_count = 1;

    function add_images_more(){
        // alert('yes');
        loop_image_count++;
         var html ='<input type="hidden" id="piid" name="piid[]" value=""><div class="col-xl-4 col-md-4 col-lg-4 form-group pro_images_loop_count_'+loop_image_count+'"> <label>Image*</label> <input type="file" name="images[]"  class="form-control" required></div>';

         html += '<div class="col-xl-2 col-md-2 col-lg-2 form-group pro_images_loop_count_'+loop_image_count+' "> <button type="button" class="btn btn-danger btn-lg" style="padding: 10px;margin-top: 30px;color: white" onclick=remove_remove_image_more("'+loop_image_count+'");><span class="fa  fa-minus"></span>&nbsp;Remove</button> </div>';



         $('#images_more_box').append(html);
    } 

    function remove_remove_image_more(loop_image_count){
        $(".pro_images_loop_count_"+loop_image_count).remove();
    }  




    // CKEDITOR.replace('short_desc');
    CKEDITOR.replace('descreption');
    CKEDITOR.replace('technical_specification');
</script>

@endsection


