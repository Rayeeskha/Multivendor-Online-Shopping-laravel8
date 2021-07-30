@extends('admin/layout')
@section('page_title', 'Colors')
@section('review_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">

    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

    <div class="heading-layout1">
        <div class="item-title">
            <h3>Mange Product Review</h3>
        </div>
       
    </div>
   
    <div class="table-responsive">
        <table class="table display data-table text-nowrap">
            <thead>
                 <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tbody>
                    @foreach($data as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->pname}}</td>
                        <td>{{$list->rating}}</td>
                        <td>{{$list->review}}</td>
                        <td>{{date('d M Y', strtotime($list->added_on))}}</td>
                        <td>
                            @if($list->status==1)
                                <a href="{{url('admin/update_product_review_status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary" style="background: red">Deactive</button></a>
                             @elseif($list->status==0)
                                <a href="{{url('admin/update_product_review_status/1')}}/{{$list->id}}"><button type="button" class="btn btn-info" >Active</button></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
             
        </table>
    </div>
</div>
</div>




@endsection


