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
    helper: 'clone'
  })
  .bind('dragstart', function(event, ui){
  })
  .bind('drag', function(event, ui){
  })
  .bind('dragstop', function(event, ui){
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
    target = target || $('#faqs li').first();
    if (original == null) return;
    var new_element = original.clone();
    new_element.insertBefore(target);
    setup_faq_draggable(new_element);
    original.remove();
  });
}
$(function(){
  $.anchorHandler
    .add(/\#top/, setup_tabs)
    .add(/\#faq/, setup_tabs)
    .add(/\#inquiry/, setup_tabs);
  setup_tabs();

  //setup editor
  $('#top_content').wysiwyg();

  //setup faq
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
  $('.add_qa_category').click(function(){
    if ($('#new_category_name').val().trim().length == 0) {
      return;
    }
    var category = $('<li class="faq-category" data-id="' + parseInt(new Date()/1000, 10) + '">' +
      '<span class="category_name">' + $('#new_category_name').val().trim() + '</span>' +
      '<span class="right qa-delete">&nbsp;</span>' +
      '<span class="right qa-edit">&nbsp;</span>' +
      '<br class="close"/>' +
      '</li>');
    $('#faqs ul').append(category);
    $('#modal_add_qa_category').modal('hide');
  });
  $('.qa_modal_close').click(function(){
    $('#modal_add_qa_category').modal('hide');
  });
  //カテゴリの編集
  $('.faq-category .qa-edit').click(function(){
    $('div#form-category').show().submit(function(){this.cancel()});
    $('div#form-qa').hide();
    var category_name = $('span.category_name', $(this).parent('.faq-category'));
    $('#category_name').val(category_name.text())
      .change(function(){category_name.text($(this).val());})
      .focus();
  });
  //カテゴリの削除
  var target;
  $('.faq-category .qa-delete').click(function(){
    target = $(this).parent('li');
    $('.target', $('#modal_delete_confirm')).text('カテゴリ');
    $('#modal_delete_confirm').modal({
      keyboard: true,
      backdrop: true,
      show: true
    });
  });
  $('#modal_delete_confirm .delete_qa').click(function(){
    target.remove();
    $('#modal_delete_confirm').modal('hide');
  });
  $('#modal_delete_confirm .qa_modal_close').click(function(){
    $('#modal_delete_confirm').modal('hide');
  });
  //QAの編集
  $('.faq-element .qa-edit').click(function(){
    $('div#form-category').hide();
    $('div#form-qa').show();
    var qa_name = $('span.qa_name', $(this).parent('.faq-element'));
    $('#faq_q').val(qa_name.text())
      .change(function(){qa_name.text($(this).val());})
      .focus();
    $('#faq_a').val(qa_name.data('a'))
  });
  //QAの削除
  $('.faq-element .qa-delete').click(function(){
    target = $(this).parent('li');
    $('.target', $('#modal_delete_confirm')).text('QA');
    $('#modal_delete_confirm').modal({
      keyboard: true,
      backdrop: true,
      show: true
    });
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
