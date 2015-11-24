<?$this->title="Отчет за период"?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Отчет</div>
  <div class="panel-body">
  </div>

  <!-- Table -->
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Категория</th>
        <th>Пользователь</th>
        <th>Сумма в руб.</th>
      </tr>
    </thead>
    <tbody>
<?
$i = 0;
$summa = 0;
?>    
<?if(isset($query)):?>
    <? foreach($query as $quer): ?>
        <?$i = $i + 1;?>
        <tr>
            <td><?=$i?></td>
            <td><?=$quer['categ_name']?></td>
            <td><?=$quer['user_name']?></td>
            <td><?=$quer['suma_rub']?></td>
            <?$summa = $summa + $quer['suma_rub'] ?>
        </tr>
    <? endforeach; ?>
    <tr><td></td><td></td><td>Итого:</td><td><?=$summa?></td></tr>
<?else:?>
<p>За заданный период ничего нет</p>    
<?endif;?>
    </tbody>
  </table>
</div>

