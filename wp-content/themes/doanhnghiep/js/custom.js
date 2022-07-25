jQuery(document).ready(function(){

var width = jQuery(window).width();
	  if (jQuery('[data-toggle="tooltip"]').length > 0) {
            jQuery('[data-toggle="tooltip"]').tooltip({
                container: 'body'
            });
        }

	jQuery('.review_alice .textwidget').click(function(){
		jQuery(this).siblings('.share_social').toggle();
		jQuery(this).siblings('.share_social').toggleClass('current');
	});

	$(window).on('load', function(){ 
    setTimeout(function(){
        $('#loader').fadeOut(500);
    },500);
    
});

	jQuery('.services_home .slide_service li .textwidget .btn_pop_lichhen a , .about_lh_btn').click(function(e){
		e.preventDefault();
		jQuery('.popup_regis').modal('show');
		
	});	

		if(jQuery('#lang_choice_1').length>0){
			jQuery('#lang_choice_1 option').each(function(){
				var val_opt = jQuery(this).val();
				var attr = $(this).attr('selected');
				var hostname = jQuery(location).attr('hostname');
				if (typeof attr !== 'undefined' && attr !== false) {
				if(val_opt == 'vi'){
					console.log(val_opt);
					jQuery(this).parent().attr('style','background-image:url("https://alice.ninjadona.com/wp-content/themes/doanhnghiep/images/flag-vn-lang.png")');
				}else if(val_opt == 'en'){
					console.log(val_opt);
					jQuery(this).parent().attr('style','background-image:url("https://alice.ninjadona.com/wp-content/themes/doanhnghiep/images/flag-usa-lang.png")');
				}else{
					console.log('Third language');
				}
				}
			});
		}
		
		if(jQuery('.tg_language').length>0){
			jQuery('.tg_language ul li a').wrapInner('<span></span>');
		}

		// external JS: masonry.pkgd.js
		
		function tg_masonry(){
			var $grid = $('.grid').masonry({
			// use outer width of grid-sizer for columnWidth
columnWidth: '.grid-sizer',
// do not use .grid-sizer in layout
itemSelector: '.grid-item',
percentPosition: true
			});
		}	

		if(width>767){
			tg_masonry();
		}else{
				if(jQuery('.dream_with_al  ').length>0){
				$('.dream_with_al  .grid').slick({
					dots: false,
					arrows: true,
					infinite: false,
					speed: 300,
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: false,
					autoplaySpeed: 1000
				
				});
			}
		}

	    // show hide tab-content
	    $(document).on('click', '.show_hide_tab li', function () {
	    	var el_main = $(this).parents('.show_hide_tab_parent');
	    	var tab_id = $(this).attr('data-tab');
	    	$(this).addClass('current').siblings().removeClass('current');
	    	var currentTab =  $(el_main).find("#" + tab_id).addClass('current');
	    	$(currentTab).parent().siblings().find('.tab-content').removeClass('current');
	    });


		// END SCROLL TO FORM
				// SCROLL TO DIV
				jQuery(window).scroll(function(){
					if(jQuery(this).scrollTop()>500){
						jQuery('.scrolltop').addClass('go_scrolltop');
					}
					else{
						jQuery('.scrolltop').removeClass('go_scrolltop');
					}
				});
				jQuery('.scrolltop').click(function (){
					jQuery('html, body').animate({
						scrollTop: jQuery("html").offset().top
					}, 1000);
				}); 



		// STICKY NAVBAR
		if($('.sticky').length>0){
			var sticky = document.querySelector('.sticky');

			if (sticky.style.position !== 'sticky') {
				var stickyTop = sticky.offsetTop;

				document.addEventListener('scroll', function () {
					window.scrollY >= stickyTop ?
					sticky.classList.add('fixed_menu') :
					sticky.classList.remove('fixed_menu');
				});
			}	
		}
		

		// MENU MOBILE
		jQuery(".icon_mobile_click").click(function(){
			jQuery("#page_wrapper").addClass('page_wrapper_active');
			jQuery("#menu_mobile_full").addClass('menu_show').stop().animate({left: "0px"},260);
			jQuery(".close_menu, .bg_opacity").show();
		});
		jQuery(".close_menu").click(function(){
			jQuery(".top_header .icon_mobile_click").fadeIn(300);
			jQuery("#menu_mobile_full").animate({left: "-260px"},260).removeClass('menu_show');
			jQuery(this).hide();
			jQuery('.bg_opacity').hide();
			
		});
		jQuery('.bg_opacity').click(function(){
			jQuery("#menu_mobile_full").animate({left: "-260px"},260).removeClass('menu_show');
			jQuery('.close_menu').hide();
			jQuery(this).hide();
		});
		jQuery("#menu_mobile_full ul li a").click(function(){
			jQuery(".icon_mobile_click").fadeIn(300);
			jQuery("#page_wrapper").removeClass('page_wrapper_active');
		});

		jQuery('.mobile-menu .menu>li:not(:has(ul.sub-menu)) , .mobile-menu .menu>li ul.sub-menu>li:not(:has(ul.sub-menu))').addClass('not-have-child');

		// menu cap 2
		jQuery('.mobile-menu ul.menu').children().has('ul.sub-menu').click(function(){
			jQuery(this).children('ul').slideToggle();
			jQuery(this).siblings().has('ul.sub-menu').find('ul.sub-menu').slideUp();
			jQuery(this).siblings().find('ul.sub-menu>li').has('ul.sub-menu').removeClass('editBefore_mobile');
		}).children('ul').children().click(function(event){event.stopPropagation();});

		//menu cap 3
		jQuery('.mobile-menu ul.menu>li>ul.sub-menu').children().has('ul.sub-menu').click(function(){
			jQuery(this).children('ul.sub-menu').slideToggle();
		}).children('ul').children().click(function(event){event.stopPropagation();});

			//menu cap 4
			jQuery('.mobile-menu ul.menu>li>ul.sub-menu>li>ul.sub-menu').children().has('ul.sub-menu').click(function(){
				jQuery(this).children('ul.sub-menu').slideToggle();
			}).children('ul').children().click(function(event){event.stopPropagation();});


			jQuery('.mobile-menu ul.menu li').has('ul.sub-menu').click(function(event){
				jQuery(this).toggleClass('editBefore_mobile');
			});
			jQuery('.mobile-menu ul.menu').children().has('ul.sub-menu').addClass('menu-item-has-children');
			jQuery('.mobile-menu ul.menu>li').click(function(){
				$(this).addClass('active').siblings().removeClass('active, editBefore_mobile');
			});



			if(jQuery('.services_home  ').length>0){
				$('.services_home  .slide_service').slick({
					dots: false,
					arrows: true,
					infinite: false,
					speed: 300,
					slidesToShow: 3,
					slidesToScroll: 3,
					autoplay: false,
					autoplaySpeed: 1000,
					responsive: [
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
					]
				});
			}
			if(jQuery('.customer_home').length>0){
				$('.customer_home  .slide_ctm').slick({
					dots: false,
					arrows: true,
					infinite: false,
					speed: 300,
					slidesToShow: 3,
					slidesToScroll: 3,
					autoplay: false,
					autoplaySpeed: 1000,
					responsive: [
					{
						breakpoint: 767,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						}
					}
					]
				});
			}


			
			if(width>1024 && jQuery('.home').length>0){
				jQuery('.slide_service , .tg_banner .row .textwidget').attr({"data-wow-delay" : "0.3s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .wrap_figure_banner span').attr({"data-wow-delay" : "0.6s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .wrap_figure_banner em').attr({"data-wow-delay" : "0.9s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .wrap_figure_banner b').attr({"data-wow-delay" : "1.2s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .news_home .big_post_home').attr({"data-wow-delay" : "0.3s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .list_news_child>li:nth-child(1)').attr({"data-wow-delay" : "0.5s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .list_news_child>li:nth-child(2)').attr({"data-wow-delay" : "0.65s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .footer .container>.panel-layout>.panel-grid>.panel-grid-cell:nth-child(1)').attr({"data-wow-delay" : "0.5s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .footer .container>.panel-layout>.panel-grid>.panel-grid-cell:nth-child(2)').attr({"data-wow-delay" : "0.65s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .footer .container>.panel-layout>.panel-grid>.panel-grid-cell:nth-child(3)').attr({"data-wow-delay" : "0.8s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
				jQuery('.home .footer .container>.panel-layout>.panel-grid>.panel-grid-cell:nth-child(4)').attr({"data-wow-delay" : "0.95s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
jQuery('.list_grid_item>.grid-item').attr({"data-wow-delay" : "0.3s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
jQuery('.list_grid_item>.grid-item:nth-child(4n+1)').attr({"data-wow-delay" : "0.3s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");

jQuery('.list_grid_item>.grid-item:nth-child(3n)').attr({"data-wow-delay" : "0.45s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");
jQuery('.list_grid_item>.grid-item:nth-child(2n)').attr({"data-wow-delay" : "0.6s", "data-wow-duration" : "1s"}).addClass("wow animated fadeInUp ");

				jQuery('.proceduce_inner>.panel-grid-cell:nth-child(1)').attr({"data-wow-delay" : "0.3s", "data-wow-duration" : "1.2s"}).addClass("wow animated bounceIn ");
				jQuery('.proceduce_inner>.panel-grid-cell:nth-child(2)').attr({"data-wow-delay" : "0.45s", "data-wow-duration" : "1.2s"}).addClass("wow animated bounceIn ");
				jQuery('.proceduce_inner>.panel-grid-cell:nth-child(3)').attr({"data-wow-delay" : "0.6s", "data-wow-duration" : "1.2s"}).addClass("wow animated bounceIn ");
				jQuery('.proceduce_inner>.panel-grid-cell:nth-child(4)').attr({"data-wow-delay" : "0.75s", "data-wow-duration" : "1.2s"}).addClass("wow animated bounceIn ");

				new WOW().init();
			} 



		});

