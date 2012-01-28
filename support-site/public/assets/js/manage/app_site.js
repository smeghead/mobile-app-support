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
//    containment: 'parent',
    axis: 'y',
    opacity: 0.9,
    helper: 'clone'
  })
  .bind('dragstart', function(event, ui){
console.log('start', ui.clientY);
  })
  .bind('drag', function(event, ui){
//console.log('drag');
  })
  .bind('dragstop', function(event, ui){
console.log(ui);
    var end_point = $(ui.target).position().top;
    var target = null,
        original = null,
        original_id = $(event.target).data('id');
    $('#faqs li').each(function(){
      if ($(this).css('position') == 'absolute') return;
//console.log('check', $(this).text().trim());
console.log($(this).position().top, end_point);
      if (target == null && $(this).position().top > end_point) {
        target = $(this);
        console.log('hit');
console.log('target', target);
      }
      if ($(this).data('id') == original_id) {
        original = $(this);
      }
    });
    target = target || $('#faqs li').first();
console.log('original', original);
    if (original == null) return;
    var new_element = original.clone();
    new_element.insertBefore(target);
    setup_faq_draggable(new_element);
    original.remove();
    //$(target).insertBefore($(original).remove());
//    $('#faqs li').draggable('destroy');
    //re-setup
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
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
