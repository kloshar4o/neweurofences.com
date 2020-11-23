(function ($) {

	//preloader
	$(window).on('load', function () {
		var preloader_wrap = $('#preloader_wrap'),
			preloader = $('#preloader');
		preloader.fadeOut();
		preloader_wrap.delay(350).fadeOut('slow');
	});

	//equalHeight
	$(window).on('load', function () {
		$('.avantage').matchHeight();
		
		if (window.matchMedia("(min-width: 768px)").matches) {
			$('.sidebar-filter-in, .products-list-wrap').matchHeight({
				property: 'min-height'
			});
			$('.shops-list .shops-list-item').matchHeight({
				byRow: true
			});
		}
	});
	
	//on ready
	$(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

		//run modals
		$('a.getModal').on('click', function () {
			var target_modal = $(this).attr('href');
			$(target_modal).arcticmodal();
		});

		//scroll to anchors
		$('.scrolling').click(function () {
			var target = $(this).attr('href');
			$('html, body').animate({scrollTop: $(target).offset().top}, 500);
			return false;
		});

		// hide placeholder on focus and return it on blur
		$('input, textarea').focus(function () {
			$(this).data('placeholder', $(this).attr('placeholder'));
			$(this).attr('placeholder', '');
		});
		$('input, textarea').blur(function () {
			$(this).attr('placeholder', $(this).data('placeholder'));
		});

		// index-slider
		$('.index-slider').slick({
			arrows: false,
			dots: true,
			infinite: true,
			speed: 600,
			slidesToShow: 1,
			slidesToScroll: 1
		});

		//header-phone
		$('.header-phone').on('click', function () {
			$('.header-contacts-popup').stop().fadeToggle();
		});

		//.header-work-time
		if (window.matchMedia("(max-width: 768px)").matches) {
			$('.header-work-time-wrap').on('click', function () {
				$('.header-work-time').stop().fadeToggle();
			});
		}

		//header-menu dropdown
		if (window.matchMedia("(min-width: 1140px)").matches) {
			$('.header-menu li.has-submenu').on('mouseenter', function () {
				$(this).addClass('open');
				$(this).find('> .sub-menu').stop().fadeIn();
			}).on('mouseleave', function () {
				$(this).removeClass('open');
				$(this).find('> .sub-menu').stop().fadeOut();
			});
		}
		if (window.matchMedia("(max-width: 1140px)").matches) {
			$('.header-menu-toggle').on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('open');
				$('.header-menu').slideToggle();
			});
			$('.header-menu li.has-submenu').on('click', function (e) {
				e.preventDefault();
				$(this).toggleClass('open');
				$(this).find('> .sub-menu').stop().slideToggle();
			});
		}

		//catalog-menu
		$('.catalog-menu-toggle').on('click', function (e) {
			e.stopPropagation();
			$(this).toggleClass('open');
			$('.catalog-menu').stop().slideToggle();
		});
		if (window.matchMedia("(min-width: 1140px)").matches) {
			var catalog_height = $('.catalog-menu').outerHeight();
			$('.catalog-menu > li.has-submenu > .sub-menu').css('height', catalog_height);
			$('.catalog-menu > li.has-submenu > .catalog-menu-item-img-wrap').css('height', catalog_height);
		}
		if (window.matchMedia("(max-width: 1140px)").matches) {
			$('.catalog-menu > li.has-submenu > a').on('click', function (e) {
				e.preventDefault();
				$(this).parent().toggleClass('open');
				$(this).siblings('.sub-menu').stop().slideToggle();
			});
		}

        //close catalog menu on click out of the div
        $(document).mouseup(function (e) {
            var container = $(".catalog-menu");
			var target = e.target;
			target = $(target).hasClass('catalog-menu-toggle');
            if ( container.is(':visible') && (container.has(e.target).length === 0) && !target){
                //container.hide();
				$('.catalog-menu-toggle').toggleClass('open');
				$('.catalog-menu').stop().slideToggle();
            }
        });

		//clients-slider
		$('.clients-slider').slick({
			arrows: true,
			dots: false,
			infinite: true,
			speed: 300,
			centerMode: true,
			variableWidth: true,
            initialSlide: 3,
//          slidesToShow: 1,
//			slidesToScroll: 1,
//			responsive: [
//				{
//					breakpoint: 1140,
//					settings: {
//						slidesToShow: 5
//					}
//				},
//				{
//					breakpoint: 1024,
//					settings: {
//						slidesToShow: 4
//					}
//				},
//				{
//					breakpoint: 768,
//					settings: {
//						slidesToShow: 3
//					}
//				},
//				{
//					breakpoint: 480,
//					settings: {
//						slidesToShow: 2
//					}
//				}
//			]
		});
		
		//footer
		if (window.matchMedia("(max-width: 768px)").matches) {
			$('.toggle-next-div').on('click', function () {
				$(this).toggleClass('open');
				$(this).next('div').slideToggle();
			});
		}
		
		//go_top
		$('.go-top').click(function () {
			$('html, body').animate({scrollTop: 0}, 300);
		});
		$(window).scroll(function () {
			if ($(window).scrollTop() > 150) {
				$('.go-top').fadeIn();
			} else {
				$('.go-top').fadeOut();
			}
		});
		
		// product-img-slider
		$('.product-img-slider').slick({
			arrows: true,
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			slidesToScroll: 1,
			asNavFor: '.product-thumbs-slider',
			fade: true,
//			responsive: [
//				{
//					breakpoint: 1024,
//					settings: {
//						slidesToShow: 3,
//					}
//				},
//				{
//					breakpoint: 768,
//					settings: {
//						slidesToShow: 2
//					}
//				},
//				{
//					breakpoint: 480,
//					settings: {
//						slidesToShow: 1
//					}
//				}
//			]
		});
		
		// product-thumbs-slider
		$('.product-thumbs-slider').slick({
			arrows: false,
			dots: false,
			speed: 300,
			slidesToShow: 5,
			slidesToScroll: 1,
			variableWidth: true,
			focusOnSelect: true,
			asNavFor: '.product-img-slider',
			responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 3,
						centerMode: true
					}
				}
			]
		});
		
		//more in catalog-page-item
		if (window.matchMedia("(min-width: 480px)").matches) {
			$('.catalog-page-item .catalog-page-item-in').each(function() {
				$this = $(this);
				var linksHeight = $(this).find('.catalog-page-item-links').outerHeight();
				if (linksHeight >= 192) {
					$this.append('<div class="catalog-page-item-show-more-wrap"><a class="catalog-page-item-show-more">Ещё</a></div>');
				}
			});
			$(document).on('click', '.catalog-page-item-show-more', function() {
				var $thisParent = $(this).parents('.catalog-page-item');
				var more = $thisParent.data('more');
				var less = $thisParent.data('less');
				if ($thisParent.hasClass('open')) {
					$('.catalog-page-item').removeClass('open');
					$(this).removeClass('open');
					$(this).text(more);
				} else {
					$('.catalog-page-item').not($thisParent).removeClass('open');
					$('.catalog-page-item-show-more').text(more);
					$(this).addClass('open');
					$(this).parents('.catalog-page-item').addClass('open');
					$(this).text(less);
				}
			});
		}
		$('.catalog-page-item-links-toggle').on('click', function (e) {
			e.preventDefault();
			$(this).parents('.catalog-page-item').toggleClass('open').find('.catalog-page-item-links').slideToggle();
		});
		
		
		//select styler
		$('select').styler({
			//selectPlaceholder: 'Выберите...'
		});
		
		//filter-block toggle
		$('.filter-title').on('click', function (e) {
			e.preventDefault();
			$(this).toggleClass('open');
			$(this).next('.filter-hidden').stop().slideToggle();
		});
		
		//checkbox styler
		$('input[type=checkbox]').styler();
		
		//sidebar-filter toggle
		$('.hide-sidebar-filter').on('click', function () {
			$('.sidebar-filter').removeClass('open');
		});
		$('.toggle-filter').on('click', function () {
			$('.sidebar-filter').toggleClass('open');
		});
		
		//products-list-item hover
		$(document).on('mouseenter', '.products-list-item', function () {
			$(this).addClass('hover');
			$(this).find('.desc').stop().slideDown();
		}).on('mouseleave', '.products-list-item', function () {
			var $this = $(this);
			$(this).find('.desc').stop().slideUp(300, function () {
				$this.removeClass('hover');
			});
		});
		
		//buy-list-item hover
		$('.buy-list-item').on('mouseenter', function () {
			$(this).addClass('hover');
			$(this).find('.desc').stop().slideDown();
		}).on('mouseleave', function () {
			var $this = $(this);
			$(this).find('.desc').stop().slideUp(300, function () {
				$this.removeClass('hover');
			});
		});
		
		//product-tabs
		$('.product-tabs').tabslet({
			animation: true
		});
		
		//masked input
		$("input[name=phone]").mask("+373 99999999");
		
		//google map initializa
		if($("#map").length > 0) {
			initialize(47.028537, 28.798721, null);
			
			$('.shops-list-item .show-on-map, .shops-list-item .address').on('click', function() {
				
				var _this = $(this);
				var latitude = _this.data('latitude');
				var longitude = _this.data('longitude');
				
				initialize(latitude, longitude, 'click');
				
				$('html, body').animate({
					scrollTop: $("#map").offset().top
				}, 1000);
			});
		}

// Ranger
        $.each($('.range'), function(key, value){
            var min_value = $(value).attr('data-min');
            var max_value = $(value).attr('data-max');

            var data_min_input = $(value).attr('data-min-get');
            var data_max_input = $(value).attr('data-max-get');

            var el_id = $(value).attr('id');

            if((data_min_input == min_value) && (data_max_input == max_value)) {
                global_range(min_value, max_value, null, null, el_id);
            }
            else {
                global_range(min_value, max_value, data_min_input, data_max_input, el_id);
            }
        });

        $('.result').on('change', function(){

            var min_value = $(this).siblings('.range').attr('data-min');
            var max_value = $(this).siblings('.range').attr('data-max');

            var min_value_input = parseInt($(this).find('.price1').val());
            var max_value_input = parseInt($(this).find('.price2').val());

            if(min_value_input < min_value || max_value_input > max_value){
                $(this).find('.price1').val(min_value);
                $(this).find('.price2').val(max_value);
            }
            else if(min_value_input > max_value || max_value_input < min_value){
                $(this).find('.price1').val(min_value);
                $(this).find('.price2').val(max_value);
            }
            else if(min_value_input > max_value_input){
                $(this).find('.price1').val(min_value);
                $(this).find('.price2').val(max_value);
            }

        });

// Ranger

//    Filter
        $('#filter-data :input').on('change', function(){

            // $('.paginations').load(window.location.href + ' ul.pagination');
            var my_form_id = $(this).parents('#filter-data').get(0);
            filterForm(my_form_id);
        });
//    Filter

//  Ajax pagination

        // $(document).on('click', '.pagination li a', function(e){
        //     e.preventDefault();
        //
        //     var curr_page = $(this).parents('.paginations').attr('data-curr-page');
        //
        //     var page = $(this).html();
        //
        //     if(parseInt(page, 10)) {
        //         load_more(page);
        //     }
        //     else if($(this).hasClass('next')){
        //         page = parseInt(curr_page) + 1;
        //         load_more(page);
        //     }
        //     else{
        //         page = parseInt(curr_page) - 1;
        //         load_more(page);
        //     }
        // });
//  Ajax pagination

//  Add to wish
        $(document).on('click', '.add-to-buy-list', function(e){
            e.preventDefault();

            $(this).toggleClass('active');

            var lang = $('html').attr('lang');
            var url = '/' + lang + '/wishElements/goods';
            var goods_id = $(this).attr('data-id');

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: goods_id
                },
                success: function(response) {
                    if(response.status == true) {

                        if(response.wish_count > 0) {
                            $('.cart-nr').html(response.wish_count);
                            $('.cart-nr').removeClass('hidden');
                        }
                        else {
                            $('.cart-nr').addClass('hidden');
                        }

                    }
                }
            })

        });
//  Add to wish

//  Order Elements
        $('#show-by').on('change', function(){
            var lang = $('html').attr('lang');
			var url = '/' + lang + '/sortListPage/goods' + window.location.search;

            var per_page = $(this).val();

            var loader_height = $('.products').height() + 71;
            var loader_min_height = $('.sidebar-filter').height() + 71;
            var child = $(this).data('child');
            var empty_response = $('.products-list-with-filter').find('.products').attr('data-empty-rsp');

            $('.products-list-with-filter').find('.loader-list').css({'height' : loader_height, 'bottom' : 0, 'min-height': loader_min_height});

            $.ajax({
                type: "POST",
                url: url,
                beforeSend: function() {
                    $('.products-list-with-filter').find('.loader-list').fadeIn();
                },
                data: {
                    lang: lang,
                    per_page: per_page,
                    child: child
                },
                success: function(response) {
                    $('.products-list-with-filter').find('.loader-list').fadeOut();
                    if(response.status == true) {

                        $('.paginations').html(response.pagination);

                        $('.products').html(response.view);

                        if(response.total_elements == 0) {
                            $('.products').html('<div class="empty-list"><span>' + empty_response + '</span></div>');
                        }
                    }
                    // window.location.reload();
                },
                error: function () {
                    $('.products-list-with-filter').find('.loader-list').fadeOut();
                }
            });
        });
//  Order Elements

//    Global search on the site
        $('#global-search-form').submit(function(e){
            e.preventDefault();

            var _this = $(this);
            var search_key = _this.find('#search-main-form').val();
            var lang = $('html').attr('lang');
            var url = '/' + lang + '/searchItems/search';

            var loader_height = _this.find('#submit-search-main-form').height();
            var loader_width = _this.find('#submit-search-main-form').outerWidth();
            var loader_border_radius = '0 2px 2px 0';
            var loader_bottom = 0;

            if($(window).width() <= 1200) {
                loader_border_radius = '50%';
                loader_bottom = 0;
            }

            _this.find('.loader-list-search').css({'height' : loader_height, 'bottom' : loader_bottom, 'width' : loader_width, 'left' : 'inherit', 'border-radius' : loader_border_radius, 'background-color': '#f89728', 'opacity': 1});

            $.ajax({
                type: "POST",
                url: url,
                beforeSend: function(){
                    _this.find('.loader-list-search').fadeIn();
                },
                data: {
                    q: search_key
                },
                success: function(response) {
                    _this.find('.loader-list-search').fadeOut();
                    if(response.status == true) {

                        var newUrl = window.location.protocol + "//" + window.location.host + '/' + lang + response.messages;
                        window.history.pushState({path:newUrl},'',newUrl);

                        $('#site-container').html(response.view);
                    }
                },
                error: function() {
                    _this.find('.loader-list-search').fadeOut();
                }
            });

        });

        var options = {

            url: function(phrase) {
                var lang = $('html').attr('lang');
                var url = '/' + lang + '/suggestItems/search';
                return url;
            },

            displayValue: function(element) {
                return element.name;
            },

            getValue: function(element) {
                return element.name + element.code;
            },

            ajaxSettings: {
                dataType: "json",
                method: "POST",
                data: {
                    dataType: "json"
                }
            },

            preparePostData: function(data) {

                data.phrase = $("#search-main-form").val();
                return data;
            },

            requestDelay: 300,

            list: {

                onKeyEnterEvent: function() {
                    $('#global-search-form').submit();
                },

                showAnimation: {
                    type: "fade",
                    time: 200,
                    callback: function() {}
                },

                hideAnimation: {
                    type: "fade",
                    time: 200,
                    callback: function() {}
                },

                maxNumberOfElements: 10,

                match: {
                    enabled: true
                }
            },

            template: {
                type: "custom",
                method: function(value, item) {
                    var response = "" +
                        "<a href='" + item.link + "' class='search-link'>" +
                            "<div class='search-ico-c'>" +
                                "<img src='" + item.icon + "' class='search-ico-c' />" +
                            "</div>" +
                            "<div class='search-content-c'>" +
                                "<span class='search-text-c'>" + value + "</span>" +
                                "<div class='search-code-div-c'>" +
                                    "<span class='search-code-c'> " + item.code + "</span>" +
                                "</div>" +
                            "</div>" +
                        "</a>";
                    return response;
                }
            }

        };

        $("#search-main-form").easyAutocomplete(options);



//    Global search on the site

//	Remove error label
        $(document).on('click', 'label.error', function () {
            $(this).fadeOut('slow', function () {
                $(this).remove();
            });
        });

        $('form input, form textarea').focusin(function () {
            var _siblings = $(this).siblings('label.error');
            _siblings.fadeOut('slow');
        }).focusout(function() {
            var _siblings = $(this).siblings('label.error');
            _siblings.fadeIn('slow');
        });

//	Remove error label

	}); //END on ready
})(jQuery);

function global_range(min, max, data_min_input, data_max_input, el_id){
    var my_form_id = $('#filter-data').get(0);
    var slider = $('#' + el_id).get(0);
    var input_from = $(slider).siblings('.range-values').find('#' + el_id + '_from').get(0);
    var input_to = $(slider).siblings('.range-values').find('#' + el_id + '_to').get(0);

    if(min == max)
        min = 1;

    if(data_min_input == data_max_input)
        data_min_input = 1;

    if(data_min_input == null || data_max_input == null) {
        noUiSlider.create(slider, {
            start: [1, parseInt(max)],

            connect: true,
            margin: 1,
            range: {
                'min': parseInt(min),
                'max': parseInt(max)
            }
        });
    }
    else {
        noUiSlider.create(slider, {
            start: [data_min_input, data_max_input],

            connect: true,
            margin: 1,
            range: {
                'min': parseInt(min),
                'max': parseInt(max)
            }
        });
    }

    slider.noUiSlider.on('update', function ( values, handle ) {

        if (handle) {
            $('#' + el_id).siblings('.range-values').find('.my_range_val_max').val(parseInt(values[handle]));

        }
        else {
            $('#' + el_id).siblings('.range-values').find('.my_range_val_min').val(parseInt(values[handle]));
        }

    });

    input_from.addEventListener('change', function(){
        slider.noUiSlider.set([this.value, null]);
    });

    input_to.addEventListener('change', function(){
        slider.noUiSlider.set([null, this.value]);
    });

    slider.noUiSlider.on('change', function(values, handle){
        if (handle) {
            $('#' + el_id).siblings('.range-values').find('.my_range_val_max').val(parseInt(values[handle]));

        }
        else {
            $('#' + el_id).siblings('.range-values').find('.my_range_val_min').val(parseInt(values[handle]));
        }

        filterForm(my_form_id);
    });

}

function filterForm(parentThat) {

    var form_id = $(parentThat).data('form-id');
    $( '#'+form_id ).submit(function( event ) {
        event.preventDefault();
    });

    var form = $('#'+ $(parentThat).data('form-id'));
    var serializedForm = $(form).find("select, textarea, input").serializeArray();
	serializedForm.push({name: 'data-child', value: form.attr('data-child')});

    if (!$(form)) {
        return;
    }

    var loader_height = $('.products').outerHeight() + 71;
    var loader_min_height = $('.sidebar-filter').outerHeight() + 71;

    $('.products-list-with-filter').find('.loader-list').css({'height' : loader_height, 'bottom' : 0, 'min-height': loader_min_height});

    var empty_response = $('.products-list-with-filter').find('.products').attr('data-empty-rsp');

    if(form_id == 'filter-data') {

        $.ajax({
            method: "POST",
            url: $(form).attr('action'),
            beforeSend: function(){
                $('.products-list-with-filter').find('.loader-list').fadeIn();
            },
            data: serializedForm,
            success: function (response) {
                $('.products-list-with-filter').find('.loader-list').fadeOut();

                if (response.status == true) {
                    //$('span.total-count').html(response.total_elements);

                    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + response.messages;
                    window.history.pushState({path:newUrl},'',newUrl);

                    $('.paginations').html(response.pagination);


                    $('.products').html(response.view);

                    if(response.total_elements == 0) {
                        $('.products').html('<div class="empty-list"><span>' + empty_response + '</span></div>');
                    }

                }
            },
            error: function () {
                $('.products-list-with-filter').find('.loader-list').fadeOut();
            }
        })
    }
}

function saveForm(parentThat) {

    var form_id = $(parentThat).data('form-id');

    $( '#'+form_id ).submit(function( event ) {
        event.preventDefault();
    });

    var form = $('#'+ $(parentThat).data('form-id'));
    var serializedForm = $(form).find("select, textarea, input").serializeArray();
    var formData = new FormData($(form));
    console.log(formData);

    if (!$(form)) {
        return;
    }

    var loader_height = form.outerHeight();

    if(form_id == 'feedback_page_form') {
        $('#' + form_id + ' .loader-list').css({'height' : loader_height, 'bottom' : 0});

        $(form).find('input[type=text], textarea').removeClass('error-input');
        $(form).find('label.error').remove();

        $.ajax({
            method: "POST",
            url: $(form).attr('action'),
            beforeSend: function(){
                $('#' + form_id + ' .loader-list').fadeIn();
            },
            data: serializedForm,
            success: function (response) {
                grecaptcha.reset();
                $('#' + form_id + ' .loader-list').fadeOut();
                if (response.status == true) {

                    $('#modal-callback').arcticmodal('close');
                    $('#modal-success').arcticmodal();

                    setTimeout(function(){
                        $('#modal-success').arcticmodal('close');
                    }, 3000);

                    $(form).find('input[type=text], textarea').val('');
                    $(form).find('input[type=text], textarea').removeClass('error-input');
                }
                else {

                    if (response.messages != null) {
                        $.each( response.messages, function( ObjNames, ObjValues ) {
                            $(form).find('span.' + ObjNames).remove('label.' + ObjNames);
                            $(form).find("[name='" + ObjNames + "']").removeClass('error-input');
                            $(form).find("[name='" + ObjNames + "']").after('<label class="error ' + ObjNames + '" for="' + ObjNames + '">' + ObjValues + '</label>');
                            $(form).find("[name='" + ObjNames + "']").addClass('error-input');
                        });
                    }
                }
            },
            error: function() {
                grecaptcha.reset();
                $('#' + form_id + ' .loader-list').fadeOut();
            }
        })
    }
}