<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Users Community <https://basercms.net/community/>
 *
 * @copyright       Copyright (c) baserCMS Users Community
 * @link            https://basercms.net baserCMS Project
 * @package         Mail.View
 * @since           baserCMS v 0.1.0
 * @license         https://basercms.net/license/index.html
 */

/**
 * [PUBLISH] フォーム
 */
// ブラウザのヒストリーバック（戻るボタン）対応
$this->Mail->token();
?>


<script type="text/javascript">
	$(function () {
		$(".form-submit").click(function () {
			var mode = $(this).attr('id').replace('BtnMessage', '');
			$("#MailMessageMode").val(mode);
			$(this).prop('disabled', true);//ボタンを無効化する
			$(this).closest('form').submit();//フォームを送信する
			return true;
		});
	});
</script>


<?php /* フォーム開始タグ */ ?>
<?php if (!$freezed): ?>
	<?php echo $this->Mailform->create('MailMessage', ['url' => $this->BcBaser->getContentsUrl(null, false, null, false) . 'confirm', 'type' => 'file']) ?>
<?php else: ?>
	<?php echo $this->Mailform->create('MailMessage', ['url' => $this->BcBaser->getContentsUrl(null, false, null, false) . 'submit']) ?>
<?php endif; ?>
<?php /* フォーム本体 */ ?>

<?php $this->Mailform->unlockField('MailMessage.mode') ?>
<?php echo $this->Mailform->hidden('MailMessage.mode') ?>

<table cellpadding="0" cellspacing="0" class="row-table-01">
	<?php $this->BcBaser->element('mail_input', ['blockStart' => 1]) ?>
</table>

<?php if ($mailContent['MailContent']['auth_captcha']): ?>
	<?php if (!$freezed): ?>
		<div class="auth-captcha clearfix">
			<?php echo $this->Mailform->authCaptcha('MailMessage.auth_captcha') ?>
			<br/>
			&nbsp;<?php echo __('画像の文字を入力してください') ?><br clear="all"/>
			<?php echo $this->Mailform->error('MailMessage.auth_captcha', __('入力された文字が間違っています。入力をやり直してください。')) ?>
		</div>
	<?php else: ?>
		<?php echo $this->Mailform->hidden('MailMessage.auth_captcha') ?>
		<?php echo $this->Mailform->hidden('MailMessage.captcha_id') ?>
	<?php endif ?>
<?php endif ?>

<?php /* 送信ボタン */ ?>
<div class="submit">
	<?php if ($freezed): ?>
		<?php echo $this->Mailform->submit('　' . __('書き直す') . '　', ['div' => false, 'class' => 'btn-red button form-submit', 'id' => 'BtnMessageBack']) ?>
		<?php echo $this->Mailform->submit('　' . __('送信する') . '　', ['div' => false, 'class' => 'btn-red button form-submit', 'id' => 'BtnMessageSubmit']) ?>
	<?php else: ?>
		<input name="resetdata" value="　<?php echo __('クリア') ?>　" type="reset" class="btn-gray button"/>
		<?php echo $this->Mailform->submit('　' . __('入力内容を確認する') . '　', ['div' => false, 'class' => 'btn-orange button form-submit', 'id' => 'BtnMessageConfirm']) ?>
	<?php endif; ?>
</div>

<?php echo $this->Mailform->end() ?>
