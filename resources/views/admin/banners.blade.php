@extends('admin/layout')
@section('banner_title', 'Home Banner')
@section('banner_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">

    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

    <div class="heading-layout1">
        <div class="item-title">
            <h3>Banners</h3>
        </div>
       
    </div>
    <form class="mg-b-20">
        <div class="row gutters-8">
             <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
               <a href="{{url('admin/home_banner/manage_home_banner')}}" class="btn btn-primary  fw-btn-fill btn-gradient-success" style="width: 170px;height: 40px">Add Home Banner</a>
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
                    
                    <th>Btn Text</th>
                    <th>Btn Link</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Discription</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $cate)
                <tr>
                    
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->btn_text}}</td>
                    <td>{{$cate->btn_link}}</td>
                    <td>{{$cate->btn_title}}</td>
                    <td>{{$cate->btn_disc}}</td>
                    <td>
                        @if($cate->image != '')
                        <img src="{{asset('storage/banner/'.$cate->image)}}" style="width: 100px;border-radius: 3%;margin-top: 10px;height: 50px">
                        @endif
                    </td>
                   
                    <td>
                        @if($cate->status == 'Active')
                       <span style="color: green;font-weight: 500;font-size: 12px"> {{$cate->status}}</span>
                        @else
                            <span style="color: red;font-weight: 500;font-size: 12px">{{$cate->status}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Banner ?')" href="{{url('admin/home_banner/delete/')}}/{{$cate->id}}"><i class="fas fa-times text-orange-red" ></i>Delete</a>

                                <a class="dropdown-item" href="{{url('admin/home_banner/manage_home_banner/')}}/{{$cate->id}}"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>

                                  @if($cate->status == 'Active')
                                   <a class="dropdown-item" href="{{url('admin/home_banner/changehome_bannerstatus/')}}/{{$cate->id}}/Deactivate"><i class="fas fa-cogs text-dark-pastel-green"></i>Deactivate</a>
                                @else
                                    <a class="dropdown-item" href="{{url('admin/home_banner/changehome_bannerstatus/')}}/{{$cate->id}}/Active"><i class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
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


