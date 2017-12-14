<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
			<ul>
				<li><a href="/">Главная</a></li>
				<li><?= $this->city->gorod ?></li>
			</ul>
		</div>
		<h1>Купить книгу в городе <?= $this->city->gorod ?></h1>
		<div class="middle-menu">
			<div class="middle-menu-block">
				<h2>Категории</h2>
				<ul class="__menu-top">
				<?
					foreach ($categories as $category)
					{
				?>
					<li class="middle-menu-item">
						<span class="middle-menu-item_title"><?=$category->name?></span>
						<ul class="middle-menu-sub">
						<?
							echo '<li><a href="/category/'.$category->url.'">Полный список</a></li>';
							foreach ($category->to_kids as $row)
								echo '<li><a href="/category/'.$row->url.'">'.$row->name.'</a></li>';
						?>
						</ul>
					</li>
				<? } ?>
				</ul>
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
		<div class="products-catalog">
			<div class="products-catalog-top-desc">
				<p>
					В городе <?= $this->city->gorod ?> найдено <?= count($shops) ?> книжных магазинов и <?= count($libs) ?> библиотек. Каждому магазину присвоен рейтинг согласно отзывам покупателей, ассортименту книг и наличию доступной информации. Так же представлен рейтинг <?= count($shopOnline) ?>-и крупнейших книжных интернет-магазинов с доставкой в город <?= $this->city->gorod ?>.
				</p>
			</div>
			<div class="shop-list">
				<h3>Книжные магазины</h3>
				<div class="product-online-list">
				<?php foreach ($shops as $key => $row) { ?>
					<a href="/<?= $this->city->simbol_name ?>/shop/<?= $row->url ?>">
						<div class="product-online-item">
							<div class="product-online-item_img">
								<img src="/img/derault_company_<?= $row->id % 5 ?>.jpg" alt="<?= $row->name ?> в городе <?= $this->city->gorod ?>">
							</div>
							<div class="product-online-item_content">
								<p class="__title"><?= $row->name ?></p>
								<p class="__rating"><span>рейтинг</span><?= $row->rating ?> из <?= count($shops) ?></p>
								<p class="__address"><?= $row->address ? $row->address : $this->city->gorod ?></p>
							</div>
						</div>
					</a>
				<?php
						if ($key >= 5) break;
					}
				?>
				</div>
			</div>
			<div class="shop-list">
				<h3>Библиотеки</h3>
				<div class="product-online-list">
				<?php foreach ($libs as $key => $row) { ?>
					<a href="/<?= $this->city->simbol_name ?>/library/<?= $row->url ?>">
						<div class="product-online-item">
							<div class="product-online-item_img">
								<img src="/img/derault_company_<?= $row->id % 5 ?>.jpg" alt="<?= $row->name ?> в городе <?= $this->city->gorod ?>">
							</div>
							<div class="product-online-item_content">
								<p class="__title"><?= $row->name ?></p>
								<p class="__rating"><span>рейтинг</span><?= $row->rating ?> из <?= count($libs) ?></p>
								<p class="__address"><?= $row->address ? $row->address : $this->city->gorod ?></p>
							</div>
						</div>
					</a>
				<?php
						if ($key >= 5) break;
					}
				?>
				</div>
			</div>
			<div class="shop-list">
				<h3>Online магазины книг с доставкой в город <?=$this->city->gorod?></h3>
				<div class="product-online-list">
				<?php foreach ($shopOnline as $key => $online) { ?>
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
				<?php
						if ($key >= 5) break;
					}
				?>
				</div>
			</div>
		</div>
	</div>
</div>