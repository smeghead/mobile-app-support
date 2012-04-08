$(function() {
    var app_id = $('#id_input').val();
    console.log('app_id:' + app_id);
    if (app_id) {
      $('#menu-app .menu-app').each(function(){
        var $this = $(this);
        if ($this.data('id') == app_id) {
          $this.next().show();
        }
      });
    }
});  

// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
