<?php

$register_mail_body = <<<EOD
#email# さん
Androidサポート Parappaへの登録ありがとうございます。

以下のサイトにてログインして、PaRappaをを利用下さい。
http://parappa.starbug1.com/manage

EOD;

$inquiry_answer_mail_body = <<<EOD
#email# さん
Androidサポート Parappaへのご質問ありがとうございます。

#content#
EOD;

return array(
  'basic' => array(
    'bcc' => 'smeghead7@gmial.com',
    'from' => 'support@starbug1.com'
  ),
  'register_mail' => array(
    'subject' => '[Parappa] ユーザ登録完了のお知らせ',
    'body' => $register_mail_body,
  ),
  'inquiry_answer_mail' => array(
    'subject' => '[Parappa] ご質問への回答',
    'body' => $inquiry_answer_mail_body,
  ),
);

/* End of file mail.php */
