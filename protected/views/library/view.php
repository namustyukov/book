<?php
/* @var $this LibraryController */
/* @var $model Library */

$this->breadcrumbs=array(
	'Libraris'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Library', 'url'=>array('index')),
	array('label'=>'Create Library', 'url'=>array('create')),
	array('label'=>'Update Library', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Library', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Library', 'url'=>array('admin')),
);
?>

<div class="main">
<div class="main-in">
	<div class="breadcrumbs">
		<ul>
			<li><a href="/">Главная</a></li>
			<li><a href="/<?= $this->city->simbol_name ?>"><?= $this->city->gorod ?></a></li>
			<li><a href="/<?= $this->city->simbol_name ?>/library/list">Библиотеки</a></li>
			<li><?= $model->name ?></li>
		</ul>
	</div>
	<h1><?= $model->name ?> в городе <?= $this->city->gorod ?></h1>
	<div class="middle-menu">
		<div class="online-view-logo">
			<img src="/img/derault_company_<?= $model->id % 5 ?>.jpg" alt="<?= $model->name ?> в городе <?= $this->city->gorod ?>">
		</div>
		<div class="ads-sidebar">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- bookone sidebar -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:240px;height:400px"
				 data-ad-client="ca-pub-9040033498726551"
				 data-ad-slot="9328884028"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
	<div class="online-view">
		<div class="online-view-param">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>Рейтинг</td>
					<td><?= $model->rating ?> из <?= $countCompany ?></td>
				</tr>
			<?php if ($model->address) { ?>
				<tr>
					<td>Адрес</td>
					<td><?= $model->address ?></td>
				</tr>
			<?php } ?>
			<?php if ($model->phone) { ?>
				<tr>
					<td>Номер телефона</td>
					<td><?= $model->phone ?></td>
				</tr>
			<?php } ?>
			<?php if ($model->worktime) { ?>
				<tr>
					<td>Время работы</td>
					<td><?= $model->worktime ?></td>
				</tr>
			<?php } ?>
				<tr>
					<td>Краткое описание</td>
					<td>Описание отсутствует</td>
				</tr>
			</table>
		</div>
		<div class="product-view-online">
			<h3>Другие библиотеки в городе <?=$this->city->gorod?></h3>
			<div class="product-online-list">
			<?php foreach ($other as $row) { ?>
				<a href="/<?= $this->city->simbol_name ?>/library/<?= $row->url ?>">
					<div class="product-online-item">
						<div class="product-online-item_img">
							<img src="/img/derault_company_<?= $row->id % 5 ?>.jpg" alt="<?= $row->name ?> в городе <?= $this->city->gorod ?>">
						</div>
						<div class="product-online-item_content">
							<p class="__title"><?= $row->name ?></p>
							<p class="__rating"><span>рейтинг</span><?= $row->rating ?> из <?= $countCompany ?></p>
							<p class="__address"><?= $row->address ? $row->address : $this->city->gorod ?></p>
						</div>
					</div>
				</a>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>