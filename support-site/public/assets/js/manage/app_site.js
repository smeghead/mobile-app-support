(function($){
  var hash = window.location.hash;
  var handlers  = [];
  var opt = {};

  $.extend({
    anchorHandler: {
      apply: function() {
        $.map(handlers, function(handler){
          var match = hash.match(handler.r) && hash.match(handler.r)[0] || false;
          if (match)  { handler.cb.apply($('a[href*='+match+']').get(0), [handler.r, hash || '']); }
        });
        return $.anchorHandler;
      },
      add: function(regexp, callback, options) {
        var opt  = $.extend({handleClick: true, preserveHash: true}, options);
        if (opt.handleClick) { 
          $('a[href*=#]').each(function(i, a){
            if (a.href.match(regexp)) {
              $(a).bind('click.anchorHandler', function(){
                if (opt.preserveHash) { window.location.hash = a.hash; }
                return callback.apply(this, [regexp, a.href]);
              });
            }
          }); 
        }
        handlers.push({r: regexp, cb: callback});
        $($.anchorHandler.apply);
        return $.anchorHandler;
      }
    }
  });
})(jQuery);

function h(value) {
  return $('<div/>').text(value || '').html();
}
function setup_tabs(){
  //display tabs.
  var tabs = ['top', 'faq', 'inquiry'];
  var hash = location.hash;
  var anchor = hash.indexOf('#') == 0 ? hash.substring(1) : hash;
  if ($.inArray(anchor, tabs) == -1) {
    anchor = 'top';
  }
  $(tabs).each(function(){
    var tab = $('#tabs_' + this);
    var box = $('#tab_' + this);
    if (anchor == this) {
      tab.addClass('active');
      box.show();
    } else {
      tab.removeClass('active');
      box.hide();
    }
  });
  $('html, body').scrollTop(0);
}
function setup_faq_draggable(elements) {
  elements.draggable({
    axis: 'y',
    opacity: 0.9,
    helper: 'clone',
    cursorAt: 'left'
  })
  .bind('dragstart', function(event, ui){
  })
  .bind('drag', function(event, ui){
    var path = get_move_info(event, ui);
    $('#faqs li').each(function(){
      var self = $(this);
      if (path.to.data('id') != path.from.data('id') && self.data('id') == path.to.data('id')) {
        if (!self.hasClass('target')) {
console.log('set target to ' + self.data('id'));
          self.addClass('target');
        }
      } else {
        self.removeClass('target');
      }
    });
  })
  .bind('dragstop', function(event, ui){
    var path = get_move_info(event, ui);
    if (path.from == null) return;
    var new_element = path.from.clone();
    new_element.insertBefore(path.to);
    setup_faq_draggable(new_element);
    path.from.remove();
    $('#faqs li').removeClass('target');
  });
  var get_move_info = function(event, ui){
    var end_point = $(ui.target).position().top;
    var target = null,
        original = null,
        original_id = $(event.target).data('id');
    $('#faqs li').each(function(){
      if ($(this).css('position') == 'absolute') return;
      if (target == null && $(this).position().top > end_point) {
        target = $(this);
      }
      if ($(this).data('id') == original_id) {
        original = $(this);
      }
    });
    target = target || $('#faqs li').last();
    return {
      from: original,
      to: target
    };
  };
  return elements;
}
$(function(){
  $.anchorHandler
    .add(/\#top/, setup_tabs)
    .add(/\#faq/, setup_tabs)
    .add(/\#inquiry/, setup_tabs);
  setup_tabs();

  //setup editor
  $.ajax({
    type: 'GET',
    url: '/api/app_top_content.json/' + $('#id_input').val(), 
    success: function(data, status){
      console.log('success', data);
      $('#top_content').text(data.app_top_content.content);
      $('#top_content').wysiwyg({
        controls: {
          html: { visible: true },
          codesnipet: { visible: false },
          underline: { visible: false },
          subscript: { visible: false },
          superscript: { visible: true }
        }
      });
    },
    error: function(xhr, status, c){
      console.log(xhr.responseText);
      var data = JSON.parse(xhr.responseText || '{}');
      $('#error-description').text(data.error);
      $('#alert-message-error').show();
    }
  });
  // トップコンテンツの保存
  $('#top_content_save').click(function(e){
    console.log($('#top_content').val());
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: '/api/app_top_content.json/' + $('#id_input').val(), 
      data: {
        content: $('#top_content').val()
      },
      success: function(data, status){
        console.log('success', data);
        $('#alert-message-success').show();
      },
      error: function(xhr, status, c){
        console.log(xhr.responseText);
        var data = JSON.parse(xhr.responseText || '{}');
        $('#error-description').text(data.error);
        $('#alert-message-error').show();
      }
    });
  });

  //setup faq
  $.ajax({
    type: 'GET',
    url: '/api/faq.json/' + $('#id_input').val(), 
    success: function(data, status){
      console.log('success', data);
      var faqs = $('#faqs ul');
      $(data.faqs).each(function(){
        console.log(this);
        if (this.type == 'category') {
          faqs.append(setup_faq_draggable(create_category(this.id, this.name)));
        } else {
          faqs.append(setup_faq_draggable(create_qa(this.id, this.question, this.answer)));
        }
      });
    },
    error: function(xhr, status, c){
      console.log(xhr.responseText);
      var data = JSON.parse(xhr.responseText || '{}');
      $('#error-description').text(data.error);
      $('#alert-message-error').show();
    }
  });
  setup_faq_draggable($('#faqs li'));
  $('.open_add_category').click(function(){
    $('#modal_add_qa_category').modal({
      keyboard: true,
      backdrop: true,
      show: true
    });
    $('#modal_add_qa_category').bind('shown', function(){
      $('#new_category_name').focus();
    });
  });
  $('#form_add_category').submit(function(){
    $('#btn_add_category').click();
    this.cancel();
  });
  var create_category = function(id, category_name){
    return $('<li class="faq-category" data-id="' + h(id) + '">' +
      '<span class="category_name">' + h(category_name) + '</span>' +
      '<span class="right qa-delete delete-icon" title="削除">&nbsp;</span>' +
      '<span class="right qa-edit edit-icon" title="編集">&nbsp;</span>' +
      '<br class="close"/>' +
      '</li>');
  };
  $('.add_qa_category').click(function(){
    if ($('#new_category_name').val().trim().length == 0) {
      return;
    }
    var category = create_category(parseInt(new Date()/1000, 10), $('#new_category_name').val().trim());
    $('#faqs ul').append(setup_faq_draggable(category));
    $('#modal_add_qa_category').modal('hide');
  });
  $('.qa_modal_close').click(function(){
    $('#modal_add_qa_category').modal('hide');
  });
  //カテゴリの編集
  $('.faq-category').live('click', function(){
    $('#category_name').unbind('change');
    $('div#form-category').show().submit(function(){this.cancel()});
    $('div#form-qa').hide();
    $('.faq-category, .faq-element').removeClass('editting');
    var li = $(this);
    li.addClass('editting');
    var category_name = $('span.category_name', li);
    $('#category_name').val(category_name.text())
      .change(function(){category_name.text($(this).val());})
      .focus();
  });
  //カテゴリの削除
  var target;
  $('.faq-category .qa-delete').live('click', function(){
    target = $(this).parent('li');
    $('.target', $('#modal_delete_confirm')).text('カテゴリ');
    $('#modal_delete_confirm').modal({
      keyboard: true,
      backdrop: true,
      show: true
    });
  });
  $('#modal_delete_confirm .delete_qa').live('click', function(){
    target.remove();
    $('#modal_delete_confirm').modal('hide');
  });
  $('#modal_delete_confirm .qa_modal_close').live('click', function(){
    $('#modal_delete_confirm').modal('hide');
  });
  var create_qa = function(id, q, a){
    return $('<li class="faq-element" data-id="' + h(id) + '">' +
        '  <span class="qa_name" data-a="' + h(a) + '">' + h(q) + '</span>' +
        '  <span class="right qa-delete delete-icon" title="削除">&nbsp;</span>' +
        '  <span class="right qa-edit edit-icon" title="編集">&nbsp;</span>' +
        '  <br class="close"/>' +
        '</li>');
  };
  //QAの追加
  $('.add-qa').click(function(){
    console.log('add qa');
    var qa = create_qa(parseInt(new Date()/1000, 10));
    $('#faqs ul').append(setup_faq_draggable(qa));
    $('.qa-edit', qa).click();
  });
  //QAの編集
  $('.faq-element').live('click', function(){
    $('#faq_q, #faq_a').unbind('change');
    $('div#form-category').hide();
    $('div#form-qa').show();
    $('.faq-category, .faq-element').removeClass('editting');
    var li = $(this)
    li.addClass('editting');
    var qa_name = $('span.qa_name', li);
    $('#faq_q').val(qa_name.text())
      .change(function(){qa_name.text($(this).val());})
      .focus();
    $('#faq_a').val(qa_name.data('a'))
      .change(function(){qa_name.data('a', $(this).val());});
  });
  //QAの削除
  $('.faq-element .qa-delete').live('click', function(){
    target = $(this).parent('li');
    $('.target', $('#modal_delete_confirm')).text('QA');
    $('#modal_delete_confirm').modal({
      keyboard: true,
      backdrop: true,
      show: true
    });
  });
  //FAQ の更新
  $('#faq_save').click(function(){
    var faqs = [];
    var last_category_id;
    $('#faqs ul li').each(function(){
      var li = $(this);
      if (li.hasClass('faq-category')) {
        last_category_id = li.data('id');
        console.log($('span.category_name', li));
        faqs.push({
          type: 'category',
          id: li.data('id'),
          app_id: $('#id_input').val(),
          name: $('span.category_name', li).text()
        });
      } else {
        var qa = $('.qa_name', li);
        faqs.push({
          type: 'qa',
          id: li.data('id'),
          app_id: $('#id_input').val(),
          category_id: last_category_id,
          question: qa.text(),
          answer: qa.data('a')
        });
      }

    });
    console.log(faqs);
    $.ajax({
      type: 'POST',
      url: '/api/faq.json/' + $('#id_input').val(), 
      data: {
        json: JSON.stringify(faqs)
      },
      success: function(data, status){
        console.log('success', data);
        $('#alert-message-success').show();
      },
      error: function(xhr, status, c){
        console.log(xhr.responseText);
        var data = JSON.parse(xhr.responseText || '{}');
        $('#error-description').text(data.error);
        $('#alert-message-error').show();
      }
    });
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
