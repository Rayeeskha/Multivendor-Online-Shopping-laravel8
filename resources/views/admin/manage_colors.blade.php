@extends('admin/layout')
@section('page_title', 'Manage Colors')
@section('size_select', 'active')
@section('container')

  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Colors</h3>
                <a href="{{url('admin/colors')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
           
        </div>
        <form class="new-added-form" action="{{route('colors.managecolorsprocess')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-12 form-group">
                    <label>color*</label>
                    <input type="text" name="color" value="{{$color}}" class="form-control">

                     @error('color')
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


