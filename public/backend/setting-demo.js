"use strict";

// Setting Color

$(window).resize(function() {
	$(window).width(); 
});

$('.changeBodyBackgroundFullColor').on('click', function(){
	if($(this).attr('data-color') == 'default'){
		$('body').removeAttr('data-background-full');
	} else {
		$('body').attr('data-background-full', $(this).attr('data-color'));
	}

	$(this).parent().find('.changeBodyBackgroundFullColor').removeClass("selected");
	$(this).addClass("selected");
	layoutsColors();
});

$('.changeLogoHeaderColor').on('click', function(){
	if($(this).attr('data-color') == 'default'){
		$('.logo-header').removeAttr('data-background-color');
	} else {
		$('.logo-header').attr('data-background-color', $(this).attr('data-color'));
	}

	$(this).parent().find('.changeLogoHeaderColor').removeClass("selected");
	$(this).addClass("selected");
	layoutsColors();
	saveSetting();
});

$('.changeTopBarColor').on('click', function(){
	if($(this).attr('data-color') == 'default'){
		$('.main-header .navbar-header').removeAttr('data-background-color');
	} else {
		$('.main-header .navbar-header').attr('data-background-color', $(this).attr('data-color'));
	}

	$(this).parent().find('.changeTopBarColor').removeClass("selected");
	$(this).addClass("selected");
	layoutsColors();
	saveSetting();
});

$('.changeSideBarColor').on('click', function(){
	if($(this).attr('data-color') == 'default'){
		$('.sidebar').removeAttr('data-background-color');
	} else {
		$('.sidebar').attr('data-background-color', $(this).attr('data-color'));
	}

	$(this).parent().find('.changeSideBarColor').removeClass("selected");
	$(this).addClass("selected");
	layoutsColors();
	saveSetting();
});

$('.changeBackgroundColor').on('click', function(){
	$('body').removeAttr('data-background-color');
	$('body').attr('data-background-color', $(this).attr('data-color'));
	$(this).parent().find('.changeBackgroundColor').removeClass("selected");
	$(this).addClass("selected");
	saveSetting();
});

function customCheckColor(){
	var logoHeader = $('.logo-header').attr('data-background-color');
	if (logoHeader !== "white") {
		$('.logo-header .navbar-brand').attr('src', '../assets/img/logo.svg');
	} else {
		$('.logo-header .navbar-brand').attr('src', '../assets/img/logo2.svg');
	}
}

function saveSetting()
{
	const sidebarColor = $('.sidebarColor .selected').data('color');
	const topbarColor = $('.TopBarColor .selected').data('color');
	const logoHeaderColor = $('.LogoHeaderColor .selected').data('color');
	const backgroundColor = $('.BackgroundColor .selected').data('color');

	const baseUrl = homeUrl();
	
	$.ajax({
        url: baseUrl+'/backend/save-color-setting',
        type:'GET',
        data:{
        	sidebarColor:sidebarColor,
        	topbarColor:topbarColor,
        	logoHeaderColor:logoHeaderColor,
        	backgroundColor:backgroundColor
        },
        success: function(data) {

            // el.parents('form').find('select[name="district_id"]').html(data);

        }
    });
}


var toggle_customSidebar = false,
custom_open = 0;

if(!toggle_customSidebar) {
	var toggle = $('.custom-template .custom-toggle');

	toggle.on('click', (function(){
		if (custom_open == 1){
			$('.custom-template').removeClass('open');
			toggle.removeClass('toggled');
			custom_open = 0;
		}  else {
			$('.custom-template').addClass('open');
			toggle.addClass('toggled');
			custom_open = 1;
		}
	})
	);
	toggle_customSidebar = true;
}