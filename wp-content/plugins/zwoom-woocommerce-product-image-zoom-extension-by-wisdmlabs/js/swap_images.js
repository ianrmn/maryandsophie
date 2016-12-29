//Now onwards we will be creating a variable for all selectors and those variables will be used. Names of those variables should always start with 'selector'.
//global variable for slider images dimensions.
var wdm_height = 0;
var wdm_width = 0;
var wdm_main_div_width2 = 0;
var wdm_main_div_height2 = 0;

jQuery(document).ready(function() {
 //initial height and width of slider images will be assigned to wdm_height and wdm_width
 var selector_shop_thumbnail = jQuery('.attachment-shop_thumbnail');
 wdm_height = selector_shop_thumbnail.innerHeight();
 wdm_width = selector_shop_thumbnail.innerWidth();

 //Cleanup DOM and resize images after page has loaded completely
 window.onload = function() {

  //To remove unwanted extra image
  jQuery('.bxslider li:first-child').remove();

  //Bxslider's first image selector
  var selector_bxslider_first_element = jQuery('.bxslider li:eq(0) a');

  var wdm_img_padding = jQuery('.bxslider li:eq(1) a img:eq(0)').css("padding");

  selector_bxslider_first_element.css("padding", wdm_img_padding);
  selector_bxslider_first_element.removeClass("woocommerce-main-image");
  selector_bxslider_first_element.find('img').removeClass("wp-post-image");
  selector_bxslider_first_element.find('img').css("padding", "0px")
   //To remove extra content in slider images if present
  if (jQuery('.bxslider li').length != 0) {
   var x = jQuery('.bxslider li:eq(0) a').html();
   var y = x.split('</div>');
   var z = y[0] + "</div>";
   jQuery('.bxslider li:eq(0) a').html(z);
   jQuery('.images a:eq(1) img').trigger('click');
  } else {
   //Featured image selector
   var selector_featured_image = jQuery('.images a img:eq(0)');

   //Zoomed image selector
   var selector_zoomed_image = jQuery('.zoomImg');

   selector_zoomed_image.css('height', obj.zlevel * selector_featured_image.height());
   selector_zoomed_image.css('width', obj.zlevel * selector_featured_image.width());
  }
  jQuery('.images a img:eq(1)').position('left', '0px');
  var selector_bxslider_elements = jQuery('.bxslider li a');
  if (wdm_width > 0 && wdm_height > 0) {
   selector_bxslider_elements.find('img').width(wdm_width);
   selector_bxslider_elements.find('img').height(wdm_height);
   selector_bxslider_elements.width(wdm_width);
   selector_bxslider_elements.height(wdm_height);
  } else if (wdm_width > 0) {
   selector_bxslider_elements.find('img').width(wdm_width);
   selector_bxslider_elements.find('img').height(wdm_width);
   selector_bxslider_elements.width(wdm_width);
   selector_bxslider_elements.height(wdm_width);
  }

  jQuery('#slider_main_div').show();
  jQuery('.bxslider li:eq(1) a').show();

  //To give position to slider list
  jQuery('.bx-window ul').css('left', '30px');
  jQuery('.bx-next').css('top', (jQuery('.bxslider li a img').height() / 2) - 10);
  jQuery('.bx-prev').css('top', (jQuery('.bxslider li a img').height() / 2) - 10);
  //   }
  jQuery('.bx-wrapper').width(jQuery('.images a:eq(0) img:eq(0)').width());
  jQuery('.bx-window').width(jQuery('.images a:eq(0) img:eq(0)').width() - 60);

 };

 //To apply new class by changing previous
 jQuery('.thumbnails .zoom').removeClass('zoom').addClass('wisdm_zoom').attr('rel', 'remove');

 //jQuery(".size-shop_thumbnail .zoom").removeClass("zoom").addClass("wisdm_zoom").attr("rel", "remove");
 jQuery('a.wisdm_zoom').removeData();

 get_all_images_link = [];
 //wisdm_obj holds the relationship between image to be displayed in 'Featured Image' box and the image to be zoomed. 'Key' in object will be the url of full width image and 'Value' in object will be image displayed in 'Featured image box'
 var wisdm_obj = new Object();

 //Add first element in the object. Add default featured image in the object
 wisdm_obj[wdm_zwoom_object.sourceimageurlforzoom] = wdm_zwoom_object.sourceimagesinglesrc;

 jQuery('a.wisdm_zoom').each(function() {
  get_all_images_link.push(jQuery(this).attr("href"));
  temp_link = jQuery(this).attr("href");
  wisdm_obj[temp_link] = temp_link;
 });
 //To get all image urls from product gallary
 var data = {
  action: 'get_ids_of_all_attachments',
  all_links: get_all_images_link.join(':::::')
 };
 jQuery.ajax({
  type: 'POST',
  traditional: true,
  url: wdm_zwoom_object.admin_ajax_url,
  async: false,
  data: data,
  success: function(response) {
   if (response != '') {
    response_string = response.split(':::::');
    console.log(response_string);
    //var links_to_be_preloaded = new Array();
    for (var i = 0; i < response_string.length; i++) {
     var separate_new_old_links = response_string[i].split('|||||');
     var newPhoto = new Image();
     newPhoto.src = separate_new_old_links[1];
     var newPhoto2 = new Image();
     newPhoto2.src = separate_new_old_links[0];
     wisdm_obj[newPhoto.src] = newPhoto2.src;
    }
   }
   load_rest_of_script();
  }
 });
 //To list all images in slider
 function load_rest_of_script() {

  jQuery('.images').find('a.zoom:first').width(jQuery('.images').width());
  jQuery('.thumbnails').attr('id', 'slider_main_div');
  jQuery('<ul class="bxslider"></ul>').prependTo('#slider_main_div');
  jQuery('.images').find('a.zoom:first').clone().wrap('<li></li>').prependTo('#slider_main_div .bxslider').addClass('first-featured-image wisdm_zoom');
  jQuery('.first-featured-image img').attr({
   src: wdm_zwoom_object.sourceimageurl,
   width: wdm_zwoom_object.thumbnail_image_width,
   height: wdm_zwoom_object.thumbnail_image_height,
   style: ""
  });
  jQuery('.thumbnails a').each(function() {
   var cloned_element = jQuery(this).clone();
   jQuery(this).remove();
   var create_a_new_li = jQuery("<li></li>").appendTo('#slider_main_div .bxslider');
   cloned_element.appendTo(create_a_new_li);
  });
  //To apply css to slider images
  jQuery("#slider_main_div").css({
   'height': wdm_zwoom_object.thumbnail_image_height,
   'width': jQuery(".images").width()
  });
  jQuery('.bxslider li').css('paddingLeft', '10px').css('paddingRight', '10px');
  jQuery('a.wisdm_zoom').unbind("click");
  jQuery('a.wisdm_zoom').click(function(event) {
   event.preventDefault();
  });
  var first_image_selector = jQuery('.images a.zoom:first');
  first_image_selector.each(function(index) {

   if (index == 0) {
    var title_of_image = jQuery(this).attr("title");
    jQuery(this).hover(
     function() {
      jQuery(this).attr("title", "");
     },
     function() {
      jQuery(this).attr("title", title_of_image);
     });
   }

  });
  jQuery('.bxslider').bxSlider({
   speed: 800,
   setWrapperwidth: jQuery('.images').width(),
   setChildrenWidth: (parseInt(wdm_zwoom_object.thumbnail_image_width)),
   moveSlideQty: 1,
   prevImage: wdm_zwoom_object.previous_image,
   nextImage: wdm_zwoom_object.next_image,
   hideControlOnEnd: true,
   infiniteLoop: false,
   distanceBetweenControlImages: 20
  });
  //To apply zooming function to slider image on click
  jQuery('.bxslider li .wisdm_zoom').click(function() {
   var get_original_link_of_image = jQuery(this).attr("href");
   //Handle Responsive images introduced in WordPress 4.4+
   first_image_selector.find('img:first').attr('srcset', jQuery(this).find('img').attr('srcset'));
   first_image_selector.find('img:first').attr("src", wisdm_obj[get_original_link_of_image]).width(jQuery(".images").width());
   var zoom_level_to_be_set_new = parseInt(wdm_zwoom_object.zoomleveloption) || 2;
   var get_zoomed_height_new = first_image_selector.find('img:first').height() * zoom_level_to_be_set_new;
   jQuery('.images .zoomImg').height(get_zoomed_height_new);
   first_image_selector.find('.zoomImg').attr("src", get_original_link_of_image);
   first_image_selector.attr("href", get_original_link_of_image);
  });
 }

});