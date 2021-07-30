@extends('front/layout')
@section('page_title', 'Carts ')
@section('container')




 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
              @php $finaltotal =0; @endphp
             	@if(isset($list[0]))
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>X</th>
                        <th>Product Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    
                    @foreach($list as $data)
                    @php $finaltotal +=   $data->qty  * $data->price; @endphp
                    <tbody>
                      <tr id="cart_box{{$data->attr_id}}">
                        <td><a class="remove" href="javascript:void(0)" onclick="deleteCartProducts('{{$data->pid}}','{{$data->size}}','{{$data->color}}','{{$data->attr_id}}')"><fa class="fa fa-close"></fa></a></td>

                        <td><a href="{{url('product/'.$data->slug)}}" target="_blank">
                        	<img src="{{asset('storage/products/'.$data->image)}}" alt="{{$data->name}}" style="width: 100px;height: 50px"></a>
                        </td>
                        <td><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}" target="_blank">{{$data->name}}</a>
                           <br>
                          @if($data->size != "")
                          SIZE: {{$data->size}}<br/>
                          @endif
                          @if($data->color != "")
                          COLOR: {{$data->color}}<br/>
                          @endif
                        </td>
                        <td><span class="fa fa-inr">&nbsp;{{number_format($data->price)}}</span></td>
                        <td>
                          <input id="qty{{$data->attr_id}}" class="aa-cart-quantity" type="number" value="{{$data->qty}}" onchange="update_cart_Qty('{{$data->pid}}','{{$data->size}}','{{$data->color}}', '{{$data->attr_id}}', '{{$data->price}}')">
                        </td>
                        <td id="total_price_{{$data->attr_id}}">{{number_format($data->price * $data->qty)}}</td>
                      </tr>
                     
                     @endforeach
                     
                      </tbody>
                  </table>
                </div>
                @else
                <h4 style="color: red">Data Not Found</h4>
                @endif
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Total</th>
                     <td><span class="fa fa-inr"></span>&nbsp;
                      {{number_format($finaltotal)}}
                   </td>
                   </tr>
                 </tbody>
               </table>
               <a href="{{url('/Checkout')}}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <input type="hidden" id="qty" value="1"/>
  <form id="frmAddToCart">
    <input type="hidden" id="size_id" name="size_id"/>
    <input type="hidden" id="color_id" name="color_id"/>
    <input type="hidden" id="pqty" name="pqty"/>
    <input type="hidden" id="product_id" name="product_id"/>           
    @csrf
  </form>



@endsection