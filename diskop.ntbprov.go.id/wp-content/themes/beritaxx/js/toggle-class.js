    jQuery(document).ready(function($){
        $(".oc_search, .one-search").click(function(){
            $(".taxx_search").toggleClass("mobile_search");
			$(".beritaxx_mobile#header-one .taxx_flat_menu").removeClass("mobile_menu");
        });
		$(".bottom_float span").click(function(){
            $(".bottom_ads").hide();
        });
		$(".side_float span").click(function(){
            $(".taxx_float_ads").hide();
        });
		$(".open_sidebar").click(function(){
            $("#header-one .area_secondary").toggleClass("show_bar");
        });
		$(".taxx_mobmenu").click(function(){
            $(".beritaxx_mobile#header-one .taxx_flat_menu").toggleClass("mobile_menu");
			$(".taxx_search").removeClass("mobile_search");
        });
    });
	
	function resize() {
        if ( jQuery(window).width() < 982 ) { 
	    	jQuery("#header-one .nav .dd").addClass("accord").removeClass("desktop"); 
			jQuery("body").addClass("beritaxx_mobile");
		} else { 
	    	jQuery("#header-one .nav .dd").removeClass("accord").addClass("desktop");
			jQuery("body").removeClass("beritaxx_mobile");
		}
    }
	
    (console.log = function () {}),
    jQuery.noConflict(),
    jQuery("document").ready(function (e) {
            
            e(".nav > ul > li:has(ul),.nav > ul > li > ul > li:has(ul),.nav > ul > li > ul > li > ul > li:has(ul)").addClass("has-sub"),
            e(".nav > ul > li > a").click(function () {
                var l = e(this).next();
                return (
                    e(".nav li").removeClass("active"),
                    e(this).closest("li").addClass("active"),
                    l.is("ul") && l.is(":visible") && (e(this).closest("li").removeClass("active"), l.slideUp("slow")),
                    l.is("ul") && !l.is(":visible") && (e(".nav ul ul:visible").slideUp("slow"), l.slideDown("slow")),
                    !l.is("ul")
                );
            }),
            e(".nav > ul > li > ul > li > a").click(function () {
                var l = e(this).next();
                return (
                    e(".nav li ul li").removeClass("active"),
                    e(this).closest("li").addClass("active"),
                    l.is("ul") && l.is(":visible") && (e(this).closest("li").removeClass("active"), l.slideUp("slow")),
                    l.is("ul") && !l.is(":visible") && (e(".nav ul ul ul:visible").slideUp("slow"), l.slideDown("slow")),
                    !l.is("ul")
                );
            }),
            e(".nav > ul > li > ul > li > ul > li > a").click(function () {
                var l = e(this).next();
                return (
                    e(".nav li ul li ul li").removeClass("active"),
                    e(this).closest("li").addClass("active"),
                    l.is("ul") && l.is(":visible") && (e(this).closest("li").removeClass("active"), l.slideUp("slow")),
                    l.is("ul") && !l.is(":visible") && (e(".nav ul ul ul ul:visible").slideUp("slow"), l.slideDown("slow")),
                    !l.is("ul")
                );
            });
    });
	
    jQuery(document).ready(function (e) {
        e(window).resize(resize), resize();
    });