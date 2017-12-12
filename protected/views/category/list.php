<input type="hidden" name="current_model" id="current_model" value="<?=$current_model->id?>" />
<input type="hidden" name="total_count" id="total_count" value="<?=$total_count?>" />
<input type="hidden" name="begin" id="begin" value="<?=$begin?>" />
<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
		<?
			$breadcrumbs = array('<li>'.$current_model->name.'</li>');
			$model = $current_model;
			while ($model->to_parent)
			{
				$model = $model->to_parent;
				array_unshift($breadcrumbs, '<li><a href="/category/'.$model->url.'">'.$model->name.'</a></li>');
			}
			array_unshift($breadcrumbs, '<li><a href="/">Главная</a></li>');
			echo '<ul>'.implode('', $breadcrumbs).'</ul>';
		?>
		</div>
		<h1><?=$current_model->name?></h1>
		<div class="middle-menu">
			<div class="middle-menu-block">
				<h2>Категории</h2>
				<ul class="__menu-top">
				<?
					foreach ($categories as $category)
					{
						$class = '';
						if ($category->id == $current_model->id)
							$class = '__active';
				?>
					<li class="middle-menu-item <?=$class?>">
						<span class="middle-menu-item_title"><?=$category->name?></span>
						<ul class="middle-menu-sub">
						<?
							if ($class)
								echo '<li>Полный список</li>';
							else
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
		<?php
			if ($total_count && $page == 1) {
		?>
			<div class="products-catalog-top-desc">
				<p>
					Каталог "<?=$current_model->name?>" содержит <?=$total_count?> книг. 
					Книги отсортированы согласно их популярности и отзывам читателей. 
					Среди книг "<?=$current_model->name?>" имеются как печатные издания, так и аудиокниги. 
					По каждой книге представлена информация о ее рыночной стоимости в <?= date('Y') ?> году.
					Воспользуйтесь поиском или навигацией по разделам каталога "<?=$current_model->name?>", чтобы найти нужное Вам произведение или автора.
				</p>
			</div>
		<?php } ?>
			<div class="products-list <?=($category_text ? '' : '__need_save')?>">
			<?
				if (!$total_count)
					echo '<div class="products-list-empty">
						<p>Данная категория книг не заполнена. Воспользуйтесь поиском вверху страницы.</p>
						<p>Введите наименование интересующей Вас книги или ее автора, категорию не указывайте.<br />Таким образом, поиск будет осуществляться по всей базе книг.</p>
					</div>';
				elseif ($category_text)
					echo $category_text->text;
				else
				{
			?>
				<? foreach ($books as $row) { ?>
					<a href="/book/<?=$row->id?>/<?=$row->url?>">
						<div class="products-item <?=($row->picture_my ? '' : '__load')?>" id="start_<?=$row->id?>">
							<div class="products-item-img">
							<? if ($row->picture_my) { ?>
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$row->picture_my?>" alt="<?=$row->name?>">
							<? }else{ ?>
								<img data-url="<?=str_replace('http://static.ozone.ru/multimedia/books_covers','',$row->picture)?>" src="#" alt="<?=$row->name?>">
							<? } ?>
							</div>
							<div class="products-item-title">
								<?=$row->name?>
							</div>
							<div class="products-item-author">
								<?=$row->author?>
							</div>
							<div class="products-item-rating">
								<ul>
								<?
									for ($i = 0 ; $i < 5 ; $i++)
										echo ($row->mark_reviews && $i < $row->mark_reviews) ? '<li class="__active"></li>' : '<li></li>';
								?>
								</ul>
								<div class="products-item-rating-review">
									<span><?=($row->count_reviews ? $row->count_reviews : '0 отзывов')?></span>
								</div>
							</div>
							<div class="products-item-price">
							<? if ($row->baseprice > $row->price) { ?>
								<div class="products-item-price-old"><?=number_format($row->baseprice, 0, ',', ' ')?> руб.</div>
							<? }else{ ?>
								<div class="products-item-price-no-diff"></div>
							<? } ?>
								<div class="products-item-price-new"><?=number_format($row->price, 0, ',', ' ')?> <span>руб.</span></div>
								<div class="products-item-price-buy"><span>Оформить заявку</span></div>
							</div>
							<div class="products-item-compare">
								<span>Сравнение цен всех магазинов</span>
							</div>
							<div class="products-item-label <?=(($row->diff > 0 && $row->is_bestseller) ? '__best' : ($row->is_bestseller ? '__bestseller' : ($row->diff > 0 ? '__discount' : '')))?>"></div>
						</div>
					</a>
				<? } ?>
			<? } ?>
			</div>
			<?if (!Yii::app()->user->isGuest):?>
			<div class="products-pages"> <!--Old pagination-->
				<div class="products-pages-see">Показано <?=($total_count < 36 ? $total_count : 36)?> из <?=$total_count?></div>
				<div class="products-pages-more <?=($total_count < 36 ? '__hidden' : '')?>"><span>Показать еще!</span></div>
			</div>
			<?endif?>
			<div class="products-pagination">
				<div class="products-pages-left">
					<ul>
					<?php
						if (ceil($total_count/36) > 1)
						{
							$count_page = ceil($total_count/36);
							$back = $page - 5;
							$next = $page < 5 ? 10 : $page + 5;
							if ($count_page - $page < 5)
								$back = $count_page - 10;

							if ($back <= 1 && $next >= $count_page)
							{
								for ($i = 1; $i <= $count_page; $i++)
								{
									$class = '';
									if ($i == $page) $class = '__active';
									$url_page = $i == 1 ? "/category/{$current_model->url}" : "/category/{$current_model->url}/page/{$i}";
									echo "<li class='{$class}'><a href='{$url_page}'>{$i}</a></li>";
								}
							}
							elseif ($back <= 1 && $next < $count_page)
							{
								for ($i = 1; $i <= $next - 1; $i++)
								{
									$class = '';
									if ($i == $page) $class = '__active';
									$url_page = $i == 1 ? "/category/{$current_model->url}" : "/category/{$current_model->url}/page/{$i}";
									echo "<li class='{$class}'><a href='{$url_page}'>{$i}</a></li>";
								}
								$url_dots = "/category/{$current_model->url}/page/{$next}";
								echo "<li class='__dots'><a href='{$url_dots}'>...</a></li>";
								$url_right = "/category/{$current_model->url}/page/{$count_page}";
								echo "<li><a href='{$url_right}'>{$count_page}</a></li>";
							}
							elseif ($back > 1 && $next >= $count_page)
							{
								$url_left = "/category/{$current_model->url}";
								echo "<li><a href='{$url_left}'>1</a></li>";
								$url_dots = "/category/{$current_model->url}/page/{$back}";
								echo "<li class='__dots'><a href='{$url_dots}'>...</a></li>";
								for ($i = $back + 1; $i <= $count_page; $i++)
								{
									$class = '';
									if ($i == $page) $class = '__active';
									$url_page = $i == 1 ? "/category/{$current_model->url}" : "/category/{$current_model->url}/page/{$i}";
									echo "<li class='{$class}'><a href='{$url_page}'>{$i}</a></li>";
								}
							}
							else
							{
								$url_left = "/category/{$current_model->url}";
								echo "<li><a href='{$url_left}'>1</a></li>";
								$url_dots = "/category/{$current_model->url}/page/{$back}";
								echo "<li class='__dots'><a href='{$url_dots}'>...</a></li>";
								for ($i = $back + 1; $i <= $next - 1; $i++)
								{
									$class = '';
									if ($i == $page) $class = '__active';
									$url_page = $i == 1 ? "/category/{$current_model->url}" : "/category/{$current_model->url}/page/{$i}";
									echo "<li class='{$class}'><a href='{$url_page}'>{$i}</a></li>";
								}
								$url_dots = "/category/{$current_model->url}/page/{$next}";
								echo "<li class='__dots'><a href='{$url_dots}'>...</a></li>";
								$url_right = "/category/{$current_model->url}/page/{$count_page}";
								echo "<li><a href='{$url_right}'>{$count_page}</a></li>";
							}
					?>
					<?php
						}
					?>
					</ul>
					<?php if ($page != $count_page && $total_count > $begin + 36) { ?>
					<a class="__next" href="/category/<?=$current_model->url?>/page/<?=($page +1)?>">Вперед ›</a>
					<?php } ?>
				</div>
				<div class="products-pages-right">Показано с <?=($begin + 1)?> по <?=($total_count < $begin + 36 ? $total_count : $begin + 36)?> из <?=$total_count?></div>
			</div>
		</div>
	</div>
</div>