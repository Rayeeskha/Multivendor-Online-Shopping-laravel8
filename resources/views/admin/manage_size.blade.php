@extends('admin/layout')
@section('page_title', 'Manage Size')
@section('size_select', 'active')
@section('container')

  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Size</h3>
                <a href="{{url('admin/size')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
           
        </div>
        <form class="new-added-form" action="{{route('size.managesizeprocess')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Size*</label>
                    <input type="text" name="size" value="{{$size}}" class="form-control">

                     @error('size')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
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


