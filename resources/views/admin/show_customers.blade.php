@extends('admin/layout')
@section('page_title', 'Customer Details')
@section('customers_select', 'active')
@section('container')
<div class="card height-auto">
    <div class="card-body">
        <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Customer Details</h3>
                <a href="{{url('admin/customers')}}" class="btn btn-primary">Back</a>
            </div>
         </div>
         <div class="table-responsive">
            <table class="table display data-table text-nowrap">
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td>{{$customer_list->name}}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{$customer_list->email}}</td>
                </tr>
                <tr>
                    <td><strong>Mobile</strong></td>
                    <td>{{$customer_list->mobile}}</td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td>{{$customer_list->address}}</td>
                </tr>
                <tr>
                    <td><strong>Pincode</strong></td>
                    <td>{{$customer_list->pincode}}</td>
                </tr>
                 <tr>
                    <td><strong>State</strong></td>
                    <td>{{$customer_list->state}}</td>
                </tr>
                <tr>
                    <td><strong>City</strong></td>
                    <td>{{$customer_list->city}}</td>
                </tr>
                 <tr>
                    <td><strong>GST NO</strong></td>
                    <td>{{$customer_list->gstno}}</td>
                </tr>
                <tr>
                    <td><strong>Status</strong></td>
                    <td><span class="badge badge-primary">{{$customer_list->status}}</span></td>
                </tr>
                <tr>
                    <td><strong>Added On</strong></td>
                    <td><span class="badge badge-info">
                        {{\Carbon\Carbon::parse($customer_list->created_at)->format('d-M-Y h:i')}}
                    </span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>




@endsection


