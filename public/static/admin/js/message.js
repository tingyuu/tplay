/** kit_admin-v1.1.0 MIT License By http://kit/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;/**
 * Name:message.js
 * Author:Van
 * E-mail:zheng_jinfan@126.com
 * Website:http://kit.zhengjinfan.cn/
 * LICENSE:MIT
 */
layui.define(['jquery', 'kitconfig'], function(exports) {
    var $ = layui.jquery,
        kitconfig = layui.kitconfig,
        _modName = 'message',
        _doc = $(document),
        _body = $('body'),
        _MESSAGE = '.kit-message';
    var message = {
        v: '1.0.0',
        times: 1,
        _message: function() {
            var _msg = $(_MESSAGE);
            if (_msg.length > 0)
                return _msg;
            _body.append('<div class="kit-message"></div>');
            return $(_MESSAGE);
        },
        show: function(options) {
            var that = this,
                _message = that._message(),
                id = that.times,
                options = options || {},
                skin = options.skin === undefined ? 'default' : options.skin,
                msg = options.msg === undefined ? '请输入一些提示信息!' : options.msg,
                autoClose = options.autoClose === undefined ? true : options.autoClose;
            var tpl = [
                '<div class="kit-message-item layui-anim layui-anim-upbit" data-times="' + id + '">',
                '<div class="kit-message-body kit-skin-' + skin + '">',
                msg,
                '</div>',
                '<div class="kit-close kit-skin-' + skin + '"><i class="fa fa-times" aria-hidden="true"></i></div>',
                '</div>'
            ];
            _message.append(tpl.join(''));
            var _times = _message.children('div[data-times=' + id + ']').find('i.fa-times');
            _times.off('click').on('click', function() {
                var _t = $(this).parents('div.kit-message-item').removeClass('layui-anim-upbit').addClass('layui-anim-fadeout');
                setTimeout(function() {
                    _t.remove();
                }, 1000);
            });
            if (autoClose) { //是否自动关闭
                setTimeout(function() {
                    _times.click();
                }, 3000);
            }
            that.times++;
        }
    };
    layui.link(kitconfig.resourcePath + 'css/message.css');
    exports('message', message);
});