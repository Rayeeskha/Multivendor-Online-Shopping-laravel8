@extends('front/layout')
@section('page_title','Placed Order')
@section('container')

<!-- catg header banner section -->

  <section id="aa-product-category">
   <div class="container">
      <div class="row" style="text-align:center; color: green">
        <br/><br/><br/>
            <h2 style="color:green">Your Order has been Placed Succcessfully</h2>
     	<h3>Order Id :- {{session()->get('ORDER_ID')}}</h3>
        <br/><br/><br/>
      </div>
   </div>
</section>
  <!-- / catg header banner section -->  

@endsection