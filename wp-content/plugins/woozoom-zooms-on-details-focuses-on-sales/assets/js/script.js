jQuery( document ).ready(function($) {	
	if( $('#woozoom-zoom').length ) {
		var woozoom_args = {
			gallery:'woozoom-gallery', 
			galleryActiveClass: 'active', 
			imageCrossfade: true, 
			cursor: 'crosshair'			
		};
		
		if( woozoom_js.zoom_type == '' ) {
			woozoom_js.zoom_type = 'window';
		}
		
		woozoom_args.zoomType = woozoom_js.zoom_type;
		if( woozoom_args.zoomType == 'lens' ) {
			woozoom_args.containLensZoom = true;
			woozoom_args.lensSize = woozoom_js.zoom_lens_size;
			
			if( woozoom_js.zoom_lens_type == '' ) {
				woozoom_js.zoom_lens_type = 'square';
			}
			woozoom_args.lensShape = woozoom_js.zoom_lens_type;
		} else if( woozoom_args.zoomType == 'window' ) {
			if( (typeof woozoom_js.zoom_box_size.width != 'undefined' && woozoom_js.zoom_box_size.width > 0) && (typeof woozoom_js.zoom_box_size.height != 'undefined' && woozoom_js.zoom_box_size.height > 0) ) {
				woozoom_args.zoomWindowWidth = woozoom_js.zoom_box_size.width;
				woozoom_args.zoomWindowHeight = woozoom_js.zoom_box_size.height;
			}
		}
		
		if( woozoom_js.easing == 1 ) {
			woozoom_js.easing = true;
		} else {
			woozoom_js.easing = false;
		}
		woozoom_args.easing = woozoom_js.easing;
		
		if( woozoom_js.scroll_zoom == 1 ) {
			woozoom_js.scroll_zoom = true;
		} else {
			woozoom_js.scroll_zoom = false;
		}
		woozoom_args.scrollZoom = woozoom_js.scroll_zoom;
		
		//Mobile Responsive Fix
		woozoom_mobile_args = JSON.parse(JSON.stringify(woozoom_args));
		if( woozoom_mobile_args.zoomType == 'window' ) {
			woozoom_mobile_args.zoomType = 'inner';
		}
		
		//Disable Lightbox from Thumbnails
		$(".woozoom-images a[data-rel^='prettyPhoto']").unbind('click');
		$(".woozoom-images a.woocommerce-main-image[data-rel^='prettyPhoto']").click(function(e) {
			e.preventDefault();
			
			var lightbox_img = $(this).attr('href');
			var lightbox_img_title = $("#woozoom-gallery a:first").attr('title');
			var lightbox_img_description = $("#woozoom-gallery a:first").data('description');
			
			if( $("#woozoom-gallery a.active").length ) {
				var img_large = $("#woozoom-gallery a.active").data('zoom-image');
				if( typeof img_large != 'undefined' ) {
					lightbox_img = img_large;
				}
				
				lightbox_img_title = $("#woozoom-gallery a.active").attr('title');
				lightbox_img_description = $("#woozoom-gallery a.active").data('description');
			}			
			$.prettyPhoto.open(lightbox_img, lightbox_img_title, lightbox_img_description);
		});
		
		$(window).resize(function() {
			$('#woozoom-zoom').removeData('elevateZoom');
			$('.zoomWrapper #woozoom-zoom').unwrap();
			$('.zoomContainer').remove();
			
			if( $(this).width() < 768 ) {
				$('#woozoom-zoom').elevateZoom(woozoom_mobile_args);
			} else {
				woozoom_args = woozoom.hooks.applyFilters('woozoom_args', woozoom_args);
				$('#woozoom-zoom').elevateZoom(woozoom_args);
			}
		});
		$(window).trigger('resize');		
		
		// Thumbnails Jcarousel Slider
		$(function() {
		    var jcarousel = $('.jcarousel');

		    jcarousel
		        .on('jcarousel:reload jcarousel:create', function () {
		            var carousel = $(this),
		                width = carousel.innerWidth();
					
					width = width / 4;

		            carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
		        })
		        .jcarousel({
		            wrap: 'circular'
		        });

		    $('.jcarousel-control-prev')
		        .jcarouselControl({
		            target: '-=1'
		        });

		    $('.jcarousel-control-next')
		        .jcarouselControl({
		            target: '+=1'
		        });
		});
	}
});
