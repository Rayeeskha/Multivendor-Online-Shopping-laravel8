@extends('admin/layout')
@section('page_title', 'Coupons')
@section('coupon_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">
    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>
    <div class="heading-layout1">
        <div class="item-title">
            <h3>Coupons</h3>
        </div>
     </div>
    <form class="mg-b-20">
        <div class="row gutters-8">
             <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
               <a href="{{url('admin/coupon/managecoupons')}}" class="btn btn-primary  fw-btn-fill btn-gradient-success" style="width: 170px;height: 40px">Manage Coupons</a>
            </div>
            <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group"> </div>
            <div class="col-5-xxxl col-xl-5 col-lg-5 col-12 form-group">
                <input type="text" placeholder="Search by Name ..." class="form-control">
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
                    <th>S.NO</th>
                    <th>Coupon Title</th>
                    <th>Coupon Code</th>
                    <th>Coupon Value</th>
                    <th>Min Order Amount</th>
                    <th>Is one time</th>
                    <th>Expiry date</th>
                    <th>Expired On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupon as $coup)
                <tr>
                   <td>{{$coup->id}}</td>
                    <td>{{$coup->title}}</td>
                    <td>{{$coup->code}}</td>
                    <td>
                        @if($coup->coupon_type == 'Percentage')
                        <span style="color: green">{{$coup->value}} %</span>
                        @else
                            <span style="color: orange" class="fa fa-rupee-sign">&nbsp;{{$coup->value}}</span>
                        @endif 
                    </td>
                    <td>{{$coup->min_order_amnt}}</td>
                    <td>
                        @if($coup->is_one_time == 0)
                        <span class="badge badge-primary">No</span>
                        @else
                        <span class="badge badge-danger">Yes</span>
                        @endif
                       
                    </td>

                    <td>
                        @if($coup->expirydate >= date('Y-m-d'))
                        <span style="color: green;font-weight: 500;font-size: 12px">Activated Coupon</span>
                        @else
                        <span style="color: red;font-weight: 500;font-size: 12px">Expired</span>
                        @endif
                    </td>
                    <td>
                        {{date('d M Y', strtotime($coup->expirydate))}}
                    </td>
                    <td>
                        @if($coup->status == 'Active')
                       <span style="color: green;font-weight: 500;font-size: 12px"> {{$coup->status}}</span>
                        @else
                            <span style="color: red;font-weight: 500;font-size: 12px">{{$coup->status}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Coupons details ?')" href="{{url('admin/coupon/delete/')}}/{{$coup->id}}"><i class="fas fa-times text-orange-red" ></i>Delete</a>
                                <a class="dropdown-item" href="{{url('admin/coupon/managecoupons/')}}/{{$coup->id}}"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>

                                @if($coup->status == 'Active')
                                   <a class="dropdown-item" href="{{url('admin/coupon/changecouponstatus/')}}/{{$coup->id}}/Deactivate"><i class="fas fa-cogs text-dark-pastel-green"></i>Deactivate</a>
                                @else
                                    <a class="dropdown-item" href="{{url('admin/coupon/changecouponstatus/')}}/{{$coup->id}}/Active"><i class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
                                @endif
                                

                                
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


