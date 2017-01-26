jQuery(document).ready(function($){
    $('input, textarea').placeholder();


    $(".submenu-place, .menu-place [data-target-menu]").mouseenter(function(e){
        var target = e.getAttribute("data-target-menu");
        
        $('.submenu-place').removeClass('hidden-submenu-place');
        $('.pointer-menu').removeClass('hidden-arrow');
        $('.menu-place a').addClass('blue-menu');
        $('.submenu').css("margin-top", "-17px");
        $('.index-page').css("margin-top", "60px");
        $('.menu-place a span').css("border-bottom", "1px solid #0085b2");
    });
    $(".submenu-place, .menu-place").mouseleave(function(){
        $('.submenu-place').addClass('hidden-submenu-place');
        $('.pointer-menu').addClass('hidden-arrow');
        $('.menu-place a').removeClass('blue-menu');
        $('.submenu').css("margin-top", "0px");
        $('.index-page').css("margin-top", "0px");
        $('.menu-place a span').css("border-bottom", "1px solid #999999");
    });



    $('.collapse').on('show.bs.collapse', function(){
        $(this).parent().find(".accordion-toggle-collapsed").removeClass("accordion-toggle-collapsed").addClass("accordion-toggle-expanded");
        $(this).parent().find(".panel-heading").addClass("grey-color");
    }).on('hide.bs.collapse', function(){
        $(this).parent().find(".accordion-toggle-expanded").removeClass("accordion-toggle-expanded").addClass("accordion-toggle-collapsed");
        $(this).parent().find(".panel-heading").removeClass("grey-color");
    });

    $('.checkbox input').change(function() {
        showFindArrow(this);
    });

    function showFindArrow(elem) {
        $( ".find-arrow" ).remove();
        if ($('.checkbox input:checked').length) {
          var html = $.ajax({
            type: "POST",
            // Тут в качестве параметра url мы указываем на
            // controller который будет обрабатывать наши данные
            url: "/admin/filter/countCards/1",
            data: ({
                // Перечесляем передаваемые переменные
                // Сначала идёт название которое получит controller
                // через метод post, следом наша переменная с данными
                'url_string' : title
            }),
            dataType: "json",
            async: false
        }).responseText;
        var param = JSON.parse(html);
            $(elem).parent().after( '<div class="find-arrow">\
										<span class="quantity-found">Найдено: '+param+'</span>\
										<span class="link-show-results">\
											<a>Показать</a>\
										</span>\
									</div>' );
        }

    }


    $(".burger-menu").click(function() {
        $(".menu").slideToggle("slow");
    });


    $("#filter_button").click(function() {
        $(".filter-box .panel-group").slideToggle("fast");
        $(".sorting-wrapper").hide();
    });

    $("#sorting_button").click(function() {
        $(".sorting-wrapper").slideToggle("fast");
        $(".filter-box .panel-group").hide();
    });

    $(".sticky").sticky({topSpacing:0, zIndex:999999});

    $(".thumb").click(function() {
        var image = $(this).find("img").data("image");
        $(".main-image").attr("src", image);
    });

    var h = $(".large-photo-container").height();
    $("#map-iframe").height(h);
    $(window).resize(function(){
        var h = $(".large-photo-container").height();
        $("#map-iframe").height(h);
    });

    $(".small-review").each(function () {
        text = $(this).text();
        if (text.length > 240) {
            $(this).html(text.substr(0, 240) + '<span class="button-view-full">' + text.substr(240) + '</span><a' +
                ' class="button-view-full" href="#">Посмотреть целиком</a>');
        }
    });
    $(".small-review > a.button-view-full").click(function (e) {
        e.preventDefault(); //prevent '#' from being added to the url
        $(this).fadeToggle(500);
        $(this).prev('span.button-view-full').fadeToggle(500);
    });

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }

    $("#phoneInput").inputmask("+7 999 9999999");
    $("#nameInput").inputmask("Regex");
    $('#form-review').submit(function(){
      var message = $("#inputMessage").val();
      var is_valid = true;
      if (!message){
          $("#inputMessage").addClass('form-error');
          is_valid = false;
      } else {
          $("#inputMessage").removeClass('form-error');
      }
      var name = $("#nameInput").val();
      if (!name){
          $("#nameInput").addClass('form-error');
          is_valid = false;
      } else {
          $("#nameInput").removeClass('form-error');
      }
      var email = $("#emailInput").val();
      if (!email || !isEmail(email)){
          $("#emailInput").addClass('form-error');
          is_valid = false;
      } else {
          $("#emailInput").removeClass('form-error');
      }
      if (!is_valid) {
          return false;
      }

    });

    $('#form-change').submit(function(){
      var place = $("#namePlace").val();
      var is_valid = true;
      if (!place){
          $("#namePlace").addClass('form-error');
          is_valid = false;
      } else {
          $("#namePlace").removeClass('form-error');
      }
      var name = $("#inputNameSurname").val();
      if (!name){
          $("#inputNameSurname").addClass('form-error');
          is_valid = false;
      } else {
          $("#inputNameSurname").removeClass('form-error');
      }
      var email = $("#emailChangeInput").val();
      if (!email || !isEmail(email)){
          $("#emailChangeInput").addClass('form-error');
          is_valid = false;
      } else {
          $("#emailChangeInput").removeClass('form-error');
      }
      var changes = $("#inputChanges").val();
      if (!changes){
          $("#inputChanges").addClass('form-error');
          is_valid = false;
      } else {
          $("#inputChanges").removeClass('form-error');
      }
      if (!is_valid) {
          return false;
      }

    });

    var owl = $("#owl-example");
    owl.owlCarousel({
        loop: true,
        //responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            450:{
                items:2
            },
            800:{
                items:3
            },
            1000:{
                items:4
            },
            1400:{
                items:5
            }
        }


    });

    $(".next").click(function(){
        owl.trigger('next.owl.carousel');
    });
    $(".prev").click(function(){
        owl.trigger('prev.owl.carousel');
    });

    $(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});

    function resizeResultItem() {
         $(".wrapper-result-item").each(function () {
            var max_height = 0;
            $(this).find(".result-item").each(function () {
                var item_height =  $(this).outerHeight();
                if (item_height > max_height) {
                    max_height = item_height;

                }
            });
            $(this).find(".result-item").each(function () {
                $(this).height(max_height);
            });
        });
    }
    $(window).resize(function(){
        resizeResultItem();
    });
    $(window).load(function(){
        resizeResultItem();
    });

    $("#country").selectmenu({appendTo: ".header-select"});
    $("#country-button .ui-selectmenu-text").text("Ваш город");
    $("#city").selectmenu({appendTo: ".header-select"});
    $("#city-button .ui-selectmenu-text").text("Ваша страна");
    $("#teacher").selectmenu({appendTo: ".filter-select1",
     open: function( event, ui ) {
         $("#teacher-menu").parent().width($("#teacher-button").outerWidth()-2);
     }
    });
    $("#teacher-button .ui-selectmenu-text").text("Выбрать из списка:");
    $("#parents").selectmenu({appendTo: ".filter-select2",
        open: function( event, ui ) {
            $("#parents-menu").parent().width($("#parents-button").outerWidth()-2);
        }
    });
    $("#parents-button .ui-selectmenu-text").text("Можно с родителями:");
    $("#cafe").selectmenu({appendTo: ".filter-select3",
        open: function( event, ui ) {
            $("#cafe-menu").parent().width($("#cafe-button").outerWidth()-2);
        }
    });
    $("#cafe-button .ui-selectmenu-text").text("Не важно");
    $("#metro").selectmenu({appendTo: ".btn-metro"});
    $("#metro-button .ui-selectmenu-text").text("Метро");
    $("#city-sorting").selectmenu({appendTo: ".btn-city"});
    $("#city-sorting-button .ui-selectmenu-text").text("Город");
    $("#region-sorting").selectmenu({appendTo: ".btn-country"});
    $("#region-sorting-button .ui-selectmenu-text").text("Регион");
    $("#country-sorting").selectmenu({appendTo: ".btn-country"});
    $("#country-sorting-button .ui-selectmenu-text").text("Страна");


});
