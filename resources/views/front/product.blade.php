@extends('front/layout')
@section('page_title', $product[0]->name)
@section('container')

<style type="text/css">

  .aa-color-red{background-color: red}
  .aa-color-orange{background-color: orange}
</style>
 <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="{{asset('storage/products/'.$product[0]->image)}}" class="simpleLens-lens-image"><img src="{{asset('storage/products/'.$product[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                         
                          @if(isset($product_images[$product[0]->id][0]))
                          @foreach($product_images[$product[0]->id] as $list)

                           <a data-big-image="{{asset('storage/pro_attr_img/'.$list->images)}}" data-lens-image="{{asset('storage/pro_attr_img/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="{{asset('storage/pro_attr_img/'.$list->images)}}" width="50px">
                          </a>                                    
                          @endforeach
                          @endif

                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$product[0]->name}}</h3>
                    <div class="aa-price-block">
                        &nbsp;
                        <span class="aa-product-view-price fa fa-inr" style="color: green">
                        {{number_format($product_attr[$product[0]->id][0]->price, 1)}} 
                        </span>&nbsp;
                        <span class="aa-product-view-price">
                       <del style="color: red"> {{number_format($product_attr[$product[0]->id][0]->mrp)}} </del>
                        </span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                      
                      <?php $seller =  get_seller_details($product[0]->seller_id); ?>
                      @if($seller)
                      @if($seller[0]->role =="Seller")
                      <p class="aa-product-avilability" style="font-size: 12px;font-weight: 800">Seller : <span  style="color: red;">{{$seller[0]->fname}}&nbsp;{{$seller[0]->lname}}</span></p>
                      @endif
                      @endif
                       
                      @if($product[0]->lead_time!="")
                      <p class="aa-product-avilability" style="font-size: 12px;font-weight: 800">Delivery : <span  style="color: red;">{{$product[0]->lead_time}}</span></p>
                      @endif
                    </div>
                    <p>{!! $product[0]->short_desc !!}</p>
                    @if($product_attr[$product[0]->id][0]->size_id >0)
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                      @php
                          $arrSize = [];
                          foreach($product_attr[$product[0]->id] as $attr){
                              $arrSize[]  = $attr->size;
                          }
                          $arrSize = array_unique($arrSize);
                      @endphp

                       @foreach($arrSize as $attr)
                        @if($attr!="")
                        <a href="javascript:void(0)" onclick="show_product_color('{{$attr}}')" id="size_{{$attr}}" class="size_link">{{$attr}}</a>
                        @endif
                        
                      @endforeach
                  </div>
                  @endif
                  @if($product_attr[$product[0]->id][0]->color_id >0)
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                      @foreach($product_attr[$product[0]->id] as $attr)
                        @if($attr->color!="")
                        
                        <a href="javascript:void(0)" class="aa-color-{{strtolower($attr->color)}} product_color size_{{$attr->size}}"  onclick=change_product_color_image("{{asset('storage/pro_attr_img/'.$attr->attr_image)}}","{{$attr->color}}")></a>
                        @endif
                      @endforeach

                    </div>


                  @endif


                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="qty" name="qty">
                          @for($i = 1; $i<11; $i++)
                               <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                      </form>
                      <p class="aa-prod-category">
                        Model: <a href="#">{{$product[0]->model}}</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}', '{{$product_attr[$product[0]->id][0]->size_id }}', '{{$product_attr[$product[0]->id][0]->color_id}}')">Add To Cart</a>
                      <div id="add_to_cart_msg"></div>
                      <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                      <a class="aa-add-to-cart-btn" href="#">Compare</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technical_specification" data-toggle="tab">Technical Specification</a></li>
                <li><a href="#uses" data-toggle="tab">Uses</a></li>
                <li><a href="#warrenty" data-toggle="tab">Warrenty</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>{!!$product[0]->descreption!!}</p>
                </div>
                <div class="tab-pane fade" id="technical_specification">
                  <p>{!!$product[0]->technical_specification!!}</p>
                </div>
                <div class="tab-pane fade" id="uses">
                  <p>{!!$product[0]->uses!!}</p>
                </div>
                <div class="tab-pane fade" id="warrenty">
                  <p>{!!$product[0]->warrenty!!}</p>
                </div>

                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   @if(isset($product_review[0]))    
                   <h4>
                   @php  
                      echo count($product_review);
                   @endphp
                    Review(s) for {{$product[0]->name}}</h4> 
                   <ul class="aa-review-nav">
                     @foreach($product_review as $list)
                     <li>
                        <div class="media">
                          <div class="media-body">
                            <h4 class="media-heading"><strong>{{$list->name}}</strong> - <span>{{date('d M Y', strtotime($list->added_on))}}</span></h4>
                            <div class="aa-product-rating">
                              <span class="rating_txt">{{$list->rating}}</span>
                            </div>
                            <p>{{$list->review}}</p>
                          </div>
                        </div>
                      </li>
                      @endforeach
                   </ul>
                   @else
                        <h2 style="color: red">No review found</h2>
                      @endif
                      
                   
                   <!-- review form -->
                   <form id="frmProductReview" class="aa-review-form">
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <select class="form-control" name="rating" required>
                      <option value="">Select Rating</option>
                      <option>Worst</option>
                      <option>Bad</option>
                      <option>Good</option>
                      <option>Very Good</option>
                      <option>Fantastic</option>
                     </select>
                   </div>
                   <!-- review form -->
                   
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3"  name="review" required></textarea>
                      </div>
                      
                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                      <input type="hidden" name="product_id" value="{{$product[0]->id}}"/>
                      @csrf
                   </form>
                   <div class="review_msg"></div>
                 </div>
                </div>            
              </div>
            </div>
                 </div>
                </div>            
              </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">
                <!-- start single product item -->
                @if(isset($related_product[0]))
                @foreach($related_product as $productArr)
                <li>
                  <figure >
                    <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}"><img src="{{asset('storage/products/'.$productArr->image)}}" alt="{{$productArr->name}}" style="width: 100%;height: 300px"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                      <h4 class="aa-product-title"><a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a></h4>
                      <span class="fa  fa-inr">
                         {{number_format($related_product_attr[$productArr->id][0]->mrp)}} 
                      </span><span class="aa-product-price"><del>{{number_format($related_product_attr[$productArr->id][0]->price)}}</del></span>
                    </figcaption>
                  </figure>                        
                  
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                <!-- start single product item -->
                @endforeach
                @else
                <li>
                  <h6 style="color: red">No Data Found</h6>
                </li>
                @endif
                                               
              </ul>
             
              </div>
              <!-- / quick view modal -->   
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->

<form id="frmAddToCart">
  @csrf
  <input type="hidden" name="size_id" id="size_id">
  <input type="hidden" name="color_id" id="color_id">
  <input type="hidden" name="pqty" id="pqty">
  <input type="hidden" name="product_id" id="product_id">
</form>

  

@endsection


