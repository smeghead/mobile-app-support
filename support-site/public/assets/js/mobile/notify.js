function h(value) {
  return $('<div/>').text(value || '').html();
}
function getUrlVars() {
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i <hashes.length; i++)
  {
    hash = hashes[i].split('=');
    vars.push(hash[0]);
    vars[hash[0]] = hash[1];
  }
  return vars;
}
$(function(){
  $('#jump-to-activity').click(function(){
    var activity = getUrlVars()['activity'];
    if (typeof(___android___) != undefined) {
      ___android___.jump(activity);
    }
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
