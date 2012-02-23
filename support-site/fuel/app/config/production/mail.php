<?php

$register_mail_body = <<<EOD
#email# さん
Androidサポート Parappaへの登録ありがとうございます。

以下のサイトにてログインして、PaRappaをを利用下さい。
http://parappa.me/manage

EOD;

return array(
  'basic' => array(
    'bcc' => 'smeghead7@gmial.com',
    'from' => 'support@parappa.me'
  ),
  'register_mail' => array(
    'subject' => '[Parappa] ユーザ登録完了のお知らせ',
    'body' => $register_mail_body,
  )
);

/* End of file mail.php */
