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
        var data = JSON.parse(xhr.responseText || '{error:""}');
        $('#dialog-header').text('エラー');
        $('#dialog-content').text(data.error);
        $("<a href='#dialog' data-rel='dialog'></a>").click().remove();
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
    var code = location.pathname.match(/\/([^\/]+)$/)[1];
    console.log('code' + code);
    $('#inquiry_form').submit(function(event){
      console.log('submit', event);
      $.ajax({
        type: 'POST',
        url: '/api/inquiry.json/' + code, 
        data: {
          email: $('#email').val(),
          question: $('#question').val()
        },
        success: function(data, status){
          console.log('success', data);
          $('#dialog-header').text('お問い合わせ');
          $('#dialog-content').text('ありがとうございます。お問い合わせを受け付けました。入力されたメールアドレス宛てに回答しますので、しばらくお待ちください。');
          $("<a href='#dialog' data-rel='dialog'></a>").click().remove();
          $('#email,#question').val('');
        },
        error: function(xhr, status, c){
          console.log(xhr.responseText);
          var data = {error:''};
          console.log('first letter: ' + xhr.responseText.indexOf(0));
          if (xhr.responseText.substring(0, 1) == '{') {
            data = JSON.parse(xhr.responseText || '{error:""}');
          }
          $('#dialog-header').text('エラー');
          $('#dialog-content').text('エラーが発生しました。再度エラーが発生する場合、PaRappaサポートまでご連絡下さい。 ERROR: ' + data.error);
          $("<a href='#dialog' data-rel='dialog'></a>").click().remove();
        }
      });
      return false;
    });
  });
});
// vim: set ts=2 sw=2 sts=2 expandtab fenc=utf-8: 
