<?php
$this->BcAdmin->setTitle('プッシュ通知');
?>

<div class="bca-data-list__top">
	<div>
		<?php $this->BcBaser->link("プッシュ通知管理一覧に戻る", ['action' => 'index'], ['class' => 'bca-btn', 'data-bca-btn-type' => 'back-to-list', 'data-bca-btn-size' => 'sm']); ?>
	</div>
</div>
<?= $this->BcAdminForm->create($data,["id" => "expo_posts_form"]); ?>
<section class="bca-section">
  <?= $this->BcAdminForm->control('id', ['type' => 'hidden']); ?>
  <table id="FormTable" class="form-table bca-form-table">
    <tr>
      <th class="col-head bca-form-table__label">タイトル&nbsp;<span class="required bca-label" data-bca-label-type="required">必須</span></th>
      <td class="col-input bca-form-table__input">
        <?= $this->BcAdminForm->control('name', ['type' => 'text',
          'size' => 80,
          'maxlength' => 255,
          'autofocus' => true,
          'data-input-text-size' => 'full-counter',
          'counter' => true]); ?>
        <?= $this->BcAdminForm->error('name'); ?>
      </td>
    </tr>
    <tr>
      <th class="col-head bca-form-table__label">説明文</th>
      <td class="col-input bca-form-table__input">
        <?= $this->BcAdminForm->control('description', ['type' => 'textarea']); ?>
        <?= $this->BcAdminForm->error('description'); ?>
      </td>
    </tr>

    <tr>
      <th class="col-head bca-form-table__label">プッシュ通知</th>
      <td class="col-input bca-form-table__input">
        <?php if($data->push_flag == 0):?>
        <?= $this->BcAdminForm->control('push_flag', ['type' => 'checkbox','value' => "1",'label' => '※チェックをつけるとプッシュ通知が送信されます。']); ?>
        <?php else: ?>
        <?= $this->BcAdminForm->control('push_flag', ['type' => 'checkbox','value' => "1",'label' => '※送信済みです。','disabled' => 'disabled']); ?>
        <?php endif; ?>
        <?= $this->BcAdminForm->error('push_flag'); ?><br>
    </tr>

  </table>
</section>

<div class="submit bca-actions">
  <div class="bca-actions__main">
    <?= $this->BcAdminForm->button("保存",[
      'div' => false,
      'class' => 'button bca-btn bca-actions__item bca-loading',
      'data-bca-btn-type' => 'save',
      'data-bca-btn-size' => 'lg',
      'data-bca-btn-width' => 'lg',
	  ]); ?>
  </div>
  <div class="bca-actions__sub">
      <?= $this->BcAdminForm->postLink('削除',
        ['action' => 'delete', $data->id],
        ['block' => true,'confirm' => '本当に削除してもいいですか？','class' => 'bca-submit-token button bca-btn bca-actions__item','data-bca-btn-type' => 'delete','data-bca-btn-size' => 'sm']
      ); ?>
  </div>
</div>


<?= $this->BcAdminForm->end(); ?>
<!-- 削除用フォームを生成 -->
<?= $this->fetch('postLink'); ?>

<script>
$(function(){
  $(".bca-actions__main button.bca-btn").on("click",function(e){
    let push_flag = $("#push-flag:checked:not(:disabled)").val();
    if(push_flag == 1){
    e.preventDefault();
    if(confirm("プッシュ通知を本当に送信しますか？")){
    $("#expo_posts_form").submit();
   }else{
    $("#Waiting").hide();
   }
   }
  });
});
</script>