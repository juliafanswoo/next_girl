//jQuery $ > jQuery Start
;(function($){
	//jQuery ready
	$(function(){
	
		//載入CSS檔案
		var fanswooVersion = "fanswoo-1.3.1.js";
		var cssPath = $("script[src$='" + fanswooVersion + "']").attr("src").split(fanswooVersion);
		var cssPath = cssPath[0];
		$("<link>").attr({ rel: "stylesheet", href: cssPath + "fanswoo-js.css"}).appendTo("head");
		
		//版本提示
		//if($.browser.msie && $.browser.version < 8){
		//	alert("您的瀏覽器版本過舊，無法正常支援HTML5及CSS3的最新功能，請下載Chrome、Firefox或將您的IE更新到最新版本。\n\nYour browser version is too old, can not properly support the latest features of HTML5 and CSS3, please download Chrome, Firefox or update your IE to the latest version.");
		//}
		
		// $('#my-container').imagesLoaded(myFunction)
		// or
		// $('img').imagesLoaded(myFunction)
		// execute a callback when all images have loaded.
		// needed because .load() doesn't work on cached images
		// callback function gets image collection as argument
		//  `this` is the container
		$.fn.imagesLoaded = function( callback ){
			var $this = this,
			$images = $this.find('img').add( $this.filter('img') ),
			len = $images.length,
			blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==',
			loaded = [];
			function triggerCallback() {
				callback.call( $this, $images );
			}
			function imgLoaded( event ) {
				var img = event.target;
				if ( img.src !== blank && $.inArray( img, loaded ) === -1 ){
					loaded.push( img );
					if ( --len <= 0 ){
						setTimeout( triggerCallback );
						$images.unbind( '.imagesLoaded', imgLoaded );
					}
				}
			}
			// if no images, trigger immediately
			if ( !len ) {
				triggerCallback();
			}
			$images.bind( 'load.imagesLoaded error.imagesLoaded',  imgLoaded ).each( function() {
				// cached images don't fire load sometimes, so we reset src.
				var src = this.src;
				// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
				// data uri bypasses webkit log warning (thx doug jones)
				this.src = blank;
				this.src = src;
			});
			return $this;
		};
		
		//$("#clicker").previewScreen("#content");
		//#clicker填寫觸發者，#content填寫列印內容
		$.fn.previewScreen = function(jQuerySelect , callback ){
			var _this = this;
			var handler = function(){
				$(_this).on('click', _this, function(){
					var printPage = window.open("","printPage","");
					printPage.document.open();
					printPage.document.write("<HTML><head></head><BODY>");
					printPage.document.write($(jQuerySelect).html());
					printPage.document.close("</BODY></HTML>");
				});
			}
			return this.each(handler);
		};
		
		//<a href="" fanswoo-href></a>
		//阻止連結動作
		$(document).on('click', '[fanswoo-hrefNone]', function(event){
			event.preventDefault();
		});
		
		//$.url class
		//$.url.param('val') 分析指定網址參數
		//$.url.paramAll() 會回傳所有參數集合的陣列
		$.url = {};
		$.extend($.url, {
			_params: {},
			init: function(){
				var paramsRaw = "";
				try{
					paramsRaw = (document.location.href.split("?", 2)[1] || "").split("#")[0].split("&") || [];
					for(var i = 0; i< paramsRaw.length; i++){
						var single = paramsRaw[i].split("=");
						if(single[0]){
							this._params[single[0]] = unescape(single[1]);
						}
					}
				}
				catch(e){
					alert(e);
				}
			},
			param: function(name){
				return this._params[name] || "";
			},
			paramAll: function(){
				return this._params;
			}
		});
		$.url.init();
		
		//$().heightAll()回傳height+padding-top+padding-bottom
		$.fn.heightAll = function(){
			return $(this).height() + parseInt($(this).css("padding-top")) + parseInt($(this).css("padding-bottom"));
		};
		
		//$().widthAll()回傳width+padding-left+padding-right
		$.fn.widthAll = function(){
			return $(this).width() + parseInt($(this).css("padding-left")) + parseInt($(this).css("padding-right"));
		};
		
		//$().scrollWatchOver({watchingDistance:0, watchedDistance:0, callback:function(){}});
		//偵測網頁瀏覽位置，網頁瀏覽位置由下而上出現後觸發callback
		$.fn.scrollWatchOver = function(_settings){
			var defaultSettings = {
				watchingDistance: 0,
				callback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			$("[fanswoo-scrollWatchOver]").attr('fanswoo-scrollWatchOver','none');
			var handler = function(){
				$(window).scroll(function(){
					//watching向下轉動
					var loop = true;
					while(loop){
						var x = $("[fanswoo-scrollWatchOver='none']:first").offset();
						if(x !== null){
							if($(window).scrollTop() + $(window).height() - settings.watchingDistance > x.top){
								//初始直線型瀏覽
								$("[fanswoo-scrollWatchOver='none']:first").attr('fanswoo-scrollWatchOver','watching');
								settings.callback();
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						else{//結束迴圈
							var loop = false;
						}
					}
				});
			}
			return this.each(handler);
		};
		
		//$.mousewheel(function(event, delta){});滑鼠滾輪偵測，delta若是負值為往下滾；反之則往上滾
		//var count = 0;
		//$("#mousewheel_example").mousewheel(function(event, delta){
		//	alert(delta);
		//});
		var mousewheelTypes = ['DOMMouseScroll', 'mousewheel'];
		if ($.event.fixHooks) {
			for ( var i=mousewheelTypes.length; i; ) {
				$.event.fixHooks[ mousewheelTypes[--i] ] = $.event.mouseHooks;
			}
		}
		$.event.special.mousewheel = {
			setup: function() {
				if ( this.addEventListener ) {
					for ( var i=mousewheelTypes.length; i; ) {
						this.addEventListener( mousewheelTypes[--i], mousewheelHandler, false );
					}
				} else {
					this.onmousewheel = mousewheelHandler;
				}
			},
			teardown: function() {
				if ( this.removeEventListener ) {
					for ( var i=mousewheelTypes.length; i; ) {
						this.removeEventListener( mousewheelTypes[--i], mousewheelHandler, false );
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
		function mousewheelHandler(event) {
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
		
		//scrollReel高級捲軸
		$.fn.scrollReel = function(_settings){
			var _this = this;
			var defaultSettings = {
			};
			var settings = $.extend(defaultSettings, _settings);
			var handler = function(){
				var $this = $(this);
				var scrollMoveHeight = 100;//box每次捲動移動的範圍
				var thisHeightAll;//box高度
				var scrollHeight;//box內容距離上方長度
				var contentHeight;//box內容高度
				var turnCount;//捲軸每次移動幅度
				$this.attr("fanswoo-scrollReel","true");
				if($this.css("position") != 'fixed'){
					$this.css("position","relative");
				}
				$this.append("<div fanswoo-scrollReelChild></div>");
				var $thisChild = $this.children("[fanswoo-scrollReelChild]");
				$this.resize(function(){
					reSet();
				});
				$this.mouseenter(function(){
					if(scrollHeight == undefined || thisHeightAll != $this.heightAll() || contentHeight != scrollHeight + thisHeightAll){
						reSet();
					}
				});
				$this.mousewheel(function(event, delta){
					if(delta == 1 && scrollHeight > 20 && $this.scrollTop() > 10){
						$thisChild.css("top", (parseInt($thisChild.css("top")) - turnCount) + "px");
						$this.scrollTop($this.scrollTop() - scrollMoveHeight);
						if(parseInt($thisChild.css("top")) < 10){
							$thisChild.css("top", "10px");
						}
					}
					else if(delta == -1 && scrollHeight > 20 && $this.scrollTop() < scrollHeight - 10){
						$thisChild.css("top", (parseInt($thisChild.css("top")) + turnCount) + "px");
						$this.scrollTop($this.scrollTop() + scrollMoveHeight);
						if(parseInt($thisChild.css("top")) > contentHeight - $thisChild.height() - 10){
							$thisChild.css("top", (contentHeight - $thisChild.height() - 10) + "px");
						}
					}
				});
				function reSet(){
					$thisChild.css("top", "10px");
					$thisChild.height(0);
					thisHeightAll = $this.heightAll();
					$this.scrollTop(9999999999);
					scrollHeight = $this.scrollTop();
					if(scrollHeight > 20){
						contentHeight = scrollHeight + thisHeightAll;
						turnCount = scrollMoveHeight + ((thisHeightAll - 20) / Math.ceil(contentHeight / scrollMoveHeight));
						var thisChildHeight = $this.heightAll() * $this.heightAll() / contentHeight;
						$thisChild.height(thisChildHeight);
					}
					$this.scrollTop(0);
				}
			}
			return this.each(handler);
		};
		
		//jQuery resize event內容變更事件偵測
		var elems = $([]),
		jq_resize = $.resize = $.extend( $.resize, {} ),
		timeout_id,
		str_setTimeout = 'setTimeout',
		str_resize = 'resize',
		str_data = str_resize + '-special-event',
		str_delay = 'delay',
		str_throttle = 'throttleWindow';
		jq_resize[ str_delay ] = 250;
		jq_resize[ str_throttle ] = true;
		$.event.special[ str_resize ] = {
			setup: function() {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var elem = $(this);
				elems = elems.add( elem );
				$.data( this, str_data, { w: elem.width(), h: elem.height() } );
				if ( elems.length === 1 ) {
					loopy();
				}
			},
			teardown: function() {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var elem = $(this);
				elems = elems.not( elem );
				elem.removeData( str_data );
				if ( !elems.length ) {
					clearTimeout( timeout_id );
				}
			},
			add: function( handleObj ) {
				if ( !jq_resize[ str_throttle ] && this[ str_setTimeout ] ) { return false; }
				var old_handler;
				function new_handler( e, w, h ) {
					var elem = $(this),
					data = $.data( this, str_data );
					data.w = w !== undefined ? w : elem.width();
					data.h = h !== undefined ? h : elem.height();
					old_handler.apply( this, arguments );
				};
				if ( $.isFunction( handleObj ) ) {
					old_handler = handleObj;
					return new_handler;
				} else {
					old_handler = handleObj.handler;
					handleObj.handler = new_handler;
				}
			}
		};
		function loopy() {
			timeout_id = window[ str_setTimeout ](function(){
			elems.each(function(){
				var elem = $(this),
				width = elem.width(),
				height = elem.height(),
				data = $.data( this, str_data );
				if ( width !== data.w || height !== data.h ) {
					elem.trigger( str_resize, [ data.w = width, data.h = height ] );
				}
			});
			// Loop.
			loopy();
			}, jq_resize[ str_delay ] );
		};
		
		//$().scrollWatch({watchingDistance:0, watchedDistance:0, callback:function(){}});
		//偵測網頁瀏覽位置，網頁瀏覽位置由下而上出現後觸發callback
		$.fn.scrollWatch = function(_settings){
			this.scrollTopNow = 0;
			var _this = this;
			var defaultSettings = {
				watchingDistance: 0,
				bottomCallback: function() {},
				topCallback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			$("[fanswoo-scrollWatch]").attr('fanswoo-scrollWatch','none');
			var handler = function(){
				$(window).scroll(function(){
					if($(window).scrollTop() >= _this.scrollTopNow){
						_this.scrollTopNow = $(window).scrollTop();
						//watching向下轉動
						var loop = true;
						while(loop){
							if($("[fanswoo-scrollWatch='watching']").length > 0){//watching已經存在
								var x = $("[fanswoo-scrollWatch='watching']:last").nextAll("[fanswoo-scrollWatch='none']:first").offset();
							}
							else{//初始直線型瀏覽
								var x = $("[fanswoo-scrollWatch='none']:first").offset();
							}
							if(x !== null){
								if($(window).scrollTop() + $(window).height() - settings.watchingDistance > x.top){
									if($("[fanswoo-scrollWatch='watching']").length > 0){//watching已經存在
										$("[fanswoo-scrollWatch='watching']:last").nextAll("[fanswoo-scrollWatch='none']:first").attr('fanswoo-scrollWatch','watching');
									}
									else{//初始直線型瀏覽
										$("[fanswoo-scrollWatch='none']:first").attr('fanswoo-scrollWatch','watching');
									}
									settings.bottomCallback();
								}
								else{//結束迴圈
									var loop = false;
								}
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						//none向下捲動
						var loop = true;
						while(loop){
							var x = $("[fanswoo-scrollWatch='watching']:first").offset();
							if(x !== null){
								var objHeight = $("[fanswoo-scrollWatch='watching']:first").heightAll();
								if($(window).scrollTop() - objHeight > x.top){
									$("[fanswoo-scrollWatch='watching']:first").attr('fanswoo-scrollWatch','none');
								}
								else{
									var loop = false;
								}
							}
							else{
								var loop = false;
							}
						}
					}
					else if($(window).scrollTop() < _this.scrollTopNow){
						_this.scrollTopNow = $(window).scrollTop();
						//watching向上轉動
						var loop = true;
						while(loop){
							var x = $("[fanswoo-scrollWatch='watching']:first").prevAll("[fanswoo-scrollWatch='none']:first").offset();
							if(x !== null){
								var objHeight = $("[fanswoo-scrollWatch='watching']:first").prevAll("[fanswoo-scrollWatch='none']:first").heightAll();
								if($(window).scrollTop() - objHeight < x.top){
									$("[fanswoo-scrollWatch='watching']:first").prevAll("[fanswoo-scrollWatch='none']:first").attr('fanswoo-scrollWatch','watching');
									settings.topCallback();
								}
								else{//結束迴圈
									var loop = false;
								}
							}
							else{//結束迴圈
								var loop = false;
							}
						}
						//none向上捲動
						var loop = true;
						while(loop){
							var x = $("[fanswoo-scrollWatch='watching']:last").offset();
							if(x !== null){
								if($(window).scrollTop() + $(window).height() < x.top){
									$("[fanswoo-scrollWatch='watching']:last").attr('fanswoo-scrollWatch','none');
								}
								else{
									var loop = false;
								}
							}
							else{
								var loop = false;
							}
						}
					}
				});
			}
			return this.each(handler);
		};
		
		//fanswoo-textareaAutoHeight自動調整textarea高度
		//<div fanswoo-textareaAutoHeight><textarea></textarea></div>
		$(document).on('focus', '[fanswoo-textareaAutoHeight]', function() {
			if($(this).attr('pre') == 'true'){
			}
			else{
				$(this).attr('pre', 'true');
				var $this = $(this),
				$mirror = $("<pre><span></span><br /></pre>").appendTo($this),
				$textarea = $this.find("textarea"),
				checkCssRule = "font-size line-height border padding margin".split(" "),
				ruleIterator = 0,
				ruleLength = checkCssRule.length,
				rule;
				for (; ruleIterator < ruleLength; ruleIterator++) {
					rule = checkCssRule[ruleIterator];
					if ($textarea.css(rule)) {
						$mirror.css(rule, $textarea.css(rule));
					}
				}
				$mirror.width($textarea.width());
				$textarea.on("input", function(){
					$mirror.find("span").html($textarea.val());
					$textarea.height($mirror.height());
				}).trigger("input");
			}
		});
		
		//fanswoo-promptTitleMeta提示浮動標籤
		//<a fanswoo-promptTitleMeta="this is a apple">what's this?</a>
		$(document).on('ajax ready', function() {
			$("[fanswoo-promptTitleMeta]:not([fanswoo-promptTitleMetaChild])").each(function() {
				var $this = $(this);
				var $child = $("<span fanswoo-promptTitleMetaChild></span>").appendTo($this);
				$child.css("left", $this.widthAll());
				$child.css("display", "none");
				$child.text($this.attr("fanswoo-promptTitleMeta"));
			});
		});
		$(document).on('hover', '[fanswoo-promptTitleMeta]', function() {
			$(this).find("[fanswoo-promptTitleMetaChild]").css("display", "");
		});
		
		//fanswoo-slideshow
		//slideshowNav為選項，由slideshowPage="0"指定slideshowPic畫布的開始選項
		//slideshowPic為畫面，由slideshowPage="0"指定開始畫面
		//slideshowLeft為向左轉觸發按鈕
		//slideshowRight為向右轉觸發按鈕
		//利用slideshowPic畫布產生的slideshowPath做出幻燈片（left、center、right、hidden）的轉場效果
		//利用slideshowNav選項產生的slideshowClick做出（true）選擇鍵效果
		//一定要放置slideshowNav才可使用
		//
		//基本模組ex：
		//<div fanswoo-slideshowPic="sample1" fanswoo-slideshowPage="0" fanswoo-slideShowEvent="click"></div>
		//<div fanswoo-slideshowPic="sample1"></div>
		//<div fanswoo-slideshowPic="sample1"></div>
		//<div fanswoo-slideshowNav="sample1" fanswoo-slideshowPage="0"></div>
		//<div fanswoo-slideshowNav="sample1"></div>
		//<div fanswoo-slideshowNav="sample1"></div>
		//<div fanswoo-slideshowLeft="sample1"></div>
		//<div fanswoo-slideshowRight="sample1"></div>
		$("[fanswoo-slideshowPic][fanswoo-slideshowPage='0']").each(function(){
			var name = $(this).attr("fanswoo-slideshowPic");
			if($(this).attr("fanswoo-slideShowEvent") == '' || $(this).attr("fanswoo-slideShowEvent") == 'click'){
				var slideShowEvent = 'click';
			}
			else if($(this).attr("fanswoo-slideShowEvent") == 'mouseenter'){
				var slideShowEvent = 'mouseenter';
			}
			else if($(this).attr("fanswoo-slideShowEvent") == 'click,mouseenter'){
				var slideShowEvent = 'click,mouseenter';
			}
			else{
				var slideShowEvent = 'click';
			}
			if($("[fanswoo-slideshowPic='" + name + "']").size() == 2){
				$("[fanswoo-slideshowPic='" + name + "']:eq(0)").clone().removeAttr("fanswoo-slideshowPage").insertAfter("[fanswoo-slideshowPic='" + name + "']:last");
				$("[fanswoo-slideshowPic='" + name + "']:eq(1)").clone().removeAttr("fanswoo-slideshowPage").insertAfter("[fanswoo-slideshowPic='" + name + "']:last");
				$("[fanswoo-slideshowNav='" + name + "']:eq(0)").clone().removeAttr("fanswoo-slideshowPage").insertAfter("[fanswoo-slideshowNav='" + name + "']:last");
				$("[fanswoo-slideshowNav='" + name + "']:eq(1)").clone().removeAttr("fanswoo-slideshowPage").insertAfter("[fanswoo-slideshowNav='" + name + "']:last");
			}
			//為slideshowNav和slideshowPic增加對應的slideshowPage屬性
			$("[fanswoo-slideshowNav='" + name + "']").each(function(key, value){
				$(this).attr("fanswoo-slideshowPage", key);
				$("[fanswoo-slideshowPic='" + name + "']:eq(" + key + ")").attr("fanswoo-slideshowPage", key);
			});
			if($("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").size() > 1){
				//依照slideshowNav增加slideshowPic的left、center、right屬性
				$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(0)").attr("fanswoo-slideshowPath","center");
				$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(1)").attr("fanswoo-slideshowPath","right");
				$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:last").remove().clone().attr("fanswoo-slideshowPath","left").insertBefore("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(0)");
				//為slideshowNav增加click屬性
				$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage]:eq(0)").attr("fanswoo-slideshowClick", "true");
				//滑鼠選擇圖片時轉換
				$(document).on(slideShowEvent, "[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage]", function(){
					if($(this).attr("fanswoo-slideshowPage") !== $("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='center']").attr("fanswoo-slideshowPage")){
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='hidden']").remove();
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").removeAttr("fanswoo-slideshowPath");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").attr("fanswoo-slideshowTurn","select");
						$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowClick='true']").removeAttr("fanswoo-slideshowClick");
						$(this).attr("fanswoo-slideshowClick", "true");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").removeAttr("fanswoo-slideshowPath");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage='" + $(this).attr("fanswoo-slideshowPage") + "']").attr("fanswoo-slideshowPath","center");
						//倒反center前面的dom
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").prevAll().remove().clone().insertBefore("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(0)");
						//增加path屬性
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").prevAll().remove().clone().insertAfter("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:last");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='center']").next().clone().attr("fanswoo-slideshowPath", "hidden").insertBefore("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='center']");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").next().attr("fanswoo-slideshowPath","right");
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:last").remove().clone().attr("fanswoo-slideshowPath","left").insertBefore("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']");
						if($.browser.msie && $.browser.version < 10){
							$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").css('display', 'none').fadeIn();
							$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath!='center']").css('display', 'none');
						}
					}
				});
				//滑鼠點選右轉時轉換
				$(document).on(slideShowEvent, "[fanswoo-slideshowRight='" + name + "']", function(){
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='hidden']").remove();
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").removeAttr("fanswoo-slideshowTurn");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").attr("fanswoo-slideshowTurn","right");
					$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowClick='true']").removeAttr("fanswoo-slideshowClick").next().attr("fanswoo-slideshowClick", "true");
					if($("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowClick='true']").size() == 0){
						$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage]:eq(0)").attr("fanswoo-slideshowClick", "true");
					}
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='right']").removeAttr("fanswoo-slideshowPath").next().attr("fanswoo-slideshowPath","right");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").removeAttr("fanswoo-slideshowPath").next().attr("fanswoo-slideshowPath","center");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='left']").removeAttr("fanswoo-slideshowPath").next().attr("fanswoo-slideshowPath","left");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(0)").clone().insertAfter("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:last");
					$("[fanswoo-slideshowPic='" + name + "']:eq(0)").attr("fanswoo-slideshowPath", "hidden");
					if($("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='right']").size() == 0){
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:last").attr("fanswoo-slideshowPath","right");
					}
				});
				//滑鼠點選左轉時轉換
				$(document).on(slideShowEvent, "[fanswoo-slideshowLeft='" + name + "']", function(){
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='hidden']").remove();
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").removeAttr("fanswoo-slideshowTurn");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]").attr("fanswoo-slideshowTurn","left");
					$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowClick='true']").removeAttr("fanswoo-slideshowClick").prev().attr("fanswoo-slideshowClick", "true");
					if($("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowClick='true']").size() == 0){
						$("[fanswoo-slideshowNav='" + name + "'][fanswoo-slideshowPage]:last").attr("fanswoo-slideshowClick", "true");
					}
					$("[fanswoo-slideshowPic='" + name + "']:last").remove().clone().insertBefore("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(0)");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPath='right']").clone().attr("fanswoo-slideshowPath", "hidden").insertBefore("[fanswoo-slideshowPic='" + name + "']:eq(0)");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='left']").removeAttr("fanswoo-slideshowPath").prev().attr("fanswoo-slideshowPath","left");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='center']").removeAttr("fanswoo-slideshowPath").prev().attr("fanswoo-slideshowPath","center");
					$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='right']").removeAttr("fanswoo-slideshowPath").prev().attr("fanswoo-slideshowPath","right");
					if($("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage][fanswoo-slideshowPath='right']").size() == 0){
						$("[fanswoo-slideshowPic='" + name + "'][fanswoo-slideshowPage]:eq(3)").attr("fanswoo-slideshowPath","right");
					}
				});
			}
			else{
				$("[fanswoo-slideshowPic='" + name + "']").attr("fanswoo-slideshowTurn", "select");
				$("[fanswoo-slideshowPic='" + name + "']").attr("fanswoo-slideshowPath", "select");
			}
			if($("[fanswoo-slideshowPic='" + name + "']").size() == 1){
				$("[fanswoo-slideshowPic='" + name + "']:eq(0)").attr("fanswoo-slideshowPath","center");
				$("[fanswoo-slideshowNav='" + name + "']:eq(0)").attr("fanswoo-slideShowEvent","click");
			}
		});

	    /*
	    多層次選單用法
	    fanswoo-selectEachDiv為多層次最上層
	    fanswoo-selectEachLine為多層次上層
	    fanswoo-selectEachLineMaster為多層次之主要Select
	    fanswoo-selectEachLineSlave為多層次之次要Select，因應selectEachLineMaster之值而顯示次要Select
	    fanswoo-selectEachLineCount為計數器，計算selectEachDiv內的selectEachLineCount總數
	    
	    雙層範例
	    <style>
	    [fanswoo-selectEachDiv]{width:500px;overflow:hidden;}
	    [fanswoo-selectEachLine]{overflow:hidden;}
	    select{float:left;}
	    </style>
	    <div style="width:500px;overflow:hidden;" fanswoo-selectEachDiv="A">
	      <div fanswoo-selectEachLine>
	          <span>number <span fanswoo-selectEachLineCount></span> :</span>
	          <select fanswoo-selectEachLineMaster="A">
	              <option value="">NULL</option>
	              <option value="A1">A1</option>
	              <option value="A2">A2</option>
	          </select>
	          <div fanswoo-selectEachLineSlave="A">
	              <select fanswoo-selectValue="A1" fanswoo-selectName="class_Arr[]">
	                  <option value="">NULL</option>
	                  <option value="B1">B1</option>
	                  <option value="B2">B2</option>
	              </select>
	              <select fanswoo-selectValue="A2" fanswoo-selectName="class_Arr[]">
	                  <option value="">NULL</option>
	                  <option value="B3">B3</option>
	                  <option value="B4">B4</option>
	              </select>
	          </div>
	      </div>
	    </div>
	    
	    多層次範例
	    <style>
	    [fanswoo-selectEachDiv]{width:500px;overflow:hidden;}
	    [fanswoo-selectEachLine]{overflow:hidden;}
	    select{float:left;}
	    </style>
	    <div fanswoo-selectEachDiv="class2">
	        <div fanswoo-selectEachLine>
	            <span style="float:left;">分類 <span fanswoo-selectEachLineCount></span> ：</span>
	            <select style="float:left;" fanswoo-selectEachLineMaster="class2">
	                <option value="">沒有分類標籤</option>
	                <option value="A">A</option>
	                <option value="B">B</option>
	            </select>
	            <span fanswoo-selectEachLineSlave="class2">
	                <select style="display:none;" fanswoo-selectEachLineMaster="class3" fanswoo-selectValue="A" fanswoo-selectName="classids_Arr[]">
	                    <option value="">沒有分類標籤</option>
	                    <option value="A1">A1</option>
	                    <option value="A2">A2</option>
	                </select>
	                <span fanswoo-selectEachLineSlave="class3">
	                    <select style="display:none;" fanswoo-selectValue="A1" fanswoo-selectEachLineMaster="class4" fanswoo-selectName="classids_Arr[]">
	                        <option value="">沒有分類標籤</option>
	                        <option value="C1">C1</option>
	                        <option value="C2">C2</option>
	                    </select>
	                    <span fanswoo-selectEachLineSlave="class4">
	                        <select style="display:none;" fanswoo-selectValue="C1" fanswoo-selectName="classids_Arr[]">
	                            <option value="">沒有分類標籤</option>
	                            <option value="E1">E1</option>
	                            <option value="E2">E2</option>
	                        </select>
	                        <select style="display:none;" fanswoo-selectValue="C2" fanswoo-selectName="classids_Arr[]">
	                            <option value="">沒有分類標籤</option>
	                            <option value="E3">E3</option>
	                            <option value="E4">E4</option>
	                        </select>
	                    </span>
	                    <select style="display:none;" fanswoo-selectValue="A2" fanswoo-selectName="classids_Arr[]">
	                        <option value="">沒有分類標籤</option>
	                        <option value="C3">C3</option>
	                        <option value="C4">C4</option>
	                    </select>
	                </span>
	                <select style="display:none;" fanswoo-selectEachLineMaster="class3" fanswoo-selectValue="B" fanswoo-selectName="classids_Arr[]">
	                    <option value="">沒有分類標籤</option>
	                    <option value="B1">B1</option>
	                    <option value="B2">B2</option>
	                </select>
	                <span fanswoo-selectEachLineSlave="class3">
	                    <select style="display:none;" fanswoo-selectValue="B1" fanswoo-selectName="classids_Arr[]">
	                        <option value="">沒有分類標籤</option>
	                        <option value="D1">D1</option>
	                        <option value="D2">D2</option>
	                    </select>
	                    <select style="display:none;" fanswoo-selectValue="B2" fanswoo-selectName="classids_Arr[]">
	                        <option value="">沒有分類標籤</option>
	                        <option value="D3">D3</option>
	                        <option value="D4">D4</option>
	                    </select>
	                </span>
	            </span>
	        </div>
	    </div>
	     */
	    //多分類標籤自動新增
	    $('[fanswoo-selectEachDiv]').each(function(key, value){
	        $(this).find('[fanswoo-selectEachLineCount]').each(function(key2, value2){
	            $(this).text(parseInt(key2) + 1);
	        });
	    });
	    //多層次選單新增移除
	    $(document).on('change', '[fanswoo-selectEachLineMaster]', function(){
	        var select_each_line_master = $(this).attr('fanswoo-selectEachLineMaster');
	        var select_each_div = $(this).parents('[fanswoo-selectEachDiv]').attr('fanswoo-selectEachDiv');
	        if(select_each_line_master == select_each_div)
	        {
	            var $div = $(this).parents('[fanswoo-selectEachDiv]');
	            if($(this).find(":selected").val() !== '')
	            {
	                if($div.find("[fanswoo-selectEachLineMaster=" + select_each_line_master + "] :selected[value='']").size() === 0)
	                {
	                    $(this).parent('[fanswoo-selectEachLine]').clone().insertAfter($(this).parents('[fanswoo-selectEachDiv]').find('[fanswoo-selectEachLine]:last'));
	                    $div.find('[fanswoo-selectEachLine]:last select option').removeAttr('selected');
	                    $div.find('[fanswoo-selectEachLine]:last select').css('display', 'none');
	                    $div.find('[fanswoo-selectEachLine]:last select[fanswoo-selectEachLineMaster=' + select_each_line_master + ']').css('display', 'block');
	                    $div.find('[fanswoo-selectEachLineCount]').each(function(key, value){
	                        $(this).text(parseInt(key) + 1);
	                    });
	                }
	            }
	            else
	            {
	                var classid_select_box_count = $(this).parent('[fanswoo-selectEachLine]').find('[fanswoo-selectEachLineCount]').text();
	                $div.find('[fanswoo-selectEachLineCount]').each(function(key, value){
	                    if(key + 1 > classid_select_box_count)
	                    {
	                        $(this).text(parseInt(key));
	                    }
	                    else
	                    {
	                        $(this).text(parseInt(key) + 1);
	                    }
	                });
	                $(this).parent('[fanswoo-selectEachLine]').remove();
	            }
	        }
	        var select_value = $(this).val();
	        $('[fanswoo-selectEachLineSlave=' + select_each_line_master + ']').find('select').css('display', 'none');
	        $('[fanswoo-selectEachLineSlave=' + select_each_line_master + ']').find('select').removeAttr('name');
	        $('[fanswoo-selectEachLineSlave=' + select_each_line_master + ']').find('option').removeAttr('selected');
	        $('[fanswoo-selectEachLineSlave=' + select_each_line_master + ']').children('select[fanswoo-selectValue=' + select_value + ']').css('display', 'block');
	        $('[fanswoo-selectEachLineSlave=' + select_each_line_master + ']').children('select[fanswoo-selectValue=' + select_value + ']').attr('name', $('[fanswoo-selectEachLineSlave=' + select_each_line_master + '] > select[fanswoo-selectValue=' + select_value + ']').attr('fanswoo-selectName'));
	    });
		
		//fanswoo-imgLoading
		$.fn.imgLoading = function(_settings){
			var defaultSettings = {
				obj: 'document',
				callback: function() {}
			};
			var settings = $.extend(defaultSettings, _settings);
			var _this = this;
			var handler = function(){
				$(settings.obj).append("<span class='text'>Loading</span> <span class='number' data-number='0'>0</span> <span class='percent'>%</span>");
				var imgSize = 100 / parseInt($(_this).find("img").size());
				$(_this).find("img").each(function(){
					$(this).imagesLoaded(function(){
						$(settings.obj).children(".number").data("number", $(settings.obj).children(".number").data("number") + imgSize);
						$(settings.obj).children(".number").text(Math.floor($(settings.obj).children(".number").data("number")));
						if($(settings.obj).children(".number").text() >= 99){
							settings.callback();
						}
					}); 
				});
			}
			return this.each(handler);
		};
		
	});//jQuery ready over
	
	//jQuery.cookie();
	$.cookie = function(name, value, options) {
		if (typeof value != 'undefined') { // name and value given, set cookie
			options = options || {};
			if (value === null) {
				value = '';
				options = $.extend({}, options); // clone object since it's unexpected behavior if the expired property were changed
				options.expires = -1;
			}
			var expires = '';
			if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
				var date;
				if (typeof options.expires == 'number') {
					date = new Date();
					date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
				} else {
					date = options.expires;
				}
				expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
			}
			// NOTE Needed to parenthesize options.path and options.domain
			// in the following expressions, otherwise they evaluate to undefined
			// in the packed version for some reason...
			var path = options.path ? '; path=' + (options.path) : '';
			var domain = options.domain ? '; domain=' + (options.domain) : '';
			var secure = options.secure ? '; secure' : '';
			document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
		} else { // only name given, get cookie
			var cookieValue = null;
			if (document.cookie && document.cookie != '') {
				var cookies = document.cookie.split(';');
				for (var i = 0; i < cookies.length; i++) {
					var cookie = $.trim(cookies[i]);
					// Does this cookie string begin with the name we want?
					if (cookie.substring(0, name.length + 1) == (name + '=')) {
						cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
						break;
					}
				}
			}
			return cookieValue;
		}
	}
})(jQuery);//$ > jQuery over

//fanswoo Class
function fanswoo(){
	var $ = jQuery;//jQuery $ > jQuery Start
	
	//跑馬燈
	this.slideLine = function(box,stf,delay,speed,h,mouse){
		//box為標籤名稱、stf為內標籤類型，delay為延遲毫秒數、speed速度、h高度，mouse=1的話，滑鼠經過會停，pause=0滑鼠經過無效
		//取得id
		var box;
		var slideBox = document.getElementById(box);
		slideBox.scrollTop = h;
		//預設值 delay:幾毫秒滾動一次(1000毫秒=1秒)
		//       speed:數字越小越快，h:高度
		if(delay !== 0){
			var delay = delay||1000;
		}
		var speed = speed||20;
		var h = h||20;
		var tid = null,pause = false;
		var mouse = mouse||0;
		//setInterval跟setTimeout的用法可以咕狗研究一下~
		var s = function(){tid=setInterval(slide, speed);}
		//主要動作的地方
		var slide = function(){
			//當滑鼠移到上面的時候就會暫停
			if(pause) return;
			//滾動條往下滾動 數字越大會越快但是看起來越不連貫，所以這邊用1
			if($.browser.msie){
				slideBox.scrollTop += -10;//IE跑比較慢，所以更改
			}
			else{
				slideBox.scrollTop += -3;
			}
			//滾動到一個高度(h)的時候就停止
			if(slideBox.scrollTop%h == 0){
				//跟setInterval搭配使用的
				clearInterval(tid);
				//將剛剛滾動上去的前一項加回到整列的最後一項
				slideBox.insertBefore(slideBox.getElementsByTagName(stf)[slideBox.getElementsByTagName(stf).length-1],slideBox.getElementsByTagName(stf)[0]);
				//再重設滾動條到最上面
				slideBox.scrollTop = h;
				//延遲多久再執行一次
				setTimeout(s, delay);
			}
		}
		//滑鼠移上去會暫停 移走會繼續動
		if(mouse == 1){
			slideBox.onmouseover = function(){pause=true;}
			slideBox.onmouseout = function(){pause=false;}
		}
		//起始的地方，沒有這個就不會動囉
		setTimeout(s, delay);
	}
	
	//Mywindow視窗class
	myWindowOpenNow = false;
	this.MyWindow = function(){
		var _this = this;
		var bodyScrollTop = 0;//攝影機位置紀錄
		//開啟mywindow視窗
		this.myWindowOpen = function(_id, _myWindowMajorWidth){
			var id = _id || '';
			var myWindowMajor = '#' + id + '.myWindowMajor';
			if(myWindowOpenNow == false){
				myWindowOpenNow = true;
			}
			else{
				return false;
			}
			$("<div>").addClass("myWindowShadow").insertAfter(".myWindowMajor");
			$("<div>").addClass("myWindowBg myWindowClose").insertAfter(".myWindowMajor");
			$("body").css("overflow-y","scroll");
			if($.browser.msie){
				$(myWindowMajor).css("display","block");
				$(".myWindowShadow").css("display","block");
				$(".myWindowBg").css("display","block");
			}
			else{
				$(myWindowMajor).fadeIn(300);
				$(".myWindowShadow").fadeIn(300);
				$(".myWindowBg").fadeIn(300);
			}
			//計算主要視窗數據
			var myWindowMajorWidth = _myWindowMajorWidth || 400;
			var myWindowMajorHeight = $(myWindowMajor).height();
			var myWindowMajorMarginLeft = parseInt('-' + myWindowMajorWidth) / 2 + 'px';
			var myWindowMajorMarginTop = parseInt('-' + myWindowMajorHeight) / 2 + 'px';
			//計算背景視窗數據
			var myWindowBgWidth = (parseInt(myWindowMajorWidth) + 20 ) + 'px';
			var myWindowBgHeight = (parseInt(myWindowMajorHeight) + 20 ) + 'px';
			var myWindowBgMarginLeft = (((parseInt('-' + myWindowMajorWidth) + 20 ) / 2 ) -20) + 'px';
			var myWindowBgMarginTop = (((parseInt('-' + myWindowMajorHeight) + 20 ) / 2 ) -20) + 'px';
			//改變視窗大小位置
			$(myWindowMajor).css({"width":myWindowMajorWidth,"height":myWindowMajorHeight,"margin-left":myWindowMajorMarginLeft,"margin-top":myWindowMajorMarginTop});
			$(".myWindowShadow").css({"width":myWindowBgWidth,"height":myWindowBgHeight,"margin-left":myWindowBgMarginLeft,"margin-top":myWindowBgMarginTop});
			//改變body能見度與捲軸
			this.bodyScrollTop = $(window).scrollTop();
			var windowHeight = $(window).height();
			var windowWidth = $(window).width();
			var windowMargin = parseInt('-' + windowWidth) / 2;
			$(".body").css({"overflow-y":"hidden", "position":"fixed", "width":windowWidth, "height":windowHeight});
			$(".body").scrollTop(this.bodyScrollTop);
		}
		//mywindow關閉事件
		$(document).on('click', '.myWindowClose', function(event){
			_this.close();
		});
		//mywindow關閉事件
		$(document).on('click', '.myWindowSendSubmit', function(event){
			_this.close();
		});
		//mywindow關閉事件
		$(document).on('click', '.myWindowCancelSubmit', function(event){
			_this.close();
		});
		this.close = function(){
			myWindowOpenNow = false;
			$("body").css("overflow-y","auto");
			if($.browser.msie){
				$(".myWindowMajor").css("display","none");
				$(".myWindowShadow").css("display","none");
				$(".myWindowBg").css("display","none");
			}
			else{
				$(".myWindowMajor").fadeOut(300);
				$(".myWindowShadow").fadeOut(300);
				$(".myWindowBg").fadeOut(300);
			}
			//改變body能見度與捲軸
			$(".body").css({"overflow-y":"visible","position":"static","margin":"0","height":"auto"});
			$(window).scrollTop(_this.bodyScrollTop);
			fanswoo.delayExecute(
				function() {
					return true;
				},
				function() {
					$(".myWindowMajor").remove();
					$(".myWindowShadow").remove();
					$(".myWindowBg").remove();
				}//如果已經登出就重新整理
			);
		}
	}
	
	//檢查XXX，如果XXX已經變化就執行XXX的函式
	this.delayExecute = function(check, proc, chkInterval) {
		//default interval = 500ms
		var x = chkInterval || 500;
		var hnd = window.setInterval(function (){
			//if check() return true, 
			//stop timer and execute proc()
			if (check()) {
				window.clearInterval(hnd);
				proc();
			}
		}, x);
	}
    
    
    this.check_href_action = function(message, url){
        var message;
        var url;
        var answer = confirm(message);
        if (answer){
            location.href = url;
        }
    }
	
	//判斷瀏覽器類型
	this.detectBrowser = function(){
		var sAgent = navigator.userAgent.toLowerCase();
		if(sAgent.indexOf("msie") != -1){
			return 'ie';
		}
		else if(sAgent.indexOf("firefox") != -1){
			return 'firefox';
		}
		else if(sAgent.indexOf("chrome") != -1){
			return 'chrome';
		}
		else if(sAgent.indexOf("safari") != -1){
			return 'safari';
		}
		else if(sAgent.indexOf("opera") != -1){
			return 'opera';
		}
		else if(sAgent.indexOf("netscape") != -1){
			return 'netscape';
		}
		else{
			return 'other';
		}
	}
	
	//倒數計時器
	this.countdownTimer = function(jQuerySelector, time){
		var padZero = function(a,b){//倒數計時器補零
			return a.toString().length >= b ? a : padZero("0" + a, b);
		}
		var jQuerySelector;
		if(time !== null){
			var time = time - 1;
		}
		else{
			var time = $(jQuerySelector).attr('fanswoo-countdownTimer') - 1;
		}
		$(jQuerySelector).attr('fanswoo-countdownTimer', time);
		if(time >= 0){
			var c = padZero(parseInt(time / 3600, 10), 2);
			var d = padZero(parseInt(time % 3600 / 60, 10), 2);
			var e = padZero(parseInt(time % 60, 10), 2);
			$(jQuerySelector).html("<b class=hour>" + c + "</b>時 <b class=minute>" + d + "</b>分 <b class=second>" + e + "</b>秒");
			setTimeout(function(){
				fanswoo.countdownTimer(jQuerySelector, time);
			}, 1000);
		}
	}
	
	//取得網址參數
	var queryString = window.top.location.search.substring(1);
	function getParameter(queryString, parameterName){
		// Add "=" to the parameter name (i.e. parameterName=value)
		var parameterName = parameterName + "=";
		if(queryString.length > 0) {
			// Find the beginning of the string
			begin = queryString.indexOf(parameterName);
			// If the parameter name is not found, skip it, otherwise return the value
			if (begin != -1){
			// Add the length (integer) to the beginning
				begin += parameterName.length;
				// Multiple parameters are separated by the "&" sign
				end = queryString.indexOf("&", begin);
				if (end == -1) {
					end = queryString.length
				}
				// Return the string
				return unescape(queryString.substring(begin, end));
			}
			// Return "null" if no parameter has been found
			return "null";
		}
	}
}
fanswoo = new fanswoo();