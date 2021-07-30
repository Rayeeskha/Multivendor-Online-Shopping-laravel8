@extends('admin/layout')
@section('page_title', 'Category')
@section('category_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">

    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

    <div class="heading-layout1">
        <div class="item-title">
            <h3>Categories</h3>
        </div>
       
    </div>
    <form class="mg-b-20">
        <div class="row gutters-8">
             <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
               <a href="category/managecategories" class="btn btn-primary  fw-btn-fill btn-gradient-success" style="width: 170px;height: 40px">Manage Categories</a>
            </div>
            <div class="col-2-xxxl col-xl-2 col-lg-2 col-12 form-group">
                
            </div>
           
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
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($category as $cate)
                <tr>
                    
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->category_name}}</td>
                   
                    <td>{{$cate->category_slug}}</td>
                    <td>
                        @if($cate->category_image != '')
                            <img src="{{asset('storage/category_image/'.$cate->category_image)}}" style="width: 35px;border-radius: 100%">
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Category ?')" href="{{url('admin/category/delete/')}}/{{$cate->id}}"><i class="fas fa-times text-orange-red" ></i>Delete</a>
                                <a class="dropdown-item" href="{{url('admin/category/managecategories/')}}/{{$cate->id}}"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                
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


