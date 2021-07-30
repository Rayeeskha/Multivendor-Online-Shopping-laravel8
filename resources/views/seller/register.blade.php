<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
    @import "font-awesome.min.css";
@import "font-awesome-ie7.min.css";
/* Space out content a bit */
body {
  padding-top: 20px;
  padding-bottom: 20px;
}

/* Everything but the jumbotron gets side spacing for mobile first views */
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;

}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
  span{color: red}
  .field_error{color: red}
}
</style>
<div class="container">
    <h4 class="well">Create Seller Account</h4>


    <div class="col-lg-12 well">
    <div class="row">
        <form id="frmSellerAccount">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>First Name <span>*</span></label>
                        <input type="text" name="fname" placeholder="Enter First Name Here.." class="form-control"required>
                        
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Last Name </label>
                        <input type="text" name="lname" placeholder="Enter Last Name Here.." class="form-control">
                    </div>
                </div>  
                <div class="form-group">
                    <label>Phone Number <span>*</span></label>
                    <input type="number" name="phone" placeholder="Enter Phone Number Here.." class="form-control"required>
                </div>   
                <div id="phone_error" class="field_error"></div>    
                <div class="form-group">
                    <label>Email Address <span>*</span></label>
                    <input type="email" name="email" placeholder="Enter Email Address Here.." class="form-control"required>
                </div>  
                <div id="email_error" class="field_error"></div>                 
                
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label>Company <span>*</span></label>
                        <input type="text" name="company"  placeholder="Enter Company Name Here.." class="form-control" required="">
                    </div> 
                    <div id="company_error" class="field_error"></div>
                    <div class="col-sm-12 form-group">
                        <label>GST Number <span>*</span></label>
                        <input type="text" name="gstumber"  placeholder="Enter GST Name Here.." class="form-control" required="">
                    </div>
                    <div id="gstumber_error" class="field_error"></div> 
                    <div class="col-sm-12 form-group">
                        <label>Aadhar Number <span>*</span></label>
                        <input type="text" name="aadharnumber"  placeholder="Enter Aadhar  Number Here.." class="form-control" required="">
                    </div>
                    <div id="aadharnumber_error" class="field_error"></div> 
                    <div class="col-sm-12 form-group">
                        <label>PAN Number <span>*</span></label>
                        <input type="text" name="pannumber"  placeholder="Enter PAN  Number Here.." class="form-control" required="">
                    </div> 
                    <div id="pannumber_error" class="field_error"></div>  
                </div> 
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label>City <span>*</span></label>
                        <input type="text" name="city" placeholder="Enter City Name Here.." class="form-control" required="">
                        <div id="city_error" class="field_error"></div> 
                    </div> 
                    
                    <div class="col-sm-4 form-group">
                        <label>State <span>*</span></label>
                        <input type="text" name="state" placeholder="Enter State Name Here.." class="form-control"required>
                        <div id="state_error" class="field_error"></div> 
                    </div>

                    <div class="col-sm-4 form-group">
                        <label>Zip <span>*</span></label>
                        <input type="text" name="zip" placeholder="Enter Zip Code Here.." class="form-control" required="">
                        <div id="zip_error" class="field_error"></div>
                    </div>      
                </div>
                <div class="form-group">
                    <label>Address <span>*</span></label>
                    <textarea name="address" placeholder="Enter Address Here.." rows="3" class="form-control" required=""></textarea>
                    <div id="address_error" class="field_error"></div>
                </div>                      
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website" placeholder="Enter Website Name Here.." class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <label>Password <span>*</span></label>
                        <input type="password" name="password" placeholder="Enter Password" class="form-control">
                         <div id="password_error" class="field_error"></div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <label>Confirm Password <span>*</span></label>
                        <input type="password" name="confirmpassword" placeholder="Enter Password" class="form-control">
                        <div id="confirmpassword_error" class="field_error"></div>
                    </div>
                </div><br><br>
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6">
                        <a href="{{url('admin')}}" class="btn btn-lg btn-primary">Login</a>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <button type="submit" class="btn btn-lg btn-info">Register</button>  
                    </div>
                </div>
                                 
            </div>
            @csrf
        </form> 
        </div>
    </div>
    </div>

 
 <script type="text/javascript">
     $('#frmSellerAccount').submit(function(e){
      $('.field_error').html('');
      e.preventDefault();
      $.ajax({
        url:'selleraccount_process',
        data:$('#frmSellerAccount').serialize(),
        type:'post',
        success:function(result){
          if (result.status == "error") {
            $.each(result.error, function(key, val){
              $('#'+key+'_error').html(val[0]);
            });
          }
          if (result.status == "success") {
            $('#frmSellerAccount')[0].reset();
            alert(result.msg);
            }
        }
      });
    });
 </script>   