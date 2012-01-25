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
  console.log('cb');
  //display tabs.
  var tabs = ['top', 'faq', 'inquiry'];
  var hash = location.hash;
  var anchor = hash.indexOf('#') == 0 ? hash.substring(1) : hash;
  if ($.inArray(anchor, tabs) == -1) {
    anchor = 'top';
  }
  $(tabs).each(function(){
    var tab = $('#tabs_' + this);
    var box = $('#' + this);
    console.log('x :' + this);
    if (anchor == this) {
      tab.addClass('active');
      box.show();
    } else {
      tab.removeClass('active');
      box.hide();
    }
  });
}
$(function(){
  $.anchorHandler
    .add(/\#top/, setup_tabs)
    .add(/\#faq/, setup_tabs)
    .add(/\#inquiry/, setup_tabs);
  console.log('init');
  setup_tabs();

});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
