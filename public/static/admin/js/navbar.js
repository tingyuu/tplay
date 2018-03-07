/** kit_admin-v1.1.0 MIT License By http://kit/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;/**
 * Name:navbar.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://kit.zhengjinfan.cn/
 * LICENSE:MIT
 */
layui.define(['layer', 'laytpl', 'element'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        _modName = 'navbar',
        _win = $(window),
        _doc = $(document),
        laytpl = layui.laytpl,
        element = layui.element;

    var navbar = {
        v: '1.0.4',
        config: {
            data: undefined, //静态数据
            remote: {
                url: undefined, //接口地址
                type: 'GET', //请求方式
                jsonp: false //跨域
            },
            cached: false, //是否缓存
            elem: undefined, //容器
            filter: 'kitNavbar' //过滤器名称
        },
        set: function(options) {
            var that = this;
            that.config.data = undefined;
            $.extend(true, that.config, options);
            return that;
        },
        /**
         * 是否已设置了elem
         */
        hasElem: function() {
            var that = this,
                _config = that.config;
            if (_config.elem === undefined && _doc.find('ul[kit-navbar]').length === 0 && $(_config.elem)) {
                layui.hint().error('Navbar error:请配置Navbar容器.');
                return false;
            }
            return true;
        },
        /**
         * 获取容器的jq对象
         */
        getElem: function() {
            var _config = this.config;
            return (_config.elem !== undefined && $(_config.elem).length > 0) ? $(_config.elem) : _doc.find('ul[kit-navbar]');
        },
        /**
         * 绑定特定a标签的点击事件
         */
        bind: function(callback, params) {
            var that = this,
                _config = that.config;
            var defaults = {
                target: undefined,
                showTips: true
            };
            $.extend(true, defaults, params);
            var _target = defaults.target === undefined ? _doc : $(defaults.target);
            // if (!that.hasElem())
            //     return that;
            // var _elem = that.getElem();
            _target.find('a[kit-target]').each(function() {
                var _that = $(this),
                    tipsId = undefined;
                if (defaults.showTips) {
                    _that.hover(function() {
                        tipsId = layer.tips($(this).children('span').text(), this);
                    }, function() {
                        if (tipsId)
                            layer.close(tipsId);
                    });
                }
                _that.off('click').on('click', function() {
                    var options = _that.data('options');
                    var data;
                    if (options !== undefined) {
                        try {
                            data = new Function('return ' + options)();
                        } catch (e) {
                            layui.hint().error('Navbar 组件a[data-options]配置项存在语法错误：' + options)
                        }
                    } else {
                        data = {
                            icon: _that.data('icon'),
                            id: _that.data('id'),
                            title: _that.data('title'),
                            url: _that.data('url'),
                        };
                    }
                    typeof callback === 'function' && callback(data);
                });
            });
            $('#kit-side-fold').off('click').on('click', function() {
                var display = $('.kit-side-fold span').css('display');
                var menu = $(this).find('i');
                if(display == 'inline' || display == 'inline-block') {
                    $('.kit-side-fold span').css('display','none');
                }
                if(display == 'none') {
                    $('.kit-side-fold span').css('display','inline-block');
                }
                var _side = _doc.find('div.kit-side');
                if (_side.hasClass('kit-sided')) {
                    _side.removeClass('kit-sided');
                    _doc.find('div.layui-body').removeClass('kit-body-folded');
                    _doc.find('div.layui-footer').removeClass('kit-footer-folded');
                    menu.attr('class','fa fa-arrow-left');
                    $('#logo span').css('display','block');
                    $('#logo').css('width','220px');
                    $('.tplay-left-icon').css('display','none');
                    $('.layui-layout-left').css('left','220px');
                } else {
                    _side.addClass('kit-sided');
                    _doc.find('div.layui-body').addClass('kit-body-folded');
                    _doc.find('div.layui-footer').addClass('kit-footer-folded');
                    menu.attr('class','fa fa-arrow-right');
                    $('#logo span').css('display','none');
                    $('#logo').css('width','50px');
                    $('.tplay-left-icon').css('display','block');
                    $('.layui-layout-left').css('left','50px');
                }
            });
            return that;
        },
        /**
         * 渲染navbar
         */
        render: function(callback) {
            var that = this,
                _config = that.config, //配置
                _remote = _config.remote, //远程参数配置
                _tpl = [
                    '{{# layui.each(d,function(index, item){ }}',
                    '{{# if(item.spread){ }}',
                    '<li class="layui-nav-item layui-nav-itemed">',
                    '{{# }else{ }}',
                    '<li class="layui-nav-item">',
                    '{{# } }}',
                    '{{# var hasChildren = item.children!==undefined && item.children.length>0; }}',
                    '{{# if(hasChildren){ }}',
                    '<a href="javascript:;">',
                    '{{# if (item.icon.indexOf("fa-") !== -1) { }}',
                    '<i class="fa {{item.icon}}" aria-hidden="true"></i>',
                    '{{# } else { }}',
                    '<i class="layui-icon">{{item.icon}}</i>',
                    '{{# } }}',
                    '<span> {{item.title}}</span>',
                    '</a>',
                    '{{# var children = item.children; }}',
                    '<dl class="layui-nav-child">',
                    '{{# layui.each(children,function(childIndex, child){ }}',
                    '<dd>',
                    '<a href="javascript:;" kit-target data-options="{url:\'{{child.url}}\',icon:\'{{child.icon}}\',title:\'{{child.title}}\',id:\'{{child.id}}\'}">',
                    '{{# if (child.icon.indexOf("fa-") !== -1) { }}',
                    '<i class="fa {{child.icon}}" aria-hidden="true"></i>',
                    '{{# } else { }}',
                    '<i class="layui-icon">{{child.icon}}</i>',
                    '{{# } }}',
                    '<span> {{child.title}}</span>',
                    '</a>',
                    '</dd>',
                    '{{# }); }}',
                    '</dl>',
                    '{{# }else{ }}',
                    '<a href="javascript:;" kit-target data-options="{url:\'{{item.url}}\',icon:\'{{item.icon}}\',title:\'{{item.title}}\',id:\'{{item.id}}\'}">',
                    '{{# if (item.icon.indexOf("fa-") !== -1) { }}',
                    '<i class="fa {{item.icon}}" aria-hidden="true"></i>',
                    '{{# } else { }}',
                    '<i class="layui-icon">{{item.icon}}</i>',
                    '{{# } }}',
                    '<span> {{item.title}}</span>',
                    '</a>',
                    '{{# } }}',
                    '</li>',
                    '{{# }); }}',
                ], //模板
                _data = [];
            var navbarLoadIndex = layer.load(2);
            if (!that.hasElem())
                return that;
            var _elem = that.getElem();
            //本地数据优先
            if (_config.data !== undefined && _config.data.length > 0) {
                _data = _config.data;
            } else {
                var dataType = _remote.jsonp ? 'jsonp' : 'json';
                var options = {
                    url: _remote.url,
                    type: _remote.type,
                    error: function(xhr, status, thrown) {
                        layui.hint().error('Navbar error:AJAX请求出错.' + thrown);
                        navbarLoadIndex && layer.close(navbarLoadIndex);
                    },
                    success: function(res) {
                        _data = res;
                    }
                };
                $.extend(true, options, _remote.jsonp ? {
                    dataType: 'jsonp',
                    jsonp: 'callback',
                    jsonpCallback: 'jsonpCallback'
                } : {
                    dataType: 'json'
                });
                $.support.cors = true;
                $.ajax(options);
            }
            var tIndex = setInterval(function() {
                if (_data.length > 0) {
                    clearInterval(tIndex);
                    //渲染模板
                    laytpl(_tpl.join('')).render(_data, function(html) {
                        _elem.html(html);
                        element.init();
                        //绑定a标签的点击事件
                        that.bind(function(data) {
                            typeof callback === 'function' && callback(data);
                        });
                        //关闭等待层
                        navbarLoadIndex && layer.close(navbarLoadIndex);
                    });
                }
            }, 50);
            return that;
        }
    };
    exports('navbar', navbar);
});


var a_link = document.querySelectorAll('.menu_ul li a');
var display;
for (var i = 0, len = a_link.length; i < len; i++) {
    a_link[i].addEventListener('click',function(e){
        console.log(this.parentNode.children[1])
        if(this.parentNode.children[1]) {
            display = this.parentNode.children[1].style.display;
             a_link.forEach(function(item,index){
                    if(item.parentNode.children[1]){
                     item.parentNode.children[1].style.display = 'none';
                     item.parentNode.children[0].children[2].children[0].className = 'fa fa-angle-down';
                    }
                })
             if(display){
                    this.parentNode.children[1].style.display = display;
             }
            if(this.parentNode.children[1].style.display == 'none'){               
               this.parentNode.children[1].style.display = 'block';
                this.parentNode.children[0].children[2].children[0].className = 'fa fa-angle-up';
               
            }else{
                 this.parentNode.children[1].style.display = 'none';
                this.parentNode.children[0].children[2].children[0].className = 'fa fa-angle-down';
            }
        }
        
    },false);
}