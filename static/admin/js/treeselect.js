/** kit_admin-v1.1.0 MIT License By http://kit/zhengjinfan.cn e-mail:zheng_jinfan@126.com */
 ;//treeSelect组件
layui.define(['layer', 'ztree'], function(exports) {
  var _MOD = 'treeselect',
    layer = layui.layer,
    $ = layui.jquery;
  var TreeSelect = function() {
    this.v = '1.0.0';
  };
  /**
   * 渲染treeSelect
   */
  TreeSelect.prototype.render = function(options) {
    var that = this;
    // 设置可参考ztree.js配置 URL:http://www.treejs.cn/v3/api.php
    var setting = {
      check: {
        enable: true,
        chkboxType: {
          "Y": "",
          "N": ""
        }
      },
      view: {
        dblClickExpand: false
      },
      data: {
        simpleData: {
          enable: true
        }
      },
      callback: {
        // ztree 点击前发生
        beforeClick: function(treeId, treeNode) {
          var zTree = $.fn.zTree.getZTreeObj(treeId);
          zTree.checkNode(treeNode, !treeNode.checked, null, true);
        },
        // ztree 点击时发生
        onClick: function(e, treeId, treeNode) {
          var zTree = $.fn.zTree.getZTreeObj(treeId),
            nodes = zTree.getCheckedNodes(true), //获取选中的节点
            valIds = [],
            arr = [];
          for (var i = 0, l = nodes.length; i < l; i++) {
            valIds.push(nodes[i].id);
            arr.push({
              name: nodes[i].name,
              id: nodes[i].id,
              tid: nodes[i].tId
            });
          }
          _div = $(options.elem);
          var _htm = [];
          layui.each(arr, function(index, item) {
            _htm.push([
              '<a href="javascript:;">',
              item.name,
              ' <i class="layui-icon" data-action="close" data-tid="' + item.tid + '" data-id="' + item.id + '">&#x1006;</i>',
              '</a>'
            ].join(''));
          });
          _div.html(_htm.join(''));
          //给input 赋值
          var _input = _div.siblings('input.layui-input');
          _input.attr("value", valIds.join(','));
          _bindCloseEvent();
        }
      }
    };
    // 获取当前时间戳
    var times = new Date().getTime();
    var eId = 'content' + times;
    var treeDOMId = 'treeDemo' + times;
    // 创建DOM
    $(options.elem)
      .parent()
      .append('<div class="ztree-input" id="' + options.elem.substr(1) + '"></div>')
      .append(['<div id="' + eId + '" class="ztree-content layui-anim layui-anim-upbit">',
        '<ul id="treeDemo' + times + '" class="ztree"></ul>',
        '</div>'
      ].join(''))
      .children('input.layui-input').removeAttr('id');
    // 初始化zTree
    var zTree = $.fn.zTree.init($('#' + treeDOMId), setting, options.data);
    // 获取所有节点
    var nodes = zTree.getNodes();
    // 获取初始值
    var vals = $(options.elem).parent().children('input.layui-input').val();
    if ($.trim(vals).length > 0) {
      initNode(nodes);
    }
    // 初始化数据
    function initNode(nodes) {
      for (var i = 0, l = nodes.length; i < l; i++) {
        var node = nodes[i];
        if (findArray(vals.split(','), node.id) !== -1) {
          zTree.checkNode(node, true, false);
          $(options.elem).append([
            '<a href="javascript:;">',
            node.name,
            ' <i class="layui-icon" data-action="close" data-tid="' + node.tId + '" data-id="' + node.id + '">&#x1006;</i>',
            '</a>'
          ].join(''));
          _bindCloseEvent();
        }
        if (node.children !== null && node.children !== undefined && node.children.length > 0) {
          // 递归调用
          initNode(node.children);
        }
      }
    };
    // input 框点击事件
    $(options.elem).off('click').on('click', function() {
      $("#" + eId).show();
      $(document).off('mousedown').on("mousedown", function(event) {
        if (!('#' + event.target.id == options.elem || event.target.id == eId || $(event.target).parents('#' + eId).length > 0)) {
          // 隐藏ztree
          $("#" + eId).fadeOut('fast');
        }
      });
    });
    /**
     * 绑定删除按钮事件
     */
    function _bindCloseEvent() {
      var _div = $(options.elem),
        _input = _div.siblings('input.layui-input');
      _div.find('i[data-action=close]').off('click').on('click', function(e) {
        layui.stope(e);
        // 获取id
        var id = $(this).data('id');
        // 获取tid
        var tid = $(this).data('tid');
        // 处理节点显示
        var node = zTree.getNodeByTId(tid);
        // 将对应的ztree节点的check取消选中
        zTree.checkNode(node, false, false);
        // 处理input 值
        var inputs = _input.val().split(',');
        // 移除当前所选值Id
        inputs.remove(id);
        // 重新辅助
        _input.attr('value', inputs.join(','));
        // 移除截元素
        $(this).parent().remove();
      });
    }

    // Array 扩展
    Array.prototype.indexOf = function(val) {
      for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
      }
      return -1;
    };
    // 移除指定值
    Array.prototype.remove = function(val) {
      var index = this.indexOf(val);
      if (index > -1) {
        this.splice(index, 1);
      }
    };
    /**
     * 
     * 查找数组，返回匹配到的第一个index
     * 
     * @param array 被查找的数组
     * @param feature 查找特征 或者为一个具体值，用于匹配数组遍历的值，或者为一个对象，表明所有希望被匹配的key-value
     * @param or boolean 希望命中feature全部特征或者只需命中一个特征，默认true
     * 
     * @return 数组下标  查找不到返回-1
     */
    function findArray(array, feature, all = true) {
      for (let index in array) {
        let cur = array[index];
        if (feature instanceof Object) {
          let allRight = true;
          for (let key in feature) {
            let value = feature[key];
            if (cur[key] == value && !all) return index;
            if (all && cur[key] != value) {
              allRight = false;
              break;
            }
          }
          if (allRight) return index;
        } else {
          if (cur == feature) {
            return index;
          }
        }
      }
      return -1;
    }

    return that;
  };
  // 导出组件
  exports(_MOD, new TreeSelect());
});