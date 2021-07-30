/** 
  * Template Name: Daily Shop
  * Version: 1.0  
  * Template Scripts
  * Author: MarkUps
  * Author URI: http://www.markups.io/

  Custom JS
  

  1. CARTBOX
  2. TOOLTIP
  3. PRODUCT VIEW SLIDER 
  4. POPULAR PRODUCT SLIDER (SLICK SLIDER) 
  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  6. LATEST PRODUCT SLIDER (SLICK SLIDER) 
  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  9. PRICE SLIDER  (noUiSlider SLIDER)
  10. SCROLL TOP BUTTON
  11. PRELOADER
  12. GRID AND LIST LAYOUT CHANGER 
  13. RELATED ITEM SLIDER (SLICK SLIDER)

  
**/

jQuery(function($){


  /* ----------------------------------------------------------- */
  /*  1. CARTBOX 
  /* ----------------------------------------------------------- */
    
     jQuery(".aa-cartbox").hover(function(){
      jQuery(this).find(".aa-cartbox-summary").fadeIn(500);
    }
      ,function(){
          jQuery(this).find(".aa-cartbox-summary").fadeOut(500);
      }
     );   
  
  /* ----------------------------------------------------------- */
  /*  2. TOOLTIP
  /* ----------------------------------------------------------- */    
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery('[data-toggle2="tooltip"]').tooltip();

  /* ----------------------------------------------------------- */
  /*  3. PRODUCT VIEW SLIDER 
  /* ----------------------------------------------------------- */    

    jQuery('#demo-1 .simpleLens-thumbnails-container img').simpleGallery({
        loading_image: 'demo/images/loading.gif'
    });

    jQuery('#demo-1 .simpleLens-big-image').simpleLens({
        loading_image: 'demo/images/loading.gif'
    });

  /* ----------------------------------------------------------- */
  /*  4. POPULAR PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-popular-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 

  
  /* ----------------------------------------------------------- */
  /*  5. FEATURED PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-featured-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });
    
  /* ----------------------------------------------------------- */
  /*  6. LATEST PRODUCT SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      
    jQuery('.aa-latest-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  7. TESTIMONIAL SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */     
    
    jQuery('.aa-testimonial-slider').slick({
      dots: true,
      infinite: true,
      arrows: false,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });

  /* ----------------------------------------------------------- */
  /*  8. CLIENT BRAND SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */  

    jQuery('.aa-client-brand-slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
    });

  /* ----------------------------------------------------------- */
  /*  9. PRICE SLIDER  (noUiSlider SLIDER)
  /* ----------------------------------------------------------- */        

    jQuery(function(){
      if($('body').is('.productPage')){
       var skipSlider = document.getElementById('skipstep');
       let filter_price_start = $('#filter_price_start').val();
       let filter_price_end = $('#filter_price_end').val();
       if (filter_price_start == '' || filter_price_end =='') {
          filter_price_start = 100;
          filter_price_end = 4000;
       }
        noUiSlider.create(skipSlider, {
            range: {
                'min': 0,
                '10%': 100,
                '15%': 200,
                '20%': 300,
                '25%': 500,
                '30%': 600,
                '35%': 800,
                '40%': 1000,
                '45%': 1200,
                '50%': 1300,
                '55%': 1500,
                '60%': 1900,
                '65%': 2000,
                '70%': 2200,
                '75%': 2400,
                '80%': 2600,
                '85%': 2800,
                '90%': 3000,
                '95%': 3500,
                'max': 4000
            },
            snap: true,
            connect: true,
            start: [filter_price_start, filter_price_end]
        });
        // for value print
        var skipValues = [
          document.getElementById('skip-value-lower'),
          document.getElementById('skip-value-upper')
        ];

        skipSlider.noUiSlider.on('update', function( values, handle ) {
          skipValues[handle].innerHTML = values[handle];
        });
      }
    });


    
  /* ----------------------------------------------------------- */
  /*  10. SCROLL TOP BUTTON
  /* ----------------------------------------------------------- */

  //Check to see if the window is top if not then display button

    jQuery(window).scroll(function(){
      if ($(this).scrollTop() > 300) {
        $('.scrollToTop').fadeIn();
      } else {
        $('.scrollToTop').fadeOut();
      }
    });
     
    //Click event to scroll to top

    jQuery('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
  
  /* ----------------------------------------------------------- */
  /*  11. PRELOADER
  /* ----------------------------------------------------------- */

    jQuery(window).load(function() { // makes sure the whole site is loaded      
      jQuery('#wpf-loader-two').delay(200).fadeOut('slow'); // will fade out      
    })

  /* ----------------------------------------------------------- */
  /*  12. GRID AND LIST LAYOUT CHANGER 
  /* ----------------------------------------------------------- */

  jQuery("#list-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").addClass("list");
  });
  jQuery("#grid-catg").click(function(e){
    e.preventDefault(e);
    jQuery(".aa-product-catg").removeClass("list");
  });


  /* ----------------------------------------------------------- */
  /*  13. RELATED ITEM SLIDER (SLICK SLIDER)
  /* ----------------------------------------------------------- */      

    jQuery('.aa-related-item-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
    }); 
    
});


function change_product_color_image(img,color){
  $('#color_id').val(color);
  $('.simpleLens-big-image-container').html('<a  data-lens-image="'+img+'" class="simpleLens-lens-image"><img src="'+img+'" class="simpleLens-big-image"> </a>');
}


function show_product_color(size){
  $('#size_id').val(size);
  $('.product_color').hide();
  $('.size_'+size).show();
  $('.size_link').css('border', '0px');
  $('#size_'+size).css('border', '1px solid green');
}

function add_to_cart(id,size_str_id,color_str_id){
   $('#add_to_cart_msg').html('');
  let size_id = $('#size_id').val();
  let color_id = $('#color_id').val();
  if(size_str_id==0 && color_str_id==0){
    size_str_id = 'no';
    color_str_id = 'no';
  }
  if (size_id == "" && size_str_id!='no'){
    $('#add_to_cart_msg').html('<div class="alert alert-danger mt10" role="alert">  <strong>Please !</strong> Select Size First<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }else if(color_id =="" && color_str_id!='no'){
   $('#add_to_cart_msg').html('<div class="alert alert-danger mt10" role="alert">  <strong>Please !</strong> Select Color First<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  }else{
    $('#product_id').val(id);
    let qty = $('#qty').val();
    $('#pqty').val(qty);
    $.ajax({
      url:'/add_to_cart',
      data:$('#frmAddToCart').serialize(),
      type:'POST',
      success:function(result){
        //alert('Product '+result.msg);
        if(result.msg == 'not_avaliable'){
          $('#errormodel').modal('show');
         
          $('#errormodel_heading').html('Product Not Availale'+result.data);
        }else{
          $('#successmodel').modal('show');
          $('#success_model_heading').html('Product '+result.msg);
        }
        let totalCartPrice = 0;
        if (result.totalItem==0) {
            $('.aa-cart-notify').html('0');
            $('.aa-cartbox-summary').remove();
        }else{

          $('.aa-cart-notify').html(result.totalItem);
          let html = '<ul>';
          $.each(result.data, function(arrkey, arrVal){
            totalCartPrice = parseInt(totalCartPrice)+(parseInt(arrVal.qty)*parseInt(arrVal.price));
               html += '<li> <a class="aa-cartbox-img" href="#"><img src="'+PRODUCT_IMAGE+'/'+arrVal.image+'" alt="'+arrVal.pro_name+'" style="width: 100px;height: 50px"></a><div class="aa-cartbox-info"> <h4><a class="aa-cart-title" href="javascript:void(0)" target="_blank">'+arrVal.pro_name+'</a></h4> <p>'+arrVal.qty+' * <span class="fa fa-inr">&nbsp;'+arrVal.price+'</span></p></div> <a class="aa-remove-product" href="#"><span class="fa fa-times"></span></a> </li>';
          });
          html += '<li> <span class="aa-cartbox-total-title"> Total </span> <span class="aa-cartbox-total-price "> <span class="fa fa-inr"></span>&nbsp;'+totalCartPrice+'</span></li>'
          html += '</ul><a class="aa-cartbox-checkout aa-primary-btn" href="carts">Cart</a>';
          $('.aa-cartbox-summary').html(html);
        }
        
      }
    });
  }
}

function home_add_to_cart(id, size_str_id,color_str_id){
   $('#size_id').val(size_str_id);
  $('#color_id').val(color_str_id);
  add_to_cart(id,size_str_id,color_str_id);
  //alert('Under Construction');
}


function update_cart_Qty(pid,size,color,attr_id,price){
  $('#color_id').val(color);
  $('#size_id').val(size);
  var qty=$('#qty'+attr_id).val();
  $('#qty').val(qty)
  add_to_cart(pid,size,color);
  $('#total_price_'+attr_id).html('Rs '+qty*price);
}



function deleteCartProducts(pid,size,color,attr_id){
  $('#color_id').val(color);
  $('#size_id').val(size);
  $('#qty').val(0)
  add_to_cart(pid,size,color);
  //$('#total_price_'+attr_id).html('Rs '+qty*price);
  $('#cart_box'+attr_id).hide();
}



function sort_by(){
  let sort_by_value = $('#sort_by_value').val();
  $('#sort').val(sort_by_value);
  $('#categoryFilter').submit();
 // alert(sort_by_value);
}


function sort_price_filter(){
  let start = $('#skip-value-lower').html();
  let end = $('#skip-value-upper').html();
  $('#filter_price_start').val(start);
  $('#filter_price_end').val(end);
  $('#categoryFilter').submit();
}


function setColor(color, type){
  let color_str = $('#color_filter').val();
  if (type ==1) {
    let new_color_str = color_str.replace(color+':', '');
    
    $('#color_filter').val(new_color_str);
  }else{
    $('#color_filter').val(color+':'+color_str);
  }
  
  $('#categoryFilter').submit();
}



function funSearch(){
  var search_str=jQuery('#search_str').val();
  if(search_str!='' && search_str.length>3){
    window.location.href='/search/'+search_str;
  }
}


$('#frmRegistration').submit(function(e){
  $('.field_error').html('');
  e.preventDefault();
  $.ajax({
    url:'registration_process',
    data:$('#frmRegistration').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "error") {
        $.each(result.error, function(key, val){
          $('#'+key+'_error').html(val[0]);
        });
      }
      if (result.status == "success") {
        $('#frmRegistration')[0].reset();
        $('#successmodel').modal('show');
        $('#success_model_heading').html(result.msg);
      }
    }
  });
});


$('#frmLogin').submit(function(e){
   e.preventDefault();
  $.ajax({
    url:'/login_process',
    data:$('#frmLogin').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "error") {
        $('#errormodel').modal('show');
        $('#errormodel_heading').html(result.msg);
      }
      if (result.status == "success") {
        $('#frmLogin')[0].reset();
        $('#successmodel').modal('show');
        $('#success_model_heading').html(result.msg);
        window.location.href = window.location.href;
      }
    }
  });
});


$('#frmForgot').submit(function(e){
   e.preventDefault();
  $.ajax({
    url:'/forgot_password',
    data:$('#frmForgot').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "error") {
        $('#errormodel').modal('show');
        $('#errormodel_heading').html(result.msg);
      }
      if (result.status == "success") {
        $('#frmForgot')[0].reset();
        $('#successmodel').modal('show');
        $('#success_model_heading').html(result.msg);
        window.location.href = '/';
      }
    }
  });
});


function forgot_password(){
  $('#popup_forgot').show();
  $('#popup_login').hide();
}


function show_login_popup(){
  $('#popup_login').show();
  $('#popup_forgot').hide();
}

$('#frmUpdatePassword').submit(function(e){
   $('.field_error').html('');
   e.preventDefault();
  $.ajax({
    url:'/forgot_password_change_process',
    data:$('#frmUpdatePassword').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "error") {
        $.each(result.error, function(key, val){
          $('#'+key+'_error').html(val[0]);
        });
      }
      if (result.status == "success") {
        $('#frmUpdatePassword')[0].reset();
        $('#successmodel').modal('show');
        $('#success_model_heading').html(result.msg);
        window.location.href = '/';
      }
    }
  });
});


function applyCouponCode(){
  $('#coupon_code_msg').html('');
  let coupon_code  = $('#coupon_code').val();
  if (coupon_code != "") {
    $.ajax({
      type:'post',
      url:'/apply_coupon_code',
      data:'coupon_code='+coupon_code+'&_token='+$("[name='_token']").val(),
      success:function(result){
        console.log(result);
        if (result.status == "success") {
            $('.show_coupon_box').removeClass('hide');
            $('#coupon_code_str').html(coupon_code);
            $('#total_price').html('INR '+result.totalprice);
            $('.apply_coupon_code_box').hide();
          $('#coupon_code_success').html(result.msg);
        }else{
          $('#coupon_code_msg').html(result.msg);
        }
      }
    });
  }else{
    $('#coupon_code_msg').html('Please Enter Coupon Code');
  }
}

function remove_coupon_code(){
   $('#coupon_code_msg').html('');
  let coupon_code  = $('#coupon_code').val();
  $('#coupon_code').val('');
  if (coupon_code != "") {
    $.ajax({
      type:'post',
      url:'/remove_coupon_code',
      data:'coupon_code='+coupon_code+'&_token='+$("[name='_token']").val(),
      success:function(result){
        if (result.status == "success") {
            $('.show_coupon_box').addClass('hide');
            $('#coupon_code_str').html('');
            $('#total_price').html('INR '+result.totalprice);
            $('.apply_coupon_code_box').show();
          $('#coupon_code_success').html(result.msg);
        }else{
          $('#coupon_code_msg').html(result.msg);
        }
      }
    });
  }
}


$('#frmPlaceOrder').submit(function(e){
   e.preventDefault();
  $.ajax({
    url:'/place_order',
    data:$('#frmPlaceOrder').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "error") {
        $('#errormodel').modal('show');
        $('#errormodel_heading').html(result.msg);
      }
      if (result.status == "success") {
        if(result.payment_url!=''){
          window.location.href=result.payment_url;
        }else{
          $('#successmodel').modal('show');
          $('#success_model_heading').html(result.msg);
          window.location.href="/order_placed";
        }
      }
    }
  });
});

$('#frmProductReview').submit(function(e){
   e.preventDefault();
  $.ajax({
    url:'/product_review_process',
    data:$('#frmProductReview').serialize(),
    type:'post',
    success:function(result){
      if (result.status == "success") {
        $('#frmProductReview')[0].reset();
         $('#successmodel').modal('show');
          $('#success_model_heading').html(result.msg);
          setInterval(function(){
            window.location.href=window.location.href
          },3000);
      }
      if (result.status == "error") {
        $('#errormodel').modal('show');
        $('#errormodel_heading').html(result.msg);
      }

    }
  });
});