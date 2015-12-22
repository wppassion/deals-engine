jQuery(document).ready(function($){
	
	jQuery('.deals-navdeal').removeClass('deals-nav1').removeClass('deals-nav2');	
	jQuery('div.deals-ending-soon').hide();
	jQuery('div.deals-upcoming-soon').hide();
	jQuery('div.deals-list:first').show();
	
	jQuery( '.deals-navdeal' ).on('click','.deals-active',function(){
		jQuery('.deals-navdeal span').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.deals-navdeal').removeClass('deals-nav1').removeClass('deals-nav2');
		jQuery(this).parent().parent().children('div.deals-list').hide();
		jQuery('.deals-active').show();
	});
	jQuery( '.deals-navdeal' ).on('click','.deals-ending-soon',function(){
		jQuery('.deals-navdeal span').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.deals-navdeal').addClass('deals-nav1');
		jQuery('.deals-navdeal').removeClass('deals-nav2');
		jQuery(this).parent().parent().children('div.deals-list').hide();
		jQuery('.deals-ending-soon').show();
	});
	jQuery( '.deals-navdeal' ).on('click','.deals-upcoming-soon',function(){
		jQuery('.deals-navdeal span').removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.deals-navdeal').addClass('deals-nav2');
		jQuery('.deals-navdeal').removeClass('deals-nav1');
		jQuery(this).parent().parent().children('div.deals-list').hide();
		jQuery('.deals-upcoming-soon').show();
	});
});