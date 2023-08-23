/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));
/*
 * metismenu - v1.1.3
 * Easy menu jQuery plugin for Twitter Bootstrap 3
 * https://github.com/onokumus/metisMenu
 *
 * Made by Osman Nuri Okumus
 * Under MIT License
 */
;(function($, window, document, undefined) {

    var pluginName = "metisMenu",
        defaults = {
            toggle: true,
            doubleTapToGo: false
        };

    function Plugin(element, options) {
        this.element = $(element);
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }

    Plugin.prototype = {
        init: function() {

            var $this = this.element,
                $toggle = this.settings.toggle,
                obj = this;

            if (this.isIE() <= 9) {
                $this.find("li.active").has("ul").children("ul").collapse("show");
                $this.find("li").not(".active").has("ul").children("ul").collapse("hide");
            } else {
                $this.find("li.active").has("ul").children("ul").addClass("collapse in");
                $this.find("li").not(".active").has("ul").children("ul").addClass("collapse");
            }

            //add the "doubleTapToGo" class to active items if needed
            if (obj.settings.doubleTapToGo) {
                $this.find("li.active").has("ul").children("a").addClass("doubleTapToGo");
            }

            $this.find("li").has("ul").children("a").on("click" + "." + pluginName, function(e) {
                e.preventDefault();

                //Do we need to enable the double tap
                if (obj.settings.doubleTapToGo) {

                    //if we hit a second time on the link and the href is valid, navigate to that url
                    if (obj.doubleTapToGo($(this)) && $(this).attr("href") !== "#" && $(this).attr("href") !== "") {
                        e.stopPropagation();
                        document.location = $(this).attr("href");
                        return;
                    }
                }

                $(this).parent("li").toggleClass("active").children("ul").collapse("toggle");

                if ($toggle) {
                    $(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide");
                }

            });
        },

        isIE: function() { //https://gist.github.com/padolsey/527683
            var undef,
                v = 3,
                div = document.createElement("div"),
                all = div.getElementsByTagName("i");

            while (
                div.innerHTML = "<!--[if gt IE " + (++v) + "]><i></i><![endif]-->",
                    all[0]
                ) {
                return v > 4 ? v : undef;
            }
        },

        //Enable the link on the second click.
        doubleTapToGo: function(elem) {
            var $this = this.element;

            //if the class "doubleTapToGo" exists, remove it and return
            if (elem.hasClass("doubleTapToGo")) {
                elem.removeClass("doubleTapToGo");
                return true;
            }

            //does not exists, add a new class and return false
            if (elem.parent().children("ul").length) {
                //first remove all other class
                $this.find(".doubleTapToGo").removeClass("doubleTapToGo");
                //add the class on the current element
                elem.addClass("doubleTapToGo");
                return false;
            }
        },

        remove: function() {
            this.element.off("." + pluginName);
            this.element.removeData(pluginName);
        }

    };

    $.fn[pluginName] = function(options) {
        this.each(function () {
            var el = $(this);
            if (el.data(pluginName)) {
                el.data(pluginName).remove();
            }
            el.data(pluginName, new Plugin(this, options));
        });
        return this;
    };

})(jQuery, window, document);
/*! Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 * 美化滚动条插件
 */
(function(f){jQuery.fn.extend({slimScroll:function(h){var a=f.extend({width:"auto",height:"250px",size:"4px",color:"#000",position:"right",distance:"1px",start:"top",opacity:0.4,alwaysVisible:!1,disableFadeOut:!1,railVisible:!1,railColor:"#333",railOpacity:0.2,railDraggable:!0,railClass:"slimScrollRail",barClass:"slimScrollBar",wrapperClass:"slimScrollDiv",allowPageScroll:!1,wheelStep:20,touchScrollStep:200,borderRadius:"7px",railBorderRadius:"7px"},h);this.each(function(){function r(d){if(s){d=d||
window.event;var c=0;d.wheelDelta&&(c=-d.wheelDelta/120);d.detail&&(c=d.detail/3);f(d.target||d.srcTarget||d.srcElement).closest("."+a.wrapperClass).is(b.parent())&&m(c,!0);d.preventDefault&&!k&&d.preventDefault();k||(d.returnValue=!1)}}function m(d,f,h){k=!1;var e=d,g=b.outerHeight()-c.outerHeight();f&&(e=parseInt(c.css("top"))+d*parseInt(a.wheelStep)/100*c.outerHeight(),e=Math.min(Math.max(e,0),g),e=0<d?Math.ceil(e):Math.floor(e),c.css({top:e+"px"}));l=parseInt(c.css("top"))/(b.outerHeight()-c.outerHeight());
e=l*(b[0].scrollHeight-b.outerHeight());h&&(e=d,d=e/b[0].scrollHeight*b.outerHeight(),d=Math.min(Math.max(d,0),g),c.css({top:d+"px"}));b.scrollTop(e);b.trigger("slimscrolling",~~e);v();p()}function C(){window.addEventListener?(this.addEventListener("DOMMouseScroll",r,!1),this.addEventListener("mousewheel",r,!1),this.addEventListener("MozMousePixelScroll",r,!1)):document.attachEvent("onmousewheel",r)}function w(){u=Math.max(b.outerHeight()/b[0].scrollHeight*b.outerHeight(),D);c.css({height:u+"px"});
var a=u==b.outerHeight()?"none":"block";c.css({display:a})}function v(){w();clearTimeout(A);l==~~l?(k=a.allowPageScroll,B!=l&&b.trigger("slimscroll",0==~~l?"top":"bottom")):k=!1;B=l;u>=b.outerHeight()?k=!0:(c.stop(!0,!0).fadeIn("fast"),a.railVisible&&g.stop(!0,!0).fadeIn("fast"))}function p(){a.alwaysVisible||(A=setTimeout(function(){a.disableFadeOut&&s||(x||y)||(c.fadeOut("slow"),g.fadeOut("slow"))},1E3))}var s,x,y,A,z,u,l,B,D=30,k=!1,b=f(this);if(b.parent().hasClass(a.wrapperClass)){var n=b.scrollTop(),
c=b.parent().find("."+a.barClass),g=b.parent().find("."+a.railClass);w();if(f.isPlainObject(h)){if("height"in h&&"auto"==h.height){b.parent().css("height","auto");b.css("height","auto");var q=b.parent().parent().height();b.parent().css("height",q);b.css("height",q)}if("scrollTo"in h)n=parseInt(a.scrollTo);else if("scrollBy"in h)n+=parseInt(a.scrollBy);else if("destroy"in h){c.remove();g.remove();b.unwrap();return}m(n,!1,!0)}}else{a.height="auto"==a.height?b.parent().height():a.height;n=f("<div></div>").addClass(a.wrapperClass).css({position:"relative",width:a.width,height:a.height});b.css({width:a.width,height:a.height});var g=f("<div></div>").addClass(a.railClass).css({width:a.size,height:"100%",position:"absolute",top:0,display:a.alwaysVisible&&a.railVisible?"block":"none","border-radius":a.railBorderRadius,background:a.railColor,opacity:a.railOpacity,zIndex:90}),c=f("<div></div>").addClass(a.barClass).css({background:a.color,width:a.size,position:"absolute",top:0,opacity:a.opacity,display:a.alwaysVisible?
"block":"none","border-radius":a.borderRadius,BorderRadius:a.borderRadius,MozBorderRadius:a.borderRadius,WebkitBorderRadius:a.borderRadius,zIndex:99}),q="right"==a.position?{right:a.distance}:{left:a.distance};g.css(q);c.css(q);b.wrap(n);b.parent().append(c);b.parent().append(g);a.railDraggable&&c.bind("mousedown",function(a){var b=f(document);y=!0;t=parseFloat(c.css("top"));pageY=a.pageY;b.bind("mousemove.slimscroll",function(a){currTop=t+a.pageY-pageY;c.css("top",currTop);m(0,c.position().top,!1)});
b.bind("mouseup.slimscroll",function(a){y=!1;p();b.unbind(".slimscroll")});return!1}).bind("selectstart.slimscroll",function(a){a.stopPropagation();a.preventDefault();return!1});g.hover(function(){v()},function(){p()});c.hover(function(){x=!0},function(){x=!1});b.hover(function(){s=!0;v();p()},function(){s=!1;p()});b.bind("touchstart",function(a,b){a.originalEvent.touches.length&&(z=a.originalEvent.touches[0].pageY)});b.bind("touchmove",function(b){k||b.originalEvent.preventDefault();b.originalEvent.touches.length&&
(m((z-b.originalEvent.touches[0].pageY)/a.touchScrollStep,!0),z=b.originalEvent.touches[0].pageY)});w();"bottom"===a.start?(c.css({top:b.outerHeight()-c.outerHeight()}),m(0,!0)):"top"!==a.start&&(m(f(a.start).position().top,null,!0),a.alwaysVisible||c.hide());C()}});return this}});jQuery.fn.extend({slimscroll:jQuery.fn.slimScroll})})(jQuery);
/**
 * baiduTemplate简单好用的Javascript模板引擎 1.0.6 版本
 * http://baidufe.github.com/BaiduTemplate
 * 开源协议：BSD License
 * 浏览器环境占用命名空间 baidu.template ，nodejs环境直接安装 npm install baidutemplate
 * @param str{String} dom结点ID，或者模板string
 * @param data{Object} 需要渲染的json对象，可以为空。当data为{}时，仍然返回html。
 * @return 如果无data，直接返回编译后的函数；如果有data，返回html。
 * @author wangxiao 
 * @email 1988wangxiao@gmail.com
*/

;(function(window){

    //取得浏览器环境的baidu命名空间，非浏览器环境符合commonjs规范exports出去
    //修正在nodejs环境下，采用baidu.template变量名
    var baidu = typeof module === 'undefined' ? (window.baidu = window.baidu || {}) : module.exports;

    //模板函数（放置于baidu.template命名空间下）
    baidu.template = function(str, data){

        //检查是否有该id的元素存在，如果有元素则获取元素的innerHTML/value，否则认为字符串为模板
        var fn = (function(){

            //判断如果没有document，则为非浏览器环境
            if(!window.document){
                return bt._compile(str);
            };

            //HTML5规定ID可以由任何不包含空格字符的字符串组成
            var element = document.getElementById(str);
            if (element) {
                    
                //取到对应id的dom，缓存其编译后的HTML模板函数
                if (bt.cache[str]) {
                    return bt.cache[str];
                };

                //textarea或input则取value，其它情况取innerHTML
                var html = /^(textarea|input)$/i.test(element.nodeName) ? element.value : element.innerHTML;
                return bt._compile(html);

            }else{

                //是模板字符串，则生成一个函数
                //如果直接传入字符串作为模板，则可能变化过多，因此不考虑缓存
                return bt._compile(str);
            };

        })();

        //有数据则返回HTML字符串，没有数据则返回函数 支持data={}的情况
        var result = bt._isObject(data) ? fn( data ) : fn;
        fn = null;

        return result;
    };

    //取得命名空间 baidu.template
    var bt = baidu.template;

    //标记当前版本
    bt.versions = bt.versions || [];
    bt.versions.push('1.0.6');

    //缓存  将对应id模板生成的函数缓存下来。
    bt.cache = {};
    
    //自定义分隔符，可以含有正则中的字符，可以是HTML注释开头 <! !>
    bt.LEFT_DELIMITER = bt.LEFT_DELIMITER||'<%';
    bt.RIGHT_DELIMITER = bt.RIGHT_DELIMITER||'%>';

    //自定义默认是否转义，默认为默认自动转义
    bt.ESCAPE = true;

    //HTML转义
    bt._encodeHTML = function (source) {
        return String(source)
            .replace(/&/g,'&amp;')
            .replace(/</g,'&lt;')
            .replace(/>/g,'&gt;')
            .replace(/\\/g,'&#92;')
            .replace(/"/g,'&quot;')
            .replace(/'/g,'&#39;');
    };

    //转义影响正则的字符
    bt._encodeReg = function (source) {
        return String(source).replace(/([.*+?^=!:${}()|[\]/\\])/g,'\\$1');
    };

    //转义UI UI变量使用在HTML页面标签onclick等事件函数参数中
    bt._encodeEventHTML = function (source) {
        return String(source)
            .replace(/&/g,'&amp;')
            .replace(/</g,'&lt;')
            .replace(/>/g,'&gt;')
            .replace(/"/g,'&quot;')
            .replace(/'/g,'&#39;')
            .replace(/\\\\/g,'\\')
            .replace(/\\\//g,'\/')
            .replace(/\\n/g,'\n')
            .replace(/\\r/g,'\r');
    };

    //将字符串拼接生成函数，即编译过程(compile)
    bt._compile = function(str){
        var funBody = "var _template_fun_array=[];\nvar fn=(function(__data__){\nvar _template_varName='';\nfor(name in __data__){\n_template_varName+=('var '+name+'=__data__[\"'+name+'\"];');\n};\neval(_template_varName);\n_template_fun_array.push('"+bt._analysisStr(str)+"');\n_template_varName=null;\n})(_template_object);\nfn = null;\nreturn _template_fun_array.join('');\n";
        return new Function("_template_object",funBody);
    };

    //判断是否是Object类型
    bt._isObject = function (source) {
        return 'function' === typeof source || !!(source && 'object' === typeof source);
    };

    //解析模板字符串
    bt._analysisStr = function(str){

        //取得分隔符
        var _left_ = bt.LEFT_DELIMITER;
        var _right_ = bt.RIGHT_DELIMITER;

        //对分隔符进行转义，支持正则中的元字符，可以是HTML注释 <!  !>
        var _left = bt._encodeReg(_left_);
        var _right = bt._encodeReg(_right_);

        str = String(str)
            
            //去掉分隔符中js注释
            .replace(new RegExp("("+_left+"[^"+_right+"]*)//.*\n","g"), "$1")

            //去掉注释内容  <%* 这里可以任意的注释 *%>
            //默认支持HTML注释，将HTML注释匹配掉的原因是用户有可能用 <! !>来做分割符
            .replace(new RegExp("<!--.*?-->", "g"),"")
            .replace(new RegExp(_left+"\\*.*?\\*"+_right, "g"),"")

            //把所有换行去掉  \r回车符 \t制表符 \n换行符
            .replace(new RegExp("[\\r\\t\\n]","g"), "")

            //用来处理非分隔符内部的内容中含有 斜杠 \ 单引号 ‘ ，处理办法为HTML转义
            .replace(new RegExp(_left+"(?:(?!"+_right+")[\\s\\S])*"+_right+"|((?:(?!"+_left+")[\\s\\S])+)","g"),function (item, $1) {
                var str = '';
                if($1){

                    //将 斜杠 单引 HTML转义
                    str = $1.replace(/\\/g,"&#92;").replace(/'/g,'&#39;');
                    while(/<[^<]*?&#39;[^<]*?>/g.test(str)){

                        //将标签内的单引号转义为\r  结合最后一步，替换为\'
                        str = str.replace(/(<[^<]*?)&#39;([^<]*?>)/g,'$1\r$2')
                    };
                }else{
                    str = item;
                }
                return str ;
            });


        str = str 
            //定义变量，如果没有分号，需要容错  <%var val='test'%>
            .replace(new RegExp("("+_left+"[\\s]*?var[\\s]*?.*?[\\s]*?[^;])[\\s]*?"+_right,"g"),"$1;"+_right_)

            //对变量后面的分号做容错(包括转义模式 如<%:h=value%>)  <%=value;%> 排除掉函数的情况 <%fun1();%> 排除定义变量情况  <%var val='test';%>
            .replace(new RegExp("("+_left+":?[hvu]?[\\s]*?=[\\s]*?[^;|"+_right+"]*?);[\\s]*?"+_right,"g"),"$1"+_right_)

            //按照 <% 分割为一个个数组，再用 \t 和在一起，相当于将 <% 替换为 \t
            //将模板按照<%分为一段一段的，再在每段的结尾加入 \t,即用 \t 将每个模板片段前面分隔开
            .split(_left_).join("\t");

        //支持用户配置默认是否自动转义
        if(bt.ESCAPE){
            str = str

                //找到 \t=任意一个字符%> 替换为 ‘，任意字符,'
                //即替换简单变量  \t=data%> 替换为 ',data,'
                //默认HTML转义  也支持HTML转义写法<%:h=value%>  
                .replace(new RegExp("\\t=(.*?)"+_right,"g"),"',typeof($1) === 'undefined'?'':baidu.template._encodeHTML($1),'");
        }else{
            str = str
                
                //默认不转义HTML转义
                .replace(new RegExp("\\t=(.*?)"+_right,"g"),"',typeof($1) === 'undefined'?'':$1,'");
        };

        str = str

            //支持HTML转义写法<%:h=value%>  
            .replace(new RegExp("\\t:h=(.*?)"+_right,"g"),"',typeof($1) === 'undefined'?'':baidu.template._encodeHTML($1),'")

            //支持不转义写法 <%:=value%>和<%-value%>
            .replace(new RegExp("\\t(?::=|-)(.*?)"+_right,"g"),"',typeof($1)==='undefined'?'':$1,'")

            //支持url转义 <%:u=value%>
            .replace(new RegExp("\\t:u=(.*?)"+_right,"g"),"',typeof($1)==='undefined'?'':encodeURIComponent($1),'")

            //支持UI 变量使用在HTML页面标签onclick等事件函数参数中  <%:v=value%>
            .replace(new RegExp("\\t:v=(.*?)"+_right,"g"),"',typeof($1)==='undefined'?'':baidu.template._encodeEventHTML($1),'")

            //将字符串按照 \t 分成为数组，在用'); 将其合并，即替换掉结尾的 \t 为 ');
            //在if，for等语句前面加上 '); ，形成 ');if  ');for  的形式
            .split("\t").join("');")

            //将 %> 替换为_template_fun_array.push('
            //即去掉结尾符，生成函数中的push方法
            //如：if(list.length=5){%><h2>',list[4],'</h2>');}
            //会被替换为 if(list.length=5){_template_fun_array.push('<h2>',list[4],'</h2>');}
            .split(_right_).join("_template_fun_array.push('")

            //将 \r 替换为 \
            .split("\r").join("\\'");

        return str;
    };

})(window);
﻿// -----------------------------------------------------------------------
// Eros Fratini - eros@recoding.it
// jqprint 0.3
//
// - 19/06/2009 - some new implementations, added Opera support
// - 11/05/2009 - first sketch
//
// Printing plug-in for jQuery, evolution of jPrintArea: http://plugins.jquery.com/project/jPrintArea
// requires jQuery 1.3.x
//
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
//------------------------------------------------------------------------

(function($) {
    var opt;

    $.fn.jqprint = function (options) {
        opt = $.extend({}, $.fn.jqprint.defaults, options);

        var $element = (this instanceof jQuery) ? this : $(this);
        
        if (opt.operaSupport && $.browser.opera) 
        { 
            var tab = window.open("","jqPrint-preview");
            tab.document.open();

            var doc = tab.document;
        }
        else 
        {
            var $iframe = $("<iframe  />");
        
            if (!opt.debug) { $iframe.css({ position: "absolute", width: "0px", height: "0px", left: "-600px", top: "-600px" }); }

            $iframe.appendTo("body");
            var doc = $iframe[0].contentWindow.document;
        }
        
        if (opt.importCSS)
        {
            if ($("link[media=print]").length > 0) 
            {
                $("link[media=print]").each( function() {
                    doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' media='print' />");
                });
            }
            else 
            {
                $("link").each( function() {
                    doc.write("<link type='text/css' rel='stylesheet' href='" + $(this).attr("href") + "' />");
                });
            }
        }
        
        if (opt.printContainer) { doc.write($element.outer()); }
        else { $element.each( function() { doc.write($(this).html()); }); }
        
        doc.close();
        
        (opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).focus();
        setTimeout( function() { (opt.operaSupport && $.browser.opera ? tab : $iframe[0].contentWindow).print(); if (tab) { tab.close(); } }, 1000);
    }
    
    $.fn.jqprint.defaults = {
		debug: false,
		importCSS: true, 
		printContainer: true,
		operaSupport: true
	};

    // Thanks to 9__, found at http://users.livejournal.com/9__/380664.html
    jQuery.fn.outer = function() {
      return $($('<div></div>').html(this.clone())).html();
    } 
})(jQuery);/* ----------------------------------------------
 * bootstrap-datepicker.js
 * Repo: https://github.com/eternicode/bootstrap-datepicker/
 * Demo: http://eternicode.github.io/bootstrap-datepicker/
 * Docs: http://bootstrap-datepicker.readthedocs.org/
 * Forked from http://www.eyecon.ro/bootstrap-datepicker
 * ----------------------------------------------
 * Started by Stefan Petre; improvements by Andrew Rowls + contributors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ---------------------------------------------- */

(function($, undefined){

	var $window = $(window);

	function UTCDate(){
		return new Date(Date.UTC.apply(Date, arguments));
	}
	function UTCToday(){
		var today = new Date();
		return UTCDate(today.getFullYear(), today.getMonth(), today.getDate());
	}
	function alias(method){
		return function(){
			return this[method].apply(this, arguments);
		};
	}

	var DateArray = (function(){
		var extras = {
			get: function(i){
				return this.slice(i)[0];
			},
			contains: function(d){
				// Array.indexOf is not cross-browser;
				// $.inArray doesn't work with Dates
				var val = d && d.valueOf();
				for (var i=0, l=this.length; i < l; i++)
					if (this[i].valueOf() === val)
						return i;
				return -1;
			},
			remove: function(i){
				this.splice(i,1);
			},
			replace: function(new_array){
				if (!new_array)
					return;
				if (!$.isArray(new_array))
					new_array = [new_array];
				this.clear();
				this.push.apply(this, new_array);
			},
			clear: function(){
				this.splice(0);
			},
			copy: function(){
				var a = new DateArray();
				a.replace(this);
				return a;
			}
		};

		return function(){
			var a = [];
			a.push.apply(a, arguments);
			$.extend(a, extras);
			return a;
		};
	})();


	// Picker object

	var Datepicker = function(element, options){
		this.dates = new DateArray();
		this.viewDate = UTCToday();
		this.focusDate = null;

		this._process_options(options);

		this.element = $(element);
		this.isInline = false;
		this.isInput = this.element.is('input');
		this.component = this.element.is('.date') ? this.element.find('.add-on, .input-group-addon, .btn') : false;
		this.hasInput = this.component && this.element.find('input').length;
		if (this.component && this.component.length === 0)
			this.component = false;

		this.picker = $(DPGlobal.template);
		this._buildEvents();
		this._attachEvents();

		if (this.isInline){
			this.picker.addClass('datepicker-inline').appendTo(this.element);
		}
		else {
			this.picker.addClass('datepicker-dropdown dropdown-menu');
		}

		if (this.o.rtl){
			this.picker.addClass('datepicker-rtl');
		}

		this.viewMode = this.o.startView;

		if (this.o.calendarWeeks)
			this.picker.find('tfoot th.today')
						.attr('colspan', function(i, val){
							return parseInt(val) + 1;
						});

		this._allow_update = false;

		this.setStartDate(this._o.startDate);
		this.setEndDate(this._o.endDate);
		this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled);

		this.fillDow();
		this.fillMonths();

		this._allow_update = true;

		this.update();
		this.showMode();

		if (this.isInline){
			this.show();
		}
	};

	Datepicker.prototype = {
		constructor: Datepicker,

		_process_options: function(opts){
			// Store raw options for reference
			this._o = $.extend({}, this._o, opts);
			// Processed options
			var o = this.o = $.extend({}, this._o);

			// Check if "de-DE" style date is available, if not language should
			// fallback to 2 letter code eg "de"
			var lang = o.language;
			if (!dates[lang]){
				lang = lang.split('-')[0];
				if (!dates[lang])
					lang = defaults.language;
			}
			o.language = lang;

			switch (o.startView){
				case 2:
				case 'decade':
					o.startView = 2;
					break;
				case 1:
				case 'year':
					o.startView = 1;
					break;
				default:
					o.startView = 0;
			}

			switch (o.minViewMode){
				case 1:
				case 'months':
					o.minViewMode = 1;
					break;
				case 2:
				case 'years':
					o.minViewMode = 2;
					break;
				default:
					o.minViewMode = 0;
			}

			o.startView = Math.max(o.startView, o.minViewMode);

			// true, false, or Number > 0
			if (o.multidate !== true){
				o.multidate = Number(o.multidate) || false;
				if (o.multidate !== false)
					o.multidate = Math.max(0, o.multidate);
				else
					o.multidate = 1;
			}
			o.multidateSeparator = String(o.multidateSeparator);

			o.weekStart %= 7;
			o.weekEnd = ((o.weekStart + 6) % 7);

			var format = DPGlobal.parseFormat(o.format);
			if (o.startDate !== -Infinity){
				if (!!o.startDate){
					if (o.startDate instanceof Date)
						o.startDate = this._local_to_utc(this._zero_time(o.startDate));
					else
						o.startDate = DPGlobal.parseDate(o.startDate, format, o.language);
				}
				else {
					o.startDate = -Infinity;
				}
			}
			if (o.endDate !== Infinity){
				if (!!o.endDate){
					if (o.endDate instanceof Date)
						o.endDate = this._local_to_utc(this._zero_time(o.endDate));
					else
						o.endDate = DPGlobal.parseDate(o.endDate, format, o.language);
				}
				else {
					o.endDate = Infinity;
				}
			}

			o.daysOfWeekDisabled = o.daysOfWeekDisabled||[];
			if (!$.isArray(o.daysOfWeekDisabled))
				o.daysOfWeekDisabled = o.daysOfWeekDisabled.split(/[,\s]*/);
			o.daysOfWeekDisabled = $.map(o.daysOfWeekDisabled, function(d){
				return parseInt(d, 10);
			});

			var plc = String(o.orientation).toLowerCase().split(/\s+/g),
				_plc = o.orientation.toLowerCase();
			plc = $.grep(plc, function(word){
				return (/^auto|left|right|top|bottom$/).test(word);
			});
			o.orientation = {x: 'auto', y: 'auto'};
			if (!_plc || _plc === 'auto')
				; // no action
			else if (plc.length === 1){
				switch (plc[0]){
					case 'top':
					case 'bottom':
						o.orientation.y = plc[0];
						break;
					case 'left':
					case 'right':
						o.orientation.x = plc[0];
						break;
				}
			}
			else {
				_plc = $.grep(plc, function(word){
					return (/^left|right$/).test(word);
				});
				o.orientation.x = _plc[0] || 'auto';

				_plc = $.grep(plc, function(word){
					return (/^top|bottom$/).test(word);
				});
				o.orientation.y = _plc[0] || 'auto';
			}
		},
		_events: [],
		_secondaryEvents: [],
		_applyEvents: function(evs){
			for (var i=0, el, ch, ev; i < evs.length; i++){
				el = evs[i][0];
				if (evs[i].length === 2){
					ch = undefined;
					ev = evs[i][1];
				}
				else if (evs[i].length === 3){
					ch = evs[i][1];
					ev = evs[i][2];
				}
				el.on(ev, ch);
			}
		},
		_unapplyEvents: function(evs){
			for (var i=0, el, ev, ch; i < evs.length; i++){
				el = evs[i][0];
				if (evs[i].length === 2){
					ch = undefined;
					ev = evs[i][1];
				}
				else if (evs[i].length === 3){
					ch = evs[i][1];
					ev = evs[i][2];
				}
				el.off(ev, ch);
			}
		},
		_buildEvents: function(){
			if (this.isInput){ // single input
				this._events = [
					[this.element, {
						focus: $.proxy(this.show, this),
						keyup: $.proxy(function(e){
							if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
								this.update();
						}, this),
						keydown: $.proxy(this.keydown, this)
					}]
				];
			}
			else if (this.component && this.hasInput){ // component: input + button
				this._events = [
					// For components that are not readonly, allow keyboard nav
					[this.element.find('input'), {
						focus: $.proxy(this.show, this),
						keyup: $.proxy(function(e){
							if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
								this.update();
						}, this),
						keydown: $.proxy(this.keydown, this)
					}],
					[this.component, {
						click: $.proxy(this.show, this)
					}]
				];
			}
			else if (this.element.is('div')){  // inline datepicker
				this.isInline = true;
			}
			else {
				this._events = [
					[this.element, {
						click: $.proxy(this.show, this)
					}]
				];
			}
			this._events.push(
				// Component: listen for blur on element descendants
				[this.element, '*', {
					blur: $.proxy(function(e){
						this._focused_from = e.target;
					}, this)
				}],
				// Input: listen for blur on element
				[this.element, {
					blur: $.proxy(function(e){
						this._focused_from = e.target;
					}, this)
				}]
			);

			this._secondaryEvents = [
				[this.picker, {
					click: $.proxy(this.click, this)
				}],
				[$(window), {
					resize: $.proxy(this.place, this)
				}],
				[$(document), {
					'mousedown touchstart': $.proxy(function(e){
						// Clicked outside the datepicker, hide it
						if (!(
							this.element.is(e.target) ||
							this.element.find(e.target).length ||
							this.picker.is(e.target) ||
							this.picker.find(e.target).length
						)){
							this.hide();
						}
					}, this)
				}]
			];
		},
		_attachEvents: function(){
			this._detachEvents();
			this._applyEvents(this._events);
		},
		_detachEvents: function(){
			this._unapplyEvents(this._events);
		},
		_attachSecondaryEvents: function(){
			this._detachSecondaryEvents();
			this._applyEvents(this._secondaryEvents);
		},
		_detachSecondaryEvents: function(){
			this._unapplyEvents(this._secondaryEvents);
		},
		_trigger: function(event, altdate){
			var date = altdate || this.dates.get(-1),
				local_date = this._utc_to_local(date);

			this.element.trigger({
				type: event,
				date: local_date,
				dates: $.map(this.dates, this._utc_to_local),
				format: $.proxy(function(ix, format){
					if (arguments.length === 0){
						ix = this.dates.length - 1;
						format = this.o.format;
					}
					else if (typeof ix === 'string'){
						format = ix;
						ix = this.dates.length - 1;
					}
					format = format || this.o.format;
					var date = this.dates.get(ix);
					return DPGlobal.formatDate(date, format, this.o.language);
				}, this)
			});
		},

		show: function(){
			if (!this.isInline)
				this.picker.appendTo('body');
			this.picker.show();
			this.place();
			this._attachSecondaryEvents();
			this._trigger('show');
		},

		hide: function(){
			if (this.isInline)
				return;
			if (!this.picker.is(':visible'))
				return;
			this.focusDate = null;
			this.picker.hide().detach();
			this._detachSecondaryEvents();
			this.viewMode = this.o.startView;
			this.showMode();

			if (
				this.o.forceParse &&
				(
					this.isInput && this.element.val() ||
					this.hasInput && this.element.find('input').val()
				)
			)
				this.setValue();
			this._trigger('hide');
		},

		remove: function(){
			this.hide();
			this._detachEvents();
			this._detachSecondaryEvents();
			this.picker.remove();
			delete this.element.data().datepicker;
			if (!this.isInput){
				delete this.element.data().date;
			}
		},

		_utc_to_local: function(utc){
			return utc && new Date(utc.getTime() + (utc.getTimezoneOffset()*60000));
		},
		_local_to_utc: function(local){
			return local && new Date(local.getTime() - (local.getTimezoneOffset()*60000));
		},
		_zero_time: function(local){
			return local && new Date(local.getFullYear(), local.getMonth(), local.getDate());
		},
		_zero_utc_time: function(utc){
			return utc && new Date(Date.UTC(utc.getUTCFullYear(), utc.getUTCMonth(), utc.getUTCDate()));
		},

		getDates: function(){
			return $.map(this.dates, this._utc_to_local);
		},

		getUTCDates: function(){
			return $.map(this.dates, function(d){
				return new Date(d);
			});
		},

		getDate: function(){
			return this._utc_to_local(this.getUTCDate());
		},

		getUTCDate: function(){
			return new Date(this.dates.get(-1));
		},

		setDates: function(){
			var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
			this.update.apply(this, args);
			this._trigger('changeDate');
			this.setValue();
		},

		setUTCDates: function(){
			var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
			this.update.apply(this, $.map(args, this._utc_to_local));
			this._trigger('changeDate');
			this.setValue();
		},

		setDate: alias('setDates'),
		setUTCDate: alias('setUTCDates'),

		setValue: function(){
			var formatted = this.getFormattedDate();
			if (!this.isInput){
				if (this.component){
					this.element.find('input').val(formatted).change();
				}
			}
			else {
				this.element.val(formatted).change();
			}
		},

		getFormattedDate: function(format){
			if (format === undefined)
				format = this.o.format;

			var lang = this.o.language;
			return $.map(this.dates, function(d){
				return DPGlobal.formatDate(d, format, lang);
			}).join(this.o.multidateSeparator);
		},

		setStartDate: function(startDate){
			this._process_options({startDate: startDate});
			this.update();
			this.updateNavArrows();
		},

		setEndDate: function(endDate){
			this._process_options({endDate: endDate});
			this.update();
			this.updateNavArrows();
		},

		setDaysOfWeekDisabled: function(daysOfWeekDisabled){
			this._process_options({daysOfWeekDisabled: daysOfWeekDisabled});
			this.update();
			this.updateNavArrows();
		},

		place: function(){
			if (this.isInline)
				return;
			var calendarWidth = this.picker.outerWidth(),
				calendarHeight = this.picker.outerHeight(),
				visualPadding = 10,
				windowWidth = $window.width(),
				windowHeight = $window.height(),
				scrollTop = $window.scrollTop();

			var zIndex = parseInt(this.element.parents().filter(function(){
					return $(this).css('z-index') !== 'auto';
				}).first().css('z-index'))+10;
			var offset = this.component ? this.component.parent().offset() : this.element.offset();
			var height = this.component ? this.component.outerHeight(true) : this.element.outerHeight(false);
			var width = this.component ? this.component.outerWidth(true) : this.element.outerWidth(false);
			var left = offset.left,
				top = offset.top;

			this.picker.removeClass(
				'datepicker-orient-top datepicker-orient-bottom '+
				'datepicker-orient-right datepicker-orient-left'
			);

			if (this.o.orientation.x !== 'auto'){
				this.picker.addClass('datepicker-orient-' + this.o.orientation.x);
				if (this.o.orientation.x === 'right')
					left -= calendarWidth - width;
			}
			// auto x orientation is best-placement: if it crosses a window
			// edge, fudge it sideways
			else {
				// Default to left
				this.picker.addClass('datepicker-orient-left');
				if (offset.left < 0)
					left -= offset.left - visualPadding;
				else if (offset.left + calendarWidth > windowWidth)
					left = windowWidth - calendarWidth - visualPadding;
			}

			// auto y orientation is best-situation: top or bottom, no fudging,
			// decision based on which shows more of the calendar
			var yorient = this.o.orientation.y,
				top_overflow, bottom_overflow;
			if (yorient === 'auto'){
				top_overflow = -scrollTop + offset.top - calendarHeight;
				bottom_overflow = scrollTop + windowHeight - (offset.top + height + calendarHeight);
				if (Math.max(top_overflow, bottom_overflow) === bottom_overflow)
					yorient = 'top';
				else
					yorient = 'bottom';
			}
			this.picker.addClass('datepicker-orient-' + yorient);
			if (yorient === 'top')
				top += height;
			else
				top -= calendarHeight + parseInt(this.picker.css('padding-top'));

			this.picker.css({
				top: top,
				left: left,
				zIndex: zIndex
			});
		},

		_allow_update: true,
		update: function(){
			if (!this._allow_update)
				return;

			var oldDates = this.dates.copy(),
				dates = [],
				fromArgs = false;
			if (arguments.length){
				$.each(arguments, $.proxy(function(i, date){
					if (date instanceof Date)
						date = this._local_to_utc(date);
					dates.push(date);
				}, this));
				fromArgs = true;
			}
			else {
				dates = this.isInput
						? this.element.val()
						: this.element.data('date') || this.element.find('input').val();
				if (dates && this.o.multidate)
					dates = dates.split(this.o.multidateSeparator);
				else
					dates = [dates];
				delete this.element.data().date;
			}

			dates = $.map(dates, $.proxy(function(date){
				return DPGlobal.parseDate(date, this.o.format, this.o.language);
			}, this));
			dates = $.grep(dates, $.proxy(function(date){
				return (
					date < this.o.startDate ||
					date > this.o.endDate ||
					!date
				);
			}, this), true);
			this.dates.replace(dates);

			if (this.dates.length)
				this.viewDate = new Date(this.dates.get(-1));
			else if (this.viewDate < this.o.startDate)
				this.viewDate = new Date(this.o.startDate);
			else if (this.viewDate > this.o.endDate)
				this.viewDate = new Date(this.o.endDate);

			if (fromArgs){
				// setting date by clicking
				this.setValue();
			}
			else if (dates.length){
				// setting date by typing
				if (String(oldDates) !== String(this.dates))
					this._trigger('changeDate');
			}
			if (!this.dates.length && oldDates.length)
				this._trigger('clearDate');

			this.fill();
		},

		fillDow: function(){
			var dowCnt = this.o.weekStart,
				html = '<tr>';
			if (this.o.calendarWeeks){
				var cell = '<th class="cw">&nbsp;</th>';
				html += cell;
				this.picker.find('.datepicker-days thead tr:first-child').prepend(cell);
			}
			while (dowCnt < this.o.weekStart + 7){
				html += '<th class="dow">'+dates[this.o.language].daysMin[(dowCnt++)%7]+'</th>';
			}
			html += '</tr>';
			this.picker.find('.datepicker-days thead').append(html);
		},

		fillMonths: function(){
			var html = '',
			i = 0;
			while (i < 12){
				html += '<span class="month">'+dates[this.o.language].monthsShort[i++]+'</span>';
			}
			this.picker.find('.datepicker-months td').html(html);
		},

		setRange: function(range){
			if (!range || !range.length)
				delete this.range;
			else
				this.range = $.map(range, function(d){
					return d.valueOf();
				});
			this.fill();
		},

		getClassNames: function(date){
			var cls = [],
				year = this.viewDate.getUTCFullYear(),
				month = this.viewDate.getUTCMonth(),
				today = new Date();
			if (date.getUTCFullYear() < year || (date.getUTCFullYear() === year && date.getUTCMonth() < month)){
				cls.push('old');
			}
			else if (date.getUTCFullYear() > year || (date.getUTCFullYear() === year && date.getUTCMonth() > month)){
				cls.push('new');
			}
			if (this.focusDate && date.valueOf() === this.focusDate.valueOf())
				cls.push('focused');
			// Compare internal UTC date with local today, not UTC today
			if (this.o.todayHighlight &&
				date.getUTCFullYear() === today.getFullYear() &&
				date.getUTCMonth() === today.getMonth() &&
				date.getUTCDate() === today.getDate()){
				cls.push('today');
			}
			if (this.dates.contains(date) !== -1)
				cls.push('active');
			if (date.valueOf() < this.o.startDate || date.valueOf() > this.o.endDate ||
				$.inArray(date.getUTCDay(), this.o.daysOfWeekDisabled) !== -1){
				cls.push('disabled');
			}
			if (this.range){
				if (date > this.range[0] && date < this.range[this.range.length-1]){
					cls.push('range');
				}
				if ($.inArray(date.valueOf(), this.range) !== -1){
					cls.push('selected');
				}
			}
			return cls;
		},

		fill: function(){
			var d = new Date(this.viewDate),
				year = d.getUTCFullYear(),
				month = d.getUTCMonth(),
				startYear = this.o.startDate !== -Infinity ? this.o.startDate.getUTCFullYear() : -Infinity,
				startMonth = this.o.startDate !== -Infinity ? this.o.startDate.getUTCMonth() : -Infinity,
				endYear = this.o.endDate !== Infinity ? this.o.endDate.getUTCFullYear() : Infinity,
				endMonth = this.o.endDate !== Infinity ? this.o.endDate.getUTCMonth() : Infinity,
				todaytxt = dates[this.o.language].today || dates['en'].today || '',
				cleartxt = dates[this.o.language].clear || dates['en'].clear || '',
				tooltip;
			this.picker.find('.datepicker-days thead th.datepicker-switch')
						.text(dates[this.o.language].months[month]+' '+year);
			this.picker.find('tfoot th.today')
						.text(todaytxt)
						.toggle(this.o.todayBtn !== false);
			this.picker.find('tfoot th.clear')
						.text(cleartxt)
						.toggle(this.o.clearBtn !== false);
			this.updateNavArrows();
			this.fillMonths();
			var prevMonth = UTCDate(year, month-1, 28),
				day = DPGlobal.getDaysInMonth(prevMonth.getUTCFullYear(), prevMonth.getUTCMonth());
			prevMonth.setUTCDate(day);
			prevMonth.setUTCDate(day - (prevMonth.getUTCDay() - this.o.weekStart + 7)%7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setUTCDate(nextMonth.getUTCDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName;
			while (prevMonth.valueOf() < nextMonth){
				if (prevMonth.getUTCDay() === this.o.weekStart){
					html.push('<tr>');
					if (this.o.calendarWeeks){
						// ISO 8601: First week contains first thursday.
						// ISO also states week starts on Monday, but we can be more abstract here.
						var
							// Start of current week: based on weekstart/current date
							ws = new Date(+prevMonth + (this.o.weekStart - prevMonth.getUTCDay() - 7) % 7 * 864e5),
							// Thursday of this week
							th = new Date(Number(ws) + (7 + 4 - ws.getUTCDay()) % 7 * 864e5),
							// First Thursday of year, year from thursday
							yth = new Date(Number(yth = UTCDate(th.getUTCFullYear(), 0, 1)) + (7 + 4 - yth.getUTCDay())%7*864e5),
							// Calendar week: ms between thursdays, div ms per day, div 7 days
							calWeek =  (th - yth) / 864e5 / 7 + 1;
						html.push('<td class="cw">'+ calWeek +'</td>');

					}
				}
				clsName = this.getClassNames(prevMonth);
				clsName.push('day');

				if (this.o.beforeShowDay !== $.noop){
					var before = this.o.beforeShowDay(this._utc_to_local(prevMonth));
					if (before === undefined)
						before = {};
					else if (typeof(before) === 'boolean')
						before = {enabled: before};
					else if (typeof(before) === 'string')
						before = {classes: before};
					if (before.enabled === false)
						clsName.push('disabled');
					if (before.classes)
						clsName = clsName.concat(before.classes.split(/\s+/));
					if (before.tooltip)
						tooltip = before.tooltip;
				}

				clsName = $.unique(clsName);
				html.push('<td class="'+clsName.join(' ')+'"' + (tooltip ? ' title="'+tooltip+'"' : '') + '>'+prevMonth.getUTCDate() + '</td>');
				if (prevMonth.getUTCDay() === this.o.weekEnd){
					html.push('</tr>');
				}
				prevMonth.setUTCDate(prevMonth.getUTCDate()+1);
			}
			this.picker.find('.datepicker-days tbody').empty().append(html.join(''));

			var months = this.picker.find('.datepicker-months')
						.find('th:eq(1)')
							.text(year)
							.end()
						.find('span').removeClass('active');

			$.each(this.dates, function(i, d){
				if (d.getUTCFullYear() === year)
					months.eq(d.getUTCMonth()).addClass('active');
			});

			if (year < startYear || year > endYear){
				months.addClass('disabled');
			}
			if (year === startYear){
				months.slice(0, startMonth).addClass('disabled');
			}
			if (year === endYear){
				months.slice(endMonth+1).addClass('disabled');
			}

			html = '';
			year = parseInt(year/10, 10) * 10;
			var yearCont = this.picker.find('.datepicker-years')
								.find('th:eq(1)')
									.text(year + '-' + (year + 9))
									.end()
								.find('td');
			year -= 1;
			var years = $.map(this.dates, function(d){
					return d.getUTCFullYear();
				}),
				classes;
			for (var i = -1; i < 11; i++){
				classes = ['year'];
				if (i === -1)
					classes.push('old');
				else if (i === 10)
					classes.push('new');
				if ($.inArray(year, years) !== -1)
					classes.push('active');
				if (year < startYear || year > endYear)
					classes.push('disabled');
				html += '<span class="' + classes.join(' ') + '">'+year+'</span>';
				year += 1;
			}
			yearCont.html(html);
		},

		updateNavArrows: function(){
			if (!this._allow_update)
				return;

			var d = new Date(this.viewDate),
				year = d.getUTCFullYear(),
				month = d.getUTCMonth();
			switch (this.viewMode){
				case 0:
					if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear() && month <= this.o.startDate.getUTCMonth()){
						this.picker.find('.prev').css({visibility: 'hidden'});
					}
					else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear() && month >= this.o.endDate.getUTCMonth()){
						this.picker.find('.next').css({visibility: 'hidden'});
					}
					else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
				case 1:
				case 2:
					if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear()){
						this.picker.find('.prev').css({visibility: 'hidden'});
					}
					else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear()){
						this.picker.find('.next').css({visibility: 'hidden'});
					}
					else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
			}
		},

		click: function(e){
			e.preventDefault();
			var target = $(e.target).closest('span, td, th'),
				year, month, day;
			if (target.length === 1){
				switch (target[0].nodeName.toLowerCase()){
					case 'th':
						switch (target[0].className){
							case 'datepicker-switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								var dir = DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1);
								switch (this.viewMode){
									case 0:
										this.viewDate = this.moveMonth(this.viewDate, dir);
										this._trigger('changeMonth', this.viewDate);
										break;
									case 1:
									case 2:
										this.viewDate = this.moveYear(this.viewDate, dir);
										if (this.viewMode === 1)
											this._trigger('changeYear', this.viewDate);
										break;
								}
								this.fill();
								break;
							case 'today':
								var date = new Date();
								date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);

								this.showMode(-2);
								var which = this.o.todayBtn === 'linked' ? null : 'view';
								this._setDate(date, which);
								break;
							case 'clear':
								var element;
								if (this.isInput)
									element = this.element;
								else if (this.component)
									element = this.element.find('input');
								if (element)
									element.val("").change();
								this.update();
								this._trigger('changeDate');
								if (this.o.autoclose)
									this.hide();
								break;
						}
						break;
					case 'span':
						if (!target.is('.disabled')){
							this.viewDate.setUTCDate(1);
							if (target.is('.month')){
								day = 1;
								month = target.parent().find('span').index(target);
								year = this.viewDate.getUTCFullYear();
								this.viewDate.setUTCMonth(month);
								this._trigger('changeMonth', this.viewDate);
								if (this.o.minViewMode === 1){
									this._setDate(UTCDate(year, month, day));
								}
							}
							else {
								day = 1;
								month = 0;
								year = parseInt(target.text(), 10)||0;
								this.viewDate.setUTCFullYear(year);
								this._trigger('changeYear', this.viewDate);
								if (this.o.minViewMode === 2){
									this._setDate(UTCDate(year, month, day));
								}
							}
							this.showMode(-1);
							this.fill();
						}
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')){
							day = parseInt(target.text(), 10)||1;
							year = this.viewDate.getUTCFullYear();
							month = this.viewDate.getUTCMonth();
							if (target.is('.old')){
								if (month === 0){
									month = 11;
									year -= 1;
								}
								else {
									month -= 1;
								}
							}
							else if (target.is('.new')){
								if (month === 11){
									month = 0;
									year += 1;
								}
								else {
									month += 1;
								}
							}
							this._setDate(UTCDate(year, month, day));
						}
						break;
				}
			}
			if (this.picker.is(':visible') && this._focused_from){
				$(this._focused_from).focus();
			}
			delete this._focused_from;
		},

		_toggle_multidate: function(date){
			var ix = this.dates.contains(date);
			if (!date){
				this.dates.clear();
			}
			else if (ix !== -1){
				this.dates.remove(ix);
			}
			else {
				this.dates.push(date);
			}
			if (typeof this.o.multidate === 'number')
				while (this.dates.length > this.o.multidate)
					this.dates.remove(0);
		},

		_setDate: function(date, which){
			if (!which || which === 'date')
				this._toggle_multidate(date && new Date(date));
			if (!which || which  === 'view')
				this.viewDate = date && new Date(date);

			this.fill();
			this.setValue();
			this._trigger('changeDate');
			var element;
			if (this.isInput){
				element = this.element;
			}
			else if (this.component){
				element = this.element.find('input');
			}
			if (element){
				element.change();
			}
			if (this.o.autoclose && (!which || which === 'date')){
				this.hide();
			}
		},

		moveMonth: function(date, dir){
			if (!date)
				return undefined;
			if (!dir)
				return date;
			var new_date = new Date(date.valueOf()),
				day = new_date.getUTCDate(),
				month = new_date.getUTCMonth(),
				mag = Math.abs(dir),
				new_month, test;
			dir = dir > 0 ? 1 : -1;
			if (mag === 1){
				test = dir === -1
					// If going back one month, make sure month is not current month
					// (eg, Mar 31 -> Feb 31 == Feb 28, not Mar 02)
					? function(){
						return new_date.getUTCMonth() === month;
					}
					// If going forward one month, make sure month is as expected
					// (eg, Jan 31 -> Feb 31 == Feb 28, not Mar 02)
					: function(){
						return new_date.getUTCMonth() !== new_month;
					};
				new_month = month + dir;
				new_date.setUTCMonth(new_month);
				// Dec -> Jan (12) or Jan -> Dec (-1) -- limit expected date to 0-11
				if (new_month < 0 || new_month > 11)
					new_month = (new_month + 12) % 12;
			}
			else {
				// For magnitudes >1, move one month at a time...
				for (var i=0; i < mag; i++)
					// ...which might decrease the day (eg, Jan 31 to Feb 28, etc)...
					new_date = this.moveMonth(new_date, dir);
				// ...then reset the day, keeping it in the new month
				new_month = new_date.getUTCMonth();
				new_date.setUTCDate(day);
				test = function(){
					return new_month !== new_date.getUTCMonth();
				};
			}
			// Common date-resetting loop -- if date is beyond end of month, make it
			// end of month
			while (test()){
				new_date.setUTCDate(--day);
				new_date.setUTCMonth(new_month);
			}
			return new_date;
		},

		moveYear: function(date, dir){
			return this.moveMonth(date, dir*12);
		},

		dateWithinRange: function(date){
			return date >= this.o.startDate && date <= this.o.endDate;
		},

		keydown: function(e){
			if (this.picker.is(':not(:visible)')){
				if (e.keyCode === 27) // allow escape to hide and re-show picker
					this.show();
				return;
			}
			var dateChanged = false,
				dir, newDate, newViewDate,
				focusDate = this.focusDate || this.viewDate;
			switch (e.keyCode){
				case 27: // escape
					if (this.focusDate){
						this.focusDate = null;
						this.viewDate = this.dates.get(-1) || this.viewDate;
						this.fill();
					}
					else
						this.hide();
					e.preventDefault();
					break;
				case 37: // left
				case 39: // right
					if (!this.o.keyboardNavigation)
						break;
					dir = e.keyCode === 37 ? -1 : 1;
					if (e.ctrlKey){
						newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
						newViewDate = this.moveYear(focusDate, dir);
						this._trigger('changeYear', this.viewDate);
					}
					else if (e.shiftKey){
						newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
						newViewDate = this.moveMonth(focusDate, dir);
						this._trigger('changeMonth', this.viewDate);
					}
					else {
						newDate = new Date(this.dates.get(-1) || UTCToday());
						newDate.setUTCDate(newDate.getUTCDate() + dir);
						newViewDate = new Date(focusDate);
						newViewDate.setUTCDate(focusDate.getUTCDate() + dir);
					}
					if (this.dateWithinRange(newDate)){
						this.focusDate = this.viewDate = newViewDate;
						this.setValue();
						this.fill();
						e.preventDefault();
					}
					break;
				case 38: // up
				case 40: // down
					if (!this.o.keyboardNavigation)
						break;
					dir = e.keyCode === 38 ? -1 : 1;
					if (e.ctrlKey){
						newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
						newViewDate = this.moveYear(focusDate, dir);
						this._trigger('changeYear', this.viewDate);
					}
					else if (e.shiftKey){
						newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
						newViewDate = this.moveMonth(focusDate, dir);
						this._trigger('changeMonth', this.viewDate);
					}
					else {
						newDate = new Date(this.dates.get(-1) || UTCToday());
						newDate.setUTCDate(newDate.getUTCDate() + dir * 7);
						newViewDate = new Date(focusDate);
						newViewDate.setUTCDate(focusDate.getUTCDate() + dir * 7);
					}
					if (this.dateWithinRange(newDate)){
						this.focusDate = this.viewDate = newViewDate;
						this.setValue();
						this.fill();
						e.preventDefault();
					}
					break;
				case 32: // spacebar
					// Spacebar is used in manually typing dates in some formats.
					// As such, its behavior should not be hijacked.
					break;
				case 13: // enter
					focusDate = this.focusDate || this.dates.get(-1) || this.viewDate;
					this._toggle_multidate(focusDate);
					dateChanged = true;
					this.focusDate = null;
					this.viewDate = this.dates.get(-1) || this.viewDate;
					this.setValue();
					this.fill();
					if (this.picker.is(':visible')){
						e.preventDefault();
						if (this.o.autoclose)
							this.hide();
					}
					break;
				case 9: // tab
					this.focusDate = null;
					this.viewDate = this.dates.get(-1) || this.viewDate;
					this.fill();
					this.hide();
					break;
			}
			if (dateChanged){
				if (this.dates.length)
					this._trigger('changeDate');
				else
					this._trigger('clearDate');
				var element;
				if (this.isInput){
					element = this.element;
				}
				else if (this.component){
					element = this.element.find('input');
				}
				if (element){
					element.change();
				}
			}
		},

		showMode: function(dir){
			if (dir){
				this.viewMode = Math.max(this.o.minViewMode, Math.min(2, this.viewMode + dir));
			}
			this.picker
				.find('>div')
				.hide()
				.filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName)
					.css('display', 'block');
			this.updateNavArrows();
		}
	};

	var DateRangePicker = function(element, options){
		this.element = $(element);
		this.inputs = $.map(options.inputs, function(i){
			return i.jquery ? i[0] : i;
		});
		delete options.inputs;

		$(this.inputs)
			.datepicker(options)
			.bind('changeDate', $.proxy(this.dateUpdated, this));

		this.pickers = $.map(this.inputs, function(i){
			return $(i).data('datepicker');
		});
		this.updateDates();
	};
	DateRangePicker.prototype = {
		updateDates: function(){
			this.dates = $.map(this.pickers, function(i){
				return i.getUTCDate();
			});
			this.updateRanges();
		},
		updateRanges: function(){
			var range = $.map(this.dates, function(d){
				return d.valueOf();
			});
			$.each(this.pickers, function(i, p){
				p.setRange(range);
			});
		},
		dateUpdated: function(e){
			// `this.updating` is a workaround for preventing infinite recursion
			// between `changeDate` triggering and `setUTCDate` calling.  Until
			// there is a better mechanism.
			if (this.updating)
				return;
			this.updating = true;

			var dp = $(e.target).data('datepicker'),
				new_date = dp.getUTCDate(),
				i = $.inArray(e.target, this.inputs),
				l = this.inputs.length;
			if (i === -1)
				return;

			$.each(this.pickers, function(i, p){
				if (!p.getUTCDate())
					p.setUTCDate(new_date);
			});

			if (new_date < this.dates[i]){
				// Date being moved earlier/left
				while (i >= 0 && new_date < this.dates[i]){
					this.pickers[i--].setUTCDate(new_date);
				}
			}
			else if (new_date > this.dates[i]){
				// Date being moved later/right
				while (i < l && new_date > this.dates[i]){
					this.pickers[i++].setUTCDate(new_date);
				}
			}
			this.updateDates();

			delete this.updating;
		},
		remove: function(){
			$.map(this.pickers, function(p){ p.remove(); });
			delete this.element.data().datepicker;
		}
	};

	function opts_from_el(el, prefix){
		// Derive options from element data-attrs
		var data = $(el).data(),
			out = {}, inkey,
			replace = new RegExp('^' + prefix.toLowerCase() + '([A-Z])');
		prefix = new RegExp('^' + prefix.toLowerCase());
		function re_lower(_,a){
			return a.toLowerCase();
		}
		for (var key in data)
			if (prefix.test(key)){
				inkey = key.replace(replace, re_lower);
				out[inkey] = data[key];
			}
		return out;
	}

	function opts_from_locale(lang){
		// Derive options from locale plugins
		var out = {};
		// Check if "de-DE" style date is available, if not language should
		// fallback to 2 letter code eg "de"
		if (!dates[lang]){
			lang = lang.split('-')[0];
			if (!dates[lang])
				return;
		}
		var d = dates[lang];
		$.each(locale_opts, function(i,k){
			if (k in d)
				out[k] = d[k];
		});
		return out;
	}

	var old = $.fn.datepicker;
	$.fn.datepicker = function(option){
		var args = Array.apply(null, arguments);
		args.shift();
		var internal_return;
		this.each(function(){
			var $this = $(this),
				data = $this.data('datepicker'),
				options = typeof option === 'object' && option;
			if (!data){
				var elopts = opts_from_el(this, 'date'),
					// Preliminary otions
					xopts = $.extend({}, defaults, elopts, options),
					locopts = opts_from_locale(xopts.language),
					// Options priority: js args, data-attrs, locales, defaults
					opts = $.extend({}, defaults, locopts, elopts, options);
				if ($this.is('.input-daterange') || opts.inputs){
					var ropts = {
						inputs: opts.inputs || $this.find('input').toArray()
					};
					$this.data('datepicker', (data = new DateRangePicker(this, $.extend(opts, ropts))));
				}
				else {
					$this.data('datepicker', (data = new Datepicker(this, opts)));
				}
			}
			if (typeof option === 'string' && typeof data[option] === 'function'){
				internal_return = data[option].apply(data, args);
				if (internal_return !== undefined)
					return false;
			}
		});
		if (internal_return !== undefined)
			return internal_return;
		else
			return this;
	};

	var defaults = $.fn.datepicker.defaults = {
		autoclose: false,
		beforeShowDay: $.noop,
		calendarWeeks: false,
		clearBtn: false,
		daysOfWeekDisabled: [],
		endDate: Infinity,
		forceParse: true,
		format: 'yyyy-mm-dd',
		keyboardNavigation: true,
		language: 'en',
		minViewMode: 0,
		multidate: false,
		multidateSeparator: ',',
		orientation: "auto",
		rtl: false,
		startDate: -Infinity,
		startView: 0,
		todayBtn: false,
		todayHighlight: false,
		weekStart: 0
	};
	var locale_opts = $.fn.datepicker.locale_opts = [
		'format',
		'rtl',
		'weekStart'
	];
	$.fn.datepicker.Constructor = Datepicker;
	var dates = $.fn.datepicker.dates = {
		en: {
			days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
			daysShort: ["日", "一", "二", "三", "四", "五", "六", "日"],
			daysMin: ["日", "一", "二", "三", "四", "五", "六", "日"],
			months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
			monthsShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
			today: "今天",
			clear: "清空"
		}
	};

	var DPGlobal = {
		modes: [
			{
				clsName: 'days',
				navFnc: 'Month',
				navStep: 1
			},
			{
				clsName: 'months',
				navFnc: 'FullYear',
				navStep: 1
			},
			{
				clsName: 'years',
				navFnc: 'FullYear',
				navStep: 10
		}],
		isLeapYear: function(year){
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
		},
		getDaysInMonth: function(year, month){
			return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
		},
		validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
		nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
		parseFormat: function(format){
			// IE treats \0 as a string end in inputs (truncating the value),
			// so it's a bad format delimiter, anyway
			var separators = format.replace(this.validParts, '\0').split('\0'),
				parts = format.match(this.validParts);
			if (!separators || !separators.length || !parts || parts.length === 0){
				throw new Error("Invalid date format.");
			}
			return {separators: separators, parts: parts};
		},
		parseDate: function(date, format, language){
			if (!date)
				return undefined;
			if (date instanceof Date)
				return date;
			if (typeof format === 'string')
				format = DPGlobal.parseFormat(format);
			var part_re = /([\-+]\d+)([dmwy])/,
				parts = date.match(/([\-+]\d+)([dmwy])/g),
				part, dir, i;
			if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(date)){
				date = new Date();
				for (i=0; i < parts.length; i++){
					part = part_re.exec(parts[i]);
					dir = parseInt(part[1]);
					switch (part[2]){
						case 'd':
							date.setUTCDate(date.getUTCDate() + dir);
							break;
						case 'm':
							date = Datepicker.prototype.moveMonth.call(Datepicker.prototype, date, dir);
							break;
						case 'w':
							date.setUTCDate(date.getUTCDate() + dir * 7);
							break;
						case 'y':
							date = Datepicker.prototype.moveYear.call(Datepicker.prototype, date, dir);
							break;
					}
				}
				return UTCDate(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), 0, 0, 0);
			}
			parts = date && date.match(this.nonpunctuation) || [];
			date = new Date();
			var parsed = {},
				setters_order = ['yyyy', 'yy', 'M', 'MM', 'm', 'mm', 'd', 'dd'],
				setters_map = {
					yyyy: function(d,v){
						return d.setUTCFullYear(v);
					},
					yy: function(d,v){
						return d.setUTCFullYear(2000+v);
					},
					m: function(d,v){
						if (isNaN(d))
							return d;
						v -= 1;
						while (v < 0) v += 12;
						v %= 12;
						d.setUTCMonth(v);
						while (d.getUTCMonth() !== v)
							d.setUTCDate(d.getUTCDate()-1);
						return d;
					},
					d: function(d,v){
						return d.setUTCDate(v);
					}
				},
				val, filtered;
			setters_map['M'] = setters_map['MM'] = setters_map['mm'] = setters_map['m'];
			setters_map['dd'] = setters_map['d'];
			date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
			var fparts = format.parts.slice();
			// Remove noop parts
			if (parts.length !== fparts.length){
				fparts = $(fparts).filter(function(i,p){
					return $.inArray(p, setters_order) !== -1;
				}).toArray();
			}
			// Process remainder
			function match_part(){
				var m = this.slice(0, parts[i].length),
					p = parts[i].slice(0, m.length);
				return m === p;
			}
			if (parts.length === fparts.length){
				var cnt;
				for (i=0, cnt = fparts.length; i < cnt; i++){
					val = parseInt(parts[i], 10);
					part = fparts[i];
					if (isNaN(val)){
						switch (part){
							case 'MM':
								filtered = $(dates[language].months).filter(match_part);
								val = $.inArray(filtered[0], dates[language].months) + 1;
								break;
							case 'M':
								filtered = $(dates[language].monthsShort).filter(match_part);
								val = $.inArray(filtered[0], dates[language].monthsShort) + 1;
								break;
						}
					}
					parsed[part] = val;
				}
				var _date, s;
				for (i=0; i < setters_order.length; i++){
					s = setters_order[i];
					if (s in parsed && !isNaN(parsed[s])){
						_date = new Date(date);
						setters_map[s](_date, parsed[s]);
						if (!isNaN(_date))
							date = _date;
					}
				}
			}
			return date;
		},
		formatDate: function(date, format, language){
			if (!date)
				return '';
			if (typeof format === 'string')
				format = DPGlobal.parseFormat(format);
			var val = {
				d: date.getUTCDate(),
				D: dates[language].daysShort[date.getUTCDay()],
				DD: dates[language].days[date.getUTCDay()],
				m: date.getUTCMonth() + 1,
				M: dates[language].monthsShort[date.getUTCMonth()],
				MM: dates[language].months[date.getUTCMonth()],
				yy: date.getUTCFullYear().toString().substring(2),
				yyyy: date.getUTCFullYear()
			};
			val.dd = (val.d < 10 ? '0' : '') + val.d;
			val.mm = (val.m < 10 ? '0' : '') + val.m;
			date = [];
			var seps = $.extend([], format.separators);
			for (var i=0, cnt = format.parts.length; i <= cnt; i++){
				if (seps.length)
					date.push(seps.shift());
				date.push(val[format.parts[i]]);
			}
			return date.join('');
		},
		headTemplate: '<thead>'+
							'<tr>'+
								'<th class="prev">&laquo;</th>'+
								'<th colspan="5" class="datepicker-switch"></th>'+
								'<th class="next">&raquo;</th>'+
							'</tr>'+
						'</thead>',
		contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
		footTemplate: '<tfoot>'+
							'<tr>'+
								'<th colspan="7" class="today"></th>'+
							'</tr>'+
							'<tr>'+
								'<th colspan="7" class="clear"></th>'+
							'</tr>'+
						'</tfoot>'
	};
	DPGlobal.template = '<div class="datepicker">'+
							'<div class="datepicker-days">'+
								'<table class=" table-condensed">'+
									DPGlobal.headTemplate+
									'<tbody></tbody>'+
									DPGlobal.footTemplate+
								'</table>'+
							'</div>'+
							'<div class="datepicker-months">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
									DPGlobal.footTemplate+
								'</table>'+
							'</div>'+
							'<div class="datepicker-years">'+
								'<table class="table-condensed">'+
									DPGlobal.headTemplate+
									DPGlobal.contTemplate+
									DPGlobal.footTemplate+
								'</table>'+
							'</div>'+
						'</div>';

	$.fn.datepicker.DPGlobal = DPGlobal;


	/* DATEPICKER NO CONFLICT
	* =================== */

	$.fn.datepicker.noConflict = function(){
		$.fn.datepicker = old;
		return this;
	};


	/* DATEPICKER DATA-API
	* ================== */

	$(document).on(
		'focus.datepicker.data-api click.datepicker.data-api',
		'[data-provide="datepicker"]',
		function(e){
			var $this = $(this);
			if ($this.data('datepicker'))
				return;
			e.preventDefault();
			// component click requires us to explicitly show it
			$this.datepicker('show');
		}
	);
	$(function(){
		$('[data-provide="datepicker-inline"]').datepicker();
	});

}(window.jQuery));
﻿/* ----------------------------------------------
 * bootstrap-datetimepicker.js
 * ----------------------------------------------
 * Copyright 2012 Stefan Petre
 * Improvements by Andrew Rowls
 * Improvements by Sébastien Malot
 * Improvements by Yun Lai
 * Project URL : http://www.malot.fr/bootstrap-datetimepicker
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ---------------------------------------------- */

/*
 * Improvement by CuGBabyBeaR @ 2013-09-12
 * 
 * Make it work in bootstrap v3
 */

!function ($) {

	function UTCDate() {
		return new Date(Date.UTC.apply(Date, arguments));
	}

	function UTCToday() {
		var today = new Date();
		return UTCDate(today.getUTCFullYear(), today.getUTCMonth(), today.getUTCDate(), today.getUTCHours(), today.getUTCMinutes(), today.getUTCSeconds(), 0);
	}

	// Picker object

	var Datetimepicker = function (element, options) {
		var that = this;

		this.element = $(element);

		// add container for single page application
		// when page switch the datetimepicker div will be removed also.
		this.container = options.container || 'body';

		this.language = options.language || this.element.data('date-language') || "en";
		this.language = this.language in dates ? this.language : "en";
		this.isRTL = dates[this.language].rtl || false;
		this.formatType = options.formatType || this.element.data('format-type') || 'standard';
		this.format = DPGlobal.parseFormat(options.format || this.element.data('date-format') || dates[this.language].format || DPGlobal.getDefaultFormat(this.formatType, 'input'), this.formatType);
		this.isInline = false;
		this.isVisible = false;
		this.isInput = this.element.is('input');


		this.bootcssVer = this.isInput ? (this.element.is('.form-control') ? 3 : 2) : ( this.bootcssVer = this.element.is('.input-group') ? 3 : 2 );

		this.component = this.element.is('.date') ? ( this.bootcssVer == 3 ? this.element.find('.input-group-addon .glyphicon-th, .input-group-addon .glyphicon-time, .input-group-addon .glyphicon-calendar').parent() : this.element.find('.add-on .icon-th, .add-on .icon-time, .add-on .icon-calendar').parent()) : false;
		this.componentReset = this.element.is('.date') ? ( this.bootcssVer == 3 ? this.element.find('.input-group-addon .glyphicon-remove').parent() : this.element.find('.add-on .icon-remove').parent()) : false;
		this.hasInput = this.component && this.element.find('input').length;
		if (this.component && this.component.length === 0) {
			this.component = false;
		}
		this.linkField = options.linkField || this.element.data('link-field') || false;
		this.linkFormat = DPGlobal.parseFormat(options.linkFormat || this.element.data('link-format') || DPGlobal.getDefaultFormat(this.formatType, 'link'), this.formatType);
		this.minuteStep = options.minuteStep || this.element.data('minute-step') || 5;
		this.pickerPosition = options.pickerPosition || this.element.data('picker-position') || 'bottom-right';
		this.showMeridian = options.showMeridian || this.element.data('show-meridian') || false;
		this.initialDate = options.initialDate || new Date();

		this._attachEvents();

		this.formatViewType = "datetime";
		if ('formatViewType' in options) {
			this.formatViewType = options.formatViewType;
		} else if ('formatViewType' in this.element.data()) {
			this.formatViewType = this.element.data('formatViewType');
		}

		this.minView = 0;
		if ('minView' in options) {
			this.minView = options.minView;
		} else if ('minView' in this.element.data()) {
			this.minView = this.element.data('min-view');
		}
		this.minView = DPGlobal.convertViewMode(this.minView);

		this.maxView = DPGlobal.modes.length - 1;
		if ('maxView' in options) {
			this.maxView = options.maxView;
		} else if ('maxView' in this.element.data()) {
			this.maxView = this.element.data('max-view');
		}
		this.maxView = DPGlobal.convertViewMode(this.maxView);

		this.wheelViewModeNavigation = false;
		if ('wheelViewModeNavigation' in options) {
			this.wheelViewModeNavigation = options.wheelViewModeNavigation;
		} else if ('wheelViewModeNavigation' in this.element.data()) {
			this.wheelViewModeNavigation = this.element.data('view-mode-wheel-navigation');
		}

		this.wheelViewModeNavigationInverseDirection = false;

		if ('wheelViewModeNavigationInverseDirection' in options) {
			this.wheelViewModeNavigationInverseDirection = options.wheelViewModeNavigationInverseDirection;
		} else if ('wheelViewModeNavigationInverseDirection' in this.element.data()) {
			this.wheelViewModeNavigationInverseDirection = this.element.data('view-mode-wheel-navigation-inverse-dir');
		}

		this.wheelViewModeNavigationDelay = 100;
		if ('wheelViewModeNavigationDelay' in options) {
			this.wheelViewModeNavigationDelay = options.wheelViewModeNavigationDelay;
		} else if ('wheelViewModeNavigationDelay' in this.element.data()) {
			this.wheelViewModeNavigationDelay = this.element.data('view-mode-wheel-navigation-delay');
		}

		this.startViewMode = 2;
		if ('startView' in options) {
			this.startViewMode = options.startView;
		} else if ('startView' in this.element.data()) {
			this.startViewMode = this.element.data('start-view');
		}
		this.startViewMode = DPGlobal.convertViewMode(this.startViewMode);
		this.viewMode = this.startViewMode;

		this.viewSelect = this.minView;
		if ('viewSelect' in options) {
			this.viewSelect = options.viewSelect;
		} else if ('viewSelect' in this.element.data()) {
			this.viewSelect = this.element.data('view-select');
		}
		this.viewSelect = DPGlobal.convertViewMode(this.viewSelect);

		this.forceParse = true;
		if ('forceParse' in options) {
			this.forceParse = options.forceParse;
		} else if ('dateForceParse' in this.element.data()) {
			this.forceParse = this.element.data('date-force-parse');
		}

		this.picker = $((this.bootcssVer == 3) ? DPGlobal.templateV3 : DPGlobal.template)
			.appendTo(this.isInline ? this.element : this.container) // 'body')
			.on({
				click:     $.proxy(this.click, this),
				mousedown: $.proxy(this.mousedown, this)
			});

		if (this.wheelViewModeNavigation) {
			if ($.fn.mousewheel) {
				this.picker.on({mousewheel: $.proxy(this.mousewheel, this)});
			} else {
				console.log("Mouse Wheel event is not supported. Please include the jQuery Mouse Wheel plugin before enabling this option");
			}
		}

		if (this.isInline) {
			this.picker.addClass('datetimepicker-inline');
		} else {
			this.picker.addClass('datetimepicker-dropdown-' + this.pickerPosition + ' dropdown-menu');
		}
		if (this.isRTL) {
			this.picker.addClass('datetimepicker-rtl');
			if (this.bootcssVer == 3) {
				this.picker.find('.prev span, .next span')
					.toggleClass('glyphicon-arrow-left glyphicon-arrow-right');
			} else {
				this.picker.find('.prev i, .next i')
					.toggleClass('icon-arrow-left icon-arrow-right');
			}
			;

		}
		$(document).on('mousedown', function (e) {
			// Clicked outside the datetimepicker, hide it
			if ($(e.target).closest('.datetimepicker').length === 0) {
				that.hide();
			}
		});

		this.autoclose = false;
		if ('autoclose' in options) {
			this.autoclose = options.autoclose;
		} else if ('dateAutoclose' in this.element.data()) {
			this.autoclose = this.element.data('date-autoclose');
		}

		this.keyboardNavigation = true;
		if ('keyboardNavigation' in options) {
			this.keyboardNavigation = options.keyboardNavigation;
		} else if ('dateKeyboardNavigation' in this.element.data()) {
			this.keyboardNavigation = this.element.data('date-keyboard-navigation');
		}

		this.todayBtn = (options.todayBtn || this.element.data('date-today-btn') || false);
		this.todayHighlight = (options.todayHighlight || this.element.data('date-today-highlight') || false);

		this.weekStart = ((options.weekStart || this.element.data('date-weekstart') || dates[this.language].weekStart || 0) % 7);
		this.weekEnd = ((this.weekStart + 6) % 7);
		this.startDate = -Infinity;
		this.endDate = Infinity;
		this.daysOfWeekDisabled = [];
		this.setStartDate(options.startDate || this.element.data('date-startdate'));
		this.setEndDate(options.endDate || this.element.data('date-enddate'));
		this.setDaysOfWeekDisabled(options.daysOfWeekDisabled || this.element.data('date-days-of-week-disabled'));
		this.fillDow();
		this.fillMonths();
		this.update();
		this.showMode();

		if (this.isInline) {
			this.show();
		}
	};

	Datetimepicker.prototype = {
		constructor: Datetimepicker,

		_events:       [],
		_attachEvents: function () {
			this._detachEvents();
			if (this.isInput) { // single input
				this._events = [
					[this.element, {
						focus:   $.proxy(this.show, this),
						keyup:   $.proxy(this.update, this),
						keydown: $.proxy(this.keydown, this)
					}]
				];
			}
			else if (this.component && this.hasInput) { // component: input + button
				this._events = [
					// For components that are not readonly, allow keyboard nav
					[this.element.find('input'), {
						focus:   $.proxy(this.show, this),
						keyup:   $.proxy(this.update, this),
						keydown: $.proxy(this.keydown, this)
					}],
					[this.component, {
						click: $.proxy(this.show, this)
					}]
				];
				if (this.componentReset) {
					this._events.push([
						this.componentReset,
						{click: $.proxy(this.reset, this)}
					]);
				}
			}
			else if (this.element.is('div')) {  // inline datetimepicker
				this.isInline = true;
			}
			else {
				this._events = [
					[this.element, {
						click: $.proxy(this.show, this)
					}]
				];
			}
			for (var i = 0, el, ev; i < this._events.length; i++) {
				el = this._events[i][0];
				ev = this._events[i][1];
				el.on(ev);
			}
		},

		_detachEvents: function () {
			for (var i = 0, el, ev; i < this._events.length; i++) {
				el = this._events[i][0];
				ev = this._events[i][1];
				el.off(ev);
			}
			this._events = [];
		},

		show: function (e) {
			this.picker.show();
			this.height = this.component ? this.component.outerHeight() : this.element.outerHeight();
			if (this.forceParse) {
				this.update();
			}
			this.place();
			$(window).on('resize', $.proxy(this.place, this));
			if (e) {
				e.stopPropagation();
				e.preventDefault();
			}
			this.isVisible = true;
			this.element.trigger({
				type: 'show',
				date: this.date
			});
		},

		hide: function (e) {
			if (!this.isVisible) return;
			if (this.isInline) return;
			this.picker.hide();
			$(window).off('resize', this.place);
			this.viewMode = this.startViewMode;
			this.showMode();
			if (!this.isInput) {
				$(document).off('mousedown', this.hide);
			}

			if (
				this.forceParse &&
					(
						this.isInput && this.element.val() ||
							this.hasInput && this.element.find('input').val()
						)
				)
				this.setValue();
			this.isVisible = false;
			this.element.trigger({
				type: 'hide',
				date: this.date
			});
		},

		remove: function () {
			this._detachEvents();
			this.picker.remove();
			delete this.picker;
			delete this.element.data().datetimepicker;
		},

		getDate: function () {
			var d = this.getUTCDate();
			return new Date(d.getTime() + (d.getTimezoneOffset() * 60000));
		},

		getUTCDate: function () {
			return this.date;
		},

		setDate: function (d) {
			this.setUTCDate(new Date(d.getTime() - (d.getTimezoneOffset() * 60000)));
		},

		setUTCDate: function (d) {
			if (d >= this.startDate && d <= this.endDate) {
				this.date = d;
				this.setValue();
				this.viewDate = this.date;
				this.fill();
			} else {
				this.element.trigger({
					type:      'outOfRange',
					date:      d,
					startDate: this.startDate,
					endDate:   this.endDate
				});
			}
		},

		setFormat: function (format) {
			this.format = DPGlobal.parseFormat(format, this.formatType);
			var element;
			if (this.isInput) {
				element = this.element;
			} else if (this.component) {
				element = this.element.find('input');
			}
			if (element && element.val()) {
				this.setValue();
			}
		},

		setValue: function () {
			var formatted = this.getFormattedDate();
			if (!this.isInput) {
				if (this.component) {
					this.element.find('input').val(formatted);
				}
				this.element.data('date', formatted);
			} else {
				this.element.val(formatted);
			}
			if (this.linkField) {
				$('#' + this.linkField).val(this.getFormattedDate(this.linkFormat));
			}
		},

		getFormattedDate: function (format) {
			if (format == undefined) format = this.format;
			return DPGlobal.formatDate(this.date, format, this.language, this.formatType);
		},

		setStartDate: function (startDate) {
			this.startDate = startDate || -Infinity;
			if (this.startDate !== -Infinity) {
				this.startDate = DPGlobal.parseDate(this.startDate, this.format, this.language, this.formatType);
			}
			this.update();
			this.updateNavArrows();
		},

		setEndDate: function (endDate) {
			this.endDate = endDate || Infinity;
			if (this.endDate !== Infinity) {
				this.endDate = DPGlobal.parseDate(this.endDate, this.format, this.language, this.formatType);
			}
			this.update();
			this.updateNavArrows();
		},

		setDaysOfWeekDisabled: function (daysOfWeekDisabled) {
			this.daysOfWeekDisabled = daysOfWeekDisabled || [];
			if (!$.isArray(this.daysOfWeekDisabled)) {
				this.daysOfWeekDisabled = this.daysOfWeekDisabled.split(/,\s*/);
			}
			this.daysOfWeekDisabled = $.map(this.daysOfWeekDisabled, function (d) {
				return parseInt(d, 10);
			});
			this.update();
			this.updateNavArrows();
		},

		place: function () {
			if (this.isInline) return;

			var index_highest = 0;
			$('div').each(function () {
				var index_current = parseInt($(this).css("zIndex"), 10);
				if (index_current > index_highest) {
					index_highest = index_current;
				}
			});
			var zIndex = index_highest + 10;

			var offset, top, left, containerOffset;
			if (this.container instanceof $) {
				containerOffset = this.container.offset();
			} else {
				containerOffset = $(this.container).offset();
			}

			if (this.component) {
				offset = this.component.offset();
				left = offset.left;
				if (this.pickerPosition == 'bottom-left' || this.pickerPosition == 'top-left') {
					left += this.component.outerWidth() - this.picker.outerWidth();
				}
			} else {
				offset = this.element.offset();
				left = offset.left;
			}
			
			if(left+220 > document.body.clientWidth){
            			left = document.body.clientWidth-220;
          		}
			
			if (this.pickerPosition == 'top-left' || this.pickerPosition == 'top-right') {
				top = offset.top - this.picker.outerHeight();
			} else {
				top = offset.top + this.height;
			}

			top = top - containerOffset.top;
			left = left - containerOffset.left;

			this.picker.css({
				top:    top,
				left:   left,
				zIndex: zIndex
			});
		},

		update: function () {
			var date, fromArgs = false;
			if (arguments && arguments.length && (typeof arguments[0] === 'string' || arguments[0] instanceof Date)) {
				date = arguments[0];
				fromArgs = true;
			} else {
				date = (this.isInput ? this.element.val() : this.element.find('input').val()) || this.element.data('date') || this.initialDate;
				if (typeof date == 'string' || date instanceof String) {
				  date = date.replace(/^\s+|\s+$/g,'');
				}
			}

			if (!date) {
				date = new Date();
				fromArgs = false;
			}

			this.date = DPGlobal.parseDate(date, this.format, this.language, this.formatType);

			if (fromArgs) this.setValue();

			if (this.date < this.startDate) {
				this.viewDate = new Date(this.startDate);
			} else if (this.date > this.endDate) {
				this.viewDate = new Date(this.endDate);
			} else {
				this.viewDate = new Date(this.date);
			}
			this.fill();
		},

		fillDow: function () {
			var dowCnt = this.weekStart,
				html = '<tr>';
			while (dowCnt < this.weekStart + 7) {
				html += '<th class="dow">' + dates[this.language].daysMin[(dowCnt++) % 7] + '</th>';
			}
			html += '</tr>';
			this.picker.find('.datetimepicker-days thead').append(html);
		},

		fillMonths: function () {
			var html = '',
				i = 0;
			while (i < 12) {
				html += '<span class="month">' + dates[this.language].monthsShort[i++] + '</span>';
			}
			this.picker.find('.datetimepicker-months td').html(html);
		},

		fill: function () {
			if (this.date == null || this.viewDate == null) {
				return;
			}
			var d = new Date(this.viewDate),
				year = d.getUTCFullYear(),
				month = d.getUTCMonth(),
				dayMonth = d.getUTCDate(),
				hours = d.getUTCHours(),
				minutes = d.getUTCMinutes(),
				startYear = this.startDate !== -Infinity ? this.startDate.getUTCFullYear() : -Infinity,
				startMonth = this.startDate !== -Infinity ? this.startDate.getUTCMonth() : -Infinity,
				endYear = this.endDate !== Infinity ? this.endDate.getUTCFullYear() : Infinity,
				endMonth = this.endDate !== Infinity ? this.endDate.getUTCMonth() : Infinity,
				currentDate = (new UTCDate(this.date.getUTCFullYear(), this.date.getUTCMonth(), this.date.getUTCDate())).valueOf(),
				today = new Date();
			this.picker.find('.datetimepicker-days thead th:eq(1)')
				.text(dates[this.language].months[month] + ' ' + year);
			if (this.formatViewType == "time") {
				var hourConverted = hours % 12 ? hours % 12 : 12;
				var hoursDisplay = (hourConverted < 10 ? '0' : '') + hourConverted;
				var minutesDisplay = (minutes < 10 ? '0' : '') + minutes;
				var meridianDisplay = dates[this.language].meridiem[hours < 12 ? 0 : 1];
				this.picker.find('.datetimepicker-hours thead th:eq(1)')
					.text(hoursDisplay + ':' + minutesDisplay + ' ' + (meridianDisplay ? meridianDisplay.toUpperCase() : ''));
				this.picker.find('.datetimepicker-minutes thead th:eq(1)')
					.text(hoursDisplay + ':' + minutesDisplay + ' ' + (meridianDisplay ? meridianDisplay.toUpperCase() : ''));
			} else {
				this.picker.find('.datetimepicker-hours thead th:eq(1)')
					.text(dayMonth + ' ' + dates[this.language].months[month] + ' ' + year);
				this.picker.find('.datetimepicker-minutes thead th:eq(1)')
					.text(dayMonth + ' ' + dates[this.language].months[month] + ' ' + year);
			}
			this.picker.find('tfoot th.today')
				.text(dates[this.language].today)
				.toggle(this.todayBtn !== false);
			this.updateNavArrows();
			this.fillMonths();
			/*var prevMonth = UTCDate(year, month, 0,0,0,0,0);
			 prevMonth.setUTCDate(prevMonth.getDate() - (prevMonth.getUTCDay() - this.weekStart + 7)%7);*/
			var prevMonth = UTCDate(year, month - 1, 28, 0, 0, 0, 0),
				day = DPGlobal.getDaysInMonth(prevMonth.getUTCFullYear(), prevMonth.getUTCMonth());
			prevMonth.setUTCDate(day);
			prevMonth.setUTCDate(day - (prevMonth.getUTCDay() - this.weekStart + 7) % 7);
			var nextMonth = new Date(prevMonth);
			nextMonth.setUTCDate(nextMonth.getUTCDate() + 42);
			nextMonth = nextMonth.valueOf();
			var html = [];
			var clsName;
			while (prevMonth.valueOf() < nextMonth) {
				if (prevMonth.getUTCDay() == this.weekStart) {
					html.push('<tr>');
				}
				clsName = '';
				if (prevMonth.getUTCFullYear() < year || (prevMonth.getUTCFullYear() == year && prevMonth.getUTCMonth() < month)) {
					clsName += ' old';
				} else if (prevMonth.getUTCFullYear() > year || (prevMonth.getUTCFullYear() == year && prevMonth.getUTCMonth() > month)) {
					clsName += ' new';
				}
				// Compare internal UTC date with local today, not UTC today
				if (this.todayHighlight &&
					prevMonth.getUTCFullYear() == today.getFullYear() &&
					prevMonth.getUTCMonth() == today.getMonth() &&
					prevMonth.getUTCDate() == today.getDate()) {
					clsName += ' today';
				}
				if (prevMonth.valueOf() == currentDate) {
					clsName += ' active';
				}
				if ((prevMonth.valueOf() + 86400000) <= this.startDate || prevMonth.valueOf() > this.endDate ||
					$.inArray(prevMonth.getUTCDay(), this.daysOfWeekDisabled) !== -1) {
					clsName += ' disabled';
				}
				html.push('<td class="day' + clsName + '">' + prevMonth.getUTCDate() + '</td>');
				if (prevMonth.getUTCDay() == this.weekEnd) {
					html.push('</tr>');
				}
				prevMonth.setUTCDate(prevMonth.getUTCDate() + 1);
			}
			this.picker.find('.datetimepicker-days tbody').empty().append(html.join(''));

			html = [];
			var txt = '', meridian = '', meridianOld = '';
			for (var i = 0; i < 24; i++) {
				var actual = UTCDate(year, month, dayMonth, i);
				clsName = '';
				// We want the previous hour for the startDate
				if ((actual.valueOf() + 3600000) <= this.startDate || actual.valueOf() > this.endDate) {
					clsName += ' disabled';
				} else if (hours == i) {
					clsName += ' active';
				}
				if (this.showMeridian && dates[this.language].meridiem.length == 2) {
					meridian = (i < 12 ? dates[this.language].meridiem[0] : dates[this.language].meridiem[1]);
					if (meridian != meridianOld) {
						if (meridianOld != '') {
							html.push('</fieldset>');
						}
						html.push('<fieldset class="hour"><legend>' + meridian.toUpperCase() + '</legend>');
					}
					meridianOld = meridian;
					txt = (i % 12 ? i % 12 : 12);
					html.push('<span class="hour' + clsName + ' hour_' + (i < 12 ? 'am' : 'pm') + '">' + txt + '</span>');
					if (i == 23) {
						html.push('</fieldset>');
					}
				} else {
					txt = i + ':00';
					html.push('<span class="hour' + clsName + '">' + txt + '</span>');
				}
			}
			this.picker.find('.datetimepicker-hours td').html(html.join(''));

			html = [];
			txt = '', meridian = '', meridianOld = '';
			for (var i = 0; i < 60; i += this.minuteStep) {
				var actual = UTCDate(year, month, dayMonth, hours, i, 0);
				clsName = '';
				if (actual.valueOf() < this.startDate || actual.valueOf() > this.endDate) {
					clsName += ' disabled';
				} else if (Math.floor(minutes / this.minuteStep) == Math.floor(i / this.minuteStep)) {
					clsName += ' active';
				}
				if (this.showMeridian && dates[this.language].meridiem.length == 2) {
					meridian = (hours < 12 ? dates[this.language].meridiem[0] : dates[this.language].meridiem[1]);
					if (meridian != meridianOld) {
						if (meridianOld != '') {
							html.push('</fieldset>');
						}
						html.push('<fieldset class="minute"><legend>' + meridian.toUpperCase() + '</legend>');
					}
					meridianOld = meridian;
					txt = (hours % 12 ? hours % 12 : 12);
					//html.push('<span class="minute'+clsName+' minute_'+(hours<12?'am':'pm')+'">'+txt+'</span>');
					html.push('<span class="minute' + clsName + '">' + txt + ':' + (i < 10 ? '0' + i : i) + '</span>');
					if (i == 59) {
						html.push('</fieldset>');
					}
				} else {
					txt = i + ':00';
					//html.push('<span class="hour'+clsName+'">'+txt+'</span>');
					html.push('<span class="minute' + clsName + '">' + hours + ':' + (i < 10 ? '0' + i : i) + '</span>');
				}
			}
			this.picker.find('.datetimepicker-minutes td').html(html.join(''));

			var currentYear = this.date.getUTCFullYear();
			var months = this.picker.find('.datetimepicker-months')
				.find('th:eq(1)')
				.text(year)
				.end()
				.find('span').removeClass('active');
			if (currentYear == year) {
				months.eq(this.date.getUTCMonth()).addClass('active');
			}
			if (year < startYear || year > endYear) {
				months.addClass('disabled');
			}
			if (year == startYear) {
				months.slice(0, startMonth).addClass('disabled');
			}
			if (year == endYear) {
				months.slice(endMonth + 1).addClass('disabled');
			}

			html = '';
			year = parseInt(year / 10, 10) * 10;
			var yearCont = this.picker.find('.datetimepicker-years')
				.find('th:eq(1)')
				.text(year + '-' + (year + 9))
				.end()
				.find('td');
			year -= 1;
			for (var i = -1; i < 11; i++) {
				html += '<span class="year' + (i == -1 || i == 10 ? ' old' : '') + (currentYear == year ? ' active' : '') + (year < startYear || year > endYear ? ' disabled' : '') + '">' + year + '</span>';
				year += 1;
			}
			yearCont.html(html);
			this.place();
		},

		updateNavArrows: function () {
			var d = new Date(this.viewDate),
				year = d.getUTCFullYear(),
				month = d.getUTCMonth(),
				day = d.getUTCDate(),
				hour = d.getUTCHours();
			switch (this.viewMode) {
				case 0:
					if (this.startDate !== -Infinity && year <= this.startDate.getUTCFullYear()
						&& month <= this.startDate.getUTCMonth()
						&& day <= this.startDate.getUTCDate()
						&& hour <= this.startDate.getUTCHours()) {
						this.picker.find('.prev').css({visibility: 'hidden'});
					} else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.endDate !== Infinity && year >= this.endDate.getUTCFullYear()
						&& month >= this.endDate.getUTCMonth()
						&& day >= this.endDate.getUTCDate()
						&& hour >= this.endDate.getUTCHours()) {
						this.picker.find('.next').css({visibility: 'hidden'});
					} else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
				case 1:
					if (this.startDate !== -Infinity && year <= this.startDate.getUTCFullYear()
						&& month <= this.startDate.getUTCMonth()
						&& day <= this.startDate.getUTCDate()) {
						this.picker.find('.prev').css({visibility: 'hidden'});
					} else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.endDate !== Infinity && year >= this.endDate.getUTCFullYear()
						&& month >= this.endDate.getUTCMonth()
						&& day >= this.endDate.getUTCDate()) {
						this.picker.find('.next').css({visibility: 'hidden'});
					} else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
				case 2:
					if (this.startDate !== -Infinity && year <= this.startDate.getUTCFullYear()
						&& month <= this.startDate.getUTCMonth()) {
						this.picker.find('.prev').css({visibility: 'hidden'});
					} else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.endDate !== Infinity && year >= this.endDate.getUTCFullYear()
						&& month >= this.endDate.getUTCMonth()) {
						this.picker.find('.next').css({visibility: 'hidden'});
					} else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
				case 3:
				case 4:
					if (this.startDate !== -Infinity && year <= this.startDate.getUTCFullYear()) {
						this.picker.find('.prev').css({visibility: 'hidden'});
					} else {
						this.picker.find('.prev').css({visibility: 'visible'});
					}
					if (this.endDate !== Infinity && year >= this.endDate.getUTCFullYear()) {
						this.picker.find('.next').css({visibility: 'hidden'});
					} else {
						this.picker.find('.next').css({visibility: 'visible'});
					}
					break;
			}
		},

		mousewheel: function (e) {

			e.preventDefault();
			e.stopPropagation();

			if (this.wheelPause) {
				return;
			}

			this.wheelPause = true;

			var originalEvent = e.originalEvent;

			var delta = originalEvent.wheelDelta;

			var mode = delta > 0 ? 1 : (delta === 0) ? 0 : -1;

			if (this.wheelViewModeNavigationInverseDirection) {
				mode = -mode;
			}

			this.showMode(mode);

			setTimeout($.proxy(function () {

				this.wheelPause = false

			}, this), this.wheelViewModeNavigationDelay);

		},

		click: function (e) {
			e.stopPropagation();
			e.preventDefault();
			var target = $(e.target).closest('span, td, th, legend');
			if (target.is('.glyphicon')) {
				target = $(target).parent().closest('span, td, th, legend');
			}
			if (target.length == 1) {
				if (target.is('.disabled')) {
					this.element.trigger({
						type:      'outOfRange',
						date:      this.viewDate,
						startDate: this.startDate,
						endDate:   this.endDate
					});
					return;
				}
				switch (target[0].nodeName.toLowerCase()) {
					case 'th':
						switch (target[0].className) {
							case 'switch':
								this.showMode(1);
								break;
							case 'prev':
							case 'next':
								var dir = DPGlobal.modes[this.viewMode].navStep * (target[0].className == 'prev' ? -1 : 1);
								switch (this.viewMode) {
									case 0:
										this.viewDate = this.moveHour(this.viewDate, dir);
										break;
									case 1:
										this.viewDate = this.moveDate(this.viewDate, dir);
										break;
									case 2:
										this.viewDate = this.moveMonth(this.viewDate, dir);
										break;
									case 3:
									case 4:
										this.viewDate = this.moveYear(this.viewDate, dir);
										break;
								}
								this.fill();
								this.element.trigger({
									type:      target[0].className + ':' + this.convertViewModeText(this.viewMode),
									date:      this.viewDate,
									startDate: this.startDate,
									endDate:   this.endDate
								});
								break;
							case 'today':
								var date = new Date();
								date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds(), 0);

								// Respect startDate and endDate.
								if (date < this.startDate) date = this.startDate;
								else if (date > this.endDate) date = this.endDate;

								this.viewMode = this.startViewMode;
								this.showMode(0);
								this._setDate(date);
								this.fill();
								if (this.autoclose) {
									this.hide();
								}
								break;
						}
						break;
					case 'span':
						if (!target.is('.disabled')) {
							var year = this.viewDate.getUTCFullYear(),
								month = this.viewDate.getUTCMonth(),
								day = this.viewDate.getUTCDate(),
								hours = this.viewDate.getUTCHours(),
								minutes = this.viewDate.getUTCMinutes(),
								seconds = this.viewDate.getUTCSeconds();

							if (target.is('.month')) {
								this.viewDate.setUTCDate(1);
								month = target.parent().find('span').index(target);
								day = this.viewDate.getUTCDate();
								this.viewDate.setUTCMonth(month);
								this.element.trigger({
									type: 'changeMonth',
									date: this.viewDate
								});
								if (this.viewSelect >= 3) {
									this._setDate(UTCDate(year, month, day, hours, minutes, seconds, 0));
								}
							} else if (target.is('.year')) {
								this.viewDate.setUTCDate(1);
								year = parseInt(target.text(), 10) || 0;
								this.viewDate.setUTCFullYear(year);
								this.element.trigger({
									type: 'changeYear',
									date: this.viewDate
								});
								if (this.viewSelect >= 4) {
									this._setDate(UTCDate(year, month, day, hours, minutes, seconds, 0));
								}
							} else if (target.is('.hour')) {
								hours = parseInt(target.text(), 10) || 0;
								if (target.hasClass('hour_am') || target.hasClass('hour_pm')) {
									if (hours == 12 && target.hasClass('hour_am')) {
										hours = 0;
									} else if (hours != 12 && target.hasClass('hour_pm')) {
										hours += 12;
									}
								}
								this.viewDate.setUTCHours(hours);
								this.element.trigger({
									type: 'changeHour',
									date: this.viewDate
								});
								if (this.viewSelect >= 1) {
									this._setDate(UTCDate(year, month, day, hours, minutes, seconds, 0));
								}
							} else if (target.is('.minute')) {
								minutes = parseInt(target.text().substr(target.text().indexOf(':') + 1), 10) || 0;
								this.viewDate.setUTCMinutes(minutes);
								this.element.trigger({
									type: 'changeMinute',
									date: this.viewDate
								});
								if (this.viewSelect >= 0) {
									this._setDate(UTCDate(year, month, day, hours, minutes, seconds, 0));
								}
							}
							if (this.viewMode != 0) {
								var oldViewMode = this.viewMode;
								this.showMode(-1);
								this.fill();
								if (oldViewMode == this.viewMode && this.autoclose) {
									this.hide();
								}
							} else {
								this.fill();
								if (this.autoclose) {
									this.hide();
								}
							}
						}
						break;
					case 'td':
						if (target.is('.day') && !target.is('.disabled')) {
							var day = parseInt(target.text(), 10) || 1;
							var year = this.viewDate.getUTCFullYear(),
								month = this.viewDate.getUTCMonth(),
								hours = this.viewDate.getUTCHours(),
								minutes = this.viewDate.getUTCMinutes(),
								seconds = this.viewDate.getUTCSeconds();
							if (target.is('.old')) {
								if (month === 0) {
									month = 11;
									year -= 1;
								} else {
									month -= 1;
								}
							} else if (target.is('.new')) {
								if (month == 11) {
									month = 0;
									year += 1;
								} else {
									month += 1;
								}
							}
							this.viewDate.setUTCFullYear(year);
							this.viewDate.setUTCMonth(month, day);
							this.element.trigger({
								type: 'changeDay',
								date: this.viewDate
							});
							if (this.viewSelect >= 2) {
								this._setDate(UTCDate(year, month, day, hours, minutes, seconds, 0));
							}
						}
						var oldViewMode = this.viewMode;
						this.showMode(-1);
						this.fill();
						if (oldViewMode == this.viewMode && this.autoclose) {
							this.hide();
						}
						break;
				}
			}
		},

		_setDate: function (date, which) {
			if (!which || which == 'date')
				this.date = date;
			if (!which || which == 'view')
				this.viewDate = date;
			this.fill();
			this.setValue();
			var element;
			if (this.isInput) {
				element = this.element;
			} else if (this.component) {
				element = this.element.find('input');
			}
			if (element) {
				element.change();
				if (this.autoclose && (!which || which == 'date')) {
					//this.hide();
				}
			}
			this.element.trigger({
				type: 'changeDate',
				date: this.date
			});
		},

		moveMinute: function (date, dir) {
			if (!dir) return date;
			var new_date = new Date(date.valueOf());
			//dir = dir > 0 ? 1 : -1;
			new_date.setUTCMinutes(new_date.getUTCMinutes() + (dir * this.minuteStep));
			return new_date;
		},

		moveHour: function (date, dir) {
			if (!dir) return date;
			var new_date = new Date(date.valueOf());
			//dir = dir > 0 ? 1 : -1;
			new_date.setUTCHours(new_date.getUTCHours() + dir);
			return new_date;
		},

		moveDate: function (date, dir) {
			if (!dir) return date;
			var new_date = new Date(date.valueOf());
			//dir = dir > 0 ? 1 : -1;
			new_date.setUTCDate(new_date.getUTCDate() + dir);
			return new_date;
		},

		moveMonth: function (date, dir) {
			if (!dir) return date;
			var new_date = new Date(date.valueOf()),
				day = new_date.getUTCDate(),
				month = new_date.getUTCMonth(),
				mag = Math.abs(dir),
				new_month, test;
			dir = dir > 0 ? 1 : -1;
			if (mag == 1) {
				test = dir == -1
					// If going back one month, make sure month is not current month
					// (eg, Mar 31 -> Feb 31 == Feb 28, not Mar 02)
					? function () {
					return new_date.getUTCMonth() == month;
				}
					// If going forward one month, make sure month is as expected
					// (eg, Jan 31 -> Feb 31 == Feb 28, not Mar 02)
					: function () {
					return new_date.getUTCMonth() != new_month;
				};
				new_month = month + dir;
				new_date.setUTCMonth(new_month);
				// Dec -> Jan (12) or Jan -> Dec (-1) -- limit expected date to 0-11
				if (new_month < 0 || new_month > 11)
					new_month = (new_month + 12) % 12;
			} else {
				// For magnitudes >1, move one month at a time...
				for (var i = 0; i < mag; i++)
					// ...which might decrease the day (eg, Jan 31 to Feb 28, etc)...
					new_date = this.moveMonth(new_date, dir);
				// ...then reset the day, keeping it in the new month
				new_month = new_date.getUTCMonth();
				new_date.setUTCDate(day);
				test = function () {
					return new_month != new_date.getUTCMonth();
				};
			}
			// Common date-resetting loop -- if date is beyond end of month, make it
			// end of month
			while (test()) {
				new_date.setUTCDate(--day);
				new_date.setUTCMonth(new_month);
			}
			return new_date;
		},

		moveYear: function (date, dir) {
			return this.moveMonth(date, dir * 12);
		},

		dateWithinRange: function (date) {
			return date >= this.startDate && date <= this.endDate;
		},

		keydown: function (e) {
			if (this.picker.is(':not(:visible)')) {
				if (e.keyCode == 27) // allow escape to hide and re-show picker
					this.show();
				return;
			}
			var dateChanged = false,
				dir, day, month,
				newDate, newViewDate;
			switch (e.keyCode) {
				case 27: // escape
					this.hide();
					e.preventDefault();
					break;
				case 37: // left
				case 39: // right
					if (!this.keyboardNavigation) break;
					dir = e.keyCode == 37 ? -1 : 1;
					viewMode = this.viewMode;
					if (e.ctrlKey) {
						viewMode += 2;
					} else if (e.shiftKey) {
						viewMode += 1;
					}
					if (viewMode == 4) {
						newDate = this.moveYear(this.date, dir);
						newViewDate = this.moveYear(this.viewDate, dir);
					} else if (viewMode == 3) {
						newDate = this.moveMonth(this.date, dir);
						newViewDate = this.moveMonth(this.viewDate, dir);
					} else if (viewMode == 2) {
						newDate = this.moveDate(this.date, dir);
						newViewDate = this.moveDate(this.viewDate, dir);
					} else if (viewMode == 1) {
						newDate = this.moveHour(this.date, dir);
						newViewDate = this.moveHour(this.viewDate, dir);
					} else if (viewMode == 0) {
						newDate = this.moveMinute(this.date, dir);
						newViewDate = this.moveMinute(this.viewDate, dir);
					}
					if (this.dateWithinRange(newDate)) {
						this.date = newDate;
						this.viewDate = newViewDate;
						this.setValue();
						this.update();
						e.preventDefault();
						dateChanged = true;
					}
					break;
				case 38: // up
				case 40: // down
					if (!this.keyboardNavigation) break;
					dir = e.keyCode == 38 ? -1 : 1;
					viewMode = this.viewMode;
					if (e.ctrlKey) {
						viewMode += 2;
					} else if (e.shiftKey) {
						viewMode += 1;
					}
					if (viewMode == 4) {
						newDate = this.moveYear(this.date, dir);
						newViewDate = this.moveYear(this.viewDate, dir);
					} else if (viewMode == 3) {
						newDate = this.moveMonth(this.date, dir);
						newViewDate = this.moveMonth(this.viewDate, dir);
					} else if (viewMode == 2) {
						newDate = this.moveDate(this.date, dir * 7);
						newViewDate = this.moveDate(this.viewDate, dir * 7);
					} else if (viewMode == 1) {
						if (this.showMeridian) {
							newDate = this.moveHour(this.date, dir * 6);
							newViewDate = this.moveHour(this.viewDate, dir * 6);
						} else {
							newDate = this.moveHour(this.date, dir * 4);
							newViewDate = this.moveHour(this.viewDate, dir * 4);
						}
					} else if (viewMode == 0) {
						newDate = this.moveMinute(this.date, dir * 4);
						newViewDate = this.moveMinute(this.viewDate, dir * 4);
					}
					if (this.dateWithinRange(newDate)) {
						this.date = newDate;
						this.viewDate = newViewDate;
						this.setValue();
						this.update();
						e.preventDefault();
						dateChanged = true;
					}
					break;
				case 13: // enter
					if (this.viewMode != 0) {
						var oldViewMode = this.viewMode;
						this.showMode(-1);
						this.fill();
						if (oldViewMode == this.viewMode && this.autoclose) {
							this.hide();
						}
					} else {
						this.fill();
						if (this.autoclose) {
							this.hide();
						}
					}
					e.preventDefault();
					break;
				case 9: // tab
					this.hide();
					break;
			}
			if (dateChanged) {
				var element;
				if (this.isInput) {
					element = this.element;
				} else if (this.component) {
					element = this.element.find('input');
				}
				if (element) {
					element.change();
				}
				this.element.trigger({
					type: 'changeDate',
					date: this.date
				});
			}
		},

		showMode: function (dir) {
			if (dir) {
				var newViewMode = Math.max(0, Math.min(DPGlobal.modes.length - 1, this.viewMode + dir));
				if (newViewMode >= this.minView && newViewMode <= this.maxView) {
					this.element.trigger({
						type:        'changeMode',
						date:        this.viewDate,
						oldViewMode: this.viewMode,
						newViewMode: newViewMode
					});

					this.viewMode = newViewMode;
				}
			}
			/*
			 vitalets: fixing bug of very special conditions:
			 jquery 1.7.1 + webkit + show inline datetimepicker in bootstrap popover.
			 Method show() does not set display css correctly and datetimepicker is not shown.
			 Changed to .css('display', 'block') solve the problem.
			 See https://github.com/vitalets/x-editable/issues/37

			 In jquery 1.7.2+ everything works fine.
			 */
			//this.picker.find('>div').hide().filter('.datetimepicker-'+DPGlobal.modes[this.viewMode].clsName).show();
			this.picker.find('>div').hide().filter('.datetimepicker-' + DPGlobal.modes[this.viewMode].clsName).css('display', 'block');
			this.updateNavArrows();
		},

		reset: function (e) {
			this._setDate(null, 'date');
		},

		convertViewModeText:  function (viewMode) {
			switch (viewMode) {
				case 4:
					return 'decade';
				case 3:
					return 'year';
				case 2:
					return 'month';
				case 1:
					return 'day';
				case 0:
					return 'hour';
			}
		}
	};

	$.fn.datetimepicker = function (option) {
		var args = Array.apply(null, arguments);
		args.shift();
		var internal_return;
		this.each(function () {
			var $this = $(this),
				data = $this.data('datetimepicker'),
				options = typeof option == 'object' && option;
			if (!data) {
				$this.data('datetimepicker', (data = new Datetimepicker(this, $.extend({}, $.fn.datetimepicker.defaults, options))));
			}
			if (typeof option == 'string' && typeof data[option] == 'function') {
				internal_return = data[option].apply(data, args);
				if (internal_return !== undefined) {
					return false;
				}
			}
		});
		if (internal_return !== undefined)
			return internal_return;
		else
			return this;
	};

	$.fn.datetimepicker.defaults = {
	};
	$.fn.datetimepicker.Constructor = Datetimepicker;
	var dates = $.fn.datetimepicker.dates = {
		en: {
			days:        ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
			daysShort:   ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
			daysMin:     ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
			months:      ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
			monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			meridiem:    ["am", "pm"],
			suffix:      ["st", "nd", "rd", "th"],
			today:       "Today"
		}
	};

	var DPGlobal = {
		modes:            [
			{
				clsName: 'minutes',
				navFnc:  'Hours',
				navStep: 1
			},
			{
				clsName: 'hours',
				navFnc:  'Date',
				navStep: 1
			},
			{
				clsName: 'days',
				navFnc:  'Month',
				navStep: 1
			},
			{
				clsName: 'months',
				navFnc:  'FullYear',
				navStep: 1
			},
			{
				clsName: 'years',
				navFnc:  'FullYear',
				navStep: 10
			}
		],
		isLeapYear:       function (year) {
			return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0))
		},
		getDaysInMonth:   function (year, month) {
			return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month]
		},
		getDefaultFormat: function (type, field) {
			if (type == "standard") {
				if (field == 'input')
					return 'yyyy-mm-dd hh:ii';
				else
					return 'yyyy-mm-dd hh:ii:ss';
			} else if (type == "php") {
				if (field == 'input')
					return 'Y-m-d H:i';
				else
					return 'Y-m-d H:i:s';
			} else {
				throw new Error("Invalid format type.");
			}
		},
		validParts:       function (type) {
			if (type == "standard") {
				return /hh?|HH?|p|P|ii?|ss?|dd?|DD?|mm?|MM?|yy(?:yy)?/g;
			} else if (type == "php") {
				return /[dDjlNwzFmMnStyYaABgGhHis]/g;
			} else {
				throw new Error("Invalid format type.");
			}
		},
		nonpunctuation:   /[^ -\/:-@\[-`{-~\t\n\rTZ]+/g,
		parseFormat:      function (format, type) {
			// IE treats \0 as a string end in inputs (truncating the value),
			// so it's a bad format delimiter, anyway
			var separators = format.replace(this.validParts(type), '\0').split('\0'),
				parts = format.match(this.validParts(type));
			if (!separators || !separators.length || !parts || parts.length == 0) {
				throw new Error("Invalid date format.");
			}
			return {separators: separators, parts: parts};
		},
		parseDate:        function (date, format, language, type) {
			if (date instanceof Date) {
				var dateUTC = new Date(date.valueOf() - date.getTimezoneOffset() * 60000);
				dateUTC.setMilliseconds(0);
				return dateUTC;
			}
			if (/^\d{4}\-\d{1,2}\-\d{1,2}$/.test(date)) {
				format = this.parseFormat('yyyy-mm-dd', type);
			}
			if (/^\d{4}\-\d{1,2}\-\d{1,2}[T ]\d{1,2}\:\d{1,2}$/.test(date)) {
				format = this.parseFormat('yyyy-mm-dd hh:ii', type);
			}
			if (/^\d{4}\-\d{1,2}\-\d{1,2}[T ]\d{1,2}\:\d{1,2}\:\d{1,2}[Z]{0,1}$/.test(date)) {
				format = this.parseFormat('yyyy-mm-dd hh:ii:ss', type);
			}
			if (/^[-+]\d+[dmwy]([\s,]+[-+]\d+[dmwy])*$/.test(date)) {
				var part_re = /([-+]\d+)([dmwy])/,
					parts = date.match(/([-+]\d+)([dmwy])/g),
					part, dir;
				date = new Date();
				for (var i = 0; i < parts.length; i++) {
					part = part_re.exec(parts[i]);
					dir = parseInt(part[1]);
					switch (part[2]) {
						case 'd':
							date.setUTCDate(date.getUTCDate() + dir);
							break;
						case 'm':
							date = Datetimepicker.prototype.moveMonth.call(Datetimepicker.prototype, date, dir);
							break;
						case 'w':
							date.setUTCDate(date.getUTCDate() + dir * 7);
							break;
						case 'y':
							date = Datetimepicker.prototype.moveYear.call(Datetimepicker.prototype, date, dir);
							break;
					}
				}
				return UTCDate(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), date.getUTCHours(), date.getUTCMinutes(), date.getUTCSeconds(), 0);
			}
			var parts = date && date.match(this.nonpunctuation) || [],
				date = new Date(0, 0, 0, 0, 0, 0, 0),
				parsed = {},
				setters_order = ['hh', 'h', 'ii', 'i', 'ss', 's', 'yyyy', 'yy', 'M', 'MM', 'm', 'mm', 'D', 'DD', 'd', 'dd', 'H', 'HH', 'p', 'P'],
				setters_map = {
					hh:   function (d, v) {
						return d.setUTCHours(v);
					},
					h:    function (d, v) {
						return d.setUTCHours(v);
					},
					HH:   function (d, v) {
						return d.setUTCHours(v == 12 ? 0 : v);
					},
					H:    function (d, v) {
						return d.setUTCHours(v == 12 ? 0 : v);
					},
					ii:   function (d, v) {
						return d.setUTCMinutes(v);
					},
					i:    function (d, v) {
						return d.setUTCMinutes(v);
					},
					ss:   function (d, v) {
						return d.setUTCSeconds(v);
					},
					s:    function (d, v) {
						return d.setUTCSeconds(v);
					},
					yyyy: function (d, v) {
						return d.setUTCFullYear(v);
					},
					yy:   function (d, v) {
						return d.setUTCFullYear(2000 + v);
					},
					m:    function (d, v) {
						v -= 1;
						while (v < 0) v += 12;
						v %= 12;
						d.setUTCMonth(v);
						while (d.getUTCMonth() != v)
							if (isNaN(d.getUTCMonth()))
								return d;
							else
								d.setUTCDate(d.getUTCDate() - 1);
						return d;
					},
					d:    function (d, v) {
						return d.setUTCDate(v);
					},
					p:    function (d, v) {
						return d.setUTCHours(v == 1 ? d.getUTCHours() + 12 : d.getUTCHours());
					}
				},
				val, filtered, part;
			setters_map['M'] = setters_map['MM'] = setters_map['mm'] = setters_map['m'];
			setters_map['dd'] = setters_map['d'];
			setters_map['P'] = setters_map['p'];
			date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), date.getHours(), date.getMinutes(), date.getSeconds());
			if (parts.length == format.parts.length) {
				for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
					val = parseInt(parts[i], 10);
					part = format.parts[i];
					if (isNaN(val)) {
						switch (part) {
							case 'MM':
								filtered = $(dates[language].months).filter(function () {
									var m = this.slice(0, parts[i].length),
										p = parts[i].slice(0, m.length);
									return m == p;
								});
								val = $.inArray(filtered[0], dates[language].months) + 1;
								break;
							case 'M':
								filtered = $(dates[language].monthsShort).filter(function () {
									var m = this.slice(0, parts[i].length),
										p = parts[i].slice(0, m.length);
									return m.toLowerCase() == p.toLowerCase();
								});
								val = $.inArray(filtered[0], dates[language].monthsShort) + 1;
								break;
							case 'p':
							case 'P':
								val = $.inArray(parts[i].toLowerCase(), dates[language].meridiem);
								break;
						}
					}
					parsed[part] = val;
				}
				for (var i = 0, s; i < setters_order.length; i++) {
					s = setters_order[i];
					if (s in parsed && !isNaN(parsed[s]))
						setters_map[s](date, parsed[s])
				}
			}
			return date;
		},
		formatDate:       function (date, format, language, type) {
			if (date == null) {
				return '';
			}
			var val;
			if (type == 'standard') {
				val = {
					// year
					yy:   date.getUTCFullYear().toString().substring(2),
					yyyy: date.getUTCFullYear(),
					// month
					m:    date.getUTCMonth() + 1,
					M:    dates[language].monthsShort[date.getUTCMonth()],
					MM:   dates[language].months[date.getUTCMonth()],
					// day
					d:    date.getUTCDate(),
					D:    dates[language].daysShort[date.getUTCDay()],
					DD:   dates[language].days[date.getUTCDay()],
					p:    (dates[language].meridiem.length == 2 ? dates[language].meridiem[date.getUTCHours() < 12 ? 0 : 1] : ''),
					// hour
					h:    date.getUTCHours(),
					// minute
					i:    date.getUTCMinutes(),
					// second
					s:    date.getUTCSeconds()
				};

				if (dates[language].meridiem.length == 2) {
					val.H = (val.h % 12 == 0 ? 12 : val.h % 12);
				}
				else {
					val.H = val.h;
				}
				val.HH = (val.H < 10 ? '0' : '') + val.H;
				val.P = val.p.toUpperCase();
				val.hh = (val.h < 10 ? '0' : '') + val.h;
				val.ii = (val.i < 10 ? '0' : '') + val.i;
				val.ss = (val.s < 10 ? '0' : '') + val.s;
				val.dd = (val.d < 10 ? '0' : '') + val.d;
				val.mm = (val.m < 10 ? '0' : '') + val.m;
			} else if (type == 'php') {
				// php format
				val = {
					// year
					y: date.getUTCFullYear().toString().substring(2),
					Y: date.getUTCFullYear(),
					// month
					F: dates[language].months[date.getUTCMonth()],
					M: dates[language].monthsShort[date.getUTCMonth()],
					n: date.getUTCMonth() + 1,
					t: DPGlobal.getDaysInMonth(date.getUTCFullYear(), date.getUTCMonth()),
					// day
					j: date.getUTCDate(),
					l: dates[language].days[date.getUTCDay()],
					D: dates[language].daysShort[date.getUTCDay()],
					w: date.getUTCDay(), // 0 -> 6
					N: (date.getUTCDay() == 0 ? 7 : date.getUTCDay()),       // 1 -> 7
					S: (date.getUTCDate() % 10 <= dates[language].suffix.length ? dates[language].suffix[date.getUTCDate() % 10 - 1] : ''),
					// hour
					a: (dates[language].meridiem.length == 2 ? dates[language].meridiem[date.getUTCHours() < 12 ? 0 : 1] : ''),
					g: (date.getUTCHours() % 12 == 0 ? 12 : date.getUTCHours() % 12),
					G: date.getUTCHours(),
					// minute
					i: date.getUTCMinutes(),
					// second
					s: date.getUTCSeconds()
				};
				val.m = (val.n < 10 ? '0' : '') + val.n;
				val.d = (val.j < 10 ? '0' : '') + val.j;
				val.A = val.a.toString().toUpperCase();
				val.h = (val.g < 10 ? '0' : '') + val.g;
				val.H = (val.G < 10 ? '0' : '') + val.G;
				val.i = (val.i < 10 ? '0' : '') + val.i;
				val.s = (val.s < 10 ? '0' : '') + val.s;
			} else {
				throw new Error("Invalid format type.");
			}
			var date = [],
				seps = $.extend([], format.separators);
			for (var i = 0, cnt = format.parts.length; i < cnt; i++) {
				if (seps.length) {
					date.push(seps.shift());
				}
				date.push(val[format.parts[i]]);
			}
			if (seps.length) {
				date.push(seps.shift());
			}
			return date.join('');
		},
		convertViewMode:  function (viewMode) {
			switch (viewMode) {
				case 4:
				case 'decade':
					viewMode = 4;
					break;
				case 3:
				case 'year':
					viewMode = 3;
					break;
				case 2:
				case 'month':
					viewMode = 2;
					break;
				case 1:
				case 'day':
					viewMode = 1;
					break;
				case 0:
				case 'hour':
					viewMode = 0;
					break;
			}

			return viewMode;
		},
		headTemplate:     '<thead>' +
							  '<tr>' +
							  '<th class="prev"><i class="icon-arrow-left"/></th>' +
							  '<th colspan="5" class="switch"></th>' +
							  '<th class="next"><i class="icon-arrow-right"/></th>' +
							  '</tr>' +
			'</thead>',
		headTemplateV3:   '<thead>' +
							  '<tr>' +
							  '<th class="prev"><span class="glyphicon glyphicon-arrow-left"></span> </th>' +
							  '<th colspan="5" class="switch"></th>' +
							  '<th class="next"><span class="glyphicon glyphicon-arrow-right"></span> </th>' +
							  '</tr>' +
			'</thead>',
		contTemplate:     '<tbody><tr><td colspan="7"></td></tr></tbody>',
		footTemplate:     '<tfoot><tr><th colspan="7" class="today"></th></tr></tfoot>'
	};
	DPGlobal.template = '<div class="datetimepicker">' +
		'<div class="datetimepicker-minutes">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplate +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-hours">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplate +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-days">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplate +
		'<tbody></tbody>' +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-months">' +
		'<table class="table-condensed">' +
		DPGlobal.headTemplate +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-years">' +
		'<table class="table-condensed">' +
		DPGlobal.headTemplate +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'</div>';
	DPGlobal.templateV3 = '<div class="datetimepicker">' +
		'<div class="datetimepicker-minutes">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplateV3 +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-hours">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplateV3 +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-days">' +
		'<table class=" table-condensed">' +
		DPGlobal.headTemplateV3 +
		'<tbody></tbody>' +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-months">' +
		'<table class="table-condensed">' +
		DPGlobal.headTemplateV3 +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'<div class="datetimepicker-years">' +
		'<table class="table-condensed">' +
		DPGlobal.headTemplateV3 +
		DPGlobal.contTemplate +
		DPGlobal.footTemplate +
		'</table>' +
		'</div>' +
		'</div>';
	$.fn.datetimepicker.DPGlobal = DPGlobal;

	/* DATETIMEPICKER NO CONFLICT
	 * =================== */

	$.fn.datetimepicker.noConflict = function () {
		$.fn.datetimepicker = old;
		return this;
	};

	/* DATETIMEPICKER DATA-API
	 * ================== */

	$(document).on(
		'focus.datetimepicker.data-api click.datetimepicker.data-api',
		'[data-provide="datetimepicker"]',
		function (e) {
			var $this = $(this);
			if ($this.data('datetimepicker')) return;
			e.preventDefault();
			// component click requires us to explicitly show it
			$this.datetimepicker('show');
		}
	);
	$(function () {
		$('[data-provide="datetimepicker-inline"]').datetimepicker();
	});

}(window.jQuery);
/**
 * Simplified Chinese translation for bootstrap-datetimepicker
 * Yuan Cheung <advanimal@gmail.com>
 */
;(function($){
	$.fn.datetimepicker.dates['zh-CN'] = {
			days: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"],
			daysShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六", "周日"],
			daysMin:  ["日", "一", "二", "三", "四", "五", "六", "日"],
			months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
			monthsShort: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
			today: "今日",
			suffix: [],
			meridiem: ["上午", "下午"],
			format: "yyyy-mm-dd" /*控制显示格式*/
	};
}(jQuery));
/*!
 * ClockPicker v{package.version} (http://weareoutman.github.io/clockpicker/)
 * Copyright 2014 Wang Shenwei.
 * Licensed under MIT (https://github.com/weareoutman/clockpicker/blob/gh-pages/LICENSE)
 */

;(function(){
	var $ = window.jQuery,
		$win = $(window),
		$doc = $(document),
		$body;

	// Can I use inline svg ?
	var svgNS = 'http://www.w3.org/2000/svg',
		svgSupported = 'SVGAngle' in window && (function(){
			var supported,
				el = document.createElement('div');
			el.innerHTML = '<svg/>';
			supported = (el.firstChild && el.firstChild.namespaceURI) == svgNS;
			el.innerHTML = '';
			return supported;
		})();

	// Can I use transition ?
	var transitionSupported = (function(){
		var style = document.createElement('div').style;
		return 'transition' in style ||
			'WebkitTransition' in style ||
			'MozTransition' in style ||
			'msTransition' in style ||
			'OTransition' in style;
	})();

	// Listen touch events in touch screen device, instead of mouse events in desktop.
	var touchSupported = 'ontouchstart' in window,
		mousedownEvent = 'mousedown' + ( touchSupported ? ' touchstart' : ''),
		mousemoveEvent = 'mousemove.clockpicker' + ( touchSupported ? ' touchmove.clockpicker' : ''),
		mouseupEvent = 'mouseup.clockpicker' + ( touchSupported ? ' touchend.clockpicker' : '');

	// Vibrate the device if supported
	var vibrate = navigator.vibrate ? 'vibrate' : navigator.webkitVibrate ? 'webkitVibrate' : null;

	function createSvgElement(name) {
		return document.createElementNS(svgNS, name);
	}

	function leadingZero(num) {
		return (num < 10 ? '0' : '') + num;
	}

	// Get a unique id
	var idCounter = 0;
	function uniqueId(prefix) {
		var id = ++idCounter + '';
		return prefix ? prefix + id : id;
	}

	// Clock size
	var dialRadius = 100,
		outerRadius = 80,
		// innerRadius = 80 on 12 hour clock
		innerRadius = 54,
		tickRadius = 13,
		diameter = dialRadius * 2,
		duration = transitionSupported ? 350 : 1;

	// Popover template
	var tpl = [
		'<div class="popover clockpicker-popover">',
			'<div class="arrow"></div>',
			'<div class="popover-title">',
				'<span class="clockpicker-span-hours text-primary"></span>',
				' : ',
				'<span class="clockpicker-span-minutes"></span>',
				'<span class="clockpicker-span-am-pm"></span>',
			'</div>',
			'<div class="popover-content">',
				'<div class="clockpicker-plate">',
					'<div class="clockpicker-canvas"></div>',
					'<div class="clockpicker-dial clockpicker-hours"></div>',
					'<div class="clockpicker-dial clockpicker-minutes clockpicker-dial-out"></div>',
				'</div>',
				'<span class="clockpicker-am-pm-block">',
				'</span>',
			'</div>',
		'</div>'
	].join('');

	// ClockPicker
	function ClockPicker(element, options) {
		var popover = $(tpl),
			plate = popover.find('.clockpicker-plate'),
			hoursView = popover.find('.clockpicker-hours'),
			minutesView = popover.find('.clockpicker-minutes'),
			amPmBlock = popover.find('.clockpicker-am-pm-block'),
			isInput = element.prop('tagName') === 'INPUT',
			input = isInput ? element : element.find('input'),
			addon = element.find('.input-group-addon'),
			self = this,
			timer;

		this.id = uniqueId('cp');
		this.element = element;
		this.options = options;
		this.isAppended = false;
		this.isShown = false;
		this.currentView = 'hours';
		this.isInput = isInput;
		this.input = input;
		this.addon = addon;
		this.popover = popover;
		this.plate = plate;
		this.hoursView = hoursView;
		this.minutesView = minutesView;
		this.amPmBlock = amPmBlock;
		this.spanHours = popover.find('.clockpicker-span-hours');
		this.spanMinutes = popover.find('.clockpicker-span-minutes');
		this.spanAmPm = popover.find('.clockpicker-span-am-pm');
		this.amOrPm = "PM";

		// Setup for for 12 hour clock if option is selected
		if (options.twelvehour) {

			var  amPmButtonsTemplate = ['<div class="clockpicker-am-pm-block">',
				'<button type="button" class="btn btn-sm btn-default clockpicker-button clockpicker-am-button">',
				'AM</button>',
				'<button type="button" class="btn btn-sm btn-default clockpicker-button clockpicker-pm-button">',
				'PM</button>',
				'</div>'].join('');

			var amPmButtons = $(amPmButtonsTemplate);
			//amPmButtons.appendTo(plate);

			////Not working b/c they are not shown when this runs
			//$('clockpicker-am-button')
			//    .on("click", function() {
			//        self.amOrPm = "AM";
			//        $('.clockpicker-span-am-pm').empty().append('AM');
			//    });
			//
			//$('clockpicker-pm-button')
			//    .on("click", function() {
			//         self.amOrPm = "PM";
			//        $('.clockpicker-span-am-pm').empty().append('PM');
			//    });

			$('<button type="button" class="btn btn-sm btn-default clockpicker-button am-button">' + "AM" + '</button>')
				.on("click", function() {
					self.amOrPm = "AM";
					$('.clockpicker-span-am-pm').empty().append('AM');
				}).appendTo(this.amPmBlock);


			$('<button type="button" class="btn btn-sm btn-default clockpicker-button pm-button">' + "PM" + '</button>')
				.on("click", function() {
					self.amOrPm = 'PM';
					$('.clockpicker-span-am-pm').empty().append('PM');
				}).appendTo(this.amPmBlock);

		}

		if (! options.autoclose) {
			// If autoclose is not setted, append a button
			$('<button type="button" class="btn btn-sm btn-default btn-block clockpicker-button">' + options.donetext + '</button>')
				.click($.proxy(this.done, this))
				.appendTo(popover);
		}

		// Placement and arrow align - make sure they make sense.
		if ((options.placement === 'top' || options.placement === 'bottom') && (options.align === 'top' || options.align === 'bottom')) options.align = 'left';
		if ((options.placement === 'left' || options.placement === 'right') && (options.align === 'left' || options.align === 'right')) options.align = 'top';

		popover.addClass(options.placement);
		popover.addClass('clockpicker-align-' + options.align);

		this.spanHours.click($.proxy(this.toggleView, this, 'hours'));
		this.spanMinutes.click($.proxy(this.toggleView, this, 'minutes'));

		// Show or toggle
		input.on('focus.clockpicker click.clockpicker', $.proxy(this.show, this));
		addon.on('click.clockpicker', $.proxy(this.toggle, this));

		// Build ticks
		var tickTpl = $('<div class="clockpicker-tick"></div>'),
			i, tick, radian, radius;

		// Hours view
		if (options.twelvehour) {
			for (i = 1; i < 13; i += 1) {
				tick = tickTpl.clone();
				radian = i / 6 * Math.PI;
				radius = outerRadius;
				tick.css('font-size', '120%');
				tick.css({
					left: dialRadius + Math.sin(radian) * radius - tickRadius,
					top: dialRadius - Math.cos(radian) * radius - tickRadius
				});
				tick.html(i === 0 ? '00' : i);
				hoursView.append(tick);
				tick.on(mousedownEvent, mousedown);
			}
		} else {
			for (i = 0; i < 24; i += 1) {
				tick = tickTpl.clone();
				radian = i / 6 * Math.PI;
				var inner = i > 0 && i < 13;
				radius = inner ? innerRadius : outerRadius;
				tick.css({
					left: dialRadius + Math.sin(radian) * radius - tickRadius,
					top: dialRadius - Math.cos(radian) * radius - tickRadius
				});
				if (inner) {
					tick.css('font-size', '120%');
				}
				tick.html(i === 0 ? '00' : i);
				hoursView.append(tick);
				tick.on(mousedownEvent, mousedown);
			}
		}

		// Minutes view
		for (i = 0; i < 60; i += 5) {
			tick = tickTpl.clone();
			radian = i / 30 * Math.PI;
			tick.css({
				left: dialRadius + Math.sin(radian) * outerRadius - tickRadius,
				top: dialRadius - Math.cos(radian) * outerRadius - tickRadius
			});
			tick.css('font-size', '120%');
			tick.html(leadingZero(i));
			minutesView.append(tick);
			tick.on(mousedownEvent, mousedown);
		}

		// Clicking on minutes view space
		plate.on(mousedownEvent, function(e){
			if ($(e.target).closest('.clockpicker-tick').length === 0) {
				mousedown(e, true);
			}
		});

		// Mousedown or touchstart
		function mousedown(e, space) {
			var offset = plate.offset(),
				isTouch = /^touch/.test(e.type),
				x0 = offset.left + dialRadius,
				y0 = offset.top + dialRadius,
				dx = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
				dy = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0,
				z = Math.sqrt(dx * dx + dy * dy),
				moved = false;

			// When clicking on minutes view space, check the mouse position
			if (space && (z < outerRadius - tickRadius || z > outerRadius + tickRadius)) {
				return;
			}
			e.preventDefault();

			// Set cursor style of body after 200ms
			var movingTimer = setTimeout(function(){
				$body.addClass('clockpicker-moving');
			}, 200);

			// Place the canvas to top
			if (svgSupported) {
				plate.append(self.canvas);
			}

			// Clock
			self.setHand(dx, dy, ! space, true);

			// Mousemove on document
			$doc.off(mousemoveEvent).on(mousemoveEvent, function(e){
				e.preventDefault();
				var isTouch = /^touch/.test(e.type),
					x = (isTouch ? e.originalEvent.touches[0] : e).pageX - x0,
					y = (isTouch ? e.originalEvent.touches[0] : e).pageY - y0;
				if (! moved && x === dx && y === dy) {
					// Clicking in chrome on windows will trigger a mousemove event
					return;
				}
				moved = true;
				self.setHand(x, y, false, true);
			});

			// Mouseup on document
			$doc.off(mouseupEvent).on(mouseupEvent, function(e){
				$doc.off(mouseupEvent);
				e.preventDefault();
				var isTouch = /^touch/.test(e.type),
					x = (isTouch ? e.originalEvent.changedTouches[0] : e).pageX - x0,
					y = (isTouch ? e.originalEvent.changedTouches[0] : e).pageY - y0;
				if ((space || moved) && x === dx && y === dy) {
					self.setHand(x, y);
				}
				if (self.currentView === 'hours') {
					self.toggleView('minutes', duration / 2);
				} else {
					if (options.autoclose) {
						self.minutesView.addClass('clockpicker-dial-out');
						setTimeout(function(){
							self.done();
						}, duration / 2);
					}
				}
				plate.prepend(canvas);

				// Reset cursor style of body
				clearTimeout(movingTimer);
				$body.removeClass('clockpicker-moving');

				// Unbind mousemove event
				$doc.off(mousemoveEvent);
			});
		}

		if (svgSupported) {
			// Draw clock hands and others
			var canvas = popover.find('.clockpicker-canvas'),
				svg = createSvgElement('svg');
			svg.setAttribute('class', 'clockpicker-svg');
			svg.setAttribute('width', diameter);
			svg.setAttribute('height', diameter);
			var g = createSvgElement('g');
			g.setAttribute('transform', 'translate(' + dialRadius + ',' + dialRadius + ')');
			var bearing = createSvgElement('circle');
			bearing.setAttribute('class', 'clockpicker-canvas-bearing');
			bearing.setAttribute('cx', 0);
			bearing.setAttribute('cy', 0);
			bearing.setAttribute('r', 2);
			var hand = createSvgElement('line');
			hand.setAttribute('x1', 0);
			hand.setAttribute('y1', 0);
			var bg = createSvgElement('circle');
			bg.setAttribute('class', 'clockpicker-canvas-bg');
			bg.setAttribute('r', tickRadius);
			var fg = createSvgElement('circle');
			fg.setAttribute('class', 'clockpicker-canvas-fg');
			fg.setAttribute('r', 3.5);
			g.appendChild(hand);
			g.appendChild(bg);
			g.appendChild(fg);
			g.appendChild(bearing);
			svg.appendChild(g);
			canvas.append(svg);

			this.hand = hand;
			this.bg = bg;
			this.fg = fg;
			this.bearing = bearing;
			this.g = g;
			this.canvas = canvas;
		}

		raiseCallback(this.options.init);
	}

	function raiseCallback(callbackFunction) {
		if (callbackFunction && typeof callbackFunction === "function") {
			callbackFunction();
		}
	}

	// Default options
	ClockPicker.DEFAULTS = {
		'default': '',       // default time, 'now' or '13:14' e.g.
		fromnow: 0,          // set default time to * milliseconds from now (using with default = 'now')
		placement: 'bottom', // clock popover placement
		align: 'left',       // popover arrow align
		donetext: '完成',    // done button text
		autoclose: false,    // auto close when minute is selected
		twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
		vibrate: true        // vibrate the device when dragging clock hand
	};

	// Show or hide popover
	ClockPicker.prototype.toggle = function(){
		this[this.isShown ? 'hide' : 'show']();
	};

	// Set popover position
	ClockPicker.prototype.locate = function(){
		var element = this.element,
			popover = this.popover,
			offset = element.offset(),
			width = element.outerWidth(),
			height = element.outerHeight(),
			placement = this.options.placement,
			align = this.options.align,
			styles = {},
			self = this;

		popover.show();

		// Place the popover
		switch (placement) {
			case 'bottom':
				styles.top = offset.top + height;
				break;
			case 'right':
				styles.left = offset.left + width;
				break;
			case 'top':
				styles.top = offset.top - popover.outerHeight();
				break;
			case 'left':
				styles.left = offset.left - popover.outerWidth();
				break;
		}

		// Align the popover arrow
		switch (align) {
			case 'left':
				styles.left = offset.left;
				break;
			case 'right':
				styles.left = offset.left + width - popover.outerWidth();
				break;
			case 'top':
				styles.top = offset.top;
				break;
			case 'bottom':
				styles.top = offset.top + height - popover.outerHeight();
				break;
		}

		popover.css(styles);
	};

	// Show popover
	ClockPicker.prototype.show = function(e){
		// Not show again
		if (this.isShown) {
			return;
		}

		raiseCallback(this.options.beforeShow);

		var self = this;

		// Initialize
		if (! this.isAppended) {
			// Append popover to body
			$body = $(document.body).append(this.popover);

			// Reset position when resize
			$win.on('resize.clockpicker' + this.id, function(){
				if (self.isShown) {
					self.locate();
				}
			});

			this.isAppended = true;
		}

		// Get the time
		var value = ((this.input.prop('value') || this.options['default'] || '') + '').split(':');
		if (value[0] === 'now') {
			var now = new Date(+ new Date() + this.options.fromnow);
			value = [
				now.getHours(),
				now.getMinutes()
			];
		}
		this.hours = + value[0] || 0;
		this.minutes = + value[1] || 0;
		this.spanHours.html(leadingZero(this.hours));
		this.spanMinutes.html(leadingZero(this.minutes));

		// Toggle to hours view
		this.toggleView('hours');

		// Set position
		this.locate();

		this.isShown = true;

		// Hide when clicking or tabbing on any element except the clock, input and addon
		$doc.on('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id, function(e){
			var target = $(e.target);
			if (target.closest(self.popover).length === 0 &&
					target.closest(self.addon).length === 0 &&
					target.closest(self.input).length === 0) {
				self.hide();
			}
		});

		// Hide when ESC is pressed
		$doc.on('keyup.clockpicker.' + this.id, function(e){
			if (e.keyCode === 27) {
				self.hide();
			}
		});

		raiseCallback(this.options.afterShow);
	};

	// Hide popover
	ClockPicker.prototype.hide = function(){
		raiseCallback(this.options.beforeHide);

		this.isShown = false;

		// Unbinding events on document
		$doc.off('click.clockpicker.' + this.id + ' focusin.clockpicker.' + this.id);
		$doc.off('keyup.clockpicker.' + this.id);

		this.popover.hide();

		raiseCallback(this.options.afterHide);
	};

	// Toggle to hours or minutes view
	ClockPicker.prototype.toggleView = function(view, delay){
		var raiseAfterHourSelect = false;
		if (view === 'minutes' && $(this.hoursView).css("visibility") === "visible") {
			raiseCallback(this.options.beforeHourSelect);
			raiseAfterHourSelect = true;
		}
		var isHours = view === 'hours',
			nextView = isHours ? this.hoursView : this.minutesView,
			hideView = isHours ? this.minutesView : this.hoursView;

		this.currentView = view;

		this.spanHours.toggleClass('text-primary', isHours);
		this.spanMinutes.toggleClass('text-primary', ! isHours);

		// Let's make transitions
		hideView.addClass('clockpicker-dial-out');
		nextView.css('visibility', 'visible').removeClass('clockpicker-dial-out');

		// Reset clock hand
		this.resetClock(delay);

		// After transitions ended
		clearTimeout(this.toggleViewTimer);
		this.toggleViewTimer = setTimeout(function(){
			hideView.css('visibility', 'hidden');
		}, duration);

		if (raiseAfterHourSelect) {
			raiseCallback(this.options.afterHourSelect);
		}
	};

	// Reset clock hand
	ClockPicker.prototype.resetClock = function(delay){
		var view = this.currentView,
			value = this[view],
			isHours = view === 'hours',
			unit = Math.PI / (isHours ? 6 : 30),
			radian = value * unit,
			radius = isHours && value > 0 && value < 13 ? innerRadius : outerRadius,
			x = Math.sin(radian) * radius,
			y = - Math.cos(radian) * radius,
			self = this;
		if (svgSupported && delay) {
			self.canvas.addClass('clockpicker-canvas-out');
			setTimeout(function(){
				self.canvas.removeClass('clockpicker-canvas-out');
				self.setHand(x, y);
			}, delay);
		} else {
			this.setHand(x, y);
		}
	};

	// Set clock hand to (x, y)
	ClockPicker.prototype.setHand = function(x, y, roundBy5, dragging){
		var radian = Math.atan2(x, - y),
			isHours = this.currentView === 'hours',
			unit = Math.PI / (isHours || roundBy5 ? 6 : 30),
			z = Math.sqrt(x * x + y * y),
			options = this.options,
			inner = isHours && z < (outerRadius + innerRadius) / 2,
			radius = inner ? innerRadius : outerRadius,
			value;

			if (options.twelvehour) {
				radius = outerRadius;
			}

		// Radian should in range [0, 2PI]
		if (radian < 0) {
			radian = Math.PI * 2 + radian;
		}

		// Get the round value
		value = Math.round(radian / unit);

		// Get the round radian
		radian = value * unit;

		// Correct the hours or minutes
		if (options.twelvehour) {
			if (isHours) {
				if (value === 0) {
					value = 12;
				}
			} else {
				if (roundBy5) {
					value *= 5;
				}
				if (value === 60) {
					value = 0;
				}
			}
		} else {
			if (isHours) {
				if (value === 12) {
					value = 0;
				}
				value = inner ? (value === 0 ? 12 : value) : value === 0 ? 0 : value + 12;
			} else {
				if (roundBy5) {
					value *= 5;
				}
				if (value === 60) {
					value = 0;
				}
			}
		}

		// Once hours or minutes changed, vibrate the device
		if (this[this.currentView] !== value) {
			if (vibrate && this.options.vibrate) {
				// Do not vibrate too frequently
				if (! this.vibrateTimer) {
					navigator[vibrate](10);
					this.vibrateTimer = setTimeout($.proxy(function(){
						this.vibrateTimer = null;
					}, this), 100);
				}
			}
		}

		this[this.currentView] = value;
		this[isHours ? 'spanHours' : 'spanMinutes'].html(leadingZero(value));

		// If svg is not supported, just add an active class to the tick
		if (! svgSupported) {
			this[isHours ? 'hoursView' : 'minutesView'].find('.clockpicker-tick').each(function(){
				var tick = $(this);
				tick.toggleClass('active', value === + tick.html());
			});
			return;
		}

		// Place clock hand at the top when dragging
		if (dragging || (! isHours && value % 5)) {
			this.g.insertBefore(this.hand, this.bearing);
			this.g.insertBefore(this.bg, this.fg);
			this.bg.setAttribute('class', 'clockpicker-canvas-bg clockpicker-canvas-bg-trans');
		} else {
			// Or place it at the bottom
			this.g.insertBefore(this.hand, this.bg);
			this.g.insertBefore(this.fg, this.bg);
			this.bg.setAttribute('class', 'clockpicker-canvas-bg');
		}

		// Set clock hand and others' position
		var cx = Math.sin(radian) * radius,
			cy = - Math.cos(radian) * radius;
		this.hand.setAttribute('x2', cx);
		this.hand.setAttribute('y2', cy);
		this.bg.setAttribute('cx', cx);
		this.bg.setAttribute('cy', cy);
		this.fg.setAttribute('cx', cx);
		this.fg.setAttribute('cy', cy);
	};

	// Hours and minutes are selected
	ClockPicker.prototype.done = function() {
		raiseCallback(this.options.beforeDone);
		this.hide();
		var last = this.input.prop('value'),
			value = leadingZero(this.hours) + ':' + leadingZero(this.minutes);
		if  (this.options.twelvehour) {
			value = value + this.amOrPm;
		}

		this.input.prop('value', value);
		if (value !== last) {
			this.input.triggerHandler('change');
			if (! this.isInput) {
				this.element.trigger('change');
			}
		}

		if (this.options.autoclose) {
			this.input.trigger('blur');
		}

		raiseCallback(this.options.afterDone);
	};

	// Remove clockpicker from input
	ClockPicker.prototype.remove = function() {
		this.element.removeData('clockpicker');
		this.input.off('focus.clockpicker click.clockpicker');
		this.addon.off('click.clockpicker');
		if (this.isShown) {
			this.hide();
		}
		if (this.isAppended) {
			$win.off('resize.clockpicker' + this.id);
			this.popover.remove();
		}
	};

	// Extends $.fn.clockpicker
	$.fn.clockpicker = function(option){
		var args = Array.prototype.slice.call(arguments, 1);
		return this.each(function(){
			var $this = $(this),
				data = $this.data('clockpicker');
			if (! data) {
				var options = $.extend({}, ClockPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);
				$this.data('clockpicker', new ClockPicker($this, options));
			} else {
				// Manual operatsions. show, hide, remove, e.g.
				if (typeof data[option] === 'function') {
					data[option].apply(data, args);
				}
			}
		});
	};
}());
/*! iCheck v1.0.2 by Damir Sultanov, http://git.io/arlzeA, MIT Licensed */
(function(f){function A(a,b,d){var c=a[0],g=/er/.test(d)?_indeterminate:/bl/.test(d)?n:k,e=d==_update?{checked:c[k],disabled:c[n],indeterminate:"true"==a.attr(_indeterminate)||"false"==a.attr(_determinate)}:c[g];if(/^(ch|di|in)/.test(d)&&!e)x(a,g);else if(/^(un|en|de)/.test(d)&&e)q(a,g);else if(d==_update)for(var f in e)e[f]?x(a,f,!0):q(a,f,!0);else if(!b||"toggle"==d){if(!b)a[_callback]("ifClicked");e?c[_type]!==r&&q(a,g):x(a,g)}}function x(a,b,d){var c=a[0],g=a.parent(),e=b==k,u=b==_indeterminate,
    v=b==n,s=u?_determinate:e?y:"enabled",F=l(a,s+t(c[_type])),B=l(a,b+t(c[_type]));if(!0!==c[b]){if(!d&&b==k&&c[_type]==r&&c.name){var w=a.closest("form"),p='input[name="'+c.name+'"]',p=w.length?w.find(p):f(p);p.each(function(){this!==c&&f(this).data(m)&&q(f(this),b)})}u?(c[b]=!0,c[k]&&q(a,k,"force")):(d||(c[b]=!0),e&&c[_indeterminate]&&q(a,_indeterminate,!1));D(a,e,b,d)}c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"default");g[_add](B||l(a,b)||"");g.attr("role")&&!u&&g.attr("aria-"+(v?n:k),"true");
    g[_remove](F||l(a,s)||"")}function q(a,b,d){var c=a[0],g=a.parent(),e=b==k,f=b==_indeterminate,m=b==n,s=f?_determinate:e?y:"enabled",q=l(a,s+t(c[_type])),r=l(a,b+t(c[_type]));if(!1!==c[b]){if(f||!d||"force"==d)c[b]=!1;D(a,e,s,d)}!c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"pointer");g[_remove](r||l(a,b)||"");g.attr("role")&&!f&&g.attr("aria-"+(m?n:k),"false");g[_add](q||l(a,s)||"")}function E(a,b){if(a.data(m)){a.parent().html(a.attr("style",a.data(m).s||""));if(b)a[_callback](b);a.off(".i").unwrap();
    f(_label+'[for="'+a[0].id+'"]').add(a.closest(_label)).off(".i")}}function l(a,b,f){if(a.data(m))return a.data(m).o[b+(f?"":"Class")]}function t(a){return a.charAt(0).toUpperCase()+a.slice(1)}function D(a,b,f,c){if(!c){if(b)a[_callback]("ifToggled");a[_callback]("ifChanged")[_callback]("if"+t(f))}}var m="iCheck",C=m+"-helper",r="radio",k="checked",y="un"+k,n="disabled";_determinate="determinate";_indeterminate="in"+_determinate;_update="update";_type="type";_click="click";_touch="touchbegin.i touchend.i";
    _add="addClass";_remove="removeClass";_callback="trigger";_label="label";_cursor="cursor";_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);f.fn[m]=function(a,b){var d='input[type="checkbox"], input[type="'+r+'"]',c=f(),g=function(a){a.each(function(){var a=f(this);c=a.is(d)?c.add(a):c.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),g(this),c.each(function(){var c=
        f(this);"destroy"==a?E(c,"ifDestroyed"):A(c,!0,a);f.isFunction(b)&&b()});if("object"!=typeof a&&a)return this;var e=f.extend({checkedClass:k,disabledClass:n,indeterminateClass:_indeterminate,labelHover:!0},a),l=e.handle,v=e.hoverClass||"hover",s=e.focusClass||"focus",t=e.activeClass||"active",B=!!e.labelHover,w=e.labelHoverClass||"hover",p=(""+e.increaseArea).replace("%","")|0;if("checkbox"==l||l==r)d='input[type="'+l+'"]';-50>p&&(p=-50);g(this);return c.each(function(){var a=f(this);E(a);var c=this,
        b=c.id,g=-p+"%",d=100+2*p+"%",d={position:"absolute",top:g,left:g,display:"block",width:d,height:d,margin:0,padding:0,background:"#fff",border:0,opacity:0},g=_mobile?{position:"absolute",visibility:"hidden"}:p?d:{position:"absolute",opacity:0},l="checkbox"==c[_type]?e.checkboxClass||"icheckbox":e.radioClass||"i"+r,z=f(_label+'[for="'+b+'"]').add(a.closest(_label)),u=!!e.aria,y=m+"-"+Math.random().toString(36).substr(2,6),h='<div class="'+l+'" '+(u?'role="'+c[_type]+'" ':"");u&&z.each(function(){h+=
        'aria-labelledby="';this.id?h+=this.id:(this.id=y,h+=y);h+='"'});h=a.wrap(h+"/>")[_callback]("ifCreated").parent().append(e.insert);d=f('<ins class="'+C+'"/>').css(d).appendTo(h);a.data(m,{o:e,s:a.attr("style")}).css(g);e.inheritClass&&h[_add](c.className||"");e.inheritID&&b&&h.attr("id",m+"-"+b);"static"==h.css("position")&&h.css("position","relative");A(a,!0,_update);if(z.length)z.on(_click+".i mouseover.i mouseout.i "+_touch,function(b){var d=b[_type],e=f(this);if(!c[n]){if(d==_click){if(f(b.target).is("a"))return;
        A(a,!1,!0)}else B&&(/ut|nd/.test(d)?(h[_remove](v),e[_remove](w)):(h[_add](v),e[_add](w)));if(_mobile)b.stopPropagation();else return!1}});a.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(b){var d=b[_type];b=b.keyCode;if(d==_click)return!1;if("keydown"==d&&32==b)return c[_type]==r&&c[k]||(c[k]?q(a,k):x(a,k)),!1;if("keyup"==d&&c[_type]==r)!c[k]&&x(a,k);else if(/us|ur/.test(d))h["blur"==d?_remove:_add](s)});d.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(b){var d=
        b[_type],e=/wn|up/.test(d)?t:v;if(!c[n]){if(d==_click)A(a,!1,!0);else{if(/wn|er|in/.test(d))h[_add](e);else h[_remove](e+" "+t);if(z.length&&B&&e==v)z[/ut|nd/.test(d)?_remove:_add](w)}if(_mobile)b.stopPropagation();else return!1}})})}})(window.jQuery||window.Zepto);
/*!
 Chosen, a Select Box Enhancer for jQuery and Prototype
 by Patrick Filler for Harvest, http://getharvest.com

 Version 1.1.0
 Full source at https://github.com/harvesthq/chosen
 Copyright (c) 2011 Harvest http://getharvest.com

 MIT License, https://github.com/harvesthq/chosen/blob/master/LICENSE.md
 This file is generated by `grunt build`, do not edit it by hand.
 */

(function() {
    var $, AbstractChosen, Chosen, SelectParser, _ref,
        __hasProp = {}.hasOwnProperty,
        __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

    SelectParser = (function() {
        function SelectParser() {
            this.options_index = 0;
            this.parsed = [];
        }

        SelectParser.prototype.add_node = function(child) {
            if (child.nodeName.toUpperCase() === "OPTGROUP") {
                return this.add_group(child);
            } else {
                return this.add_option(child);
            }
        };

        SelectParser.prototype.add_group = function(group) {
            var group_position, option, _i, _len, _ref, _results;
            group_position = this.parsed.length;
            this.parsed.push({
                array_index: group_position,
                group: true,
                label: this.escapeExpression(group.label),
                children: 0,
                disabled: group.disabled
            });
            _ref = group.childNodes;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                _results.push(this.add_option(option, group_position, group.disabled));
            }
            return _results;
        };

        SelectParser.prototype.add_option = function(option, group_position, group_disabled) {
            if (option.nodeName.toUpperCase() === "OPTION") {
                if (option.text !== "") {
                    if (group_position != null) {
                        this.parsed[group_position].children += 1;
                    }
                    this.parsed.push({
                        array_index: this.parsed.length,
                        options_index: this.options_index,
                        value: option.value,
                        text: option.text,
                        html: option.innerHTML,
                        selected: option.selected,
                        disabled: group_disabled === true ? group_disabled : option.disabled,
                        group_array_index: group_position,
                        classes: option.className,
                        style: option.style.cssText
                    });
                } else {
                    this.parsed.push({
                        array_index: this.parsed.length,
                        options_index: this.options_index,
                        empty: true
                    });
                }
                return this.options_index += 1;
            }
        };

        SelectParser.prototype.escapeExpression = function(text) {
            var map, unsafe_chars;
            if ((text == null) || text === false) {
                return "";
            }
            if (!/[\&\<\>\"\'\`]/.test(text)) {
                return text;
            }
            map = {
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;"
            };
            unsafe_chars = /&(?!\w+;)|[\<\>\"\'\`]/g;
            return text.replace(unsafe_chars, function(chr) {
                return map[chr] || "&amp;";
            });
        };

        return SelectParser;

    })();

    SelectParser.select_to_array = function(select) {
        var child, parser, _i, _len, _ref;
        parser = new SelectParser();
        _ref = select.childNodes;
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            child = _ref[_i];
            parser.add_node(child);
        }
        return parser.parsed;
    };

    AbstractChosen = (function() {
        function AbstractChosen(form_field, options) {
            this.form_field = form_field;
            this.options = options != null ? options : {};
            if (!AbstractChosen.browser_is_supported()) {
                return;
            }
            this.is_multiple = this.form_field.multiple;
            this.set_default_text();
            this.set_default_values();
            this.setup();
            this.set_up_html();
            this.register_observers();
        }

        AbstractChosen.prototype.set_default_values = function() {
            var _this = this;
            this.click_test_action = function(evt) {
                return _this.test_active_click(evt);
            };
            this.activate_action = function(evt) {
                return _this.activate_field(evt);
            };
            this.active_field = false;
            this.mouse_on_container = false;
            this.results_showing = false;
            this.result_highlighted = null;
            this.allow_single_deselect = (this.options.allow_single_deselect != null) && (this.form_field.options[0] != null) && this.form_field.options[0].text === "" ? this.options.allow_single_deselect : false;
            this.disable_search_threshold = this.options.disable_search_threshold || 0;
            this.disable_search = this.options.disable_search || false;
            this.enable_split_word_search = this.options.enable_split_word_search != null ? this.options.enable_split_word_search : true;
            this.group_search = this.options.group_search != null ? this.options.group_search : true;
            this.search_contains = this.options.search_contains || false;
            this.single_backstroke_delete = this.options.single_backstroke_delete != null ? this.options.single_backstroke_delete : true;
            this.max_selected_options = this.options.max_selected_options || Infinity;
            this.inherit_select_classes = this.options.inherit_select_classes || false;
            this.display_selected_options = this.options.display_selected_options != null ? this.options.display_selected_options : true;
            return this.display_disabled_options = this.options.display_disabled_options != null ? this.options.display_disabled_options : true;
        };

        AbstractChosen.prototype.set_default_text = function() {
            if (this.form_field.getAttribute("data-placeholder")) {
                this.default_text = this.form_field.getAttribute("data-placeholder");
            } else if (this.is_multiple) {
                this.default_text = this.options.placeholder_text_multiple || this.options.placeholder_text || AbstractChosen.default_multiple_text;
            } else {
                this.default_text = this.options.placeholder_text_single || this.options.placeholder_text || AbstractChosen.default_single_text;
            }
            return this.results_none_found = this.form_field.getAttribute("data-no_results_text") || this.options.no_results_text || AbstractChosen.default_no_result_text;
        };

        AbstractChosen.prototype.mouse_enter = function() {
            return this.mouse_on_container = true;
        };

        AbstractChosen.prototype.mouse_leave = function() {
            return this.mouse_on_container = false;
        };

        AbstractChosen.prototype.input_focus = function(evt) {
            var _this = this;
            if (this.is_multiple) {
                if (!this.active_field) {
                    return setTimeout((function() {
                        return _this.container_mousedown();
                    }), 50);
                }
            } else {
                if (!this.active_field) {
                    return this.activate_field();
                }
            }
        };

        AbstractChosen.prototype.input_blur = function(evt) {
            var _this = this;
            if (!this.mouse_on_container) {
                this.active_field = false;
                return setTimeout((function() {
                    return _this.blur_test();
                }), 100);
            }
        };

        AbstractChosen.prototype.results_option_build = function(options) {
            var content, data, _i, _len, _ref;
            content = '';
            _ref = this.results_data;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                data = _ref[_i];
                if (data.group) {
                    content += this.result_add_group(data);
                } else {
                    content += this.result_add_option(data);
                }
                if (options != null ? options.first : void 0) {
                    if (data.selected && this.is_multiple) {
                        this.choice_build(data);
                    } else if (data.selected && !this.is_multiple) {
                        this.single_set_selected_text(data.text);
                    }
                }
            }
            return content;
        };

        AbstractChosen.prototype.result_add_option = function(option) {
            var classes, option_el;
            if (!option.search_match) {
                return '';
            }
            if (!this.include_option_in_results(option)) {
                return '';
            }
            classes = [];
            if (!option.disabled && !(option.selected && this.is_multiple)) {
                classes.push("active-result");
            }
            if (option.disabled && !(option.selected && this.is_multiple)) {
                classes.push("disabled-result");
            }
            if (option.selected) {
                classes.push("result-selected");
            }
            if (option.group_array_index != null) {
                classes.push("group-option");
            }
            if (option.classes !== "") {
                classes.push(option.classes);
            }
            option_el = document.createElement("li");
            option_el.className = classes.join(" ");
            option_el.style.cssText = option.style;
            option_el.setAttribute("data-option-array-index", option.array_index);
            option_el.innerHTML = option.search_text;
            return this.outerHTML(option_el);
        };

        AbstractChosen.prototype.result_add_group = function(group) {
            var group_el;
            if (!(group.search_match || group.group_match)) {
                return '';
            }
            if (!(group.active_options > 0)) {
                return '';
            }
            group_el = document.createElement("li");
            group_el.className = "group-result";
            group_el.innerHTML = group.search_text;
            return this.outerHTML(group_el);
        };

        AbstractChosen.prototype.results_update_field = function() {
            this.set_default_text();
            if (!this.is_multiple) {
                this.results_reset_cleanup();
            }
            this.result_clear_highlight();
            this.results_build();
            if (this.results_showing) {
                return this.winnow_results();
            }
        };

        AbstractChosen.prototype.reset_single_select_options = function() {
            var result, _i, _len, _ref, _results;
            _ref = this.results_data;
            _results = [];
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                result = _ref[_i];
                if (result.selected) {
                    _results.push(result.selected = false);
                } else {
                    _results.push(void 0);
                }
            }
            return _results;
        };

        AbstractChosen.prototype.results_toggle = function() {
            if (this.results_showing) {
                return this.results_hide();
            } else {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.results_search = function(evt) {
            if (this.results_showing) {
                return this.winnow_results();
            } else {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.winnow_results = function() {
            var escapedSearchText, option, regex, regexAnchor, results, results_group, searchText, startpos, text, zregex, _i, _len, _ref;
            this.no_results_clear();
            results = 0;
            searchText = this.get_search_text();
            escapedSearchText = searchText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
            regexAnchor = this.search_contains ? "" : "^";
            regex = new RegExp(regexAnchor + escapedSearchText, 'i');
            zregex = new RegExp(escapedSearchText, 'i');
            _ref = this.results_data;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                option.search_match = false;
                results_group = null;
                if (this.include_option_in_results(option)) {
                    if (option.group) {
                        option.group_match = false;
                        option.active_options = 0;
                    }
                    if ((option.group_array_index != null) && this.results_data[option.group_array_index]) {
                        results_group = this.results_data[option.group_array_index];
                        if (results_group.active_options === 0 && results_group.search_match) {
                            results += 1;
                        }
                        results_group.active_options += 1;
                    }
                    if (!(option.group && !this.group_search)) {
                        option.search_text = option.group ? option.label : option.html;
                        option.search_match = this.search_string_match(option.search_text, regex);
                        if (option.search_match && !option.group) {
                            results += 1;
                        }
                        if (option.search_match) {
                            if (searchText.length) {
                                startpos = option.search_text.search(zregex);
                                text = option.search_text.substr(0, startpos + searchText.length) + '</em>' + option.search_text.substr(startpos + searchText.length);
                                option.search_text = text.substr(0, startpos) + '<em>' + text.substr(startpos);
                            }
                            if (results_group != null) {
                                results_group.group_match = true;
                            }
                        } else if ((option.group_array_index != null) && this.results_data[option.group_array_index].search_match) {
                            option.search_match = true;
                        }
                    }
                }
            }
            this.result_clear_highlight();
            if (results < 1 && searchText.length) {
                this.update_results_content("");
                return this.no_results(searchText);
            } else {
                this.update_results_content(this.results_option_build());
                return this.winnow_results_set_highlight();
            }
        };

        AbstractChosen.prototype.search_string_match = function(search_string, regex) {
            var part, parts, _i, _len;
            if (regex.test(search_string)) {
                return true;
            } else if (this.enable_split_word_search && (search_string.indexOf(" ") >= 0 || search_string.indexOf("[") === 0)) {
                parts = search_string.replace(/\[|\]/g, "").split(" ");
                if (parts.length) {
                    for (_i = 0, _len = parts.length; _i < _len; _i++) {
                        part = parts[_i];
                        if (regex.test(part)) {
                            return true;
                        }
                    }
                }
            }
        };

        AbstractChosen.prototype.choices_count = function() {
            var option, _i, _len, _ref;
            if (this.selected_option_count != null) {
                return this.selected_option_count;
            }
            this.selected_option_count = 0;
            _ref = this.form_field.options;
            for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                option = _ref[_i];
                if (option.selected) {
                    this.selected_option_count += 1;
                }
            }
            return this.selected_option_count;
        };

        AbstractChosen.prototype.choices_click = function(evt) {
            evt.preventDefault();
            if (!(this.results_showing || this.is_disabled)) {
                return this.results_show();
            }
        };

        AbstractChosen.prototype.keyup_checker = function(evt) {
            var stroke, _ref;
            stroke = (_ref = evt.which) != null ? _ref : evt.keyCode;
            this.search_field_scale();
            switch (stroke) {
                case 8:
                    if (this.is_multiple && this.backstroke_length < 1 && this.choices_count() > 0) {
                        return this.keydown_backstroke();
                    } else if (!this.pending_backstroke) {
                        this.result_clear_highlight();
                        return this.results_search();
                    }
                    break;
                case 13:
                    evt.preventDefault();
                    if (this.results_showing) {
                        return this.result_select(evt);
                    }
                    break;
                case 27:
                    if (this.results_showing) {
                        this.results_hide();
                    }
                    return true;
                case 9:
                case 38:
                case 40:
                case 16:
                case 91:
                case 17:
                    break;
                default:
                    return this.results_search();
            }
        };

        AbstractChosen.prototype.clipboard_event_checker = function(evt) {
            var _this = this;
            return setTimeout((function() {
                return _this.results_search();
            }), 50);
        };

        AbstractChosen.prototype.container_width = function() {
            if (this.options.width != null) {
                return this.options.width;
            } else {
                return "" + this.form_field.offsetWidth + "px";
            }
        };

        AbstractChosen.prototype.include_option_in_results = function(option) {
            if (this.is_multiple && (!this.display_selected_options && option.selected)) {
                return false;
            }
            if (!this.display_disabled_options && option.disabled) {
                return false;
            }
            if (option.empty) {
                return false;
            }
            return true;
        };

        AbstractChosen.prototype.search_results_touchstart = function(evt) {
            this.touch_started = true;
            return this.search_results_mouseover(evt);
        };

        AbstractChosen.prototype.search_results_touchmove = function(evt) {
            this.touch_started = false;
            return this.search_results_mouseout(evt);
        };

        AbstractChosen.prototype.search_results_touchend = function(evt) {
            if (this.touch_started) {
                return this.search_results_mouseup(evt);
            }
        };

        AbstractChosen.prototype.outerHTML = function(element) {
            var tmp;
            if (element.outerHTML) {
                return element.outerHTML;
            }
            tmp = document.createElement("div");
            tmp.appendChild(element);
            return tmp.innerHTML;
        };

        AbstractChosen.browser_is_supported = function() {
            if (window.navigator.appName === "Microsoft Internet Explorer") {
                return document.documentMode >= 8;
            }
            if (/iP(od|hone)/i.test(window.navigator.userAgent)) {
                return false;
            }
            if (/Android/i.test(window.navigator.userAgent)) {
                if (/Mobile/i.test(window.navigator.userAgent)) {
                    return false;
                }
            }
            return true;
        };

        AbstractChosen.default_multiple_text = "Select Some Options";

        AbstractChosen.default_single_text = "Select an Option";

        AbstractChosen.default_no_result_text = "No results match";

        return AbstractChosen;

    })();

    $ = jQuery;

    $.fn.extend({
        chosen: function(options) {
            if (!AbstractChosen.browser_is_supported()) {
                return this;
            }
            return this.each(function(input_field) {
                var $this, chosen;
                $this = $(this);
                chosen = $this.data('chosen');
                if (options === 'destroy' && chosen) {
                    chosen.destroy();
                } else if (!chosen) {
                    $this.data('chosen', new Chosen(this, options));
                }
            });
        }
    });

    Chosen = (function(_super) {
        __extends(Chosen, _super);

        function Chosen() {
            _ref = Chosen.__super__.constructor.apply(this, arguments);
            return _ref;
        }

        Chosen.prototype.setup = function() {
            this.form_field_jq = $(this.form_field);
            this.current_selectedIndex = this.form_field.selectedIndex;
            return this.is_rtl = this.form_field_jq.hasClass("chosen-rtl");
        };

        Chosen.prototype.set_up_html = function() {
            var container_classes, container_props;
            container_classes = ["chosen-container"];
            container_classes.push("chosen-container-" + (this.is_multiple ? "multi" : "single"));
            if (this.inherit_select_classes && this.form_field.className) {
                container_classes.push(this.form_field.className);
            }
            if (this.is_rtl) {
                container_classes.push("chosen-rtl");
            }
            container_props = {
                'class': container_classes.join(' '),
                'style': "width: " + (this.container_width()) + ";",
                'title': this.form_field.title
            };
            if (this.form_field.id.length) {
                container_props.id = this.form_field.id.replace(/[^\w]/g, '_') + "_chosen";
            }
            this.container = $("<div />", container_props);
            if (this.is_multiple) {
                this.container.html('<ul class="chosen-choices"><li class="search-field"><input type="text" value="' + this.default_text + '" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div>');
            } else {
                this.container.html('<a class="chosen-single chosen-default" tabindex="-1"><span>' + this.default_text + '</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" /></div><ul class="chosen-results"></ul></div>');
            }
            this.form_field_jq.hide().after(this.container);
            this.dropdown = this.container.find('div.chosen-drop').first();
            this.search_field = this.container.find('input').first();
            this.search_results = this.container.find('ul.chosen-results').first();
            this.search_field_scale();
            this.search_no_results = this.container.find('li.no-results').first();
            if (this.is_multiple) {
                this.search_choices = this.container.find('ul.chosen-choices').first();
                this.search_container = this.container.find('li.search-field').first();
            } else {
                this.search_container = this.container.find('div.chosen-search').first();
                this.selected_item = this.container.find('.chosen-single').first();
            }
            this.results_build();
            this.set_tab_index();
            this.set_label_behavior();
            return this.form_field_jq.trigger("chosen:ready", {
                chosen: this
            });
        };

        Chosen.prototype.register_observers = function() {
            var _this = this;
            this.container.bind('mousedown.chosen', function(evt) {
                _this.container_mousedown(evt);
            });
            this.container.bind('mouseup.chosen', function(evt) {
                _this.container_mouseup(evt);
            });
            this.container.bind('mouseenter.chosen', function(evt) {
                _this.mouse_enter(evt);
            });
            this.container.bind('mouseleave.chosen', function(evt) {
                _this.mouse_leave(evt);
            });
            this.search_results.bind('mouseup.chosen', function(evt) {
                _this.search_results_mouseup(evt);
            });
            this.search_results.bind('mouseover.chosen', function(evt) {
                _this.search_results_mouseover(evt);
            });
            this.search_results.bind('mouseout.chosen', function(evt) {
                _this.search_results_mouseout(evt);
            });
            this.search_results.bind('mousewheel.chosen DOMMouseScroll.chosen', function(evt) {
                _this.search_results_mousewheel(evt);
            });
            this.search_results.bind('touchstart.chosen', function(evt) {
                _this.search_results_touchstart(evt);
            });
            this.search_results.bind('touchmove.chosen', function(evt) {
                _this.search_results_touchmove(evt);
            });
            this.search_results.bind('touchend.chosen', function(evt) {
                _this.search_results_touchend(evt);
            });
            this.form_field_jq.bind("chosen:updated.chosen", function(evt) {
                _this.results_update_field(evt);
            });
            this.form_field_jq.bind("chosen:activate.chosen", function(evt) {
                _this.activate_field(evt);
            });
            this.form_field_jq.bind("chosen:open.chosen", function(evt) {
                _this.container_mousedown(evt);
            });
            this.form_field_jq.bind("chosen:close.chosen", function(evt) {
                _this.input_blur(evt);
            });
            this.search_field.bind('blur.chosen', function(evt) {
                _this.input_blur(evt);
            });
            this.search_field.bind('keyup.chosen', function(evt) {
                _this.keyup_checker(evt);
            });
            this.search_field.bind('keydown.chosen', function(evt) {
                _this.keydown_checker(evt);
            });
            this.search_field.bind('focus.chosen', function(evt) {
                _this.input_focus(evt);
            });
            this.search_field.bind('cut.chosen', function(evt) {
                _this.clipboard_event_checker(evt);
            });
            this.search_field.bind('paste.chosen', function(evt) {
                _this.clipboard_event_checker(evt);
            });
            if (this.is_multiple) {
                return this.search_choices.bind('click.chosen', function(evt) {
                    _this.choices_click(evt);
                });
            } else {
                return this.container.bind('click.chosen', function(evt) {
                    evt.preventDefault();
                });
            }
        };

        Chosen.prototype.destroy = function() {
            $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action);
            if (this.search_field[0].tabIndex) {
                this.form_field_jq[0].tabIndex = this.search_field[0].tabIndex;
            }
            this.container.remove();
            this.form_field_jq.removeData('chosen');
            return this.form_field_jq.show();
        };

        Chosen.prototype.search_field_disabled = function() {
            this.is_disabled = this.form_field_jq[0].disabled;
            if (this.is_disabled) {
                this.container.addClass('chosen-disabled');
                this.search_field[0].disabled = true;
                if (!this.is_multiple) {
                    this.selected_item.unbind("focus.chosen", this.activate_action);
                }
                return this.close_field();
            } else {
                this.container.removeClass('chosen-disabled');
                this.search_field[0].disabled = false;
                if (!this.is_multiple) {
                    return this.selected_item.bind("focus.chosen", this.activate_action);
                }
            }
        };

        Chosen.prototype.container_mousedown = function(evt) {
            if (!this.is_disabled) {
                if (evt && evt.type === "mousedown" && !this.results_showing) {
                    evt.preventDefault();
                }
                if (!((evt != null) && ($(evt.target)).hasClass("search-choice-close"))) {
                    if (!this.active_field) {
                        if (this.is_multiple) {
                            this.search_field.val("");
                        }
                        $(this.container[0].ownerDocument).bind('click.chosen', this.click_test_action);
                        this.results_show();
                    } else if (!this.is_multiple && evt && (($(evt.target)[0] === this.selected_item[0]) || $(evt.target).parents("a.chosen-single").length)) {
                        evt.preventDefault();
                        this.results_toggle();
                    }
                    return this.activate_field();
                }
            }
        };

        Chosen.prototype.container_mouseup = function(evt) {
            if (evt.target.nodeName === "ABBR" && !this.is_disabled) {
                return this.results_reset(evt);
            }
        };

        Chosen.prototype.search_results_mousewheel = function(evt) {
            var delta;
            if (evt.originalEvent) {
                delta = -evt.originalEvent.wheelDelta || evt.originalEvent.detail;
            }
            if (delta != null) {
                evt.preventDefault();
                if (evt.type === 'DOMMouseScroll') {
                    delta = delta * 40;
                }
                return this.search_results.scrollTop(delta + this.search_results.scrollTop());
            }
        };

        Chosen.prototype.blur_test = function(evt) {
            if (!this.active_field && this.container.hasClass("chosen-container-active")) {
                return this.close_field();
            }
        };

        Chosen.prototype.close_field = function() {
            $(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action);
            this.active_field = false;
            this.results_hide();
            this.container.removeClass("chosen-container-active");
            this.clear_backstroke();
            this.show_search_field_default();
            return this.search_field_scale();
        };

        Chosen.prototype.activate_field = function() {
            this.container.addClass("chosen-container-active");
            this.active_field = true;
            this.search_field.val(this.search_field.val());
            return this.search_field.focus();
        };

        Chosen.prototype.test_active_click = function(evt) {
            var active_container;
            active_container = $(evt.target).closest('.chosen-container');
            if (active_container.length && this.container[0] === active_container[0]) {
                return this.active_field = true;
            } else {
                return this.close_field();
            }
        };

        Chosen.prototype.results_build = function() {
            this.parsing = true;
            this.selected_option_count = null;
            this.results_data = SelectParser.select_to_array(this.form_field);
            if (this.is_multiple) {
                this.search_choices.find("li.search-choice").remove();
            } else if (!this.is_multiple) {
                this.single_set_selected_text();
                if (this.disable_search || this.form_field.options.length <= this.disable_search_threshold) {
                    this.search_field[0].readOnly = true;
                    this.container.addClass("chosen-container-single-nosearch");
                } else {
                    this.search_field[0].readOnly = false;
                    this.container.removeClass("chosen-container-single-nosearch");
                }
            }
            this.update_results_content(this.results_option_build({
                first: true
            }));
            this.search_field_disabled();
            this.show_search_field_default();
            this.search_field_scale();
            return this.parsing = false;
        };

        Chosen.prototype.result_do_highlight = function(el) {
            var high_bottom, high_top, maxHeight, visible_bottom, visible_top;
            if (el.length) {
                this.result_clear_highlight();
                this.result_highlight = el;
                this.result_highlight.addClass("highlighted");
                maxHeight = parseInt(this.search_results.css("maxHeight"), 10);
                visible_top = this.search_results.scrollTop();
                visible_bottom = maxHeight + visible_top;
                high_top = this.result_highlight.position().top + this.search_results.scrollTop();
                high_bottom = high_top + this.result_highlight.outerHeight();
                if (high_bottom >= visible_bottom) {
                    return this.search_results.scrollTop((high_bottom - maxHeight) > 0 ? high_bottom - maxHeight : 0);
                } else if (high_top < visible_top) {
                    return this.search_results.scrollTop(high_top);
                }
            }
        };

        Chosen.prototype.result_clear_highlight = function() {
            if (this.result_highlight) {
                this.result_highlight.removeClass("highlighted");
            }
            return this.result_highlight = null;
        };

        Chosen.prototype.results_show = function() {
            if (this.is_multiple && this.max_selected_options <= this.choices_count()) {
                this.form_field_jq.trigger("chosen:maxselected", {
                    chosen: this
                });
                return false;
            }
            this.container.addClass("chosen-with-drop");
            this.results_showing = true;
            this.search_field.focus();
            this.search_field.val(this.search_field.val());
            this.winnow_results();
            return this.form_field_jq.trigger("chosen:showing_dropdown", {
                chosen: this
            });
        };

        Chosen.prototype.update_results_content = function(content) {
            return this.search_results.html(content);
        };

        Chosen.prototype.results_hide = function() {
            if (this.results_showing) {
                this.result_clear_highlight();
                this.container.removeClass("chosen-with-drop");
                this.form_field_jq.trigger("chosen:hiding_dropdown", {
                    chosen: this
                });
            }
            return this.results_showing = false;
        };

        Chosen.prototype.set_tab_index = function(el) {
            var ti;
            if (this.form_field.tabIndex) {
                ti = this.form_field.tabIndex;
                this.form_field.tabIndex = -1;
                return this.search_field[0].tabIndex = ti;
            }
        };

        Chosen.prototype.set_label_behavior = function() {
            var _this = this;
            this.form_field_label = this.form_field_jq.parents("label");
            if (!this.form_field_label.length && this.form_field.id.length) {
                this.form_field_label = $("label[for='" + this.form_field.id + "']");
            }
            if (this.form_field_label.length > 0) {
                return this.form_field_label.bind('click.chosen', function(evt) {
                    if (_this.is_multiple) {
                        return _this.container_mousedown(evt);
                    } else {
                        return _this.activate_field();
                    }
                });
            }
        };

        Chosen.prototype.show_search_field_default = function() {
            if (this.is_multiple && this.choices_count() < 1 && !this.active_field) {
                this.search_field.val(this.default_text);
                return this.search_field.addClass("default");
            } else {
                this.search_field.val("");
                return this.search_field.removeClass("default");
            }
        };

        Chosen.prototype.search_results_mouseup = function(evt) {
            var target;
            target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first();
            if (target.length) {
                this.result_highlight = target;
                this.result_select(evt);
                return this.search_field.focus();
            }
        };

        Chosen.prototype.search_results_mouseover = function(evt) {
            var target;
            target = $(evt.target).hasClass("active-result") ? $(evt.target) : $(evt.target).parents(".active-result").first();
            if (target) {
                return this.result_do_highlight(target);
            }
        };

        Chosen.prototype.search_results_mouseout = function(evt) {
            if ($(evt.target).hasClass("active-result" || $(evt.target).parents('.active-result').first())) {
                return this.result_clear_highlight();
            }
        };

        Chosen.prototype.choice_build = function(item) {
            var choice, close_link,
                _this = this;
            choice = $('<li />', {
                "class": "search-choice"
            }).html("<span>" + item.html + "</span>");
            if (item.disabled) {
                choice.addClass('search-choice-disabled');
            } else {
                close_link = $('<a />', {
                    "class": 'search-choice-close',
                    'data-option-array-index': item.array_index
                });
                close_link.bind('click.chosen', function(evt) {
                    return _this.choice_destroy_link_click(evt);
                });
                choice.append(close_link);
            }
            return this.search_container.before(choice);
        };

        Chosen.prototype.choice_destroy_link_click = function(evt) {
            evt.preventDefault();
            evt.stopPropagation();
            if (!this.is_disabled) {
                return this.choice_destroy($(evt.target));
            }
        };

        Chosen.prototype.choice_destroy = function(link) {
            if (this.result_deselect(link[0].getAttribute("data-option-array-index"))) {
                this.show_search_field_default();
                if (this.is_multiple && this.choices_count() > 0 && this.search_field.val().length < 1) {
                    this.results_hide();
                }
                link.parents('li').first().remove();
                return this.search_field_scale();
            }
        };

        Chosen.prototype.results_reset = function() {
            this.reset_single_select_options();
            this.form_field.options[0].selected = true;
            this.single_set_selected_text();
            this.show_search_field_default();
            this.results_reset_cleanup();
            this.form_field_jq.trigger("change");
            if (this.active_field) {
                return this.results_hide();
            }
        };

        Chosen.prototype.results_reset_cleanup = function() {
            this.current_selectedIndex = this.form_field.selectedIndex;
            return this.selected_item.find("abbr").remove();
        };

        Chosen.prototype.result_select = function(evt) {
            var high, item;
            if (this.result_highlight) {
                high = this.result_highlight;
                this.result_clear_highlight();
                if (this.is_multiple && this.max_selected_options <= this.choices_count()) {
                    this.form_field_jq.trigger("chosen:maxselected", {
                        chosen: this
                    });
                    return false;
                }
                if (this.is_multiple) {
                    high.removeClass("active-result");
                } else {
                    this.reset_single_select_options();
                }
                item = this.results_data[high[0].getAttribute("data-option-array-index")];
                item.selected = true;
                this.form_field.options[item.options_index].selected = true;
                this.selected_option_count = null;
                if (this.is_multiple) {
                    this.choice_build(item);
                } else {
                    this.single_set_selected_text(item.text);
                }
                if (!((evt.metaKey || evt.ctrlKey) && this.is_multiple)) {
                    this.results_hide();
                }
                this.search_field.val("");
                if (this.is_multiple || this.form_field.selectedIndex !== this.current_selectedIndex) {
                    this.form_field_jq.trigger("change", {
                        'selected': this.form_field.options[item.options_index].value
                    });
                }
                this.current_selectedIndex = this.form_field.selectedIndex;
                return this.search_field_scale();
            }
        };

        Chosen.prototype.single_set_selected_text = function(text) {
            if (text == null) {
                text = this.default_text;
            }
            if (text === this.default_text) {
                this.selected_item.addClass("chosen-default");
            } else {
                this.single_deselect_control_build();
                this.selected_item.removeClass("chosen-default");
            }
            return this.selected_item.find("span").text(text);
        };

        Chosen.prototype.result_deselect = function(pos) {
            var result_data;
            result_data = this.results_data[pos];
            if (!this.form_field.options[result_data.options_index].disabled) {
                result_data.selected = false;
                this.form_field.options[result_data.options_index].selected = false;
                this.selected_option_count = null;
                this.result_clear_highlight();
                if (this.results_showing) {
                    this.winnow_results();
                }
                this.form_field_jq.trigger("change", {
                    deselected: this.form_field.options[result_data.options_index].value
                });
                this.search_field_scale();
                return true;
            } else {
                return false;
            }
        };

        Chosen.prototype.single_deselect_control_build = function() {
            if (!this.allow_single_deselect) {
                return;
            }
            if (!this.selected_item.find("abbr").length) {
                this.selected_item.find("span").first().after("<abbr class=\"search-choice-close\"></abbr>");
            }
            return this.selected_item.addClass("chosen-single-with-deselect");
        };

        Chosen.prototype.get_search_text = function() {
            if (this.search_field.val() === this.default_text) {
                return "";
            } else {
                return $('<div/>').text($.trim(this.search_field.val())).html();
            }
        };

        Chosen.prototype.winnow_results_set_highlight = function() {
            var do_high, selected_results;
            selected_results = !this.is_multiple ? this.search_results.find(".result-selected.active-result") : [];
            do_high = selected_results.length ? selected_results.first() : this.search_results.find(".active-result").first();
            if (do_high != null) {
                return this.result_do_highlight(do_high);
            }
        };

        Chosen.prototype.no_results = function(terms) {
            var no_results_html;
            no_results_html = $('<li class="no-results">' + this.results_none_found + ' "<span></span>"</li>');
            no_results_html.find("span").first().html(terms);
            this.search_results.append(no_results_html);
            return this.form_field_jq.trigger("chosen:no_results", {
                chosen: this
            });
        };

        Chosen.prototype.no_results_clear = function() {
            return this.search_results.find(".no-results").remove();
        };

        Chosen.prototype.keydown_arrow = function() {
            var next_sib;
            if (this.results_showing && this.result_highlight) {
                next_sib = this.result_highlight.nextAll("li.active-result").first();
                if (next_sib) {
                    return this.result_do_highlight(next_sib);
                }
            } else {
                return this.results_show();
            }
        };

        Chosen.prototype.keyup_arrow = function() {
            var prev_sibs;
            if (!this.results_showing && !this.is_multiple) {
                return this.results_show();
            } else if (this.result_highlight) {
                prev_sibs = this.result_highlight.prevAll("li.active-result");
                if (prev_sibs.length) {
                    return this.result_do_highlight(prev_sibs.first());
                } else {
                    if (this.choices_count() > 0) {
                        this.results_hide();
                    }
                    return this.result_clear_highlight();
                }
            }
        };

        Chosen.prototype.keydown_backstroke = function() {
            var next_available_destroy;
            if (this.pending_backstroke) {
                this.choice_destroy(this.pending_backstroke.find("a").first());
                return this.clear_backstroke();
            } else {
                next_available_destroy = this.search_container.siblings("li.search-choice").last();
                if (next_available_destroy.length && !next_available_destroy.hasClass("search-choice-disabled")) {
                    this.pending_backstroke = next_available_destroy;
                    if (this.single_backstroke_delete) {
                        return this.keydown_backstroke();
                    } else {
                        return this.pending_backstroke.addClass("search-choice-focus");
                    }
                }
            }
        };

        Chosen.prototype.clear_backstroke = function() {
            if (this.pending_backstroke) {
                this.pending_backstroke.removeClass("search-choice-focus");
            }
            return this.pending_backstroke = null;
        };

        Chosen.prototype.keydown_checker = function(evt) {
            var stroke, _ref1;
            stroke = (_ref1 = evt.which) != null ? _ref1 : evt.keyCode;
            this.search_field_scale();
            if (stroke !== 8 && this.pending_backstroke) {
                this.clear_backstroke();
            }
            switch (stroke) {
                case 8:
                    this.backstroke_length = this.search_field.val().length;
                    break;
                case 9:
                    if (this.results_showing && !this.is_multiple) {
                        this.result_select(evt);
                    }
                    this.mouse_on_container = false;
                    break;
                case 13:
                    evt.preventDefault();
                    break;
                case 38:
                    evt.preventDefault();
                    this.keyup_arrow();
                    break;
                case 40:
                    evt.preventDefault();
                    this.keydown_arrow();
                    break;
            }
        };

        Chosen.prototype.search_field_scale = function() {
            var div, f_width, h, style, style_block, styles, w, _i, _len;
            if (this.is_multiple) {
                h = 0;
                w = 0;
                style_block = "position:absolute; left: -1000px; top: -1000px; display:none;";
                styles = ['font-size', 'font-style', 'font-weight', 'font-family', 'line-height', 'text-transform', 'letter-spacing'];
                for (_i = 0, _len = styles.length; _i < _len; _i++) {
                    style = styles[_i];
                    style_block += style + ":" + this.search_field.css(style) + ";";
                }
                div = $('<div />', {
                    'style': style_block
                });
                div.text(this.search_field.val());
                $('body').append(div);
                w = div.width() + 25;
                div.remove();
                f_width = this.container.outerWidth();
                if (w > f_width - 10) {
                    w = f_width - 10;
                }
                return this.search_field.css({
                    'width': w + 'px'
                });
            }
        };

        return Chosen;

    })(AbstractChosen);

}).call(this);
/**
 * Bootstrap Search Suggest
 * @desc    这是一个基于 bootstrap 按钮式下拉菜单组件的搜索建议插件，必须使用于按钮式下拉菜单组件上。
 * @author  renxia <lzwy0820#qq.com>
 * @github  https://github.com/lzwme/bootstrap-suggest-plugin.git
 * @since   2014-10-09
 *----------------------------------------------======================
 * (c) Copyright 2014-2019 http://lzw.me All Rights Reserved.
 ********************************************************************************/
(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object' && typeof module === 'object') {
        factory(require('jquery'));
    } else if (window.jQuery) {
        factory(window.jQuery);
    } else {
        throw new Error('Not found jQuery.');
    }
})(function($) {
    var VERSION = 'VERSION_PLACEHOLDER';
    var $window = $(window);
    var isIe = 'ActiveXObject' in window; // 用于对 IE 的兼容判断
    var inputLock; // 用于中文输入法输入时锁定搜索

    // ie 下和 chrome 51 以上浏览器版本，出现滚动条时不计算 padding
    var chromeVer = navigator.userAgent.match(/Chrome\/(\d+)/);
    if (chromeVer) {
        chromeVer = +chromeVer[1];
    }
    var notNeedCalcPadding = isIe || chromeVer > 51;

    // 一些常量
    var BSSUGGEST = 'bsSuggest';
    var onDataRequestSuccess = 'onDataRequestSuccess';
    var DISABLED = 'disabled';
    var TRUE = true;
    var FALSE = false;

    function isUndefined(val) {
        return val === void(0);
    }

    /**
     * 错误处理
     */
    function handleError(e1, e2) {
        if (!window.console || !window.console.trace) {
            return;
        }
        console.trace(e1);
        if (e2) {
            console.trace(e2);
        }
    }
    /**
     * 获取当前 tr 列的关键字数据
     */
    function getPointKeyword($list) {
        return $list.data();
    }
    /**
     * 设置或获取输入框的 alt 值
     */
    function setOrGetAlt($input, val) {
        return isUndefined(val) ? $input.attr('alt') : $input.attr('alt', val);
    }
    /**
     * 设置或获取输入框的 data-id 值
     */
    function setOrGetDataId($input, val) {
        return val !== (void 0) ? $input.attr('data-id', val) : $input.attr('data-id');
    }
    /**
     * 设置选中的值
     */
    function setValue($input, keywords, options) {
        if (!keywords || !keywords.key) {
            return;
        }

        var separator = options.separator || ',',
            inputValList,
            inputIdList,
            dataId = setOrGetDataId($input);

        if (options && options.multiWord) {
            inputValList = $input.val().split(separator);
            inputValList[inputValList.length - 1] = keywords.key;

            //多关键字检索支持设置id --- 存在 bug，不建议使用
            if (!dataId) {
                inputIdList = [keywords.id];
            } else {
                inputIdList = dataId.split(separator);
                inputIdList.push(keywords.id);
            }

            setOrGetDataId($input, inputIdList.join(separator))
                .val(inputValList.join(separator))
                .focus();
        } else {
            setOrGetDataId($input, keywords.id || '').val(keywords.key).focus();
        }

        $input.data('pre-val', $input.val())
            .trigger('onSetSelectValue', [keywords, (options.data.value || options._lastData.value)[keywords.index]]);
    }
    /**
     * 调整选择菜单位置
     * @param {Object} $input
     * @param {Object} $dropdownMenu
     * @param {Object} options
     */
    function adjustDropMenuPos($input, $dropdownMenu, options) {
        if (!$dropdownMenu.is(':visible')) {
            return;
        }

        var $parent = $input.parent();
        var parentHeight = $parent.height();
        var parentWidth = $parent.width();

        if (options.autoDropup) {
            setTimeout(function() {
                var offsetTop = $input.offset().top;
                var winScrollTop = $window.scrollTop();
                var menuHeight = $dropdownMenu.height();

                if ( // 自动判断菜单向上展开
                    ($window.height() + winScrollTop - offsetTop) < menuHeight && // 假如向下会撑长页面
                    offsetTop > (menuHeight + winScrollTop) // 而且向上不会撑到顶部
                ) {
                    $parent.addClass('dropup');
                } else {
                    $parent.removeClass('dropup');
                }
            }, 10);
        }

        // 列表对齐方式
        var dmcss = {};
        if (options.listAlign === 'left') {
            dmcss = {
                'left': $input.siblings('div').width() - parentWidth,
                'right': 'auto'
            };
        } else if (options.listAlign === 'right') {
            dmcss = {
                'left': 'auto',
                'right': 0
            };
        }

        // ie 下，不显示按钮时的 top/bottom
        if (isIe && !options.showBtn) {
            if (!$parent.hasClass('dropup')) {
                dmcss.top = parentHeight;
                dmcss.bottom = 'auto';
            } else {
                dmcss.top = 'auto';
                dmcss.bottom = parentHeight;
            }
        }

        // 是否自动最小宽度
        if (!options.autoMinWidth) {
            dmcss.minWidth = parentWidth;
        }
        /* else {
            dmcss['width'] = 'auto';
        }*/

        $dropdownMenu.css(dmcss);

        return $input;
    }
    /**
     * 设置输入框背景色
     * 当设置了 indexId，而输入框的 data-id 为空时，输入框加载警告色
     */
    function setBackground($input, options) {
        var inputbg, bg, warnbg;
        if ((options.indexId === -1 && !options.idField) || options.multiWord) {
            return $input;
        }

        bg = options.inputBgColor;
        warnbg = options.inputWarnColor;

        var curVal = $input.val();
        var preVal = $input.data('pre-val');

        if (setOrGetDataId($input) || !curVal) {
            $input.css('background', bg || '');

            if (!curVal && preVal) {
                $input.trigger('onUnsetSelectValue').data('pre-val', '');
            }

            return $input;
        }

        inputbg = $input.css('backgroundColor').replace(/ /g, '').split(',', 3).join(',');
        // 自由输入的内容，设置背景色
        if (!~warnbg.indexOf(inputbg)) {
            $input.trigger('onUnsetSelectValue') // 触发取消data-id事件
                .data('pre-val', '')
                .css('background', warnbg);
        }

        return $input;
    }
    /**
     * 调整滑动条
     */
    function adjustScroll($input, $dropdownMenu, options) {
        // 控制滑动条
        var $hover = $input.parent().find('tbody tr.' + options.listHoverCSS),
            pos, maxHeight;

        if ($hover.length) {
            pos = ($hover.index() + 3) * $hover.height();
            maxHeight = +$dropdownMenu.css('maxHeight').replace('px', '');

            if (pos > maxHeight || $dropdownMenu.scrollTop() > maxHeight) {
                pos = pos - maxHeight;
            } else {
                pos = 0;
            }

            $dropdownMenu.scrollTop(pos);
        }
    }
    /**
     * 解除所有列表 hover 样式
     */
    function unHoverAll($dropdownMenu, options) {
        $dropdownMenu.find('tr.' + options.listHoverCSS).removeClass(options.listHoverCSS);
    }
    /**
     * 验证 $input 对象是否符合条件
     *   1. 必须为 bootstrap 下拉式菜单
     *   2. 必须未初始化过
     */
    function checkInput($input, $dropdownMenu, options) {
        if (
            !$dropdownMenu.length || // 过滤非 bootstrap 下拉式菜单对象
            $input.data(BSSUGGEST) // 是否已经初始化的检测
        ) {
            return FALSE;
        }

        $input.data(BSSUGGEST, {
            options: options
        });

        return TRUE;
    }
    /**
     * 数据格式检测
     * 检测 ajax 返回成功数据或 data 参数数据是否有效
     * data 格式：{"value": [{}, {}...]}
     */
    function checkData(data) {
        var isEmpty = TRUE, o;

        for (o in data) {
            if (o === 'value') {
                isEmpty = FALSE;
                break;
            }
        }
        if (isEmpty) {
            handleError('返回数据格式错误!');
            return FALSE;
        }
        if (!data.value.length) {
            // handleError('返回数据为空!');
            return FALSE;
        }

        return data;
    }
    /**
     * 判断字段名是否在 options.effectiveFields 配置项中
     * @param  {String} field   要判断的字段名
     * @param  {Object} options
     * @return {Boolean}        effectiveFields 为空时始终返回 true
     */
    function inEffectiveFields(field, options) {
        var effectiveFields = options.effectiveFields;

        return !(field === '__index' ||
            effectiveFields.length &&
            !~$.inArray(field, effectiveFields));
    }
    /**
     * 判断字段名是否在 options.searchFields 搜索字段配置中
     */
    function inSearchFields(field, options) {
        return ~$.inArray(field, options.searchFields);
    }
    /**
     * 通过下拉菜单显示提示文案
     */
    function showTip(tip, $input, $dropdownMenu, options) {
        $dropdownMenu.html('<div style="padding:10px 5px 5px">' + tip + '</div>').show();
        adjustDropMenuPos($input, $dropdownMenu, options);
    }
    /**
     * 显示下拉列表
     */
    function showDropMenu($input, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)');
        if (!$dropdownMenu.is(':visible')) {
            // $dropdownMenu.css('display', 'block');
            $dropdownMenu.show();
            $input.trigger('onShowDropdown', [options ? options.data.value : []]);
        }
    }
    /**
     * 隐藏下拉列表
     */
    function hideDropMenu($input, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)');
        if ($dropdownMenu.is(':visible')) {
            // $dropdownMenu.css('display', '');
            $dropdownMenu.hide();
            $input.trigger('onHideDropdown', [options ? options.data.value : []]);
        }
    }
    /**
     * 下拉列表刷新
     * 作为 fnGetData 的 callback 函数调用
     */
    function refreshDropMenu($input, data, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)'),
            len, i, field, index = 0,
            tds,
            html = ['<table class="table table-condensed table-sm" style="margin:0">'],
            idValue, keyValue; // 作为输入框 data-id 和内容的字段值
        var dataList = data.value;

        if (!data || !(len = dataList.length)) {
            if (options.emptyTip) {
                showTip(options.emptyTip, $input, $dropdownMenu, options);
            } else {
                $dropdownMenu.empty();
                hideDropMenu($input, options);
            }
            return $input;
        }

        // 相同数据，不用继续渲染了
        if (
            options._lastData &&
            JSON.stringify(options._lastData) === JSON.stringify(data) &&
            $dropdownMenu.find('tr').length === len
        ) {
            showDropMenu($input, options);
            return adjustDropMenuPos($input, $dropdownMenu, options);
        }
        options._lastData = data;

        // 生成表头
        if (options.showHeader) {
            html.push('<thead><tr>');
            for (field in dataList[0]) {
                if (!inEffectiveFields(field, options)) {
                    continue;
                }

                html.push('<th>', (options.effectiveFieldsAlias[field] || field),
                    index === 0 ? ('(' + len + ')') : '' , // 表头第一列记录总数
                    '</th>');

                index++;
            }
            html.push('</tr></thead>');
        }
        html.push('<tbody>');

        // console.log(data, len);
        // 按列加数据
        var dataI;
        for (i = 0; i < len; i++) {
            index = 0;
            tds = [];
            dataI = dataList[i];
            idValue = dataI[options.idField];
            keyValue = dataI[options.keyField];

            for (field in dataI) {
                // 标记作为 value 和 作为 id 的值
                if (isUndefined(keyValue) && options.indexKey === index) {
                    keyValue = dataI[field];
                }
                if (isUndefined(idValue) && options.indexId === index) {
                    idValue = dataI[field];
                }

                index++;

                // 列表中只显示有效的字段
                if (inEffectiveFields(field, options)) {
                    tds.push('<td data-name="', field, '">', dataI[field], '</td>');
                }
            }

            html.push('<tr data-index="', (dataI.__index || i),
                '" data-id="', idValue,
                '" data-key="', keyValue, '">',
                tds.join(''), '</tr>');
        }
        html.push('</tbody></table>');

        $dropdownMenu.html(html.join(''));
        showDropMenu($input, options);
        //.show();

        // scrollbar 存在时，延时到动画结束时调整 padding
        setTimeout(function() {
            if (notNeedCalcPadding) {
                return;
            }

            var $table = $dropdownMenu.find('table:eq(0)'),
                pdr = 0,
                mgb = 0;

            if (
                $dropdownMenu.height() < $table.height() &&
                +$dropdownMenu.css('minWidth').replace('px', '') < $dropdownMenu.width()
            ) {
                pdr = 18;
                mgb = 20;
            }

            $dropdownMenu.css('paddingRight', pdr);
            $table.css('marginBottom', mgb);
        }, 301);

        adjustDropMenuPos($input, $dropdownMenu, options);

        return $input;
    }
    /**
     * ajax 获取数据
     * @param  {Object} options
     * @return {Object}         $.Deferred
     */
    function ajax(options, keyword) {
        keyword = keyword || '';

        var preAjax = options._preAjax;

        if (preAjax && preAjax.abort && preAjax.readyState !== 4) {
            // console.log('abort pre ajax');
            preAjax.abort();
        }

        var ajaxParam = {
            type: 'GET',
            dataType: options.jsonp ? 'jsonp' : 'json',
            timeout: 5000,
        };

        // jsonp
        if (options.jsonp) {
            ajaxParam.jsonp = options.jsonp;
        }

        // 自定义 ajax 请求参数生成方法
        var adjustAjaxParam,
            fnAdjustAjaxParam = options.fnAdjustAjaxParam;

        if ($.isFunction(fnAdjustAjaxParam)) {
            adjustAjaxParam = fnAdjustAjaxParam(keyword, options);

            // options.fnAdjustAjaxParam 返回false，则终止 ajax 请求
            if (FALSE === adjustAjaxParam) {
                return;
            }

            $.extend(ajaxParam, adjustAjaxParam);
        }

        // url 调整
        ajaxParam.url = function() {
            if (!keyword || ajaxParam.data) {
                return ajaxParam.url || options.url;
            }

            var type = '?';
            if (/=$/.test(options.url)) {
                type = '';
            } else if (/\?/.test(options.url)) {
                type = '&';
            }

            return options.url + type + encodeURIComponent(keyword);
        }();

        return options._preAjax = $.ajax(ajaxParam).done(function(result) {
            options.data = options.fnProcessData(result);
        }).fail(function(err) {
            if (options.fnAjaxFail) {
                options.fnAjaxFail(err, options);
            }
        });
    }
    /**
     * 检测 keyword 与 value 是否存在互相包含
     * @param  {String}  keyword 用户输入的关键字
     * @param  {String}  key     匹配字段的 key
     * @param  {String}  value   key 字段对应的值
     * @param  {Object}  options
     * @return {Boolean}         包含/不包含
     */
    function isInWord(keyword, key, value, options) {
        value = $.trim(value);

        if (options.ignorecase) {
            keyword = keyword.toLocaleLowerCase();
            value = value.toLocaleLowerCase();
        }

        return value &&
            (inEffectiveFields(key, options) || inSearchFields(key, options)) && // 必须在有效的搜索字段中
            (
                ~value.indexOf(keyword) || // 匹配值包含关键字
                options.twoWayMatch && ~keyword.indexOf(value) // 关键字包含匹配值
            );
    }
    /**
     * 通过 ajax 或 json 参数获取数据
     */
    function getData(keyword, $input, callback, options) {
        var data, validData, filterData = {
                value: []
            },
            i, key, len,
            fnPreprocessKeyword = options.fnPreprocessKeyword;

        keyword = keyword || '';
        // 获取数据前对关键字预处理方法
        if ($.isFunction(fnPreprocessKeyword)) {
            keyword = fnPreprocessKeyword(keyword, options);
        }

        // 给了url参数，则从服务器 ajax 请求
        // console.log(options.url + keyword);
        if (options.url) {
            var timer;
            if (options.searchingTip) {
                timer = setTimeout(function() {
                    showTip(options.searchingTip, $input, $input.parent().find('ul'), options);
                }, 600);
            }

            ajax(options, keyword).done(function(result) {
                callback($input, options.data, options); // 为 refreshDropMenu
                $input.trigger(onDataRequestSuccess, result);
                if (options.getDataMethod === 'firstByUrl') {
                    options.url = null;
                }
            }).always(function() {
                timer && clearTimeout(timer);
            });
        } else {
            // 没有给出 url 参数，则从 data 参数获取
            data = options.data;
            validData = checkData(data);
            // 本地的 data 数据，则在本地过滤
            if (validData) {
                if (keyword) {
                    // 输入不为空时则进行匹配
                    len = data.value.length;
                    for (i = 0; i < len; i++) {
                        for (key in data.value[i]) {
                            if (
                                data.value[i][key] &&
                                isInWord(keyword, key, data.value[i][key] + '', options)
                            ) {
                                filterData.value.push(data.value[i]);
                                filterData.value[filterData.value.length - 1].__index = i;
                                break;
                            }
                        }
                    }
                } else {
                    filterData = data;
                }
            }

            callback($input, filterData, options);
        } // else
    }
    /**
     * 数据处理
     * url 获取数据时，对数据的处理，作为 fnGetData 之后的回调处理
     */
    function processData(data) {
        return checkData(data);
    }
    /**
     * 取得 clearable 清除按钮
     */
    function getIClear($input, options) {
        var $iClear = $input.prev('i.clearable');

        // 是否可清除已输入的内容(添加清除按钮)
        if (options.clearable && !$iClear.length) {
                $iClear = $('<i class="clearable glyphicon glyphicon-remove fa fa-plus"></i>')
                    .prependTo($input.parent());
        }

        return $iClear.css({
            position: 'absolute',
            top: 'calc(50% - 6px)',
            transform: 'rotate(45deg)',
            // right: options.showBtn ? Math.max($input.next('.input-group-btn').width(), 33) + 2 : 12,
            zIndex: 4,
            cursor: 'pointer',
            width: '14px',
            lineHeight: '14px',
            textAlign: 'center',
            fontSize: 12
        }).hide();
    }
    /**
     * 默认的配置选项
     * @type {Object}
     */
    var defaultOptions = {
        url: null,                      // 请求数据的 URL 地址
        jsonp: null,                    // 设置此参数名，将开启jsonp功能，否则使用json数据结构
        data: {
            value: []
        },                              // 提示所用的数据，注意格式
        indexId: 0,                     // 每组数据的第几个数据，作为input输入框的 data-id，设为 -1 且 idField 为空则不设置此值
        indexKey: 0,                    // 每组数据的第几个数据，作为input输入框的内容
        idField: '',                    // 每组数据的哪个字段作为 data-id，优先级高于 indexId 设置（推荐）
        keyField: '',                   // 每组数据的哪个字段作为输入框内容，优先级高于 indexKey 设置（推荐）

        /* 搜索相关 */
        autoSelect: TRUE,               // 键盘向上/下方向键时，是否自动选择值
        allowNoKeyword: TRUE,           // 是否允许无关键字时请求数据
        getDataMethod: 'firstByUrl',    // 获取数据的方式，url：一直从url请求；data：从 options.data 获取；firstByUrl：第一次从Url获取全部数据，之后从options.data获取
        delayUntilKeyup: FALSE,         // 获取数据的方式 为 firstByUrl 时，是否延迟到有输入时才请求数据
        ignorecase: FALSE,              // 前端搜索匹配时，是否忽略大小写
        effectiveFields: [],            // 有效显示于列表中的字段，非有效字段都会过滤，默认全部有效。
        effectiveFieldsAlias: {},       // 有效字段的别名对象，用于 header 的显示
        searchFields: [],               // 有效搜索字段，从前端搜索过滤数据时使用，但不一定显示在列表中。effectiveFields 配置字段也会用于搜索过滤
        twoWayMatch: TRUE,              // 是否双向匹配搜索。为 true 即输入关键字包含或包含于匹配字段均认为匹配成功，为 false 则输入关键字包含于匹配字段认为匹配成功
        multiWord: FALSE,               // 以分隔符号分割的多关键字支持
        separator: ',',                 // 多关键字支持时的分隔符，默认为半角逗号
        delay: 300,                     // 搜索触发的延时时间间隔，单位毫秒
        emptyTip: '',                   // 查询为空时显示的内容，可为 html
        searchingTip: '搜索中...',       // ajax 搜索时显示的提示内容，当搜索时间较长时给出正在搜索的提示
        hideOnSelect: FALSE,            // 鼠标从列表单击选择了值时，是否隐藏选择列表

        /* UI */
        autoDropup: FALSE,              // 选择菜单是否自动判断向上展开。设为 true，则当下拉菜单高度超过窗体，且向上方向不会被窗体覆盖，则选择菜单向上弹出
        autoMinWidth: FALSE,            // 是否自动最小宽度，设为 false 则最小宽度不小于输入框宽度
        showHeader: FALSE,              // 是否显示选择列表的 header。为 true 时，有效字段大于一列则显示表头
        showBtn: TRUE,                  // 是否显示下拉按钮
        inputBgColor: '',               // 输入框背景色，当与容器背景色不同时，可能需要该项的配置
        inputWarnColor: 'rgba(255,0,0,.1)', // 输入框内容不是下拉列表选择时的警告色
        listStyle: {
            'padding-top': 0,
            'max-height': '375px',
            'max-width': '800px',
            'overflow': 'auto',
            'width': 'auto',
            'transition': '0.3s',
            '-webkit-transition': '0.3s',
            '-moz-transition': '0.3s',
            '-o-transition': '0.3s',
            'word-break': 'keep-all',
            'white-space': 'nowrap'
        },                              // 列表的样式控制
        listAlign: 'left',              // 提示列表对齐位置，left/right/auto
        listHoverStyle: 'background: #07d; color:#fff', // 提示框列表鼠标悬浮的样式
        listHoverCSS: 'jhover',         // 提示框列表鼠标悬浮的样式名称
        clearable: FALSE,               // 是否可清除已输入的内容

        /* key */
        keyLeft: 37,                    // 向左方向键，不同的操作系统可能会有差别，则自行定义
        keyUp: 38,                      // 向上方向键
        keyRight: 39,                   // 向右方向键
        keyDown: 40,                    // 向下方向键
        keyEnter: 13,                   // 回车键

        /* methods */
        fnProcessData: processData,     // 格式化数据的方法，返回数据格式参考 data 参数
        fnGetData: getData,             // 获取数据的方法，无特殊需求一般不作设置
        fnAdjustAjaxParam: null,        // 调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        fnPreprocessKeyword: null,      // 搜索过滤数据前，对输入关键字作进一步处理方法。注意，应返回字符串
        fnAjaxFail: null,               // ajax 失败时回调方法
    };

    var methods = {
        init: function(options) {
            // 参数设置
            var self = this;
            options = options || {};

            // 默认配置有效显示字段多于一个，则显示列表表头，否则不显示
            if (isUndefined(options.showHeader) && options.effectiveFields && options.effectiveFields.length > 1) {
                options.showHeader = TRUE;
            }

            options = $.extend(TRUE, {}, defaultOptions, options);

            // 旧的方法兼容
            if (options.processData) {
                options.fnProcessData = options.processData;
            }

            if (options.getData) {
                options.fnGetData = options.getData;
            }

            if (options.getDataMethod === 'firstByUrl' && options.url && !options.delayUntilKeyup) {
                ajax(options).done(function(result) {
                    options.url = null;
                    self.trigger(onDataRequestSuccess, result);
                });
            }

            // 鼠标滑动到条目样式
            if (!$('#' + BSSUGGEST).length) {
                $('head:eq(0)').append('<style id="' + BSSUGGEST + '">.' + options.listHoverCSS + '{' + options.listHoverStyle + '}</style>');
            }

            return self.each(function() {
                var $input = $(this),
                    $parent = $input.parent(),
                    $iClear = getIClear($input, options),
                    isMouseenterMenu,
                    keyupTimer, // keyup 与 input 事件延时定时器
                    $dropdownMenu = $parent.find('ul:eq(0)');

                // 兼容 bs4
                $dropdownMenu.parent().css('position', 'relative');

                // 验证输入框对象是否符合条件
                if (!checkInput($input, $dropdownMenu, options)) {
                    console.warn('不是一个标准的 bootstrap 下拉式菜单或已初始化:', $input);
                    return;
                }

                // 是否显示 button 按钮
                if (!options.showBtn) {
                    $input.css('borderRadius', 4);
                    $parent.css('width', '100%')
                        .find('.btn:eq(0)').hide();
                }

                // 移除 disabled 类，并禁用自动完成
                $input.removeClass(DISABLED).prop(DISABLED, FALSE).attr('autocomplete', 'off');
                // dropdown-menu 增加修饰
                $dropdownMenu.css(options.listStyle);

                // 默认背景色
                if (!options.inputBgColor) {
                    options.inputBgColor = $input.css('backgroundColor');
                }

                // 开始事件处理
                $input.on('keydown', function(event) {
                    var currentList, tipsKeyword; // 提示列表上被选中的关键字

                    // 当提示层显示时才对键盘事件处理
                    if (!$dropdownMenu.is(':visible')) {
                        setOrGetDataId($input, '');
                        return;
                    }

                    currentList = $dropdownMenu.find('.' + options.listHoverCSS);
                    tipsKeyword = ''; // 提示列表上被选中的关键字

                    unHoverAll($dropdownMenu, options);

                    if (event.keyCode === options.keyDown) { // 如果按的是向下方向键
                        if (!currentList.length) {
                            // 如果提示列表没有一个被选中,则将列表第一个选中
                            tipsKeyword = getPointKeyword($dropdownMenu.find('tbody tr:first').mouseover());
                        } else if (!currentList.next().length) {
                            // 如果是最后一个被选中,则取消选中,即可认为是输入框被选中，并恢复输入的值
                            if (options.autoSelect) {
                                setOrGetDataId($input, '').val(setOrGetAlt($input));
                            }
                        } else {
                            // 选中下一行
                            tipsKeyword = getPointKeyword(currentList.next().mouseover());
                        }
                        // 控制滑动条
                        adjustScroll($input, $dropdownMenu, options);

                        if (!options.autoSelect) {
                            return;
                        }
                    } else if (event.keyCode === options.keyUp) { // 如果按的是向上方向键
                        if (!currentList.length) {
                            tipsKeyword = getPointKeyword($dropdownMenu.find('tbody tr:last').mouseover());
                        } else if (!currentList.prev().length) {
                            if (options.autoSelect) {
                                setOrGetDataId($input, '').val(setOrGetAlt($input));
                            }
                        } else {
                            // 选中前一行
                            tipsKeyword = getPointKeyword(currentList.prev().mouseover());
                        }

                        // 控制滑动条
                        adjustScroll($input, $dropdownMenu, options);

                        if (!options.autoSelect) {
                            return;
                        }
                    } else if (event.keyCode === options.keyEnter) {
                        tipsKeyword = getPointKeyword(currentList);
                        hideDropMenu($input, options);
                    } else {
                        setOrGetDataId($input, '');
                    }

                    // 设置值 tipsKeyword
                    // console.log(tipsKeyword);
                    setValue($input, tipsKeyword, options);
                }).on('compositionstart', function(event) {
                    // 中文输入开始，锁定
                    // console.log('compositionstart');
                    inputLock = TRUE;
                }).on('compositionend', function(event) {
                    // 中文输入结束，解除锁定
                    // console.log('compositionend');
                    inputLock = FALSE;
                }).on('keyup input paste', function(event) {
                    var word;

                    if (event.keyCode) {
                        setBackground($input, options);
                    }

                    // 如果弹起的键是回车、向上或向下方向键则返回
                    if (~$.inArray(event.keyCode, [options.keyDown, options.keyUp, options.keyEnter])) {
                        $input.val($input.val()); // 让鼠标输入跳到最后
                        return;
                    }

                    clearTimeout(keyupTimer);
                    keyupTimer = setTimeout(function() {
                        // console.log('input keyup', event);

                        // 锁定状态，返回
                        if (inputLock) {
                            return;
                        }

                        word = $input.val();

                        // 若输入框值没有改变则返回
                        if ($.trim(word) && word === setOrGetAlt($input)) {
                            return;
                        }

                        // 当按下键之前记录输入框值,以方便查看键弹起时值有没有变
                        setOrGetAlt($input, word);

                        if (options.multiWord) {
                            word = word.split(options.separator).reverse()[0];
                        }

                        // 是否允许空数据查询
                        if (!word.length && !options.allowNoKeyword) {
                            return;
                        }

                        options.fnGetData($.trim(word), $input, refreshDropMenu, options);
                    }, options.delay || 300);
                }).on('focus', function() {
                    // console.log('input focus');
                    adjustDropMenuPos($input, $dropdownMenu, options);
                }).on('blur', function() {
                    if (!isMouseenterMenu) { // 不是进入下拉列表状态，则隐藏列表
                        hideDropMenu($input, options);
                    }
                }).on('click', function() {
                    // console.log('input click');
                    var word = $input.val();

                    if (
                        $.trim(word) &&
                        word === setOrGetAlt($input) &&
                        $dropdownMenu.find('table tr').length
                    ) {
                        return showDropMenu($input, options);
                    }

                    if ($dropdownMenu.is(':visible')) {
                        return;
                    }

                    if (options.multiWord) {
                        word = word.split(options.separator).reverse()[0];
                    }

                    // 是否允许空数据查询
                    if (!word.length && !options.allowNoKeyword) {
                        return;
                    }

                    // console.log('word', word);
                    options.fnGetData($.trim(word), $input, refreshDropMenu, options);
                });

                // 下拉按钮点击时
                $parent.find('.btn:eq(0)').attr('data-toggle', '').click(function() {
                    if (!$dropdownMenu.is(':visible')) {
                        if (options.url) {
                            $input.click().focus();
                            if (!$dropdownMenu.find('tr').length) {
                                return FALSE;
                            }
                        } else {
                            // 不以 keyword 作为过滤，展示所有的数据
                            refreshDropMenu($input, options.data, options);
                        }
                        showDropMenu($input, options);
                    } else {
                        hideDropMenu($input, options);
                    }

                    return FALSE;
                });

                // 列表中滑动时，输入框失去焦点
                $dropdownMenu.mouseenter(function() {
                        // console.log('mouseenter')
                        isMouseenterMenu = 1;
                        $input.blur();
                    }).mouseleave(function() {
                        // console.log('mouseleave')
                        isMouseenterMenu = 0;
                        $input.focus();
                    }).on('mouseenter', 'tbody tr', function() {
                        // 行上的移动事件
                        unHoverAll($dropdownMenu, options);
                        $(this).addClass(options.listHoverCSS);

                        return FALSE; // 阻止冒泡
                    })
                    .on('mousedown', 'tbody tr', function() {
                        var keywords = getPointKeyword($(this));
                        setValue($input, keywords, options);
                        setOrGetAlt($input, keywords.key);
                        setBackground($input, options);

                        if (options.hideOnSelect) {
                            hideDropMenu($input, options);
                        }
                    });

                // 存在清空按钮
                if ($iClear.length) {
                    $iClear.click(function () {
                        setOrGetDataId($input, '').val('');
                        setBackground($input, options);
                    });

                    $parent.mouseenter(function() {
                        if (!$input.prop(DISABLED)) {
                            $iClear.css('right', options.showBtn ? Math.max($input.next().width(), 33) + 2 : 12)
                                .show();
                        }
                    }).mouseleave(function() {
                        $iClear.hide();
                    });
                }

            });
        },
        show: function() {
            return this.each(function() {
                $(this).click();
            });
        },
        hide: function() {
            return this.each(function() {
                hideDropMenu($(this));
            });
        },
        disable: function() {
            return this.each(function() {
                $(this).attr(DISABLED, TRUE)
                    .parent().find('.btn:eq(0)').prop(DISABLED, TRUE);
            });
        },
        enable: function() {
            return this.each(function() {
                $(this).attr(DISABLED, FALSE)
                    .parent().find('.btn:eq(0)').prop(DISABLED, FALSE);
            });
        },
        destroy: function() {
            return this.each(function() {
                $(this).off().removeData(BSSUGGEST).removeAttr('style')
                    .parent().find('.btn:eq(0)').off().show().attr('data-toggle', 'dropdown').prop(DISABLED, FALSE) // .addClass(DISABLED);
                    .next().css('display', '').off();
            });
        },
        version: function() {
            return VERSION;
        }
    };

    $.fn[BSSUGGEST] = function(options) {
        // 方法判断
        if (typeof options === 'string' && methods[options]) {
            var inited = TRUE;
            this.each(function() {
                if (!$(this).data(BSSUGGEST)) {
                    return inited = FALSE;
                }
            });
            // 只要有一个未初始化，则全部都不执行方法，除非是 init 或 version
            if (!inited && 'init' !== options && 'version' !== options) {
                return this;
            }

            // 如果是方法，则参数第一个为函数名，从第二个开始为函数参数
            return methods[options].apply(this, [].slice.call(arguments, 1));
        } else {
            // 调用初始化方法
            return methods.init.apply(this, arguments);
        }
    }
});
/* bignumber.js v9.0.1 https://github.com/MikeMcl/bignumber.js/LICENCE.md */!function(e){"use strict";var r,C=/^-?(?:\d+(?:\.\d*)?|\.\d+)(?:e[+-]?\d+)?$/i,M=Math.ceil,G=Math.floor,k="[BigNumber Error] ",F=k+"Number primitive has more than 15 significant digits: ",q=1e14,j=14,$=9007199254740991,z=[1,10,100,1e3,1e4,1e5,1e6,1e7,1e8,1e9,1e10,1e11,1e12,1e13],H=1e7,V=1e9;function W(e){var r=0|e;return 0<e||e===r?r:r-1}function X(e){for(var r,n,t=1,i=e.length,o=e[0]+"";t<i;){for(r=e[t++]+"",n=j-r.length;n--;r="0"+r);o+=r}for(i=o.length;48===o.charCodeAt(--i););return o.slice(0,i+1||1)}function Y(e,r){var n,t,i=e.c,o=r.c,s=e.s,f=r.s,u=e.e,l=r.e;if(!s||!f)return null;if(n=i&&!i[0],t=o&&!o[0],n||t)return n?t?0:-f:s;if(s!=f)return s;if(n=s<0,t=u==l,!i||!o)return t?0:!i^n?1:-1;if(!t)return l<u^n?1:-1;for(f=(u=i.length)<(l=o.length)?u:l,s=0;s<f;s++)if(i[s]!=o[s])return i[s]>o[s]^n?1:-1;return u==l?0:l<u^n?1:-1}function J(e,r,n,t){if(e<r||n<e||e!==G(e))throw Error(k+(t||"Argument")+("number"==typeof e?e<r||n<e?" out of range: ":" not an integer: ":" not a primitive number: ")+String(e))}function Z(e){var r=e.c.length-1;return W(e.e/j)==r&&e.c[r]%2!=0}function K(e,r){return(1<e.length?e.charAt(0)+"."+e.slice(1):e)+(r<0?"e":"e+")+r}function Q(e,r,n){var t,i;if(r<0){for(i=n+".";++r;i+=n);e=i+e}else if(++r>(t=e.length)){for(i=n,r-=t;--r;i+=n);e+=i}else r<t&&(e=e.slice(0,r)+"."+e.slice(r));return e}(r=function e(r){var d,a,h,n,l,m,s,f,u,c,g,t=_.prototype={constructor:_,toString:null,valueOf:null},w=new _(1),v=20,N=4,p=-7,O=21,y=-1e7,b=1e7,E=!1,o=1,A=0,S={prefix:"",groupSize:3,secondaryGroupSize:0,groupSeparator:",",decimalSeparator:".",fractionGroupSize:0,fractionGroupSeparator:" ",suffix:""},R="0123456789abcdefghijklmnopqrstuvwxyz";function _(e,r){var n,t,i,o,s,f,u,l,c=this;if(!(c instanceof _))return new _(e,r);if(null==r){if(e&&!0===e._isBigNumber)return c.s=e.s,void(!e.c||e.e>b?c.c=c.e=null:e.e<y?c.c=[c.e=0]:(c.e=e.e,c.c=e.c.slice()));if((f="number"==typeof e)&&0*e==0){if(c.s=1/e<0?(e=-e,-1):1,e===~~e){for(o=0,s=e;10<=s;s/=10,o++);return void(b<o?c.c=c.e=null:(c.e=o,c.c=[e]))}l=String(e)}else{if(!C.test(l=String(e)))return h(c,l,f);c.s=45==l.charCodeAt(0)?(l=l.slice(1),-1):1}-1<(o=l.indexOf("."))&&(l=l.replace(".","")),0<(s=l.search(/e/i))?(o<0&&(o=s),o+=+l.slice(s+1),l=l.substring(0,s)):o<0&&(o=l.length)}else{if(J(r,2,R.length,"Base"),10==r)return I(c=new _(e),v+c.e+1,N);if(l=String(e),f="number"==typeof e){if(0*e!=0)return h(c,l,f,r);if(c.s=1/e<0?(l=l.slice(1),-1):1,_.DEBUG&&15<l.replace(/^0\.0*|\./,"").length)throw Error(F+e)}else c.s=45===l.charCodeAt(0)?(l=l.slice(1),-1):1;for(n=R.slice(0,r),o=s=0,u=l.length;s<u;s++)if(n.indexOf(t=l.charAt(s))<0){if("."==t){if(o<s){o=u;continue}}else if(!i&&(l==l.toUpperCase()&&(l=l.toLowerCase())||l==l.toLowerCase()&&(l=l.toUpperCase()))){i=!0,s=-1,o=0;continue}return h(c,String(e),f,r)}f=!1,-1<(o=(l=a(l,r,10,c.s)).indexOf("."))?l=l.replace(".",""):o=l.length}for(s=0;48===l.charCodeAt(s);s++);for(u=l.length;48===l.charCodeAt(--u););if(l=l.slice(s,++u)){if(u-=s,f&&_.DEBUG&&15<u&&($<e||e!==G(e)))throw Error(F+c.s*e);if((o=o-s-1)>b)c.c=c.e=null;else if(o<y)c.c=[c.e=0];else{if(c.e=o,c.c=[],s=(o+1)%j,o<0&&(s+=j),s<u){for(s&&c.c.push(+l.slice(0,s)),u-=j;s<u;)c.c.push(+l.slice(s,s+=j));s=j-(l=l.slice(s)).length}else s-=u;for(;s--;l+="0");c.c.push(+l)}}else c.c=[c.e=0]}function B(e,r,n,t){for(var i,o,s=[0],f=0,u=e.length;f<u;){for(o=s.length;o--;s[o]*=r);for(s[0]+=t.indexOf(e.charAt(f++)),i=0;i<s.length;i++)s[i]>n-1&&(null==s[i+1]&&(s[i+1]=0),s[i+1]+=s[i]/n|0,s[i]%=n)}return s.reverse()}function D(e,r,n){var t,i,o,s,f=0,u=e.length,l=r%H,c=r/H|0;for(e=e.slice();u--;)f=((i=l*(o=e[u]%H)+(t=c*o+(s=e[u]/H|0)*l)%H*H+f)/n|0)+(t/H|0)+c*s,e[u]=i%n;return f&&(e=[f].concat(e)),e}function P(e,r,n,t){var i,o;if(n!=t)o=t<n?1:-1;else for(i=o=0;i<n;i++)if(e[i]!=r[i]){o=e[i]>r[i]?1:-1;break}return o}function x(e,r,n,t){for(var i=0;n--;)e[n]-=i,i=e[n]<r[n]?1:0,e[n]=i*t+e[n]-r[n];for(;!e[0]&&1<e.length;e.splice(0,1));}function i(e,r,n,t){var i,o,s,f,u;if(null==n?n=N:J(n,0,8),!e.c)return e.toString();if(i=e.c[0],s=e.e,null==r)u=X(e.c),u=1==t||2==t&&(s<=p||O<=s)?K(u,s):Q(u,s,"0");else if(o=(e=I(new _(e),r,n)).e,f=(u=X(e.c)).length,1==t||2==t&&(r<=o||o<=p)){for(;f<r;u+="0",f++);u=K(u,o)}else if(r-=s,u=Q(u,o,"0"),f<o+1){if(0<--r)for(u+=".";r--;u+="0");}else if(0<(r+=o-f))for(o+1==f&&(u+=".");r--;u+="0");return e.s<0&&i?"-"+u:u}function L(e,r){for(var n,t=1,i=new _(e[0]);t<e.length;t++){if(!(n=new _(e[t])).s){i=n;break}r.call(i,n)&&(i=n)}return i}function U(e,r,n){for(var t=1,i=r.length;!r[--i];r.pop());for(i=r[0];10<=i;i/=10,t++);return(n=t+n*j-1)>b?e.c=e.e=null:n<y?e.c=[e.e=0]:(e.e=n,e.c=r),e}function I(e,r,n,t){var i,o,s,f,u,l,c,a=e.c,h=z;if(a){e:{for(i=1,f=a[0];10<=f;f/=10,i++);if((o=r-i)<0)o+=j,s=r,c=(u=a[l=0])/h[i-s-1]%10|0;else if((l=M((o+1)/j))>=a.length){if(!t)break e;for(;a.length<=l;a.push(0));u=c=0,s=(o%=j)-j+(i=1)}else{for(u=f=a[l],i=1;10<=f;f/=10,i++);c=(s=(o%=j)-j+i)<0?0:u/h[i-s-1]%10|0}if(t=t||r<0||null!=a[l+1]||(s<0?u:u%h[i-s-1]),t=n<4?(c||t)&&(0==n||n==(e.s<0?3:2)):5<c||5==c&&(4==n||t||6==n&&(0<o?0<s?u/h[i-s]:0:a[l-1])%10&1||n==(e.s<0?8:7)),r<1||!a[0])return a.length=0,t?(r-=e.e+1,a[0]=h[(j-r%j)%j],e.e=-r||0):a[0]=e.e=0,e;if(0==o?(a.length=l,f=1,l--):(a.length=l+1,f=h[j-o],a[l]=0<s?G(u/h[i-s]%h[s])*f:0),t)for(;;){if(0==l){for(o=1,s=a[0];10<=s;s/=10,o++);for(s=a[0]+=f,f=1;10<=s;s/=10,f++);o!=f&&(e.e++,a[0]==q&&(a[0]=1));break}if(a[l]+=f,a[l]!=q)break;a[l--]=0,f=1}for(o=a.length;0===a[--o];a.pop());}e.e>b?e.c=e.e=null:e.e<y&&(e.c=[e.e=0])}return e}function T(e){var r,n=e.e;return null===n?e.toString():(r=X(e.c),r=n<=p||O<=n?K(r,n):Q(r,n,"0"),e.s<0?"-"+r:r)}return _.clone=e,_.ROUND_UP=0,_.ROUND_DOWN=1,_.ROUND_CEIL=2,_.ROUND_FLOOR=3,_.ROUND_HALF_UP=4,_.ROUND_HALF_DOWN=5,_.ROUND_HALF_EVEN=6,_.ROUND_HALF_CEIL=7,_.ROUND_HALF_FLOOR=8,_.EUCLID=9,_.config=_.set=function(e){var r,n;if(null!=e){if("object"!=typeof e)throw Error(k+"Object expected: "+e);if(e.hasOwnProperty(r="DECIMAL_PLACES")&&(J(n=e[r],0,V,r),v=n),e.hasOwnProperty(r="ROUNDING_MODE")&&(J(n=e[r],0,8,r),N=n),e.hasOwnProperty(r="EXPONENTIAL_AT")&&((n=e[r])&&n.pop?(J(n[0],-V,0,r),J(n[1],0,V,r),p=n[0],O=n[1]):(J(n,-V,V,r),p=-(O=n<0?-n:n))),e.hasOwnProperty(r="RANGE"))if((n=e[r])&&n.pop)J(n[0],-V,-1,r),J(n[1],1,V,r),y=n[0],b=n[1];else{if(J(n,-V,V,r),!n)throw Error(k+r+" cannot be zero: "+n);y=-(b=n<0?-n:n)}if(e.hasOwnProperty(r="CRYPTO")){if((n=e[r])!==!!n)throw Error(k+r+" not true or false: "+n);if(n){if("undefined"==typeof crypto||!crypto||!crypto.getRandomValues&&!crypto.randomBytes)throw E=!n,Error(k+"crypto unavailable");E=n}else E=n}if(e.hasOwnProperty(r="MODULO_MODE")&&(J(n=e[r],0,9,r),o=n),e.hasOwnProperty(r="POW_PRECISION")&&(J(n=e[r],0,V,r),A=n),e.hasOwnProperty(r="FORMAT")){if("object"!=typeof(n=e[r]))throw Error(k+r+" not an object: "+n);S=n}if(e.hasOwnProperty(r="ALPHABET")){if("string"!=typeof(n=e[r])||/^.?$|[+\-.\s]|(.).*\1/.test(n))throw Error(k+r+" invalid: "+n);R=n}}return{DECIMAL_PLACES:v,ROUNDING_MODE:N,EXPONENTIAL_AT:[p,O],RANGE:[y,b],CRYPTO:E,MODULO_MODE:o,POW_PRECISION:A,FORMAT:S,ALPHABET:R}},_.isBigNumber=function(e){if(!e||!0!==e._isBigNumber)return!1;if(!_.DEBUG)return!0;var r,n,t=e.c,i=e.e,o=e.s;e:if("[object Array]"=={}.toString.call(t)){if((1===o||-1===o)&&-V<=i&&i<=V&&i===G(i)){if(0===t[0]){if(0===i&&1===t.length)return!0;break e}if((r=(i+1)%j)<1&&(r+=j),String(t[0]).length==r){for(r=0;r<t.length;r++)if((n=t[r])<0||q<=n||n!==G(n))break e;if(0!==n)return!0}}}else if(null===t&&null===i&&(null===o||1===o||-1===o))return!0;throw Error(k+"Invalid BigNumber: "+e)},_.maximum=_.max=function(){return L(arguments,t.lt)},_.minimum=_.min=function(){return L(arguments,t.gt)},_.random=(n=9007199254740992,l=Math.random()*n&2097151?function(){return G(Math.random()*n)}:function(){return 8388608*(1073741824*Math.random()|0)+(8388608*Math.random()|0)},function(e){var r,n,t,i,o,s=0,f=[],u=new _(w);if(null==e?e=v:J(e,0,V),i=M(e/j),E)if(crypto.getRandomValues){for(r=crypto.getRandomValues(new Uint32Array(i*=2));s<i;)9e15<=(o=131072*r[s]+(r[s+1]>>>11))?(n=crypto.getRandomValues(new Uint32Array(2)),r[s]=n[0],r[s+1]=n[1]):(f.push(o%1e14),s+=2);s=i/2}else{if(!crypto.randomBytes)throw E=!1,Error(k+"crypto unavailable");for(r=crypto.randomBytes(i*=7);s<i;)9e15<=(o=281474976710656*(31&r[s])+1099511627776*r[s+1]+4294967296*r[s+2]+16777216*r[s+3]+(r[s+4]<<16)+(r[s+5]<<8)+r[s+6])?crypto.randomBytes(7).copy(r,s):(f.push(o%1e14),s+=7);s=i/7}if(!E)for(;s<i;)(o=l())<9e15&&(f[s++]=o%1e14);for(i=f[--s],e%=j,i&&e&&(o=z[j-e],f[s]=G(i/o)*o);0===f[s];f.pop(),s--);if(s<0)f=[t=0];else{for(t=-1;0===f[0];f.splice(0,1),t-=j);for(s=1,o=f[0];10<=o;o/=10,s++);s<j&&(t-=j-s)}return u.e=t,u.c=f,u}),_.sum=function(){for(var e=1,r=arguments,n=new _(r[0]);e<r.length;)n=n.plus(r[e++]);return n},m="0123456789",a=function(e,r,n,t,i){var o,s,f,u,l,c,a,h,g=e.indexOf("."),p=v,w=N;for(0<=g&&(u=A,A=0,e=e.replace(".",""),c=(h=new _(r)).pow(e.length-g),A=u,h.c=B(Q(X(c.c),c.e,"0"),10,n,m),h.e=h.c.length),f=u=(a=B(e,r,n,i?(o=R,m):(o=m,R))).length;0==a[--u];a.pop());if(!a[0])return o.charAt(0);if(g<0?--f:(c.c=a,c.e=f,c.s=t,a=(c=d(c,h,p,w,n)).c,l=c.r,f=c.e),g=a[s=f+p+1],u=n/2,l=l||s<0||null!=a[s+1],l=w<4?(null!=g||l)&&(0==w||w==(c.s<0?3:2)):u<g||g==u&&(4==w||l||6==w&&1&a[s-1]||w==(c.s<0?8:7)),s<1||!a[0])e=l?Q(o.charAt(1),-p,o.charAt(0)):o.charAt(0);else{if(a.length=s,l)for(--n;++a[--s]>n;)a[s]=0,s||(++f,a=[1].concat(a));for(u=a.length;!a[--u];);for(g=0,e="";g<=u;e+=o.charAt(a[g++]));e=Q(e,f,o.charAt(0))}return e},d=function(e,r,n,t,i){var o,s,f,u,l,c,a,h,g,p,w,d,m,v,N,O,y,b=e.s==r.s?1:-1,E=e.c,A=r.c;if(!(E&&E[0]&&A&&A[0]))return new _(e.s&&r.s&&(E?!A||E[0]!=A[0]:A)?E&&0==E[0]||!A?0*b:b/0:NaN);for(g=(h=new _(b)).c=[],b=n+(s=e.e-r.e)+1,i||(i=q,s=W(e.e/j)-W(r.e/j),b=b/j|0),f=0;A[f]==(E[f]||0);f++);if(A[f]>(E[f]||0)&&s--,b<0)g.push(1),u=!0;else{for(v=E.length,O=A.length,b+=2,1<(l=G(i/(A[f=0]+1)))&&(A=D(A,l,i),E=D(E,l,i),O=A.length,v=E.length),m=O,w=(p=E.slice(0,O)).length;w<O;p[w++]=0);y=A.slice(),y=[0].concat(y),N=A[0],A[1]>=i/2&&N++;do{if(l=0,(o=P(A,p,O,w))<0){if(d=p[0],O!=w&&(d=d*i+(p[1]||0)),1<(l=G(d/N)))for(i<=l&&(l=i-1),a=(c=D(A,l,i)).length,w=p.length;1==P(c,p,a,w);)l--,x(c,O<a?y:A,a,i),a=c.length,o=1;else 0==l&&(o=l=1),a=(c=A.slice()).length;if(a<w&&(c=[0].concat(c)),x(p,c,w,i),w=p.length,-1==o)for(;P(A,p,O,w)<1;)l++,x(p,O<w?y:A,w,i),w=p.length}else 0===o&&(l++,p=[0]);g[f++]=l,p[0]?p[w++]=E[m]||0:(p=[E[m]],w=1)}while((m++<v||null!=p[0])&&b--);u=null!=p[0],g[0]||g.splice(0,1)}if(i==q){for(f=1,b=g[0];10<=b;b/=10,f++);I(h,n+(h.e=f+s*j-1)+1,t,u)}else h.e=s,h.r=+u;return h},s=/^(-?)0([xbo])(?=\w[\w.]*$)/i,f=/^([^.]+)\.$/,u=/^\.([^.]+)$/,c=/^-?(Infinity|NaN)$/,g=/^\s*\+(?=[\w.])|^\s+|\s+$/g,h=function(e,r,n,t){var i,o=n?r:r.replace(g,"");if(c.test(o))e.s=isNaN(o)?null:o<0?-1:1;else{if(!n&&(o=o.replace(s,function(e,r,n){return i="x"==(n=n.toLowerCase())?16:"b"==n?2:8,t&&t!=i?e:r}),t&&(i=t,o=o.replace(f,"$1").replace(u,"0.$1")),r!=o))return new _(o,i);if(_.DEBUG)throw Error(k+"Not a"+(t?" base "+t:"")+" number: "+r);e.s=null}e.c=e.e=null},t.absoluteValue=t.abs=function(){var e=new _(this);return e.s<0&&(e.s=1),e},t.comparedTo=function(e,r){return Y(this,new _(e,r))},t.decimalPlaces=t.dp=function(e,r){var n,t,i;if(null!=e)return J(e,0,V),null==r?r=N:J(r,0,8),I(new _(this),e+this.e+1,r);if(!(n=this.c))return null;if(t=((i=n.length-1)-W(this.e/j))*j,i=n[i])for(;i%10==0;i/=10,t--);return t<0&&(t=0),t},t.dividedBy=t.div=function(e,r){return d(this,new _(e,r),v,N)},t.dividedToIntegerBy=t.idiv=function(e,r){return d(this,new _(e,r),0,1)},t.exponentiatedBy=t.pow=function(e,r){var n,t,i,o,s,f,u,l,c=this;if((e=new _(e)).c&&!e.isInteger())throw Error(k+"Exponent not an integer: "+T(e));if(null!=r&&(r=new _(r)),s=14<e.e,!c.c||!c.c[0]||1==c.c[0]&&!c.e&&1==c.c.length||!e.c||!e.c[0])return l=new _(Math.pow(+T(c),s?2-Z(e):+T(e))),r?l.mod(r):l;if(f=e.s<0,r){if(r.c?!r.c[0]:!r.s)return new _(NaN);(t=!f&&c.isInteger()&&r.isInteger())&&(c=c.mod(r))}else{if(9<e.e&&(0<c.e||c.e<-1||(0==c.e?1<c.c[0]||s&&24e7<=c.c[1]:c.c[0]<8e13||s&&c.c[0]<=9999975e7)))return o=c.s<0&&Z(e)?-0:0,-1<c.e&&(o=1/o),new _(f?1/o:o);A&&(o=M(A/j+2))}for(u=s?(n=new _(.5),f&&(e.s=1),Z(e)):(i=Math.abs(+T(e)))%2,l=new _(w);;){if(u){if(!(l=l.times(c)).c)break;o?l.c.length>o&&(l.c.length=o):t&&(l=l.mod(r))}if(i){if(0===(i=G(i/2)))break;u=i%2}else if(I(e=e.times(n),e.e+1,1),14<e.e)u=Z(e);else{if(0==(i=+T(e)))break;u=i%2}c=c.times(c),o?c.c&&c.c.length>o&&(c.c.length=o):t&&(c=c.mod(r))}return t?l:(f&&(l=w.div(l)),r?l.mod(r):o?I(l,A,N,void 0):l)},t.integerValue=function(e){var r=new _(this);return null==e?e=N:J(e,0,8),I(r,r.e+1,e)},t.isEqualTo=t.eq=function(e,r){return 0===Y(this,new _(e,r))},t.isFinite=function(){return!!this.c},t.isGreaterThan=t.gt=function(e,r){return 0<Y(this,new _(e,r))},t.isGreaterThanOrEqualTo=t.gte=function(e,r){return 1===(r=Y(this,new _(e,r)))||0===r},t.isInteger=function(){return!!this.c&&W(this.e/j)>this.c.length-2},t.isLessThan=t.lt=function(e,r){return Y(this,new _(e,r))<0},t.isLessThanOrEqualTo=t.lte=function(e,r){return-1===(r=Y(this,new _(e,r)))||0===r},t.isNaN=function(){return!this.s},t.isNegative=function(){return this.s<0},t.isPositive=function(){return 0<this.s},t.isZero=function(){return!!this.c&&0==this.c[0]},t.minus=function(e,r){var n,t,i,o,s=this,f=s.s;if(r=(e=new _(e,r)).s,!f||!r)return new _(NaN);if(f!=r)return e.s=-r,s.plus(e);var u=s.e/j,l=e.e/j,c=s.c,a=e.c;if(!u||!l){if(!c||!a)return c?(e.s=-r,e):new _(a?s:NaN);if(!c[0]||!a[0])return a[0]?(e.s=-r,e):new _(c[0]?s:3==N?-0:0)}if(u=W(u),l=W(l),c=c.slice(),f=u-l){for((i=(o=f<0)?(f=-f,c):(l=u,a)).reverse(),r=f;r--;i.push(0));i.reverse()}else for(t=(o=(f=c.length)<(r=a.length))?f:r,f=r=0;r<t;r++)if(c[r]!=a[r]){o=c[r]<a[r];break}if(o&&(i=c,c=a,a=i,e.s=-e.s),0<(r=(t=a.length)-(n=c.length)))for(;r--;c[n++]=0);for(r=q-1;f<t;){if(c[--t]<a[t]){for(n=t;n&&!c[--n];c[n]=r);--c[n],c[t]+=q}c[t]-=a[t]}for(;0==c[0];c.splice(0,1),--l);return c[0]?U(e,c,l):(e.s=3==N?-1:1,e.c=[e.e=0],e)},t.modulo=t.mod=function(e,r){var n,t,i=this;return e=new _(e,r),!i.c||!e.s||e.c&&!e.c[0]?new _(NaN):!e.c||i.c&&!i.c[0]?new _(i):(9==o?(t=e.s,e.s=1,n=d(i,e,0,3),e.s=t,n.s*=t):n=d(i,e,0,o),(e=i.minus(n.times(e))).c[0]||1!=o||(e.s=i.s),e)},t.multipliedBy=t.times=function(e,r){var n,t,i,o,s,f,u,l,c,a,h,g,p,w,d,m=this,v=m.c,N=(e=new _(e,r)).c;if(!(v&&N&&v[0]&&N[0]))return!m.s||!e.s||v&&!v[0]&&!N||N&&!N[0]&&!v?e.c=e.e=e.s=null:(e.s*=m.s,v&&N?(e.c=[0],e.e=0):e.c=e.e=null),e;for(t=W(m.e/j)+W(e.e/j),e.s*=m.s,(u=v.length)<(a=N.length)&&(p=v,v=N,N=p,i=u,u=a,a=i),i=u+a,p=[];i--;p.push(0));for(w=q,d=H,i=a;0<=--i;){for(n=0,h=N[i]%d,g=N[i]/d|0,o=i+(s=u);i<o;)n=((l=h*(l=v[--s]%d)+(f=g*l+(c=v[s]/d|0)*h)%d*d+p[o]+n)/w|0)+(f/d|0)+g*c,p[o--]=l%w;p[o]=n}return n?++t:p.splice(0,1),U(e,p,t)},t.negated=function(){var e=new _(this);return e.s=-e.s||null,e},t.plus=function(e,r){var n,t=this,i=t.s;if(r=(e=new _(e,r)).s,!i||!r)return new _(NaN);if(i!=r)return e.s=-r,t.minus(e);var o=t.e/j,s=e.e/j,f=t.c,u=e.c;if(!o||!s){if(!f||!u)return new _(i/0);if(!f[0]||!u[0])return u[0]?e:new _(f[0]?t:0*i)}if(o=W(o),s=W(s),f=f.slice(),i=o-s){for((n=0<i?(s=o,u):(i=-i,f)).reverse();i--;n.push(0));n.reverse()}for((i=f.length)-(r=u.length)<0&&(n=u,u=f,f=n,r=i),i=0;r;)i=(f[--r]=f[r]+u[r]+i)/q|0,f[r]=q===f[r]?0:f[r]%q;return i&&(f=[i].concat(f),++s),U(e,f,s)},t.precision=t.sd=function(e,r){var n,t,i;if(null!=e&&e!==!!e)return J(e,1,V),null==r?r=N:J(r,0,8),I(new _(this),e,r);if(!(n=this.c))return null;if(t=(i=n.length-1)*j+1,i=n[i]){for(;i%10==0;i/=10,t--);for(i=n[0];10<=i;i/=10,t++);}return e&&this.e+1>t&&(t=this.e+1),t},t.shiftedBy=function(e){return J(e,-$,$),this.times("1e"+e)},t.squareRoot=t.sqrt=function(){var e,r,n,t,i,o=this,s=o.c,f=o.s,u=o.e,l=v+4,c=new _("0.5");if(1!==f||!s||!s[0])return new _(!f||f<0&&(!s||s[0])?NaN:s?o:1/0);if((n=0==(f=Math.sqrt(+T(o)))||f==1/0?(((r=X(s)).length+u)%2==0&&(r+="0"),f=Math.sqrt(+r),u=W((u+1)/2)-(u<0||u%2),new _(r=f==1/0?"5e"+u:(r=f.toExponential()).slice(0,r.indexOf("e")+1)+u)):new _(f+"")).c[0])for((f=(u=n.e)+l)<3&&(f=0);;)if(i=n,n=c.times(i.plus(d(o,i,l,1))),X(i.c).slice(0,f)===(r=X(n.c)).slice(0,f)){if(n.e<u&&--f,"9999"!=(r=r.slice(f-3,f+1))&&(t||"4999"!=r)){+r&&(+r.slice(1)||"5"!=r.charAt(0))||(I(n,n.e+v+2,1),e=!n.times(n).eq(o));break}if(!t&&(I(i,i.e+v+2,0),i.times(i).eq(o))){n=i;break}l+=4,f+=4,t=1}return I(n,n.e+v+1,N,e)},t.toExponential=function(e,r){return null!=e&&(J(e,0,V),e++),i(this,e,r,1)},t.toFixed=function(e,r){return null!=e&&(J(e,0,V),e=e+this.e+1),i(this,e,r)},t.toFormat=function(e,r,n){var t;if(null==n)null!=e&&r&&"object"==typeof r?(n=r,r=null):e&&"object"==typeof e?(n=e,e=r=null):n=S;else if("object"!=typeof n)throw Error(k+"Argument not an object: "+n);if(t=this.toFixed(e,r),this.c){var i,o=t.split("."),s=+n.groupSize,f=+n.secondaryGroupSize,u=n.groupSeparator||"",l=o[0],c=o[1],a=this.s<0,h=a?l.slice(1):l,g=h.length;if(f&&(i=s,s=f,g-=f=i),0<s&&0<g){for(i=g%s||s,l=h.substr(0,i);i<g;i+=s)l+=u+h.substr(i,s);0<f&&(l+=u+h.slice(i)),a&&(l="-"+l)}t=c?l+(n.decimalSeparator||"")+((f=+n.fractionGroupSize)?c.replace(new RegExp("\\d{"+f+"}\\B","g"),"$&"+(n.fractionGroupSeparator||"")):c):l}return(n.prefix||"")+t+(n.suffix||"")},t.toFraction=function(e){var r,n,t,i,o,s,f,u,l,c,a,h,g=this,p=g.c;if(null!=e&&(!(f=new _(e)).isInteger()&&(f.c||1!==f.s)||f.lt(w)))throw Error(k+"Argument "+(f.isInteger()?"out of range: ":"not an integer: ")+T(f));if(!p)return new _(g);for(r=new _(w),l=n=new _(w),t=u=new _(w),h=X(p),o=r.e=h.length-g.e-1,r.c[0]=z[(s=o%j)<0?j+s:s],e=!e||0<f.comparedTo(r)?0<o?r:l:f,s=b,b=1/0,f=new _(h),u.c[0]=0;c=d(f,r,0,1),1!=(i=n.plus(c.times(t))).comparedTo(e);)n=t,t=i,l=u.plus(c.times(i=l)),u=i,r=f.minus(c.times(i=r)),f=i;return i=d(e.minus(n),t,0,1),u=u.plus(i.times(l)),n=n.plus(i.times(t)),u.s=l.s=g.s,a=d(l,t,o*=2,N).minus(g).abs().comparedTo(d(u,n,o,N).minus(g).abs())<1?[l,t]:[u,n],b=s,a},t.toNumber=function(){return+T(this)},t.toPrecision=function(e,r){return null!=e&&J(e,1,V),i(this,e,r,2)},t.toString=function(e){var r,n=this,t=n.s,i=n.e;return null===i?t?(r="Infinity",t<0&&(r="-"+r)):r="NaN":(r=null==e?i<=p||O<=i?K(X(n.c),i):Q(X(n.c),i,"0"):10===e?Q(X((n=I(new _(n),v+i+1,N)).c),n.e,"0"):(J(e,2,R.length,"Base"),a(Q(X(n.c),i,"0"),10,e,t,!0)),t<0&&n.c[0]&&(r="-"+r)),r},t.valueOf=t.toJSON=function(){return T(this)},t._isBigNumber=!0,null!=r&&_.set(r),_}()).default=r.BigNumber=r,"function"==typeof define&&define.amd?define(function(){return r}):"undefined"!=typeof module&&module.exports?module.exports=r:(e=e||("undefined"!=typeof self&&self?self:window)).BigNumber=r}(this);/**
 * Bootstrap Search Suggest
 * @desc    这是一个基于 bootstrap 按钮式下拉菜单组件的搜索建议插件，必须使用于按钮式下拉菜单组件上。
 * @author  renxia <lzwy0820#qq.com>
 * @github  https://github.com/lzwme/bootstrap-suggest-plugin.git
 * @since   2014-10-09
 *----------------------------------------------======================
 * (c) Copyright 2014-2019 http://lzw.me All Rights Reserved.
 ********************************************************************************/
(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object' && typeof module === 'object') {
        factory(require('jquery'));
    } else if (window.jQuery) {
        factory(window.jQuery);
    } else {
        throw new Error('Not found jQuery.');
    }
})(function($) {
    var VERSION = 'VERSION_PLACEHOLDER';
    var $window = $(window);
    var isIe = 'ActiveXObject' in window; // 用于对 IE 的兼容判断
    var inputLock; // 用于中文输入法输入时锁定搜索

    // ie 下和 chrome 51 以上浏览器版本，出现滚动条时不计算 padding
    var chromeVer = navigator.userAgent.match(/Chrome\/(\d+)/);
    if (chromeVer) {
        chromeVer = +chromeVer[1];
    }
    var notNeedCalcPadding = isIe || chromeVer > 51;

    // 一些常量
    var BSSUGGEST = 'bsSuggest';
    var onDataRequestSuccess = 'onDataRequestSuccess';
    var DISABLED = 'disabled';
    var TRUE = true;
    var FALSE = false;

    function isUndefined(val) {
        return val === void(0);
    }

    /**
     * 错误处理
     */
    function handleError(e1, e2) {
        if (!window.console || !window.console.trace) {
            return;
        }
        console.trace(e1);
        if (e2) {
            console.trace(e2);
        }
    }
    /**
     * 获取当前 tr 列的关键字数据
     */
    function getPointKeyword($list) {
        return $list.data();
    }
    /**
     * 设置或获取输入框的 alt 值
     */
    function setOrGetAlt($input, val) {
        return isUndefined(val) ? $input.attr('alt') : $input.attr('alt', val);
    }
    /**
     * 设置或获取输入框的 data-id 值
     */
    function setOrGetDataId($input, val) {
        return val !== (void 0) ? $input.attr('data-id', val) : $input.attr('data-id');
    }
    /**
     * 设置选中的值
     */
    function setValue($input, keywords, options) {
        if (!keywords || !keywords.key) {
            return;
        }

        var separator = options.separator || ',',
            inputValList,
            inputIdList,
            dataId = setOrGetDataId($input);

        if (options && options.multiWord) {
            inputValList = $input.val().split(separator);
            inputValList[inputValList.length - 1] = keywords.key;

            //多关键字检索支持设置id --- 存在 bug，不建议使用
            if (!dataId) {
                inputIdList = [keywords.id];
            } else {
                inputIdList = dataId.split(separator);
                inputIdList.push(keywords.id);
            }

            setOrGetDataId($input, inputIdList.join(separator))
                .val(inputValList.join(separator))
                .focus();
        } else {
            setOrGetDataId($input, keywords.id || '').val(keywords.key).focus();
        }

        $input.data('pre-val', $input.val())
            .trigger('onSetSelectValue', [keywords, (options.data.value || options._lastData.value)[keywords.index]]);
    }
    /**
     * 调整选择菜单位置
     * @param {Object} $input
     * @param {Object} $dropdownMenu
     * @param {Object} options
     */
    function adjustDropMenuPos($input, $dropdownMenu, options) {
        if (!$dropdownMenu.is(':visible')) {
            return;
        }

        var $parent = $input.parent();
        var parentHeight = $parent.height();
        var parentWidth = $parent.width();

        if (options.autoDropup) {
            setTimeout(function() {
                var offsetTop = $input.offset().top;
                var winScrollTop = $window.scrollTop();
                var menuHeight = $dropdownMenu.height();

                if ( // 自动判断菜单向上展开
                    ($window.height() + winScrollTop - offsetTop) < menuHeight && // 假如向下会撑长页面
                    offsetTop > (menuHeight + winScrollTop) // 而且向上不会撑到顶部
                ) {
                    $parent.addClass('dropup');
                } else {
                    $parent.removeClass('dropup');
                }
            }, 10);
        }

        // 列表对齐方式
        var dmcss = {};
        if (options.listAlign === 'left') {
            dmcss = {
                'left': $input.siblings('div').width() - parentWidth,
                'right': 'auto'
            };
        } else if (options.listAlign === 'right') {
            dmcss = {
                'left': 'auto',
                'right': 0
            };
        }

        // ie 下，不显示按钮时的 top/bottom
        if (isIe && !options.showBtn) {
            if (!$parent.hasClass('dropup')) {
                dmcss.top = parentHeight;
                dmcss.bottom = 'auto';
            } else {
                dmcss.top = 'auto';
                dmcss.bottom = parentHeight;
            }
        }

        // 是否自动最小宽度
        if (!options.autoMinWidth) {
            dmcss.minWidth = parentWidth;
        }
        /* else {
            dmcss['width'] = 'auto';
        }*/

        $dropdownMenu.css(dmcss);

        return $input;
    }
    /**
     * 设置输入框背景色
     * 当设置了 indexId，而输入框的 data-id 为空时，输入框加载警告色
     */
    function setBackground($input, options) {
        var inputbg, bg, warnbg;
        if ((options.indexId === -1 && !options.idField) || options.multiWord) {
            return $input;
        }

        bg = options.inputBgColor;
        warnbg = options.inputWarnColor;

        var curVal = $input.val();
        var preVal = $input.data('pre-val');

        if (setOrGetDataId($input) || !curVal) {
            $input.css('background', bg || '');

            if (!curVal && preVal) {
                $input.trigger('onUnsetSelectValue').data('pre-val', '');
            }

            return $input;
        }

        inputbg = $input.css('backgroundColor').replace(/ /g, '').split(',', 3).join(',');
        // 自由输入的内容，设置背景色
        if (!~warnbg.indexOf(inputbg)) {
            $input.trigger('onUnsetSelectValue') // 触发取消data-id事件
                .data('pre-val', '')
                .css('background', warnbg);
        }

        return $input;
    }
    /**
     * 调整滑动条
     */
    function adjustScroll($input, $dropdownMenu, options) {
        // 控制滑动条
        var $hover = $input.parent().find('tbody tr.' + options.listHoverCSS),
            pos, maxHeight;

        if ($hover.length) {
            pos = ($hover.index() + 3) * $hover.height();
            maxHeight = +$dropdownMenu.css('maxHeight').replace('px', '');

            if (pos > maxHeight || $dropdownMenu.scrollTop() > maxHeight) {
                pos = pos - maxHeight;
            } else {
                pos = 0;
            }

            $dropdownMenu.scrollTop(pos);
        }
    }
    /**
     * 解除所有列表 hover 样式
     */
    function unHoverAll($dropdownMenu, options) {
        $dropdownMenu.find('tr.' + options.listHoverCSS).removeClass(options.listHoverCSS);
    }
    /**
     * 验证 $input 对象是否符合条件
     *   1. 必须为 bootstrap 下拉式菜单
     *   2. 必须未初始化过
     */
    function checkInput($input, $dropdownMenu, options) {
        if (
            !$dropdownMenu.length || // 过滤非 bootstrap 下拉式菜单对象
            $input.data(BSSUGGEST) // 是否已经初始化的检测
        ) {
            return FALSE;
        }

        $input.data(BSSUGGEST, {
            options: options
        });

        return TRUE;
    }
    /**
     * 数据格式检测
     * 检测 ajax 返回成功数据或 data 参数数据是否有效
     * data 格式：{"value": [{}, {}...]}
     */
    function checkData(data) {
        var isEmpty = TRUE, o;

        for (o in data) {
            if (o === 'value') {
                isEmpty = FALSE;
                break;
            }
        }
        if (isEmpty) {
            handleError('返回数据格式错误!');
            return FALSE;
        }
        if (!data.value.length) {
            // handleError('返回数据为空!');
            return FALSE;
        }

        return data;
    }
    /**
     * 判断字段名是否在 options.effectiveFields 配置项中
     * @param  {String} field   要判断的字段名
     * @param  {Object} options
     * @return {Boolean}        effectiveFields 为空时始终返回 true
     */
    function inEffectiveFields(field, options) {
        var effectiveFields = options.effectiveFields;

        return !(field === '__index' ||
            effectiveFields.length &&
            !~$.inArray(field, effectiveFields));
    }
    /**
     * 判断字段名是否在 options.searchFields 搜索字段配置中
     */
    function inSearchFields(field, options) {
        return ~$.inArray(field, options.searchFields);
    }
    /**
     * 通过下拉菜单显示提示文案
     */
    function showTip(tip, $input, $dropdownMenu, options) {
        $dropdownMenu.html('<div style="padding:10px 5px 5px">' + tip + '</div>').show();
        adjustDropMenuPos($input, $dropdownMenu, options);
    }
    /**
     * 显示下拉列表
     */
    function showDropMenu($input, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)');
        if (!$dropdownMenu.is(':visible')) {
            // $dropdownMenu.css('display', 'block');
            $dropdownMenu.show();
            $input.trigger('onShowDropdown', [options ? options.data.value : []]);
        }
    }
    /**
     * 隐藏下拉列表
     */
    function hideDropMenu($input, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)');
        if ($dropdownMenu.is(':visible')) {
            // $dropdownMenu.css('display', '');
            $dropdownMenu.hide();
            $input.trigger('onHideDropdown', [options ? options.data.value : []]);
        }
    }
    /**
     * 下拉列表刷新
     * 作为 fnGetData 的 callback 函数调用
     */
    function refreshDropMenu($input, data, options) {
        var $dropdownMenu = $input.parent().find('ul:eq(0)'),
            len, i, field, index = 0,
            tds,
            html = ['<table class="table table-condensed table-sm" style="margin:0">'],
            idValue, keyValue; // 作为输入框 data-id 和内容的字段值
        var dataList = data.value;

        if (!data || !(len = dataList.length)) {
            if (options.emptyTip) {
                showTip(options.emptyTip, $input, $dropdownMenu, options);
            } else {
                $dropdownMenu.empty();
                hideDropMenu($input, options);
            }
            return $input;
        }

        // 相同数据，不用继续渲染了
        if (
            options._lastData &&
            JSON.stringify(options._lastData) === JSON.stringify(data) &&
            $dropdownMenu.find('tr').length === len
        ) {
            showDropMenu($input, options);
            return adjustDropMenuPos($input, $dropdownMenu, options);
        }
        options._lastData = data;

        // 生成表头
        if (options.showHeader) {
            html.push('<thead><tr>');
            for (field in dataList[0]) {
                if (!inEffectiveFields(field, options)) {
                    continue;
                }

                html.push('<th>', (options.effectiveFieldsAlias[field] || field),
                    index === 0 ? ('(' + len + ')') : '' , // 表头第一列记录总数
                    '</th>');

                index++;
            }
            html.push('</tr></thead>');
        }
        html.push('<tbody>');

        // console.log(data, len);
        // 按列加数据
        var dataI;
        for (i = 0; i < len; i++) {
            index = 0;
            tds = [];
            dataI = dataList[i];
            idValue = dataI[options.idField];
            keyValue = dataI[options.keyField];

            for (field in dataI) {
                // 标记作为 value 和 作为 id 的值
                if (isUndefined(keyValue) && options.indexKey === index) {
                    keyValue = dataI[field];
                }
                if (isUndefined(idValue) && options.indexId === index) {
                    idValue = dataI[field];
                }

                index++;

                // 列表中只显示有效的字段
                if (inEffectiveFields(field, options)) {
                    tds.push('<td data-name="', field, '">', dataI[field], '</td>');
                }
            }

            html.push('<tr data-index="', (dataI.__index || i),
                '" data-id="', idValue,
                '" data-key="', keyValue, '">',
                tds.join(''), '</tr>');
        }
        html.push('</tbody></table>');

        $dropdownMenu.html(html.join(''));
        showDropMenu($input, options);
        //.show();

        // scrollbar 存在时，延时到动画结束时调整 padding
        setTimeout(function() {
            if (notNeedCalcPadding) {
                return;
            }

            var $table = $dropdownMenu.find('table:eq(0)'),
                pdr = 0,
                mgb = 0;

            if (
                $dropdownMenu.height() < $table.height() &&
                +$dropdownMenu.css('minWidth').replace('px', '') < $dropdownMenu.width()
            ) {
                pdr = 18;
                mgb = 20;
            }

            $dropdownMenu.css('paddingRight', pdr);
            $table.css('marginBottom', mgb);
        }, 301);

        adjustDropMenuPos($input, $dropdownMenu, options);

        return $input;
    }
    /**
     * ajax 获取数据
     * @param  {Object} options
     * @return {Object}         $.Deferred
     */
    function ajax(options, keyword) {
        keyword = keyword || '';

        var preAjax = options._preAjax;

        if (preAjax && preAjax.abort && preAjax.readyState !== 4) {
            // console.log('abort pre ajax');
            preAjax.abort();
        }

        var ajaxParam = {
            type: 'GET',
            dataType: options.jsonp ? 'jsonp' : 'json',
            timeout: 5000,
        };

        // jsonp
        if (options.jsonp) {
            ajaxParam.jsonp = options.jsonp;
        }

        // 自定义 ajax 请求参数生成方法
        var adjustAjaxParam,
            fnAdjustAjaxParam = options.fnAdjustAjaxParam;

        if ($.isFunction(fnAdjustAjaxParam)) {
            adjustAjaxParam = fnAdjustAjaxParam(keyword, options);

            // options.fnAdjustAjaxParam 返回false，则终止 ajax 请求
            if (FALSE === adjustAjaxParam) {
                return;
            }

            $.extend(ajaxParam, adjustAjaxParam);
        }

        // url 调整
        ajaxParam.url = function() {
            if (!keyword || ajaxParam.data) {
                return ajaxParam.url || options.url;
            }

            var type = '?';
            if (/=$/.test(options.url)) {
                type = '';
            } else if (/\?/.test(options.url)) {
                type = '&';
            }

            return options.url + type + encodeURIComponent(keyword);
        }();

        return options._preAjax = $.ajax(ajaxParam).done(function(result) {
            options.data = options.fnProcessData(result);
        }).fail(function(err) {
            if (options.fnAjaxFail) {
                options.fnAjaxFail(err, options);
            }
        });
    }
    /**
     * 检测 keyword 与 value 是否存在互相包含
     * @param  {String}  keyword 用户输入的关键字
     * @param  {String}  key     匹配字段的 key
     * @param  {String}  value   key 字段对应的值
     * @param  {Object}  options
     * @return {Boolean}         包含/不包含
     */
    function isInWord(keyword, key, value, options) {
        value = $.trim(value);

        if (options.ignorecase) {
            keyword = keyword.toLocaleLowerCase();
            value = value.toLocaleLowerCase();
        }

        return value &&
            (inEffectiveFields(key, options) || inSearchFields(key, options)) && // 必须在有效的搜索字段中
            (
                ~value.indexOf(keyword) || // 匹配值包含关键字
                options.twoWayMatch && ~keyword.indexOf(value) // 关键字包含匹配值
            );
    }
    /**
     * 通过 ajax 或 json 参数获取数据
     */
    function getData(keyword, $input, callback, options) {
        var data, validData, filterData = {
                value: []
            },
            i, key, len,
            fnPreprocessKeyword = options.fnPreprocessKeyword;

        keyword = keyword || '';
        // 获取数据前对关键字预处理方法
        if ($.isFunction(fnPreprocessKeyword)) {
            keyword = fnPreprocessKeyword(keyword, options);
        }

        // 给了url参数，则从服务器 ajax 请求
        // console.log(options.url + keyword);
        if (options.url) {
            var timer;
            if (options.searchingTip) {
                timer = setTimeout(function() {
                    showTip(options.searchingTip, $input, $input.parent().find('ul'), options);
                }, 600);
            }

            ajax(options, keyword).done(function(result) {
                callback($input, options.data, options); // 为 refreshDropMenu
                $input.trigger(onDataRequestSuccess, result);
                if (options.getDataMethod === 'firstByUrl') {
                    options.url = null;
                }
            }).always(function() {
                timer && clearTimeout(timer);
            });
        } else {
            // 没有给出 url 参数，则从 data 参数获取
            data = options.data;
            validData = checkData(data);
            // 本地的 data 数据，则在本地过滤
            if (validData) {
                if (keyword) {
                    // 输入不为空时则进行匹配
                    len = data.value.length;
                    for (i = 0; i < len; i++) {
                        for (key in data.value[i]) {
                            if (
                                data.value[i][key] &&
                                isInWord(keyword, key, data.value[i][key] + '', options)
                            ) {
                                filterData.value.push(data.value[i]);
                                filterData.value[filterData.value.length - 1].__index = i;
                                break;
                            }
                        }
                    }
                } else {
                    filterData = data;
                }
            }

            callback($input, filterData, options);
        } // else
    }
    /**
     * 数据处理
     * url 获取数据时，对数据的处理，作为 fnGetData 之后的回调处理
     */
    function processData(data) {
        return checkData(data);
    }
    /**
     * 取得 clearable 清除按钮
     */
    function getIClear($input, options) {
        var $iClear = $input.prev('i.clearable');

        // 是否可清除已输入的内容(添加清除按钮)
        if (options.clearable && !$iClear.length) {
                $iClear = $('<i class="clearable glyphicon glyphicon-remove fa fa-plus"></i>')
                    .prependTo($input.parent());
        }

        return $iClear.css({
            position: 'absolute',
            top: 'calc(50% - 6px)',
            transform: 'rotate(45deg)',
            // right: options.showBtn ? Math.max($input.next('.input-group-btn').width(), 33) + 2 : 12,
            zIndex: 4,
            cursor: 'pointer',
            width: '14px',
            lineHeight: '14px',
            textAlign: 'center',
            fontSize: 12
        }).hide();
    }
    /**
     * 默认的配置选项
     * @type {Object}
     */
    var defaultOptions = {
        url: null,                      // 请求数据的 URL 地址
        jsonp: null,                    // 设置此参数名，将开启jsonp功能，否则使用json数据结构
        data: {
            value: []
        },                              // 提示所用的数据，注意格式
        indexId: 0,                     // 每组数据的第几个数据，作为input输入框的 data-id，设为 -1 且 idField 为空则不设置此值
        indexKey: 0,                    // 每组数据的第几个数据，作为input输入框的内容
        idField: '',                    // 每组数据的哪个字段作为 data-id，优先级高于 indexId 设置（推荐）
        keyField: '',                   // 每组数据的哪个字段作为输入框内容，优先级高于 indexKey 设置（推荐）

        /* 搜索相关 */
        autoSelect: TRUE,               // 键盘向上/下方向键时，是否自动选择值
        allowNoKeyword: TRUE,           // 是否允许无关键字时请求数据
        getDataMethod: 'firstByUrl',    // 获取数据的方式，url：一直从url请求；data：从 options.data 获取；firstByUrl：第一次从Url获取全部数据，之后从options.data获取
        delayUntilKeyup: FALSE,         // 获取数据的方式 为 firstByUrl 时，是否延迟到有输入时才请求数据
        ignorecase: FALSE,              // 前端搜索匹配时，是否忽略大小写
        effectiveFields: [],            // 有效显示于列表中的字段，非有效字段都会过滤，默认全部有效。
        effectiveFieldsAlias: {},       // 有效字段的别名对象，用于 header 的显示
        searchFields: [],               // 有效搜索字段，从前端搜索过滤数据时使用，但不一定显示在列表中。effectiveFields 配置字段也会用于搜索过滤
        twoWayMatch: TRUE,              // 是否双向匹配搜索。为 true 即输入关键字包含或包含于匹配字段均认为匹配成功，为 false 则输入关键字包含于匹配字段认为匹配成功
        multiWord: FALSE,               // 以分隔符号分割的多关键字支持
        separator: ',',                 // 多关键字支持时的分隔符，默认为半角逗号
        delay: 300,                     // 搜索触发的延时时间间隔，单位毫秒
        emptyTip: '',                   // 查询为空时显示的内容，可为 html
        searchingTip: '搜索中...',       // ajax 搜索时显示的提示内容，当搜索时间较长时给出正在搜索的提示
        hideOnSelect: FALSE,            // 鼠标从列表单击选择了值时，是否隐藏选择列表

        /* UI */
        autoDropup: FALSE,              // 选择菜单是否自动判断向上展开。设为 true，则当下拉菜单高度超过窗体，且向上方向不会被窗体覆盖，则选择菜单向上弹出
        autoMinWidth: FALSE,            // 是否自动最小宽度，设为 false 则最小宽度不小于输入框宽度
        showHeader: FALSE,              // 是否显示选择列表的 header。为 true 时，有效字段大于一列则显示表头
        showBtn: TRUE,                  // 是否显示下拉按钮
        inputBgColor: '',               // 输入框背景色，当与容器背景色不同时，可能需要该项的配置
        inputWarnColor: 'rgba(255,0,0,.1)', // 输入框内容不是下拉列表选择时的警告色
        listStyle: {
            'padding-top': 0,
            'max-height': '375px',
            'max-width': '800px',
            'overflow': 'auto',
            'width': 'auto',
            'transition': '0.3s',
            '-webkit-transition': '0.3s',
            '-moz-transition': '0.3s',
            '-o-transition': '0.3s',
            'word-break': 'keep-all',
            'white-space': 'nowrap'
        },                              // 列表的样式控制
        listAlign: 'left',              // 提示列表对齐位置，left/right/auto
        listHoverStyle: 'background: #07d; color:#fff', // 提示框列表鼠标悬浮的样式
        listHoverCSS: 'jhover',         // 提示框列表鼠标悬浮的样式名称
        clearable: FALSE,               // 是否可清除已输入的内容

        /* key */
        keyLeft: 37,                    // 向左方向键，不同的操作系统可能会有差别，则自行定义
        keyUp: 38,                      // 向上方向键
        keyRight: 39,                   // 向右方向键
        keyDown: 40,                    // 向下方向键
        keyEnter: 13,                   // 回车键

        /* methods */
        fnProcessData: processData,     // 格式化数据的方法，返回数据格式参考 data 参数
        fnGetData: getData,             // 获取数据的方法，无特殊需求一般不作设置
        fnAdjustAjaxParam: null,        // 调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        fnPreprocessKeyword: null,      // 搜索过滤数据前，对输入关键字作进一步处理方法。注意，应返回字符串
        fnAjaxFail: null,               // ajax 失败时回调方法
    };

    var methods = {
        init: function(options) {
            // 参数设置
            var self = this;
            options = options || {};

            // 默认配置有效显示字段多于一个，则显示列表表头，否则不显示
            if (isUndefined(options.showHeader) && options.effectiveFields && options.effectiveFields.length > 1) {
                options.showHeader = TRUE;
            }

            options = $.extend(TRUE, {}, defaultOptions, options);

            // 旧的方法兼容
            if (options.processData) {
                options.fnProcessData = options.processData;
            }

            if (options.getData) {
                options.fnGetData = options.getData;
            }

            if (options.getDataMethod === 'firstByUrl' && options.url && !options.delayUntilKeyup) {
                ajax(options).done(function(result) {
                    options.url = null;
                    self.trigger(onDataRequestSuccess, result);
                });
            }

            // 鼠标滑动到条目样式
            if (!$('#' + BSSUGGEST).length) {
                $('head:eq(0)').append('<style id="' + BSSUGGEST + '">.' + options.listHoverCSS + '{' + options.listHoverStyle + '}</style>');
            }

            return self.each(function() {
                var $input = $(this),
                    $parent = $input.parent(),
                    $iClear = getIClear($input, options),
                    isMouseenterMenu,
                    keyupTimer, // keyup 与 input 事件延时定时器
                    $dropdownMenu = $parent.find('ul:eq(0)');

                // 兼容 bs4
                $dropdownMenu.parent().css('position', 'relative');

                // 验证输入框对象是否符合条件
                if (!checkInput($input, $dropdownMenu, options)) {
                    console.warn('不是一个标准的 bootstrap 下拉式菜单或已初始化:', $input);
                    return;
                }

                // 是否显示 button 按钮
                if (!options.showBtn) {
                    $input.css('borderRadius', 4);
                    $parent.css('width', '100%')
                        .find('.btn:eq(0)').hide();
                }

                // 移除 disabled 类，并禁用自动完成
                $input.removeClass(DISABLED).prop(DISABLED, FALSE).attr('autocomplete', 'off');
                // dropdown-menu 增加修饰
                $dropdownMenu.css(options.listStyle);

                // 默认背景色
                if (!options.inputBgColor) {
                    options.inputBgColor = $input.css('backgroundColor');
                }

                // 开始事件处理
                $input.on('keydown', function(event) {
                    var currentList, tipsKeyword; // 提示列表上被选中的关键字

                    // 当提示层显示时才对键盘事件处理
                    if (!$dropdownMenu.is(':visible')) {
                        setOrGetDataId($input, '');
                        return;
                    }

                    currentList = $dropdownMenu.find('.' + options.listHoverCSS);
                    tipsKeyword = ''; // 提示列表上被选中的关键字

                    unHoverAll($dropdownMenu, options);

                    if (event.keyCode === options.keyDown) { // 如果按的是向下方向键
                        if (!currentList.length) {
                            // 如果提示列表没有一个被选中,则将列表第一个选中
                            tipsKeyword = getPointKeyword($dropdownMenu.find('tbody tr:first').mouseover());
                        } else if (!currentList.next().length) {
                            // 如果是最后一个被选中,则取消选中,即可认为是输入框被选中，并恢复输入的值
                            if (options.autoSelect) {
                                setOrGetDataId($input, '').val(setOrGetAlt($input));
                            }
                        } else {
                            // 选中下一行
                            tipsKeyword = getPointKeyword(currentList.next().mouseover());
                        }
                        // 控制滑动条
                        adjustScroll($input, $dropdownMenu, options);

                        if (!options.autoSelect) {
                            return;
                        }
                    } else if (event.keyCode === options.keyUp) { // 如果按的是向上方向键
                        if (!currentList.length) {
                            tipsKeyword = getPointKeyword($dropdownMenu.find('tbody tr:last').mouseover());
                        } else if (!currentList.prev().length) {
                            if (options.autoSelect) {
                                setOrGetDataId($input, '').val(setOrGetAlt($input));
                            }
                        } else {
                            // 选中前一行
                            tipsKeyword = getPointKeyword(currentList.prev().mouseover());
                        }

                        // 控制滑动条
                        adjustScroll($input, $dropdownMenu, options);

                        if (!options.autoSelect) {
                            return;
                        }
                    } else if (event.keyCode === options.keyEnter) {
                        tipsKeyword = getPointKeyword(currentList);
                        hideDropMenu($input, options);
                    } else {
                        setOrGetDataId($input, '');
                    }

                    // 设置值 tipsKeyword
                    // console.log(tipsKeyword);
                    setValue($input, tipsKeyword, options);
                }).on('compositionstart', function(event) {
                    // 中文输入开始，锁定
                    // console.log('compositionstart');
                    inputLock = TRUE;
                }).on('compositionend', function(event) {
                    // 中文输入结束，解除锁定
                    // console.log('compositionend');
                    inputLock = FALSE;
                }).on('keyup input paste', function(event) {
                    var word;

                    if (event.keyCode) {
                        setBackground($input, options);
                    }

                    // 如果弹起的键是回车、向上或向下方向键则返回
                    if (~$.inArray(event.keyCode, [options.keyDown, options.keyUp, options.keyEnter])) {
                        $input.val($input.val()); // 让鼠标输入跳到最后
                        return;
                    }

                    clearTimeout(keyupTimer);
                    keyupTimer = setTimeout(function() {
                        // console.log('input keyup', event);

                        // 锁定状态，返回
                        if (inputLock) {
                            return;
                        }

                        word = $input.val();

                        // 若输入框值没有改变则返回
                        if ($.trim(word) && word === setOrGetAlt($input)) {
                            return;
                        }

                        // 当按下键之前记录输入框值,以方便查看键弹起时值有没有变
                        setOrGetAlt($input, word);

                        if (options.multiWord) {
                            word = word.split(options.separator).reverse()[0];
                        }

                        // 是否允许空数据查询
                        if (!word.length && !options.allowNoKeyword) {
                            return;
                        }

                        options.fnGetData($.trim(word), $input, refreshDropMenu, options);
                    }, options.delay || 300);
                }).on('focus', function() {
                    // console.log('input focus');
                    adjustDropMenuPos($input, $dropdownMenu, options);
                }).on('blur', function() {
                    if (!isMouseenterMenu) { // 不是进入下拉列表状态，则隐藏列表
                        hideDropMenu($input, options);
                    }
                }).on('click', function() {
                    // console.log('input click');
                    var word = $input.val();

                    if (
                        $.trim(word) &&
                        word === setOrGetAlt($input) &&
                        $dropdownMenu.find('table tr').length
                    ) {
                        return showDropMenu($input, options);
                    }

                    if ($dropdownMenu.is(':visible')) {
                        return;
                    }

                    if (options.multiWord) {
                        word = word.split(options.separator).reverse()[0];
                    }

                    // 是否允许空数据查询
                    if (!word.length && !options.allowNoKeyword) {
                        return;
                    }

                    // console.log('word', word);
                    options.fnGetData($.trim(word), $input, refreshDropMenu, options);
                });

                // 下拉按钮点击时
                $parent.find('.btn:eq(0)').attr('data-toggle', '').click(function() {
                    if (!$dropdownMenu.is(':visible')) {
                        if (options.url) {
                            $input.click().focus();
                            if (!$dropdownMenu.find('tr').length) {
                                return FALSE;
                            }
                        } else {
                            // 不以 keyword 作为过滤，展示所有的数据
                            refreshDropMenu($input, options.data, options);
                        }
                        showDropMenu($input, options);
                    } else {
                        hideDropMenu($input, options);
                    }

                    return FALSE;
                });

                // 列表中滑动时，输入框失去焦点
                $dropdownMenu.mouseenter(function() {
                        // console.log('mouseenter')
                        isMouseenterMenu = 1;
                        $input.blur();
                    }).mouseleave(function() {
                        // console.log('mouseleave')
                        isMouseenterMenu = 0;
                        $input.focus();
                    }).on('mouseenter', 'tbody tr', function() {
                        // 行上的移动事件
                        unHoverAll($dropdownMenu, options);
                        $(this).addClass(options.listHoverCSS);

                        return FALSE; // 阻止冒泡
                    })
                    .on('mousedown', 'tbody tr', function() {
                        var keywords = getPointKeyword($(this));
                        setValue($input, keywords, options);
                        setOrGetAlt($input, keywords.key);
                        setBackground($input, options);

                        if (options.hideOnSelect) {
                            hideDropMenu($input, options);
                        }
                    });

                // 存在清空按钮
                if ($iClear.length) {
                    $iClear.click(function () {
                        setOrGetDataId($input, '').val('');
                        setBackground($input, options);
                    });

                    $parent.mouseenter(function() {
                        if (!$input.prop(DISABLED)) {
                            $iClear.css('right', options.showBtn ? Math.max($input.next().width(), 33) + 2 : 12)
                                .show();
                        }
                    }).mouseleave(function() {
                        $iClear.hide();
                    });
                }

            });
        },
        show: function() {
            return this.each(function() {
                $(this).click();
            });
        },
        hide: function() {
            return this.each(function() {
                hideDropMenu($(this));
            });
        },
        disable: function() {
            return this.each(function() {
                $(this).attr(DISABLED, TRUE)
                    .parent().find('.btn:eq(0)').prop(DISABLED, TRUE);
            });
        },
        enable: function() {
            return this.each(function() {
                $(this).attr(DISABLED, FALSE)
                    .parent().find('.btn:eq(0)').prop(DISABLED, FALSE);
            });
        },
        destroy: function() {
            return this.each(function() {
                $(this).off().removeData(BSSUGGEST).removeAttr('style')
                    .parent().find('.btn:eq(0)').off().show().attr('data-toggle', 'dropdown').prop(DISABLED, FALSE) // .addClass(DISABLED);
                    .next().css('display', '').off();
            });
        },
        version: function() {
            return VERSION;
        }
    };

    $.fn[BSSUGGEST] = function(options) {
        // 方法判断
        if (typeof options === 'string' && methods[options]) {
            var inited = TRUE;
            this.each(function() {
                if (!$(this).data(BSSUGGEST)) {
                    return inited = FALSE;
                }
            });
            // 只要有一个未初始化，则全部都不执行方法，除非是 init 或 version
            if (!inited && 'init' !== options && 'version' !== options) {
                return this;
            }

            // 如果是方法，则参数第一个为函数名，从第二个开始为函数参数
            return methods[options].apply(this, [].slice.call(arguments, 1));
        } else {
            // 调用初始化方法
            return methods.init.apply(this, arguments);
        }
    }
});
(function(global,factory){typeof exports==='object'&&typeof module!=='undefined'?module.exports=factory():typeof define==='function'&&define.amd?define(factory):global.moment=factory()}(this,function(){'use strict';var hookCallback;function utils_hooks__hooks(){return hookCallback.apply(null,arguments);}
function setHookCallback(callback){hookCallback=callback;}
function isArray(input){return Object.prototype.toString.call(input)==='[object Array]';}
function isDate(input){return input instanceof Date||Object.prototype.toString.call(input)==='[object Date]';}
function map(arr,fn){var res=[],i;for(i=0;i<arr.length;++i){res.push(fn(arr[i],i));}
return res;}
function hasOwnProp(a,b){return Object.prototype.hasOwnProperty.call(a,b);}
function extend(a,b){for(var i in b){if(hasOwnProp(b,i)){a[i]=b[i];}}
if(hasOwnProp(b,'toString')){a.toString=b.toString;}
if(hasOwnProp(b,'valueOf')){a.valueOf=b.valueOf;}
return a;}
function create_utc__createUTC(input,format,locale,strict){return createLocalOrUTC(input,format,locale,strict,true).utc();}
function defaultParsingFlags(){return{empty:false,unusedTokens:[],unusedInput:[],overflow:-2,charsLeftOver:0,nullInput:false,invalidMonth:null,invalidFormat:false,userInvalidated:false,iso:false};}
function getParsingFlags(m){if(m._pf==null){m._pf=defaultParsingFlags();}
return m._pf;}
function valid__isValid(m){if(m._isValid==null){var flags=getParsingFlags(m);m._isValid=!isNaN(m._d.getTime())&&flags.overflow<0&&!flags.empty&&!flags.invalidMonth&&!flags.invalidWeekday&&!flags.nullInput&&!flags.invalidFormat&&!flags.userInvalidated;if(m._strict){m._isValid=m._isValid&&flags.charsLeftOver===0&&flags.unusedTokens.length===0&&flags.bigHour===undefined;}}
return m._isValid;}
function valid__createInvalid(flags){var m=create_utc__createUTC(NaN);if(flags!=null){extend(getParsingFlags(m),flags);}
else{getParsingFlags(m).userInvalidated=true;}
return m;}
var momentProperties=utils_hooks__hooks.momentProperties=[];function copyConfig(to,from){var i,prop,val;if(typeof from._isAMomentObject!=='undefined'){to._isAMomentObject=from._isAMomentObject;}
if(typeof from._i!=='undefined'){to._i=from._i;}
if(typeof from._f!=='undefined'){to._f=from._f;}
if(typeof from._l!=='undefined'){to._l=from._l;}
if(typeof from._strict!=='undefined'){to._strict=from._strict;}
if(typeof from._tzm!=='undefined'){to._tzm=from._tzm;}
if(typeof from._isUTC!=='undefined'){to._isUTC=from._isUTC;}
if(typeof from._offset!=='undefined'){to._offset=from._offset;}
if(typeof from._pf!=='undefined'){to._pf=getParsingFlags(from);}
if(typeof from._locale!=='undefined'){to._locale=from._locale;}
if(momentProperties.length>0){for(i in momentProperties){prop=momentProperties[i];val=from[prop];if(typeof val!=='undefined'){to[prop]=val;}}}
return to;}
var updateInProgress=false;function Moment(config){copyConfig(this,config);this._d=new Date(config._d!=null?config._d.getTime():NaN);if(updateInProgress===false){updateInProgress=true;utils_hooks__hooks.updateOffset(this);updateInProgress=false;}}
function isMoment(obj){return obj instanceof Moment||(obj!=null&&obj._isAMomentObject!=null);}
function absFloor(number){if(number<0){return Math.ceil(number);}else{return Math.floor(number);}}
function toInt(argumentForCoercion){var coercedNumber=+argumentForCoercion,value=0;if(coercedNumber!==0&&isFinite(coercedNumber)){value=absFloor(coercedNumber);}
return value;}
function compareArrays(array1,array2,dontConvert){var len=Math.min(array1.length,array2.length),lengthDiff=Math.abs(array1.length-array2.length),diffs=0,i;for(i=0;i<len;i++){if((dontConvert&&array1[i]!==array2[i])||(!dontConvert&&toInt(array1[i])!==toInt(array2[i]))){diffs++;}}
return diffs+lengthDiff;}
function Locale(){}
var locales={};var globalLocale;function normalizeLocale(key){return key?key.toLowerCase().replace('_','-'):key;}
function chooseLocale(names){var i=0,j,next,locale,split;while(i<names.length){split=normalizeLocale(names[i]).split('-');j=split.length;next=normalizeLocale(names[i+1]);next=next?next.split('-'):null;while(j>0){locale=loadLocale(split.slice(0,j).join('-'));if(locale){return locale;}
if(next&&next.length>=j&&compareArrays(split,next,true)>=j-1){break;}
j--;}
i++;}
return null;}
function loadLocale(name){var oldLocale=null;if(!locales[name]&&typeof module!=='undefined'&&module&&module.exports){try{oldLocale=globalLocale._abbr;require('./locale/'+name);locale_locales__getSetGlobalLocale(oldLocale);}catch(e){}}
return locales[name];}
function locale_locales__getSetGlobalLocale(key,values){var data;if(key){if(typeof values==='undefined'){data=locale_locales__getLocale(key);}
else{data=defineLocale(key,values);}
if(data){globalLocale=data;}}
return globalLocale._abbr;}
function defineLocale(name,values){if(values!==null){values.abbr=name;locales[name]=locales[name]||new Locale();locales[name].set(values);locale_locales__getSetGlobalLocale(name);return locales[name];}else{delete locales[name];return null;}}
function locale_locales__getLocale(key){var locale;if(key&&key._locale&&key._locale._abbr){key=key._locale._abbr;}
if(!key){return globalLocale;}
if(!isArray(key)){locale=loadLocale(key);if(locale){return locale;}
key=[key];}
return chooseLocale(key);}
var aliases={};function addUnitAlias(unit,shorthand){var lowerCase=unit.toLowerCase();aliases[lowerCase]=aliases[lowerCase+'s']=aliases[shorthand]=unit;}
function normalizeUnits(units){return typeof units==='string'?aliases[units]||aliases[units.toLowerCase()]:undefined;}
function normalizeObjectUnits(inputObject){var normalizedInput={},normalizedProp,prop;for(prop in inputObject){if(hasOwnProp(inputObject,prop)){normalizedProp=normalizeUnits(prop);if(normalizedProp){normalizedInput[normalizedProp]=inputObject[prop];}}}
return normalizedInput;}
function makeGetSet(unit,keepTime){return function(value){if(value!=null){get_set__set(this,unit,value);utils_hooks__hooks.updateOffset(this,keepTime);return this;}else{return get_set__get(this,unit);}};}
function get_set__get(mom,unit){return mom._d['get'+(mom._isUTC?'UTC':'')+unit]();}
function get_set__set(mom,unit,value){return mom._d['set'+(mom._isUTC?'UTC':'')+unit](value);}
function getSet(units,value){var unit;if(typeof units==='object'){for(unit in units){this.set(unit,units[unit]);}}else{units=normalizeUnits(units);if(typeof this[units]==='function'){return this[units](value);}}
return this;}
function zeroFill(number,targetLength,forceSign){var absNumber=''+Math.abs(number),zerosToFill=targetLength-absNumber.length,sign=number>=0;return(sign?(forceSign?'+':''):'-')+
Math.pow(10,Math.max(0,zerosToFill)).toString().substr(1)+absNumber;}
var formattingTokens=/(\[[^\[]*\])|(\\)?(Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Q|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g;var localFormattingTokens=/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g;var formatFunctions={};var formatTokenFunctions={};function addFormatToken(token,padded,ordinal,callback){var func=callback;if(typeof callback==='string'){func=function(){return this[callback]();};}
if(token){formatTokenFunctions[token]=func;}
if(padded){formatTokenFunctions[padded[0]]=function(){return zeroFill(func.apply(this,arguments),padded[1],padded[2]);};}
if(ordinal){formatTokenFunctions[ordinal]=function(){return this.localeData().ordinal(func.apply(this,arguments),token);};}}
function removeFormattingTokens(input){if(input.match(/\[[\s\S]/)){return input.replace(/^\[|\]$/g,'');}
return input.replace(/\\/g,'');}
function makeFormatFunction(format){var array=format.match(formattingTokens),i,length;for(i=0,length=array.length;i<length;i++){if(formatTokenFunctions[array[i]]){array[i]=formatTokenFunctions[array[i]];}else{array[i]=removeFormattingTokens(array[i]);}}
return function(mom){var output='';for(i=0;i<length;i++){output+=array[i]instanceof Function?array[i].call(mom,format):array[i];}
return output;};}
function formatMoment(m,format){if(!m.isValid()){return m.localeData().invalidDate();}
format=expandFormat(format,m.localeData());formatFunctions[format]=formatFunctions[format]||makeFormatFunction(format);return formatFunctions[format](m);}
function expandFormat(format,locale){var i=5;function replaceLongDateFormatTokens(input){return locale.longDateFormat(input)||input;}
localFormattingTokens.lastIndex=0;while(i>=0&&localFormattingTokens.test(format)){format=format.replace(localFormattingTokens,replaceLongDateFormatTokens);localFormattingTokens.lastIndex=0;i-=1;}
return format;}
var match1=/\d/;var match2=/\d\d/;var match3=/\d{3}/;var match4=/\d{4}/;var match6=/[+-]?\d{6}/;var match1to2=/\d\d?/;var match1to3=/\d{1,3}/;var match1to4=/\d{1,4}/;var match1to6=/[+-]?\d{1,6}/;var matchUnsigned=/\d+/;var matchSigned=/[+-]?\d+/;var matchOffset=/Z|[+-]\d\d:?\d\d/gi;var matchTimestamp=/[+-]?\d+(\.\d{1,3})?/;var matchWord=/[0-9]*['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+|[\u0600-\u06FF\/]+(\s*?[\u0600-\u06FF]+){1,2}/i;var regexes={};function isFunction(sth){return typeof sth==='function'&&Object.prototype.toString.call(sth)==='[object Function]';}
function addRegexToken(token,regex,strictRegex){regexes[token]=isFunction(regex)?regex:function(isStrict){return(isStrict&&strictRegex)?strictRegex:regex;};}
function getParseRegexForToken(token,config){if(!hasOwnProp(regexes,token)){return new RegExp(unescapeFormat(token));}
return regexes[token](config._strict,config._locale);}
function unescapeFormat(s){return s.replace('\\','').replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(matched,p1,p2,p3,p4){return p1||p2||p3||p4;}).replace(/[-\/\\^$*+?.()|[\]{}]/g,'\\$&');}
var tokens={};function addParseToken(token,callback){var i,func=callback;if(typeof token==='string'){token=[token];}
if(typeof callback==='number'){func=function(input,array){array[callback]=toInt(input);};}
for(i=0;i<token.length;i++){tokens[token[i]]=func;}}
function addWeekParseToken(token,callback){addParseToken(token,function(input,array,config,token){config._w=config._w||{};callback(input,config._w,config,token);});}
function addTimeToArrayFromToken(token,input,config){if(input!=null&&hasOwnProp(tokens,token)){tokens[token](input,config._a,config,token);}}
var YEAR=0;var MONTH=1;var DATE=2;var HOUR=3;var MINUTE=4;var SECOND=5;var MILLISECOND=6;function daysInMonth(year,month){return new Date(Date.UTC(year,month+1,0)).getUTCDate();}
addFormatToken('M',['MM',2],'Mo',function(){return this.month()+1;});addFormatToken('MMM',0,0,function(format){return this.localeData().monthsShort(this,format);});addFormatToken('MMMM',0,0,function(format){return this.localeData().months(this,format);});addUnitAlias('month','M');addRegexToken('M',match1to2);addRegexToken('MM',match1to2,match2);addRegexToken('MMM',matchWord);addRegexToken('MMMM',matchWord);addParseToken(['M','MM'],function(input,array){array[MONTH]=toInt(input)-1;});addParseToken(['MMM','MMMM'],function(input,array,config,token){var month=config._locale.monthsParse(input,token,config._strict);if(month!=null){array[MONTH]=month;}else{getParsingFlags(config).invalidMonth=input;}});var defaultLocaleMonths='January_February_March_April_May_June_July_August_September_October_November_December'.split('_');function localeMonths(m){return this._months[m.month()];}
var defaultLocaleMonthsShort='Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec'.split('_');function localeMonthsShort(m){return this._monthsShort[m.month()];}
function localeMonthsParse(monthName,format,strict){var i,mom,regex;if(!this._monthsParse){this._monthsParse=[];this._longMonthsParse=[];this._shortMonthsParse=[];}
for(i=0;i<12;i++){mom=create_utc__createUTC([2000,i]);if(strict&&!this._longMonthsParse[i]){this._longMonthsParse[i]=new RegExp('^'+this.months(mom,'').replace('.','')+'$','i');this._shortMonthsParse[i]=new RegExp('^'+this.monthsShort(mom,'').replace('.','')+'$','i');}
if(!strict&&!this._monthsParse[i]){regex='^'+this.months(mom,'')+'|^'+this.monthsShort(mom,'');this._monthsParse[i]=new RegExp(regex.replace('.',''),'i');}
if(strict&&format==='MMMM'&&this._longMonthsParse[i].test(monthName)){return i;}else if(strict&&format==='MMM'&&this._shortMonthsParse[i].test(monthName)){return i;}else if(!strict&&this._monthsParse[i].test(monthName)){return i;}}}
function setMonth(mom,value){var dayOfMonth;if(typeof value==='string'){value=mom.localeData().monthsParse(value);if(typeof value!=='number'){return mom;}}
dayOfMonth=Math.min(mom.date(),daysInMonth(mom.year(),value));mom._d['set'+(mom._isUTC?'UTC':'')+'Month'](value,dayOfMonth);return mom;}
function getSetMonth(value){if(value!=null){setMonth(this,value);utils_hooks__hooks.updateOffset(this,true);return this;}else{return get_set__get(this,'Month');}}
function getDaysInMonth(){return daysInMonth(this.year(),this.month());}
function checkOverflow(m){var overflow;var a=m._a;if(a&&getParsingFlags(m).overflow===-2){overflow=a[MONTH]<0||a[MONTH]>11?MONTH:a[DATE]<1||a[DATE]>daysInMonth(a[YEAR],a[MONTH])?DATE:a[HOUR]<0||a[HOUR]>24||(a[HOUR]===24&&(a[MINUTE]!==0||a[SECOND]!==0||a[MILLISECOND]!==0))?HOUR:a[MINUTE]<0||a[MINUTE]>59?MINUTE:a[SECOND]<0||a[SECOND]>59?SECOND:a[MILLISECOND]<0||a[MILLISECOND]>999?MILLISECOND:-1;if(getParsingFlags(m)._overflowDayOfYear&&(overflow<YEAR||overflow>DATE)){overflow=DATE;}
getParsingFlags(m).overflow=overflow;}
return m;}
function warn(msg){if(utils_hooks__hooks.suppressDeprecationWarnings===false&&typeof console!=='undefined'&&console.warn){console.warn('Deprecation warning: '+msg);}}
function deprecate(msg,fn){var firstTime=true;return extend(function(){if(firstTime){warn(msg+'\n'+(new Error()).stack);firstTime=false;}
return fn.apply(this,arguments);},fn);}
var deprecations={};function deprecateSimple(name,msg){if(!deprecations[name]){warn(msg);deprecations[name]=true;}}
utils_hooks__hooks.suppressDeprecationWarnings=false;var from_string__isoRegex=/^\s*(?:[+-]\d{6}|\d{4})-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/;var isoDates=[['YYYYYY-MM-DD',/[+-]\d{6}-\d{2}-\d{2}/],['YYYY-MM-DD',/\d{4}-\d{2}-\d{2}/],['GGGG-[W]WW-E',/\d{4}-W\d{2}-\d/],['GGGG-[W]WW',/\d{4}-W\d{2}/],['YYYY-DDD',/\d{4}-\d{3}/]];var isoTimes=[['HH:mm:ss.SSSS',/(T| )\d\d:\d\d:\d\d\.\d+/],['HH:mm:ss',/(T| )\d\d:\d\d:\d\d/],['HH:mm',/(T| )\d\d:\d\d/],['HH',/(T| )\d\d/]];var aspNetJsonRegex=/^\/?Date\((\-?\d+)/i;function configFromISO(config){var i,l,string=config._i,match=from_string__isoRegex.exec(string);if(match){getParsingFlags(config).iso=true;for(i=0,l=isoDates.length;i<l;i++){if(isoDates[i][1].exec(string)){config._f=isoDates[i][0];break;}}
for(i=0,l=isoTimes.length;i<l;i++){if(isoTimes[i][1].exec(string)){config._f+=(match[6]||' ')+isoTimes[i][0];break;}}
if(string.match(matchOffset)){config._f+='Z';}
configFromStringAndFormat(config);}else{config._isValid=false;}}
function configFromString(config){var matched=aspNetJsonRegex.exec(config._i);if(matched!==null){config._d=new Date(+matched[1]);return;}
configFromISO(config);if(config._isValid===false){delete config._isValid;utils_hooks__hooks.createFromInputFallback(config);}}
utils_hooks__hooks.createFromInputFallback=deprecate('moment construction falls back to js Date. This is '+
'discouraged and will be removed in upcoming major '+
'release. Please refer to '+
'https://github.com/moment/moment/issues/1407 for more info.',function(config){config._d=new Date(config._i+(config._useUTC?' UTC':''));});function createDate(y,m,d,h,M,s,ms){var date=new Date(y,m,d,h,M,s,ms);if(y<1970){date.setFullYear(y);}
return date;}
function createUTCDate(y){var date=new Date(Date.UTC.apply(null,arguments));if(y<1970){date.setUTCFullYear(y);}
return date;}
addFormatToken(0,['YY',2],0,function(){return this.year()%100;});addFormatToken(0,['YYYY',4],0,'year');addFormatToken(0,['YYYYY',5],0,'year');addFormatToken(0,['YYYYYY',6,true],0,'year');addUnitAlias('year','y');addRegexToken('Y',matchSigned);addRegexToken('YY',match1to2,match2);addRegexToken('YYYY',match1to4,match4);addRegexToken('YYYYY',match1to6,match6);addRegexToken('YYYYYY',match1to6,match6);addParseToken(['YYYYY','YYYYYY'],YEAR);addParseToken('YYYY',function(input,array){array[YEAR]=input.length===2?utils_hooks__hooks.parseTwoDigitYear(input):toInt(input);});addParseToken('YY',function(input,array){array[YEAR]=utils_hooks__hooks.parseTwoDigitYear(input);});function daysInYear(year){return isLeapYear(year)?366:365;}
function isLeapYear(year){return(year%4===0&&year%100!==0)||year%400===0;}
utils_hooks__hooks.parseTwoDigitYear=function(input){return toInt(input)+(toInt(input)>68?1900:2000);};var getSetYear=makeGetSet('FullYear',false);function getIsLeapYear(){return isLeapYear(this.year());}
addFormatToken('w',['ww',2],'wo','week');addFormatToken('W',['WW',2],'Wo','isoWeek');addUnitAlias('week','w');addUnitAlias('isoWeek','W');addRegexToken('w',match1to2);addRegexToken('ww',match1to2,match2);addRegexToken('W',match1to2);addRegexToken('WW',match1to2,match2);addWeekParseToken(['w','ww','W','WW'],function(input,week,config,token){week[token.substr(0,1)]=toInt(input);});function weekOfYear(mom,firstDayOfWeek,firstDayOfWeekOfYear){var end=firstDayOfWeekOfYear-firstDayOfWeek,daysToDayOfWeek=firstDayOfWeekOfYear-mom.day(),adjustedMoment;if(daysToDayOfWeek>end){daysToDayOfWeek-=7;}
if(daysToDayOfWeek<end-7){daysToDayOfWeek+=7;}
adjustedMoment=local__createLocal(mom).add(daysToDayOfWeek,'d');return{week:Math.ceil(adjustedMoment.dayOfYear()/7),year:adjustedMoment.year()};}
function localeWeek(mom){return weekOfYear(mom,this._week.dow,this._week.doy).week;}
var defaultLocaleWeek={dow:0,doy:6};function localeFirstDayOfWeek(){return this._week.dow;}
function localeFirstDayOfYear(){return this._week.doy;}
function getSetWeek(input){var week=this.localeData().week(this);return input==null?week:this.add((input-week)*7,'d');}
function getSetISOWeek(input){var week=weekOfYear(this,1,4).week;return input==null?week:this.add((input-week)*7,'d');}
addFormatToken('DDD',['DDDD',3],'DDDo','dayOfYear');addUnitAlias('dayOfYear','DDD');addRegexToken('DDD',match1to3);addRegexToken('DDDD',match3);addParseToken(['DDD','DDDD'],function(input,array,config){config._dayOfYear=toInt(input);});function dayOfYearFromWeeks(year,week,weekday,firstDayOfWeekOfYear,firstDayOfWeek){var week1Jan=6+firstDayOfWeek-firstDayOfWeekOfYear,janX=createUTCDate(year,0,1+week1Jan),d=janX.getUTCDay(),dayOfYear;if(d<firstDayOfWeek){d+=7;}
weekday=weekday!=null?1*weekday:firstDayOfWeek;dayOfYear=1+week1Jan+7*(week-1)-d+weekday;return{year:dayOfYear>0?year:year-1,dayOfYear:dayOfYear>0?dayOfYear:daysInYear(year-1)+dayOfYear};}
function getSetDayOfYear(input){var dayOfYear=Math.round((this.clone().startOf('day')-this.clone().startOf('year'))/864e5)+1;return input==null?dayOfYear:this.add((input-dayOfYear),'d');}
function defaults(a,b,c){if(a!=null){return a;}
if(b!=null){return b;}
return c;}
function currentDateArray(config){var now=new Date();if(config._useUTC){return[now.getUTCFullYear(),now.getUTCMonth(),now.getUTCDate()];}
return[now.getFullYear(),now.getMonth(),now.getDate()];}
function configFromArray(config){var i,date,input=[],currentDate,yearToUse;if(config._d){return;}
currentDate=currentDateArray(config);if(config._w&&config._a[DATE]==null&&config._a[MONTH]==null){dayOfYearFromWeekInfo(config);}
if(config._dayOfYear){yearToUse=defaults(config._a[YEAR],currentDate[YEAR]);if(config._dayOfYear>daysInYear(yearToUse)){getParsingFlags(config)._overflowDayOfYear=true;}
date=createUTCDate(yearToUse,0,config._dayOfYear);config._a[MONTH]=date.getUTCMonth();config._a[DATE]=date.getUTCDate();}
for(i=0;i<3&&config._a[i]==null;++i){config._a[i]=input[i]=currentDate[i];}
for(;i<7;i++){config._a[i]=input[i]=(config._a[i]==null)?(i===2?1:0):config._a[i];}
if(config._a[HOUR]===24&&config._a[MINUTE]===0&&config._a[SECOND]===0&&config._a[MILLISECOND]===0){config._nextDay=true;config._a[HOUR]=0;}
config._d=(config._useUTC?createUTCDate:createDate).apply(null,input);if(config._tzm!=null){config._d.setUTCMinutes(config._d.getUTCMinutes()-config._tzm);}
if(config._nextDay){config._a[HOUR]=24;}}
function dayOfYearFromWeekInfo(config){var w,weekYear,week,weekday,dow,doy,temp;w=config._w;if(w.GG!=null||w.W!=null||w.E!=null){dow=1;doy=4;weekYear=defaults(w.GG,config._a[YEAR],weekOfYear(local__createLocal(),1,4).year);week=defaults(w.W,1);weekday=defaults(w.E,1);}else{dow=config._locale._week.dow;doy=config._locale._week.doy;weekYear=defaults(w.gg,config._a[YEAR],weekOfYear(local__createLocal(),dow,doy).year);week=defaults(w.w,1);if(w.d!=null){weekday=w.d;if(weekday<dow){++week;}}else if(w.e!=null){weekday=w.e+dow;}else{weekday=dow;}}
temp=dayOfYearFromWeeks(weekYear,week,weekday,doy,dow);config._a[YEAR]=temp.year;config._dayOfYear=temp.dayOfYear;}
utils_hooks__hooks.ISO_8601=function(){};function configFromStringAndFormat(config){if(config._f===utils_hooks__hooks.ISO_8601){configFromISO(config);return;}
config._a=[];getParsingFlags(config).empty=true;var string=''+config._i,i,parsedInput,tokens,token,skipped,stringLength=string.length,totalParsedInputLength=0;tokens=expandFormat(config._f,config._locale).match(formattingTokens)||[];for(i=0;i<tokens.length;i++){token=tokens[i];parsedInput=(string.match(getParseRegexForToken(token,config))||[])[0];if(parsedInput){skipped=string.substr(0,string.indexOf(parsedInput));if(skipped.length>0){getParsingFlags(config).unusedInput.push(skipped);}
string=string.slice(string.indexOf(parsedInput)+parsedInput.length);totalParsedInputLength+=parsedInput.length;}
if(formatTokenFunctions[token]){if(parsedInput){getParsingFlags(config).empty=false;}
else{getParsingFlags(config).unusedTokens.push(token);}
addTimeToArrayFromToken(token,parsedInput,config);}
else if(config._strict&&!parsedInput){getParsingFlags(config).unusedTokens.push(token);}}
getParsingFlags(config).charsLeftOver=stringLength-totalParsedInputLength;if(string.length>0){getParsingFlags(config).unusedInput.push(string);}
if(getParsingFlags(config).bigHour===true&&config._a[HOUR]<=12&&config._a[HOUR]>0){getParsingFlags(config).bigHour=undefined;}
config._a[HOUR]=meridiemFixWrap(config._locale,config._a[HOUR],config._meridiem);configFromArray(config);checkOverflow(config);}
function meridiemFixWrap(locale,hour,meridiem){var isPm;if(meridiem==null){return hour;}
if(locale.meridiemHour!=null){return locale.meridiemHour(hour,meridiem);}else if(locale.isPM!=null){isPm=locale.isPM(meridiem);if(isPm&&hour<12){hour+=12;}
if(!isPm&&hour===12){hour=0;}
return hour;}else{return hour;}}
function configFromStringAndArray(config){var tempConfig,bestMoment,scoreToBeat,i,currentScore;if(config._f.length===0){getParsingFlags(config).invalidFormat=true;config._d=new Date(NaN);return;}
for(i=0;i<config._f.length;i++){currentScore=0;tempConfig=copyConfig({},config);if(config._useUTC!=null){tempConfig._useUTC=config._useUTC;}
tempConfig._f=config._f[i];configFromStringAndFormat(tempConfig);if(!valid__isValid(tempConfig)){continue;}
currentScore+=getParsingFlags(tempConfig).charsLeftOver;currentScore+=getParsingFlags(tempConfig).unusedTokens.length*10;getParsingFlags(tempConfig).score=currentScore;if(scoreToBeat==null||currentScore<scoreToBeat){scoreToBeat=currentScore;bestMoment=tempConfig;}}
extend(config,bestMoment||tempConfig);}
function configFromObject(config){if(config._d){return;}
var i=normalizeObjectUnits(config._i);config._a=[i.year,i.month,i.day||i.date,i.hour,i.minute,i.second,i.millisecond];configFromArray(config);}
function createFromConfig(config){var res=new Moment(checkOverflow(prepareConfig(config)));if(res._nextDay){res.add(1,'d');res._nextDay=undefined;}
return res;}
function prepareConfig(config){var input=config._i,format=config._f;config._locale=config._locale||locale_locales__getLocale(config._l);if(input===null||(format===undefined&&input==='')){return valid__createInvalid({nullInput:true});}
if(typeof input==='string'){config._i=input=config._locale.preparse(input);}
if(isMoment(input)){return new Moment(checkOverflow(input));}else if(isArray(format)){configFromStringAndArray(config);}else if(format){configFromStringAndFormat(config);}else if(isDate(input)){config._d=input;}else{configFromInput(config);}
return config;}
function configFromInput(config){var input=config._i;if(input===undefined){config._d=new Date();}else if(isDate(input)){config._d=new Date(+input);}else if(typeof input==='string'){configFromString(config);}else if(isArray(input)){config._a=map(input.slice(0),function(obj){return parseInt(obj,10);});configFromArray(config);}else if(typeof(input)==='object'){configFromObject(config);}else if(typeof(input)==='number'){config._d=new Date(input);}else{utils_hooks__hooks.createFromInputFallback(config);}}
function createLocalOrUTC(input,format,locale,strict,isUTC){var c={};if(typeof(locale)==='boolean'){strict=locale;locale=undefined;}
c._isAMomentObject=true;c._useUTC=c._isUTC=isUTC;c._l=locale;c._i=input;c._f=format;c._strict=strict;return createFromConfig(c);}
function local__createLocal(input,format,locale,strict){return createLocalOrUTC(input,format,locale,strict,false);}
var prototypeMin=deprecate('moment().min is deprecated, use moment.min instead. https://github.com/moment/moment/issues/1548',function(){var other=local__createLocal.apply(null,arguments);return other<this?this:other;});var prototypeMax=deprecate('moment().max is deprecated, use moment.max instead. https://github.com/moment/moment/issues/1548',function(){var other=local__createLocal.apply(null,arguments);return other>this?this:other;});function pickBy(fn,moments){var res,i;if(moments.length===1&&isArray(moments[0])){moments=moments[0];}
if(!moments.length){return local__createLocal();}
res=moments[0];for(i=1;i<moments.length;++i){if(!moments[i].isValid()||moments[i][fn](res)){res=moments[i];}}
return res;}
function min(){var args=[].slice.call(arguments,0);return pickBy('isBefore',args);}
function max(){var args=[].slice.call(arguments,0);return pickBy('isAfter',args);}
function Duration(duration){var normalizedInput=normalizeObjectUnits(duration),years=normalizedInput.year||0,quarters=normalizedInput.quarter||0,months=normalizedInput.month||0,weeks=normalizedInput.week||0,days=normalizedInput.day||0,hours=normalizedInput.hour||0,minutes=normalizedInput.minute||0,seconds=normalizedInput.second||0,milliseconds=normalizedInput.millisecond||0;this._milliseconds=+milliseconds+
seconds*1e3+
minutes*6e4+
hours*36e5;this._days=+days+
weeks*7;this._months=+months+
quarters*3+
years*12;this._data={};this._locale=locale_locales__getLocale();this._bubble();}
function isDuration(obj){return obj instanceof Duration;}
function offset(token,separator){addFormatToken(token,0,0,function(){var offset=this.utcOffset();var sign='+';if(offset<0){offset=-offset;sign='-';}
return sign+zeroFill(~~(offset/60),2)+separator+zeroFill(~~(offset)%60,2);});}
offset('Z',':');offset('ZZ','');addRegexToken('Z',matchOffset);addRegexToken('ZZ',matchOffset);addParseToken(['Z','ZZ'],function(input,array,config){config._useUTC=true;config._tzm=offsetFromString(input);});var chunkOffset=/([\+\-]|\d\d)/gi;function offsetFromString(string){var matches=((string||'').match(matchOffset)||[]);var chunk=matches[matches.length-1]||[];var parts=(chunk+'').match(chunkOffset)||['-',0,0];var minutes=+(parts[1]*60)+toInt(parts[2]);return parts[0]==='+'?minutes:-minutes;}
function cloneWithOffset(input,model){var res,diff;if(model._isUTC){res=model.clone();diff=(isMoment(input)||isDate(input)?+input:+local__createLocal(input))-(+res);res._d.setTime(+res._d+diff);utils_hooks__hooks.updateOffset(res,false);return res;}else{return local__createLocal(input).local();}}
function getDateOffset(m){return-Math.round(m._d.getTimezoneOffset()/15)*15;}
utils_hooks__hooks.updateOffset=function(){};function getSetOffset(input,keepLocalTime){var offset=this._offset||0,localAdjust;if(input!=null){if(typeof input==='string'){input=offsetFromString(input);}
if(Math.abs(input)<16){input=input*60;}
if(!this._isUTC&&keepLocalTime){localAdjust=getDateOffset(this);}
this._offset=input;this._isUTC=true;if(localAdjust!=null){this.add(localAdjust,'m');}
if(offset!==input){if(!keepLocalTime||this._changeInProgress){add_subtract__addSubtract(this,create__createDuration(input-offset,'m'),1,false);}else if(!this._changeInProgress){this._changeInProgress=true;utils_hooks__hooks.updateOffset(this,true);this._changeInProgress=null;}}
return this;}else{return this._isUTC?offset:getDateOffset(this);}}
function getSetZone(input,keepLocalTime){if(input!=null){if(typeof input!=='string'){input=-input;}
this.utcOffset(input,keepLocalTime);return this;}else{return-this.utcOffset();}}
function setOffsetToUTC(keepLocalTime){return this.utcOffset(0,keepLocalTime);}
function setOffsetToLocal(keepLocalTime){if(this._isUTC){this.utcOffset(0,keepLocalTime);this._isUTC=false;if(keepLocalTime){this.subtract(getDateOffset(this),'m');}}
return this;}
function setOffsetToParsedOffset(){if(this._tzm){this.utcOffset(this._tzm);}else if(typeof this._i==='string'){this.utcOffset(offsetFromString(this._i));}
return this;}
function hasAlignedHourOffset(input){input=input?local__createLocal(input).utcOffset():0;return(this.utcOffset()-input)%60===0;}
function isDaylightSavingTime(){return(this.utcOffset()>this.clone().month(0).utcOffset()||this.utcOffset()>this.clone().month(5).utcOffset());}
function isDaylightSavingTimeShifted(){if(typeof this._isDSTShifted!=='undefined'){return this._isDSTShifted;}
var c={};copyConfig(c,this);c=prepareConfig(c);if(c._a){var other=c._isUTC?create_utc__createUTC(c._a):local__createLocal(c._a);this._isDSTShifted=this.isValid()&&compareArrays(c._a,other.toArray())>0;}else{this._isDSTShifted=false;}
return this._isDSTShifted;}
function isLocal(){return!this._isUTC;}
function isUtcOffset(){return this._isUTC;}
function isUtc(){return this._isUTC&&this._offset===0;}
var aspNetRegex=/(\-)?(?:(\d*)\.)?(\d+)\:(\d+)(?:\:(\d+)\.?(\d{3})?)?/;var create__isoRegex=/^(-)?P(?:(?:([0-9,.]*)Y)?(?:([0-9,.]*)M)?(?:([0-9,.]*)D)?(?:T(?:([0-9,.]*)H)?(?:([0-9,.]*)M)?(?:([0-9,.]*)S)?)?|([0-9,.]*)W)$/;function create__createDuration(input,key){var duration=input,match=null,sign,ret,diffRes;if(isDuration(input)){duration={ms:input._milliseconds,d:input._days,M:input._months};}else if(typeof input==='number'){duration={};if(key){duration[key]=input;}else{duration.milliseconds=input;}}else if(!!(match=aspNetRegex.exec(input))){sign=(match[1]==='-')?-1:1;duration={y:0,d:toInt(match[DATE])*sign,h:toInt(match[HOUR])*sign,m:toInt(match[MINUTE])*sign,s:toInt(match[SECOND])*sign,ms:toInt(match[MILLISECOND])*sign};}else if(!!(match=create__isoRegex.exec(input))){sign=(match[1]==='-')?-1:1;duration={y:parseIso(match[2],sign),M:parseIso(match[3],sign),d:parseIso(match[4],sign),h:parseIso(match[5],sign),m:parseIso(match[6],sign),s:parseIso(match[7],sign),w:parseIso(match[8],sign)};}else if(duration==null){duration={};}else if(typeof duration==='object'&&('from'in duration||'to'in duration)){diffRes=momentsDifference(local__createLocal(duration.from),local__createLocal(duration.to));duration={};duration.ms=diffRes.milliseconds;duration.M=diffRes.months;}
ret=new Duration(duration);if(isDuration(input)&&hasOwnProp(input,'_locale')){ret._locale=input._locale;}
return ret;}
create__createDuration.fn=Duration.prototype;function parseIso(inp,sign){var res=inp&&parseFloat(inp.replace(',','.'));return(isNaN(res)?0:res)*sign;}
function positiveMomentsDifference(base,other){var res={milliseconds:0,months:0};res.months=other.month()-base.month()+
(other.year()-base.year())*12;if(base.clone().add(res.months,'M').isAfter(other)){--res.months;}
res.milliseconds=+other-+(base.clone().add(res.months,'M'));return res;}
function momentsDifference(base,other){var res;other=cloneWithOffset(other,base);if(base.isBefore(other)){res=positiveMomentsDifference(base,other);}else{res=positiveMomentsDifference(other,base);res.milliseconds=-res.milliseconds;res.months=-res.months;}
return res;}
function createAdder(direction,name){return function(val,period){var dur,tmp;if(period!==null&&!isNaN(+period)){deprecateSimple(name,'moment().'+name+'(period, number) is deprecated. Please use moment().'+name+'(number, period).');tmp=val;val=period;period=tmp;}
val=typeof val==='string'?+val:val;dur=create__createDuration(val,period);add_subtract__addSubtract(this,dur,direction);return this;};}
function add_subtract__addSubtract(mom,duration,isAdding,updateOffset){var milliseconds=duration._milliseconds,days=duration._days,months=duration._months;updateOffset=updateOffset==null?true:updateOffset;if(milliseconds){mom._d.setTime(+mom._d+milliseconds*isAdding);}
if(days){get_set__set(mom,'Date',get_set__get(mom,'Date')+days*isAdding);}
if(months){setMonth(mom,get_set__get(mom,'Month')+months*isAdding);}
if(updateOffset){utils_hooks__hooks.updateOffset(mom,days||months);}}
var add_subtract__add=createAdder(1,'add');var add_subtract__subtract=createAdder(-1,'subtract');function moment_calendar__calendar(time,formats){var now=time||local__createLocal(),sod=cloneWithOffset(now,this).startOf('day'),diff=this.diff(sod,'days',true),format=diff<-6?'sameElse':diff<-1?'lastWeek':diff<0?'lastDay':diff<1?'sameDay':diff<2?'nextDay':diff<7?'nextWeek':'sameElse';return this.format(formats&&formats[format]||this.localeData().calendar(format,this,local__createLocal(now)));}
function clone(){return new Moment(this);}
function isAfter(input,units){var inputMs;units=normalizeUnits(typeof units!=='undefined'?units:'millisecond');if(units==='millisecond'){input=isMoment(input)?input:local__createLocal(input);return+this>+input;}else{inputMs=isMoment(input)?+input:+local__createLocal(input);return inputMs<+this.clone().startOf(units);}}
function isBefore(input,units){var inputMs;units=normalizeUnits(typeof units!=='undefined'?units:'millisecond');if(units==='millisecond'){input=isMoment(input)?input:local__createLocal(input);return+this<+input;}else{inputMs=isMoment(input)?+input:+local__createLocal(input);return+this.clone().endOf(units)<inputMs;}}
function isBetween(from,to,units){return this.isAfter(from,units)&&this.isBefore(to,units);}
function isSame(input,units){var inputMs;units=normalizeUnits(units||'millisecond');if(units==='millisecond'){input=isMoment(input)?input:local__createLocal(input);return+this===+input;}else{inputMs=+local__createLocal(input);return+(this.clone().startOf(units))<=inputMs&&inputMs<=+(this.clone().endOf(units));}}
function diff(input,units,asFloat){var that=cloneWithOffset(input,this),zoneDelta=(that.utcOffset()-this.utcOffset())*6e4,delta,output;units=normalizeUnits(units);if(units==='year'||units==='month'||units==='quarter'){output=monthDiff(this,that);if(units==='quarter'){output=output/3;}else if(units==='year'){output=output/12;}}else{delta=this-that;output=units==='second'?delta/1e3:units==='minute'?delta/6e4:units==='hour'?delta/36e5:units==='day'?(delta-zoneDelta)/864e5:units==='week'?(delta-zoneDelta)/6048e5:delta;}
return asFloat?output:absFloor(output);}
function monthDiff(a,b){var wholeMonthDiff=((b.year()-a.year())*12)+(b.month()-a.month()),anchor=a.clone().add(wholeMonthDiff,'months'),anchor2,adjust;if(b-anchor<0){anchor2=a.clone().add(wholeMonthDiff-1,'months');adjust=(b-anchor)/(anchor-anchor2);}else{anchor2=a.clone().add(wholeMonthDiff+1,'months');adjust=(b-anchor)/(anchor2-anchor);}
return-(wholeMonthDiff+adjust);}
utils_hooks__hooks.defaultFormat='YYYY-MM-DDTHH:mm:ssZ';function toString(){return this.clone().locale('en').format('ddd MMM DD YYYY HH:mm:ss [GMT]ZZ');}
function moment_format__toISOString(){var m=this.clone().utc();if(0<m.year()&&m.year()<=9999){if('function'===typeof Date.prototype.toISOString){return this.toDate().toISOString();}else{return formatMoment(m,'YYYY-MM-DD[T]HH:mm:ss.SSS[Z]');}}else{return formatMoment(m,'YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]');}}
function format(inputString){var output=formatMoment(this,inputString||utils_hooks__hooks.defaultFormat);return this.localeData().postformat(output);}
function from(time,withoutSuffix){if(!this.isValid()){return this.localeData().invalidDate();}
return create__createDuration({to:this,from:time}).locale(this.locale()).humanize(!withoutSuffix);}
function fromNow(withoutSuffix){return this.from(local__createLocal(),withoutSuffix);}
function to(time,withoutSuffix){if(!this.isValid()){return this.localeData().invalidDate();}
return create__createDuration({from:this,to:time}).locale(this.locale()).humanize(!withoutSuffix);}
function toNow(withoutSuffix){return this.to(local__createLocal(),withoutSuffix);}
function locale(key){var newLocaleData;if(key===undefined){return this._locale._abbr;}else{newLocaleData=locale_locales__getLocale(key);if(newLocaleData!=null){this._locale=newLocaleData;}
return this;}}
var lang=deprecate('moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.',function(key){if(key===undefined){return this.localeData();}else{return this.locale(key);}});function localeData(){return this._locale;}
function startOf(units){units=normalizeUnits(units);switch(units){case 'year':this.month(0);case 'quarter':case 'month':this.date(1);case 'week':case 'isoWeek':case 'day':this.hours(0);case 'hour':this.minutes(0);case 'minute':this.seconds(0);case 'second':this.milliseconds(0);}
if(units==='week'){this.weekday(0);}
if(units==='isoWeek'){this.isoWeekday(1);}
if(units==='quarter'){this.month(Math.floor(this.month()/3)*3);}
return this;}
function endOf(units){units=normalizeUnits(units);if(units===undefined||units==='millisecond'){return this;}
return this.startOf(units).add(1,(units==='isoWeek'?'week':units)).subtract(1,'ms');}
function to_type__valueOf(){return+this._d-((this._offset||0)*60000);}
function unix(){return Math.floor(+this/1000);}
function toDate(){return this._offset?new Date(+this):this._d;}
function toArray(){var m=this;return[m.year(),m.month(),m.date(),m.hour(),m.minute(),m.second(),m.millisecond()];}
function toObject(){var m=this;return{years:m.year(),months:m.month(),date:m.date(),hours:m.hours(),minutes:m.minutes(),seconds:m.seconds(),milliseconds:m.milliseconds()};}
function moment_valid__isValid(){return valid__isValid(this);}
function parsingFlags(){return extend({},getParsingFlags(this));}
function invalidAt(){return getParsingFlags(this).overflow;}
addFormatToken(0,['gg',2],0,function(){return this.weekYear()%100;});addFormatToken(0,['GG',2],0,function(){return this.isoWeekYear()%100;});function addWeekYearFormatToken(token,getter){addFormatToken(0,[token,token.length],0,getter);}
addWeekYearFormatToken('gggg','weekYear');addWeekYearFormatToken('ggggg','weekYear');addWeekYearFormatToken('GGGG','isoWeekYear');addWeekYearFormatToken('GGGGG','isoWeekYear');addUnitAlias('weekYear','gg');addUnitAlias('isoWeekYear','GG');addRegexToken('G',matchSigned);addRegexToken('g',matchSigned);addRegexToken('GG',match1to2,match2);addRegexToken('gg',match1to2,match2);addRegexToken('GGGG',match1to4,match4);addRegexToken('gggg',match1to4,match4);addRegexToken('GGGGG',match1to6,match6);addRegexToken('ggggg',match1to6,match6);addWeekParseToken(['gggg','ggggg','GGGG','GGGGG'],function(input,week,config,token){week[token.substr(0,2)]=toInt(input);});addWeekParseToken(['gg','GG'],function(input,week,config,token){week[token]=utils_hooks__hooks.parseTwoDigitYear(input);});function weeksInYear(year,dow,doy){return weekOfYear(local__createLocal([year,11,31+dow-doy]),dow,doy).week;}
function getSetWeekYear(input){var year=weekOfYear(this,this.localeData()._week.dow,this.localeData()._week.doy).year;return input==null?year:this.add((input-year),'y');}
function getSetISOWeekYear(input){var year=weekOfYear(this,1,4).year;return input==null?year:this.add((input-year),'y');}
function getISOWeeksInYear(){return weeksInYear(this.year(),1,4);}
function getWeeksInYear(){var weekInfo=this.localeData()._week;return weeksInYear(this.year(),weekInfo.dow,weekInfo.doy);}
addFormatToken('Q',0,0,'quarter');addUnitAlias('quarter','Q');addRegexToken('Q',match1);addParseToken('Q',function(input,array){array[MONTH]=(toInt(input)-1)*3;});function getSetQuarter(input){return input==null?Math.ceil((this.month()+1)/3):this.month((input-1)*3+this.month()%3);}
addFormatToken('D',['DD',2],'Do','date');addUnitAlias('date','D');addRegexToken('D',match1to2);addRegexToken('DD',match1to2,match2);addRegexToken('Do',function(isStrict,locale){return isStrict?locale._ordinalParse:locale._ordinalParseLenient;});addParseToken(['D','DD'],DATE);addParseToken('Do',function(input,array){array[DATE]=toInt(input.match(match1to2)[0],10);});var getSetDayOfMonth=makeGetSet('Date',true);addFormatToken('d',0,'do','day');addFormatToken('dd',0,0,function(format){return this.localeData().weekdaysMin(this,format);});addFormatToken('ddd',0,0,function(format){return this.localeData().weekdaysShort(this,format);});addFormatToken('dddd',0,0,function(format){return this.localeData().weekdays(this,format);});addFormatToken('e',0,0,'weekday');addFormatToken('E',0,0,'isoWeekday');addUnitAlias('day','d');addUnitAlias('weekday','e');addUnitAlias('isoWeekday','E');addRegexToken('d',match1to2);addRegexToken('e',match1to2);addRegexToken('E',match1to2);addRegexToken('dd',matchWord);addRegexToken('ddd',matchWord);addRegexToken('dddd',matchWord);addWeekParseToken(['dd','ddd','dddd'],function(input,week,config){var weekday=config._locale.weekdaysParse(input);if(weekday!=null){week.d=weekday;}else{getParsingFlags(config).invalidWeekday=input;}});addWeekParseToken(['d','e','E'],function(input,week,config,token){week[token]=toInt(input);});function parseWeekday(input,locale){if(typeof input!=='string'){return input;}
if(!isNaN(input)){return parseInt(input,10);}
input=locale.weekdaysParse(input);if(typeof input==='number'){return input;}
return null;}
var defaultLocaleWeekdays='Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday'.split('_');function localeWeekdays(m){return this._weekdays[m.day()];}
var defaultLocaleWeekdaysShort='Sun_Mon_Tue_Wed_Thu_Fri_Sat'.split('_');function localeWeekdaysShort(m){return this._weekdaysShort[m.day()];}
var defaultLocaleWeekdaysMin='Su_Mo_Tu_We_Th_Fr_Sa'.split('_');function localeWeekdaysMin(m){return this._weekdaysMin[m.day()];}
function localeWeekdaysParse(weekdayName){var i,mom,regex;this._weekdaysParse=this._weekdaysParse||[];for(i=0;i<7;i++){if(!this._weekdaysParse[i]){mom=local__createLocal([2000,1]).day(i);regex='^'+this.weekdays(mom,'')+'|^'+this.weekdaysShort(mom,'')+'|^'+this.weekdaysMin(mom,'');this._weekdaysParse[i]=new RegExp(regex.replace('.',''),'i');}
if(this._weekdaysParse[i].test(weekdayName)){return i;}}}
function getSetDayOfWeek(input){var day=this._isUTC?this._d.getUTCDay():this._d.getDay();if(input!=null){input=parseWeekday(input,this.localeData());return this.add(input-day,'d');}else{return day;}}
function getSetLocaleDayOfWeek(input){var weekday=(this.day()+7-this.localeData()._week.dow)%7;return input==null?weekday:this.add(input-weekday,'d');}
function getSetISODayOfWeek(input){return input==null?this.day()||7:this.day(this.day()%7?input:input-7);}
addFormatToken('H',['HH',2],0,'hour');addFormatToken('h',['hh',2],0,function(){return this.hours()%12||12;});function meridiem(token,lowercase){addFormatToken(token,0,0,function(){return this.localeData().meridiem(this.hours(),this.minutes(),lowercase);});}
meridiem('a',true);meridiem('A',false);addUnitAlias('hour','h');function matchMeridiem(isStrict,locale){return locale._meridiemParse;}
addRegexToken('a',matchMeridiem);addRegexToken('A',matchMeridiem);addRegexToken('H',match1to2);addRegexToken('h',match1to2);addRegexToken('HH',match1to2,match2);addRegexToken('hh',match1to2,match2);addParseToken(['H','HH'],HOUR);addParseToken(['a','A'],function(input,array,config){config._isPm=config._locale.isPM(input);config._meridiem=input;});addParseToken(['h','hh'],function(input,array,config){array[HOUR]=toInt(input);getParsingFlags(config).bigHour=true;});function localeIsPM(input){return((input+'').toLowerCase().charAt(0)==='p');}
var defaultLocaleMeridiemParse=/[ap]\.?m?\.?/i;function localeMeridiem(hours,minutes,isLower){if(hours>11){return isLower?'pm':'PM';}else{return isLower?'am':'AM';}}
var getSetHour=makeGetSet('Hours',true);addFormatToken('m',['mm',2],0,'minute');addUnitAlias('minute','m');addRegexToken('m',match1to2);addRegexToken('mm',match1to2,match2);addParseToken(['m','mm'],MINUTE);var getSetMinute=makeGetSet('Minutes',false);addFormatToken('s',['ss',2],0,'second');addUnitAlias('second','s');addRegexToken('s',match1to2);addRegexToken('ss',match1to2,match2);addParseToken(['s','ss'],SECOND);var getSetSecond=makeGetSet('Seconds',false);addFormatToken('S',0,0,function(){return~~(this.millisecond()/100);});addFormatToken(0,['SS',2],0,function(){return~~(this.millisecond()/10);});addFormatToken(0,['SSS',3],0,'millisecond');addFormatToken(0,['SSSS',4],0,function(){return this.millisecond()*10;});addFormatToken(0,['SSSSS',5],0,function(){return this.millisecond()*100;});addFormatToken(0,['SSSSSS',6],0,function(){return this.millisecond()*1000;});addFormatToken(0,['SSSSSSS',7],0,function(){return this.millisecond()*10000;});addFormatToken(0,['SSSSSSSS',8],0,function(){return this.millisecond()*100000;});addFormatToken(0,['SSSSSSSSS',9],0,function(){return this.millisecond()*1000000;});addUnitAlias('millisecond','ms');addRegexToken('S',match1to3,match1);addRegexToken('SS',match1to3,match2);addRegexToken('SSS',match1to3,match3);var token;for(token='SSSS';token.length<=9;token+='S'){addRegexToken(token,matchUnsigned);}
function parseMs(input,array){array[MILLISECOND]=toInt(('0.'+input)*1000);}
for(token='S';token.length<=9;token+='S'){addParseToken(token,parseMs);}
var getSetMillisecond=makeGetSet('Milliseconds',false);addFormatToken('z',0,0,'zoneAbbr');addFormatToken('zz',0,0,'zoneName');function getZoneAbbr(){return this._isUTC?'UTC':'';}
function getZoneName(){return this._isUTC?'Coordinated Universal Time':'';}
var momentPrototype__proto=Moment.prototype;momentPrototype__proto.add=add_subtract__add;momentPrototype__proto.calendar=moment_calendar__calendar;momentPrototype__proto.clone=clone;momentPrototype__proto.diff=diff;momentPrototype__proto.endOf=endOf;momentPrototype__proto.format=format;momentPrototype__proto.from=from;momentPrototype__proto.fromNow=fromNow;momentPrototype__proto.to=to;momentPrototype__proto.toNow=toNow;momentPrototype__proto.get=getSet;momentPrototype__proto.invalidAt=invalidAt;momentPrototype__proto.isAfter=isAfter;momentPrototype__proto.isBefore=isBefore;momentPrototype__proto.isBetween=isBetween;momentPrototype__proto.isSame=isSame;momentPrototype__proto.isValid=moment_valid__isValid;momentPrototype__proto.lang=lang;momentPrototype__proto.locale=locale;momentPrototype__proto.localeData=localeData;momentPrototype__proto.max=prototypeMax;momentPrototype__proto.min=prototypeMin;momentPrototype__proto.parsingFlags=parsingFlags;momentPrototype__proto.set=getSet;momentPrototype__proto.startOf=startOf;momentPrototype__proto.subtract=add_subtract__subtract;momentPrototype__proto.toArray=toArray;momentPrototype__proto.toObject=toObject;momentPrototype__proto.toDate=toDate;momentPrototype__proto.toISOString=moment_format__toISOString;momentPrototype__proto.toJSON=moment_format__toISOString;momentPrototype__proto.toString=toString;momentPrototype__proto.unix=unix;momentPrototype__proto.valueOf=to_type__valueOf;momentPrototype__proto.year=getSetYear;momentPrototype__proto.isLeapYear=getIsLeapYear;momentPrototype__proto.weekYear=getSetWeekYear;momentPrototype__proto.isoWeekYear=getSetISOWeekYear;momentPrototype__proto.quarter=momentPrototype__proto.quarters=getSetQuarter;momentPrototype__proto.month=getSetMonth;momentPrototype__proto.daysInMonth=getDaysInMonth;momentPrototype__proto.week=momentPrototype__proto.weeks=getSetWeek;momentPrototype__proto.isoWeek=momentPrototype__proto.isoWeeks=getSetISOWeek;momentPrototype__proto.weeksInYear=getWeeksInYear;momentPrototype__proto.isoWeeksInYear=getISOWeeksInYear;momentPrototype__proto.date=getSetDayOfMonth;momentPrototype__proto.day=momentPrototype__proto.days=getSetDayOfWeek;momentPrototype__proto.weekday=getSetLocaleDayOfWeek;momentPrototype__proto.isoWeekday=getSetISODayOfWeek;momentPrototype__proto.dayOfYear=getSetDayOfYear;momentPrototype__proto.hour=momentPrototype__proto.hours=getSetHour;momentPrototype__proto.minute=momentPrototype__proto.minutes=getSetMinute;momentPrototype__proto.second=momentPrototype__proto.seconds=getSetSecond;momentPrototype__proto.millisecond=momentPrototype__proto.milliseconds=getSetMillisecond;momentPrototype__proto.utcOffset=getSetOffset;momentPrototype__proto.utc=setOffsetToUTC;momentPrototype__proto.local=setOffsetToLocal;momentPrototype__proto.parseZone=setOffsetToParsedOffset;momentPrototype__proto.hasAlignedHourOffset=hasAlignedHourOffset;momentPrototype__proto.isDST=isDaylightSavingTime;momentPrototype__proto.isDSTShifted=isDaylightSavingTimeShifted;momentPrototype__proto.isLocal=isLocal;momentPrototype__proto.isUtcOffset=isUtcOffset;momentPrototype__proto.isUtc=isUtc;momentPrototype__proto.isUTC=isUtc;momentPrototype__proto.zoneAbbr=getZoneAbbr;momentPrototype__proto.zoneName=getZoneName;momentPrototype__proto.dates=deprecate('dates accessor is deprecated. Use date instead.',getSetDayOfMonth);momentPrototype__proto.months=deprecate('months accessor is deprecated. Use month instead',getSetMonth);momentPrototype__proto.years=deprecate('years accessor is deprecated. Use year instead',getSetYear);momentPrototype__proto.zone=deprecate('moment().zone is deprecated, use moment().utcOffset instead. https://github.com/moment/moment/issues/1779',getSetZone);var momentPrototype=momentPrototype__proto;function moment__createUnix(input){return local__createLocal(input*1000);}
function moment__createInZone(){return local__createLocal.apply(null,arguments).parseZone();}
var defaultCalendar={sameDay:'[Today at] LT',nextDay:'[Tomorrow at] LT',nextWeek:'dddd [at] LT',lastDay:'[Yesterday at] LT',lastWeek:'[Last] dddd [at] LT',sameElse:'L'};function locale_calendar__calendar(key,mom,now){var output=this._calendar[key];return typeof output==='function'?output.call(mom,now):output;}
var defaultLongDateFormat={LTS:'h:mm:ss A',LT:'h:mm A',L:'MM/DD/YYYY',LL:'MMMM D, YYYY',LLL:'MMMM D, YYYY h:mm A',LLLL:'dddd, MMMM D, YYYY h:mm A'};function longDateFormat(key){var format=this._longDateFormat[key],formatUpper=this._longDateFormat[key.toUpperCase()];if(format||!formatUpper){return format;}
this._longDateFormat[key]=formatUpper.replace(/MMMM|MM|DD|dddd/g,function(val){return val.slice(1);});return this._longDateFormat[key];}
var defaultInvalidDate='Invalid date';function invalidDate(){return this._invalidDate;}
var defaultOrdinal='%d';var defaultOrdinalParse=/\d{1,2}/;function ordinal(number){return this._ordinal.replace('%d',number);}
function preParsePostFormat(string){return string;}
var defaultRelativeTime={future:'in %s',past:'%s ago',s:'a few seconds',m:'a minute',mm:'%d minutes',h:'an hour',hh:'%d hours',d:'a day',dd:'%d days',M:'a month',MM:'%d months',y:'a year',yy:'%d years'};function relative__relativeTime(number,withoutSuffix,string,isFuture){var output=this._relativeTime[string];return(typeof output==='function')?output(number,withoutSuffix,string,isFuture):output.replace(/%d/i,number);}
function pastFuture(diff,output){var format=this._relativeTime[diff>0?'future':'past'];return typeof format==='function'?format(output):format.replace(/%s/i,output);}
function locale_set__set(config){var prop,i;for(i in config){prop=config[i];if(typeof prop==='function'){this[i]=prop;}else{this['_'+i]=prop;}}
this._ordinalParseLenient=new RegExp(this._ordinalParse.source+'|'+(/\d{1,2}/).source);}
var prototype__proto=Locale.prototype;prototype__proto._calendar=defaultCalendar;prototype__proto.calendar=locale_calendar__calendar;prototype__proto._longDateFormat=defaultLongDateFormat;prototype__proto.longDateFormat=longDateFormat;prototype__proto._invalidDate=defaultInvalidDate;prototype__proto.invalidDate=invalidDate;prototype__proto._ordinal=defaultOrdinal;prototype__proto.ordinal=ordinal;prototype__proto._ordinalParse=defaultOrdinalParse;prototype__proto.preparse=preParsePostFormat;prototype__proto.postformat=preParsePostFormat;prototype__proto._relativeTime=defaultRelativeTime;prototype__proto.relativeTime=relative__relativeTime;prototype__proto.pastFuture=pastFuture;prototype__proto.set=locale_set__set;prototype__proto.months=localeMonths;prototype__proto._months=defaultLocaleMonths;prototype__proto.monthsShort=localeMonthsShort;prototype__proto._monthsShort=defaultLocaleMonthsShort;prototype__proto.monthsParse=localeMonthsParse;prototype__proto.week=localeWeek;prototype__proto._week=defaultLocaleWeek;prototype__proto.firstDayOfYear=localeFirstDayOfYear;prototype__proto.firstDayOfWeek=localeFirstDayOfWeek;prototype__proto.weekdays=localeWeekdays;prototype__proto._weekdays=defaultLocaleWeekdays;prototype__proto.weekdaysMin=localeWeekdaysMin;prototype__proto._weekdaysMin=defaultLocaleWeekdaysMin;prototype__proto.weekdaysShort=localeWeekdaysShort;prototype__proto._weekdaysShort=defaultLocaleWeekdaysShort;prototype__proto.weekdaysParse=localeWeekdaysParse;prototype__proto.isPM=localeIsPM;prototype__proto._meridiemParse=defaultLocaleMeridiemParse;prototype__proto.meridiem=localeMeridiem;function lists__get(format,index,field,setter){var locale=locale_locales__getLocale();var utc=create_utc__createUTC().set(setter,index);return locale[field](utc,format);}
function list(format,index,field,count,setter){if(typeof format==='number'){index=format;format=undefined;}
format=format||'';if(index!=null){return lists__get(format,index,field,setter);}
var i;var out=[];for(i=0;i<count;i++){out[i]=lists__get(format,i,field,setter);}
return out;}
function lists__listMonths(format,index){return list(format,index,'months',12,'month');}
function lists__listMonthsShort(format,index){return list(format,index,'monthsShort',12,'month');}
function lists__listWeekdays(format,index){return list(format,index,'weekdays',7,'day');}
function lists__listWeekdaysShort(format,index){return list(format,index,'weekdaysShort',7,'day');}
function lists__listWeekdaysMin(format,index){return list(format,index,'weekdaysMin',7,'day');}
locale_locales__getSetGlobalLocale('en',{ordinalParse:/\d{1,2}(th|st|nd|rd)/,ordinal:function(number){var b=number%10,output=(toInt(number%100/10)===1)?'th':(b===1)?'st':(b===2)?'nd':(b===3)?'rd':'th';return number+output;}});utils_hooks__hooks.lang=deprecate('moment.lang is deprecated. Use moment.locale instead.',locale_locales__getSetGlobalLocale);utils_hooks__hooks.langData=deprecate('moment.langData is deprecated. Use moment.localeData instead.',locale_locales__getLocale);var mathAbs=Math.abs;function duration_abs__abs(){var data=this._data;this._milliseconds=mathAbs(this._milliseconds);this._days=mathAbs(this._days);this._months=mathAbs(this._months);data.milliseconds=mathAbs(data.milliseconds);data.seconds=mathAbs(data.seconds);data.minutes=mathAbs(data.minutes);data.hours=mathAbs(data.hours);data.months=mathAbs(data.months);data.years=mathAbs(data.years);return this;}
function duration_add_subtract__addSubtract(duration,input,value,direction){var other=create__createDuration(input,value);duration._milliseconds+=direction*other._milliseconds;duration._days+=direction*other._days;duration._months+=direction*other._months;return duration._bubble();}
function duration_add_subtract__add(input,value){return duration_add_subtract__addSubtract(this,input,value,1);}
function duration_add_subtract__subtract(input,value){return duration_add_subtract__addSubtract(this,input,value,-1);}
function absCeil(number){if(number<0){return Math.floor(number);}else{return Math.ceil(number);}}
function bubble(){var milliseconds=this._milliseconds;var days=this._days;var months=this._months;var data=this._data;var seconds,minutes,hours,years,monthsFromDays;if(!((milliseconds>=0&&days>=0&&months>=0)||(milliseconds<=0&&days<=0&&months<=0))){milliseconds+=absCeil(monthsToDays(months)+days)*864e5;days=0;months=0;}
data.milliseconds=milliseconds%1000;seconds=absFloor(milliseconds/1000);data.seconds=seconds%60;minutes=absFloor(seconds/60);data.minutes=minutes%60;hours=absFloor(minutes/60);data.hours=hours%24;days+=absFloor(hours/24);monthsFromDays=absFloor(daysToMonths(days));months+=monthsFromDays;days-=absCeil(monthsToDays(monthsFromDays));years=absFloor(months/12);months%=12;data.days=days;data.months=months;data.years=years;return this;}
function daysToMonths(days){return days*4800/146097;}
function monthsToDays(months){return months*146097/4800;}
function as(units){var days;var months;var milliseconds=this._milliseconds;units=normalizeUnits(units);if(units==='month'||units==='year'){days=this._days+milliseconds/864e5;months=this._months+daysToMonths(days);return units==='month'?months:months/12;}else{days=this._days+Math.round(monthsToDays(this._months));switch(units){case 'week':return days/7+milliseconds/6048e5;case 'day':return days+milliseconds/864e5;case 'hour':return days*24+milliseconds/36e5;case 'minute':return days*1440+milliseconds/6e4;case 'second':return days*86400+milliseconds/1000;case 'millisecond':return Math.floor(days*864e5)+milliseconds;default:throw new Error('Unknown unit '+units);}}}
function duration_as__valueOf(){return(this._milliseconds+
this._days*864e5+
(this._months%12)*2592e6+
toInt(this._months/12)*31536e6);}
function makeAs(alias){return function(){return this.as(alias);};}
var asMilliseconds=makeAs('ms');var asSeconds=makeAs('s');var asMinutes=makeAs('m');var asHours=makeAs('h');var asDays=makeAs('d');var asWeeks=makeAs('w');var asMonths=makeAs('M');var asYears=makeAs('y');function duration_get__get(units){units=normalizeUnits(units);return this[units+'s']();}
function makeGetter(name){return function(){return this._data[name];};}
var milliseconds=makeGetter('milliseconds');var seconds=makeGetter('seconds');var minutes=makeGetter('minutes');var hours=makeGetter('hours');var days=makeGetter('days');var months=makeGetter('months');var years=makeGetter('years');function weeks(){return absFloor(this.days()/7);}
var round=Math.round;var thresholds={s:45,m:45,h:22,d:26,M:11};function substituteTimeAgo(string,number,withoutSuffix,isFuture,locale){return locale.relativeTime(number||1,!!withoutSuffix,string,isFuture);}
function duration_humanize__relativeTime(posNegDuration,withoutSuffix,locale){var duration=create__createDuration(posNegDuration).abs();var seconds=round(duration.as('s'));var minutes=round(duration.as('m'));var hours=round(duration.as('h'));var days=round(duration.as('d'));var months=round(duration.as('M'));var years=round(duration.as('y'));var a=seconds<thresholds.s&&['s',seconds]||minutes===1&&['m']||minutes<thresholds.m&&['mm',minutes]||hours===1&&['h']||hours<thresholds.h&&['hh',hours]||days===1&&['d']||days<thresholds.d&&['dd',days]||months===1&&['M']||months<thresholds.M&&['MM',months]||years===1&&['y']||['yy',years];a[2]=withoutSuffix;a[3]=+posNegDuration>0;a[4]=locale;return substituteTimeAgo.apply(null,a);}
function duration_humanize__getSetRelativeTimeThreshold(threshold,limit){if(thresholds[threshold]===undefined){return false;}
if(limit===undefined){return thresholds[threshold];}
thresholds[threshold]=limit;return true;}
function humanize(withSuffix){var locale=this.localeData();var output=duration_humanize__relativeTime(this,!withSuffix,locale);if(withSuffix){output=locale.pastFuture(+this,output);}
return locale.postformat(output);}
var iso_string__abs=Math.abs;function iso_string__toISOString(){var seconds=iso_string__abs(this._milliseconds)/1000;var days=iso_string__abs(this._days);var months=iso_string__abs(this._months);var minutes,hours,years;minutes=absFloor(seconds/60);hours=absFloor(minutes/60);seconds%=60;minutes%=60;years=absFloor(months/12);months%=12;var Y=years;var M=months;var D=days;var h=hours;var m=minutes;var s=seconds;var total=this.asSeconds();if(!total){return 'P0D';}
return(total<0?'-':'')+
'P'+
(Y?Y+'Y':'')+
(M?M+'M':'')+
(D?D+'D':'')+
((h||m||s)?'T':'')+
(h?h+'H':'')+
(m?m+'M':'')+
(s?s+'S':'');}
var duration_prototype__proto=Duration.prototype;duration_prototype__proto.abs=duration_abs__abs;duration_prototype__proto.add=duration_add_subtract__add;duration_prototype__proto.subtract=duration_add_subtract__subtract;duration_prototype__proto.as=as;duration_prototype__proto.asMilliseconds=asMilliseconds;duration_prototype__proto.asSeconds=asSeconds;duration_prototype__proto.asMinutes=asMinutes;duration_prototype__proto.asHours=asHours;duration_prototype__proto.asDays=asDays;duration_prototype__proto.asWeeks=asWeeks;duration_prototype__proto.asMonths=asMonths;duration_prototype__proto.asYears=asYears;duration_prototype__proto.valueOf=duration_as__valueOf;duration_prototype__proto._bubble=bubble;duration_prototype__proto.get=duration_get__get;duration_prototype__proto.milliseconds=milliseconds;duration_prototype__proto.seconds=seconds;duration_prototype__proto.minutes=minutes;duration_prototype__proto.hours=hours;duration_prototype__proto.days=days;duration_prototype__proto.weeks=weeks;duration_prototype__proto.months=months;duration_prototype__proto.years=years;duration_prototype__proto.humanize=humanize;duration_prototype__proto.toISOString=iso_string__toISOString;duration_prototype__proto.toString=iso_string__toISOString;duration_prototype__proto.toJSON=iso_string__toISOString;duration_prototype__proto.locale=locale;duration_prototype__proto.localeData=localeData;duration_prototype__proto.toIsoString=deprecate('toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)',iso_string__toISOString);duration_prototype__proto.lang=lang;addFormatToken('X',0,0,'unix');addFormatToken('x',0,0,'valueOf');addRegexToken('x',matchSigned);addRegexToken('X',matchTimestamp);addParseToken('X',function(input,array,config){config._d=new Date(parseFloat(input,10)*1000);});addParseToken('x',function(input,array,config){config._d=new Date(toInt(input));});utils_hooks__hooks.version='2.10.6';setHookCallback(local__createLocal);utils_hooks__hooks.fn=momentPrototype;utils_hooks__hooks.min=min;utils_hooks__hooks.max=max;utils_hooks__hooks.utc=create_utc__createUTC;utils_hooks__hooks.unix=moment__createUnix;utils_hooks__hooks.months=lists__listMonths;utils_hooks__hooks.isDate=isDate;utils_hooks__hooks.locale=locale_locales__getSetGlobalLocale;utils_hooks__hooks.invalid=valid__createInvalid;utils_hooks__hooks.duration=create__createDuration;utils_hooks__hooks.isMoment=isMoment;utils_hooks__hooks.weekdays=lists__listWeekdays;utils_hooks__hooks.parseZone=moment__createInZone;utils_hooks__hooks.localeData=locale_locales__getLocale;utils_hooks__hooks.isDuration=isDuration;utils_hooks__hooks.monthsShort=lists__listMonthsShort;utils_hooks__hooks.weekdaysMin=lists__listWeekdaysMin;utils_hooks__hooks.defineLocale=defineLocale;utils_hooks__hooks.weekdaysShort=lists__listWeekdaysShort;utils_hooks__hooks.normalizeUnits=normalizeUnits;utils_hooks__hooks.relativeTimeThreshold=duration_humanize__getSetRelativeTimeThreshold;var _moment=utils_hooks__hooks;return _moment;}));(function(root,factory){if(typeof define==='function'&&define.amd){define(['moment','jquery','exports'],function(momentjs,$,exports){root.daterangepicker=factory(root,exports,momentjs,$);});}else if(typeof exports!=='undefined'){var momentjs=require('moment');var jQuery=(typeof window!='undefined')?window.jQuery:undefined;if(!jQuery){try{jQuery=require('jquery');if(!jQuery.fn)jQuery.fn={};}catch(err){if(!jQuery)throw new Error('jQuery dependency not found');}}
factory(root,exports,momentjs,jQuery);}else{root.daterangepicker=factory(root,{},root.moment||moment,(root.jQuery||root.Zepto||root.ender||root.$));}}(this||{},function(root,daterangepicker,moment,$){var DateRangePicker=function(element,options,cb){this.parentEl='body';this.element=$(element);this.startDate=moment().startOf('day');this.endDate=moment().endOf('day');this.minDate=false;this.maxDate=false;this.dateLimit=false;this.autoApply=false;this.singleDatePicker=false;this.showDropdowns=false;this.showWeekNumbers=false;this.showISOWeekNumbers=false;this.timePicker=false;this.timePicker24Hour=false;this.timePickerIncrement=1;this.timePickerSeconds=false;this.linkedCalendars=true;this.autoUpdateInput=true;this.alwaysShowCalendars=false;this.ranges={};this.opens='right';if(this.element.hasClass('pull-right'))
this.opens='left';this.drops='down';if(this.element.hasClass('dropup'))
this.drops='up';this.buttonClasses='btn btn-sm';this.applyClass='btn-success';this.cancelClass='btn-default';this.locale={format:'YYYY/MM/DD',separator:' - ',applyLabel:'确定',cancelLabel:'取消',weekLabel:'W',customRangeLabel:'自定义',daysOfWeek:moment.weekdaysMin(),monthNames:moment.monthsShort(),firstDay:moment.localeData().firstDayOfWeek(),daysOfWeek:["日","一","二","三","四","五","六"],monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"]};this.callback=function(){};this.isShowing=false;this.leftCalendar={};this.rightCalendar={};if(typeof options!=='object'||options===null)
options={};options=$.extend(this.element.data(),options);if(typeof options.template!=='string'&&!(options.template instanceof $))
options.template='<div class="daterangepicker dropdown-menu">'+
'<div class="ranges">'+
'</div>'+
'<div class="calendar left">'+
'<div class="prev_year"><i class="icon iconfont icon-shuangxian-zuojiantou"></i></div>'+
'<div class="calendar-table">'+
'</div>'+
'</div>'+
'<div class="calendar right">'+
'<div class="prev_month"><i class="icon iconfont icon-shuangxian-youjiantou"></i></div>'+
'<div class="calendar-table"></div>'+
'</div>'+
'<div class="calendar calendar_1">'+
'<div class="daterangepicker_input">'+
'<input class="input-mini" type="text" name="daterangepicker_start" value="" />'+
'<div class="calendar-time">'+
'<div></div>'+
'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="calendar calendar_2">'+
'<div class="daterangepicker_input">'+
'<input class="input-mini" type="text" name="daterangepicker_end" value="" />'+
'<div class="calendar-time">'+
'<div></div>'+
'<i class="fa fa-clock-o glyphicon glyphicon-time"></i>'+
'</div>'+
'</div>'+
'</div>'+
'<div class="ranges ranges_1">'+
'<div class="range_inputs">'+
'<button class="applyBtn" disabled="disabled" type="button"></button> '+
'<button class="cancelBtn" type="button"></button>'+
'</div>'+
'</div>'+
'<div class="line_date"></div>'+
'<div class="line_date_2"></div>'+
'<div class="all">全部日期</div>'+
'</div>';this.parentEl=(options.parentEl&&$(options.parentEl).length)?$(options.parentEl):$(this.parentEl);this.container=$(options.template).appendTo(this.parentEl);if(typeof options.locale==='object'){if(typeof options.locale.format==='string')
this.locale.format=options.locale.format;if(typeof options.locale.separator==='string')
this.locale.separator=options.locale.separator;if(typeof options.locale.daysOfWeek==='object')
this.locale.daysOfWeek=options.locale.daysOfWeek.slice();if(typeof options.locale.monthNames==='object')
this.locale.monthNames=options.locale.monthNames.slice();if(typeof options.locale.firstDay==='number')
this.locale.firstDay=options.locale.firstDay;if(typeof options.locale.applyLabel==='string')
this.locale.applyLabel=options.locale.applyLabel;if(typeof options.locale.cancelLabel==='string')
this.locale.cancelLabel=options.locale.cancelLabel;if(typeof options.locale.weekLabel==='string')
this.locale.weekLabel=options.locale.weekLabel;if(typeof options.locale.customRangeLabel==='string')
this.locale.customRangeLabel=options.locale.customRangeLabel;}
if(typeof options.startDate==='string')
this.startDate=moment(options.startDate,this.locale.format);if(typeof options.endDate==='string')
this.endDate=moment(options.endDate,this.locale.format);if(typeof options.minDate==='string')
this.minDate=moment(options.minDate,this.locale.format);if(typeof options.maxDate==='string')
this.maxDate=moment(options.maxDate,this.locale.format);if(typeof options.startDate==='object')
this.startDate=moment(options.startDate);if(typeof options.endDate==='object')
this.endDate=moment(options.endDate);if(typeof options.minDate==='object')
this.minDate=moment(options.minDate);if(typeof options.maxDate==='object')
this.maxDate=moment(options.maxDate);if(this.minDate&&this.startDate.isBefore(this.minDate))
this.startDate=this.minDate.clone();if(this.maxDate&&this.endDate.isAfter(this.maxDate))
this.endDate=this.maxDate.clone();if(typeof options.applyClass==='string')
this.applyClass=options.applyClass;if(typeof options.cancelClass==='string')
this.cancelClass=options.cancelClass;if(typeof options.dateLimit==='object')
this.dateLimit=options.dateLimit;if(typeof options.opens==='string')
this.opens=options.opens;if(typeof options.drops==='string')
this.drops=options.drops;if(typeof options.showWeekNumbers==='boolean')
this.showWeekNumbers=options.showWeekNumbers;if(typeof options.showISOWeekNumbers==='boolean')
this.showISOWeekNumbers=options.showISOWeekNumbers;if(typeof options.buttonClasses==='string')
this.buttonClasses=options.buttonClasses;if(typeof options.buttonClasses==='object')
this.buttonClasses=options.buttonClasses.join(' ');if(typeof options.showDropdowns==='boolean')
this.showDropdowns=options.showDropdowns;if(typeof options.singleDatePicker==='boolean'){this.singleDatePicker=options.singleDatePicker;if(this.singleDatePicker)
this.endDate=this.startDate.clone();}
if(typeof options.timePicker==='boolean')
this.timePicker=options.timePicker;if(typeof options.timePickerSeconds==='boolean')
this.timePickerSeconds=options.timePickerSeconds;if(typeof options.timePickerIncrement==='number')
this.timePickerIncrement=options.timePickerIncrement;if(typeof options.timePicker24Hour==='boolean')
this.timePicker24Hour=options.timePicker24Hour;if(typeof options.autoApply==='boolean')
this.autoApply=options.autoApply;if(typeof options.autoUpdateInput==='boolean')
this.autoUpdateInput=options.autoUpdateInput;if(typeof options.linkedCalendars==='boolean')
this.linkedCalendars=options.linkedCalendars;if(typeof options.isInvalidDate==='function')
this.isInvalidDate=options.isInvalidDate;if(typeof options.alwaysShowCalendars==='boolean')
this.alwaysShowCalendars=options.alwaysShowCalendars;if(this.locale.firstDay!=0){var iterator=this.locale.firstDay;while(iterator>0){this.locale.daysOfWeek.push(this.locale.daysOfWeek.shift());iterator--;}}
var start,end,range;if(typeof options.startDate==='undefined'&&typeof options.endDate==='undefined'){if($(this.element).is('input[type=text]')){var val=$(this.element).val(),split=val.split(this.locale.separator);start=end=null;if(split.length==2){start=moment(split[0],this.locale.format);end=moment(split[1],this.locale.format);}else if(this.singleDatePicker&&val!==""){start=moment(val,this.locale.format);end=moment(val,this.locale.format);}
if(start!==null&&end!==null){this.setStartDate(start);this.setEndDate(end);}}}
if(typeof options.ranges==='object'){for(range in options.ranges){if(typeof options.ranges[range][0]==='string')
start=moment(options.ranges[range][0],this.locale.format);else
start=moment(options.ranges[range][0]);if(typeof options.ranges[range][1]==='string')
end=moment(options.ranges[range][1],this.locale.format);else
end=moment(options.ranges[range][1]);if(this.minDate&&start.isBefore(this.minDate))
start=this.minDate.clone();var maxDate=this.maxDate;if(this.dateLimit&&start.clone().add(this.dateLimit).isAfter(maxDate))
maxDate=start.clone().add(this.dateLimit);if(maxDate&&end.isAfter(maxDate))
end=maxDate.clone();if((this.minDate&&end.isBefore(this.minDate))||(maxDate&&start.isAfter(maxDate)))
continue;var elem=document.createElement('textarea');elem.innerHTML=range;var rangeHtml=elem.value;this.ranges[rangeHtml]=[start,end];}
var list='<ul>';for(range in this.ranges){list+='<li>'+range+'</li>';}
list+='</ul>';this.container.find('.ranges').prepend(list);}
if(typeof cb==='function'){this.callback=cb;}
if(!this.timePicker){this.startDate=this.startDate.startOf('day');this.endDate=this.endDate.endOf('day');this.container.find('.calendar-time').hide();}
if(this.timePicker&&this.autoApply)
this.autoApply=false;if(this.autoApply&&typeof options.ranges!=='object'){this.container.find('.ranges').hide();}else if(this.autoApply){this.container.find('.applyBtn, .cancelBtn').addClass('hide');}
if(this.singleDatePicker){this.container.addClass('single');this.container.find('.calendar.left').addClass('single');this.container.find('.calendar.left').show();this.container.find('.calendar.right').hide();this.container.find('.daterangepicker_input input, .daterangepicker_input i').hide();if(!this.timePicker){this.container.find('.ranges').hide();}}
if((typeof options.ranges==='undefined'&&!this.singleDatePicker)||this.alwaysShowCalendars){this.container.addClass('show-calendar');}
this.container.addClass('opens'+this.opens);if(typeof options.ranges!=='undefined'&&this.opens=='right'){var ranges=this.container.find('.ranges');var html=ranges.clone();ranges.remove();this.container.find('.calendar.left').parent().prepend(html);}
this.container.find('.applyBtn, .cancelBtn').addClass(this.buttonClasses);if(this.applyClass.length)
this.container.find('.applyBtn').addClass(this.applyClass);if(this.cancelClass.length)
this.container.find('.cancelBtn').addClass(this.cancelClass);this.container.find('.applyBtn').html(this.locale.applyLabel);this.container.find('.cancelBtn').html(this.locale.cancelLabel);this.container.find('.calendar').on('click.daterangepicker','.prev',$.proxy(this.clickPrev,this)).on('click.daterangepicker','.next',$.proxy(this.clickNext,this)).on('click.daterangepicker','.prev_year',$.proxy(this.clickPrevYear,this)).on('click.daterangepicker','.prev_month',$.proxy(this.clickNextYear,this)).on('click.daterangepicker','td.available',$.proxy(this.clickDate,this)).on('mouseenter.daterangepicker','td.available',$.proxy(this.hoverDate,this)).on('mouseleave.daterangepicker','td.available',$.proxy(this.updateFormInputs,this)).on('change.daterangepicker','select.yearselect',$.proxy(this.monthOrYearChanged,this)).on('change.daterangepicker','select.monthselect',$.proxy(this.monthOrYearChanged,this)).on('change.daterangepicker','select.hourselect,select.minuteselect,select.secondselect,select.ampmselect',$.proxy(this.timeChanged,this)).on('click.daterangepicker','.daterangepicker_input input',$.proxy(this.showCalendars,this)).on('change.daterangepicker','.daterangepicker_input input',$.proxy(this.formInputsChanged,this));this.container.find('.ranges').on('click.daterangepicker','button.applyBtn',$.proxy(this.clickApply,this)).on('click.daterangepicker','button.cancelBtn',$.proxy(this.clickCancel,this)).on('click.daterangepicker','li',$.proxy(this.clickRange,this))
if(this.element.is('input')){this.element.on({'click.daterangepicker':$.proxy(this.show,this),'focus.daterangepicker':$.proxy(this.show,this),'keyup.daterangepicker':$.proxy(this.elementChanged,this),'keydown.daterangepicker':$.proxy(this.keydown,this)});}else{this.element.on('click.daterangepicker',$.proxy(this.toggle,this));}
if(this.element.is('input')&&!this.singleDatePicker&&this.autoUpdateInput){this.element.val(this.startDate.format(this.locale.format)+this.locale.separator+this.endDate.format(this.locale.format));this.element.trigger('change');}else if(this.element.is('input')&&this.autoUpdateInput){this.element.val(this.startDate.format(this.locale.format));this.element.trigger('change');}};DateRangePicker.prototype={constructor:DateRangePicker,setStartDate:function(startDate){if(typeof startDate==='string')
this.startDate=moment(startDate,this.locale.format);if(typeof startDate==='object')
this.startDate=moment(startDate);if(!this.timePicker)
this.startDate=this.startDate.startOf('day');if(this.timePicker&&this.timePickerIncrement)
this.startDate.minute(Math.round(this.startDate.minute()/this.timePickerIncrement)*this.timePickerIncrement);if(this.minDate&&this.startDate.isBefore(this.minDate))
this.startDate=this.minDate;if(this.maxDate&&this.startDate.isAfter(this.maxDate))
this.startDate=this.maxDate;if(!this.isShowing)
this.updateElement();this.updateMonthsInView();},setEndDate:function(endDate){if(typeof endDate==='string')
this.endDate=moment(endDate,this.locale.format);if(typeof endDate==='object')
this.endDate=moment(endDate);if(!this.timePicker)
this.endDate=this.endDate.endOf('day');if(this.timePicker&&this.timePickerIncrement)
this.endDate.minute(Math.round(this.endDate.minute()/this.timePickerIncrement)*this.timePickerIncrement);if(this.endDate.isBefore(this.startDate))
this.endDate=this.startDate.clone();if(this.maxDate&&this.endDate.isAfter(this.maxDate))
this.endDate=this.maxDate;if(this.dateLimit&&this.startDate.clone().add(this.dateLimit).isBefore(this.endDate))
this.endDate=this.startDate.clone().add(this.dateLimit);this.previousRightTime=this.endDate.clone();if(!this.isShowing)
this.updateElement();this.updateMonthsInView();},isInvalidDate:function(){return false;},updateView:function(){if(this.timePicker){this.renderTimePicker('left');this.renderTimePicker('right');if(!this.endDate){this.container.find('.right .calendar-time select').attr('disabled','disabled').addClass('disabled');}else{this.container.find('.right .calendar-time select').removeAttr('disabled').removeClass('disabled');}}
if(this.endDate){this.container.find('input[name="daterangepicker_end"]').removeClass('active');this.container.find('input[name="daterangepicker_start"]').addClass('active');}else{this.container.find('input[name="daterangepicker_end"]').addClass('active');this.container.find('input[name="daterangepicker_start"]').removeClass('active');}
this.updateMonthsInView();this.updateCalendars();this.updateFormInputs();},updateMonthsInView:function(){if(this.endDate){if(!this.singleDatePicker&&this.leftCalendar.month&&this.rightCalendar.month&&(this.startDate.format('YYYY-MM')==this.leftCalendar.month.format('YYYY-MM')||this.startDate.format('YYYY-MM')==this.rightCalendar.month.format('YYYY-MM'))&&(this.endDate.format('YYYY-MM')==this.leftCalendar.month.format('YYYY-MM')||this.endDate.format('YYYY-MM')==this.rightCalendar.month.format('YYYY-MM'))){return;}
this.leftCalendar.month=this.startDate.clone().date(2);if(!this.linkedCalendars&&(this.endDate.month()!=this.startDate.month()||this.endDate.year()!=this.startDate.year())){this.rightCalendar.month=this.endDate.clone().date(2);}else{this.rightCalendar.month=this.startDate.clone().date(2).add(1,'month');}}else{if(this.leftCalendar.month.format('YYYY-MM')!=this.startDate.format('YYYY-MM')&&this.rightCalendar.month.format('YYYY-MM')!=this.startDate.format('YYYY-MM')){this.leftCalendar.month=this.startDate.clone().date(2);this.rightCalendar.month=this.startDate.clone().date(2).add(1,'month');}}},updateCalendars:function(){if(this.timePicker){var hour,minute,second;if(this.endDate){hour=parseInt(this.container.find('.left .hourselect').val(),10);minute=parseInt(this.container.find('.left .minuteselect').val(),10);second=this.timePickerSeconds?parseInt(this.container.find('.left .secondselect').val(),10):0;if(!this.timePicker24Hour){var ampm=this.container.find('.left .ampmselect').val();if(ampm==='PM'&&hour<12)
hour+=12;if(ampm==='AM'&&hour===12)
hour=0;}}else{hour=parseInt(this.container.find('.right .hourselect').val(),10);minute=parseInt(this.container.find('.right .minuteselect').val(),10);second=this.timePickerSeconds?parseInt(this.container.find('.right .secondselect').val(),10):0;if(!this.timePicker24Hour){var ampm=this.container.find('.right .ampmselect').val();if(ampm==='PM'&&hour<12)
hour+=12;if(ampm==='AM'&&hour===12)
hour=0;}}
this.leftCalendar.month.hour(hour).minute(minute).second(second);this.rightCalendar.month.hour(hour).minute(minute).second(second);}
this.renderCalendar('left');this.renderCalendar('right');this.container.find('.ranges li').removeClass('active');if(this.endDate==null)return;this.calculateChosenLabel();},renderCalendar:function(side){var calendar=side=='left'?this.leftCalendar:this.rightCalendar;var month=calendar.month.month();var year=calendar.month.year();var hour=calendar.month.hour();var minute=calendar.month.minute();var second=calendar.month.second();var daysInMonth=moment([year,month]).daysInMonth();var firstDay=moment([year,month,1]);var lastDay=moment([year,month,daysInMonth]);var lastMonth=moment(firstDay).subtract(1,'month').month();var lastYear=moment(firstDay).subtract(1,'month').year();var daysInLastMonth=moment([lastYear,lastMonth]).daysInMonth();var dayOfWeek=firstDay.day();var calendar=[];calendar.firstDay=firstDay;calendar.lastDay=lastDay;for(var i=0;i<6;i++){calendar[i]=[];}
var startDay=daysInLastMonth-dayOfWeek+this.locale.firstDay+1;if(startDay>daysInLastMonth)
startDay-=7;if(dayOfWeek==this.locale.firstDay)
startDay=daysInLastMonth-6;var curDate=moment([lastYear,lastMonth,startDay,12,minute,second]);var col,row;for(var i=0,col=0,row=0;i<42;i++,col++,curDate=moment(curDate).add(24,'hour')){if(i>0&&col%7===0){col=0;row++;}
calendar[row][col]=curDate.clone().hour(hour).minute(minute).second(second);curDate.hour(12);if(this.minDate&&calendar[row][col].format('YYYY/MM/DD')==this.minDate.format('YYYY/MM/DD')&&calendar[row][col].isBefore(this.minDate)&&side=='left'){calendar[row][col]=this.minDate.clone();}
if(this.maxDate&&calendar[row][col].format('YYYY/MM/DD')==this.maxDate.format('YYYY/MM/DD')&&calendar[row][col].isAfter(this.maxDate)&&side=='right'){calendar[row][col]=this.maxDate.clone();}}
if(side=='left'){this.leftCalendar.calendar=calendar;}else{this.rightCalendar.calendar=calendar;}
var minDate=side=='left'?this.minDate:this.startDate;var maxDate=this.maxDate;var selected=side=='left'?this.startDate:this.endDate;var html='<table class="table-condensed">';html+='<thead>';html+='<tr>';if(this.showWeekNumbers||this.showISOWeekNumbers)
html+='<th></th>';if((!minDate||minDate.isBefore(calendar.firstDay))&&(!this.linkedCalendars||side=='left')){html+='<th class="prev available"><i class="icon iconfont icon-danxian-zuojiantou glyphicon"></i></th>';}else{html+='<th></th>';}
var dateHtml=calendar[1][1].format("YYYY")+'年'+calendar[1][1].format("MM")+'月';if(this.showDropdowns){var currentMonth=calendar[1][1].month();var currentYear=calendar[1][1].year();var maxYear=(maxDate&&maxDate.year())||(currentYear+5);var minYear=(minDate&&minDate.year())||(currentYear-50);var inMinYear=currentYear==minYear;var inMaxYear=currentYear==maxYear;var monthHtml='<select class="monthselect">';for(var m=0;m<12;m++){if((!inMinYear||m>=minDate.month())&&(!inMaxYear||m<=maxDate.month())){monthHtml+="<option value='"+m+"'"+
(m===currentMonth?" selected='selected'":"")+
">"+this.locale.monthNames[m]+"</option>";}else{monthHtml+="<option value='"+m+"'"+
(m===currentMonth?" selected='selected'":"")+
" disabled='disabled'>"+this.locale.monthNames[m]+"</option>";}}
monthHtml+="</select>";var yearHtml='<select class="yearselect">';for(var y=minYear;y<=maxYear;y++){yearHtml+='<option value="'+y+'"'+
(y===currentYear?' selected="selected"':'')+
'>'+y+'</option>';}
yearHtml+='</select>';dateHtml=yearHtml+monthHtml;}
html+='<th colspan="5" class="month">'+dateHtml+'</th>';if((!maxDate||maxDate.isAfter(calendar.lastDay))&&(!this.linkedCalendars||side=='right'||this.singleDatePicker)){html+='<th class="next available"><i class="icon iconfont icon-danxian-youjiantou glyphicon"></i></th>';}else{html+='<th></th>';}
html+='</tr>';html+='<tr>';if(this.showWeekNumbers||this.showISOWeekNumbers)
html+='<th class="week">'+this.locale.weekLabel+'</th>';$.each(this.locale.daysOfWeek,function(index,dayOfWeek){html+='<th>'+dayOfWeek+'</th>';});html+='</tr>';html+='</thead>';html+='<tbody>';if(this.endDate==null&&this.dateLimit){var maxLimit=this.startDate.clone().add(this.dateLimit).endOf('day');if(!maxDate||maxLimit.isBefore(maxDate)){maxDate=maxLimit;}}
for(var row=0;row<6;row++){html+='<tr>';if(this.showWeekNumbers)
html+='<td class="week">'+calendar[row][0].week()+'</td>';else if(this.showISOWeekNumbers)
html+='<td class="week">'+calendar[row][0].isoWeek()+'</td>';for(var col=0;col<7;col++){var classes=[];if(calendar[row][col].isSame(new Date(),"day"))
classes.push('today');if(calendar[row][col].isoWeekday()>5)
classes.push('weekend');if(calendar[row][col].month()!=calendar[1][1].month())
classes.push('off');if(this.minDate&&calendar[row][col].isBefore(this.minDate,'day'))
classes.push('off','disabled');if(maxDate&&calendar[row][col].isAfter(maxDate,'day'))
classes.push('off','disabled');if(this.isInvalidDate(calendar[row][col]))
classes.push('off','disabled');if(calendar[row][col].format('YYYY/MM/DD')==this.startDate.format('YYYY/MM/DD'))
classes.push('active','start-date');if(this.endDate!=null&&calendar[row][col].format('YYYY/MM/DD')==this.endDate.format('YYYY/MM/DD'))
classes.push('active','end-date');if(this.endDate!=null&&calendar[row][col]>this.startDate&&calendar[row][col]<this.endDate)
classes.push('in-range');var cname='',disabled=false;for(var i=0;i<classes.length;i++){cname+=classes[i]+' ';if(classes[i]=='disabled')
disabled=true;}
if(!disabled)
cname+='available';html+='<td class="'+cname.replace(/^\s+|\s+$/g,'')+'" data-title="'+'r'+row+'c'+col+'">'+calendar[row][col].date()+'</td>';}
html+='</tr>';}
html+='</tbody>';html+='</table>';this.container.find('.calendar.'+side+' .calendar-table').html(html);},renderTimePicker:function(side){var html,selected,minDate,maxDate=this.maxDate;if(this.dateLimit&&(!this.maxDate||this.startDate.clone().add(this.dateLimit).isAfter(this.maxDate)))
maxDate=this.startDate.clone().add(this.dateLimit);if(side=='left'){selected=this.startDate.clone();minDate=this.minDate;}else if(side=='right'){selected=this.endDate?this.endDate.clone():this.previousRightTime.clone();minDate=this.startDate;var timeSelector=this.container.find('.calendar.right .calendar-time div');if(timeSelector.html()!=''){selected.hour(timeSelector.find('.hourselect option:selected').val()||selected.hour());selected.minute(timeSelector.find('.minuteselect option:selected').val()||selected.minute());selected.second(timeSelector.find('.secondselect option:selected').val()||selected.second());if(!this.timePicker24Hour){var ampm=timeSelector.find('.ampmselect option:selected').val();if(ampm==='PM'&&selected.hour()<12)
selected.hour(selected.hour()+12);if(ampm==='AM'&&selected.hour()===12)
selected.hour(0);}
if(selected.isBefore(this.startDate))
selected=this.startDate.clone();if(selected.isAfter(maxDate))
selected=maxDate.clone();}}
html='<select class="hourselect">';var start=this.timePicker24Hour?0:1;var end=this.timePicker24Hour?23:12;for(var i=start;i<=end;i++){var i_in_24=i;if(!this.timePicker24Hour)
i_in_24=selected.hour()>=12?(i==12?12:i+12):(i==12?0:i);var time=selected.clone().hour(i_in_24);var disabled=false;if(minDate&&time.minute(59).isBefore(minDate))
disabled=true;if(maxDate&&time.minute(0).isAfter(maxDate))
disabled=true;if(i_in_24==selected.hour()&&!disabled){html+='<option value="'+i+'" selected="selected">'+i+'</option>';}else if(disabled){html+='<option value="'+i+'" disabled="disabled" class="disabled">'+i+'</option>';}else{html+='<option value="'+i+'">'+i+'</option>';}}
html+='</select> ';html+=': <select class="minuteselect">';for(var i=0;i<60;i+=this.timePickerIncrement){var padded=i<10?'0'+i:i;var time=selected.clone().minute(i);var disabled=false;if(minDate&&time.second(59).isBefore(minDate))
disabled=true;if(maxDate&&time.second(0).isAfter(maxDate))
disabled=true;if(selected.minute()==i&&!disabled){html+='<option value="'+i+'" selected="selected">'+padded+'</option>';}else if(disabled){html+='<option value="'+i+'" disabled="disabled" class="disabled">'+padded+'</option>';}else{html+='<option value="'+i+'">'+padded+'</option>';}}
html+='</select> ';if(this.timePickerSeconds){html+=': <select class="secondselect">';for(var i=0;i<60;i++){var padded=i<10?'0'+i:i;var time=selected.clone().second(i);var disabled=false;if(minDate&&time.isBefore(minDate))
disabled=true;if(maxDate&&time.isAfter(maxDate))
disabled=true;if(selected.second()==i&&!disabled){html+='<option value="'+i+'" selected="selected">'+padded+'</option>';}else if(disabled){html+='<option value="'+i+'" disabled="disabled" class="disabled">'+padded+'</option>';}else{html+='<option value="'+i+'">'+padded+'</option>';}}
html+='</select> ';}
if(!this.timePicker24Hour){html+='<select class="ampmselect">';var am_html='';var pm_html='';if(minDate&&selected.clone().hour(12).minute(0).second(0).isBefore(minDate))
am_html=' disabled="disabled" class="disabled"';if(maxDate&&selected.clone().hour(0).minute(0).second(0).isAfter(maxDate))
pm_html=' disabled="disabled" class="disabled"';if(selected.hour()>=12){html+='<option value="AM"'+am_html+'>AM</option><option value="PM" selected="selected"'+pm_html+'>PM</option>';}else{html+='<option value="AM" selected="selected"'+am_html+'>AM</option><option value="PM"'+pm_html+'>PM</option>';}
html+='</select>';}
this.container.find('.calendar.'+side+' .calendar-time div').html(html);},updateFormInputs:function(){this.container.find('input[name=daterangepicker_start]').val(this.startDate.format(this.locale.format));this.container.find('input[name=daterangepicker_end]').val(this.startDate.format(this.locale.format));if(this.endDate)
this.container.find('input[name=daterangepicker_end]').val(this.endDate.format(this.locale.format));if(this.singleDatePicker||(this.endDate&&(this.startDate.isBefore(this.endDate)||this.startDate.isSame(this.endDate)))){this.container.find('button.applyBtn').removeAttr('disabled');}else{this.container.find('button.applyBtn').removeAttr('disabled');}},move:function(){var parentOffset={top:0,left:0},containerTop;var parentRightEdge=$(window).width();if(!this.parentEl.is('body')){parentOffset={top:this.parentEl.offset().top-this.parentEl.scrollTop(),left:this.parentEl.offset().left-this.parentEl.scrollLeft()};parentRightEdge=this.parentEl[0].clientWidth+this.parentEl.offset().left;}
if(this.drops=='up')
containerTop=this.element.offset().top-this.container.outerHeight()-parentOffset.top;else
containerTop=this.element.offset().top+this.element.outerHeight()-parentOffset.top;this.container[this.drops=='up'?'addClass':'removeClass']('dropup');if(this.opens=='left'){this.container.css({top:containerTop,right:parentRightEdge-this.element.offset().left-this.element.outerWidth(),left:'auto'});if(this.container.offset().left<0){this.container.css({right:'auto',left:9});}}else if(this.opens=='center'){this.container.css({top:containerTop,left:this.element.offset().left-parentOffset.left+this.element.outerWidth()/2
-this.container.outerWidth()/2,right:'auto'});if(this.container.offset().left<0){this.container.css({right:'auto',left:9});}}else{this.container.css({top:containerTop,left:this.element.offset().left-parentOffset.left,right:'auto'});if(this.container.offset().left+this.container.outerWidth()>$(window).width()){this.container.css({left:'auto',right:0});}}},show:function(e){if(this.isShowing)return;this._outsideClickProxy=$.proxy(function(e){this.outsideClick(e);},this);$(document).on('mousedown.daterangepicker',this._outsideClickProxy).on('touchend.daterangepicker',this._outsideClickProxy).on('click.daterangepicker','[data-toggle=dropdown]',this._outsideClickProxy).on('focusin.daterangepicker',this._outsideClickProxy);$(window).on('resize.daterangepicker',$.proxy(function(e){this.move(e);},this));this.oldStartDate=this.startDate.clone();this.updateView();this.container.show();this.move();this.element.trigger('show.daterangepicker',this);this.isShowing=true;if($('#daterange-btn span').html()=='全部'){$('.calendar').find('.active').removeClass('active');$('.calendar').find('.in-range').removeClass('in-range');}},hide:function(e){if(!this.isShowing){return};if(this.startDate&&!this.endDate){$('#daterange-btn span').html(this.container.find('input[name=daterangepicker_start]').val());this.callback(this.startDate,this.endDate,this.chosenLabel);this.updateElement();$(document).off('.daterangepicker');$(window).off('.daterangepicker');this.container.hide();this.element.trigger('hide.daterangepicker',this);this.isShowing=false;}else{if(!this.startDate.isSame(this.oldStartDate)||!this.endDate.isSame(this.oldEndDate)){this.callback(this.startDate,this.endDate,this.chosenLabel);}
this.updateElement();$(document).off('.daterangepicker');$(window).off('.daterangepicker');this.container.hide();this.element.trigger('hide.daterangepicker',this);this.isShowing=false;}},toggle:function(e){if(this.isShowing){this.hide();}else{this.show();}},outsideClick:function(e){var target=$(e.target);if(e.type=="focusin"||target.closest(this.element).length||target.closest(this.container).length||target.closest('.calendar-table').length)return;this.hide();},showCalendars:function(){this.container.addClass('show-calendar');this.move();this.element.trigger('showCalendar.daterangepicker',this);},hideCalendars:function(){this.container.removeClass('show-calendar');this.element.trigger('hideCalendar.daterangepicker',this);},hoverRange:function(e){if(this.container.find('input[name=daterangepicker_start]').is(":focus")||this.container.find('input[name=daterangepicker_end]').is(":focus"))
return;var label=e.target.innerHTML;if(label==this.locale.customRangeLabel){this.updateView();}else{}},clickRange:function(e){var label=e.target.innerHTML;this.chosenLabel=label;if(label==this.locale.customRangeLabel){this.showCalendars();}else{var dates=this.ranges[label];this.startDate=dates[0];this.endDate=dates[1];if(!this.timePicker){this.startDate.startOf('day');this.endDate.endOf('day');}
if(!this.alwaysShowCalendars){this.setStartDate(this.startDate);this.setEndDate(this.endDate);this.updateCalendars();this.renderCalendar('left');this.renderCalendar('right');if(label=='全部'){$('.daterangepicker .all').css('display','block');$('.calendar').find('.active').removeClass('active');$('.calendar').find('.in-range').removeClass('in-range');}
else{$('.daterangepicker .all').css('display','none');}
this.updateFormInputs();}}},clickPrev:function(e){var cal=$(e.target).parents('.calendar');if(cal.hasClass('left')){this.leftCalendar.month.subtract(1,'month');if(this.linkedCalendars){this.rightCalendar.month.subtract(1,'month');}}else{this.rightCalendar.month.subtract(1,'month');}
this.updateCalendars();},clickNext:function(e){var cal=$(e.target).parents('.calendar');if(cal.hasClass('left')){this.leftCalendar.month.add(1,'month');}else{this.rightCalendar.month.add(1,'month');if(this.linkedCalendars)
this.leftCalendar.month.add(1,'month');}
this.updateCalendars();},clickPrevYear:function(e){var cal=$(e.target).parents('.calendar');if(cal.hasClass('left')){this.leftCalendar.month.subtract(1,'year');if(this.linkedCalendars){this.rightCalendar.month.subtract(1,'year');}}else{this.rightCalendar.month.subtract(1,'year');}
this.updateCalendars();},clickNextYear:function(e){var cal=$(e.target).parents('.calendar');if(cal.hasClass('left')){this.leftCalendar.month.add(1,'year');}else{this.rightCalendar.month.add(1,'year');if(this.linkedCalendars)
this.leftCalendar.month.add(1,'year');}
this.updateCalendars();},hoverDate:function(e){},clickDate:function(e){if(!$(e.target).hasClass('available'))return;var title=$(e.target).attr('data-title');var row=title.substr(1,1);var col=title.substr(3,1);var cal=$(e.target).parents('.calendar');var date=cal.hasClass('left')?this.leftCalendar.calendar[row][col]:this.rightCalendar.calendar[row][col];if(this.endDate||date.isBefore(this.startDate,'day')){if(this.timePicker){var hour=parseInt(this.container.find('.left .hourselect').val(),10);if(!this.timePicker24Hour){var ampm=this.container.find('.left .ampmselect').val();if(ampm==='PM'&&hour<12)
hour+=12;if(ampm==='AM'&&hour===12)
hour=0;}
var minute=parseInt(this.container.find('.left .minuteselect').val(),10);var second=this.timePickerSeconds?parseInt(this.container.find('.left .secondselect').val(),10):0;date=date.clone().hour(hour).minute(minute).second(second);}
this.endDate=null;this.setStartDate(date.clone());}else if(!this.endDate&&date.isBefore(this.startDate)){this.setEndDate(this.startDate.clone());}else{if(this.timePicker){var hour=parseInt(this.container.find('.right .hourselect').val(),10);if(!this.timePicker24Hour){var ampm=this.container.find('.right .ampmselect').val();if(ampm==='PM'&&hour<12)
hour+=12;if(ampm==='AM'&&hour===12)
hour=0;}
var minute=parseInt(this.container.find('.right .minuteselect').val(),10);var second=this.timePickerSeconds?parseInt(this.container.find('.right .secondselect').val(),10):0;date=date.clone().hour(hour).minute(minute).second(second);}
this.setEndDate(date.clone());if(this.autoApply){this.calculateChosenLabel();this.clickApply();}}
if(this.singleDatePicker){this.setEndDate(this.startDate);if(!this.timePicker)
this.clickApply();}
this.updateView();},calculateChosenLabel:function(){var customRange=true;var i=0;for(var range in this.ranges){if(this.timePicker){if(this.startDate.isSame(this.ranges[range][0])&&this.endDate.isSame(this.ranges[range][1])){customRange=false;this.chosenLabel=this.container.find('.ranges li:eq('+i+')').addClass('active').html();break;}}else{if(this.startDate.format('YYYY/MM/DD')==this.ranges[range][0].format('YYYY/MM/DD')&&this.endDate.format('YYYY/MM/DD')==this.ranges[range][1].format('YYYY/MM/DD')){customRange=false;this.chosenLabel=this.container.find('.ranges li:eq('+i+')').addClass('active').html();break;}}
i++;}
if(customRange){this.chosenLabel=this.container.find('.ranges li:last').addClass('active').html();this.showCalendars();}},clickApply:function(e){this.element.trigger('apply.daterangepicker',this);this.hide();},clickCancel:function(e){this.element.trigger('cancel.daterangepicker',this);this.updateElement();$(document).off('.daterangepicker');$(window).off('.daterangepicker');this.container.hide();this.element.trigger('hide.daterangepicker',this);this.isShowing=false;},monthOrYearChanged:function(e){var isLeft=$(e.target).closest('.calendar').hasClass('left'),leftOrRight=isLeft?'left':'right',cal=this.container.find('.calendar.'+leftOrRight);var month=parseInt(cal.find('.monthselect').val(),10);var year=cal.find('.yearselect').val();if(!isLeft){if(year<this.startDate.year()||(year==this.startDate.year()&&month<this.startDate.month())){month=this.startDate.month();year=this.startDate.year();}}
if(this.minDate){if(year<this.minDate.year()||(year==this.minDate.year()&&month<this.minDate.month())){month=this.minDate.month();year=this.minDate.year();}}
if(this.maxDate){if(year>this.maxDate.year()||(year==this.maxDate.year()&&month>this.maxDate.month())){month=this.maxDate.month();year=this.maxDate.year();}}
if(isLeft){this.leftCalendar.month.month(month).year(year);if(this.linkedCalendars)
this.rightCalendar.month=this.leftCalendar.month.clone().add(1,'month');}else{this.rightCalendar.month.month(month).year(year);if(this.linkedCalendars)
this.leftCalendar.month=this.rightCalendar.month.clone().subtract(1,'month');}
this.updateCalendars();},timeChanged:function(e){var cal=$(e.target).closest('.calendar'),isLeft=cal.hasClass('left');var hour=parseInt(cal.find('.hourselect').val(),10);var minute=parseInt(cal.find('.minuteselect').val(),10);var second=this.timePickerSeconds?parseInt(cal.find('.secondselect').val(),10):0;if(!this.timePicker24Hour){var ampm=cal.find('.ampmselect').val();if(ampm==='PM'&&hour<12)
hour+=12;if(ampm==='AM'&&hour===12)
hour=0;}
if(isLeft){var start=this.startDate.clone();start.hour(hour);start.minute(minute);start.second(second);this.setStartDate(start);if(this.singleDatePicker){this.endDate=this.startDate.clone();}else if(this.endDate&&this.endDate.format('YYYY/MM/DD')==start.format('YYYY/MM/DD')&&this.endDate.isBefore(start)){this.setEndDate(start.clone());}}else if(this.endDate){var end=this.endDate.clone();end.hour(hour);end.minute(minute);end.second(second);this.setEndDate(end);}
this.updateCalendars();this.updateFormInputs();this.renderTimePicker('left');this.renderTimePicker('right');},formInputsChanged:function(e){var isRight=$(e.target).closest('.calendar').hasClass('right');var start=moment(this.container.find('input[name="daterangepicker_start"]').val(),this.locale.format);var end=moment(this.container.find('input[name="daterangepicker_end"]').val(),this.locale.format);if(start.isValid()&&end.isValid()){if(isRight&&end.isBefore(start))
start=end.clone();this.setStartDate(start);this.setEndDate(end);if(isRight){this.container.find('input[name="daterangepicker_start"]').val(this.startDate.format(this.locale.format));}else{this.container.find('input[name="daterangepicker_end"]').val(this.endDate.format(this.locale.format));}}
this.updateCalendars();if(this.timePicker){this.renderTimePicker('left');this.renderTimePicker('right');}},elementChanged:function(){if(!this.element.is('input'))return;if(!this.element.val().length)return;if(this.element.val().length<this.locale.format.length)return;var dateString=this.element.val().split(this.locale.separator),start=null,end=null;if(dateString.length===2){start=moment(dateString[0],this.locale.format);end=moment(dateString[1],this.locale.format);}
if(this.singleDatePicker||start===null||end===null){start=moment(this.element.val(),this.locale.format);end=start;}
if(!start.isValid()||!end.isValid())return;this.setStartDate(start);this.setEndDate(end);this.updateView();},keydown:function(e){if((e.keyCode===9)||(e.keyCode===13)){this.hide();}},updateElement:function(){if(this.element.is('input')&&!this.singleDatePicker&&this.autoUpdateInput){this.element.val(this.startDate.format(this.locale.format)+this.locale.separator+this.endDate.format(this.locale.format));this.element.trigger('change');}else if(this.element.is('input')&&this.autoUpdateInput){this.element.val(this.startDate.format(this.locale.format));this.element.trigger('change');}},remove:function(){this.container.remove();this.element.off('.daterangepicker');this.element.removeData();}};$.fn.daterangepicker=function(options,callback){this.each(function(){var el=$(this);if(el.data('daterangepicker'))
el.data('daterangepicker').remove();el.data('daterangepicker',new DateRangePicker(el,options,callback));});return this;};return DateRangePicker;}));//自定义js
//为true输出日志
var debug = true;

/**
 * 打印日志
 */
function log(data) {
    if (debug) {
        if (typeof (data) == "object") {
            console.log(JSON.stringify(data)); //console.log(JSON.stringify(data, null, 4));
        } else {
            console.log(data);
        }
    }
}

//animation.css
function animationHover(element, animation) {
    element = $(element);
    element.hover(
        function () {
            element.addClass('animated ' + animation);
        },
        function () {
            //动画完成之前移除class
            window.setTimeout(function () {
                element.removeClass('animated ' + animation);
            }, 2000);
        });
}

//公共配置
$(document).ready(function () {
    //菜单点击
    //J_iframe

    //$(document).pjax('a.J_menuItem', '.J_mainContent');

    //点击左侧菜单栏目
    $(".J_menuItem").on('click', function () {
        var url = $(this).attr('href');
        $("#J_iframe").attr('src', url);
        return false;
    });

    //小提示
    $("[data-toggle='tooltip']").tooltip();

    // MetsiMenu
    $('#side-menu').metisMenu();

    // 打开右侧边栏
    $('.right-sidebar-toggle').click(function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    //固定菜单栏
    $(function () {
        $('.sidebar-collapse').slimScroll({
            height: '100%',
            railOpacity: 0.9,
            alwaysVisible: false
        });
    });

    // 菜单切换
    $('.navbar-minimalize').click(function () {
        $("body").toggleClass("mini-navbar");
        SmoothlyMenu();
    });

    // 侧边栏高度
    function fix_height() {
        var heightWithoutNavbar = $("body > #wrapper").height() - 61;
        $(".sidebard-panel").css("min-height", heightWithoutNavbar + "px");
    }
    fix_height();

    $(window).bind("load resize click scroll", function () {
        if (!$("body").hasClass('body-small')) {
            fix_height();
        }
    });

    //侧边栏滚动
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0 && !$('body').hasClass('fixed-nav')) {
            $('#right-sidebar').addClass('sidebar-top');
        } else {
            $('#right-sidebar').removeClass('sidebar-top');
        }
    });

    $('.full-height-scroll').slimScroll({
        height: '100%'
    });

    $('#side-menu>li').click(function () {
        if ($('body').hasClass('mini-navbar')) {
            NavToggle();
        }
    });
    $('#side-menu>li li a').click(function () {
        if ($(window).width() < 769) {
            NavToggle();
        }
    });

    $('.nav-close').click(NavToggle);

    //ios浏览器兼容性处理
    if (/(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent)) {
        $('#content-main').css('overflow-y', 'auto');
    }

    //选择框效果
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    //bootstrap 下拉选择
    $('.chosen-select').chosen({search_contains: true});

    //默认关闭浏览自带提示
    $("input[type='text']").attr('autocomplete', 'off');

    //授权选择 菜单 checkbox选择
    $('.menu-tree-checkbox li.has_child > span').on('click', function (e) {
        var d = $(this).siblings('ul').is(":visible");
        $(this).siblings('ul').slideToggle('fast');//.siblings('dt').css('background-position','right -40px');
        if (d) {
            console.log($(this).find(">i"));
            //$(this).find(">i").addClass('icon-minus-sign').removeClass('icon-plus-sign');
            $(this).find(">i").addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            $(this).find('>i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            //$(this).find(">i").addClass('icon-plus-sign').removeClass('icon-minus-sign');
        }
        e.stopPropagation();
    });

    $('.menu-tree-checkbox li input[type="checkbox"]').on('click', function (e) {
        var ischecked = $(this).prop('checked');
        $(this).nextAll("ul").find("li input[type='checkbox']").prop("checked", ischecked);
        $(this).parent().parents("li.has_child").find("input[type='checkbox']:first").prop("checked", true);//保证所有低级勾选上

    });

    //表格点击行之后选中+添加颜色

});


//判断窗口是否小于769
$(window).bind("load resize", function () {
    if ($(this).width() < 769) {
        $('body').addClass('mini-navbar');
        // $('.navbar-static-side').fadeIn();
    }
});

function NavToggle() {
    $('.navbar-minimalize').trigger('click');
}

function SmoothlyMenu() {
    if (!$('body').hasClass('mini-navbar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 100);
    } else if ($('body').hasClass('fixed-sidebar')) {
        $('#side-menu').hide();
        setTimeout(
            function () {
                $('#side-menu').fadeIn(500);
            }, 300);
    } else {
        $('#side-menu').removeAttr('style');
    }
}

/**
  * 将form里面的内容序列化成json
  * 相同的checkbox用分号拼接起来
  * @param {dom} 指定的选择器
  * @param {obj} 需要拼接在后面的json对象
  * @method serializeJson
  * */
$.fn.serializeJson = function (otherString) {
    var serializeObj = {},
        array = this.serializeArray();
    $(array).each(function () {
        if (serializeObj[this.name]) {
            serializeObj[this.name] += ';' + this.value;
        } else {
            serializeObj[this.name] = this.value;
        }
    });

    if (otherString != undefined) {
        var otherArray = otherString.split(';');
        $(otherArray).each(function () {
            var otherSplitArray = this.split(':');
            serializeObj[otherSplitArray[0]] = otherSplitArray[1];
        });
    }
    return serializeObj;
};

/**
 * 将josn对象赋值给form
 * @param {dom} 指定的选择器
 * @param {obj} 需要给form赋值的json对象
 * @method serializeJson
 * */
$.fn.setForm = function (jsonValue) {
    var obj = this;
    $.each(jsonValue, function (name, ival) {
        var $oinput = obj.find("input[name=" + name + "]");
        if ($oinput.attr("type") == "checkbox") {
            if (ival !== null) {
                var checkboxObj = $("[name=" + name + "]");
                var checkArray = ival.split(";");
                for (var i = 0; i < checkboxObj.length; i++) {
                    for (var j = 0; j < checkArray.length; j++) {
                        if (checkboxObj[i].value == checkArray[j]) {
                            checkboxObj[i].click();
                        }
                    }
                }
            }
        } else if ($oinput.attr("type") == "radio") {
            $oinput.each(function () {
                var radioObj = $("[name=" + name + "]");
                for (var i = 0; i < radioObj.length; i++) {
                    if (radioObj[i].value == ival) {
                        radioObj[i].click();
                    }
                }
            });
        } else if ($oinput.attr("type") == "textarea") {
            obj.find("[name=" + name + "]").html(ival);
        } else {
            obj.find("[name=" + name + "]").val(ival);
        }
    })
}

/**
 * 操纵toastor的便捷类
 * @type {{success: success, error: error, info: info, warning: warning}}
 */
var toast = {
    /**
     * 成功提示
     * @param text 内容
     * @param title 标题
     */
    success: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success(text, title);
    },
    /**
     * 失败提示
     * @param text 内容
     * @param title 标题
     */
    error: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.error(text, title);
    },
    /**
     * 信息提示
     * @param text 内容
     * @param title 标题
     */
    info: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.info(text, title);
    },
    /**
     * 警告提示
     * @param text 内容
     * @param title 标题
     */
    warning: function (text, title) {

        $(".toast").remove();

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.warning(text, title);
    }
};

/**
 * 搜索表单url
 */
var searchFormUrl = function (obj) {

    var url = $(obj).attr('url');
    var query = $('.search-form').find('input,select').serialize();
    query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g, '');
    query = query.replace(/^&/g, '');
    if (url.indexOf('?') > 0) {
        url += '&' + query;
    } else {
        url += '?' + query;
    }

    return url;
};


//将url转化为json数据
function url2json(url) {
    let arr = []; //存储参数的数组
    let res = {}; //存储最终JSON结果对象
    arr = url.split("?")[1].split("&"); //arr=["a=1", "b=2", "c=test", "d"]

    for (let i = 0, len = arr.length; i < len; i++) {
        //如果有等号，则执行赋值操作
        if (arr[i].indexOf("=") != -1) {
            let str = arr[i].split("=");
            //str=[a,1];
            res[str[0]] = str[1];
        } else {//没有等号，则赋予空值
            res[arr[i]] = "";
        }
    }
    res = JSON.stringify(res);//转化为JSON字符串
    return res; //{"a": "1", "b": "2", "c": "test", "d": ""}
}

//时间格式转换
jQuery.fn.extend(Date.prototype, {
    Format: function (fmt) {
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    },
    /* 给Date的原型添加年运算的方法
* @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
*/
    opYear: function (num) {
        var d = this.getFullYear();
        this.setFullYear(d + num);
        return this;
    },
    /* 给Date的原型添加月运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opMonth: function (num) {
        var d = this.getMonth();
        this.setMonth(d + num);
        return this;
    },
    /* 给Date的原型添加天运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opDay: function (num) {
        var d = this.getDate();
        this.setDate(d + num);
        return this;
    },
    /* 给Date的原型添加分钟运算的方法
    * @param {Object} num  要加减的时间的数量,加时间填正整数，减时间填负整数
    */
    opMinutes: function (num) {
        var d = this.getMinutes();
        this.setMinutes(d + num);
        return this;
    },

    /***参数都是以周一为基准的***/
    //上周的开始时间
    //console.log(getTime(7));
    //上周的结束时间
    //console.log(getTime(1));
    //本周的开始时间
    //console.log(getTime(0));
    //本周的结束时间
    //console.log(getTime(-6));
    getWeekTime: function (n) {
        var year = this.getFullYear();
        //因为月份是从0开始的,所以获取这个月的月份数要加1才行
        var month = this.getMonth() + 1;
        var date = this.getDate();
        var day = this.getDay();
//		console.log(date);
        //判断是否为周日,如果不是的话,就让今天的day-1(例如星期二就是2-1)
        if (day !== 0) {
            n = n + (day - 1);
        } else {
            n = n + day;
        }
        if (day) {
            //这个判断是为了解决跨年的问题
            if (month > 1) {
                month = month;
            } else {
                //这个判断是为了解决跨年的问题,月份是从0开始的
                year = year - 1;
                month = 12;
            }
        }
        this.setDate(this.getDate() - n);
        year = this.getFullYear();
        month = this.getMonth() + 1;
        date = this.getDate();
//		console.log(year+"-"+(month<10?('0'+month):month)+"-"+(date<10?('0'+date):date));
        return year + "-" + (month < 10 ? ('0' + month) : month) + "-" + (date < 10 ? ('0' + date) : date);
    },

    pattern: function (fmt) {
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours() % 24 == 0 ? 24 : this.getHours() % 24, //小时
            "H+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        var week = {
            "0": "/u65e5",
            "1": "/u4e00",
            "2": "/u4e8c",
            "3": "/u4e09",
            "4": "/u56db",
            "5": "/u4e94",
            "6": "/u516d"
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        if (/(E+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "/u661f/u671f" : "/u5468") : "") + week[this.getDay() + ""]);
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    }

});


/**
 * null => ''
 * @param {*} data 要处理的数据
 */
function null2zero(data) {
    for (let x in data) {
        if (data[x] === null) { // 如果是null 把直接内容转为 ''
            data[x] = '0';
        } else {
            if (Array.isArray(data[x])) { // 是数组遍历数组 递归继续处理
                data[x] = data[x].map(z => {
                    return null2zero(z);
                });
            }
            if (typeof (data[x]) === 'object') { // 是json 递归继续处理
                data[x] = null2zero(data[x])
            }
        }
    }
    return data;
}


/*-----页面pannel内容区高度自适应 start-----*/
$(window).resize(function () {
    setCenterHeight();
});
function setCenterHeight() {
    var height = $(window).height();
    var centerHight = height - 40;
    $(".auto-height-box").height(centerHight).css("overflow", "auto");
    $(".auto-height-box").css("background", "#fff");
}
setCenterHeight();//自适应高度
/*-----页面pannel内容区高度自适应 end-----*/

//文字转为图片
function textToImg(str) {
    var name, fsize;
    if (str.length < 2) {
        name = str;
        fsize = 60
    } else {
        if (str.length == 2) {
            name = str.substring(0, str.length);
            fsize = 45
        } else {
            if (str.length == 3) {
                name = str.substring(0, str.length);
                fsize = 30
            } else {
                if (str.length == 4) {
                    name = str.substring(0, str.length);
                    fsize = 25
                } else {
                    if (str.length > 4) {
                        name = str.substring(0, 2);
                        fsize = 45
                    }
                }
            }
        }
    }
    var fontSize = 60;
    var fontWeight = "bold";
    var canvas = document.getElementById("head_canvas_default");
    var img1 = document.getElementById("head_canvas_default");
    canvas.width = 120;
    canvas.height = 120;
    var context = canvas.getContext("2d");
    context.fillStyle = getBG();
    context.fillRect(0, 0, canvas.width, canvas.height);
    context.fillStyle = "#FFF";
    context.font = fontWeight + " " + fsize + "px sans-serif";
    context.textAlign = "center";
    context.textBaseline = "middle";
    context.fillText(name, fontSize, fontSize);
    return canvas.toDataURL("image/png")
}
//随机颜色
function getBG() {
    var bgArray = ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e",
        "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f",
        "#e67e22", "#e74c3c", "#eca0f1", "#95a5a6", "#f39c12", "#d35400",
        "#c0392b", "#bdc3c7", "#7f8c8d"];
    var color = bgArray[Math.floor(Math.random() * bgArray.length)];
    return color
};
// 列表数据列处理
var listAll = [];
if ($('a').is('.btn-field-set')) {
    var showTable = $("a.btn-field-set").attr("data-id");
    listAll = [];//所有字段
    $(".ajax-list-table").find("thead tr th").each(function (e) {
        f_name = $(this).find("span").html();
        if (f_name != null) {
            listAll[e] = f_name;
        }
    });
    //存所有字段
    log(showTable);
    localStorage.setItem("listAll" + showTable, JSON.stringify(listAll));

    //未设置显示全部列
    if (localStorage.getItem("listSave" + showTable) == null) {
        localStorage.setItem("listSave" + showTable, JSON.stringify(listAll));
    }
}

//表格显示列设置,设置列表表格显示列
$("body").on("click", ".btn-field-set", function () {
    var showTable = $("a.btn-field-set").attr("data-id");
    a = JSON.parse(localStorage.getItem("listAll" + showTable));
    b = JSON.parse(localStorage.getItem("listSave" + showTable));
    var listHtml = '';
    listHtml = "<div class='ibox-content row list-all-field' style='width:80%;'>";
    for (var i = 0; i < a.length; i++) {
        if (typeof (a[i]) != "undefined" && a[i] != null) {
            var index = $.inArray(a[i], b);
            if (index >= 0) {
                chk = "checked";
            } else {
                chk = "";
            }
            listHtml += "<div class='col-sm-4'><input type='checkbox' name='listFieldCheckbox' value='" + a[i] + "' " + chk + "> " + a[i] + "</div>";
            log(a[i]);
        }
    }
    listHtml += "</div>";
    var indxe_list_field = layer.open({
        type: 1,
        title: "列表字段设置",
        scrollbar: false,
        skin: 'layui-layer-demo', //加上边框
        area: ['80%', '60%'], //宽高
        content: listHtml,
        btn: ['保存', '取消'],
        yes: function (index, layero) {
            listSave = [];
            $(".list-all-field input[name='listFieldCheckbox']:checked").each(function (e) {
                if (true == $(this).prop("checked")) {
                    value = $(this).prop('value');
                    listSave[e] = value
                }
            });
            localStorage.setItem("listSave" + showTable, JSON.stringify(listSave));
            turnPage(pageNum);
            //事件
            layer.close(indxe_list_field);
        },
        btn2: function (index, layero) {
            layer.close(index)
        }
    });
});

//初始化隐藏表的列
function initTableCell() {
    var colspan = 0;
    $(".ajax-list-table").find("thead tr th").each(function (index) {
        listSave = JSON.parse(localStorage.getItem("listSave" + showTable));
        f_name = $(this).find("span").html();

        var cell = index + 1
        var item = $.inArray(f_name, listSave);
        //log(item);
        if (item >= 0 || typeof (f_name) == 'undefined') {
            var strth = ".ajax-list-table thead tr th:nth-child("
            var strtd = ".ajax-list-table tbody tr td:nth-child("
            $(strtd + cell + ")").show();
            $(strth + cell + ")").show();
            colspan = colspan + 1;
        } else {
            var strth = ".ajax-list-table thead tr th:nth-child("
            var strtd = ".ajax-list-table tbody tr td:nth-child("
            $(strtd + cell + ")").hide();
            $(strth + cell + ")").hide();
        }
    });
    $(".ajax-list-table").find("tfoot tr td").attr('colspan', colspan);//设置分页行的列数合并

    bindClass();
}

/*表格长文字的过滤*/
function filterTd(v) {
    var rstr = '无';
    if (isEmpty(v)) {
        return '无';
    } else {
        rstr = '<div class="MHover">' + v + '</div>' +
            '<div class="MALL">' + v + '</div>';
    }
    return rstr;
}

//绑定鼠标事件
function bindClass() {
    log('bindclsss');
    $(".MALL").hide();
    $(".MHover").mouseover(function (e) {
        var clientWidth=document.body.clientWidth
        var divWidth=clientWidth-e.pageX-45;
        $(this).next(".MALL").css({
            "color": "#ffffff",
            "z-index": "1000",
            "width": divWidth+"px",
            "padding": "1rem",
            "line-height": ": 1.5rem",
            "position": "absolute",
            "opacity": "1",
            "background-color": "#3595CC",
            "top": e.pageY - 50,
            "left": e.pageX
        }).show();
    });
    $(".MHover").mousemove(function (e) {
        var clientWidth=document.body.clientWidth
        var divWidth=clientWidth-e.pageX-45;
        $(this).next(".MALL").css({
            "color": "#ffffff",
            "z-index": "1000",
            "width": divWidth+"px",
            "padding": "1rem",
            "line-height": ": 200",
            "position": "absolute",
            "opacity": "1",
            "background-color": "#3595CC",
            "top": e.pageY - 50,
            "left": e.pageX
        });
    });
    $(".MHover").mouseout(function () {
        $(this).next(".MALL").hide();
    });
}

//点击隐藏区域，显示所有文字
$("body").on("click", ".MHover", function () {
    var msg = $(this).html();
    layer.tips(msg, $(this), {
        tips: [1, '#3595CC'],
        time: 4000
    });
    $(this).prev().hide();
})

//判断字符是否为空的方法
function isEmpty(obj) {
    if (typeof obj == "undefined" || obj == null || obj == "") {
        return true;
    } else {
        return false;
    }
}//查找带回组件
/* 使用方法
标签中设置class属性：
（*）lookup-input-select：绑定事件属性
（*）lookup-group：绑定的区域范围
（*）lookup-fields：查找后选择带回的字段，对应”lookup-group“区域中的input值
（*）lookup-url：查找数据的地址
（-）data-calback：查找选择确定之后，回调执行的函数，此函数一般在模板中用户单独设置
（-）data-calback-url：查找选择确定之后，回调执行的函数，调用的地址

* 模板中调用实例
<div class="purchase_box">
    <input type="hidden" name="purchase_id">
    <input type="text" name="purchase_no" class="form-control" placeholder="选择关联采购申请单" readonly>
    <span class="input-group-btn">
        <button type="button" class="btn btn-default lookup-input-select"
                lookup-group='purchase_box'
                lookup-fields='{"purchase_id":"id","purchase_no":"purchase_no"}'
                lookup-url="{:url('OfsuPurchase/lookup')}"
                data-calback="javascript:lookupAjaxListTable('purchase_box','purchase_id');"
                data-calback-url="{:url('OfsuPurchase/lookup',array('datatype'=>'info'))}"
        >选择
        </button>
    </span>
</div>
*/
var lookupGroupName = ''
var lookupGroupIndex = ''
var lookupGroupFun = ''
$("body").on("click", ".lookup-input-select", function () {
    lookupGroupName = $(this).attr('lookup-group');
    lookupGroupFun = $(this).attr('data-calback');
    log('查找回带区域：' + lookupGroupName);
    log('查找回带函数：' + lookupGroupFun);
    //判断设置的区域组是否存在
    if (typeof (lookupGroupName) == "undefined" || lookupGroupName == '') {
        layer.msg('参数有有错');
        return false;
    } else {
        localStorage.setItem('lookupGroupKey', lookupGroupName)
    }
    //判断地址是否存
    if ((target = $(this).attr('lookup-url'))) {
        //是否带参数字段
        //参数传，支持多个参数传送 格式：lookup-fields="{'tid':'2',''name':'张三'}"
        var ids = $(this).attr('lookup-ids');
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //是否设置了单个值
        var id = $(this).attr("data-id");
        if (typeof (id) != "undefined" && id != 0) {
            var target = target + "?id=" + id;
        }
        log('打开地址：' + target);
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: ['90%', '90%'],
            content: target,
            success: function (layero, index) {
                layer.iframeAuto(index);
                localStorage.setItem('lookupGroupIndex', index);
            },
            end: function () {
                log('关闭弹窗口执行=》start~~~~：');
                if (lookupGroupFun != null) {
                    eval(lookupGroupFun);
                    log('执行回调函数=>end~~~');
                }
            }
        });
    }
    return false;
});

//选择确定=>回示列表
$("body").on("click", ".lookup-bring-select", function () {
    var lookupGroupName = localStorage.getItem('lookupGroupKey');
    var lookupGroupObj = parent.$("." + lookupGroupName + "");
    var lookupInputObj = lookupGroupObj.find(".lookup-input-select");
    var lookupFields = lookupInputObj.attr('lookup-fields');

    log("lookupGroup区域：" + lookupGroupName);

    ////选择回显示字段
    var selectData = $(this).attr('lookup-bring-fields');
    var selectData = JSON.parse(selectData);

    //返回字段
    log("返回字段");
    log(lookupFields);
    var names = JSON.parse(lookupFields);
    $.each(names, function (key, item) {
        log(key + '==>' + item + '=' + selectData[item]);
        lookupGroupObj.find("input[name='" + key + "']").val(selectData[item]);
    });
    //关闭当前窗口
    var index = localStorage.getItem('lookupGroupIndex');
    //var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.layer.close(index);
})


//独立点击清空=清空lookup-group中所有值
$("body").on("click", ".lookup-group-box .clearable", function () {
    log('lookgroup-input 点击清空返回值');
    var object=$(this).parents(".lookup-group-box");
    object.find("input").val('');
});


$(document).ready(function () {


    //销售客户模块部门

    //自动输出=>客户关联 列表数
    $('.chosen-select.customer').each(function () {
        var value = $(this).attr("data-val");
        var target = $(this).attr("data-url");
        findCustomerLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");
    });

    //自动输出=>销售合同(未付款完)=》关联详细数据=>需要收款
    $('.chosen-select.unpaidsalcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findSalContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });

    //自动输出=>销售合同(未开完票)=》关联详细数据=>需要收款
    $('.chosen-select.uninvoicesalcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findSalContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });

    //选择用户=》客户关联（所有关联，联系人，销售合同，发票，） =>r列表数
    $('.chosen-select.customer').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        log(value);
        findCustomerLinkSelect(value, target)
    });

    //选择=>销售合同(所有合同)=》关联详细数据=>所有订单
    $('.chosen-select.salcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findSalContractInfo(value, target, bus_type);
    });

    //选择=>销售合同(未付款完)=》关联详细数据=>未付款
    $('.chosen-select.unpaidsalcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(bus_type);
        findSalContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //选择=>销售合同(未开完票)=》关联详细数据=>需要开票
    $('.chosen-select.uninvoicesalcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(bus_type);
        findSalContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //供应商部分******************************************************************

    //自动输出=》供应商关联=》数据处理
    $('.chosen-select.supplier').each(function () {
        var value = $(this).attr("data-val");
        var target = $(this).attr("data-url");
        log(value);
        findSupplierLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");

    });

    //自动输出=>采购合同(未付款完)=》关联详细数据=》收票
    $('.chosen-select.unpaidposcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type)
    });


    //自动输出=>采购合同(未开完票)=》关联详细数据=>需要收款
    $('.chosen-select.uninvoiceposcontract').each(function () {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        findPosContractInfo(value, target, bus_type);
        $(this).val(value).trigger("chosen:updated");
    });


    //选择供应商=》加载关联=》列表数据
    $('.chosen-select.supplier').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        log(value);
        findSupplierLinkSelect(value, target);
        $(this).val(value).trigger("chosen:updated");
    });

    //选择=>采购合同(未付款完)=》关联详细数据=>未付款
    $('.chosen-select.unpaidposcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

    //选择=>采购合同(未开票)=》关联详细数据=》收票
    $('.chosen-select.uninvoiceposcontract').on('change', function (e, params) {
        var value = $(this).val();
        var target = $(this).attr("data-url");
        var bus_type = $(this).find("option:selected").attr("data-type");
        log(value);
        findPosContractInfo(value, target, bus_type);
        //设置业务类型
        $(this).parents('form').find("input[name='bus_type']").val(bus_type);
    });

});

//选择客户=》回显示关联数据
function findCustomerLinkSelect(cid, target = null) {
    //回显=》联系人
    $('.chosen-select.linkman').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'linkman'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                that.append(html);
                //that.trigger('chosen:updated');
                log(val);
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》销售机会
    $('.chosen-select.chance').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'chance'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》未收款=》销售合同
    $('.chosen-select.unpaidsalcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'unpaidsalcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '"  data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显=》未开票=》销售合同
    $('.chosen-select.uninvoicesalcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"customer_id": cid, "customer_type": 'uninvoicesalcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

}


//供应商选择=》回显示关联信息
function findSupplierLinkSelect(cid, target = null) {
    //回显供应商=》联系人明细
    $('.chosen-select.linkman').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'linkman'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" >' + obj.name + '</option>';
                });
                that.append(html);
                //that.trigger('chosen:updated');
                log(val);
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显示供应商=》未付完款的合同
    $('.chosen-select.unpaidposcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'unpaidposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

    //回显示供应商=》未付完款的合同
    $('.unpaidposcontract-more').each(function () {
        var that = $(this);
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'unpaidposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.find('tbody').empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<tr>';
                    html += '<td><input name="id[]" class="checkboxCtrlId" value="' + obj.id + '" type="checkbox">';
                    html += '<input name="bus_id[]" value="' + obj.id + '" type="hidden">';
                    html += '<input name="bus_type[]" value="' + obj.bus_type + '" type="hidden">';
                    html += '<input name="bus_type_name[]" value="' + obj.bus_type_name + '" type="hidden">';
                    html += '<input name="zero_money[]" value="' + obj.zero_money + '" type="hidden">';
                    html += '<input name="bus_name[]" value="' + obj.name + '" type="hidden">';
                    html += '</td>';
                    html += '<td>' + obj.bus_date + '</td>';
                    html += '<td>' + obj.name + '</td>';
                    html += '<td>' + obj.bus_type_name + '</td>';
                    html += '<td><input name="money[]" value="' + obj.money + '" type="text" class="form-control" readonly></td>';
                    html += '<td><input name="pay_money[]" value="' + obj.pay_money + '" type="text" class="form-control" readonly></td>';
                    html += '<td><input name="invoice_money[]" value="' + obj.invoice_money + '" type="text" class="form-control" readonly></td>';
                    html += '</tr>';
                });
                log(html);
                that.find('tbody').append(html);
            },
            complete: function () {

            }
        });
    });

    //回显示供应商=》未开票完款的合同
    $('.chosen-select.uninvoiceposcontract').each(function () {
        var that = $(this);
        var val = that.attr('data-val');
        $.ajax({
            type: "POST",
            url: target,
            data: {"supplier_id": cid, "supplier_type": 'uninvoiceposcontract'},
            dataType: "json",
            async: false,
            beforeSend: function () {
                that.empty();
            },
            success: function (jsondata) {
                var html = '';
                $.each(jsondata.data, function (idx, obj) {
                    html += '<option value="' + obj.id + '" data-type="' + obj.bus_type + '">' + obj.name + '</option>';
                });
                //log(html);
                that.append(html);
                log(val);
                //that.trigger('chosen:updated');
                that.val(val).trigger("chosen:updated");
            },
            complete: function () {
                that.val(val).trigger("chosen:updated");
            }
        });
    });

}

//采购合同》关联信息
function findPosContractInfo(cid, target = null, bus_type = null) {
    $.ajax({
        type: "POST",
        url: target,
        data: {"id": cid, "bus_type": bus_type},
        dataType: "json",
        async: false,
        success: function (data) {
            //log(data);
            $(".form-horizontal input[name='contract_money']").val(data.money);
            $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
            $(".form-horizontal input[name='contract_pay_money']").val(data.pay_money);
            $(".form-horizontal input[name='contract_owe_money']").val(data.owe_money);
            $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);

            //合同金额-支付金额-去零金额
            var owe_money = BigNumber(data.money).minus(data.pay_money).minus(data.zero_money).toNumber();
            $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
            $(".form-horizontal input[name='pay_money']").val(owe_money);
            $(".form-horizontal input[name='owe_money']").val(0);

        },
        complete: function () {

        }
    });
}

//付款添加=》采购合同金额=》计算器
$("body").on("keyup", ".paycalculate", function () {
    //查询本行的数据
    var contract_owe_money = $(".form-horizontal input[name='contract_owe_money']").val();
    var pay_money = $(".form-horizontal input[name='pay_money']").val();
    var zero_money = $(".form-horizontal input[name='zero_money']").val();

    //计算剩余金额
    var owe_money = BigNumber(contract_owe_money).minus(pay_money).minus(zero_money).toNumber();
    if (owe_money < 0) {
        layer.msg('本次付款的金额和去零金额不能超过 ' + contract_owe_money, {icon: 5});
    }
    $(".form-horizontal input[name='owe_money']").val(owe_money);
    console.log(owe_money);
});


//销售合同》关联信息
function findSalContractInfo(cid, target = null, bus_type = null) {
    $.ajax({
        type: "POST",
        url: target,
        data: {"id": cid, "bus_type": bus_type},
        dataType: "json",
        async: false,
        success: function (data) {
            log(data);
            $(".form-horizontal input[name='contract_money']").val(data.money);
            $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
            $(".form-horizontal input[name='contract_back_money']").val(data.back_money);
            $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);

            //销售金额-回款金额-去零金额
            var owe_money = BigNumber(data.money).minus(data.back_money).minus(data.zero_money).toNumber();
            $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
            $(".form-horizontal input[name='back_money']").val(owe_money);
            $(".form-horizontal input[name='owe_money']").val(0);
        },
        complete: function () {

        }
    });
}

//回款添加=》销售合同金额=》计算器
$("body").on("keyup", ".rececalculate", function () {
    //查询本行的数据
    var contract_owe_money = $(".form-horizontal input[name='contract_owe_money']").val();
    var back_money = $(".form-horizontal input[name='back_money']").val();
    var zero_money = $(".form-horizontal input[name='zero_money']").val();

    var owe_money = BigNumber(contract_owe_money).minus(back_money).minus(zero_money).toNumber();
    if (owe_money < 0) {
        layer.msg('本次付款的金额和去零金额不能超过 ' + contract_owe_money, {icon: 5});
    }
    $(".form-horizontal input[name='owe_money']").val(owe_money);
    console.log(owe_money);
});// var config = {
//     version: '1.0.3',
//     cssAr: [
//         'module/admin/plugin/daterangepicker/static/css/iconfont.css',
//         'module/admin/plugin/daterangepicker/static/css/daterangepicker.css'
//     ],
//     jsAr: [
//         'module/admin/plugin/daterangepicker/static/js/moment.js',
//         'module/admin/plugin/daterangepicker/static/js/daterangepicker.js'
//     ]
// }
//
// function link(cssAr = config.cssAr, type) {
//     for (var i = 0; i < cssAr.length; i++) {
//         document.write('<link rel="stylesheet" href="' + static_root + cssAr[i] + '?version=' + config.version + '"/>');
//     }
// }
//
// function script(jsAr = config.jsAr, type) {
//     for (var i = 0; i < jsAr.length; i++) {
//         document.write('<script src="' + static_root + jsAr[i] + '?version=' + config.version + ' type="text/javascript" charset="utf-8"><\/script>');
//     }
// }
//
// link();
// script();

$(document).ready(function () {

    //双日历函数
    $('.daterange-btn').each(function () {
        daterangeinit($(this));
    });

    //选择后面的时间
    $('.daterange-next').each(function () {
        daterangeinitNext($(this));
    });

    //选择当前前面的时间
    $('.daterange-prev').each(function () {
        daterangeinitPrev($(this));
    });

    $('.daterangepicker-b1').each(function () {
        daterangeinit($(this));
    });



    //未来几天
    function daterangeinit(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    // '今天': [moment(), moment()],
                    // '明天': [moment().subtract(-1, 'days'), moment().subtract(-1, 'days')],
                    '未来七天': [moment(), moment().subtract(-6, 'days')],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '下月': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                    '去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                    // '未来30天': [moment(),moment().subtract(-29, 'days')],
                    // '未来90天': [moment(),moment().subtract(-89, 'days'), ],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '明天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '未来七天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来30天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来60天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来90天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

    //时间后面的
    function daterangeinitNext(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    '今天': [moment(), moment()],
                    '明天': [moment().subtract(-1, 'days'), moment().subtract(-2, 'days')],
                    '未来七天': [moment(), moment().subtract(-6, 'days')],
					'未来30天': [moment(),moment().subtract(-29, 'days')],
					'未来90天': [moment(),moment().subtract(-89, 'days'), ],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '下月': [moment().subtract(-1, 'month').startOf('month'), moment().subtract(-1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '明天') {
                   // object.val(start.format('YYYY/MM/DD'));
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来七天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来30天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来60天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else if (label == '未来90天') {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

    //时间后面的
    function daterangeinitPrev(object) {
        object.daterangepicker({
                "showDropdowns": true,
                "linkedCalendars": false,
                "autoUpdateInput": false,
                ranges: {
                    '今天': [moment(), moment()],
                    '昨天': [moment().subtract(1, 'days'), moment().subtract(2, 'days')],
                    '最近七天': [moment().subtract(6, 'days'),moment()],
                    '最近30天': [moment().subtract(29, 'days'),moment()],
                    '最近90天': [moment().subtract(89, 'days'),moment() ],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '今年': [moment().startOf('year'), moment().endOf('year')],
                },
                "locale": {
                    cancelLabel: "清除",
                },
                startDate: moment(),
                endDate: moment()
            },
            function (start, end, label) {
                //label:通过它来知道用户选择的是什么，传给后台进行相应的展示
                console.log(label)
                if (label == '今天') {
                    object.val(start.format('YYYY/MM/DD'));
                } else if (label == '昨天') {
                     object.val(start.format('YYYY/MM/DD'));
                    //object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                } else {
                    object.val(start.format('YYYY/MM/DD') + '-' + end.format('YYYY/MM/DD'));
                }
            }
        );
        //清空日期
        object.on('cancel.daterangepicker', function (ev, picker) {
            object.val('');
        });
    }

});/**
 * 获取本周、本季度、本月、上月的开始日期、结束日期
 */
var now = new Date(); //当前日期
var nowDayOfWeek = now.getDay(); //今天本周的第几天
var nowDay = now.getDate(); //当前日
var nowMonth = now.getMonth(); //当前月
var nowYear = now.getYear(); //当前年
nowYear += (nowYear < 2000) ? 1900 : 0; //

var lastMonthDate = new Date(); //上月日期
lastMonthDate.setDate(1);
lastMonthDate.setMonth(lastMonthDate.getMonth()-1);
var lastYear = lastMonthDate.getYear();
var lastMonth = lastMonthDate.getMonth();


// 初始化时间插件格式
$(document).ready(function () {

	// //日期选择插件yyyy-mm-dd
	$(".datepicker").datepicker({
		language: "zh-CN",
		minView: 'year',
		todayHighlight: true,
		autoclose: true,//选中之后自动隐藏日期选择框
		clearBtn: true,//清除按钮
		todayBtn: "linked",//今日按钮
		minView: 'day',
		maxView: 2,
		format: "yyyy-mm-dd"
	});

	// //日期时间选择插件 yyyy-mm-dd H:i:s
	$(".datetimepicker").datetimepicker({
		language: "zh-CN",
		autoclose: true,//选中之后自动隐藏日期选择框
		clearBtn: true,//清除按钮
		todayBtn: true,//今日按钮
		format: "yyyy-mm-dd hh:ii:ss",
	});

	// //日期时间选择插件 yyyy-mm-dd H:i:s
	$(".datetimepicker-clock").datetimepicker({
		language: "zh-CN",
		startView: 'day',
		//minView : 'day',
		//maxView:2,
		autoclose: true,//选中之后自动隐藏日期选择框
		clearBtn: true,//清除按钮
		todayBtn: true,//今日按钮
		format: "hh:ii",
	});

	// //日期时间选择插件 yyyy-mm-dd H:i:s
	$(".datetimepicker-now").datetimepicker({
		language: "zh-CN",
		autoclose: true,//选中之后自动隐藏日期选择框
		clearBtn: true,//清除按钮
		todayBtn: true,//今日按钮
		format: "yyyy-mm-dd hh:ii:ss",
		initialDate: new Date(),
	});

	//设置当前时间
	$(".datetimepicker-now").datetimepicker("setDate", new Date())

	//只选择月份
	$('.datepicker-month').datepicker({
		format: 'yyyy-mm',
		language: "zh-CN",
		autoclose: true,
		startView: 1,
		minViewMode: 1,
		maxViewMode: 1
	});

	//只选择月份
	$(".datetimepicker-year").datetimepicker({
		language: 'ch',
		format: 'yyyy',
		autoclose: true,
		todayBtn: true,
		startView: 'decade',
		minView: 'decade',
		maxView: 'decade',
	});

	// //日期时间选择插件 yyyy-mm-dd H:i:s
	$('.clockpicker').clockpicker();


	//根据开始时间 计算出结束时间
	$("body").on("click", ".date-add-interval", function () {
		var gid=$(this).attr('data-gid');
		var number=$(this).attr('data-val');
		var interval=$(this).attr('data-type');
		var format=$(this).attr('data-fmt');

		var gdate=$(this).parents('form').find("input[name='"+gid+"']").val();

		var newdate=DateAdd(interval, number, gdate)
		var sdate=newdate.Format(format);

		var sid=$(this).attr('data-sid');
		$(this).parents('form').find("input[name='"+sid+"']").val(sdate);
	});

	//根据工作报告类型得到时间
	$('.work_type_time').each(function(){
		var value  =$(this).val();
		var sid =$(this).attr("data-sid");
		var eid =$(this).attr("data-eid");
		var sdate=$(this).parents('form').find("input[name='"+sid+"']").val();
	});

	//选择工作报告类型
	$("body").on("change", ".work_type_time", function () {
		var value  =$(this).val();
		var sid =$(this).attr("data-sid");
		var eid =$(this).attr("data-eid");
		var sdate=$(this).parents('form').find("input[name='"+sid+"']").val();
		if(value==0){
			$(this).parents('form').find("input[name='"+sid+"']").val(formatDate(now));
			$(this).parents('form').find("input[name='"+eid+"']").val(formatDate(now));
		}else if(value==1){
			$(this).parents('form').find("input[name='"+sid+"']").val(getWeekStartDate());
			$(this).parents('form').find("input[name='"+eid+"']").val(getWeekEndDate());
		}else if(value==2){
			$(this).parents('form').find("input[name='"+sid+"']").val(getMonthStartDate());
			$(this).parents('form').find("input[name='"+eid+"']").val(getMonthEndDate());
		}
	});

});

//计算时间函数
//interval 增加时间类型 y m h    number=增加的值  gdate=当前时间
function DateAdd(interval, number, gdate) {
	if(gdate=='' || gdate==null){
		var date=new Date();
	}else{
		var date=new Date(gdate);
	}

	var number=parseFloat(number);
	switch (interval) {
		case "y": {
			date.setFullYear(date.getFullYear() + number);
			return date;
			break;
		}
		case "q": {
			date.setMonth(date.getMonth() + number * 3);
			return date;
			break;
		}
		case "m": {
			date.setMonth(date.getMonth() + number);
			return date;
			break;
		}
		case "w": {
			date.setDate(date.getDate() + number * 7);
			return date;
			break;
		}
		case "d": {
			date.setDate(date.getDate() + number);
			return date;
			break;
		}
		case "h": {
			date.setHours(date.getHours() + number);
			return date;
			break;
		}
		case "m": {
			date.setMinutes(date.getMinutes() + number);
			return date;
			break;
		}
		case "s": {
			date.setSeconds(date.getSeconds() + number);
			return date;
			break;
		}
		default: {
			date.setDate(d.getDate() + number);
			return date;
			break;
		}
	}
}




//格式化日期：yyyy-MM-dd
function formatDate(date) {
	var myyear = date.getFullYear();
	var mymonth = date.getMonth()+1;
	var myweekday = date.getDate();

	if(mymonth < 10){
		mymonth = "0" + mymonth;
	}
	if(myweekday < 10){
		myweekday = "0" + myweekday;
	}
	return (myyear+"-"+mymonth + "-" + myweekday);
}

//获得某月的天数
function getMonthDays(myMonth){
	var monthStartDate = new Date(nowYear, myMonth, 1);
	var monthEndDate = new Date(nowYear, myMonth + 1, 1);
	var days = (monthEndDate - monthStartDate)/(1000 * 60 * 60 * 24);
	return days;
}

//获得本季度的开始月份
function getQuarterStartMonth(){
	var quarterStartMonth = 0;
	if(nowMonth<3){
		quarterStartMonth = 0;
	}
	if(2<nowMonth && nowMonth<6){
		quarterStartMonth = 3;
	}
	if(5<nowMonth && nowMonth<9){
		quarterStartMonth = 6;
	}
	if(nowMonth>8){
		quarterStartMonth = 9;
	}
	return quarterStartMonth;
}

//获得本周的开始日期
function getWeekStartDate() {
	var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek+1);
	return formatDate(weekStartDate);
}

//获得本周的结束日期
function getWeekEndDate() {
	var weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek)+1);
	return formatDate(weekEndDate);
}

//获得本月的开始日期
function getMonthStartDate(){
	var monthStartDate = new Date(nowYear, nowMonth, 1);
	return formatDate(monthStartDate);
}

//获得本月的结束日期
function getMonthEndDate(){
	var monthEndDate = new Date(nowYear, nowMonth, getMonthDays(nowMonth));
	return formatDate(monthEndDate);
}

//获得上月开始时间
function getLastMonthStartDate(){
	var lastMonthStartDate = new Date(nowYear, lastMonth, 1);
	return formatDate(lastMonthStartDate);
}

//获得上月结束时间
function getLastMonthEndDate(){
	var lastMonthEndDate = new Date(nowYear, lastMonth, getMonthDays(lastMonth));
	return formatDate(lastMonthEndDate);
}

//获得本季度的开始日期
function getQuarterStartDate(){

	var quarterStartDate = new Date(nowYear, getQuarterStartMonth(), 1);
	return formatDate(quarterStartDate);
}

//或的本季度的结束日期
function getQuarterEndDate(){
	var quarterEndMonth = getQuarterStartMonth() + 2;
	var quarterStartDate = new Date(nowYear, quarterEndMonth, getMonthDays(quarterEndMonth));
	return formatDate(quarterStartDate);
}// var config = {
//     version: '1.0.2',
//     cssAr: [
//         'module/admin/plugin/daterangepicker/static/css/iconfont.css',
//     ],
//     jsAr: [
//         'module/admin/js/plugins/suggest/bootstrap-suggest.js',
//     ]
// }
// //外部css加载
// function link(cssAr = config.cssAr, type) {
//     for (var i = 0; i < cssAr.length; i++) {
//         document.write('<link rel="stylesheet" href="' + static_root + cssAr[i] + '?version=' + config.version + '"/>');
//     }
// }
// //外部JS加载
// function script(jsAr = config.jsAr, type) {
//     for (var i = 0; i < jsAr.length; i++) {
//         document.write('<script src="' + static_root + jsAr[i] + '?version=' + config.version + ' type="text/javascript" charset="utf-8"><\/script>');
//     }
// }

//link();
// script();

//操作方法

/* 使用方法
标签中设置class属性：
（*）class=suggest-search-box：绑定事件元素
（*）class=customer-suggest：绑定的区域范围，名称
（*）searchFields：查询关键字名 如：searchFields="keywords"
（*）target-group：查询结果后输出的区域，对应”class=customer-suggest“区域中的input值
（*）target-name：查找后选择带回的字段，对应”class=customer-suggest“区域中的input 名称为
    如：target-name='{"customer_id":"id","customer_name":"name"}'
        customer_id  为页面input的名称
        id  为查询为数据返回的数据源字段

  （*）data-url：查找数据的地址

  关联查询，在查询时获取当前面页页字段为参数，查询时带参数
  属性标签：source-group="customer-suggest" source-name='{"customer_id":"客户"}'

     source-group="customer-suggest"  要查询参数的区域
     source-name='{"customer_id":"客户"}'  要查询参数的区域 input 的名称

  （-）data-calback：查找选择确定之后，回调执行的函数，此函数一般在模板中用户单独设置
  （-）data-calback-url：查找选择确定之后，回调执行的函数，调用的地址

模板中调用实例：

<div class="suggest-search-box">
    <div class="input-group customer-suggest">
        <input type="hidden" name="customer_id"  value="{$customer_id|default=''}">
        <input type="text" name="customer_name"  value="{$customer_name|default=''}" class="form-control suggest-input"  placeholder="请输入搜索名称"
               data-url="{:url('Comm/suggest_search',array('datatype'=>'customer'))}"
               searchFields="keywords" value="{$customer_name|default=''}"
               target-group="customer-suggest" target-name='{"customer_id":"id","customer_name":"name"}'>
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
        </div>
    </div>
</div>

<label class="col-sm-2 control-label">客户联系人</label>
<div class="col-sm-4">
    <div class="suggest-search-box">
        <div class="input-group linkman-suggest">
            <input type="hidden" name="linkman_id" value="{$linkman_id|default=''}">
            <input type="text"  name="linkman_name" value="{$linkman_name|default=''}" class="form-control suggest-input" placeholder="请输入搜索名称"
                   data-url="{:url('Comm/suggest_search',array('datatype'=>'linkman'))}"
                   searchFields="keywords" source-group="customer-suggest" source-name='{"customer_id":"客户"}'
                   target-group="linkman-suggest" target-name='{"linkman_id":"id","linkman_name":"name"}'>
            <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right" role="menu"></ul>
            </div>
        </div>
    </div>
    <span class="help-block m-b-none"></span>
</div>

*
* */

$(document).ready(function () {

    //suggest-search,加载
    $('.suggest-search-box').each(function () {
        initSuggest($(this));
    });

    //独立点击清空
    $("body").on("click", ".suggest-search-box .clearable", function () {
        log('sgugest-input 点击清空返回值');
        var object=$(this).parents(".suggest-search-box");
        var suggestObj=object.find(".suggest-input");

        var targetGroup = suggestObj.attr('target-group');//返回字段值，组
        var targetNames = suggestObj.attr('target-name');//返回字段的对应的字段 如：'{"customer_id":"id","customer_name":"name"}'

        var names = JSON.parse(targetNames);
        $.each(names, function (key, item) {
            log(key + '==>' + item);
            object.find("." + targetGroup + " input[name='" + key + "']").val('');
        })

    });


});

//初始化
function initSuggest(object) {

    //实例对像
    var suggestObj = object.find('.suggest-input')
    var searchUrl = suggestObj.attr('data-url');
    var searchFields = suggestObj.attr('searchFields');
    var targetGroup = suggestObj.attr('target-group');//返回字段值，组
    var targetNames = suggestObj.attr('target-name');//返回字段的对应的字段 如：'{"customer_id":"id","customer_name":"name"}'

    //需要联动的参数
    var sourceGroup = suggestObj.attr('source-group');//联动关联字段，组
    var sourceNames = suggestObj.attr('source-name');//联动关联字段名字  '{"customer_id":"id","customer_name":"name"}'

    //加载后需要返回的参数
    var calbackGroup = suggestObj.attr('calback-group');//返回加载区域
    var calbackNames = suggestObj.attr('calback-name');//返回加载区域名字  '{"customer_id":"id","customer_name":"name"}'
    var calbackUrl = suggestObj.attr('calback-url');//回调的地址

    //判断是否有关联数据
    var relation='';

    suggestObj.bsSuggest({
        url: searchUrl,                 //*优先从url ajax 请求 json 帮助数据，注意最后一个参数为关键字请求参数*/
        jsonp: null,                    //设置此参数名，将开启jsonp功能，否则使用json数据结构
        data: {
            value: []
        },                              //提示所用的数据，注意格式
        indexId: 0,                     //每组数据的第几个数据，作为input输入框的 data-id，设为 -1 且 idField 为空则不设置此值
        indexKey: 0,                    //每组数据的第几个数据，作为input输入框的内容
        idField: 'id',                    //每组数据的哪个字段作为 data-id，优先级高于 indexId 设置（推荐）
        keyField: 'name',                   //每组数据的哪个字段作为输入框内容，优先级高于 indexKey 设置（推荐）

        /* 搜索相关 */
        autoSelect: true,               // 键盘向上/下方向键时，是否自动选择值
        allowNoKeyword: true,           // 是否允许无关键字时请求数据
        getDataMethod: 'url',           // 获取数据的方式，url：一直从url请求；data：从 options.data 获取；firstByUrl：第一次从Url获取全部数据，之后从options.data获取
        delayUntilKeyup: false,         // 获取数据的方式 为 firstByUrl 时，是否延迟到有输入时才请求数据
        ignorecase: false,              // 前端搜索匹配时，是否忽略大小写
        effectiveFields: ["id", "name"],            // 有效显示于列表中的字段，非有效字段都会过滤，默认全部有效。
        effectiveFieldsAlias: {id: "编号", name: "名称"},       // 有效字段的别名对象，用于 header 的显示
        searchFields: ["keywords"],               // 有效搜索字段，从前端搜索过滤数据时使用，但不一定显示在列表中。effectiveFields 配置字段也会用于搜索过滤
        twoWayMatch: true,              // 是否双向匹配搜索。为 true 即输入关键字包含或包含于匹配字段均认为匹配成功，为 false 则输入关键字包含于匹配字段认为匹配成功
        multiWord: false,               // 以分隔符号分割的多关键字支持
        separator: ',',                 // 多关键字支持时的分隔符，默认为半角逗号
        delay: 300,                     // 搜索触发的延时时间间隔，单位毫秒
        emptyTip: '未搜索到数据',                   // 查询为空时显示的内容，可为 html
        searchingTip: '搜索中...',       // ajax 搜索时显示的提示内容，当搜索时间较长时给出正在搜索的提示
        hideOnSelect: true,            // 鼠标从列表单击选择了值时，是否隐藏选择列表

        /* UI */
        autoDropup: true,              //选择菜单是否自动判断向上展开。设为 true，则当下拉菜单高度超过窗体，且向上方向不会被窗体覆盖，则选择菜单向上弹出
        autoMinWidth: false,            //是否自动最小宽度，设为 false 则最小宽度不小于输入框宽度
        showHeader: true,              //是否显示选择列表的 header。为 true 时，有效字段大于一列则显示表头
        showBtn: true,                  //是否显示下拉按钮
        inputBgColor: '',               //输入框背景色，当与容器背景色不同时，可能需要该项的配置
        inputWarnColor: 'rgba(255,0,0,.1)', //输入框内容不是下拉列表选择时的警告色
        listStyle: {
            'padding-top': 0,
            'max-height': '375px',
            'max-width': '800px',
            'overflow': 'auto',
            'width': 'auto',
            'transition': '0.3s',
            '-webkit-transition': '0.3s',
            '-moz-transition': '0.3s',
            '-o-transition': '0.3s'
        },                              //列表的样式控制
        listAlign: 'left',              //提示列表对齐位置，left/right/auto
        listHoverStyle: 'background: #07d; color:#fff', //提示框列表鼠标悬浮的样式
        listHoverCSS: 'jhover',         //提示框列表鼠标悬浮的样式名称
        clearable: true,               // 是否可清除已输入的内容


        /* key */
        keyLeft: 37,                    //向左方向键，不同的操作系统可能会有差别，则自行定义
        keyUp: 38,                      //向上方向键
        keyRight: 39,                   //向右方向键
        keyDown: 40,                    //向下方向键
        keyEnter: 13,                   //回车键

        //调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        /* methods */
        /*
        fnProcessData: processData,     //格式化数据的方法，返回数据格式参考 data 参数
        fnGetData: getData,             //获取数据的方法，无特殊需求一般不作设置
        fnAdjustAjaxParam: null,        //调整 ajax 请求参数方法，用于更多的请求配置需求。如对请求关键字作进一步处理、修改超时时间等
        fnPreprocessKeyword: null       //搜索过滤数据前，对输入关键字作进一步处理方法。注意，应返回字符
        */
        fnAdjustAjaxParam: function (keyword, opts) {
            log('ajax 请求参数调整：', keyword, opts);
            log(sourceGroup);
            //扩展参数=》需要关联上一级参数
            var rtnData = {keywords: keyword};
            if (typeof (sourceGroup) !== 'undefined') {
                var names = JSON.parse(sourceNames);
                log('关联参数')
                log(names)
                $.each(names, function (key, item) {
                    var itemVal = $("." + sourceGroup + " input[name='" + key + "']").val();
                    if (itemVal == null || itemVal == '' || typeof (itemVal) == 'undefined') {
                        layer.msg('选择' + item + '数据');
                        itemVal = '还没有选择' + item;
                        relation =itemVal;
                    }
                    rtnData[key] = itemVal;
                })
            }
            return {
                data: rtnData
            };
        },

    }).on('onDataRequestSuccess', function (e, result) {
        // 当 AJAX 请求数据成功时触发，并传回结果到第二个参数

        log('请求数据成功: ', result);
        if (result.value.length <= 0) {
            layer.msg('没有搜索到数据', {icon: 5});
        }

    }).on('onSetSelectValue', function (e, keyword, selectData) {
        //当从下拉菜单选取值时触发，并传回设置的数据到第二个参数

        log("选中值");
        //返回字段
        var names = JSON.parse(targetNames);
        $.each(names, function (key, item) {
            log(key + '==>' + item);
            object.find("." + targetGroup + " input[name='" + key + "']").val(selectData[item]);
        });

        //选择中后回调
        if (typeof (calbackGroup) !== 'undefined') {
            $.ajax({
                type: "POST",
                url: calbackUrl,
                data: selectData,
                dataType: "json",
                async: false,
                success: function (resJsonData) {
                    log(resJsonData);

                    //返回字段
                    var names = JSON.parse(calbackNames);
                    $.each(names, function (key, item) {
                        log(key + '==>' + item + '=' + resJsonData[item]);
                        $("." + calbackGroup + " input[name='" + key + "']").val(resJsonData[item]);
                    });

                    // $(".form-horizontal input[name='contract_money']").val(data.money);
                    // $(".form-horizontal input[name='contract_zero_money']").val(data.zero_money);
                    // $(".form-horizontal input[name='contract_pay_money']").val(data.pay_money);
                    // $(".form-horizontal input[name='contract_owe_money']").val(data.owe_money);
                    // $(".form-horizontal input[name='contract_invoice_money']").val(data.invoice_money);
                    //
                    // //合同金额-支付金额-去零金额
                    // var owe_money = BigNumber(data.money).minus(data.pay_money).minus(data.zero_money).toNumber();
                    // $(".form-horizontal input[name='contract_owe_money']").val(owe_money);
                    // $(".form-horizontal input[name='pay_money']").val(owe_money);
                    // $(".form-horizontal input[name='owe_money']").val(0);

                },
                complete: function () {

                }
            });
        }

    }).on('onUnsetSelectValue', function () {
        //当设置了 idField，且自由输入内容时触发（与背景警告色显示同步）

        log("输入");

        // if (relation.length > 0) {
        //     layer.msg(relation, {icon: 5});
        // }

        //清空
        // var names = JSON.parse(targetNames);
        // $.each(names, function (key, item) {
        //     log(key + '==>' + item);
        //     object.find("." + targetGroup + " input[name='" + key + "']").val('');
        // })
    });
}



//初始化一些效果
$(function () {
    //实现全选反选+全先后背景变色
    $(".checkboxCtrl").on('click', function () {
        $("tbody input[class='checkboxCtrlId']:checkbox").prop("checked", $(this).prop('checked'));

        if($(this).prop('checked')){
           $(".ajax-list-table tbody tr").addClass('active')
        }else{
            $(".ajax-list-table tbody tr").removeClass('active')
        }
    });

    //点击列表前面checkbox背景变色
    $("body").on("click", ".checkboxCtrlId", function () {
        if($(this).prop('checked')){
            $(this).parents('tr').addClass('active')
        }else{
            $(this).parents('tr').removeClass('active')
        }
    });


    //全局返回
    $(".btn-history").on('click', function () {
        window.history.go(-1);
    });

    //刷新验证码
    $(".captcha_change").click(function () {
        var captcha_img_obj = $("#captcha_img");
        captcha_img_obj.attr("src", captcha_img_obj.attr("src") + "?" + Math.random());
    });

    //表格行超出之后隐藏
    $("body").on("click", ".overflow-td", function () {
        var that = $(this);
        var cont = $(this).html();
        //小tips
        layer.tips(cont, that, {
            tips: [4, '#3595CC'],
            time: 9000
        });
    });

    //菜单授权全选择
    $('.auth-box .rules_all').click(function () {
        $(this).parent().parent().next('.ibox-content').find("input").prop("checked", $(this).prop('checked'));
    });

    //树形目录展开，折叠
    $(".treeClassBody lable").click(function () {
        var UL = $(this).parent().siblings("ul");
        $(this).html('');
        if (UL.css("display") == "none") {
            UL.css("display", "block");
            $(this).html(' - ');
        } else {
            UL.css("display", "none");
            $(this).html(' + ');
        }
    });

    //panel面板显示隐藏
    $("body").on("click", ".collapse-link", function () {
        $(this).find('i').toggleClass("fa-chevron-up");
        $(this).find('i').toggleClass("fa-chevron-down");
    });

    //设置有搜索列表页中，点击加回车提交搜索
    $("body").keydown(function (e) {
        var e = event || window.event;
        if (e.keyCode == 13) {
            $("form.searchForm .btn-primary.ajaxSearchForm").click();
        }
    });

});


//分页插件********************************************************************
var orderField = ''; //排序字字段
var orderDirection = '';//升序、降序
var pageSize = '';//每页条数
var pageNum = '';//第几页
var ajaxSearchFormData = '';//表单查询参数

//数据排序、样式操作
$("body").on("click", ".ajax-list-table .sort-filed", function () {
    $(this).toggleClass(function () {
        orderField = $(this).attr('orderField');
        if ($(this).hasClass('asc')) {
            $(this).removeClass('asc');
            orderDirection = 'desc';
            turnPage(1);
            return 'desc';
        } else {
            $(this).removeClass('desc');
            orderDirection = 'asc';
            turnPage(1);
            return 'asc';
        }
    })
});

//查询数据，刷新
$('.ajaxSearchForm').click(function () {
    $(this).children("input").prop("checked", true);
    var searchform = $(this).parents("form");

    //是否重置搜索条件
    if ($(this).hasClass('resetForm')) {
        searchform[0].reset();
        // searchform.find('input[type=text],select,input[type=hidden]').each(function() {
        //     $(this).val('');
        //  });
    }

    ajaxSearchFormData = searchform.serialize();
    turnPage(1);
});

//查询条件下拉时搜索
$("body").on("change", ".searchForm select", function () {
    var searchform = $(this).parents("form");
    var searchform = $(this);
    ajaxSearchFormData = searchform.serialize();
    turnPage(1);
})


//设置分页每页条数及跳转页数
$("body").on("change", ".tfootPageBar", function () {

    var ajaxListTable = $('.ajax-list-table');

    pageNum = ajaxListTable.find("tfoot td input[name='pageNum']").val();

    if (pageNum == null) pageNum = '';

    ajaxSearchFormData = $("form").serialize();

    turnPage(pageNum, ajaxListTable);
});

//输入页数跳转到批定页
$("body").on("click", ".tfootClickPageNum", function () {
    var ajaxListTable = $('.ajax-list-table');
    pageNum = $(this).attr('data-id')
    ajaxSearchFormData = $("form").serialize();
    turnPage(pageNum, ajaxListTable);
});


//获取分页数据及模板
function turnPage(pageNum, ajaxListTable = '') {

    //查询表单
    var searchForm = $('.searchForm');

    //如果没有传入对像默认为
    if (ajaxListTable == '') {
        var ajaxListTable = $('.ajax-list-table');
    }

    var ajaxUrl = ajaxListTable.attr("data-url");

    //获取查询表单数据
    //ajaxSearchFormData = searchForm.serialize();
    var searchItemData = localStorage.getItem(ajaxUrl);

    pageSize = ajaxListTable.find("tfoot td input[name='pageSize']").val();

    if (pageSize == null) pageSize = '';

    // 为在保存搜索条件离开返回不失效
    if (pageSize == '' && ajaxSearchFormData == '') {

        log("第一步：进入pagesize=0,ajaxsearch=''：");

        if (searchItemData != null && searchItemData != 'null') {

            log("第二步：判断是否之前点击查询过，searchItemData：" + searchItemData);

            //searchForm.setForm(JSON.parse(url2json('?'+searchItemData)));

            ajaxSearchFormData = searchItemData;

        } else {
            log("第二步：还没有点击查询，直接获取表单数据：");
            ajaxSearchFormData = $("form").serialize();
        }

    } else {

        ajaxSearchFormData = $("form").serialize();
        log("第一步：点击查询了：ajaxSearchFormData:" + ajaxSearchFormData);

    }

    //存储上次查询条件
    localStorage.setItem(ajaxUrl, decodeURIComponent(ajaxSearchFormData));

    //ajax 请求数据
    ajaxSearchFormData = $("form").serialize();
    ajaxPostJsonData = ajaxSearchFormData + "&pageNum=" + pageNum + "&pageSize=" + pageSize + "&orderField=" + orderField + "&orderDirection=" + orderDirection;

    // log(ajaxPostJsonData);
    $.ajax({
        type: 'POST',
        url: ajaxUrl,     //这里是请求的后台地址，自己定义
        //data: {'pageNum':page,'orderField':orderField,'orderDirection':orderDirection,'textData':textData},
        data: ajaxPostJsonData,
        dataType: 'json',
        beforeSend: function () {
            layer.msg('加载数据',
                {
                    time: 1000,
                    icon: 16,
                    shade: 0.01
                }
            );
        },
        success: function (returnJsonData) {
            if (returnJsonData.code == 0) {
                toast.error(returnJsonData.msg);
            }
            //移除原来的文档
            ajaxListTable.find("tbody").empty();

            totalCount = returnJsonData.total;

            pageSize = returnJsonData.per_page;

            pageNum = returnJsonData.current_page;

            //returnJsonData=null2str(returnJsonData);

            //模板引擎使用
            var tpl = baidu.template;
            var html = tpl('tableListTpl', returnJsonData);
            ajaxListTable.find("tbody").html(html);

        },
        complete: function () {

            //1、添加分页按钮栏
            getPageBar(ajaxListTable, pageNum, pageSize, totalCount);

            //2、判断表格是否设置显示列
            if ($('a').is('.btn-field-set')) {
                initTableCell();
            }

            //3、绑定设置超出部分隐藏
            bindClass();

            //3、判断是否有表格需要合并
            if (ajaxListTable.hasClass('merge-table-rowspan')) {
                mergeTableRowspan();
            }

        },
        error: function () {
            layer.msg('数据加载失败', {
                icon: 5,
                shade: 0.01
            });
        }
    });
}

//获取分页条（分页按钮栏的规则和样式根据自己的需要来设置）
function getPageBar(object, pageNum, pageSize, totalCount) {

    var pageNum = parseInt(pageNum);
    var pageSize = parseInt(pageSize);
    var totalPage = Math.ceil(totalCount / pageSize);
    if (pageNum > totalPage) {
        pageNum = totalPage;
    }
    if (pageNum < 1) {
        pageNum = 1;
    }
    var pageBar;
    pageBar = "<div class='page-list'>";
    pageBar += "<div class=\"btn-group\"> <span class='btn btn-white'> 共 " + totalCount + "条 </span>";
    pageBar += "<span class='btn btn-white'> 每页 <input type='text' name='pageSize' class='tfootPageBar pageSize' style='width:50px;height:20px;border:solid #ccc 1px;' value='" + pageSize + "'> 条 </span>";
    //如果不是第一页
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='0'><a>首页</a></span>";
    pageBar += "<span type=\"button\" class=\"btn btn-white tfootClickPageNum\" data-id='" + (pageNum - 1) + "'><a><< </a> </span>";

    //显示的页码按钮(5个)
    var start = 1,
        end = 0;
    if (totalPage <= 5) {
        start = 1;
        end = totalPage;
    } else {
        if (pageNum - 2 <= 0) {
            start = 1;
            end = 5;
        } else {
            if (totalPage - pageNum < 2) {
                start = totalPage - 4;
                end = totalPage;
            } else {
                start = pageNum - 2;
                end = pageNum + 2;
            }
        }
    }
    for (var i = start; i <= end; i++) {
        if (i == pageNum) {
            pageBar += "<span class='btn btn-white tfootClickPageNum active' data-id='" + i + "'><a>" + i + "</a></span>";
        } else {
            pageBar += "<span class='btn btn-white tfootClickPageNum'  data-id='" + i + "' ><a>" + i + "</a></span>";
        }
    }

    //如果不是最后页
    /*if (pageNum != totalPage) {
        pageBar += "<span class='btn btn-white' onlick='javascript:turnPage(" + (parseInt(pageNum) + 1) + ")'>>></span>";
        pageBar += "<span class='btn btn-white' onlick='javascript:turnPage(" + totalPage + ")'>尾页</span>";
    }*/
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='" + (parseInt(pageNum) + 1) + "'><a> >> </a></span>";
    pageBar += "<span class='btn btn-white tfootClickPageNum' data-id='" + (parseInt(totalPage)) + "'><a>尾页</a></span>";
    pageBar += "<span class='btn btn-white'> 跳 <input type='text' name='pageNum' class='tfootPageBar pageNum' style='width:50px;height:20px;border:solid #ccc 1px;'> 页 <a>GO</a></span>";
    pageBar += "</div></div>";

    if (totalCount == 0) {
        object.find("tfoot td").html('噢噢噢，暂时没有查询到数据~~');
    } else {
        object.find("tfoot td").html(pageBar);
    }

}

//ajax打开,跳转到指定页面
$("body").on("click", ".ajax-goto", function () {

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var tit = $(this).attr('data-title');//打开标题

        //是否设置了参数字段
        // 参数格式：data-ids="{"name":'value}
        var ids = $(this).attr('data-ids');//判断是否有参数传
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //是否设置导出标签
        //配套标签：target-from=''search from'
        if ($(this).hasClass('export')) {
            var target_form = $(this).attr('target-form');
            var form = $('.' + target_form);
            var query = form.serialize();
            var target = target + "?" + query;
        }
        log('执行地址：' + target);
        if ($(this).attr('target') == '_blank') {
            window.open(target)
        } else {
            window.location.href = target;
        }
    }
    return false;
});

//ajax打开,普通打开
$("body").on("click", ".ajax-open", function () {

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var tit = $(this).attr('data-title');//打开标题
        var fun = $(this).attr('data-calback');//回调函数

        //是否带参数字段
        //参数传，支持多个参数传送 格式：data-ids="{'tid':'2',''name':'张三'}"
        var ids = $(this).attr('data-ids');
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //是否设置了单个值
        var id = $(this).attr("data-id");
        if (typeof (id) != "undefined" && id != 0) {
            var target = target + "?id=" + id;
        }

        log('打开地址：' + target);


        //重定义打开宽度和高度
        var width = $(this).attr('width');
        var height = $(this).attr('height');
        if (typeof (width) != "undefined" && width != 0) {
            width = width;
        } else {
            width = "90%";
        }
        if (typeof (height) != "undefined" && height != 0) {
            height = height;
        } else {
            height = "90%";
        }

        //判断是否是手机页
        var wwithd = $(window).width();
        if (wwithd <= 750) {
            width = "90%";
            height = "90%";
        }
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: [width, height],
            content: target,
            success: function (layero, index) {
                layer.iframeAuto(index);
            },
            end: function () {
                if (fun != null) {
                    eval(fun);
                    log('执行回调函数：' + fun);
                } else {
                    turnPage(pageNum);
                }
            }
        });
    }
    return false;
});

//ajax打开
//可以选择多个checkbox值，同时传送参数 id=3,4,5
$("body").on("click", ".ajax-open-more", function () {

    var title = $(this).attr('data-title');//打开标题
    var ids = $(this).attr('data-ids');//判断是否有参数传
    var fun = $(this).attr('data-calback');//判断是否有回调函数
    var checkedVal = [];

    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        //多个选择的目标id
        $('.ajax-list-table tbody input[class="checkboxCtrlId"]:checked').each(function () {
            checkedVal.push($(this).val());
        });
        var cIds = checkedVal.join(',');
        if (cIds.length > 0) {
            var target = target + "?id=" + cIds;
        } else {
            layer.msg('请选择批量操作数据', {icon: 5});
            return false;
        }

        //是否设置了参数字段data-ids="{'name':'张三','sex':'女'}"
        // if (typeof (ids) != "undefined" && ids != 0) {
        //     var ids = ($.param(eval('(' + ids + ')'), true));
        //     var target = target + "?" + ids;
        // }

        log('打开地址：' + target);

        //重定义打开宽度和高度
        var width = $(this).attr('width');
        var height = $(this).attr('height');
        if (typeof (width) != "undefined" && width != 0) {
            width = width;
        } else {
            width = "90%";
        }
        if (typeof (height) != "undefined" && height != 0) {
            height = height;
        } else {
            height = "90%";
        }

        //判断是否是手机页
        var wwithd = $(window).width();
        if (wwithd <= 750) {
            width = "90%";
            height = "90%";
        }

        //打开窗口
        layer.open({
            type: 2,
            title: false,
            shadeClose: false,
            //btn: ['关闭'],
            fixed: true, //不固定
            area: [width, height],
            content: target,
            success: function (layero, index) {
                layer.iframeAuto(index);
            },
            end: function () {
                log(fun);
                if (fun != null) {
                    eval(fun);
                } else {
                    turnPage(pageNum);
                }
            }
        });
    }
    return false;
});

// ajax删除
$("body").on("click", ".ajax-del", function () {
    var target='';
    if(typeof($(this).attr('data-url'))!="undefined"){
        target=$(this).attr('data-url');
    }
    if(typeof($(this).attr('href'))!="undefined"){
        target=$(this).attr('href');
    }
    if(target==''){
        layer.msg('未找到执行地址~', {icon: 5});
        return false;
    }
    //是否设置了参数字段，执行回调函数
    var ids = $(this).attr('data-ids');
    var fun = $(this).attr('data-calback');
    if (typeof (ids) != "undefined" && ids != 0) {
        ids = ($.param(eval('(' + ids + ')'), true));
        target = target + "?" + ids;
    }
    log('删除执行地址：' + target);
    layer.confirm('您确定要删除吗?', {btn: ['确定', '取消'], icon: 3,title: "提示"}, function (index) {

        layer.close(index);//点击 =》确认框=》关闭

        if (target) {
            log('确定执行删除操作：');
            $.ajax({
                type: "POST",
                url: target,
                data: '',
                dataType: "json",
                beforeSend:function () {
                    layer.msg('数据处理中...', {icon: 16,time: 100000,shade : [0.5 , '#000' , true]});
                },
                success: function (result) {
                    if (result.code == '1') {
                        //操作成功提示
                        layer.msg(result.msg, {icon: 1});
                        if (fun != null) {
                            log(fun);
                            eval(fun);
                        } else {
                            setTimeout(function () {
                                turnPage(pageNum);
                            }, 1);
                        }
                    } else {
                        layer.msg(result.msg, {icon: 5});
                    }
                },
                complete: function () { //执行完之后执行

                },
            });//end ajax post
        }
    });
    return false;
});

//ajax get请求=》单个请求
$("body").on("click", ".ajax-get", function () {

    //提示操作
    if ($(this).hasClass('confirm')) {
        if (!confirm('确认要执行该操作吗?')) {
            return false;
        }
    }

    //是否有加载提示
    if ($(this).hasClass('ajaxload')) {
        //页面层-自定义
        var ajaxload=layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
    }

    var target;
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        var ids = $(this).attr('data-ids');//判断是否有参数传
        var fun = $(this).attr('data-calback');//判断是否有回调函数

        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        //执行get请求
        $.get(target).success(function (data) {
            if (data.code) {
                parent.layer.msg(data.msg, {icon: 1});
                if (fun != null) {
                    eval(fun);
                } else {
                    setTimeout(function () {
                        turnPage(pageNum);
                    }, 1500);
                }
            } else {
                parent.layer.msg(data.msg, {icon: 5});
            }
            layer.close(ajaxload)
        }, "json");
    }
    return false;
});

//ajax get -more 请求=》选择多个时使用
$("body").on("click", ".ajax-get-more", function () {

    var target;
    var cIds = "";
    if (!confirm('确认要执行该操作吗?')) {
        return false;
    }
    var checkedArr = $('.ajax-list-table input[class="checkboxCtrlId"]:checked');
    checkedArr.each(function () {
        cIds += $(this).val() + ",";
    });

    if (cIds.length > 0) {
        cIds = cIds.substring(0, cIds.length - 1);
        if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
            var ids = $(this).attr('data-ids');//判断是否有参数传
            var fun = $(this).attr('data-calback');//判断是否有回调函数

            //是否设置了参数字段
            if (typeof (ids) != "undefined" && ids != 0) {
                var ids = ($.param(eval('(' + ids + ')'), true));
                var target = target + "?" + ids;
            }

            $.post(target, {id: cIds}, function (data) {
                if (data.code) {
                    parent.layer.msg(data.msg, {icon: 1});
                    if (fun != null) {
                        eval(fun);
                    } else {
                        setTimeout(function () {
                            turnPage(pageNum);
                        }, 1500);
                    }
                } else {
                    parent.layer.msg(data.msg, {icon: 5});
                }
            }, "json");
        }
    } else {
        parent.layer.msg('请选择批量操作数据', {icon: 5});
    }
    return false;
});

// 重写表单POST提交处理
$("body").on("click", ".ajax-post", function () {
    var target, query, form;
    var target_form = $(this).attr('target-form');
    var that = this;
    var nead_confirm = false;

    if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {

        form = $('.' + target_form);

        if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能

            form = $('.hide-data');
            query = form.serialize();

        } else if (form.get(0) == undefined) {

            return false;

        } else if (form.get(0).nodeName == 'FORM') {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            if ($(this).attr('url') !== undefined) {
                target = $(this).attr('url');
            } else {
                target = form.get(0).action;
            }
            query = form.serialize();

        } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {

            form.each(function (k, v) {
                if (v.type == 'checkbox' && v.checked == true) {
                    nead_confirm = true;
                }
            })
            if (nead_confirm && $(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = form.serialize();
        } else {
            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = form.find('input,select,textarea').serialize();
        }

        //防止重复提交
        var is_repeat_button = $(that).hasClass('no-repeat-button');
        if (is_repeat_button) {
            $(that).prop('disabled', true);
        }

        //ajax提交
        $.ajax({
            type: "POST",
            url: target,
            data: query,
            dataType: "json",
            beforeSend:function (){
                //layer.msg('正在处理,请稍等...', {icon: 16,time: 100000,shade : [0.5 , '#333' , true]});
            },
            success: function (result) {
                if (result.code == '1') {
                    layer.msg(result.msg, {icon: 1, time: 500, shade: [0.5, '#000', true]}, function () {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                    });
                } else {
                    layer.msg(result.msg, {icon: 5});
                }
            },
            complete: function () { //执行完之后执行
                if (is_repeat_button) {
                    $(that).prop('disabled', false);
                }
            },
        });//end ajax post
    }
    return false;
});

// 提交~针对本页
$("body").on("click", ".ajax-post-trace", function () {
    var target, query, form;
    var target_form = $(this).attr('target-form');
    var that = this;
    var nead_confirm = false;
    var fun = $(this).attr('data-calback');//判断是否有回调函数

    if (($(this).attr('type') == 'submit') || (target = $(this).attr('href')) || (target = $(this).attr('url'))) {
        form = $('.' + target_form);
        if ($(this).attr('hide-data') === 'true') {//无数据时也可以使用的功能
            form = $('.hide-data');
            query = form.serialize();
        } else if (form.get(0) == undefined) {

            return false;

        } else if (form.get(0).nodeName == 'FORM') {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            if ($(this).attr('url') !== undefined) {
                target = $(this).attr('url');
            } else {
                target = form.get(0).action;
            }
            query = form.serialize();

        } else if (form.get(0).nodeName == 'INPUT' || form.get(0).nodeName == 'SELECT' || form.get(0).nodeName == 'TEXTAREA') {

            form.each(function (k, v) {
                if (v.type == 'checkbox' && v.checked == true) {
                    nead_confirm = true;
                }
            })

            if (nead_confirm && $(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }

            query = form.serialize();
        } else {

            if ($(this).hasClass('confirm')) {
                if (!confirm('确认要执行该操作吗?')) {
                    return false;
                }
            }
            query = form.find('input,select,textarea').serialize();
        }

        var is_repeat_button = $(that).hasClass('no-repeat-button');

        if (is_repeat_button) {
            $(that).prop('disabled', true);
        }

        $.ajax({
            type: "POST",
            url: target,
            data: query,
            dataType: "json",
            success: function (result) {
                if (result.code == '1') {

                    form[0].reset();

                    layer.msg(result.msg, {icon: 1, time: 500, shade: [0.5, '#000', true]}, function () {
                        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
                        parent.layer.close(index);
                        if (fun != null) {
                            eval(fun);
                        }
                    });
                } else {
                    layer.msg(result.msg, {icon: 5});
                }
            },
            complete: function () { //执行完之后执行
                if (is_repeat_button) {
                    $(that).prop('disabled', false);
                }
            },
        });//end ajax post

    }
    return false;
});


//更改列表字段,
$("body").on("change", ".ajax-input", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        //是否设置了字段
        var ids = $(this).attr('data-ids');

        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }

        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                parent.layer.msg(data.msg, {icon: 1});
            } else {
                parent.layer.msg(data.msg, {icon: 5});
            }

        }, "json");
    }
    return false;
});

//列表启用关闭
$("body").on("click", ".ajax-checkbox", function () {
    var target;
    var val = 0;
    var chk = $(this).prop('checked');
    log(chk);
    var id = $(this).attr('data-id');
    if (chk) {
        val = 1;
    }
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
        $.post(target, {id: id, value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }

        }, "json");
    }
});

//列表排序处理
$("body").on("change", ".ajax-sort", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {
        if (!((/^(\+|-)?\d+$/.test(val)) && val >= 0)) {
            layer.msg('请输入正整数', {icon: 5});
            return false;
        }
        //是否设置了字段
        var ids = $(this).attr('data-ids');
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }
        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
            //lqfalert(data);
        }, "json");
    }
    return false;
});

//排列表字段序，可以传多个参数
$("body").on("change", ".ajax-field", function () {
    var target;
    var val = $(this).val();
    if ((target = $(this).attr('href')) || (target = $(this).attr('url')) || (target = $(this).attr('data-url'))) {

        //是否设置了字段
        var ids = $(this).attr('data-ids');
        //是否设置了参数字段
        if (typeof (ids) != "undefined" && ids != 0) {
            var ids = ($.param(eval('(' + ids + ')'), true));
            var target = target + "?" + ids;
        }
        $.post(target, {id: $(this).attr('data-id'), value: val}, function (data) {
            if (data.code) {
                layer.msg(data.msg, {icon: 1});
            } else {
                layer.msg(data.msg, {icon: 5});
            }
            //lqfalert(data);
        }, "json");
    }
    return false;
});

/**
 * 提示或提示并跳转
 */
var lqfalert = function (data) {
    if (data.code) {
        layer.msg(data.msg, {icon: 1});
    } else {
        if (typeof data.msg == "string") {
            //toast.error(data.msg);
            layer.msg(data.msg, {icon: 5});
        } else {
            var err_msg = '';
            for (var item in data.msg) {
                err_msg += "Θ " + data.msg[item] + "<br/>";
            }
            layer.msg(data.msg, {icon: 5});
        }
    }
    if (data.url) {
        setTimeout(function () {
            location.href = data.url;
        }, 1500);
    }
    if (data.code && !data.url) {
        setTimeout(function () {
            location.reload();
        }, 1500);
    }
};