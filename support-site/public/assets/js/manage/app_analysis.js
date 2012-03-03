$(function(){
  $('table#table-for-graph').visualize({
    type: 'line',
    width: $('#data-table').css('width'),
    height: 150
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
