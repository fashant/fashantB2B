$(document).ready(function() {
    "use strict";

    //LEFT MOBILE MENU OPEN
    $(".ts-menu-5").on('click', function() {
        $(".mob-right-nav").css('right', '0px');
    });

    //LEFT MOBILE MENU OPEN
    $(".mob-right-nav-close").on('click', function() {
        $(".mob-right-nav").css('right', '-270px');
    });

    //LEFT MOBILE MENU CLOSE
    $(".mob-close").on('click', function() {
        $(".mob-close").hide("fast");
        $(".menu").css('left', '-92px');
        $(".mob-menu").show("slow");
    });

    //mega menu
    $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50);
    });
    $(".ts-menu").mouseleave(function() {
        $(".cat-menu").fadeOut(50);
    });

    //mega menu
    $(".sea-drop").on('click', function() {
        $(".sea-drop-1").fadeIn(100);
    });
    $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-1").fadeOut(50);
    });
    $(".dir-ho-t-sp").mouseleave(function() {
        $(".sea-drop-1").fadeOut(50);
    });

    //mega menu top menu
    $(".sea-drop-top").on('click', function() {
        $(".sea-drop-2").fadeIn(100);
    });
    $(".sea-drop-1").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50);
    });
    $(".top-search").mouseleave(function() {
        $(".sea-drop-2").fadeOut(50);
    });

    //ADMIN LEFT MOBILE MENU OPEN
    $(".atab-menu").on('click', function() {
        $(".sb2-1").css("left", "0");
        $(".btn-close-menu").css("display", "inline-block");
    });

    //ADMIN LEFT MOBILE MENU CLOSE
    $(".btn-close-menu").on('click', function() {
        $(".sb2-1").css("left", "-350px");
        $(".btn-close-menu").css("display", "none");
    });

    //mega menu
    $(".t-bb").hover(function() {
        $(".cat-menu").fadeIn(50);
    });
    $(".ts-menu").mouseleave(function() {
        $(".cat-menu").fadeOut(50);
    });
    //review replay
    $(".edit-replay").on('click', function() {
        $(".hide-box").show();
    });

    //PRE LOADING
    $('#status').fadeOut();
    $('#preloader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });

    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: 400, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    });
    $('.dropdown-button2').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: ($('.dropdown-content').width() * 3) / 2.5 + 5, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left' // Displays dropdown with edge aligned to the left of button
    });

    //Collapsible
    $('.collapsible').collapsible();

    //material select
    $('select').material_select();
	
    //AUTO COMPLETE CITY SELECT
    $('#select-city.autocomplete').autocomplete({
        data: {
            "New York": null,
            "California": null,
            "Illinois": null,
            "Texas": null,
            "Pennsylvania": null,
            "San Diego": null,
            "Los Angeles": null,
            "Dallas": null,
            "Austin": null,
            "Columbus": null,
            "Charlotte": null,
            "El Paso": null,
            "Portland": null,
            "Las Vegas": null,
            "Oklahoma City": null,
            "Milwaukee": null,
            "Tucson": null,
            "Sacramento": null,
            "Long Beach": null,
            "Oakland": null,
            "Arlington": null,
            "Tampa": null,
            "Corpus Christi": null,
            "Greensboro": null,
            "Jersey City": null
        },
        limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });

	//AUTO COMPLETE SEARCH SELECT
    $('#select-search.autocomplete').autocomplete({
        data: {
            "Property Management Services": 'images/menu/1.png',
            "Hotel and Resorts": 'images/menu/4.png',
            "Education and Traninings": 'images/menu/2.png',
            "Internet Service Providers": 'images/menu/3.png',
            "Computer Repair & Services": 'images/menu/5.png',
            "Coaching & Tuitions": 'images/menu/6.png',
            "Job Training": 'images/menu/6.png',
            "Skin Care & Treatment": 'images/menu/7.png',
			"Real Estates": 'images/menu/1.png',
			"Travel and Transport": 'images/menu/2.png',
			"Property and Rentels": 'images/menu/3.png',
			"Professional Services": 'images/menu/4.png',
			"Domestic Help Services": 'images/menu/5.png',
			"Home Appliances Repair & Services": 'images/menu/6.png',
			"Furniture Dealers": 'images/menu/7.png',
			"Packers and Movers": 'images/menu/1.png',
			"Interior Designers": 'images/menu/2.png',
			"Pest Control Services": 'images/menu/3.png',
			"Plumbing Contractors & Dealers": 'images/menu/4.png',
			"Modular Kitchen Dealers": 'images/menu/5.png',
			"Web Designers Services": 'images/menu/6.png',
			"Internet Service Providers": 'images/menu/7.png',
			"Security System Dealers": 'images/menu/8.png',
			"Entrance Exam Coaching": 'images/menu/1.png',
			"Gyms and Fitness": 'images/menu/2.png',
			"Yoga Classes": 'images/menu/3.png',
			"Weight Loss Centres": 'images/menu/4.png',
			"Dieticians & Nutritionists": 'images/menu/5.png',
            "Health and Fitness": 'images/menu/8.png'
        },
        limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });	
	
    //AUTO COMPLETE CITY SELECT
    $('#top-select-city.autocomplete').autocomplete({
        data: {
            "New York": null,
            "California": null,
            "Illinois": null,
            "Texas": null,
            "Pennsylvania": null,
            "San Diego": null,
            "Los Angeles": null,
            "Dallas": null,
            "Austin": null,
            "Columbus": null,
            "Charlotte": null,
            "El Paso": null,
            "Portland": null,
            "Las Vegas": null,
            "Oklahoma City": null,
            "Milwaukee": null,
            "Tucson": null,
            "Sacramento": null,
            "Long Beach": null,
            "Oakland": null,
            "Arlington": null,
            "Tampa": null,
            "Corpus Christi": null,
            "Greensboro": null,
            "Jersey City": null
        },
        limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });

	//AUTO COMPLETE SEARCH SELECT
    $('#top-select-search.autocomplete').autocomplete({
        data: {
            "Property Management Services": 'images/menu/1.png',
            "Hotel and Resorts": 'images/menu/4.png',
            "Education and Traninings": 'images/menu/2.png',
            "Internet Service Providers": 'images/menu/3.png',
            "Computer Repair & Services": 'images/menu/5.png',
            "Coaching & Tuitions": 'images/menu/6.png',
            "Job Training": 'images/menu/6.png',
            "Skin Care & Treatment": 'images/menu/7.png',
			"Real Estates": 'images/menu/1.png',
			"Travel and Transport": 'images/menu/2.png',
			"Property and Rentels": 'images/menu/3.png',
			"Professional Services": 'images/menu/4.png',
			"Domestic Help Services": 'images/menu/5.png',
			"Home Appliances Repair & Services": 'images/menu/6.png',
			"Furniture Dealers": 'images/menu/7.png',
			"Packers and Movers": 'images/menu/1.png',
			"Interior Designers": 'images/menu/2.png',
			"Pest Control Services": 'images/menu/3.png',
			"Plumbing Contractors & Dealers": 'images/menu/4.png',
			"Modular Kitchen Dealers": 'images/menu/5.png',
			"Web Designers Services": 'images/menu/6.png',
			"Internet Service Providers": 'images/menu/7.png',
			"Security System Dealers": 'images/menu/8.png',
			"Entrance Exam Coaching": 'images/menu/1.png',
			"Gyms and Fitness": 'images/menu/2.png',
			"Yoga Classes": 'images/menu/3.png',
			"Weight Loss Centres": 'images/menu/4.png',
			"Dieticians & Nutritionists": 'images/menu/5.png',
            "Health and Fitness": 'images/menu/8.png'
        },
        limit: 8, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function(val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });		

    //HOME PAGE FIXED MENU
    $(window).scroll(function() {

        if ($(this).scrollTop() > 450) {
            $('.hom-top-menu').fadeIn();
            $('.cat-menu').hide();
        } else {
            $('.hom-top-menu').fadeOut();
        }
    });
});

function scrollNav() {
    $('.v3-list-ql-inn a').click(function() {
        //Toggle Class
        $(".active-list").removeClass("active-list");
        $(this).closest('li').addClass("active-list");
        var theClass = $(this).attr("class");
        $('.' + theClass).parent('li').addClass('active-list');
        //Animate
        $('html, body').stop().animate({
            scrollTop: $($(this).attr('href')).offset().top - 130
        }, 400);
        return false;
    });
    $('.scrollTop a').scrollTop();
}
scrollNav();