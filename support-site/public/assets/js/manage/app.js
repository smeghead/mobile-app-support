$(function(){
  //アプリ名
  $('.name-edit').click(function(e){
    $('.alert-message').hide();
    var that = $(this);
    var text = $('span.text', that.parent());
    var input = $('#' + text.attr('id') + '_input');
    text.hide();
    that.hide();
    input.val(text.text()).show().focus();
    input.unbind('change').change(function(){
      if (input.val().trim().length == 0) {
        e.preventDefault();
        return;
      }
      console.log($('#app_name_input').val());
      $.ajax({
        type: 'POST',
        url: '/api/app.json/' + $('#id_input').val(), 
        data: {
          name: $('#app_name_input').val(),
          url: $('#url').text(),
          category: $('#category_input').val()
        },
        success: function(data, status){
          console.log('success', data);
          text.text(input.val());
          $('#alert-message-success').show();
        },
        error: function(xhr, status, c){
          var data = JSON.parse(xhr.responseText);
          $('#error-description').text(data.error);
          $('#alert-message-error').show();
        }
      });
    });
    input.blur(function(){
      text.show();
      that.show();
      input.hide();
    });
  });

  //url
  $('.url-edit').click(function(e){
    $('.alert-message').hide();
    var that = $(this);
    var text = $('span.text', that.parent());
    var input = $('#' + text.attr('id') + '_input');
    text.hide();
    that.hide();
    input.val(text.text()).show().focus();
    input.unbind('change').change(function(){
      if (input.val().trim().length == 0) {
        e.preventDefault();
        return;
      }
      $.ajax({
        type: 'POST',
        url: '/api/app.json/' + $('#id_input').val(), 
        data: {
          name: $('#app_name').text(),
          url: $('#url_input').val(),
          category: $('#category_input').val()
        },
        success: function(data, status){
          console.log('success', data);
          text.text(input.val());
          $('#alert-message-success').show();
        },
        error: function(xhr, status, c){
          var data = JSON.parse(xhr.responseText);
          $('#error-description').text(data.error);
          $('#alert-message-error').show();
        }
      });
    });
    input.blur(function(){
      text.show();
      that.show();
      input.hide();
    });
  });

  //カテゴリ
  $('.category-edit').click(function(e){
    $('.alert-message').hide();
    var that = $(this);
    var text = $('span.text', that.parent());
    var input = $('#' + text.attr('id') + '_input');
    text.hide();
    that.hide();
    input.val(text.text()).show().focus();
    input.unbind('change').change(function(){
      if (input.val().trim().length == 0) {
        e.preventDefault();
        return;
      }
      $.ajax({
        type: 'POST',
        url: '/api/app.json/' + $('#id_input').val(), 
        data: {
          name: $('#app_name').text(),
          url: $('#url').text(),
          category: $('#category_input').val()
        },
        success: function(data, status){
          console.log('success', data);
          text.text(input.children(':selected').text());
          $('#alert-message-success').show();
        },
        error: function(xhr, status, c){
          var data = JSON.parse(xhr.responseText);
          $('#error-description').text(data.error);
          $('#alert-message-error').show();
        }
      });
    });
    input.blur(function(){
      text.show();
      that.show();
      input.hide();
    });
  });
  $('#category').text($('#category_input').children(':selected').text());
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
