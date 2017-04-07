devon = {};

$(function(){
	devon.init();

});

devon.init = function(){
	console.log("It's working");
	devon.orderingFanciness();
	devon.menuSlideIn();
	devon.faqSelect();
}

//FAQs
devon.faqSelect = function(){
	$('input[type=radio]#tab-1').attr("checked", true);
}

//MENU SLIDE IN
devon.menuSlideIn = function(){
	$('ul.menu_list li p.ingredients').on('mouseenter', function(){
		 $(this).addClass('show');
	});
	$('ul.menu_list li p.ingredients').on('mouseleave', function(){
		 $(this).removeClass('show');
	});
	$('section.order_selections li p.ingredients').on('mouseenter', function(){
		 $(this).addClass('show');
	});
	$('section.order_selections li p.ingredients').on('mouseleave', function(){
		 $(this).removeClass('show');
	});
}


//ORDERING FANCINESS
devon.orderingFanciness = function(){
	devon.proteinHandler();
	devon.deliveryHandler();
	devon.orderRefresh();	
	devon.minCartAmount();
	//devon.allergyFee();
}

devon.orderRefresh = function(){
	$('section.order-summary tr.cart_item').on('mouseenter', function(){
		$(this).find('td.product-refresh label').addClass('show');
	});
	$('section.order-summary tr.cart_item').on('mouseleave', function(){
		$(this).find('td.product-refresh label').removeClass('show');
	});

	$('td.product-delivery-day.sunday').first().html('<div class="rotate">Sunday</div>');
	$('td.product-delivery-day.wednesday').first().html('<div class="rotate">Wednesday</div>');
	
}


devon.proteinHandler = function(){
$('div.protein_type').on('mouseenter', function(){
		$(this).addClass('bright');
		});
	$('div.protein_type').on('mouseleave', function(){
		$(this).removeClass('bright');
		});
	$('div.protein_type').on('click', function(){
		$(this).parents('td.value').find('div.protein_type').removeClass('grey');
		$(this).parents('td.value').find('div.protein_type').not(this).addClass('grey');
		$(this).removeClass('bright');
	});
};

devon.deliveryHandler = function(){
	$('label.attribute_delivery-day').on('mouseenter', function(){
		$(this).addClass('hover');
		});
	$('label.attribute_delivery-day').on('mouseleave', function(){
		$(this).removeClass('hover');
		});
	$('label.attribute_delivery-day').on('click', function(){
		$(this).parents('td.value').find('label').removeClass('chosen');
		$(this).addClass('chosen');
		$(this).removeClass('hover');
	});
};

devon.minCartAmount = function(){
	$('a.disabled-proceed-to-cart').on('click', function(e){
		e.preventDefault();
		alert("Choose at least 4 bowls to proceed to checkout!");
	});
}

devon.allergyFee = function(){
	$("textarea#allergies").after( '<a class="hello" style="display:none;" href=<?php echo do_shortcode("[add_to_cart_url id="1307"]"); ?>>Extra Allergies (+$5)</a>' );
	$("textarea#allergies").on('keyup', function(e){
		 var list = $(this).val().split(',');
		 console.log(list);
		 var not_yet = false; 
		 if (list[2] === "" || list[2] === " "){
		 	not_yet = true;
		 }
		 if (list.length < 3 ){
		 	$("p.hello").slideUp();
		 }
		if (list.length == 3 && !not_yet ){
			$("a.hello").slideDown();
			console.log('STOP');
			 $("textarea#allergies").bind('keydown',function(e){
		        if(e.which == 32 || e.which == 188){
		            return false
		        }
    		});
		}	
	});
}

