
	if (typeof other_action == 'function') { 
	  function other_action(){
		  
	  }
	}
	
	/* Fill modal with content from link href
	$("#quick_view").on("show.bs.modal", function(e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-body").load(link.attr("href"));
	});
	
	 Fill modal with content from link href
	$("#quick_view").on("hide.bs.modal", function(e) {
		$(this).find(".modal-body").html('');
	});
	*/
	
    $(document).ready(function() {
       /* $(".various").fancybox({
            maxWidth    : 800,
            maxHeight   : 600,
            fitToView   : false,
            width       : '70%',
            height      : '70%',
            autoSize    : false,
            closeClick  : false,
            openEffect  : 'none',
            closeEffect : 'none'
        });*/
    });
    
	/*$('#quick_view').modal({
        show: false,
        remote: ''
	}); */
	
	$(".product_quick").on('click', function () {
			var link = $(this).data("href");
			$('#quick_view').removeData('bs.modal');
			$('#quick_view').modal({remote: link });
			$('#quick_view').modal('show');
	});
	
	function ajax_load(url,id){
		var list = $('#'+id);
		$.ajax({
			url: url,
			beforeSend: function() {
				list.html('...'); // change submit button text
			},
			success: function(data) {
				list.html('');
				list.html(data).fadeIn();
				other_action();
			},
			error: function(e) {
				console.log(e)
			}
		});
	}
  	
	function notify(message,type,from,align){		
		$.notify({
			// options
			message: message 
		},{
			// settings
			type: type,
			placement: {
				from: from,
				align: align
		  	}
		});
		
	}
		

    $('body').on('click', '.add_to_cart', function(){        
        var product = $(this).data('pid');
        var elm_type = $(this).data('type');
        var button = $(this);
		var alread = button.html();
		var type = 'pp';
        if(button.closest('.margin-bottom-40').find('.cart_quantity').length){
            quantity = button.closest('.margin-bottom-40').find('.cart_quantity').val();
        }
		
        if($('#pnopoi').length){
        	type = 'pp';
            var form = button.closest('form');
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
            var option = formdata ? formdata : form.serialize();
        } else {
        	type = 'other';
        	var form = $('#cart_form_singl');
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
        	var option = formdata ? formdata : form.serialize();
        }
		
        $.ajax({
            url 		: base_url+'index.php/home/cart/add/'+product+'/'+type,
			type 		: 'POST', // form submit method get/post
			dataType 	: 'html', // request type html/json/xml
			data 		: option, // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
            beforeSend: function() {
				if(elm_type !== 'icon'){
                	button.html(cart_adding); // change submit button text
				}
            },
            success: function(data) {
                if(data == 'added'){
					$('.add_to_cart').each(function(index, element) {
						if( $('body .add_to_cart').length ){
							$('body .add_to_cart').each(function() {
								if($(this).data('pid') == product){
									var h = $(this);
									if(h.data('type') == 'text'){
										h.html('<i class="fa fa-shopping-cart"></i>'+added_to_cart).fadeIn();				
									} else if(h.data('type') == 'icon'){
										h.html('<i style="color:#AB00FF" class="fa fa-shopping-cart"></i>').fadeIn();					
									}
								}
							});
						}
                    });
					if (button.hasClass("btn_cart")) {
						button.removeClass("btn_cart");
						button.addClass("btn_carted");
					}
					//growl
                    ajax_load(base_url+'index.php/home/cart/added_list/','added_list');
					notify(product_added,'success','bottom','right');
					sound('successful_cart');
                } else if (data == 'shortage'){
                    button.html(alread);
					notify(quantity_exceeds,'warning','bottom','right');
					sound('cart_shortage');
                } else if (data == 'already'){
                    button.html(alread);
					notify(product_already,'warning','bottom','right');
					sound('already_cart');
                }
            },
            error: function(e) {
                console.log(e)
            }
        });
    });
  

    $('body').on('click', '.wish_it', function(){
        var state = check_login_stat('state');
		var product = $(this).data('pid');
		var button = $(this);
		
        state.success(function (data) {
            if(data == 'hypass'){
				$.ajax({
					url: base_url+'index.php/home/wishlist/add/'+product,
					beforeSend: function() {
					},
					success: function(data) {
						button.removeClass("wish_it");
						button.addClass("wished_it");
						//alert(button.closest('ul').data('originalTitle'));
						button.closest('ul').data('originalTitle',wishlist_add1);
						notify(wishlist_add,'info','bottom','right');
						sound('successful_wish');
					},
					error: function(e) {
						console.log(e)
					}
				});
            } else {
				signin();
			}
        });
    });
	
    $('body').on('click', '.btn_wish', function(){
        var state = check_login_stat('state');
		var product = $(this).data('pid');
		var button = $(this);
        state.success(function (data) {
            if(data == 'hypass'){
				$.ajax({
					url: base_url+'index.php/home/wishlist/add/'+product,
					beforeSend: function() {
						button.html(wishlist_adding); // change submit button text
					},
					success: function(data) {
						button.removeClass("btn_wish");
						button.addClass("btn_wished");
						button.html(wishlist_add1);
						notify(wishlist_add,'info','bottom','right');
						sound('successful_wish');
					},
					error: function(e) {
						console.log(e)
					}
				});
            } else {
				signin();
			}
        });
    });

    $('body').on('click', '.remove_from_wish', function(){
		var product = $(this).data('pid');
		var button = $(this);
		$.ajax({
			url: base_url+'index.php/home/wishlist/remove/'+product,
			beforeSend: function() {
				button.parent().parent().hide('fast');
			},
			success: function(data) {
				ajax_load(base_url+'index.php/home/wishlist/num/','wishlist_num');
				button.parent().parent().remove();
				notify(wishlist_remove,'info','bottom','right');
			},
			error: function(e) {
				console.log(e)
			}
		});
    });
  
	
    $('body').on('click', '.rate_it', function(){
        var state = check_login_stat('state');
		var product = $(this).closest('.rating').data('pid');
		var rating = $(this).data('rate');
		var button = $(this);
		
        state.success(function (data) {
            if(data == 'hypass'){
				$.ajax({
					url: base_url+'index.php/home/rating/'+product+'/'+rating,
					beforeSend: function() {
					},
					success: function(data) {
						if(data == 'success'){
							notify(rated_success,'info','bottom','right');
							for(i=Number(rating); i>0; i--){
								$('#rating_'+i).addClass('active');
							}
						} else if(data == 'failure'){
							notify(rated_fail,'alert','bottom','right');
						} else if(data == 'already'){
							notify(rated_already,'info','bottom','right');
						}
					},
					error: function(e) {
						console.log(e)
					}
				});
            } else {
				signin();
			}
        });
    });
	
	
    $('.subscriber').on('click', function(){
		
        var here = $(this); // alert div for show alert message
        var text = here.html(); // alert div for show alert message
        var form = here.closest('form');
		var email = form.find('#subscr').val();
		if(isValidEmailAddress(email)){
			//var form = $(this);
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.addClass('disabled');
					here.html(working); // change submit button text
				},
				success: function(data) {
					here.fadeIn();
					here.html(text);
					here.removeClass('disabled');
					if(data == 'done'){
						notify(subscribe_success,'info','bottom','right');
					} else if(data == 'already'){
						notify(subscribe_already,'warning','bottom','right');
					} else if(data == 'already_session'){
						notify(subscribe_sess,'warning','bottom','right');
					} else {
						notify(data,'warning','bottom','right');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		} else {
			notify(mbe,'warning','bottom','right');
		}
    });
	
	
    
	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		return pattern.test(emailAddress);
	};	
		
	$("body").on('change','.required',function(){
		var here = $(this);
		here.css({borderColor: '#931ECD'});
		if (here.attr('type') == 'email'){
			if(isValidEmailAddress(here.val())){
				here.closest('.input').find('.require_alert').remove();
			}
		} else {
			here.closest('.input').find('.require_alert').remove();
		}
		if(here.is('select')){
			here.closest('.input').find('.chosen-single').css({borderColor: '#dcdcdc'});
		}
	});

	
	
    