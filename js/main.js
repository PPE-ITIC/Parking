/** 
 * ===================================================================
 * main js
 *
 * ------------------------------------------------------------------- 
 */
var tabAnchor = ["#news", "#events", "#planning", "#testimonials", "#contact"];
var tabAnchorGrp = ["news", "events", "planning", "testimonials"];
var tabAnchorGrpCurrent = ["#news","#news","#news","#news"];

(function($) {
    if (sessionStorage.pathname != window.location.pathname) {
        sessionStorage.scrollTop = 0;
        sessionStorage.pathname = window.location.pathname;
    }
    if (!isNaN(sessionStorage.scrollTop)) {
        $(window).scrollTop(sessionStorage.scrollTop);
    }

	"use strict";
	/*---------------------------------------------------- */
	/* Preloader
	------------------------------------------------------ */ 
   $(window).load(function() {
       if ($("#news") && $("#news").length > 0)
           resize_div_news();
      // will first fade out the loading animation 
    	$("#loader").fadeOut("slow", function(){

        // will fade out the whole DIV that covers the website.
        $("#preloader").delay(300).fadeOut("slow");

        if (window.location.hash != "" || sessionStorage.resizeNews == true || sessionStorage.resizeNews == "true")
            replace_scrollTop();

        if (sessionStorage.error == true || sessionStorage.error == "true")
        {
            if (sessionStorage.connexion == true || sessionStorage.connexion == "true")
                open_modal(true,true,sessionStorage.msg);
            else
                open_modal(false,true,sessionStorage.msg);
        }
            

        define_block_profil();
        define_top_profil();

            if ($('.single-page') && $('.single-page').length > 0) {
                var id = $('.single-page').attr('id');
                $('.main-navigation li[data-link="'+id+'"]').addClass("current");
            }
      });       

  	});

    $(window).unload(function(){
        sessionStorage.saveScroll = false;
    });


    /*----------------------------------------------------*/
	/*	Sticky Navigation
	------------------------------------------------------*/
   $(window).on('scroll', function() {

       if (sessionStorage.saveScroll != "false" && sessionStorage.saveScroll != false)
           sessionStorage.scrollTop = $(window).scrollTop();

	   var y = $(window).scrollTop(),
	   topBar = $('header');
     
	   if (y > 1) {
	      topBar.addClass('sticky');
	   }
       else {
         topBar.removeClass('sticky');
       }

       sessionStorage.saveScroll = true;
       define_top_profil();

	});



	/*-----------------------------------------------------*/
  	/* Mobile Menu
   ------------------------------------------------------ */  
   var toggleButton = $('.menu-toggle'),
       nav = $('.main-navigation');

   toggleButton.on('click', function(event){
		event.preventDefault();

		toggleButton.toggleClass('is-clicked');
		nav.slideToggle();
	});

  	if (toggleButton.is(':visible')) nav.addClass('mobile');

  	$(window).resize(function() {
   	if (toggleButton.is(':visible')) nav.addClass('mobile');
    	else nav.removeClass('mobile');

        if ($('#sous-main-navigation').hasClass('mobile')) {
            $('#sous-main-navigation').addClass('invisible');
        } else {
            $('#sous-main-navigation').removeClass('invisible');
        }
  	});

  	$('#main-nav-wrap li a').on("click", function() {   

   	if (nav.hasClass('mobile')) {   		
   		toggleButton.toggleClass('is-clicked'); 
   		nav.fadeOut();   		
   	}     
  	});


   /*----------------------------------------------------*/
  	/* Highlight the current section in the navigation bar
  	------------------------------------------------------*/
	var sections = $("section"),
	navigation_links = $("#main-nav-wrap li .smoothscroll");

	sections.waypoint( {

       handler: function(direction) {

		   var active_section;
           active_section = $('section#' + this.element.id);

           if (direction === "up") active_section = active_section.prev();

			var active_link = $('#main-nav-wrap .smoothscroll[href="#' + active_section.attr("id") + '"]');

            navigation_links.parent().removeClass("current");
			active_link.parent().addClass("current");
            if ($.inArray(active_section.attr("id"),tabAnchorGrp) != -1) {
                var active_link = $('#main-nav-wrap .smoothscroll[href="' + tabAnchorGrpCurrent[$.inArray(active_section.attr("id"),tabAnchorGrp)] + '"]');
                active_link.parent().addClass("current");
            }



		}, 

		offset: '25%'

	});

	/*----------------------------------------------------*/
  	/* Flexslider
  	/*----------------------------------------------------*/
  	$(window).load(function() {

	   $('#testimonial-slider').flexslider({
              namespace: "flex-",
	      controlsContainer: "",
	      animation: 'slide',
	      controlNav: true,
	      directionNav: true,
	      smoothHeight: true,
	      slideshowSpeed: 7000,
	      animationSpeed: 600,
	      randomize: false,
	      touch: true
	   });

   });


    // gestion inscription
    $('.toggle').on('click', function () {
        if ($("#shadowing").hasClass('shadowing'))
            setTimeout(function(){ resize_modal(); }, 500);
    });

    $('#is-adh').on('click', function () {
        $('.auto-complete').addClass('hide');
        $('.alr').toggleClass('hide');
        $('#is-adh').toggleClass('already-adh');
        $('#is-adh').toggleClass('not-adh');
        if ($("#is-adh").hasClass('already-adh')) {
            $('#is-adh').text("Je suis adhérent");
            $("#is-adh input").attr("autocomplete", "on");
            $( "#adh" ).prop( "checked", false );
        }
        else {
            $('#is-adh').text("Je ne suis pas adhérent");
            $("#is-adh input").attr("autocomplete", "off");
            $( "#adh" ).prop( "checked", true );
        }
        resize_modal();
    });

    $('.word').on('click', function () {
        $('#'+sessionStorage.inputSearch).val($(this).attr("data"));
        $('.auto-complete').addClass('hide');
    });

    $('input[class^="form-"]').on('click', function () {
        $('.auto-complete').addClass('hide');
    });

    $( ".search" ).keyup(function() {
        if ($("#is-adh").hasClass('not-adh')) {
            var word_input = $(this).val().toUpperCase();
            var hide = true;
            var width = $('.form-module .form').width() * (49.11/100);
            var left = $(this).position().left - 40;
            sessionStorage.inputSearch = $(this).attr('id');
            var list = $("div[data-list=" + sessionStorage.inputSearch + "]");
            if (word_input.length != 0) {
                list.children().each(function () {
                    var word_orig = $(this).attr("data");
                    var word = $(this).attr("data").toUpperCase();
                    if (word.search(word_input) != -1) {
                        hide = false;
                        var tab = word.split(word_input);
                        var pos = 0;
                        var lg  = tab[0].length;
                        var word_bold = word_orig.substr(pos,lg);
                        pos += lg;
                        for(var i= 1; i < tab.length; i++)
                        {
                            lg = word_input.length;
                            word_bold += "<span class='mark'>"+word_orig.substr(pos,lg)+"</span>";
                            pos += lg;
                            lg  = tab[i].length;
                            word_bold += word_orig.substr(pos,lg);
                            pos += lg;
                        }
                        $(this).html(word_bold);
                        $(this).removeClass('hide');
                    }
                    else {
                        $(this).addClass('hide')
                    }
                });
            }
            if (hide) {
                list.addClass('hide');
            }
            else {
                list.css('margin-left', left+"px");
                list.css('width', width+"px");
                list.removeClass('hide');
            }

        }
    });
	/*----------------------------------------------------*/
  	/* Smooth Scrolling
  	------------------------------------------------------*/
  	$('.smoothscroll').on('click', function (e) {
	 	
	 	e.preventDefault();
   	var target = this.hash,
    	$target = $(target);
    if ($target.offset()) {
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top

        }, 800, 'swing', function () {
            window.location.hash = target;

        });
    }
    else
    {
        if ($.inArray(target,tabAnchor) != -1) {
            window.location = sessionStorage.baseUrl + target;
        } else {
            sessionStorage.scrollTop = 0;
            window.location = sessionStorage.baseUrl;
        }
    }

  	});

    /*----------------------------------------------------*/
    /* Smooth Scrolling
     ------------------------------------------------------*/
    $('.swing').on('click', function (e) {

        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        if ($target.offset()) {
            $('html, body').stop().animate({
                'scrollTop': $target.offset().top

            }, 800, 'swing', function () {
                window.location.hash = target;

            });
        }
        else
        {
            if ($.inArray(target,tabAnchor) != -1) {
                window.location = sessionStorage.baseUrl + target;
            } else {
                sessionStorage.scrollTop = 0;
                window.location = sessionStorage.baseUrl;
            }
        }

    });



        $('.main-navigation .dropdown[data-sub^="sous-"]').on('hover', function () {
            if (!$('#sous-main-navigation').hasClass('mobile')) {
                $('#sous-main-navigation').removeClass('invisible');
                var pos = $(this).offset().left
                    - $("#main-nav-wrap").offset().left
                    - (  ($("." + $(this).attr("data-sub")).width()
                    - $(this).width()) / 2 ) + 7;

                $('li[class^="sous-"]').addClass("invisible");
                $('li[class^="sous-"]').removeClass("visible");
                $("." + $(this).attr("data-sub")).addClass("visible");
                $("." + $(this).attr("data-sub")).removeClass("invisible");
                $(".down").css('margin-left', pos);
            }
            else
            {
                $('#sous-main-navigation').addClass('invisible');
            }
        });

        $('.main-navigation .dropdown[data-sub^="sous-"]').on('mouseleave', function () {
            if (!$('#sous-main-navigation').hasClass('mobile')) {
                $('#sous-main-navigation').removeClass('invisible');
                $('li[class^="sous-"]').addClass("invisible");
                $('li[class^="sous-"]').removeClass("visible");
            }
            else
            {
                $('#sous-main-navigation').addClass('invisible');
            }
        });


        $('.main-navigation li[class^="sous-"]').on('hover', function () {
            if (!$('#sous-main-navigation').hasClass('mobile')) {
                $('#sous-main-navigation').removeClass('invisible');
                $('li[class^="sous-"]').addClass("invisible");
                $('li[class^="sous-"]').removeClass("visible");
                $(this).addClass("visible");
                $(this).removeClass("invisible");
            }
            else
            {
                $('#sous-main-navigation').addClass('invisible');
            }
        });

        $('.main-navigation li[class^="sous-"]').on('mouseleave', function () {
            if (!$('#sous-main-navigation').hasClass('mobile')) {
                $('#sous-main-navigation').removeClass('invisible');
                $('li[class^="sous-"]').addClass("invisible");
                $('li[class^="sous-"]').removeClass("visible");
            }
            else
            {
                $('#sous-main-navigation').addClass('invisible');
            }
        });



    /*----------------------------------------------------*/
    /* Envoie formulaire
     ------------------------------------------------------*/
    $('.submit').on('click', function () {
        if ((($("#form-login").val().trim() == "" || $("#form-password").val().trim() == "") && $(this).parent().attr('id') == 'connexion-form') ||
            ((
              $("#form-name").val().trim() == "" || 
              $("#form-firstname").val().trim() == "" ||
             ($("#form-adresse").val().trim() == "" && !$("#form-adresse").hasClass('hide')) ||
             ($("#form-cp").val().trim() == "" && !$("#form-cp").hasClass('hide')) ||
             ($("#form-ville").val().trim() == "" && !$("#form-ville").hasClass('hide')) ||
             ($("#form-tel").val().trim() == "" && !$("#form-tel").hasClass('hide')) ||
             ($("#form-mail").val().trim() == "" && !$("#form-mail").hasClass('hide')) ||
              $("#form-id").val().trim() == "" ||
              $("#form-mdp").val().trim() == ""
              ) && $(this).parent().attr('id') == 'inscription-form')) {
            
            if ($(this).parent().attr('id') == 'connexion-form') {
                $("#connexion-error").text("Veuillez renseigner tous les champs");
                $("#connexion-error").css('display', "block");
            } else {
                $("#inscription-error").text("Veuillez renseigner tous les champs");
                $("#inscription-error").css('display', "block");
            }
            
        } else {
            $(this).parent().submit();
        }
    });

    /*----------------------------------------------------*/
    /* Retour en haut
     ------------------------------------------------------*/
    $('.logo').on('click', function () {
        sessionStorage.scrollTop = 0;
    });
  

   /*----------------------------------------------------*/
	/*  Placeholder Plugin Settings
	------------------------------------------------------*/ 

	$('input, textarea, select').placeholder()  


	/*---------------------------------------------------- */
   /* ajaxchimp
	------------------------------------------------------ */

	// Example MailChimp url: http://xxx.xxx.list-manage.com/subscribe/post?u=xxx&id=xxx
	var mailChimpURL = 'http://facebook.us8.list-manage.com/subscribe/post?u=cdb7b577e41181934ed6a6a44&amp;id=e65110b38d'

	$('#mc-form').ajaxChimp({

	   language: 'fr',
	   url: mailChimpURL

	});

	// Mailchimp translation
	//
	//  Defaults:
	//	 'submit': 'Submitting...',
	//  0: 'We have sent you a confirmation email',
	//  1: 'Please enter a value',
	//  2: 'An email address must contain a single @',
	//  3: 'The domain portion of the email address is invalid (the portion after the @: )',
	//  4: 'The username portion of the email address is invalid (the portion before the @: )',
	//  5: 'This email address looks fake or invalid. Please enter a real email address'

	$.ajaxChimp.translations.es = {
	  'Envoyer': 'Envoie en cours...',
	  0: '<i class="fa fa-check"></i> Nous vous avons envoyé un mail de confirmation',
	  1: '<i class="fa fa-warning"></i> Vous devez entrer une adresse mail valide',
	  2: '<i class="fa fa-warning"></i> Adresse invalide',
	  3: '<i class="fa fa-warning"></i> Adresse invalide',
	  4: '<i class="fa fa-warning"></i> Adresse invalide',
	  5: '<i class="fa fa-warning"></i> Adresse invalide'
	}


	/*---------------------------------------------------- */
	/* FitVids
	------------------------------------------------------ */ 
  	$(".fluid-video-wrapper").fitVids();


 	/*---------------------------------------------------- */
	/*	Modal Popup Vidéo
	------------------------------------------------------ */

    $('.video-link a').magnificPopup({

       type:'inline',
       fixedContentPos: false,
       removalDelay: 200,
       showCloseBtn: false,
       mainClass: 'mfp-fade'       

    });

    $(document).on('click', '.close-popup', function (e) {
    		e.preventDefault();
    		$.magnificPopup.close();
    });

   // Show or hide the sticky footer button
	jQuery(window).scroll(function() {
		sticky();
	});

    $(document).on('click', '#open-modal', function () {
        open_modal(true,false);
    });

    $(document).on('click', '.inscription', function () {
        open_modal(false,false);
    });

    $(document).on('click', '#open-profil', function () {
        $( "#profil-action" ).toggleClass( "open-profil" );
        $( "#profil-action" ).toggleClass( "close-profil" );
        define_block_profil();
    });

    $(document).on('click', '.monespace', function () {
        $( "#profil-action" ).removeClass( "open-profil" );
        $( "#profil-action" ).addClass( "close-profil" );
        define_block_profil();
    });

    $(document).on('click', '#close-modal', function () {
        close_modal();
    });

    $( window ).resize(function() {
        if ($("#shadowing").hasClass('shadowing'))
            resize_modal();
        if ($("#planning") && $("#planning").length > 0)
            resize_tab_planning(sessionStorage.nbCol);

        define_block_profil();
        define_top_profil();
    });

})(jQuery);

// Toggle Function
$('.toggle').click(function(){
    // Switches the Icon
    $(this).children('i').toggleClass('fa-pencil');
    // Switches the forms
    $('.form').animate({
        height: "toggle",
        'padding-top': 'toggle',
        'padding-bottom': 'toggle',
        opacity: "toggle"
    }, "slow");
});


$('#modal .toggle').click(function(){
    if ($('.tooltip').html() == "Inscription")
        $('.tooltip').html("Connexion");
    else
        $('.tooltip').html("Inscription");
});

/*---------------------------------------------------- */
/*	Modal Popup Connexion
 ------------------------------------------------------ */
var modal             = $("#modal");
var shadow            = $("#shadowing");
var body              = $("#top");
var close             = $("#close-modal");
var tab_planning      = $("#tab-planning");
var connexion_error   = $("#connexion-error");
var inscription_error = $("#inscription-error");
var toggle_action     = $("#modal .toggle");


// fonction d'ouverture de la modale
function open_modal(connexion,error,msg) {
	
    if ((connexion && $(".form-connexion").css('display') == "none") ||
        (!connexion && $(".form-inscription").css('display') == "none"))
    {
        toggle_action.trigger( "click" );
        if ((sessionStorage.is_adh == false || sessionStorage.is_adh == "false") && $("#is-adh").hasClass("not-adh"))
        {
            $("#is-adh").trigger( "click" );
        }
    }
        
    
    setTimeout(function(){ 
        connexion_error.css('display', "none");
        inscription_error.css('display', "none");

        if (error) {
            modal.css('transition', "0s");
            if (connexion) {
                connexion_error.html(msg);
                connexion_error.css('display', "block");
            } else {
                inscription_error.html(msg);
                inscription_error.css('display', "block");
            }

        }

        var top     = (body.height()/2-modal.height()/2);
        var left    = (body.width()/2-modal.width()/2);
        modal.css('top', top+"px");
        modal.css('left', left+"px");
        shadow.addClass( "shadowing" );
        $("#go-top").css('display', "none");

        $("#header-nav").addClass( "hide" );
        $("#header-nav").removeClass( "nohide" );
        modal.css('transition', "0.5s");
    }, 1000);
    
   
}

// fonction d'ouverture de la modale
function close_modal() {
    //var top = modal.height() + 20;
    var top = 1000;
    modal.css('transition', "0.5s");
    modal.css('top', "-"+top+"px");
    shadow.removeClass( "shadowing" );
    if (!( $("#header-search").hasClass('is-visible'))) {

        if (jQuery(window).scrollTop() >= pxShow) {
            jQuery("#go-top").fadeIn(fadeInTime);
        } else {
            jQuery("#go-top").fadeOut(fadeOutTime);
        }

    }

    $("#header-nav").addClass( "nohide" );
    $("#header-nav").removeClass( "hide" );
}

// fonction de redimensionnement de la modale
function resize_modal() {
    var top     = (body.height()/2-modal.height()/2);
    var left    = (body.width()/2-modal.width()/2);
    modal.css('top', top+"px");
    modal.css('left', left+"px");
}

function resize_tab_planning(nbCol) {
    var width = (tab_planning.width() - (tab_planning.width() * 10 / 100)) / nbCol;
    $(".cel-planning").css('width', width);
    sessionStorage.nbCol = nbCol;
}

function resize_div_news() {
    var height_content = $("#center-news").height() + 78;
    var height_left    = $("#left-news").height() + 78;
    var height_right   = $("#right-news").height() + 78;

    if (height_content < height_left)
        height_content = height_left;
    if (height_content < height_right)
        height_content = height_right;

    var padding_top = parseInt($("#news").css('padding-top').replace("px", ""));
    var height = height_content + $("#intro-news").height() + padding_top + padding_top;

    sessionStorage.resizeNews = false;
    if (sessionStorage.scrollTop > $("#news").position().top && $("#news").height() < height) {
        sessionStorage.resizeNews = true;
    }

    if ($("#news").height() < height)
        $("#news").css('height', height+"px");

}

function replace_scrollTop() {
    if (window.location.hash != "") {
        var target = window.location.hash,
            $target = $(target);

        if ($target.offset()) {
            sessionStorage.scrollTop = $target.offset().top;
            $(window).scrollTop(sessionStorage.scrollTop);
        }
        else
        {
            if ($.inArray(target,tabAnchor) != -1) {
                window.location = sessionStorage.baseUrl + target;
            } else {
                sessionStorage.scrollTop = 0;
                window.location = sessionStorage.baseUrl;
            }

        }
    } else {
        $(window).scrollTop(sessionStorage.scrollTop);
    }
}

function define_block_profil()
{
    if ($(".main-navigation").hasClass('mobile'))
        sessionStorage.width_block_profil =  parseInt($("body").width())/ 2;
    else
        sessionStorage.width_block_profil = parseInt($("body").width()) - parseInt($(".main-navigation .with-sep").offset().left);
    $( "#block-profil" ).css('width', sessionStorage.width_block_profil+"px");
    if ($( "#profil-action" ).hasClass('close-profil')) {
        $( "#block-profil").removeClass('opab');
        $( "#block-profil" ).css('right', "0");
    } else {
        $( "#block-profil" ).css('right', "-"+sessionStorage.width_block_profil+"px");
        $( "#block-profil").addClass('opab');
    }
}

function define_top_profil()
{

    if ($('header').hasClass('sticky') && !$(".main-navigation").hasClass('mobile')) {
        $("#block-profil").css('top', "66px");
    }
    else {
        if ($(".main-navigation").hasClass('mobile')) {
            $("#block-profil").css('top', "78px");
        } else {
            $("#block-profil").css('top', "90px");
        }
    }

}

function go_to_div(identifiant)
{
    $('html, body').stop().animate({
        'scrollTop': $(identifiant).offset().top - 70
    }, 800, 'swing', function () {
        sessionStorage.scrollTop = $(window).scrollTop();
    });
}

/*----------------------------------------------------- */
/* Back to top
 ------------------------------------------------------- */
var pxShow = 300; // height on which the button will show
var fadeInTime = 400; // how slow/fast you want the button to show
var fadeOutTime = 400; // how slow/fast you want the button to hide
var scrollSpeed = 300; // how slow/fast you want the button to scroll to top. can be a value, 'slow', 'normal' or 'fast'

function sticky() {
    if (!( $("#header-search").hasClass('is-visible')) && !($("#shadowing").hasClass('shadowing'))) {

        if (jQuery(window).scrollTop() >= pxShow) {
            jQuery("#go-top").fadeIn(fadeInTime);
        } else {
            jQuery("#go-top").fadeOut(fadeOutTime);
        }

    }
}


