var beforeFormLoadContent = 
'<div style="height:150px;padding-top:2.5em;text-align:center">' +
    '<i style="font-size:4em;" class="text-gray fa fa-spinner fa-spin"></i>'+
    '<p class="text-black" style="margin-top:1em;">正在加载....<p>'+
'</div>';

$(function(){

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-green',
      radioClass: 'iradio_minimal-green'
    });

    // reote-form
    $('body').on('click', '.ms-remote-form', function(e){
        e.preventDefault();
        var $this = $(this);
        var title = $this.attr('title') || $this.text();
        var url = $this.prop('href') || $this.data('url');
        var size  = $this.data('size') || false;

        // 弹出窗口
        var $me = bootbox.dialog({
          message: beforeFormLoadContent,
          title: '<i class="fa fa-fw fa-list-alt "></i> ' + title,
          size : size,
          animate: true,
          buttons: {
            reset: {
              label: "取消",
              className: "btn-default text-black btn-sm",
              callback: function() {
              }
            },
            button: {
              label: "提交",
              className: "btn-default text-red btn-sm",
              callback: function() {
                  var Form = $me.find('form:first');
                  var formAction = Form.attr('action') || url; 
                  var datas = Form.serializeArray();
                  $.post(formAction, datas, function(xhr){
                      if ( xhr.status == 1) {
                          window.location.reload();
                      } else {
                          alert(xhr.msg)
                      }
                  },'json');
                }
              }
          }
        });

        // 加载内容
        $.get(url, function(xhr){
            $me.find('div.bootbox-body').html(xhr);
        }, 'html')



    });

    /**
     * 远程内容读取
     */
    /*
    $('body').on('click', '.ms-remote-content', function(e){
        e.preventDefault();
        var $this = $(e.target);
        var title = $this.attr('title') || $this.text();
        var url = $this.attr('href') || $this.data('url');
        var size  = $this.data('size') || 'normal';
        var cbShow = $this.data('cbShow')
        var cbShown = $this.data('cbShown')
        var $me = $.alert({
          backdrop: true
          ,title : title
          ,body: '<div style="width:100%;margin:30px auto;" class="sui-loading loading-inline">' +
                    '<i class="sui-icon icon-pc-loading"></i>' +
                    '<p>正在加载...</p>' +
                    '</div>'
          ,width: size
          ,hasfoot:false
          ,show: function(e){
            var $me = $(e.target);
            window[cbShow]($me, $this);
          }
          ,shown: function(e){
              var $me = $(e.target);
              $.get(url, function(xhr){
                  $me.find('div.modal-body').html(xhr);
              }, 'html');
              window[cbShown]($me, $this);
          }
        });
    });
    */

    // confirm
    $('body').on('click', '.ms-confirm', function(e){
        e.preventDefault();
        var $this = $(this);
        var url = $this.prop('href') || $this.data('url');
        var msg = $this.data('message') || "您确认进行该操作吗?";

        var $me = bootbox.dialog({
            message:'<span style="font-size:1.2em" class="text-red"><i class="fa fa-fw fa-exclamation-triangle"></i> ' +  msg + '</span>',
          title: '',
          buttons: {
            reset: {
              label: "取消",
              className: "btn-default btn-sm text-black",
              callback: function() {
              }
            },
            button: {
              label: "确认",
              className: "btn-default btn-sm text-red",
              callback: function() {
                  $.get(url, function(xhr){
                      if ( xhr.status == 1) {
                          window.location.reload();
                      } else {
                          alert(xhr.msg)
                      }
                  },'json');
                }
              }
          },
          animate: true,
        });

    });

    // 如果存在datepicker插件
    if (typeof(jQuery.datepicker) !== 'undefined') { // 
       // var CurrDtInput = {value:''};  
       /*
       $(".ui-datepicker-close").on("click", function (){  
           CurrDtInput.value = "";  
       });*/ 
       $('input.ms-dt').each(function(){
           var $this = $(this);

           var setting = {
              // autoclose: true,
           };
           // 1 是否可清除
           if ($this.attr('dt-clear') == true 
               || $this.attr('dt-clear') == 'true') {
               setting['showButtonPanel'] = true;
               setting['closeText'] = '清除';
               setting['beforeShow'] = function (input, inst) {
                                           CurrDtInput = input; 
                                       };
           }
           // 2 是否可变换年
           if ($this.attr('dt-year')== true 
               || $this.attr('dt-year') == 'true') {
              setting['changeYear'] = true;
           }
           // 3 是否可变换月
           if ($this.attr('dt-month')== true 
               || $this.attr('dt-month') == 'true') {
               setting['changeMonth'] = true;
           }
           // 4 缺省 
           if ($this.attr('dt-default')) {
              setting['defaultDate'] = $this.attr('dt-default');
           }
           // 5 开始时间
           if ($this.attr('dt-min')) {
               setting['minDate'] = $this.attr('dt-min');
           }
           // 6 结束时间
           if ($this.attr('dt-max')) {
                setting['maxDate'] = $this.attr('dt-max'); 
           }
           // 7 可选择年的显示范围
           if ($this.attr('dt-year-range')) {
                setting['yearRange'] = $this.attr('dt-year-range');
           }
           // 6 时间格式
           if ($this.attr('dt-format')) {
                setting['dateFormat'] = $this.attr('dt-format'); 
           }

           $this.datepicker(setting);

       });
    } // 时间选择处理结束

    /*
    dttimeInit : function(){

        $('body').on('click', 'input[dttime=true]', function(e){
           var $this = $(this);
           if ( !$this.data('dttimeInit') ) {
               $this.datetimepicker();
               $this.data('dttimeInit', true); 
               $this.blur();
               $this.focus();
           }
        });


    },*/




    if ( _pageInfo ) {
          alert(_pageInfo);
    }
});
