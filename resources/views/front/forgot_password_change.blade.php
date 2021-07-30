@extends('front/layout')
@section('page_title','Change Password')
@section('container')



   <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              
              <div class="col-md-8">
                <div class="aa-myaccount-register">                 
                 <h4>Change Your Password</h4>
                 <form action="" class="aa-login-form" id="frmUpdatePassword">
                    <label for="">New Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="newpassword" required>
                    <div id="newpassword_error" class="field_error"></div> 

                    <label for="">Confirm  Password<span>*</span></label>
                    <input type="password" placeholder="Password" name="confirmpassword" required>
                    <div id="confirmpassword_error" class="field_error"></div> 


                    <button type="submit" class="aa-browse-btn" id="btnUpdatePassword">Update</button>    
                    @csrf                
                  </form>
                </div>
                <div id="thank_you_msg" class="field_error"></div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->



@endsection