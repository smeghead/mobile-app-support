<?php $messages = array_values($inquiry->inquiry_messages); ?>
<script type="text/javascript" src="/assets/js/manage/app.js"></script>
<ul class="breadcrumb">
  <li>
    <a href="/manage/">アプリ一覧</a> <span class="divider">/</span>
  </li>
  <li>
    <a href="/manage/app/<?php echo $app->id; ?>"><?php echo $app->name; ?></a> <span class="divider">/</span>
  </li>
  <li class="">
    <a href="/manage/app_site/<?php echo $app->id; ?>#inquiry">お問い合わせ</a> <span class="divider">/</span>
  </li>
  <li class="active">
    <a href=""><?php echo e(mb_strimwidth($messages[0]->content, 0, 20, '...')); ?></a>
  </li>
</ul>
<h1>お問い合わせ</h1>
<input class="hide" id="id_input" type="hidden" value="<?php echo $app->id; ?>" />
<div class="alert alert-error hide">
  <a class="close" data-dismiss="alert">&times;</a>
  <p>更新に失敗しました。<span id="error-description"></span></p>
</div>

<form action="/manage/inquiry/<?php echo $app->id; ?>/<?php echo $inquiry->id; ?>" method="post" class="form-horizontal">
  <fieldset>
    <div class="control-group">
      <label class="control-label">質問日時</label>
      <div class="controls">
        <span class="xlarge"><?php echo date('Y-m-d H:i:s', $inquiry->asked_at); ?></span>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group">
      <label class="control-label">メールアドレス</label>
      <div class="controls">
        <span class="xlarge"><?php echo e($messages[0]->email); ?></span>
      </div>
    </div><!-- /clearfix -->
    <div class="control-group">
      <label class="control-label">質問内容</label>
      <div class="controls">
        <pre class="input-xlarge" rows="10"><?php echo e($messages[0]->content); ?></pre>
      </div>
    </div><!-- /clearfix -->
<?php if (count($messages) > 1) { ?>
<?php   foreach (array_slice($messages, 1) as $m) { ?>
    <div class="control-group">
      <label class="control-label">回答履歴</label>
      <div class="controls">
        <span class="xlarge"><?php echo e($m->email); ?></span>
        <span class="xlarge"><?php echo date('Y-m-d H:i:s', $m->created_at); ?></span>
        <pre class="input-xlarge" rows="10"><?php echo e($m->content); ?></pre>
      </div>
    </div><!-- /clearfix -->
<?php   } ?>
<?php } ?>
    <div class="control-group <?php if (isset($errors['answer'])) { echo 'error'; } ?>">
      <label for="answer" class="control-label">回答</label>
      <div class="controls">
        <textarea class="input-xlarge" id="answer" name="answer" rows="10"><?php echo Input::post('answer') ?></textarea>
<?php if (isset($errors['answer'])) { ?>
        <span class="help-inline"><?php echo $errors['answer'] ?></span>
<?php } ?>
      </div>
    </div><!-- /clearfix -->
  </fieldset>

  <div class="form-actions">
  <input type="submit" class="btn btn-primary" value="回答">&nbsp;<a href="/manage/app_site/<?php echo $app->id; ?>#inquiry" class="btn">キャンセル</a>
  </div>
</form>
