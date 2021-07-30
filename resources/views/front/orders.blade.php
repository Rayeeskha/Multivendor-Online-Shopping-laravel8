@extends('front/layout')
@section('page_title', 'Orders ')
@section('container')

<div class="container">
  <div class="card"  style="background-color: #f5f5f5;margin-top:   17%;padding: 1%">
    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

  <div class="card-body">
   <div class="row">
     <div class="col-md-6">
       <h4>{{session()->get('FRONT_USER_NAME')}}</h4>
     </div>
     <div class="col-md-6">
        <h4>My Orders</h4>
     </div>
   </div>
  </div>
</div> 
</div>
  

  <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
             
               <div class="table-responsive" >
                  <table class="table" id="datatabels">
                    <thead>
                      <tr>
                        <th>Order Id</th>
                        <th>Total Amt</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Payment ID</th>
                        <th>Placed At</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $list)
                      <tr>
                        <td class="order_id_btn"><a href="{{url('order_detail')}}/{{$list->order_id}}">{{$list->order_id }}</a></td>
                        <td>{{number_format($list->total_amount, 1)}}</td>
                        <td>
                        	<span class="badge badge-danger" style="background: red">{{$list->order_status}}</span>
                        </td>
                        <td>{{$list->payment_status}}</td>
                        
                        <td>{{$list->payment_id}}</td>
                        <td>{{date('d M Y h:i:s', strtotime($list->added_on))}}</td>
                        <td>
                          @if($list->order_status == "Cancel")
                          <span class="badge badge-danger" style="background:  red">Cancel Order</span>
                          @elseif($list->order_status == "Deliverd")
                          <span class="badge badge-success" style="background:  green">Delivered Order</span>
                          @else
                          <a href="{{url('cancelorder')}}/{{$list->order_id}}" class="btn btn-danger">Cancel</a>
                          @endif
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
           
		   </div>
         </div>
       </div>
     </div>
   </div>
 </section> 



@endsection