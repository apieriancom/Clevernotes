jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});
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
(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery)
/* 
== malihu jquery custom scrollbars plugin == 
version: 2.3.1 
author: malihu (http://manos.malihu.gr) 
plugin home: http://manos.malihu.gr/jquery-custom-content-scroller 
*/

var methods={init:function(options){var defaults={set_width:false,set_height:false,horizontalScroll:false,scrollInertia:550,scrollEasing:"easeOutCirc",mouseWheel:"pixels",mouseWheelPixels:60,autoDraggerLength:true,scrollButtons:{enable:false,scrollType:"continuous",scrollSpeed:20,scrollAmount:40},advanced:{updateOnBrowserResize:true,updateOnContentResize:false,autoExpandHorizontalScroll:false,autoScrollOnFocus:true},callbacks:{onScrollStart:function(){},onScroll:function(){},onTotalScroll:function(){},onTotalScrollBack:function(){},onTotalScrollOffset:0,whileScrolling:false,whileScrollingInterval:30}},options=jQuery.extend(true,defaults,options);jQuery(document).data("mCS-is-touch-device",false);if(is_touch_device()){jQuery(document).data("mCS-is-touch-device",true);}
function is_touch_device(){return!!("ontouchstart"in window)?1:0;}
return this.each(function(){var jQuerythis=jQuery(this);if(options.set_width){jQuerythis.css("width",options.set_width);}
if(options.set_height){jQuerythis.css("height",options.set_height);}
if(!jQuery(document).data("mCustomScrollbar-index")){jQuery(document).data("mCustomScrollbar-index","1");}else{var mCustomScrollbarIndex=parseInt(jQuery(document).data("mCustomScrollbar-index"));jQuery(document).data("mCustomScrollbar-index",mCustomScrollbarIndex+1);}
jQuerythis.wrapInner("<div class='mCustomScrollBox' id='mCSB_"+jQuery(document).data("mCustomScrollbar-index")+"' style='position:relative; height:100%; overflow:hidden; max-width:100%;' />").addClass("mCustomScrollbar _mCS_"+jQuery(document).data("mCustomScrollbar-index"));var mCustomScrollBox=jQuerythis.children(".mCustomScrollBox");if(options.horizontalScroll){mCustomScrollBox.addClass("mCSB_horizontal").wrapInner("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />");var mCSB_h_wrapper=mCustomScrollBox.children(".mCSB_h_wrapper");mCSB_h_wrapper.wrapInner("<div class='mCSB_container' style='position:absolute; left:0;' />").children(".mCSB_container").css({"width":mCSB_h_wrapper.children().outerWidth(),"position":"relative"}).unwrap();}else{mCustomScrollBox.wrapInner("<div class='mCSB_container' style='position:relative; top:0;' />");}
var mCSB_container=mCustomScrollBox.children(".mCSB_container");if(jQuery(document).data("mCS-is-touch-device")){mCSB_container.addClass("mCS_touch");}
mCSB_container.after("<div class='mCSB_scrollTools' style='position:absolute;'><div class='mCSB_draggerContainer' style='position:relative;'><div class='mCSB_dragger' style='position:absolute;'><div class='mCSB_dragger_bar' style='position:relative;'></div></div><div class='mCSB_draggerRail'></div></div></div>");var mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),mCSB_draggerContainer=mCSB_scrollTools.children(".mCSB_draggerContainer"),mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger");if(options.horizontalScroll){mCSB_dragger.data("minDraggerWidth",mCSB_dragger.width());}else{mCSB_dragger.data("minDraggerHeight",mCSB_dragger.height());}
if(options.scrollButtons.enable){if(options.horizontalScroll){mCSB_scrollTools.prepend("<a class='mCSB_buttonLeft' style='display:block; position:relative;'></a>").append("<a class='mCSB_buttonRight' style='display:block; position:relative;'></a>");}else{mCSB_scrollTools.prepend("<a class='mCSB_buttonUp' style='display:block; position:relative;'></a>").append("<a class='mCSB_buttonDown' style='display:block; position:relative;'></a>");}}
mCustomScrollBox.bind("scroll",function(){if(!jQuerythis.is(".mCS_disabled")){mCustomScrollBox.scrollTop(0).scrollLeft(0);}});jQuerythis.data({"mCS_Init":true,"horizontalScroll":options.horizontalScroll,"scrollInertia":options.scrollInertia,"scrollEasing":options.scrollEasing,"mouseWheel":options.mouseWheel,"mouseWheelPixels":options.mouseWheelPixels,"autoDraggerLength":options.autoDraggerLength,"scrollButtons_enable":options.scrollButtons.enable,"scrollButtons_scrollType":options.scrollButtons.scrollType,"scrollButtons_scrollSpeed":options.scrollButtons.scrollSpeed,"scrollButtons_scrollAmount":options.scrollButtons.scrollAmount,"autoExpandHorizontalScroll":options.advanced.autoExpandHorizontalScroll,"autoScrollOnFocus":options.advanced.autoScrollOnFocus,"onScrollStart_Callback":options.callbacks.onScrollStart,"onScroll_Callback":options.callbacks.onScroll,"onTotalScroll_Callback":options.callbacks.onTotalScroll,"onTotalScrollBack_Callback":options.callbacks.onTotalScrollBack,"onTotalScroll_Offset":options.callbacks.onTotalScrollOffset,"whileScrolling_Callback":options.callbacks.whileScrolling,"whileScrolling_Interval":options.callbacks.whileScrollingInterval,"bindEvent_scrollbar_click":false,"bindEvent_mousewheel":false,"bindEvent_focusin":false,"bindEvent_buttonsContinuous_y":false,"bindEvent_buttonsContinuous_x":false,"bindEvent_buttonsPixels_y":false,"bindEvent_buttonsPixels_x":false,"bindEvent_scrollbar_touch":false,"bindEvent_content_touch":false,"mCSB_buttonScrollRight":false,"mCSB_buttonScrollLeft":false,"mCSB_buttonScrollDown":false,"mCSB_buttonScrollUp":false,"whileScrolling":false}).mCustomScrollbar("update");if(options.horizontalScroll){if(jQuerythis.css("max-width")!=="none"){if(!options.advanced.updateOnContentResize){options.advanced.updateOnContentResize=true;}
jQuerythis.data({"mCS_maxWidth":parseInt(jQuerythis.css("max-width")),"mCS_maxWidth_Interval":setInterval(function(){if(parseInt(jQuerythis.css("width"))>jQuerythis.data("mCS_maxWidth")){clearInterval(jQuerythis.data("mCS_maxWidth_Interval"));jQuerythis.mCustomScrollbar("update");}},150)});}}else{if(jQuerythis.css("max-height")!=="none"){jQuerythis.data({"mCS_maxHeight":parseInt(jQuerythis.css("max-height")),"mCS_maxHeight_Interval":setInterval(function(){mCustomScrollBox.css("max-height",jQuerythis.data("mCS_maxHeight"));if(parseInt(jQuerythis.css("height"))>jQuerythis.data("mCS_maxHeight")){clearInterval(jQuerythis.data("mCS_maxHeight_Interval"));jQuerythis.mCustomScrollbar("update");}},150)});}}
if(options.advanced.updateOnBrowserResize){var mCSB_resizeTimeout;jQuery(window).resize(function(){if(mCSB_resizeTimeout){clearTimeout(mCSB_resizeTimeout);}
mCSB_resizeTimeout=setTimeout(function(){if(!jQuerythis.is(".mCS_disabled")&&!jQuerythis.is(".mCS_destroyed")){jQuerythis.mCustomScrollbar("update");}},150);});}
if(options.advanced.updateOnContentResize){var mCSB_onContentResize;if(options.horizontalScroll){var mCSB_containerOldSize=mCSB_container.outerWidth();}else{var mCSB_containerOldSize=mCSB_container.outerHeight();}
mCSB_onContentResize=setInterval(function(){if(options.horizontalScroll){if(options.advanced.autoExpandHorizontalScroll){mCSB_container.css({"position":"absolute","width":"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({"width":mCSB_container.outerWidth(),"position":"relative"}).unwrap();}
var mCSB_containerNewSize=mCSB_container.outerWidth();}else{var mCSB_containerNewSize=mCSB_container.outerHeight();}
if(mCSB_containerNewSize!=mCSB_containerOldSize){jQuerythis.mCustomScrollbar("update");mCSB_containerOldSize=mCSB_containerNewSize;}},300);}});},update:function(){var jQuerythis=jQuery(this),mCustomScrollBox=jQuerythis.children(".mCustomScrollBox"),mCSB_container=mCustomScrollBox.children(".mCSB_container");mCSB_container.removeClass("mCS_no_scrollbar");jQuerythis.removeClass("mCS_disabled mCS_destroyed");mCustomScrollBox.scrollTop(0).scrollLeft(0);var mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),mCSB_draggerContainer=mCSB_scrollTools.children(".mCSB_draggerContainer"),mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger");if(jQuerythis.data("horizontalScroll")){var mCSB_buttonLeft=mCSB_scrollTools.children(".mCSB_buttonLeft"),mCSB_buttonRight=mCSB_scrollTools.children(".mCSB_buttonRight"),mCustomScrollBoxW=mCustomScrollBox.width();if(jQuerythis.data("autoExpandHorizontalScroll")){mCSB_container.css({"position":"absolute","width":"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({"width":mCSB_container.outerWidth(),"position":"relative"}).unwrap();}
var mCSB_containerW=mCSB_container.outerWidth();}else{var mCSB_buttonUp=mCSB_scrollTools.children(".mCSB_buttonUp"),mCSB_buttonDown=mCSB_scrollTools.children(".mCSB_buttonDown"),mCustomScrollBoxH=mCustomScrollBox.height(),mCSB_containerH=mCSB_container.outerHeight();}
if(mCSB_containerH>mCustomScrollBoxH&&!jQuerythis.data("horizontalScroll")){mCSB_scrollTools.css("display","block");var mCSB_draggerContainerH=mCSB_draggerContainer.height();if(jQuerythis.data("autoDraggerLength")){var draggerH=Math.round(mCustomScrollBoxH/mCSB_containerH*mCSB_draggerContainerH),minDraggerH=mCSB_dragger.data("minDraggerHeight");if(draggerH<=minDraggerH){mCSB_dragger.css({"height":minDraggerH});}else if(draggerH>=mCSB_draggerContainerH-10){var mCSB_draggerContainerMaxH=mCSB_draggerContainerH-10;mCSB_dragger.css({"height":mCSB_draggerContainerMaxH});}else{mCSB_dragger.css({"height":draggerH});}
mCSB_dragger.children(".mCSB_dragger_bar").css({"line-height":mCSB_dragger.height()+"px"});}
var mCSB_draggerH=mCSB_dragger.height(),scrollAmount=(mCSB_containerH-mCustomScrollBoxH)/(mCSB_draggerContainerH-mCSB_draggerH);jQuerythis.data("scrollAmount",scrollAmount).mCustomScrollbar("scrolling",mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight);var mCSB_containerP=Math.abs(Math.round(mCSB_container.position().top));jQuerythis.mCustomScrollbar("scrollTo",mCSB_containerP,{callback:false});}else if(mCSB_containerW>mCustomScrollBoxW&&jQuerythis.data("horizontalScroll")){mCSB_scrollTools.css("display","block");var mCSB_draggerContainerW=mCSB_draggerContainer.width();if(jQuerythis.data("autoDraggerLength")){var draggerW=Math.round(mCustomScrollBoxW/mCSB_containerW*mCSB_draggerContainerW),minDraggerW=mCSB_dragger.data("minDraggerWidth");if(draggerW<=minDraggerW){mCSB_dragger.css({"width":minDraggerW});}else if(draggerW>=mCSB_draggerContainerW-10){var mCSB_draggerContainerMaxW=mCSB_draggerContainerW-10;mCSB_dragger.css({"width":mCSB_draggerContainerMaxW});}else{mCSB_dragger.css({"width":draggerW});}}
var mCSB_draggerW=mCSB_dragger.width(),scrollAmount=(mCSB_containerW-mCustomScrollBoxW)/(mCSB_draggerContainerW-mCSB_draggerW);jQuerythis.data("scrollAmount",scrollAmount).mCustomScrollbar("scrolling",mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight);var mCSB_containerP=Math.abs(Math.round(mCSB_container.position().left));jQuerythis.mCustomScrollbar("scrollTo",mCSB_containerP,{callback:false});}else{mCustomScrollBox.unbind("mousewheel focusin");if(jQuerythis.data("horizontalScroll")){mCSB_dragger.add(mCSB_container).css("left",0);}else{mCSB_dragger.add(mCSB_container).css("top",0);}
mCSB_scrollTools.css("display","none");mCSB_container.addClass("mCS_no_scrollbar");jQuerythis.data({"bindEvent_mousewheel":false,"bindEvent_focusin":false});}},scrolling:function(mCustomScrollBox,mCSB_container,mCSB_draggerContainer,mCSB_dragger,mCSB_buttonUp,mCSB_buttonDown,mCSB_buttonLeft,mCSB_buttonRight){var jQuerythis=jQuery(this);jQuerythis.mCustomScrollbar("callbacks","whileScrolling");if(!mCSB_dragger.hasClass("ui-draggable")){if(jQuerythis.data("horizontalScroll")){var draggableAxis="x";}else{var draggableAxis="y";}
mCSB_dragger.draggable({axis:draggableAxis,containment:"parent",drag:function(event,ui){jQuerythis.mCustomScrollbar("scroll");mCSB_dragger.addClass("mCSB_dragger_onDrag");},stop:function(event,ui){mCSB_dragger.removeClass("mCSB_dragger_onDrag");}});}
if(!jQuerythis.data("bindEvent_scrollbar_click")){mCSB_draggerContainer.bind("click",function(e){if(jQuerythis.data("horizontalScroll")){var mouseCoord=(e.pageX-mCSB_draggerContainer.offset().left);if(mouseCoord<mCSB_dragger.position().left||mouseCoord>(mCSB_dragger.position().left+mCSB_dragger.width())){var scrollToPos=mouseCoord;if(scrollToPos>=mCSB_draggerContainer.width()-mCSB_dragger.width()){scrollToPos=mCSB_draggerContainer.width()-mCSB_dragger.width();}
mCSB_dragger.css("left",scrollToPos);jQuerythis.mCustomScrollbar("scroll");}}else{var mouseCoord=(e.pageY-mCSB_draggerContainer.offset().top);if(mouseCoord<mCSB_dragger.position().top||mouseCoord>(mCSB_dragger.position().top+mCSB_dragger.height())){var scrollToPos=mouseCoord;if(scrollToPos>=mCSB_draggerContainer.height()-mCSB_dragger.height()){scrollToPos=mCSB_draggerContainer.height()-mCSB_dragger.height();}
mCSB_dragger.css("top",scrollToPos);jQuerythis.mCustomScrollbar("scroll");}}});jQuerythis.data({"bindEvent_scrollbar_click":true});}
if(jQuerythis.data("mouseWheel")){var mousewheelVel=jQuerythis.data("mouseWheel");if(jQuerythis.data("mouseWheel")==="auto"){mousewheelVel=8;var os=navigator.userAgent;if(os.indexOf("Mac")!=-1&&os.indexOf("Safari")!=-1&&os.indexOf("AppleWebKit")!=-1&&os.indexOf("Chrome")==-1){mousewheelVel=1;}}
if(!jQuerythis.data("bindEvent_mousewheel")){mCustomScrollBox.bind("mousewheel",function(event,delta){event.preventDefault();var vel=Math.abs(delta*mousewheelVel);if(jQuerythis.data("horizontalScroll")){if(jQuerythis.data("mouseWheel")==="pixels"){if(delta<0){delta=-1;}else{delta=1;}
var scrollTo=Math.abs(Math.round(mCSB_container.position().left))-(delta*jQuerythis.data("mouseWheelPixels"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo);}else{var posX=mCSB_dragger.position().left-(delta*vel);mCSB_dragger.css("left",posX);if(mCSB_dragger.position().left<0){mCSB_dragger.css("left",0);}
var mCSB_draggerContainerW=mCSB_draggerContainer.width(),mCSB_draggerW=mCSB_dragger.width();if(mCSB_dragger.position().left>mCSB_draggerContainerW-mCSB_draggerW){mCSB_dragger.css("left",mCSB_draggerContainerW-mCSB_draggerW);}
jQuerythis.mCustomScrollbar("scroll");}}else{if(jQuerythis.data("mouseWheel")==="pixels"){if(delta<0){delta=-1;}else{delta=1;}
var scrollTo=Math.abs(Math.round(mCSB_container.position().top))-(delta*jQuerythis.data("mouseWheelPixels"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo);}else{var posY=mCSB_dragger.position().top-(delta*vel);mCSB_dragger.css("top",posY);if(mCSB_dragger.position().top<0){mCSB_dragger.css("top",0);}
var mCSB_draggerContainerH=mCSB_draggerContainer.height(),mCSB_draggerH=mCSB_dragger.height();if(mCSB_dragger.position().top>mCSB_draggerContainerH-mCSB_draggerH){mCSB_dragger.css("top",mCSB_draggerContainerH-mCSB_draggerH);}
jQuerythis.mCustomScrollbar("scroll");}}});jQuerythis.data({"bindEvent_mousewheel":true});}}
if(jQuerythis.data("scrollButtons_enable")){if(jQuerythis.data("scrollButtons_scrollType")==="pixels"){var pixelsScrollTo;if(jQuery.browser.msie&&parseInt(jQuery.browser.version)<9){jQuerythis.data("scrollInertia",0);}
if(jQuerythis.data("horizontalScroll")){mCSB_buttonRight.add(mCSB_buttonLeft).unbind("mousedown touchstart onmsgesturestart mouseup mouseout touchend onmsgestureend",mCSB_buttonRight_stop,mCSB_buttonLeft_stop);jQuerythis.data({"bindEvent_buttonsContinuous_x":false});if(!jQuerythis.data("bindEvent_buttonsPixels_x")){mCSB_buttonRight.bind("click",function(e){e.preventDefault();if(!mCSB_container.is(":animated")){pixelsScrollTo=Math.abs(mCSB_container.position().left)+jQuerythis.data("scrollButtons_scrollAmount");jQuerythis.mCustomScrollbar("scrollTo",pixelsScrollTo);}});mCSB_buttonLeft.bind("click",function(e){e.preventDefault();if(!mCSB_container.is(":animated")){pixelsScrollTo=Math.abs(mCSB_container.position().left)-jQuerythis.data("scrollButtons_scrollAmount");if(mCSB_container.position().left>=-jQuerythis.data("scrollButtons_scrollAmount")){pixelsScrollTo="left";}
jQuerythis.mCustomScrollbar("scrollTo",pixelsScrollTo);}});jQuerythis.data({"bindEvent_buttonsPixels_x":true});}}else{mCSB_buttonDown.add(mCSB_buttonUp).unbind("mousedown touchstart onmsgesturestart mouseup mouseout touchend onmsgestureend",mCSB_buttonRight_stop,mCSB_buttonLeft_stop);jQuerythis.data({"bindEvent_buttonsContinuous_y":false});if(!jQuerythis.data("bindEvent_buttonsPixels_y")){mCSB_buttonDown.bind("click",function(e){e.preventDefault();if(!mCSB_container.is(":animated")){pixelsScrollTo=Math.abs(mCSB_container.position().top)+jQuerythis.data("scrollButtons_scrollAmount");jQuerythis.mCustomScrollbar("scrollTo",pixelsScrollTo);}});mCSB_buttonUp.bind("click",function(e){e.preventDefault();if(!mCSB_container.is(":animated")){pixelsScrollTo=Math.abs(mCSB_container.position().top)-jQuerythis.data("scrollButtons_scrollAmount");if(mCSB_container.position().top>=-jQuerythis.data("scrollButtons_scrollAmount")){pixelsScrollTo="top";}
jQuerythis.mCustomScrollbar("scrollTo",pixelsScrollTo);}});jQuerythis.data({"bindEvent_buttonsPixels_y":true});}}}else{if(jQuerythis.data("horizontalScroll")){mCSB_buttonRight.add(mCSB_buttonLeft).unbind("click");jQuerythis.data({"bindEvent_buttonsPixels_x":false});if(!jQuerythis.data("bindEvent_buttonsContinuous_x")){mCSB_buttonRight.bind("mousedown touchstart onmsgesturestart",function(e){e.preventDefault();e.stopPropagation();jQuerythis.data({"mCSB_buttonScrollRight":setInterval(function(){var scrollTo=Math.round((Math.abs(Math.round(mCSB_container.position().left))+jQuerythis.data("scrollButtons_scrollSpeed"))/jQuerythis.data("scrollAmount"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo,{moveDragger:true});},30)});});var mCSB_buttonRight_stop=function(e){e.preventDefault();e.stopPropagation();clearInterval(jQuerythis.data("mCSB_buttonScrollRight"));}
mCSB_buttonRight.bind("mouseup touchend onmsgestureend mouseout",mCSB_buttonRight_stop);mCSB_buttonLeft.bind("mousedown touchstart onmsgesturestart",function(e){e.preventDefault();e.stopPropagation();jQuerythis.data({"mCSB_buttonScrollLeft":setInterval(function(){var scrollTo=Math.round((Math.abs(Math.round(mCSB_container.position().left))-jQuerythis.data("scrollButtons_scrollSpeed"))/jQuerythis.data("scrollAmount"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo,{moveDragger:true});},30)});});var mCSB_buttonLeft_stop=function(e){e.preventDefault();e.stopPropagation();clearInterval(jQuerythis.data("mCSB_buttonScrollLeft"));}
mCSB_buttonLeft.bind("mouseup touchend onmsgestureend mouseout",mCSB_buttonLeft_stop);jQuerythis.data({"bindEvent_buttonsContinuous_x":true});}}else{mCSB_buttonDown.add(mCSB_buttonUp).unbind("click");jQuerythis.data({"bindEvent_buttonsPixels_y":false});if(!jQuerythis.data("bindEvent_buttonsContinuous_y")){mCSB_buttonDown.bind("mousedown touchstart onmsgesturestart",function(e){e.preventDefault();e.stopPropagation();jQuerythis.data({"mCSB_buttonScrollDown":setInterval(function(){var scrollTo=Math.round((Math.abs(Math.round(mCSB_container.position().top))+jQuerythis.data("scrollButtons_scrollSpeed"))/jQuerythis.data("scrollAmount"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo,{moveDragger:true});},30)});});var mCSB_buttonDown_stop=function(e){e.preventDefault();e.stopPropagation();clearInterval(jQuerythis.data("mCSB_buttonScrollDown"));}
mCSB_buttonDown.bind("mouseup touchend onmsgestureend mouseout",mCSB_buttonDown_stop);mCSB_buttonUp.bind("mousedown touchstart onmsgesturestart",function(e){e.preventDefault();e.stopPropagation();jQuerythis.data({"mCSB_buttonScrollUp":setInterval(function(){var scrollTo=Math.round((Math.abs(Math.round(mCSB_container.position().top))-jQuerythis.data("scrollButtons_scrollSpeed"))/jQuerythis.data("scrollAmount"));jQuerythis.mCustomScrollbar("scrollTo",scrollTo,{moveDragger:true});},30)});});var mCSB_buttonUp_stop=function(e){e.preventDefault();e.stopPropagation();clearInterval(jQuerythis.data("mCSB_buttonScrollUp"));}
mCSB_buttonUp.bind("mouseup touchend onmsgestureend mouseout",mCSB_buttonUp_stop);jQuerythis.data({"bindEvent_buttonsContinuous_y":true});}}}}
if(jQuerythis.data("autoScrollOnFocus")){if(!jQuerythis.data("bindEvent_focusin")){mCustomScrollBox.bind("focusin",function(){mCustomScrollBox.scrollTop(0).scrollLeft(0);var focusedElem=jQuery(document.activeElement);if(focusedElem.is("input,textarea,select,button,a[tabindex],area,object")){if(jQuerythis.data("horizontalScroll")){var mCSB_containerX=mCSB_container.position().left,focusedElemX=focusedElem.position().left,mCustomScrollBoxW=mCustomScrollBox.width(),focusedElemW=focusedElem.outerWidth();if(mCSB_containerX+focusedElemX>=0&&mCSB_containerX+focusedElemX<=mCustomScrollBoxW-focusedElemW){}else{var moveDragger=focusedElemX/jQuerythis.data("scrollAmount");if(moveDragger>=mCSB_draggerContainer.width()-mCSB_dragger.width()){moveDragger=mCSB_draggerContainer.width()-mCSB_dragger.width();}
mCSB_dragger.css("left",moveDragger);jQuerythis.mCustomScrollbar("scroll");}}else{var mCSB_containerY=mCSB_container.position().top,focusedElemY=focusedElem.position().top,mCustomScrollBoxH=mCustomScrollBox.height(),focusedElemH=focusedElem.outerHeight();if(mCSB_containerY+focusedElemY>=0&&mCSB_containerY+focusedElemY<=mCustomScrollBoxH-focusedElemH){}else{var moveDragger=focusedElemY/jQuerythis.data("scrollAmount");if(moveDragger>=mCSB_draggerContainer.height()-mCSB_dragger.height()){moveDragger=mCSB_draggerContainer.height()-mCSB_dragger.height();}
mCSB_dragger.css("top",moveDragger);jQuerythis.mCustomScrollbar("scroll");}}}});jQuerythis.data({"bindEvent_focusin":true});}}
if(jQuery(document).data("mCS-is-touch-device")){if(!jQuerythis.data("bindEvent_scrollbar_touch")){var mCSB_draggerTouchY,mCSB_draggerTouchX;mCSB_dragger.bind("touchstart onmsgesturestart",function(e){e.preventDefault();e.stopPropagation();var touch=e.originalEvent.touches[0]||e.originalEvent.changedTouches[0],elem=jQuery(this),elemOffset=elem.offset(),x=touch.pageX-elemOffset.left,y=touch.pageY-elemOffset.top;if(x<elem.width()&&x>0&&y<elem.height()&&y>0){mCSB_draggerTouchY=y;mCSB_draggerTouchX=x;}});mCSB_dragger.bind("touchmove onmsgesturechange",function(e){e.preventDefault();e.stopPropagation();var touch=e.originalEvent.touches[0]||e.originalEvent.changedTouches[0],elem=jQuery(this),elemOffset=elem.offset(),x=touch.pageX-elemOffset.left,y=touch.pageY-elemOffset.top;if(jQuerythis.data("horizontalScroll")){jQuerythis.mCustomScrollbar("scrollTo",(mCSB_dragger.position().left-(mCSB_draggerTouchX))+x,{moveDragger:true});}else{jQuerythis.mCustomScrollbar("scrollTo",(mCSB_dragger.position().top-(mCSB_draggerTouchY))+y,{moveDragger:true});}});jQuerythis.data({"bindEvent_scrollbar_touch":true});}
if(!jQuerythis.data("bindEvent_content_touch")){var touch,elem,elemOffset,x,y,mCSB_containerTouchY,mCSB_containerTouchX;mCSB_container.bind("touchstart onmsgesturestart",function(e){touch=e.originalEvent.touches[0]||e.originalEvent.changedTouches[0];elem=jQuery(this);elemOffset=elem.offset();x=touch.pageX-elemOffset.left;y=touch.pageY-elemOffset.top;mCSB_containerTouchY=y;mCSB_containerTouchX=x;});mCSB_container.bind("touchmove onmsgesturechange",function(e){e.preventDefault();e.stopPropagation();touch=e.originalEvent.touches[0]||e.originalEvent.changedTouches[0];elem=jQuery(this).parent();elemOffset=elem.offset();x=touch.pageX-elemOffset.left;y=touch.pageY-elemOffset.top;if(jQuerythis.data("horizontalScroll")){jQuerythis.mCustomScrollbar("scrollTo",mCSB_containerTouchX-x);}else{jQuerythis.mCustomScrollbar("scrollTo",mCSB_containerTouchY-y);}});jQuerythis.data({"bindEvent_content_touch":true});}}},scroll:function(bypassCallbacks){var jQuerythis=jQuery(this),mCSB_dragger=jQuerythis.find(".mCSB_dragger"),mCSB_container=jQuerythis.find(".mCSB_container"),mCustomScrollBox=jQuerythis.find(".mCustomScrollBox");if(jQuerythis.data("horizontalScroll")){var draggerX=mCSB_dragger.position().left,targX=-draggerX*jQuerythis.data("scrollAmount"),thisX=mCSB_container.position().left,posX=Math.round(thisX-targX);}else{var draggerY=mCSB_dragger.position().top,targY=-draggerY*jQuerythis.data("scrollAmount"),thisY=mCSB_container.position().top,posY=Math.round(thisY-targY);}
if(jQuery.browser.webkit){var screenCssPixelRatio=(window.outerWidth-8)/window.innerWidth,isZoomed=(screenCssPixelRatio<.98||screenCssPixelRatio>1.02);}
if(jQuerythis.data("scrollInertia")===0||isZoomed){if(!bypassCallbacks){jQuerythis.mCustomScrollbar("callbacks","onScrollStart");}
if(jQuerythis.data("horizontalScroll")){mCSB_container.css("left",targX);}else{mCSB_container.css("top",targY);}
if(!bypassCallbacks){if(jQuerythis.data("whileScrolling")){jQuerythis.data("whileScrolling_Callback").call();}
jQuerythis.mCustomScrollbar("callbacks","onScroll");}
jQuerythis.data({"mCS_Init":false});}else{if(!bypassCallbacks){jQuerythis.mCustomScrollbar("callbacks","onScrollStart");}
if(jQuerythis.data("horizontalScroll")){mCSB_container.stop().animate({left:"-="+posX},jQuerythis.data("scrollInertia"),jQuerythis.data("scrollEasing"),function(){if(!bypassCallbacks){jQuerythis.mCustomScrollbar("callbacks","onScroll");}
jQuerythis.data({"mCS_Init":false});});}else{mCSB_container.stop().animate({top:"-="+posY},jQuerythis.data("scrollInertia"),jQuerythis.data("scrollEasing"),function(){if(!bypassCallbacks){jQuerythis.mCustomScrollbar("callbacks","onScroll");}
jQuerythis.data({"mCS_Init":false});});}}},scrollTo:function(scrollTo,options){var defaults={moveDragger:false,callback:true},options=jQuery.extend(defaults,options),jQuerythis=jQuery(this),scrollToPos,mCustomScrollBox=jQuerythis.find(".mCustomScrollBox"),mCSB_container=mCustomScrollBox.children(".mCSB_container"),mCSB_draggerContainer=jQuerythis.find(".mCSB_draggerContainer"),mCSB_dragger=mCSB_draggerContainer.children(".mCSB_dragger"),targetPos;if(scrollTo||scrollTo===0){if(typeof(scrollTo)==="number"){if(options.moveDragger){scrollToPos=scrollTo;}else{targetPos=scrollTo;scrollToPos=Math.round(targetPos/jQuerythis.data("scrollAmount"));}}else if(typeof(scrollTo)==="string"){var target;if(scrollTo==="top"){target=0;}else if(scrollTo==="bottom"&&!jQuerythis.data("horizontalScroll")){target=mCSB_container.outerHeight()-mCustomScrollBox.height();}else if(scrollTo==="left"){target=0;}else if(scrollTo==="right"&&jQuerythis.data("horizontalScroll")){target=mCSB_container.outerWidth()-mCustomScrollBox.width();}else if(scrollTo==="first"){target=jQuerythis.find(".mCSB_container").find(":first");}else if(scrollTo==="last"){target=jQuerythis.find(".mCSB_container").find(":last");}else{target=jQuerythis.find(scrollTo);}
if(target.length===1){if(jQuerythis.data("horizontalScroll")){targetPos=target.position().left;}else{targetPos=target.position().top;}
scrollToPos=Math.ceil(targetPos/jQuerythis.data("scrollAmount"));}else{scrollToPos=target;}}
if(scrollToPos<0){scrollToPos=0;}
if(jQuerythis.data("horizontalScroll")){if(scrollToPos>=mCSB_draggerContainer.width()-mCSB_dragger.width()){scrollToPos=mCSB_draggerContainer.width()-mCSB_dragger.width();}
mCSB_dragger.css("left",scrollToPos);}else{if(scrollToPos>=mCSB_draggerContainer.height()-mCSB_dragger.height()){scrollToPos=mCSB_draggerContainer.height()-mCSB_dragger.height();}
mCSB_dragger.css("top",scrollToPos);}
if(options.callback){jQuerythis.mCustomScrollbar("scroll",false);}else{jQuerythis.mCustomScrollbar("scroll",true);}}},callbacks:function(callback){var jQuerythis=jQuery(this),mCustomScrollBox=jQuerythis.find(".mCustomScrollBox"),mCSB_container=jQuerythis.find(".mCSB_container");switch(callback){case"onScrollStart":if(!mCSB_container.is(":animated")){jQuerythis.data("onScrollStart_Callback").call();}
break;case"onScroll":if(jQuerythis.data("horizontalScroll")){var mCSB_containerX=Math.round(mCSB_container.position().left);if(mCSB_containerX<0&&mCSB_containerX<=mCustomScrollBox.width()-mCSB_container.outerWidth()+jQuerythis.data("onTotalScroll_Offset")){jQuerythis.data("onTotalScroll_Callback").call();}else if(mCSB_containerX>=-jQuerythis.data("onTotalScroll_Offset")){jQuerythis.data("onTotalScrollBack_Callback").call();}else{jQuerythis.data("onScroll_Callback").call();}}else{var mCSB_containerY=Math.round(mCSB_container.position().top);if(mCSB_containerY<0&&mCSB_containerY<=mCustomScrollBox.height()-mCSB_container.outerHeight()+jQuerythis.data("onTotalScroll_Offset")){jQuerythis.data("onTotalScroll_Callback").call();}else if(mCSB_containerY>=-jQuerythis.data("onTotalScroll_Offset")){jQuerythis.data("onTotalScrollBack_Callback").call();}else{jQuerythis.data("onScroll_Callback").call();}}
break;case"whileScrolling":if(jQuerythis.data("whileScrolling_Callback")&&!jQuerythis.data("whileScrolling")){jQuerythis.data({"whileScrolling":setInterval(function(){if(mCSB_container.is(":animated")&&!jQuerythis.data("mCS_Init")){jQuerythis.data("whileScrolling_Callback").call();}},jQuerythis.data("whileScrolling_Interval"))});}
break;}},disable:function(resetScroll){var jQuerythis=jQuery(this),mCustomScrollBox=jQuerythis.children(".mCustomScrollBox"),mCSB_container=mCustomScrollBox.children(".mCSB_container"),mCSB_scrollTools=mCustomScrollBox.children(".mCSB_scrollTools"),mCSB_dragger=mCSB_scrollTools.find(".mCSB_dragger");mCustomScrollBox.unbind("mousewheel focusin");if(resetScroll){if(jQuerythis.data("horizontalScroll")){mCSB_dragger.add(mCSB_container).css("left",0);}else{mCSB_dragger.add(mCSB_container).css("top",0);}}
mCSB_scrollTools.css("display","none");mCSB_container.addClass("mCS_no_scrollbar");jQuerythis.data({"bindEvent_mousewheel":false,"bindEvent_focusin":false}).addClass("mCS_disabled");},destroy:function(){var jQuerythis=jQuery(this),content=jQuerythis.find(".mCSB_container").html();jQuerythis.find(".mCustomScrollBox").remove();jQuerythis.html(content).removeClass("mCustomScrollbar _mCS_"+jQuery(document).data("mCustomScrollbar-index")).addClass("mCS_destroyed");}}
jQuery.fn.mCustomScrollbar=function(method){if(methods[method]){return methods[method].apply(this,Array.prototype.slice.call(arguments,1));}else if(typeof method==="object"||!method){return methods.init.apply(this,arguments);}else{jQuery.error("Method "+method+" does not exist");}};
/*iOS 6 bug fix 
  iOS 6 suffers from a bug that kills timers that are created while a page is scrolling. 
  The following fixes that problem by recreating timers after scrolling finishes (with interval correction).*/
var iOSVersion=iOSVersion();
if(iOSVersion>=6){
	(function(h){var a={};var d={};var e=h.setTimeout;var f=h.setInterval;var i=h.clearTimeout;var c=h.clearInterval;if(!h.addEventListener){return false}function j(q,n,l){var p,k=l[0],m=(q===f);function o(){if(k){k.apply(h,arguments);if(!m){delete n[p];k=null}}}l[0]=o;p=q.apply(h,l);n[p]={args:l,created:Date.now(),cb:k,id:p};return p}function b(q,o,k,r,t){var l=k[r];if(!l){return}var m=(q===f);o(l.id);if(!m){var n=l.args[1];var p=Date.now()-l.created;if(p<0){p=0}n-=p;if(n<0){n=0}l.args[1]=n}function s(){if(l.cb){l.cb.apply(h,arguments);if(!m){delete k[r];l.cb=null}}}l.args[0]=s;l.created=Date.now();l.id=q.apply(h,l.args)}h.setTimeout=function(){return j(e,a,arguments)};h.setInterval=function(){return j(f,d,arguments)};h.clearTimeout=function(l){var k=a[l];if(k){delete a[l];i(k.id)}};h.clearInterval=function(l){var k=d[l];if(k){delete d[l];c(k.id)}};var g=h;while(g.location!=g.parent.location){g=g.parent}g.addEventListener("scroll",function(){var k;for(k in a){b(e,i,a,k)}for(k in d){b(f,c,d,k)}})}(window));
}
function iOSVersion(){
	var agent=window.navigator.userAgent,
		start=agent.indexOf('OS ');
	if((agent.indexOf('iPhone')>-1 || agent.indexOf('iPad')>-1) && start>-1){
		return window.Number(agent.substr(start+3,3).replace('_','.'));
	}
	return 0;
}

/*!
  jQuery blockUI plugin
  Version 2.53 (01-NOV-2012)
  @requires jQuery v1.3 or later
 
  Examples at: http://malsup.com/jquery/block/
  Copyright (c) 2007-2012 M. Alsup
  Dual licensed under the MIT and GPL licenses:
  http://www.opensource.org/licenses/mit-license.php
  http://www.gnu.org/licenses/gpl.html
 
  Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */;(function(){"use strict";function setup($){if(/^1\.(0|1|2)/.test($.fn.jquery)){alert('blockUI requires jQuery v1.3 or later!  You are using v'+$.fn.jquery);return;}
$.fn._fadeIn=$.fn.fadeIn;var noOp=$.noop||function(){};var msie=/MSIE/.test(navigator.userAgent);var ie6=/MSIE 6.0/.test(navigator.userAgent);var mode=document.documentMode||0;var setExpr=$.isFunction(document.createElement('div').style.setExpression);$.blockUI=function(opts){install(window,opts);};$.unblockUI=function(opts){remove(window,opts);};$.growlUI=function(title,message,timeout,onClose){var $m=$('<div class="growlUI"></div>');if(title)$m.append('<h1>'+title+'</h1>');if(message)$m.append('<h2>'+message+'</h2>');if(timeout===undefined)timeout=3000;$.blockUI({message:$m,fadeIn:700,fadeOut:1000,centerY:false,timeout:timeout,showOverlay:false,onUnblock:onClose,css:$.blockUI.defaults.growlCSS});};$.fn.block=function(opts){var fullOpts=$.extend({},$.blockUI.defaults,opts||{});this.each(function(){var $el=$(this);if(fullOpts.ignoreIfBlocked&&$el.data('blockUI.isBlocked'))
return;$el.unblock({fadeOut:0});});return this.each(function(){if($.css(this,'position')=='static')
this.style.position='relative';this.style.zoom=1;install(this,opts);});};$.fn.unblock=function(opts){return this.each(function(){remove(this,opts);});};$.blockUI.version=2.53;$.blockUI.defaults={message:'<h1>Please wait...</h1>',title:null,draggable:true,theme:false,css:{padding:0,margin:0,width:'70%',top:'40%',left:'35%',textAlign:'center',color:'#000',border:'3px solid #aaa',backgroundColor:'#fff',cursor:'wait'},themedCSS:{width:'30%',top:'40%',left:'35%'},overlayCSS:{backgroundColor:'#000',opacity:0.6,cursor:'wait'},cursorReset:'default',growlCSS:{width:'350px',top:'10px',left:'',right:'10px',border:'none',padding:'5px',opacity:0.6,cursor:'default',color:'#fff',backgroundColor:'#000','-webkit-border-radius':'10px','-moz-border-radius':'10px','border-radius':'10px'},iframeSrc:/^https/i.test(window.location.href||'')?'javascript:false':'about:blank',forceIframe:false,baseZ:1000,centerX:true,centerY:true,allowBodyStretch:true,bindEvents:true,constrainTabKey:true,fadeIn:200,fadeOut:400,timeout:0,showOverlay:true,focusInput:true,onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:'blockMsg',ignoreIfBlocked:false};var pageBlock=null;var pageBlockEls=[];function install(el,opts){var css,themedCSS;var full=(el==window);var msg=(opts&&opts.message!==undefined?opts.message:undefined);opts=$.extend({},$.blockUI.defaults,opts||{});if(opts.ignoreIfBlocked&&$(el).data('blockUI.isBlocked'))
return;opts.overlayCSS=$.extend({},$.blockUI.defaults.overlayCSS,opts.overlayCSS||{});css=$.extend({},$.blockUI.defaults.css,opts.css||{});if(opts.onOverlayClick)
opts.overlayCSS.cursor='pointer';themedCSS=$.extend({},$.blockUI.defaults.themedCSS,opts.themedCSS||{});msg=msg===undefined?opts.message:msg;if(full&&pageBlock)
remove(window,{fadeOut:0});if(msg&&typeof msg!='string'&&(msg.parentNode||msg.jquery)){var node=msg.jquery?msg[0]:msg;var data={};$(el).data('blockUI.history',data);data.el=node;data.parent=node.parentNode;data.display=node.style.display;data.position=node.style.position;if(data.parent)
data.parent.removeChild(node);}
$(el).data('blockUI.onUnblock',opts.onUnblock);var z=opts.baseZ;var lyr1,lyr2,lyr3,s;if(msie||opts.forceIframe)
lyr1=$('<iframe class="blockUI" style="z-index:'+(z++)+';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+opts.iframeSrc+'"></iframe>');else
lyr1=$('<div class="blockUI" style="display:none"></div>');if(opts.theme)
lyr2=$('<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+(z++)+';display:none"></div>');else
lyr2=$('<div class="blockUI blockOverlay" style="z-index:'+(z++)+';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>');if(opts.theme&&full){s='<div class="blockUI '+opts.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(z+10)+';display:none;position:fixed">';if(opts.title){s+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(opts.title||'&nbsp;')+'</div>';}
s+='<div class="ui-widget-content ui-dialog-content"></div>';s+='</div>';}
else if(opts.theme){s='<div class="blockUI '+opts.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(z+10)+';display:none;position:absolute">';if(opts.title){s+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(opts.title||'&nbsp;')+'</div>';}
s+='<div class="ui-widget-content ui-dialog-content"></div>';s+='</div>';}
else if(full){s='<div class="blockUI '+opts.blockMsgClass+' blockPage" style="z-index:'+(z+10)+';display:none;position:fixed"></div>';}
else{s='<div class="blockUI '+opts.blockMsgClass+' blockElement" style="z-index:'+(z+10)+';display:none;position:absolute"></div>';}
lyr3=$(s);if(msg){if(opts.theme){lyr3.css(themedCSS);lyr3.addClass('ui-widget-content');}
else
lyr3.css(css);}
if(!opts.theme)
lyr2.css(opts.overlayCSS);lyr2.css('position',full?'fixed':'absolute');if(msie||opts.forceIframe)
lyr1.css('opacity',0.0);var layers=[lyr1,lyr2,lyr3],$par=full?$('body'):$(el);$.each(layers,function(){this.appendTo($par);});if(opts.theme&&opts.draggable&&$.fn.draggable){lyr3.draggable({handle:'.ui-dialog-titlebar',cancel:'li'});}
var expr=setExpr&&(!$.support.boxModel||$('object,embed',full?null:el).length>0);if(ie6||expr){if(full&&opts.allowBodyStretch&&$.support.boxModel)
$('html,body').css('height','100%');if((ie6||!$.support.boxModel)&&!full){var t=sz(el,'borderTopWidth'),l=sz(el,'borderLeftWidth');var fixT=t?'(0 - '+t+')':0;var fixL=l?'(0 - '+l+')':0;}
$.each(layers,function(i,o){var s=o[0].style;s.position='absolute';if(i<2){if(full)
s.setExpression('height','Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:'+opts.quirksmodeOffsetHack+') + "px"');else
s.setExpression('height','this.parentNode.offsetHeight + "px"');if(full)
s.setExpression('width','jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"');else
s.setExpression('width','this.parentNode.offsetWidth + "px"');if(fixL)s.setExpression('left',fixL);if(fixT)s.setExpression('top',fixT);}
else if(opts.centerY){if(full)s.setExpression('top','(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"');s.marginTop=0;}
else if(!opts.centerY&&full){var top=(opts.css&&opts.css.top)?parseInt(opts.css.top,10):0;var expression='((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + '+top+') + "px"';s.setExpression('top',expression);}});}
if(msg){if(opts.theme)
lyr3.find('.ui-widget-content').append(msg);else
lyr3.append(msg);if(msg.jquery||msg.nodeType)
$(msg).show();}
if((msie||opts.forceIframe)&&opts.showOverlay)
lyr1.show();if(opts.fadeIn){var cb=opts.onBlock?opts.onBlock:noOp;var cb1=(opts.showOverlay&&!msg)?cb:noOp;var cb2=msg?cb:noOp;if(opts.showOverlay)
lyr2._fadeIn(opts.fadeIn,cb1);if(msg)
lyr3._fadeIn(opts.fadeIn,cb2);}
else{if(opts.showOverlay)
lyr2.show();if(msg)
lyr3.show();if(opts.onBlock)
opts.onBlock();}
bind(1,el,opts);if(full){pageBlock=lyr3[0];pageBlockEls=$(':input:enabled:visible',pageBlock);if(opts.focusInput)
setTimeout(focus,20);}
else
center(lyr3[0],opts.centerX,opts.centerY);if(opts.timeout){var to=setTimeout(function(){if(full)
$.unblockUI(opts);else
$(el).unblock(opts);},opts.timeout);$(el).data('blockUI.timeout',to);}}
function remove(el,opts){var full=(el==window);var $el=$(el);var data=$el.data('blockUI.history');var to=$el.data('blockUI.timeout');if(to){clearTimeout(to);$el.removeData('blockUI.timeout');}
opts=$.extend({},$.blockUI.defaults,opts||{});bind(0,el,opts);if(opts.onUnblock===null){opts.onUnblock=$el.data('blockUI.onUnblock');$el.removeData('blockUI.onUnblock');}
var els;if(full)
els=$('body').children().filter('.blockUI').add('body > .blockUI');else
els=$el.find('>.blockUI');if(opts.cursorReset){if(els.length>1)
els[1].style.cursor=opts.cursorReset;if(els.length>2)
els[2].style.cursor=opts.cursorReset;}
if(full)
pageBlock=pageBlockEls=null;if(opts.fadeOut){els.fadeOut(opts.fadeOut);setTimeout(function(){reset(els,data,opts,el);},opts.fadeOut);}
else
reset(els,data,opts,el);}
function reset(els,data,opts,el){els.each(function(i,o){if(this.parentNode)
this.parentNode.removeChild(this);});if(data&&data.el){data.el.style.display=data.display;data.el.style.position=data.position;if(data.parent)
data.parent.appendChild(data.el);$(el).removeData('blockUI.history');}
if(typeof opts.onUnblock=='function')
opts.onUnblock(el,opts);var body=$(document.body),w=body.width(),cssW=body[0].style.width;body.width(w-1).width(w);body[0].style.width=cssW;}
function bind(b,el,opts){var full=el==window,$el=$(el);if(!b&&(full&&!pageBlock||!full&&!$el.data('blockUI.isBlocked')))
return;$el.data('blockUI.isBlocked',b);if(!opts.bindEvents||(b&&!opts.showOverlay))
return;var events='mousedown mouseup keydown keypress touchstart touchend touchmove';if(b)
$(document).bind(events,opts,handler);else
$(document).unbind(events,handler);}
function handler(e){if(e.keyCode&&e.keyCode==9){if(pageBlock&&e.data.constrainTabKey){var els=pageBlockEls;var fwd=!e.shiftKey&&e.target===els[els.length-1];var back=e.shiftKey&&e.target===els[0];if(fwd||back){setTimeout(function(){focus(back);},10);return false;}}}
var opts=e.data;var target=$(e.target);if(target.hasClass('blockOverlay')&&opts.onOverlayClick)
opts.onOverlayClick();if(target.parents('div.'+opts.blockMsgClass).length>0)
return true;return target.parents().children().filter('div.blockUI').length===0;}
function focus(back){if(!pageBlockEls)
return;var e=pageBlockEls[back===true?pageBlockEls.length-1:0];if(e)
e.focus();}
function center(el,x,y){var p=el.parentNode,s=el.style;var l=((p.offsetWidth-el.offsetWidth)/2)-sz(p,'borderLeftWidth');var t=((p.offsetHeight-el.offsetHeight)/2)-sz(p,'borderTopWidth');if(x)s.left=l>0?(l+'px'):'0';if(y)s.top=t>0?(t+'px'):'0';}
function sz(el,p){return parseInt($.css(el,p),10)||0;}}
if(typeof define==='function'&&define.amd&&define.amd.jQuery){define(['jquery'],setup);}else{setup(jQuery);}})();
/*
/*-------------------------------------------------------------------- 
 * JQuery Plugin: "EqualHeights" & "EqualWidths"
 * by:	Scott Jehl, Todd Parker, Maggie Costello Wachs (http://www.filamentgroup.com)
 *
 * Copyright (c) 2007 Filament Group
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 *
 * Description: Compares the heights or widths of the top-level children of a provided element 
 		and sets their min-height to the tallest height (or width to widest width). Sets in em units 
 		by default if pxToEm() method is available.
 * Dependencies: jQuery library, pxToEm method	(article: http://www.filamentgroup.com/lab/retaining_scalable_interfaces_with_pixel_to_em_conversion/)							  
 * Usage Example: $(element).equalHeights();
   						      Optional: to set min-height in px, pass a true argument: $(element).equalHeights(true);
 * Version: 2.0, 07.24.2008
 * Changelog:
 *  08.02.2007 initial Version 1.0
 *  07.24.2008 v 2.0 - added support for widths
--------------------------------------------------------------------*/

(function($){$.fn.equalHeights = function(px) {
	$(this).each(function(){
		var currentTallest = 0;
		$(this).children().each(function(i){
			if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
		});
    if (!px && Number.prototype.pxToEm) currentTallest = currentTallest.pxToEm(); //use ems unless px is specified
		// for ie6, set height since min-height isn't supported
		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'height': currentTallest}); }
		$(this).children().css({'min-height': currentTallest}); 
	});
	return this;
};

// just in case you need it...
$.fn.equalWidths = function(px) {
	$(this).each(function(){
		var currentWidest = 0;
		$(this).children().each(function(i){
				if($(this).width() > currentWidest) { currentWidest = $(this).width(); }
		});
		if(!px && Number.prototype.pxToEm) currentWidest = currentWidest.pxToEm(); //use ems unless px is specified
		// for ie6, set width since min-width isn't supported
		if ($.browser.msie && $.browser.version == 6.0) { $(this).children().css({'width': currentWidest}); }
		$(this).children().css({'min-width': currentWidest}); 
	});
	return this;
};})(jQuery);
/**
 * jCarouselLite - jQuery plugin to navigate images/any content in a carousel style widget.
 * @requires jQuery v1.2 or above
 *
 * http://gmarwaha.com/jquery/jcarousellite/
 */
(function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,hoverPause:false,speed:200,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:1,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var running=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var div=$(this),ul=$("ul",div),tLi=$("li",ul),tl=tLi.size(),v=o.visible;if(o.circular){ul.prepend(tLi.slice(tl-v+1).clone()).append(tLi.slice(0,o.scroll).clone());o.start+=v-1;}
var li=$("li",ul),itemLength=li.size(),curr=o.start;div.css("visibility","visible");li.css({overflow:"hidden",float:o.vertical?"none":"left"});ul.css({margin:"0",padding:"0",position:"relative","z-index":"1"});div.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var liSize=o.vertical?height(li):width(li);var ulSize=liSize*itemLength;var divSize=liSize*v;li.css({width:li.width(),height:li.height()});ul.css(sizeCss,ulSize+"px").css(animCss,-(curr*liSize));div.css(sizeCss,divSize+"px");if(o.btnPrev){$(o.btnPrev).click(function(){return go(curr-o.scroll);});if(o.hoverPause){$(o.btnPrev).hover(function(){stopAuto();},function(){startAuto();});}}
if(o.btnNext){$(o.btnNext).click(function(){return go(curr+o.scroll);});if(o.hoverPause){$(o.btnNext).hover(function(){stopAuto();},function(){startAuto();});}}
if(o.btnGo)
$.each(o.btnGo,function(i,val){$(val).click(function(){return go(o.circular?o.visible+i:i);});});if(o.mouseWheel&&div.mousewheel)
div.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll);});var autoInterval;function startAuto(){stopAuto();autoInterval=setInterval(function(){go(curr+o.scroll);},o.auto+o.speed);};function stopAuto(){clearInterval(autoInterval);};if(o.auto){if(o.hoverPause){div.hover(function(){stopAuto();},function(){startAuto();});}
startAuto();};function vis(){return li.slice(curr).slice(0,v);};function go(to){if(!running){if(o.beforeStart)
o.beforeStart.call(this,vis());if(o.circular){if(to<0){ul.css(animCss,-((curr+tl)*liSize)+"px");curr=to+tl;}else if(to>itemLength-v){ul.css(animCss,-((curr-tl)*liSize)+"px");curr=to-tl;}else curr=to;}else{if(to<0||to>itemLength-v)return;else curr=to;}
running=true;ul.animate(animCss=="left"?{left:-(curr*liSize)}:{top:-(curr*liSize)},o.speed,o.easing,function(){if(o.afterEnd)
o.afterEnd.call(this,vis());running=false;});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled");}}
return false;};});};function css(el,prop){return parseInt($.css(el[0],prop))||0;};function width(el){return el[0].offsetWidth+css(el,'marginLeft')+css(el,'marginRight');};function height(el){return el[0].offsetHeight+css(el,'marginTop')+css(el,'marginBottom');};})(jQuery);
/**
 * Isotope v1.5.19
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd",transitionProperty:"transitionEnd"}[j],r=h("transitionDuration"));var s=b.event,t;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",t&&clearTimeout(t),t=setTimeout(function(){jQuery.event.handle.apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var u=["width","height"],v=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!b.browser.opera,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=u.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&v.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){var c=this,d=function(){c.$allAtoms=c.$allAtoms.not(a),a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this.$filteredAtoms=this.$filteredAtoms.not(a),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),v.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var w=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){w("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){w("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);
 /*
 * TipTip
 * Copyright 2010 Drew Wilson
 * www.drewwilson.com
 * code.drewwilson.com/entry/tiptip-jquery-plugin
 *
 * Version 1.3   -   Updated: Mar. 23, 2010
 *
 * This Plug-In will create a custom tooltip to replace the default
 * browser tooltip. It is extremely lightweight and very smart in
 * that it detects the edges of the browser window and will make sure
 * the tooltip stays within the current window size. As a result the
 * tooltip will adjust itself to be displayed above, below, to the left 
 * or to the right depending on what is necessary to stay within the
 * browser window. It is completely customizable as well via CSS.
 *
 * This TipTip jQuery plug-in is dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
(function($){$.fn.tipTip=function(options){var defaults={activation:"hover",keepAlive:false,maxWidth:"200px",edgeOffset:3,defaultPosition:"bottom",delay:400,fadeIn:200,fadeOut:200,attribute:"title",content:false,enter:function(){},exit:function(){}};var opts=$.extend(defaults,options);if($("#tiptip_holder").length<=0){var tiptip_holder=$('<div id="tiptip_holder" style="max-width:'+opts.maxWidth+';"></div>');var tiptip_content=$('<div id="tiptip_content"></div>');var tiptip_arrow=$('<div id="tiptip_arrow"></div>');$("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')))}else{var tiptip_holder=$("#tiptip_holder");var tiptip_content=$("#tiptip_content");var tiptip_arrow=$("#tiptip_arrow")}return this.each(function(){var org_elem=$(this);if(opts.content){var org_title=opts.content}else{var org_title=org_elem.attr(opts.attribute)}if(org_title!=""){if(!opts.content){org_elem.removeAttr(opts.attribute)}var timeout=false;if(opts.activation=="hover"){org_elem.hover(function(){active_tiptip()},function(){if(!opts.keepAlive){deactive_tiptip()}});if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}else if(opts.activation=="focus"){org_elem.focus(function(){active_tiptip()}).blur(function(){deactive_tiptip()})}else if(opts.activation=="click"){org_elem.click(function(){active_tiptip();return false}).hover(function(){},function(){if(!opts.keepAlive){deactive_tiptip()}});if(opts.keepAlive){tiptip_holder.hover(function(){},function(){deactive_tiptip()})}}function active_tiptip(){opts.enter.call(this);tiptip_content.html(org_title);tiptip_holder.hide().removeAttr("class").css("margin","0");tiptip_arrow.removeAttr("style");var top=parseInt(org_elem.offset()['top']);var left=parseInt(org_elem.offset()['left']);var org_width=parseInt(org_elem.outerWidth());var org_height=parseInt(org_elem.outerHeight());var tip_w=tiptip_holder.outerWidth();var tip_h=tiptip_holder.outerHeight();var w_compare=Math.round((org_width-tip_w)/2);var h_compare=Math.round((org_height-tip_h)/2);var marg_left=Math.round(left+w_compare);var marg_top=Math.round(top+org_height+opts.edgeOffset);var t_class="";var arrow_top="";var arrow_left=Math.round(tip_w-12)/2;if(opts.defaultPosition=="bottom"){t_class="_bottom"}else if(opts.defaultPosition=="top"){t_class="_top"}else if(opts.defaultPosition=="left"){t_class="_left"}else if(opts.defaultPosition=="right"){t_class="_right"}var right_compare=(w_compare+left)<parseInt($(window).scrollLeft());var left_compare=(tip_w+left)>parseInt($(window).width());if((right_compare&&w_compare<0)||(t_class=="_right"&&!left_compare)||(t_class=="_left"&&left<(tip_w+opts.edgeOffset+5))){t_class="_right";arrow_top=Math.round(tip_h-13)/2;arrow_left=-12;marg_left=Math.round(left+org_width+opts.edgeOffset);marg_top=Math.round(top+h_compare)}else if((left_compare&&w_compare<0)||(t_class=="_left"&&!right_compare)){t_class="_left";arrow_top=Math.round(tip_h-13)/2;arrow_left=Math.round(tip_w);marg_left=Math.round(left-(tip_w+opts.edgeOffset+5));marg_top=Math.round(top+h_compare)}var top_compare=(top+org_height+opts.edgeOffset+tip_h+8)>parseInt($(window).height()+$(window).scrollTop());var bottom_compare=((top+org_height)-(opts.edgeOffset+tip_h+8))<0;if(top_compare||(t_class=="_bottom"&&top_compare)||(t_class=="_top"&&!bottom_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_top"}else{t_class=t_class+"_top"}arrow_top=tip_h;marg_top=Math.round(top-(tip_h+5+opts.edgeOffset))}else if(bottom_compare|(t_class=="_top"&&bottom_compare)||(t_class=="_bottom"&&!top_compare)){if(t_class=="_top"||t_class=="_bottom"){t_class="_bottom"}else{t_class=t_class+"_bottom"}arrow_top=-12;marg_top=Math.round(top+org_height+opts.edgeOffset)}if(t_class=="_right_top"||t_class=="_left_top"){marg_top=marg_top+5}else if(t_class=="_right_bottom"||t_class=="_left_bottom"){marg_top=marg_top-5}if(t_class=="_left_top"||t_class=="_left_bottom"){marg_left=marg_left+5}tiptip_arrow.css({"margin-left":arrow_left+"px","margin-top":arrow_top+"px"});tiptip_holder.css({"margin-left":marg_left+"px","margin-top":marg_top+"px"}).attr("class","tip"+t_class);if(timeout){clearTimeout(timeout)}timeout=setTimeout(function(){tiptip_holder.stop(true,true).fadeIn(opts.fadeIn)},opts.delay)}function deactive_tiptip(){opts.exit.call(this);if(timeout){clearTimeout(timeout)}tiptip_holder.fadeOut(opts.fadeOut)}}})}})(jQuery);

 /*global jQuery */
/*jslint white: true, browser: true, onevar: true, undef: true, nomen: true, eqeqeq: true, bitwise: true, regexp: true, newcap: true, strict: true, maxerr: 50, indent: 4 */

/**
 * Set all passed elements to the same height as the highest element.
 * 
 * Copyright (c) 2010 Ewen Elder
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * @author: Ewen Elder <glomainn at yahoo dot co dot uk> <ewen at jainaewen dot com>
 * @version: 1.0
 * 
 * @todo: Recaluclate height if extra content is loaded into one of the elements after it has been resized
 *        possibly detect if the highest column has a fixed CSS height to being with or is set to 'auto'; if set to auto
 *        then leave as auto so that it well expend or contract naturally as it would normally.
**/ 

/* centre blockUI on screen */
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", ( jQuery(window).height() - this.height() ) / 2+jQuery(window).scrollTop() + "px");
    this.css("left", ( jQuery(window).width() - this.width() ) / 2+jQuery(window).scrollLeft() + "px");
    return this;
}

jQuery(document).ready(function() {
	
	// Position 'choose subject' instruction above cogs
	jQuery(window).on('load', function() {
		var jfCogWidth, jfPosRight, jfPosRightPX;
		jfCogWidth = jQuery("#cogs").css('width');
		jfPosRight = parseFloat(jfCogWidth)-120;
		jfPosRightPX = jfPosRight+'px';
		jQuery("#jf-chooseSubject").css('right',jfPosRightPX);
	});
  
	//jQuery('.isotope-item').equalHeights();

	jQuery("ul.tabs").tabs("div.clever-panes");	
	
	/* side navigation functionality */		
	jQuery("#side_nav li .title").click(function(){
		var jfAttr = jQuery(this).parent('li').attr('style');
		if (typeof jfAttr == 'undefined' || jfAttr == false) {
			jQuery("#side_nav ul").slideUp();
			jQuery("#side_nav ul").parent('li').removeAttr('style');
		}
		
		jQuery(this).addClass('active');
		jQuery(this).parent('li').children('ul').slideToggle();
		var attr = jQuery(this).parent('li').attr('style');
		
		if (typeof attr == 'undefined' || attr == false) {
		    jQuery(this).parent('li').css('background-image','url(/wp-content/themes/clevernotes/images/icons/down_arrow.png)');
		}
		else {
			jQuery(this).parent('li').removeAttr('style');
		}
	});	
	
	jQuery(".tiptip").tipTip({
		delay: 100,
		fadeIn: 0,
		fadeOut: 0,
		edgeOffset: 4
	});

	jQuery('#viewport').text(jQuery(window).width());
	
	jQuery(window).resize(function() {
		jQuery('#viewport').text(jQuery(window).width()); //window width
	});
	
	jQuery(".fade-me,.wp-post-image,#isotope-container img").hover(function(){
		jQuery(this).fadeTo(10, 0.75);
	},function(){
		jQuery(this).fadeTo(10, .99);
	});

	jQuery(".subject-not-selected img").fadeTo(0, .30);
	
	jQuery(".subject-not-selected img").hover(function(){
		jQuery(this).fadeTo(0, .99);
	},function(){
		jQuery(this).fadeTo(0, .30);
	});	
	
	/* To style images from Kapost */
	jQuery('.post-excerpt img').filter(function() {
	    return jQuery(this).css('float') == 'right';
	}).css("float", "right").css('margin','15px 0 15px 15px');	
	
	jQuery('.post-excerpt img').filter(function() {
	    return jQuery(this).css('float') == 'left';
	}).css("float", "left").css('margin','15px 15px 15px 0');	
	/* end style images from Kapost */	
	
	jQuery('#responsive_menu').prepend('<option class="level-0" value="" selected="selected">-- Navigation --</option><option class="level-0" value="0">Home</option>');		

	jQuery('#responsive_menu').on('change', function() {
		jQuerywhere = jQuery(this).val();
		window.location = "/?p="+jQuerywhere;
		
	});	
	if (jQuery(window).width() > 480) {
		// Run Isotope when all images are fully loaded
		jQuery(window).on('load', function() {
			jQuery('#isotope-container').isotope({
			  // options
			  itemSelector : '.isotope-item',
			  layoutMode : 'fitRows'
			});
			
			jQuery('.related_post').isotope({
			  // options
			  itemSelector : 'li',
			  layoutMode : 'fitRows'
			});	
		});
		
		jQuery(window).on('load', function() {	
			jQuery('#isotope-container-masonry').isotope({
				masonry: {
				    columnWidth: 340
				},
				itemSelector : '.isotope-item'
			});	
		});	
	}
	jQuery('#cogs img').show();
	jQuery(window).on('load', function() {	
		jQuery("#cogs").mCustomScrollbar({
			horizontalScroll:true
		});		
	});
	
});