function h(value) {
  return $('<div/>').text(value || '').html();
}
$(function(){
  //home
  $('#home').live( 'pageinit',function(event){
  });

  //faq
  $('#faq').live( 'pageinit',function(event){
    var code = location.pathname.match(/\/([^\/]+)$/)[1];
    $.ajax({
      type: 'GET',
      url: '/api/faq.json/?code=' + code, 
      success: function(data, status){
        console.log('success', data);
        var faqs = $('#faqs');
        $(data.faqs).each(function(){
          console.log(this);
          if (this.type == 'category') {
            faqs.append(create_category(this.id, this.name));
          } else {
            faqs.append(create_qa(this.id, this.question, this.answer));
          }
        });
        $('#faqs').listview('refresh');
      },
      error: function(xhr, status, c){
        console.log(xhr.responseText);
        var data = JSON.parse(xhr.responseText || '{}');
        $('#error-description').text(data.error);
        $('#alert-message-error').show();
      }
    });
  });
  var create_qa = function(id, q, a){
    var page = $(
      '<div data-role="page" id="faq_' + id + '">' +
      '  <div data-role="header" data-theme="d"><h1>FAQ</h1></div>' +
      '  <div data-role="content" data-theme="c">' +
      '   <h1>' + h(q) + '</h1>' +
      '   <p>' + h(a) + '</p>' +
      '   <a href="#faq" data-role="button" data-rel="back" data-theme="c">閉じる</a>' +
      ' </div>' +
      '</div>');
    $('body').append(page);
    return $('<li><a href="#faq_' + id + '" data-rel="dialog">' + h(q) + '</a></li>');
  };
  var create_category = function(id, category_name){
    return $('<li data-role="list-divider">' + h(category_name) + '</li>');
  };

  //inquiry
  $('#inquiry').live( 'pageinit',function(event){
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
