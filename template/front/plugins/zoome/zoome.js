/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */
 
(function ($) {

var zoome={
	$currentImgWrap:null,
	$magnifier:null,
	$magnifierImg:null,
	$magnifierState:null,
	init:function()
	{
		zoome.$magnifier = $('<div id="zm-magnifier"><img style="position:relative;left:0;top:0;"/><span>1X</span></div>').appendTo('body');
		zoome.$magnifierImg= $('img',zoome.$magnifier);
		zoome.$magnifierState = $('span',zoome.$magnifier);
		$(document).bind('mousemove',function(e){
			if(zoome.$currentImgWrap)
			{
				zoome.movemagnifier(e);
			}
		});
		zoome.$magnifier.mousewheel(function(e, delta, deltaX, deltaY){
			var info = zoome.$currentImgWrap.get(0).zoominfo;
			var op = deltaY>0?1:-1;
			var	nextZoom =Math.round((info.currentZoom+info.zoomStep*op)*10)/10.0;
			if(nextZoom<=info.zoomRange[1]&& nextZoom>=info.zoomRange[0])
			{
				info.currentZoom = nextZoom;
				zoome.$magnifierImg.css({left:-(e.pageX-info.coords.left)*info.currentZoom+info.magnifierSize[0]/2,top:-(e.pageY-info.coords.top)*info.currentZoom+info.magnifierSize[1]/2,width:info.imgSize.width*info.currentZoom,height:info.imgSize.height*info.currentZoom});
				zoome.$magnifierState.text(info.currentZoom+'X');
				
			}
			e.preventDefault();
		});
	},
	setup:function($img,options,fn)
	{
		if($img.parent().attr('id')!='zm-magnifier')
		{
			var i_w,i_h,largeImg,$hover_layer;
			
			$img.wrap('<div class="zm-wrap"></div>');
			var $imgWrap = $img.parent();
			if(options.hoverEf=='transparent')
			{
				$hover_layer = $('<div class="zm-hover zm-trans"></div>').appendTo($imgWrap);
			}
			else
			{
				$hover_layer= $img.clone().addClass('zm-hover').appendTo($imgWrap);
				if(options.hoverEf=='grayscale')
				{
					fn.grayscale($hover_layer);
				}
				else if(options.hoverEf=='blur')
				{
					if($.browser.msie)
					{
						$hover_layer.addClass("zm-blur");
					}
					else
					{
						fn.blur($hover_layer,3);
					}
				}
			}
			if($img.attr(options.largeImgAttr))
			{
				largeImg = $img.attr(options.largeImgAttr);
				new Image().src = largeImg;
			}
			else
			{
				largeImg = $img.attr('src');
			}
			$imgWrap.get(0).zoominfo = {defaultZoom:options.defaultZoom,zoomStep:options.zoomStep,zoomRange:options.zoomRange,showZoomState:options.showZoomState,borderSize:3,imgSize:null,coords:null,largeImg:null,currentZoom:options.defaultZoom,magnifierSize:options.magnifierSize};
			
			
			$imgWrap.bind('mouseover',function(){
				zoome.$currentImgWrap = $(this);
				var $img =$('img:first',this);
				var info = $(this).get(0).zoominfo;
				info.coords = {left:$img.offset().left,top:$img.offset().top,right:$img.offset().left+$img.width(),bottom:$img.offset().top+$img.height()};
				info.largeImg =$img.attr(options.largeImgAttr)?$img.attr(options.largeImgAttr):$img.attr('src');
				info.imgSize={width:$img.width(),height:$img.height()};
				$(this).get(0).zoominfo = info;
				zoome.$magnifierImg.attr('src',info.largeImg).css({width:info.currentZoom*info.imgSize.width,height:info.currentZoom*info.imgSize.height});
				zoome.$magnifier.css({width:info.magnifierSize[0],height:info.magnifierSize[1]}).fadeIn(300);
				if(info.showZoomState)
				{
					zoome.$magnifierState.text(info.currentZoom+'X').show();
				}
				else
				{
					zoome.$magnifierState.hide();
				}
				$(this).find('.zm-hover').fadeIn(400);
			});
		}
	},
	movemagnifier:function(e){
		var info = zoome.$currentImgWrap.get(0).zoominfo;
		
		if(e.pageX>=info.coords.left && e.pageX<=info.coords.right && e.pageY>=info.coords.top && e.pageY<=info.coords.bottom)
		{
			//in the img and move
			zoome.$magnifier.css({left:e.pageX-info.magnifierSize[0]/2-info.borderSize,top:e.pageY-info.magnifierSize[1]/2-info.borderSize});
			zoome.$magnifierImg.css({left:-(e.pageX-info.coords.left)*info.currentZoom+info.magnifierSize[0]/2,top:-(e.pageY-info.coords.top)*info.currentZoom+info.magnifierSize[1]/2});
		}
		else
		{
			zoome.$currentImgWrap.find('.zm-hover').fadeOut(300);
			zoome.$currentImgWrap = null;
			zoome.$magnifier.hide();
		}
	}
};
(function($){
	var fn ={
		img2Gray:function(img)
		{
			try{
				var canvas = document.createElement('canvas');
				var ctx = canvas.getContext('2d');
				canvas.height = img.height;
				canvas.width = img.width;
				ctx.drawImage(img,0,0,img.width,img.height);
				var imgPixels = ctx.getImageData(0, 0, img.width, img.height);
				for(var y = 0; y < imgPixels.height; y++){
					for(var x = 0; x < imgPixels.width; x++){
						var i = (y * 4) * imgPixels.width + x * 4;
						var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
						imgPixels.data[i] = avg; 
						imgPixels.data[i + 1] = avg; 
						imgPixels.data[i + 2] = avg;
					}
				}
				ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
				$(img).attr('src',canvas.toDataURL());
			}
			catch(err)
			{
				alert('Canvas can not getImageData from local or corss domain image!');
			}
		},
		grayscale:function($img){
			if($.browser.msie)
			{
				$img.addClass("zm-gray");
			}
			else
			{
				fn.img2Gray($img.get(0));
			}
		},
			blur:function($img,radius){
			function BlurStack()
			{
				this.r = 0;
				this.g = 0;
				this.b = 0;
				this.a = 0;
				this.next = null;
			}
			var mul_table = [
			512,512,456,512,328,456,335,512,405,328,271,456,388,335,292,512,
			454,405,364,328,298,271,496,456,420,388,360,335,312,292,273,512,
			482,454,428,405,383,364,345,328,312,298,284,271,259,496,475,456,
			437,420,404,388,374,360,347,335,323,312,302,292,282,273,265,512,
			497,482,468,454,441,428,417,405,394,383,373,364,354,345,337,328,
			320,312,305,298,291,284,278,271,265,259,507,496,485,475,465,456,
			446,437,428,420,412,404,396,388,381,374,367,360,354,347,341,335,
			329,323,318,312,307,302,297,292,287,282,278,273,269,265,261,512,
			505,497,489,482,475,468,461,454,447,441,435,428,422,417,411,405,
			399,394,389,383,378,373,368,364,359,354,350,345,341,337,332,328,
			324,320,316,312,309,305,301,298,294,291,287,284,281,278,274,271,
			268,265,262,259,257,507,501,496,491,485,480,475,470,465,460,456,
			451,446,442,437,433,428,424,420,416,412,408,404,400,396,392,388,
			385,381,377,374,370,367,363,360,357,354,350,347,344,341,338,335,
			332,329,326,323,320,318,315,312,310,307,304,302,299,297,294,292,
			289,287,285,282,280,278,275,273,271,269,267,265,263,261,259];
			var shg_table = [
			 9, 11, 12, 13, 13, 14, 14, 15, 15, 15, 15, 16, 16, 16, 16, 17, 
			17, 17, 17, 17, 17, 17, 18, 18, 18, 18, 18, 18, 18, 18, 18, 19, 
			19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 20, 20, 20,
			20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 21,
			21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21,
			21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 22, 22, 22, 22, 22, 22, 
			22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22,
			22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 23, 
			23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
			23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
			23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 
			23, 23, 23, 23, 23, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 
			24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
			24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
			24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
			24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24 ];
			try{
				var canvas = document.createElement('canvas');
				var context = canvas.getContext('2d');
				var width= canvas.width = $img.width();
				var height =canvas.height = $img.height(); 
				context.drawImage($img.get(0), 0, 0,width,height); 
				var imageData   = context.getImageData(0, 0, canvas.width, canvas.height);
				var pixels = imageData.data;
				var x, y, i, p, yp, yi, yw, r_sum, g_sum, b_sum,
				r_out_sum, g_out_sum, b_out_sum,
				r_in_sum, g_in_sum, b_in_sum,
				pr, pg, pb, rbs;
					
				var div = radius + radius + 1;
				var w4 = width << 2;
				var widthMinus1  = width - 1;
				var heightMinus1 = height - 1;
				var radiusPlus1  = radius + 1;
				var sumFactor = radiusPlus1 * ( radiusPlus1 + 1 ) / 2;
				var stackStart = new BlurStack();
				var stack = stackStart;
				for ( i = 1; i < div; i++ )
				{
					stack = stack.next = new BlurStack();
					if ( i == radiusPlus1 ) var stackEnd = stack;
				}
				stack.next = stackStart;
				var stackIn = null;
				var stackOut = null;
				
				yw = yi = 0;
				
				var mul_sum = mul_table[radius];
				var shg_sum = shg_table[radius];
				
				for ( y = 0; y < height; y++ )
				{
					r_in_sum = g_in_sum = b_in_sum = r_sum = g_sum = b_sum = 0;
					
					r_out_sum = radiusPlus1 * ( pr = pixels[yi] );
					g_out_sum = radiusPlus1 * ( pg = pixels[yi+1] );
					b_out_sum = radiusPlus1 * ( pb = pixels[yi+2] );
					
					r_sum += sumFactor * pr;
					g_sum += sumFactor * pg;
					b_sum += sumFactor * pb;
					
					stack = stackStart;
					
					for( i = 0; i < radiusPlus1; i++ )
					{
						stack.r = pr;
						stack.g = pg;
						stack.b = pb;
						stack = stack.next;
					}
					
					for( i = 1; i < radiusPlus1; i++ )
			
					{
						p = yi + (( widthMinus1 < i ? widthMinus1 : i ) << 2 );
						r_sum += ( stack.r = ( pr = pixels[p])) * ( rbs = radiusPlus1 - i );
						g_sum += ( stack.g = ( pg = pixels[p+1])) * rbs;
						b_sum += ( stack.b = ( pb = pixels[p+2])) * rbs;
						
						r_in_sum += pr;
						g_in_sum += pg;
						b_in_sum += pb;
						
						stack = stack.next;
					}
					
					
					stackIn = stackStart;
					stackOut = stackEnd;
					for ( x = 0; x < width; x++ )
					{
						pixels[yi]   = (r_sum * mul_sum) >> shg_sum;
						pixels[yi+1] = (g_sum * mul_sum) >> shg_sum;
						pixels[yi+2] = (b_sum * mul_sum) >> shg_sum;
						
						r_sum -= r_out_sum;
						g_sum -= g_out_sum;
						b_sum -= b_out_sum;
						
						r_out_sum -= stackIn.r;
						g_out_sum -= stackIn.g;
						b_out_sum -= stackIn.b;
						
						p =  ( yw + ( ( p = x + radius + 1 ) < widthMinus1 ? p : widthMinus1 ) ) << 2;
						
						r_in_sum += ( stackIn.r = pixels[p]);
						g_in_sum += ( stackIn.g = pixels[p+1]);
						b_in_sum += ( stackIn.b = pixels[p+2]);
						
						r_sum += r_in_sum;
						g_sum += g_in_sum;
						b_sum += b_in_sum;
						
						stackIn = stackIn.next;
						
						r_out_sum += ( pr = stackOut.r );
						g_out_sum += ( pg = stackOut.g );
						b_out_sum += ( pb = stackOut.b );
						
						r_in_sum -= pr;
						g_in_sum -= pg;
						b_in_sum -= pb;
						
						stackOut = stackOut.next;
			
						yi += 4;
					}
					yw += width;
				}
			
				
				for ( x = 0; x < width; x++ )
				{
					g_in_sum = b_in_sum = r_in_sum = g_sum = b_sum = r_sum = 0;
					
					yi = x << 2;
					r_out_sum = radiusPlus1 * ( pr = pixels[yi]);
					g_out_sum = radiusPlus1 * ( pg = pixels[yi+1]);
					b_out_sum = radiusPlus1 * ( pb = pixels[yi+2]);
					
					r_sum += sumFactor * pr;
					g_sum += sumFactor * pg;
					b_sum += sumFactor * pb;
					
					stack = stackStart;
					
					for( i = 0; i < radiusPlus1; i++ )
					{
						stack.r = pr;
						stack.g = pg;
						stack.b = pb;
						stack = stack.next;
					}
					
					yp = width;
					
					for( i = 1; i <= radius; i++ )
					{
						yi = ( yp + x ) << 2;
						
						r_sum += ( stack.r = ( pr = pixels[yi])) * ( rbs = radiusPlus1 - i );
						g_sum += ( stack.g = ( pg = pixels[yi+1])) * rbs;
						b_sum += ( stack.b = ( pb = pixels[yi+2])) * rbs;
						
						r_in_sum += pr;
						g_in_sum += pg;
						b_in_sum += pb;
						
						stack = stack.next;
					
						if( i < heightMinus1 )
						{
							yp += width;
						}
					}
					
					yi = x;
					stackIn = stackStart;
					stackOut = stackEnd;
					for ( y = 0; y < height; y++ )
					{
						p = yi << 2;
						pixels[p]   = (r_sum * mul_sum) >> shg_sum;
						pixels[p+1] = (g_sum * mul_sum) >> shg_sum;
						pixels[p+2] = (b_sum * mul_sum) >> shg_sum;
						
						r_sum -= r_out_sum;
						g_sum -= g_out_sum;
						b_sum -= b_out_sum;
						
						r_out_sum -= stackIn.r;
						g_out_sum -= stackIn.g;
						b_out_sum -= stackIn.b;
						
						p = ( x + (( ( p = y + radiusPlus1) < heightMinus1 ? p : heightMinus1 ) * width )) << 2;
						
						r_sum += ( r_in_sum += ( stackIn.r = pixels[p]));
						g_sum += ( g_in_sum += ( stackIn.g = pixels[p+1]));
						b_sum += ( b_in_sum += ( stackIn.b = pixels[p+2]));
						
						stackIn = stackIn.next;
						
						r_out_sum += ( pr = stackOut.r );
						g_out_sum += ( pg = stackOut.g );
						b_out_sum += ( pb = stackOut.b );
						
						r_in_sum -= pr;
						g_in_sum -= pg;
						b_in_sum -= pb;
						
						stackOut = stackOut.next;
						
						yi += width;
					}
				}
				context.putImageData( imageData, 0, 0 );
				$img.attr('src',canvas.toDataURL());

			}
			catch(err)
			{
				alert('Canvas can not getImageData from local or corss domain image!');
			}
				
		}
	};
	$.fn.zoome=function(options){
		var settings = $.extend({defaultZoom:2,largeImgAttr:'rel',zoomRange:[1,10],zoomStep:1,showZoomState:false,magnifierSize:[140,140],borderSize:3,hoverEf:'normal'},options);
		return this.each(function(){
			if (this.tagName!="IMG")
			return true;
			if($(this).attr("src")&&$.trim($(this).attr("src"))!="")
			{
				if(this.complete)
				{
					zoome.setup($(this),settings,fn);
				}
				else
				{
					$(this).one('load',function(){
						zoome.setup($(this),settings,fn);
					});
				}
			}
			
		});
	};
})(jQuery);


(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail     ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);

$(function(){
	zoome.init();	
});

})(jQuery)