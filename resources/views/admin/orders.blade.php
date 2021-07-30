@extends('admin/layout')
@section('page_title', 'Orders')
@section('orders_select', 'active')
@section('container')

 <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Manage Orders</h3>
                </div>
               
            </div>
            <form class="mg-b-20" action="{{url('/admin/Searchorder')}}">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-7 col-lg-7 col-12 form-group"></div>
                    
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" name="order_id" value="{{old('order_id')}}" placeholder="Search by Order Id ..." class="form-control" >
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
        <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            
                            <th>Order Id</th>
                            <th>Customer details</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Payment Type</th>
                            <th>Payment Status</th>
                            <th>Order Date</th>
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $list)
                      <tr>
                        <td class="order_id_btn"><a href="{{url('admin/order_detail')}}/{{$list->order_id}}">{{$list->order_id }}</a></td>
                        <td>
                        	{{$list->name}}<br>
                        	{{$list->email}}<br>
                        	{{$list->mobile}}<br>
                        	{{$list->address}},{{$list->city}},{{$list->state}},{{$list->pincode}}

                        </td>
                        <td>{{number_format($list->total_amount, 1)}}</td>
                        <td>
                        	<span class="badge badge-danger" style="background: red">{{$list->order_status}}</span>
                        </td>
                        <td>
                        	@if($list->payment_type == "COD")
                        	<span class="badge badge-warning" >{{$list->payment_type}}</span><br>
                        	@else
                        	<span class="badge badge-success" >{{$list->payment_type}}</span>
                        	@endif
						</td>
                        <td>
                        	@if($list->payment_type == "Gateway")
	                        	<span class="badge badge-success" >{{$list->payment_status}}</span><br>
	                        	{{$list->payment_id}}
	                        	@else
	                        	<span class="badge badge-warning" >{{$list->payment_status}}</span>
	                        	@endif
						</td>
                        
                        
                        <td>{{date('d M Y ', strtotime($list->added_on))}}</td>
                         <td>
                            <div class="dropdown">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                   
                                    <a class="dropdown-item" href="{{url('admin/order_detail')}}/{{$list->order_id}}"><i class="fas fa-redo-alt text-orange-peel"></i>View</a>
                                </div>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection