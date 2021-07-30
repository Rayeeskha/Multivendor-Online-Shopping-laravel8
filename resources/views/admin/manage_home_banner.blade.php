@extends('admin/layout')
@section('banner_title', 'Manage Home Banner')
@section('banner_select', 'active')
@section('container')



  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Home Banner</h3>
                <a href="{{url('admin/home_banner')}}" class="fw-btn-fill btn btn-primary">Back</a>
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



        <form class="new-added-form" action="{{route('home_banner.managehome_bannerprocess')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Button Text</label>
                    <input type="text" name="btn_text" value="{{$btn_text}}" class="form-control">
                </div>
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Banner Link</label>
                    <input type="text" name="btn_link" value="{{$btn_link}}" class="form-control">
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Banner Title</label>
                    <input type="text" name="btn_title" value="{{$btn_title}}" class="form-control" required="">
                </div>
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Banner Discription</label>
                    <input type="text" name="btn_disc" value="{{$btn_disc}}" class="form-control" required="">
                </div>

                <div class="col-xl-6 col-lg-6 col-12 form-group">
                <label>Image*</label>
                    <input type="file" name="image"  class="form-control">
                    @if($image != '')
                        <img src="{{asset('storage/banner/'.$image)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                    @endif
                    @error('image')
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


