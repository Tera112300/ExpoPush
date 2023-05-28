<?php
$this->BcAdmin->setTitle('プッシュ通知一覧');
$this->BcAdmin->addAdminMainBodyHeaderLinks(['url' => ['action' => 'add'],'title' => '新規追加']);
?>
<table class="list-table bca-table-listup" id="ListTable">
    <thead class="bca-table-listup__thead">
        <tr>
            <th class="bca-table-listup__thead-th">ID</th>
            <th class="bca-table-listup__thead-th">タイトル</th>
            <th class="bca-table-listup__thead-th">ステータス</th>
            <th class="bca-table-listup__thead-th">作成日</th>
			<th class="bca-table-listup__thead-th">アクション</th>
        </tr>
    </thead>
    <tbody class="bca-table-listup__tbody">
       
        <?php if(!$datas->isEmpty()): foreach($datas as $data): ?>
        <tr>
        <td class="bca-table-listup__tbody-td"><?= $data->id; ?></td>
        <td class="bca-table-listup__tbody-td"><?= h($data->name); ?></td>
        <td class="bca-table-listup__tbody-td"><?= $data->push_flag == 1 ? "送信済み" : "未送信"; ?></td>
        <td class="bca-table-listup__tbody-td"><?= $data->created->format("Y-m-d H:i:s"); ?></td>
        <td class="bca-table-listup__tbody-td">
        <?= $this->BcBaser->link('',['action' => 'edit', $data->id],['title' => '編集', 'class' => ' bca-btn-icon', 'data-bca-btn-type' => 'edit', 'data-bca-btn-size' => 'lg']) ?>
        <?= $this->BcAdminForm->postLink('',['action' => 'delete', $data->id],['confirm' => '本当に削除してもいいですか？','title' => '削除','class' => 'btn-delete bca-btn-icon','data-bca-btn-type' => 'delete','data-bca-btn-size' => 'lg']) ?>
        </td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="5" class="bca-table-listup__tbody-td">
                <p class="no-data">データが見つかりませんでした。</p>
            </td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>


<div class="bca-data-list__bottom">
  <div class="bca-data-list__sub">
    <?php $this->BcBaser->element('pagination') ?>   
    <?php $this->BcBaser->element('list_num') ?>
  </div>
</div>