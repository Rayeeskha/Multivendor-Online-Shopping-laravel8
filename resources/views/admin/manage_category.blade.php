@extends('admin/layout')
@section('page_title', 'Manage Category')
@section('category_select','active')
@section('container')

  <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Manage Category</h3>
                <a href="{{url('admin/category')}}" class="fw-btn-fill btn btn-primary">Back</a>
            </div>
           
        </div>
        <form class="new-added-form" action="{{route('category.managecategoryprocess')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Category Name*</label>
                    <input type="text" name="category" value="{{$category_name}}" class="form-control">

                     @error('category')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Category Slug*</label>
                    <input type="text" name="category_slug" value="{{$category_slug}}" class="form-control">
                    @error('category_slug')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>
                 <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Parent Category*</label>
                    <select name="parent_category_id" class="form-control">
                        <option selected="" disabled="">Select Category</option>
                        @foreach($categories as $list)
                        @if($parent_category_id == $list->id)
                        <option value="{{$list->id}}" selected>{{$list->category_name}}</option>
                        @else
                            <option value="{{$list->id}}" >{{$list->category_name}}</option>
                            @endif
                        @endforeach;
                    </select>
                   @error('parent_category_id')
                        <span style="color:red;font-weight: 500;font-size: 14px">{{ $message }}</span>
                    @enderror
                </div>

                  <div class="col-xl-6 col-lg-6 col-12 form-group">
                    <label>Category Image*</label>
                    <input type="file" name="category_image"  class="form-control">
                    @if($category_image != '')
                        <img src="{{asset('storage/category_image/'.$category_image)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                    @endif
                    @error('category_image')
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


