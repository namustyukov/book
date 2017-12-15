<?php
$this->menu=array(
	array('label'=>'List ShopOnline', 'url'=>array('index')),
	array('label'=>'Create ShopOnline', 'url'=>array('create')),
	array('label'=>'Update ShopOnline', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ShopOnline', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ShopOnline', 'url'=>array('admin')),
);
?>

<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
			<ul>
				<li><a href="/">Главная</a></li>
				<li><a href="/<?= $this->city->simbol_name ?>"><?= $this->city->gorod ?></a></li>
				<li><a href="/<?= $this->city->simbol_name ?>/online/list">Книжные онлайн магазины</a></li>
				<li><?= $model->name ?></li>
			</ul>
		</div>
		<h1>Интернет-магазин <?= $model->name ?> в городе <?= $this->city->gorod ?></h1>
		<div class="middle-menu">
			<div class="online-view-logo">
				<img src="/img/<?= $model->logo ?>" alt="<?= $model->name ?> в городе <?= $this->city->gorod ?>">
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
						<td><?= $model->rating ?> из <?= $count ?></td>
					</tr>
					<tr>
						<td>Сайт</td>
						<td><?= $model->site ?></td>
					</tr>
					<tr>
						<td>Способы оплаты</td>
						<td><?= $model->payment ?></td>
					</tr>
					<tr>
						<td>Группа товаров/услуг</td>
						<td><?= $model->goods_type ?></td>
					</tr>
					<tr>
						<td>Условия покупки и получения книги</td>
						<td><?= $model->buy_condition ?></td>
					</tr>
					<tr>
						<td>Время работы доставки книг по Москве</td>
						<td><?= $model->delivery ?></td>
					</tr>
					<tr>
						<td>Отделы выдачи товаров в Москве</td>
						<td><?= $model->address ?></td>
					</tr>
					<tr>
						<td>Время работы отделов</td>
						<td><?= $model->worktime ?></td>
					</tr>
					<tr>
						<td>Телефон для связи</td>
						<td><?= $model->phone ?></td>
					</tr>
				<?php if ($this->city->id != '425') { ?>
					<tr>
						<td>Доставка из города</td>
						<td><?= $model->delivery_from ?></td>
					</tr>
				<?php } ?>
					<tr>
						<td>Способы доставки по городу <?= $this->city->gorod ?></td>
						<td><?= $model->delivery_out ?></td>
					</tr>
				</table>
				<div class="online-view-desc">
					<h2>Краткое описание</h2>
					<p><?= $model->description ?> Жителям города <?= $this->city->gorod ?> в полном объем доступна вся книжная продукция, которую предлагает <?= $model->name ?>.</p>
				</div>
			</div>
			<div class="product-view-online">
				<h3>Другие интернет-магазины в городе <?=$this->city->gorod?></h3>
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
</div>