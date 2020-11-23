if (!getCookie('disableGeo')) {

    const redirect_if = "RO";
    const redirect_to = "gardurimd.ro";
    const geo_code = getCookie('geo_code');

    const redirectGeo = function (geo_code) {

        if (geo_code === redirect_if)
            location.href = location.href.replace(location.host, redirect_to);
        else
            setCookie('disableGeo', true, 365);
    };

    if (geo_code)
        redirectGeo(geo_code);
    else
        fetch('https://api.ipgeolocation.io/ipgeo?apiKey=0ea340f2574846a2a25d4a3e8a72bf13')
            .then(response => response.json())
            .then(({country_code2}) => {

                setCookie('geo_code', country_code2, 365);
                redirectGeo(country_code2);
            })
            .catch(err => console.log(err));

}

//  Add to cart
async function ajaxAddToCart({$goods_subject, $goods_item, size, color, quantity}) {


    let lang = $('html').attr('lang');
    let url = '/' + lang + '/cartElements/goods';
    let csfr = {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')};


    $.ajaxSetup({headers: csfr});

    let product_url = location.pathname.replace(`/${lang}`, '');
    let category_url = product_url.split('/').slice(0, -1).join('/');
    let item = {
        category_id: $goods_subject.id,
        product_id: $goods_item.id,
        size_id: size ? size.id : null,
        color_id: color ? color.id : null,
        quantity,
        product_url,
        category_url,

    };

    await $.ajax({
        url: url,
        type: "POST",
        data: item,
        success: function (response) {

            if (response.status === true) {
                $("#miniCart").html(response.html)
                $('.basket').addClass('not_empty_cart');

            }
        }
    });
}

async function ajaxUpdateQuantity(data) {

    let lang = $('html').attr('lang');
    let url = '/' + lang + '/updateQuantity/goods';
    let csfr = {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')};

    $.ajaxSetup({headers: csfr});

    return await $.post({url, data});
}

async function newOrder(data) {

    let lang = $('html').attr('lang');
    let url = `/${lang}/newOrder`;

    data.lang = lang;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    return await $.post({url, data});
}

///feedback
function saveForm(parentThat) {

    let form_id = $(parentThat).data('form-id');
    let $form = $('#' + form_id);
    let $loader = $('#loader');

    $form.submit(function (event) {
        event.preventDefault();
    });

    let serializedForm = new FormData($form[0]);

    if (!$($form)) {
        return;
    }

    if (form_id === 'contact-form') {


        $.ajax({
            method: "POST",
            url: $($form).attr('action'),
            beforeSend: function () {
                $loader.addClass('fade_in_half');
            },
            data: serializedForm,
            enctype: 'multipart/form-data',
            processData: false,  // Important!
            contentType: false,
            cache: false,
            success: function (response) {

                if (response)
                    switch (response.status) {
                        case true:

                            $form.trigger("reset");

                            if (response.text) {

                                $('.feedback_response').html(response.text);
                                $('.feedback_response').addClass('feedback_visible');

                                $('.error-input').removeClass('error-input');
                            }

                            break;

                        default:

                            if (response.text) {

                                $('.feedback_response').html(response.text);
                                $('.feedback_response').addClass('feedback_err_visible');

                                setTimeout(function () {
                                    $('.feedback_response').removeClass('feedback_err_visible');
                                }, 4000);
                            }

                            if (response.messages) {

                                $.each(response.messages, function (ObjNames, ObjValues) {
                                    $($form).find("[name='" + ObjNames + "']").parent().addClass('error-input');

                                });

                                setTimeout(function () {
                                    $(".error-input").removeClass('error-input');
                                }, 4000);
                            }

                    }

            },
            error: function (response) {

                if (response.text) {

                    $('.feedback_response').html(response.text);
                    $('.feedback_response').addClass('feedback_err_visible');

                    setTimeout(function () {
                        $('.feedback_response').removeClass('feedback_err_visible');
                    }, 4000);
                }
            },
            complete: function () {

                $loader.removeClass('fade_in_half');
            }
        })
    }
}

$(document).ready(function () {

    $("#loader").removeClass('fade_in');

    $('body').on('click', '.delete_item', async function (e) {
        e.preventDefault();

        let lang = $('html').attr('lang');
        let dataString = $(this).data('delete').split(',');
        let dataObj = {
            'lang': lang,
            'miniCart': true,
        };

        for (let key of ['$category_key', '$product_key', '$size_key', '$color_key']) {
            dataObj[key] = dataString.shift() || null
        }

        let $minicart = $('#miniCart')

        $minicart.addClass('disabled');

        let res = await ajaxUpdateQuantity(dataObj)

        console.log(res.cart_empty);

        if (res.cart_empty)
            $('.basket').removeClass('not_empty_cart');


        $minicart.removeClass('disabled')

        $minicart.html(res.html)

    })

    /*==================================================================
    [ Cart ]*/

    $('.js-show-cart').on('click', function (e) {
        e.preventDefault()


        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function (e) {
        e.preventDefault()


        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    //Whatsapp button
    $('.whatsapp_btn').on('click', function () {
        $(this).closest('.whatsapp').toggleClass('open');
    })


    /*From main.js*/
    svg4everybody();

    $(".tabWrap").tabslet();

    $(".animationBlock").tabslet({
        controls: {
            prev: ".prev",
            next: ".next"
        }
    })
});

/*breadcrumbs*/
const breadcrumbs = document.querySelectorAll('.breadcrambs li > span, .breadcrambs li > a');

for ( const id in breadcrumbs) {
    if (breadcrumbs.hasOwnProperty(id)) {
        const breadcrumb = breadcrumbs[id];
        breadcrumb.innerText = breadcrumb.innerText.replace(/-/g, ' ')
    }
}