<?php
/* @var $this ShopOnlineController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Shop Onlines',
);

$this->menu=array(
	array('label'=>'Create ShopOnline', 'url'=>array('create')),
	array('label'=>'Manage ShopOnline', 'url'=>array('admin')),
);
?>

<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
			<ul>
				<li><a href="/">Главная</a></li>
				<li>Книжные онлайн магазины в городе <?= $this->city->gorod ?></li>
			</ul>
		</div>
		<h1>Книжные онлайн магазины в городе <?= $this->city->gorod ?></h1>
		<div class="shop-list">
			<div class="product-online-list">
			<?php foreach ($shopOnline as $online) { ?>
				<a href="/<?= $this->city->simbol_name ?>/online/<?= $online->url ?>">
					<div class="product-online-item">
						<div class="product-online-item_img">
							<img src="/img/<?= $online->logo ?>" alt="<?= $online->name ?> в городе <?= $this->city->gorod ?>">
						</div>
						<div class="product-online-item_content">
							<p class="__title"><?= $online->name ?></p>
							<p class="__rating"><span>рейтинг</span><?= $online->rating ?> из <?= count($shopOnline) ?></p>
							<p class="__goods_type"><?= $online->goods_type ?></p>
						</div>
					</div>
				</a>
			<?php } ?>
			</div>
		</div>
	</div>
</div>