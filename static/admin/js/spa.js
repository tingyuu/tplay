/** kit_admin-v1.1.0 MIT License By http://kit/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;/**
 * Name:spa.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://kit.zhengjinfan.cn/
 * LICENSE:MIT
 */
layui.define(['layer', 'nprogress', 'utils'], function(exports) {
    var $ = layui.jquery,
        layer = layui.layer,
        _modName = 'spa',
        utils = layui.utils;

    var Spa = function() {
        this.config = {
            elem: '#container',
            openWait: true
        };
        this.v = '1.0.0';
    };
    Spa.fn = Spa.prototype;
    Spa.fn.set = function(options) {
        var that = this;
        $.extend(true, that.config, options);
        return that;
    };
    Spa.fn.render = function(url, callback) {
        var that = this,
            _config = that.config,
            _elem = $(_config.elem),
            loadIndex = undefined;
        NProgress.start();
        if (_config.openWait)
            loadIndex = utils.load();
        var html = utils.getBodyContent(utils.loadHtml(url + '?v=' + new Date().getTime(), function() {
            setTimeout(function() {
                NProgress.done();
                _config.openWait && loadIndex && layer.close(loadIndex);
            }, 500);
            typeof callback === 'function' && callback();
        }));
        _elem.html(html);
    };


    var t = new Spa();

    exports('spa', t);
});