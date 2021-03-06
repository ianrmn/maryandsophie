if (!WOOSVI) {
    var WOOSVI = {};
} else {
    if (WOOSVI && typeof WOOSVI !== "object") {
        throw new Error("WOOSVI is not an Object type");
    }
}
jQuery.noConflict();
WOOSVI.STARTS = function ($) {
    var $product_mainimg;
    var $trigger = true;
    var $form = jQuery('.variations_form');
    var $form_start = false;
    var $variationReset = false;
    var $container = jQuery("div#woosvi_strap");
    var $product_variations = $form.data('product_variations');
    var $select_variation_size = ($form.find('.variations select').length > 0) ? true : false;
    var $imagesLoaded_verify = true;
    var $x = 0;
    var $variationAjax = false;
    /*PLUGINS DETECT*/
    var $woosvi_lightbox = (WOOSVIDATA.lightbox == '1') ? true : false;
    var $woosvi_lens = (WOOSVIDATA.lens == '1') ? true : false;
    var $hide_thumbs = (WOOSVIDATA.hide_thumbs == '1') ? true : false;
    var $loadLens = false;
    var arr_items = [];
    return{NAME: "Application initialize module", VERSION: 4.54,
        init: function () {
            jQuery('a.woocommerce-main-image').contents(':not(img)').remove();
            $product_mainimg = jQuery('a.woocommerce-main-image').html();
            if ($($product_mainimg).length <= 0)
                $product_mainimg = false;
            this.loadInits();
        },
        loadInits: function () {

            if ($select_variation_size) { //IS VARIABLE PRODUCT
                if ($product_variations) { //NOT RUNNING AJAX
                    //console.log("VARIATIONS");
                    WOOSVI.STARTS.variationChange();
                } else { //RUNNING AJAX OR OTHER file
                    //console.log("AJAX VARIATIONS");
                    if (!$variationAjax)
                        WOOSVI.STARTS.variationAjax();
                    else
                        WOOSVI.STARTS.variationAjaxDedault();
                }

                if ($hide_thumbs)
                    $container.find('div#woosvithumbs').hide();

                WOOSVI.STARTS.variationReset();
            } else { //IS SINGLE PRODUCT
                //console.log("SINGLE PRODUCT");
                WOOSVI.STARTS.startSingleVariation();
            }

        },
        /*START SELECT ACTIONS*/
        variationChange: function () {

            WOOSVI.STARTS.variationChange_run();

            setTimeout(function () {
                if ($trigger) {
                    //console.log("NOT TRIGGERED");
                    WOOSVI.STARTS.startVariationsEmpty();
                }
            }, 150)
        },
        variationChange_run: function () {

            if ($form_start)
                return;

            $form_start = true;

            $form.on('show_variation', function (event, $variation) {

                //console.log($variation);

                if (typeof ($variation.additional_images) == 'undefined' || (Object.keys($variation.additional_images).length > 0 && typeof ($variation.additional_images[0].woosvi_slug) == 'undefined')) {

                    var $und_var = true
                    var $und_loop = 0;
                    while ($und_var) {

                        var $sel = jQuery(event.currentTarget[$und_loop]).val();
                        //console.log(jQuery.type(WOOSVIDATA.img_groups[$sel]), Object.keys(WOOSVIDATA.img_groups).length);

                        if (Object.keys(WOOSVIDATA.img_groups).length <= 0)
                            $und_var = false;

                        if (jQuery.type(WOOSVIDATA.img_groups[$sel]) != 'undefined') {
                            $und_var = false;
                            $variation.additional_images = WOOSVIDATA.img_groups[$sel];
                            //console.log("RUNNING IN  UNDEFINED " + $und_loop, $variation.additional_images)
                        } else {
                            $und_loop++;
                        }
                    }
                }

                //console.log('varun', $variation);

                $trigger = false;
                arr_items = [];

                //console.log(jQuery.type($variation));

                if (jQuery.type($variation) == 'object' && jQuery.type($variation.additional_images) != 'undefined' && Object.keys($variation.additional_images).length > 0) { //SE EXISTIREM VARIAÇÕES

                    //console.log("TRIGGERED 1");
                    var items = WOOSVI.STARTS.getImageItem($variation.additional_images);

                    var img = WOOSVI.STARTS.buildIMG(jQuery(items).first().find('img').data('sviimg'), 'single');

                    $container.find('div#woosvimain').html('').prepend(img); //INSERT MAIN PRODUCT IMAGE

                    WOOSVI.STARTS.domConstruct(items, true); // INSERT IMAGES IN DOOM
                } else {
                    //console.log("TRIGGERED 2");
                    WOOSVI.STARTS.startVariationsEmpty();
                }
            });
        },
        variationAjax: function () {
            var $trigger = true;
            $variationAjax = true; //PREVENTS AJAX DOM OF BEING LOADED AGAIN

            jQuery(document).ajaxSend(function (event, jqxhr, settings) {
                if (settings.url.indexOf("wc-ajax=get_variation") >= 0) {
                    //console.log("TRIGGERED AJAX");
                    $container.find('div#woosvimain,div#woosvithumbs').empty();
                    $trigger = false;
                    arr_items = [];
                }
            }
            ).ajaxComplete(function (event, xhr, settings) {
                if (settings.url.indexOf("wc-ajax=get_variation") >= 0) {

                    //console.log("TRIGGERED AJAX COMPLETE");
                    var $variation = xhr.responseJSON;
                    var items = WOOSVI.STARTS.getImageItem($variation.additional_images);

                    //console.log(jQuery(items).first().find('img').data('svisingle'));

                    var img = WOOSVI.STARTS.buildIMG(jQuery(items).first().find('img').data('sviimg'), 'single');

                    $container.find('div#woosvimain').prepend(img); //INSERT MAIN PRODUCT IMAGE
                    WOOSVI.STARTS.domConstruct(items, true); // INSERT IMAGES IN DOOM

                    $trigger = true;

                    return;
                }
            });

            setTimeout(function () {
                if ($trigger) {
                    WOOSVI.STARTS.variationAjaxDedault();
                }
            }, 150)
        },
        variationAjaxDedault: function () {
            //console.log("NOT TRIGGERED AJAX");
            var items;
            if ($product_mainimg)
                $container.find('div#woosvimain').html('').append($product_mainimg); //INSERT MAIN PRODUCT IMAGE
            jQuery.each(WOOSVIDATA.failsafe, function (i, v) {
                items += WOOSVI.STARTS.getImageItem(v.additional_images);
            });

            WOOSVI.STARTS.domConstruct(items); // INSERT IMAGES IN DOOM
        },
        variationReset: function () {

            if ($variationReset)
                return;

            $variationReset = true;

            $form.on('click', '.reset_variations', function (event, a) {
                arr_items = [];
                $trigger = true;
                $container.find('div#woosvimain,div#woosvithumbs').empty();
                setTimeout(function () {
                    WOOSVI.STARTS.loadInits();
                }, 100)
            });
        },
        /*END SELECT ACTIONS*/

        /*INITIALIZE DOM CONSTRUCT*/
        startVariationsEmpty: function () {

            var items = WOOSVI.STARTS.getItems(true);
            //console.log("MAIN", $product_mainimg)
            if ($product_mainimg)
                $container.find('div#woosvimain').html('').append($product_mainimg); //INSERT MAIN PRODUCT IMAGE

            WOOSVI.STARTS.domConstruct(items); // INSERT IMAGES IN DOOM
        },
        startSingleVariation: function () {
            var items;
            if ($product_mainimg)
                $container.find('div#woosvimain').html('').append($product_mainimg); //INSERT MAIN PRODUCT IMAGE
            jQuery.each(WOOSVIDATA.failsafe, function (i, v) {
                items += WOOSVI.STARTS.getImageItem(v.additional_images);
            });

            WOOSVI.STARTS.domConstruct(items); // INSERT IMAGES IN DOOM
        },
        /*END DOM CONSTRUCT*/
        /*IMAGE ACTIONS*/
        ActivateSwapImage: function () {
            jQuery('ul.svithumbnails img').click(function (e) {
                WOOSVI.STARTS.initSwap(this);
            });
        },
        initSwap: function (v) {

            var image = new Image();

            var svisingle = WOOSVI.STARTS.buildIMG(jQuery(v).data('sviimg'), 'single');

            image.src = jQuery(svisingle).attr("src");

            jQuery('div#woosvimain').prepend('<div class="sviLoader_thumb"></div>');

            jQuery(image).on("load", function () {
                jQuery('div#woosvimain img').fadeOut('fast').remove();
                jQuery('div#woosvimain').prepend(jQuery(svisingle).hide());
                jQuery('div#woosvimain img').fadeIn('fast');
                jQuery('div#woosvimain').find('.sviLoader_thumb').fadeOut().remove();

                jQuery('div.sviLoader_thumb').remove();
                WOOSVI.STARTS.prettyPhoto(); //RE-ACTIVATE LIGTHGALLERY
                WOOSVI.STARTS.LoadLens();
            });
        },
        /*END IMAGE ACTIONS*/
        /*IMAGE BUILDERS*/
        getItems: function (startEmpty) {
            var items = '';
            //console.log($product_variations);
            var $theLoop = $product_variations;
            if (startEmpty)
                $theLoop = WOOSVIDATA.failsafe;

            jQuery.each($theLoop, function (i, v) {
                //console.log(i, v, v.additional_images)
                items += WOOSVI.STARTS.getImageItem(v.additional_images);
            });
            return items;
        },
        getImageItem: function (additional_images) {
            var item = '';

            jQuery.each(additional_images, function (i, ai) {

                var exists = (jQuery.inArray(ai.ID, arr_items) != -1);
                if (!exists) {
                    arr_items.push(ai.ID);
                    item += '<li data-thumb="' + ai.thumb[0] + '" data-src="' + ai.full[0] + '">';
                    item += '<div class="sviLoader_thumb"></div>';
                    item += WOOSVI.STARTS.buildIMG(ai, 'thumb');
                    item += '</li>';
                }
            });
            return item;
        },
        buildIMG: function (ai, type) {

            /*   var img_load = [];
             img_load['full'] = new Image();
             img_load['full'].src = ai.full[0];
             img_load['large'] = new Image();
             img_load['large'].src = ai.large[0];
             img_load['single'] = new Image();
             img_load['single'].src = ai.single[0];
             img_load['thumb'] = new Image();
             img_load['thumb'].src = ai.thumb[0];
             */

            var img = jQuery('<img>');

            img.attr('src', ai[type][0])
                    .attr('width', ai[type][1])
                    .attr('height', ai[type][2])
                    .attr('title', ai.title)
                    .attr('data-woosvi', ai.woosvi_slug)
                    .attr('data-svizoom-image', ai.full[0])
                    .attr('data-sviimg', JSON.stringify(ai));

            return img[0].outerHTML;
        },
        loadImages: function (items) {
            var $size = jQuery(items).size() - 1;
            jQuery.each(jQuery(items), function ($loop, v) {

                var $classes = [''];
                if ($loop === 0 || $loop % WOOSVIDATA.columns === 0) {
                    $classes.push('first');
                }
                if (($loop + 1) % WOOSVIDATA.columns === 0) {
                    $classes.push('last');
                }
                if ($loop === $size)
                    $classes.push('last');

                jQuery(v).addClass($classes.join(' '));

                $container.find('ul.svithumbnails').append(jQuery(v));
            });
        },
        imagesLoader: function ($hide_thumbs_action) {
            if (!$imagesLoaded_verify) //PREVENT MULTIPLE imagesLoaded() from running
                return;

            $imagesLoaded_verify = false;

            $container.imagesLoaded().progress(WOOSVI.STARTS.onProgress).done(function (instance) {

                $container.removeClass('svihidden');

                WOOSVI.STARTS.ActivateSwapImage(); //ACTIVATE IMAGE SWAP CLICK

                WOOSVI.STARTS.prettyPhoto(); //ACTIVATE LIGTHGALLERY
                WOOSVI.STARTS.LoadLens();

                $container.find('.sviLoader_thumb').fadeOut().remove();

                $imagesLoaded_verify = true;

                if ($hide_thumbs && $hide_thumbs_action) {
                    $container.find('div#woosvithumbs').slideDown();
                }

                //console.log("RUNNING", $imagesLoaded_verify);

            });
        },
        onProgress: function (imgLoad, image) {
            var $item = jQuery(image.img).parent();
            $item.find('.sviLoader_thumb').fadeOut().remove();
        },
        domConstruct: function (items, $hide_thumbs_action) {
            var cols = ' columns-' + WOOSVIDATA.columns;
            if ($container.find('ul.svithumbnails li').length > 0)
                $container.find('ul.svithumbnails li').remove();
            else
                $container.find('div#woosvithumbs').prepend('<ul class="svithumbnails' + cols + '"></ul>');

            WOOSVI.STARTS.loadImages(items); // INSERT IMAGES IN DOOM

            WOOSVI.STARTS.imagesLoader($hide_thumbs_action); // FIRE ACTION WHEN READY
        },
        /*END IMAGE BUILDER*/
        /*PRETTY PHOTO*/
        prettyPhoto: function () {

            if (!$woosvi_lightbox) //IF LIGTHBOX NOT ACTIVE RETURN
                return;

            //console.log("RUNNING LIGHTBOX");

            jQuery('div#woosvimain > img').on('click', function (e) {
                e.preventDefault();
                var click_url = jQuery(this).data('svizoom-image');
                var click_title = jQuery(this).attr('title');
                var api_images = [];
                var api_titles = [];

                jQuery('div#woosvithumbs ul.svithumbnails li').each(function (i, v) {
                    var href = jQuery(this).data('src');
                    api_images.push(href);
                    api_titles.push(jQuery(this).find('img').attr('title'));
                });

                if (jQuery.isEmptyObject(api_images)) {
                    api_images.push(click_url);
                    api_titles.push(click_title);
                }

                jQuery.prettyPhoto.open(api_images, api_titles);

                jQuery('div.pp_gallery').find('img[src="' + click_url + '"]').parent().trigger('click');
            });
        },
        /*END PRETTY PHOTO*/
        /*LOAD LENS*/
        LoadLens: function () {

            if (!$woosvi_lens)
                return;

            if ($loadLens)
                return;

            $loadLens = true;

            jQuery("div.sviZoomContainer").remove();

            var ez, lensoptions;
            var ezR = setInterval(function () {
                if (jQuery("div.sviZoomContainer").length <= 0) {
                    ez = jQuery("div#woosvimain .swiper-slide-active img, div#woosvimain>img");
                    lensoptions = {
                        sviZoomType: 'lens',
                        lensShape: 'round',
                        lensSize: 150,
                        cursor: 'pointer',
                        galleryActiveClass: 'active',
                        containLensZoom: true,
                        loadingIcon: true,
                    };

                    ez.ezPlus(lensoptions);
                    $loadLens = false;
                    clearInterval(ezR);
                }
            }, 500);

        },
        /*END LOAD LENS*/
    }
}(jQuery);
jQuery(document).ready(function () {
    WOOSVI.STARTS.init();
});
