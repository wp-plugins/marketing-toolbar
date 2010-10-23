/* Slideshow
--------
Author: Sovit Tamrakar
URl: http://ssovit.com
Version: 1.0
---------
*/
(function ($) {
	$.fn.ssovitToolbar = function (input) {
		var defaults = {
			url: false
		};
		return this.each(function () {
			var options = $.extend(defaults, input);
			var hideTimeout=0;
			if(options.url.length>0){
			$.getJSON(options.url, function(data) {
				var p=data.content;
				$('body').append($('<div></div>').attr({'id':'ssovit-inline-toolbar'}));
				var c=$('#ssovit-inline-toolbar');
				c.wrap($('<div></div>').attr({'id':'ssovit-inline-toolbar-wrapper'}))
				$('#ssovit-inline-toolbar-wrapper').css({background:p.bg});
				c.append('<div id="ssovit-col1"></div>');
				c.append('<div id="ssovit-col2"></div>');
				c.append('<div id="ssovit-col3"></div>');
				c.append('<div class="ssovit-clear"></div>');
				if(p.position=="top"){
					$('body').css({padding:'50px 0 0 0'});
					$('#ssovit-inline-toolbar-wrapper').css({position:'fixed',top:0,left:0,zIndex:45});
				}
				if(p.position=="bottom"){
					$('body').css({padding:'0 0 50px 0'});
					$('#ssovit-inline-toolbar-wrapper').css({position:'fixed',bottom:0,left:0,zIndex:45});
				}
				$('#ssovit-col1').append('<div id="ssovit-product-meta" class="ssovit-cols"></div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-title"><a href="'+p.target+'">' + p.title + '</a></div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-price">' + p.price + '</div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-description">' + p.description + '</div>');
				if(p.image.length>0){
					$('#ssovit-col1').prepend('<div id="ssovit-product-image" class="ssovit-cols"></div>');
					$('#ssovit-product-image').prepend($('<img/>').attr({title:p.title,src:p.image, id:'ssovit-product-image-big' }));
					$('#ssovit-product-image').prepend($('<img/>').attr({title:p.title,src:p.image_sm, id:'ssovit-product-image-sm' }));
				}
				$('#ssovit-col2').append('<div id="ssovit-product-action">' + p.on_action + '</div>');
				$('#ssovit-product-image-big').wrap($('<a id="ssovit-product-action-link" href="'+p.target+'"></a>'));
				$('#ssovit-col3').append('<div id="ssovit-product-aweber"></div>');
				$('#ssovit-col3').append('<div id="ssovit-product-aweber-temp" style="display:none"></div>');
				$('#ssovit-col3').append('<div id="ssovit-product-aweber-text"></div>');
				$('#ssovit-product-aweber-temp').html(p.aweber);
				$('#ssovit-product-aweber-temp input').each(function(){
					 if($(this).attr('name')=="name" || $(this).attr('name')=="subscriber_name" || $(this).attr('name')=="FormValue_Fields[CustomField4095]"){

					$('#ssovit-product-aweber').append($('<label>Name</label>'));
					}
					 if($(this).attr('name')=="email" || $(this).attr('name')=="subscriber_email"|| $(this).attr('name')=="FormValue_Fields[EmailAddress]"){

					$('#ssovit-product-aweber').append($('<label>Email</label>'));
					}
					 $(this).clone().removeAttr('id').removeAttr('class').removeAttr('style').appendTo($('#ssovit-product-aweber'));
			 });
				$('#ssovit-product-aweber').wrap($('<form></form>').attr({target:'_new',action:$('#ssovit-product-aweber-temp form').attr('action'),method:$('#ssovit-product-aweber-temp form').attr('method')}));
				$('#ssovit-product-aweber-text').html(p.aweber_text);
				$('#ssovit-product-aweber-temp').remove();
				$('#ssovit-product-image-big, #ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').hide();
				c.hover(function(){
								 hideTimeout=clearInterval(hideTimeout);
								 $('#ssovit-product-image-big').stop().fadeIn(300,function(){$(this).fadeTo(300,1)});
								 $('#ssovit-product-image-sm').stop().hide();
								 $('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').stop().fadeIn(300,function(){$(this).fadeTo(300,1)});
								 },function(){
									 hideTimeout=setInterval(function(){
								 $('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').fadeOut(300,function(){
								 $('#ssovit-product-image-big').hide();
								 $('#ssovit-product-image-sm').fadeIn();
																																				  });
																	  },1000);
})
			});
			}
		});
	};
})(jQuery);