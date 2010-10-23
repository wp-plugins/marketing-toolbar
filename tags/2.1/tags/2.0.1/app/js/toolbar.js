/* Slideshow
--------
Author: Krishna Bhattarai
URl: http://krishnabhattarai.com
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
				$('#ssovit-inline-toolbar-wrapper').append('<div id="ssovit-inline-toolbar-close" style="position:absolute;top:0px;right:0px;padding:1px;cursor:pointer;font-size:10px;">X</div>');

vn_is=p.vibration_count*2;
if(p.product_text=='yes')
{
								$('#ssovit-inline-toolbar-wrapper').append('<div id="ssovit-inline-toolbar-powered" style="color:#ffffff !important;position:absolute;bottom:0px;right:0px;padding:1px;font-size:8px;"><a href="http://www.toolbarplugin.com" style="color:#fff">Powered by Toolbarplugin.com</a></div>');	
}
$('#ssovit-inline-toolbar-close').click(function(){
$('#ssovit-inline-toolbar-wrapper').hide(100);
												 });

if(p.display_close!='yes')
				{
					$('#ssovit-inline-toolbar-close').css('display','none');
				}


if(p.position!='top' && p.position!='bottom')
p.position='top';
				if(p.position=="top"){
					$('body').css({padding:'50px 0 0 0'});
					$('#ssovit-inline-toolbar-wrapper').css({position:'fixed',top:0,left:0,zIndex:1000});
				}
				if(p.position=="bottom"){
					$('body').css({padding:'0 0 50px 0'});
					$('#ssovit-inline-toolbar-wrapper').css({position:'fixed',bottom:0,left:0,zIndex:1000});
				}
$('#ssovit-col1').append('<div id="ssovit-product-meta" class="ssovit-cols"></div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-title"><a href="'+p.product_link+'">' + p.title + '</a></div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-price">' + p.price + '</div>');
				$('#ssovit-product-meta').append('<div id="ssovit-product-description">' + p.description + '</div>');
				if(p.image.length>0){
					$('#ssovit-col1').prepend('<div id="ssovit-product-image" class="ssovit-cols"></div>');
					$('#ssovit-product-image').prepend($('<img/>').attr({title:p.title,src:p.image, id:'ssovit-product-image-big' }));
					$('#ssovit-product-image').prepend($('<img/>').attr({title:p.title,src:p.image_sm, id:'ssovit-product-image-sm' }));
				}
				$('#ssovit-col2').append('<div id="ssovit-product-action">' + p.on_action + '</div>');
				$('#ssovit-product-image-big').wrap($('<a id="ssovit-product-action-link" href="'+p.product_link+'"></a>'));
				$('#ssovit-col3').append('<div id="ssovit-product-aweber"></div>');
				$('#ssovit-col3').append('<div id="ssovit-product-aweber-temp" style="display:none"></div>');
				$('#ssovit-col3').append('<div id="ssovit-product-aweber-text"></div>');
				$('#ssovit-product-aweber-temp').html(p.aweber);
																	 
//$('#ssovit-product-aweber-temp').each(function(){
					/*  if($(this).attr('name')=="name" || $(this).attr('name')=="subscriber_name" || $(this).attr('name')=="FormValue_Fields[CustomField4095]"){

					$('#ssovit-product-aweber').append($('<label>Name</label>'));
					}
					 if($(this).attr('name')=="email" || $(this).attr('name')=="subscriber_email"|| $(this).attr('name')=="FormValue_Fields[EmailAddress]"){

					$('#ssovit-product-aweber').append($('<label>Email</label>'));
					} 
					
				 $(this).clone().removeAttr('id').removeAttr('class').removeAttr('style').appendTo($('#ssovit-product-aweber'));
				 */
			// });
				
				//$('#ssovit-product-aweber').wrap($('<form></form>').attr({target:'_new',action:$('#ssovit-product-aweber-temp form').attr('action'),method:$('#ssovit-product-aweber-temp form').attr('method')}));
				
$temp=p.aweber;
				$new=r_attr($temp);
				$('#ssovit-product-aweber').html($new);
				$('#ssovit-product-aweber input').each(function(){
				$(this).removeAttr('class').removeAttr('style').removeAttr('id');
															   });
				
				$('#ssovit-product-aweber  ul').each(function(){
				$(this).removeAttr('class').removeAttr('style').removeAttr('id');
															   });
$('#ssovit-product-aweber  li').each(function(){
				$(this).removeAttr('class').removeAttr('style').removeAttr('id');
															   });				
				
$('#ssovit-product-aweber  label').each(function(){
				$(this).removeAttr('class').removeAttr('style').removeAttr('id');
															   });				
				
				$('#ssovit-product-aweber  ul').each(function(){
				$(this).removeAttr('class').removeAttr('style').removeAttr('id');
															   });

				$('#ssovit-product-aweber a').remove();
				$('#ssovit-product-aweber br').remove();
				$('#ssovit-product-aweber span').remove();
				$('#ssovit-product-aweber hr').remove();
				$('#ssovit-product-aweber form').removeAttr('class').removeAttr('id').removeAttr('style');
				$('#ssovit-product-aweber-text').html(p.aweber_text);
				
				

$('#ssovit-product-aweber form label').each(function(i){
     $(this).replaceWith($(this).text());
    });
$('#ssovit-product-aweber form li').each(function(i){
     $(this).replaceWith($(this).html());
    });
$('#ssovit-col3 ul').each(function(index){
     $(this).replaceWith($(this).html());
    });




$('#ssovit-product-aweber ul').remove();
var strtvib;

//if(p.auto_vibration=='yes' &&!isNaN(p.vibration_time) && vibration_time>0)
//{
//alert('vibration');	
//strtvib=setInterval("dovibration()",vibration_time*1000);


//}




//$('#ssovit-product-aweber').html().replace("<ul>", "");
				$('#ssovit-product-aweber-temp').remove();
				//$('#ssovit-product-image-big, #ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').hide();
				$('#ssovit-product-image-sm').hide();

vn=p.vibration_number;
if(vn<=1)
vn=2;
vn=vn*1000;

if(p.auto_vibration=='yes')
{
	if(p.vibration_time<1)
	p.vibration_time=1;
	p.vibration_time=p.vibration_time*1000;
	pvt=p.vibration_time;
setTimeout("startvibration();",vn);
}



//else {

c.click(function(){
$.get("wp-content/plugins/marketing-toolbar/hits.php?id="+tid, { name: table } );	

 
				 
				 
				 });

				c.hover(function(){
								 strtvib=clearInterval(strtvib);
								 mover=true;
								 if(compressed=='n' ) return;
								//hideTimeout=clearInterval(hideTimeout);
								 $('#ssovit-product-image-big').stop().fadeIn(300,function(){$(this).fadeTo(300,1)});
								 $('#ssovit-product-image-sm').stop().hide();
								 $('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').stop().fadeIn(300,function(){$(this).fadeTo(300,1)});
								 compressed='n';
								 
								 },function(){
									 if(compressed=='y') return;
									

	//hideTimeout=setInterval(function(){
	$('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').fadeOut(300,function(){
								 $('#ssovit-product-image-big').hide();
								 $('#ssovit-product-image-sm').fadeIn();
								 compressed='y';
																		});
																	//},1000);
	})
//}
});
			
			}
		});
	};
})(jQuery);



setTimeout("docontract()",3000);
function startvibration(){
	strtvib=setInterval("dovibration()",pvt);

}

function docontract()
{
jQuery('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').fadeOut(300,function(){jQuery('#ssovit-product-image-big').hide();jQuery('#ssovit-product-image-sm').fadeIn();});
compressed='n';

}

function dovibration()
{
if(mover) return;
if(vn_count>vn_is) return;
vn_count++;
if(compressed=='y')
{
	

jQuery('#ssovit-product-image-big').fadeIn(300,function(){jQuery('#ssovit-inline-toolbar').fadeTo(300,1);});
jQuery('#ssovit-product-image-sm').hide();
jQuery('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').fadeIn(300,function(){jQuery('#ssovit-inline-toolbar').fadeTo(300,1)});


compressed='n';



}
else
{




	
jQuery('#ssovit-product-description,#ssovit-product-action,#ssovit-product-aweber-text').fadeOut(300,function(){jQuery('#ssovit-product-image-big').hide();jQuery('#ssovit-product-image-sm').fadeIn();});
																	 

compressed='y';


}
}
function r_attr($temp)
{
		var strInputCode=$temp;
		 			
 	 	strInputCode = strInputCode.replace(/&(lt|gt);/g, function (strMatch, p1){
 		 	//return (p1 == "lt")? "<" : ">";
 		});
 		var strTagStrippedText = strInputCode.replace(/<table\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<div\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<frame\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<iframe\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<p\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<center>\/?[^>]+(>|$)/g, "");


		strTagStrippedText = strTagStrippedText.replace(/<br>\/?[^>]+(>|$)/g, "");

				strTagStrippedText = strTagStrippedText.replace('<p>', "");

				strTagStrippedText = strTagStrippedText.replace('</p>', "");
				strTagStrippedText = strTagStrippedText.replace("<br />", "");
				strTagStrippedText = strTagStrippedText.replace("<br>", "");
				
				


		strTagStrippedText = strTagStrippedText.replace(/<p\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<br>\/?[^>]+(>|$)/g, "");
		
			strTagStrippedText = strTagStrippedText.replace(/<li\/?[^>]+(>|$)/g, "");
		strTagStrippedText = strTagStrippedText.replace(/<ul>\/?[^>]+(>|$)/g, "");
		
				strTagStrippedText = strTagStrippedText.replace('<p>', "");
				strTagStrippedText = strTagStrippedText.replace('</p>', "");

				strTagStrippedText = strTagStrippedText.replace("<br />", "");
				strTagStrippedText = strTagStrippedText.replace("<br>", "");
	strTagStrippedText = strTagStrippedText.replace('<li>', "");

				strTagStrippedText = strTagStrippedText.replace('</li>', "");
								strTagStrippedText = strTagStrippedText.replace('<ul>', "");

				strTagStrippedText = strTagStrippedText.replace('&lt;ul&gt;', "");

				strTagStrippedText = strTagStrippedText.replace('&lt;ul/&gt;', "");

strTagStrippedText = strTagStrippedText.replace('&lt;li&gt;', "");

				strTagStrippedText = strTagStrippedText.replace('</p>', "");				

				strTagStrippedText = strTagStrippedText.replace('<hr>', "");
								strTagStrippedText = strTagStrippedText.replace('<a>', "");				
												strTagStrippedText = strTagStrippedText.replace('</a>', "");				
			

				
return strTagStrippedText;				
				
}