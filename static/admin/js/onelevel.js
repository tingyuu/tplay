/** kit_admin-v1.1.0 MIT License By http://kit/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;/**
 * Name:onelevel.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://kit.zhengjinfan.cn/
 * LICENSE:MIT
 */
layui.define(['jquery', 'laytpl', 'element'], function(exports) {
    var $ = layui.jquery,
        _modName = 'oneLevel',
        _win = $(window),
        _doc = $(document),
        laytpl = layui.laytpl;

    var oneLevel = {
        v: '1.0.1',
        config: {
            elem: undefined,
            data: undefined,
            remote: {
                url: undefined,
                type: 'GET'
            },
            onClicked: undefined
        },
        set: function(options) {
            var that = this;
            $.extend(true, that.config, options);
            return that;
        },
        /**
         * 是否已设置了elem
         */
        hasElem: function() {
            var that = this,
                _config = that.config;
            if (_config.elem === undefined && _doc.find('ul[kit-one-level]').length === 0 && $(_config.elem)) {
                //console.log('One-Level error:请配置One-Level容器.');
                //do something..
                return false;
            }
            return true;
        },
        /**
         * 获取容器的jq对象
         */
        getElem: function() {
            var _config = this.config;
            return (_config.elem !== undefined && $(_config.elem).length > 0) ? $(_config.elem) : _doc.find('ul[kit-one-level]');
        },
        render: function() {
            var that = this,
                _config = that.config, //配置
                _remote = _config.remote, //远程参数配置
                _tpl = [
                    '{{# layui.each(d,function(index, item){ }}',
                    '<li class="layui-nav-item">',
                    '<a href="javascript:;" data-title="{{item.title}}" data-icon="{{item.icon}}" data-id="{{item.id}}" >',
                    '{{# if (item.icon.indexOf("fa-") !== -1) { }}',
                    '<i class="fa {{item.icon}}" aria-hidden="true"></i>',
                    '{{# } else { }}',
                    '<i class="layui-icon">{{item.icon}}</i>',
                    '{{# } }}',
                    '<span> {{item.title}}</span>',
                    '</a>',
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
                        layui.hint().error('One-Level error:AJAX请求出错.' + thrown);
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
                if (_data.length > 0)
                    clearInterval(tIndex);
                //渲染模板
                laytpl(_tpl.join('')).render(_data, function(html) {
                    _elem.html(html);
                    layui.element.init();
                    typeof _config.onClicked === 'function' && _elem.children('li.layui-nav-item').off('click').on('click', function() {
                        var _a = $(this).children('a'),
                            id = _a.data('id');
                        _config.onClicked(id);
                    });
                    //关闭等待层
                    navbarLoadIndex && layer.close(navbarLoadIndex);
                    typeof _config.renderAfter === 'function' && _config.renderAfter(_elem);
                });
            }, 50);
            return that;
        }
    };

    exports('onelevel', oneLevel);
});