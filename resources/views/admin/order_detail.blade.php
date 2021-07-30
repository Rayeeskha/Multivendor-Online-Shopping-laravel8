@extends('admin/layout')
@section('banner_title', 'Orders')
@section('orders_select', 'active')
@section('container')


 <div class="col-4-xxxl col-12">
    <div class="card dashboard-card-six">
        <div class="card-body">
            <div class="row">
            	<div class="col-lg-6 col-md-6">
            		<h3>Order Id => {{$orders_details[0]->order_id}}</h3>
                </div>
            	<div class="col-lg-6 col-md-6">
            		<a href="{{url('admin/Orders')}}" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Back</a>
            	</div>
            </div>
        </div>
    </div>
</div>

<div class="col-4-xxxl col-12">
    <div class="card dashboard-card-six">
        <div class="card-body">
        	<center>
        		<h5>Customer Details</h5>
        	</center>
            <div class="row">
            	<div class="col-lg-6 col-md-6">
            		<h6>Name : {{$orders_details[0]->name}}</h6>
            		<h6>Mobile : <a href="tel:{{$orders_details[0]->mobile}}">{{$orders_details[0]->mobile}}</a></h6>
            		<h6>Email : <a href="mailto:{{$orders_details[0]->email}}">{{$orders_details[0]->email}}</a></h6>
            		
                </div>
            	<div class="col-lg-6 col-md-6">
            		<h6>Address: {{$orders_details[0]->address}}</h6>
            		<h6>City: {{$orders_details[0]->city}}</h6>
            		<h6>State: {{$orders_details[0]->state}}&nbsp;&nbsp;{{$orders_details[0]->pincode}}</h6>
            	</div>
            </div>
        </div>
    </div>
</div>


 <div class="col-4-xxxl col-12">
    <div class="card dashboard-card-six">
        <div class="card-body">
            <div class="heading-layout1 mg-b-17">
                <div class="item-title">
                    <h3>Order Details</h3>
                </div>
                
            </div>
            <div class="notice-box-wrap">
                <div class="notice-list">
                     <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                     @php 
                     $totalAmt=0;
                     @endphp
                     @foreach($orders_details as $list)
                     @php 
                     $totalAmt=$totalAmt+($list->price*$list->qty);
                     @endphp
                     <tr>
                        <td>{{$list->pname}}</td>
                        <td><img src='{{asset('storage/pro_attr_img/'.$list->attr_image)}}' / style="width:50px"></td>
                        <td>{{$list->size}}</td>
                        <td>{{$list->color}}</td>
                        <td>{{number_format($list->price)}}</td>
                        <td>{{$list->qty}}</td>
                        <td>{{number_format($list->price*$list->qty)}}</td>
                      </tr>
                     @endforeach
                     <tr>
                        <td colspan="5">&nbsp;</td>
                        <td><b>Payment Type</b></td>
                        <td><b>
                        	@if($list->payment_type == "COD")
                        	{{$list->payment_type}}
                        	<span class="badge badge-danger" style="background: red">{{$list->payment_type}}</span>
                        	@else
                        	<span class="badge badge-info">{{$list->payment_type}}</span>
                        	@endif
                        </b></td>
                      </tr>
                      <tr>
                        <td colspan="5">&nbsp;</td>
                        <td><b>Payment Status</b></td>
                        <td><b>
                        	
                        	@if($list->payment_status == "Pending")
                        	<span class="badge badge-danger" style="background: red">{{$list->payment_status}}</span>
                        	@else
                        	<span class="badge badge-success">{{$list->payment_status}}</span>
                        	@endif
                        </b>
                    </td>
                      </tr>
                     <tr>
                        <td colspan="5">&nbsp;</td>
                        <td><b>Total</b></td>
                        <td><b>{{number_format($totalAmt)}}</b></td>
                      </tr>
                      <?php
                      if($orders_details[0]->coupon_value>0){
                        echo '<tr>
                          <td colspan="5">&nbsp;</td>
                          <td><b>Coupon <span class="coupon_apply_txt">('.$orders_details[0]->coupon_code.')</span></b></td>
                          <td>'.$orders_details[0]->coupon_value.'</td>
                        </tr>';
                        $totalAmt=$totalAmt-$orders_details[0]->coupon_value;
                        echo '<tr>
                          <td colspan="5">&nbsp;</td>
                          <td><b>Final Total</b></td>
                          <td>'.number_format($totalAmt).'</td>
                        </tr>';
                      } 
                      ?>
                    </tbody>
                    </table>
                </div>
            </div>
		</div>

    </div>
</div>

 <div class="col-4-xxxl col-12">
    <div class="card dashboard-card-six">
        <div class="card-body">
            <div class="row">
            	<div class="col-lg-6 col-md-6">
            		<h6><b>Order Status</b></h6>
            		<select class="select2" id="order_status" onchange="update_order_status('{{$orders_details[0]->order_id}}')">
	                    <?php 
            				foreach($order_status as  $list){
            					if ($orders_details[0]->order_status == $list->order_status) {
            						echo "<option value='$list->order_status' selected>$list->order_status</option>";
            					}else{
            						echo "<option value='$list->order_status'>$list->order_status</option>";
            					}
            				}
						?>
	                </select>
                </div>
            	<div class="col-lg-6 col-md-6">
            		<h6><b>Payment Status</b></h6>
            		<select class="select2" id="payment_status" onchange="update_payment_status('{{$orders_details[0]->order_id}}')">
            			<?php 
            				foreach($payment_status as  $list){
            					if ($orders_details[0]->payment_status == $list) {
            						echo "<option value='$list' selected>$list</option>";
            					}else{
            						echo "<option value='$list'>$list</option>";
            					}
            				}
						?>
	                    
	                </select>
            	</div>
            	
            </div>
            <form method="post">
            	<h6><b>Track Details</b></h6>
            	<div class="form-group">
            		<textarea class="textarea form-control" name="track_details" style="height: 100px;border: 1px solid silver" required="">{{$orders_details[0]->track_details}}</textarea>
            	</div>
            	
            	<center>
            		<button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" >Track</button>
            	</center>
            	@csrf
        	</form>
        </div>
    </div> 
</div>
@endsection