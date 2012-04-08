$(function(){
  $('#notify_at').datetimepicker();
  $('#content').wysiwyg({
    controls: {
      html: { visible: true },
      codesnipet: { visible: false },
      underline: { visible: false },
      subscript: { visible: false },
      superscript: { visible: true }
    }
  });

  console.log('hogehoge');
  var update_action_type = function(elm){
    var action_type = $(elm).val();
    console.log('action_type:' + action_type);
    if (action_type == '1') {
      $('#activity').removeAttr('disabled');
    } else {
      $('#activity').attr('disabled', 'disabled');
    }
  };
  $('#action_type').change(function(){
    update_action_type(this);
  });
  update_action_type($('#action_type'));

////  アプリ名
//  $('.name-edit').click(function(e){
//    $('.alert-message').hide();
//    var that = $(this);
//    var text = $('span.text', that.parent());
//    var input = $('#' + text.attr('id') + '_input');
//    text.hide();
//    that.hide();
//    input.val(text.text()).show().focus();
//    input.unbind('change').change(function(){
//      if (input.val().trim().length == 0) {
//        e.preventDefault();
//        return;
//      }
//      console.log($('#app_name_input').val());
//      $.ajax({
//        type: 'POST',
//        url: '/api/app.json/' + $('#id_input').val(), 
//        data: {
//          name: $('#app_name_input').val(),
//          url: $('#url').text(),
//          category: 0
//        },
//        success: function(data, status){
//          console.log('success', data);
//          text.text(input.val());
//          $('#alert-message-success').show();
//        },
//        error: function(xhr, status, c){
//          var data = JSON.parse(xhr.responseText);
//          $('#error-description').text(data.error);
//          $('#alert-message-error').show();
//        }
//      });
//    });
//    input.blur(function(){
//      text.show();
//      that.show();
//      input.hide();
//    });
//  });

////  url
//  $('.url-edit').click(function(e){
//    $('.alert-message').hide();
//    var that = $(this);
//    var text = $('span.text', that.parent());
//    var input = $('#' + text.attr('id') + '_input');
//    text.hide();
//    that.hide();
//    input.val(text.text()).show().focus();
//    input.unbind('change').change(function(){
//      if (input.val().trim().length == 0) {
//        e.preventDefault();
//        return;
//      }
//      $.ajax({
//        type: 'POST',
//        url: '/api/app.json/' + $('#id_input').val(), 
//        data: {
//          name: $('#app_name').text(),
//          url: $('#url_input').val(),
//          category: 0
//        },
//        success: function(data, status){
//          console.log('success', data);
//          text.text(input.val());
//          $('#alert-message-success').show();
//        },
//        error: function(xhr, status, c){
//          var data = JSON.parse(xhr.responseText);
//          $('#error-description').text(data.error);
//          $('#alert-message-error').show();
//        }
//      });
//    });
//    input.blur(function(){
//      text.show();
//      that.show();
//      input.hide();
//    });
//  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
