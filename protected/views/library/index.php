<?php
/* @var $this LibraryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Libraris',
);

$this->menu=array(
	array('label'=>'Create Library', 'url'=>array('create')),
	array('label'=>'Manage Library', 'url'=>array('admin')),
);
?>

<div class="main">
<div class="main-in">
	<div class="breadcrumbs">
		<ul>
			<li><a href="/">Главная</a></li>
			<li>Библиотеки в городе <?= $this->city->gorod ?></li>
		</ul>
	</div>
	<h1>Библиотеки в городе <?= $this->city->gorod ?></h1>
	<div class="shop-list">
		<div class="product-online-list">
		<?php foreach ($libs as $row) { ?>
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