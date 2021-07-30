@extends('admin/layout')
@section('page_title', 'Manage Coupon')
@section('coupon_select', 'active')
@section('container')

  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Coupon</h3>
                <a href="{{url('admin/coupon')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
           
        </div>
        <form class="new-added-form" action="{{route('coupon.managecouponprocess')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Coupon Title*</label>
                    <input type="text" name="title" value="{{$title}}" class="form-control">

                     @error('title')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Coupon Code*</label>
                    <input type="text" name="code" value="{{$code}}" class="form-control">
                    @error('code')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Coupon Value*</label>
                    <input type="text" name="value" value="{{$value}}" class="form-control">
                    @error('value')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Expiry Date*</label>
                    <input type="date" name="expirydate" value="{{$expirydate}}" class="form-control">
                    @error('expirydate')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-xl-4 col-lg-4 col-12 form-group">
                    <label>Coupon Type*</label>
                    <select name="coupon_type" class="form-control">
                        @if($coupon_type == 'Value')
                        <option value="Value" selected="">Rupees</option>
                        <option value="Percentage">Percentage</option>
                         @elseif($coupon_type == 'Percentage')
                        <option value="Value" >Rupees</option>
                        <option value="Percentage" selected="">Percentage</option>
                        @else
                        <option value="Value">Rupees</option>
                        <option value="Percentage">Percentage</option>
                        @endif
                    </select>
                </div>
                <div class="col-xl-4 col-lg-4 col-12 form-group">
                    <label>Min Order Amount*</label>
                    <input type="text" name="min_order_amnt" value="{{$min_order_amnt}}" class="form-control">
                </div>
                 <div class="col-xl-4 col-lg-4 col-12 form-group">
                    <label>Is One Time*</label>
                    <select name="is_one_time" class="form-control">
                        @if($is_one_time == '1')
                        <option value="1" selected="">Yes</option>
                        <option value="0">No</option>
                        @else
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                        @endif
                    </select>
                </div>
                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                   
                </div>

                <input type="hidden" name="id" value="{{$id}}" />
            </div>
        </form>
    </div>
</div>
@endsection


