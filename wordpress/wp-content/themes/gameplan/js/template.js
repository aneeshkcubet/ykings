/* Main JS  */
jQuery(document).ready(function($) {
	jQuery( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" id="add1" class="plus" />' ).prepend( '<input type="button" value="-" id="minus1" class="minus" />' );
	jQuery('.buttons_added #minus1').click(function(e) {
		var value = parseInt(jQuery(this).next().val()) - 1;
		if(value>0){
			jQuery(this).next().val(value);
		}
    });
	jQuery('.buttons_added #add1').click(function(e) {
		var value = parseInt(jQuery(this).prev().val()) + 1;
		jQuery(this).prev().val(value);
    });
	$('body').addClass(BrowserDetect.browser.toLowerCase());
	$('body').addClass('ver'+BrowserDetect.version);
	$("[data-toggle=tooltip]").tooltip();
	$(".gptooltip").tooltip();
	$(".carousel-mg br.nc" ).remove();
	var width =$(".timeline-event .timeline1" ).width();
	if(width<600){
		$(".timeline-event .timeline1 .postleft" ).css("display","none");
	}
	$(".tb-style-1 .column .compare-table-column p" ).remove();
	$(".slides").each(function(){		
		$(this).width(function(){
			return $(this).closest(".customslider").width();
		});	
		$('.recent-post', $(this)).width(function(){
			return jQuery(this).closest(".customslider").width();
		});
		$('.testimonial', $(this)).width(function(){				
			return $(this).closest(".customslider").width()-20;
		});
		
		$(window).resize(function() {
			$('.testimonial').width(function(){				
				return $(this).closest(".customslider").width()-20;
			});
			$('.slides .recent-post').width(function(){
				return jQuery(this).closest(".customslider").width();
			});
			$(this).width(function(){
				return $(this).closest(".customslider").width();
			});
		});
		
		var parent = $(this).parent().attr('id');
		if(!$(this).hasClass('flex')){
			$(this).imagesLoaded(function(){
				$(this).carouFredSel({
					circular: true,
					infinite: true,
					width 	: "100%",
					auto 	: false,
					align 	: "left",
					prev	: {	
						button	: "#"+parent+" .pre",
						key		: "left"
					},
					next	: { 
						button	: "#"+parent+" .next",
						key		: "right"
					},
					items : {
						visible : 1,
					},
					scroll : {
						items : 1,
						fx : "cover-fade"
					},
					swipe       : {
						onTouch : true,
						onMouse : false,
						items	: 1
					}
				});
			});
			$(this).trigger("configuration", {
					width : $(this).closest(".customslider").width(),
			});
		}
	});
	
	if($('#post_gallery').length > 0){
		// slider for gallery-post-format Post
		$('#post_gallery').imagesLoaded(function(){
			$('#post_gallery').carouFredSel({
				responsive  : true,
				scroll      : {
					fx          : "crossfade"
				},
				items       : {
					visible     : 1,
				},
				prev : "#foo1_prev",
				next : "#foo1_next",
				pagination  : "#foo3_pag",
				auto:false,
				//height: 'variable',
			});
		});
	}
	jQuery(window).scroll(function(e){
	   if(jQuery(document).scrollTop()>jQuery(window).height()){
		   jQuery('a#gototop').removeClass('notshow');
	   }else{
		   jQuery('a#gototop').addClass('notshow');
	   }
	});
	jQuery("#slider").css('height','auto');
	//iOS main nav fix
	jQuery('#navigation .menu li.parent .sub-menu a').on('touchend',function(){
		window.location = jQuery(this).attr('href');
	});
});

(function($){
	// Navigation on Mobile
	var current_menu = $('#navigation-menu-mobile select option[selected="selected"]').html();
	if(current_menu != ''){
		$('#navigation-menu-mobile .spanselect').html(current_menu);
	}
	
	// Check Mac or PC 
	if (navigator.userAgent.indexOf('Mac OS X') != -1) {
		$("body").addClass("mac");
	} else {
		$("body").addClass("pc");
	}
	
	// Accordion
	$(".accordion").collapse();
	$('.accordion-heading').click(function(){
		var parent = $(this).parent();
		if(parent.parent().attr('id') != ''){
			$('.accordion-heading', parent.parent()).each(function(){
				$(this).removeClass('active');
			});
		}
		if($('.accordion-body', parent).hasClass('in')){
			//$(this).addClass('in');
			$(this).removeClass('active');
		}else{
			//$(this).removeClass('in');
			$(this).addClass('active');
		}
	});
	
	// Carousel
	$('.GP-carousel').each(function(){
		$(this).carouFredSel({
			height: 'auto',
			prev: '.carousel-prev',
			next: '.carousel-next',
			auto: false,
			width: '100%',
			align: "left",
		});
	});
	
	// Navigation Sliding Bar
	var header_area = $('#navigation');	
	var navigation_wrapper = header_area.find('#navigation-menu');
	
	var main_navigation = header_area.find('.menu-main-menu-container');
	var sliding_bar = main_navigation.siblings('.current-menu');
	var sf_menu = main_navigation.children('ul.menu');
	var current_bar = sf_menu.children('.current_page_item');	
	if(main_navigation.length == 0){
		// fix for non-located menu
		main_navigation = header_area.find('div.menu');
		sliding_bar = main_navigation.siblings('.current-menu');
		sf_menu = main_navigation.children('ul');
		current_bar = sf_menu.children('.current_page_item');
	}	
	
	if( !current_bar.length ){ current_bar = sf_menu.children('.current-menu-parent'); }
	if( !current_bar.length ){ current_bar = sf_menu.children('.current-menu-item'); }
	if( !current_bar.length ){ current_bar = sf_menu.children('.current_page_parent'); }
	if( !current_bar.length ){ current_bar = sf_menu.children().filter(':first'); }
	
	function init_navigation_sliding_bar(){
		// sliding bar width
		sliding_bar.css({ 'width':current_bar.outerWidth(), 'left':current_bar.position().left });
		sf_menu.children('li').css('padding-bottom', '0px');
		
		// sub nav height
		var header_height = parseInt(header_area.css('height'));
		var nav_margin = parseInt(navigation_wrapper.css('margin-top'));
		var nav_height = parseInt(navigation_wrapper.css('height'));
		
		//sf_menu.children('li').children('ul.sub-menu').css('top', header_height + 'px');
		//sf_menu.children('li').css('padding-bottom', (header_height - nav_height) + 'px');
	}
	$(window).load(function(e) {
        init_navigation_sliding_bar();
		sf_menu.children().hover(function(){
			sliding_bar.animate({ 'width':jQuery(this).outerWidth(), 'left':jQuery(this).position().left }, 
				{ queue: false, easing: 'easeOutQuad', duration: 250 });
		},function(){
			sliding_bar.animate({ 'width':current_bar.outerWidth(), 'left':current_bar.position().left }, 
				{ queue: false, easing: 'easeOutQuad', duration: 250 });
		});
    });
	
})(jQuery);

jQuery('a#gototop').click(function(){
	jQuery('html, body').animate({
		scrollTop: jQuery('[name="' + jQuery.attr(this, 'href').substr(1) + '"]').offset().top
	}, 680);
	return false;
});
jQuery('#nav-top #search input#s').focus(function(e) {
    jQuery(this).closest('.span6').addClass('search-focus');
});
jQuery('#nav-top #search input#s').focusout(function(e) {
    jQuery(this).closest('.span6').removeClass('search-focus');
});

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera",
			versionSearch: "Version"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

/*!
 * imagesLoaded PACKAGED v3.0.4
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

(function(){"use strict";function e(){}function t(e,t){for(var n=e.length;n--;)if(e[n].listener===t)return n;return-1}function n(e){return function(){return this[e].apply(this,arguments)}}var i=e.prototype;i.getListeners=function(e){var t,n,i=this._getEvents();if("object"==typeof e){t={};for(n in i)i.hasOwnProperty(n)&&e.test(n)&&(t[n]=i[n])}else t=i[e]||(i[e]=[]);return t},i.flattenListeners=function(e){var t,n=[];for(t=0;e.length>t;t+=1)n.push(e[t].listener);return n},i.getListenersAsObject=function(e){var t,n=this.getListeners(e);return n instanceof Array&&(t={},t[e]=n),t||n},i.addListener=function(e,n){var i,r=this.getListenersAsObject(e),o="object"==typeof n;for(i in r)r.hasOwnProperty(i)&&-1===t(r[i],n)&&r[i].push(o?n:{listener:n,once:!1});return this},i.on=n("addListener"),i.addOnceListener=function(e,t){return this.addListener(e,{listener:t,once:!0})},i.once=n("addOnceListener"),i.defineEvent=function(e){return this.getListeners(e),this},i.defineEvents=function(e){for(var t=0;e.length>t;t+=1)this.defineEvent(e[t]);return this},i.removeListener=function(e,n){var i,r,o=this.getListenersAsObject(e);for(r in o)o.hasOwnProperty(r)&&(i=t(o[r],n),-1!==i&&o[r].splice(i,1));return this},i.off=n("removeListener"),i.addListeners=function(e,t){return this.manipulateListeners(!1,e,t)},i.removeListeners=function(e,t){return this.manipulateListeners(!0,e,t)},i.manipulateListeners=function(e,t,n){var i,r,o=e?this.removeListener:this.addListener,s=e?this.removeListeners:this.addListeners;if("object"!=typeof t||t instanceof RegExp)for(i=n.length;i--;)o.call(this,t,n[i]);else for(i in t)t.hasOwnProperty(i)&&(r=t[i])&&("function"==typeof r?o.call(this,i,r):s.call(this,i,r));return this},i.removeEvent=function(e){var t,n=typeof e,i=this._getEvents();if("string"===n)delete i[e];else if("object"===n)for(t in i)i.hasOwnProperty(t)&&e.test(t)&&delete i[t];else delete this._events;return this},i.removeAllListeners=n("removeEvent"),i.emitEvent=function(e,t){var n,i,r,o,s=this.getListenersAsObject(e);for(r in s)if(s.hasOwnProperty(r))for(i=s[r].length;i--;)n=s[r][i],n.once===!0&&this.removeListener(e,n.listener),o=n.listener.apply(this,t||[]),o===this._getOnceReturnValue()&&this.removeListener(e,n.listener);return this},i.trigger=n("emitEvent"),i.emit=function(e){var t=Array.prototype.slice.call(arguments,1);return this.emitEvent(e,t)},i.setOnceReturnValue=function(e){return this._onceReturnValue=e,this},i._getOnceReturnValue=function(){return this.hasOwnProperty("_onceReturnValue")?this._onceReturnValue:!0},i._getEvents=function(){return this._events||(this._events={})},"function"==typeof define&&define.amd?define(function(){return e}):"object"==typeof module&&module.exports?module.exports=e:this.EventEmitter=e}).call(this),function(e){"use strict";var t=document.documentElement,n=function(){};t.addEventListener?n=function(e,t,n){e.addEventListener(t,n,!1)}:t.attachEvent&&(n=function(t,n,i){t[n+i]=i.handleEvent?function(){var t=e.event;t.target=t.target||t.srcElement,i.handleEvent.call(i,t)}:function(){var n=e.event;n.target=n.target||n.srcElement,i.call(t,n)},t.attachEvent("on"+n,t[n+i])});var i=function(){};t.removeEventListener?i=function(e,t,n){e.removeEventListener(t,n,!1)}:t.detachEvent&&(i=function(e,t,n){e.detachEvent("on"+t,e[t+n]);try{delete e[t+n]}catch(i){e[t+n]=void 0}});var r={bind:n,unbind:i};"function"==typeof define&&define.amd?define(r):e.eventie=r}(this),function(e){"use strict";function t(e,t){for(var n in t)e[n]=t[n];return e}function n(e){return"[object Array]"===c.call(e)}function i(e){var t=[];if(n(e))t=e;else if("number"==typeof e.length)for(var i=0,r=e.length;r>i;i++)t.push(e[i]);else t.push(e);return t}function r(e,n){function r(e,n,s){if(!(this instanceof r))return new r(e,n);"string"==typeof e&&(e=document.querySelectorAll(e)),this.elements=i(e),this.options=t({},this.options),"function"==typeof n?s=n:t(this.options,n),s&&this.on("always",s),this.getImages(),o&&(this.jqDeferred=new o.Deferred);var a=this;setTimeout(function(){a.check()})}function c(e){this.img=e}r.prototype=new e,r.prototype.options={},r.prototype.getImages=function(){this.images=[];for(var e=0,t=this.elements.length;t>e;e++){var n=this.elements[e];"IMG"===n.nodeName&&this.addImage(n);for(var i=n.querySelectorAll("img"),r=0,o=i.length;o>r;r++){var s=i[r];this.addImage(s)}}},r.prototype.addImage=function(e){var t=new c(e);this.images.push(t)},r.prototype.check=function(){function e(e,r){return t.options.debug&&a&&s.log("confirm",e,r),t.progress(e),n++,n===i&&t.complete(),!0}var t=this,n=0,i=this.images.length;if(this.hasAnyBroken=!1,!i)return this.complete(),void 0;for(var r=0;i>r;r++){var o=this.images[r];o.on("confirm",e),o.check()}},r.prototype.progress=function(e){this.hasAnyBroken=this.hasAnyBroken||!e.isLoaded;var t=this;setTimeout(function(){t.emit("progress",t,e),t.jqDeferred&&t.jqDeferred.notify(t,e)})},r.prototype.complete=function(){var e=this.hasAnyBroken?"fail":"done";this.isComplete=!0;var t=this;setTimeout(function(){if(t.emit(e,t),t.emit("always",t),t.jqDeferred){var n=t.hasAnyBroken?"reject":"resolve";t.jqDeferred[n](t)}})},o&&(o.fn.imagesLoaded=function(e,t){var n=new r(this,e,t);return n.jqDeferred.promise(o(this))});var f={};return c.prototype=new e,c.prototype.check=function(){var e=f[this.img.src];if(e)return this.useCached(e),void 0;if(f[this.img.src]=this,this.img.complete&&void 0!==this.img.naturalWidth)return this.confirm(0!==this.img.naturalWidth,"naturalWidth"),void 0;var t=this.proxyImage=new Image;n.bind(t,"load",this),n.bind(t,"error",this),t.src=this.img.src},c.prototype.useCached=function(e){if(e.isConfirmed)this.confirm(e.isLoaded,"cached was confirmed");else{var t=this;e.on("confirm",function(e){return t.confirm(e.isLoaded,"cache emitted confirmed"),!0})}},c.prototype.confirm=function(e,t){this.isConfirmed=!0,this.isLoaded=e,this.emit("confirm",this,t)},c.prototype.handleEvent=function(e){var t="on"+e.type;this[t]&&this[t](e)},c.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindProxyEvents()},c.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindProxyEvents()},c.prototype.unbindProxyEvents=function(){n.unbind(this.proxyImage,"load",this),n.unbind(this.proxyImage,"error",this)},r}var o=e.jQuery,s=e.console,a=s!==void 0,c=Object.prototype.toString;"function"==typeof define&&define.amd?define(["eventEmitter/EventEmitter","eventie/eventie"],r):e.imagesLoaded=r(e.EventEmitter,e.eventie)}(window);