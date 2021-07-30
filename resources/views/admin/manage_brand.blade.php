@extends('admin/layout')
@section('brand_title', 'Manage Brands')
@section('brand_select', 'active')
@section('container')



  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Brands</h3>
                <a href="{{url('admin/brand')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
        </div>

           @error('image')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{$message}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @enderror



        <form class="new-added-form" action="{{route('brand.managebrandprocess')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Brand*</label>
                    <input type="text" name="name" value="{{$name}}" class="form-control">

                     @error('name')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-xl-6 col-lg-6 col-12 form-group">
                <label>Brand Image*</label>
                    <input type="file" name="image"  class="form-control">
                    @if($image != '')
                        <img src="{{asset('storage/brands/'.$image)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                    @endif
                    @error('image')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                 </div>
                 <div class="col-12 col-sm-4">
                    <label>Show in Home Page : </label>
                   <input type="checkbox" name="is_home" {{$is_home_selected}}> 
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


