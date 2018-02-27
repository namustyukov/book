<?php
$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Update Book', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Book', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>
<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
		<?
			$category = $model->category_book[0]->category;
			$breadcrumbs = array('<li><a href="/category/'.$category->url.'">'.$category->name.'</a></li>', '<li>'.$model->name.'</li>');
			while ($category->to_parent)
			{
				$category = $category->to_parent;
				array_unshift($breadcrumbs, '<li><a href="/category/'.$category->url.'">'.$category->name.'</a></li>');
			}
			array_unshift($breadcrumbs, '<li><a href="/">Главная</a></li>');
			echo '<ul>'.implode('', $breadcrumbs).'</ul>';
		?>
		</div>
		<h1><?=$model->name?></h1>
		<div class="product-view">
			<div class="product-view-top">
				<div class="product-view-img">
					<div class="product-view-img-wrapper <?=($model->picture_my ? '' : '__load')?>">
					<? if ($model->picture_my) { ?>
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$model->picture_my?>" alt="<?=$teg_name?>">
					<? }else{ ?>
						<img data-url="<?=str_replace('http://static.ozone.ru/multimedia/books_covers','',$model->picture)?>" src="#" alt="<?=$teg_name?>">
					<? } ?>
					</div>
					<div class="products-item-label <?=((($model->baseprice - $model->price) > 0 && $model->is_bestseller) ? '__best' : (($model->baseprice - $model->price) > 0 ? '__discount' : ($model->is_bestseller ? '__bestseller' : '')))?>"></div>
				</div>
				<div class="product-view-about">
					<div class="product-view-info <?=($model->date_sync && $model->date_sync > (time() - 60*60*24*30) ? '' : '__load')?>">
						<div class="product-view-info-content">
							<div class="product-view-info-price">
							<? if ($model->baseprice > $model->price) { ?>
								<div class="product-view-info-price-val __old"><?=number_format($model->baseprice, 0, ',', ' ')?> руб.</div>
							<? } ?>
								<div class="product-view-info-price-val <?=($model->baseprice > $model->price ? '' : '__single')?>">
									<span><?=number_format($model->price, 0, ',', ' ')?></span><small>руб.</small>
									<div class="product-view-info-price-load">Обновление цены...</div>
								</div>
								<div class="product-view-info-compare">
									Оптимальная стоимость
								</div>
							</div>
							<div class="product-view-info-right">
							<? if ($model->is_new || $model->is_bestseller) { ?>
								<div class="product-view-info-status">
								<?
									if ($model->year >= 2015)
										echo '<span>Новинка</span>';
									if ($model->is_bestseller)
										echo '<span>Бестселлер</span>';
								?>
								</div>
							<? } ?>
								<div class="product-view-info-rating">
									<ul>
									<?
										for ($i = 0 ; $i < 5 ; $i++)
											echo ($model->mark_reviews && $i < $model->mark_reviews) ? '<li class="__active"></li>' : '<li></li>';
									?>
									</ul>
									<div class="product-view-info-reviews"><a href="#review"><?=($model->count_reviews ? $model->count_reviews : '0 отзывов')?></a></div>
								</div>
							</div>
						</div>
					</div>
					<div class="product-view-buy">
						<span class="link-to-market" data-type="ozon">Оформить покупку в OZON.RU</span>
					</div>
					<div class="product-view-compare">
						<div class="product-view-compare-title">
							<h4>Где купить в городе <?=$this->city->gorod?></h4>
						</div>
						<ul>
							<li class="__shop">
								<a target="_blank" href="/<?= $this->city->simbol_name ?>/shop/list">Розничные магазины</a>
							</li>
							<li class="__library">
								<a target="_blank" href="/<?= $this->city->simbol_name ?>/library/list">Библиотеки</a>
							</li>
							<li class="__online">
								<a target="_blank" href="/<?= $this->city->simbol_name ?>/online/list">Интернет-магазины</a>
							</li>
						</ul>
					</div>
					<div class="product-view-param">
						<h4>Основные характеристики</h4>
						<ul>
						<? if ($model->author) { ?>
							<li>
								<span class="__title">Авторы</span>
								<span class="__val" title="<?=$model->author?>"><?=$model->author?></span>
							</li>
						<? } ?>
						<? if ($model->language) { ?>
							<li>
								<span class="__title">Язык</span>
								<span class="__val" title="<?=$model->language?>"><?=$model->language?></span>
							</li>
						<? } ?>
						<? if ($model->publisher) { ?>
							<li>
								<span class="__title">Издательство</span>
								<span class="__val" title="<?=$model->publisher?>"><?=$model->publisher?></span>
							</li>
						<? } ?>
						<? if ($model->type_book == 'audiobook') { ?>
							<li>
								<span class="__title">Тип книги</span>
								<span class="__val">Аудиокнига</span>
							</li>
						<? } ?>
						<? if ($model->page_extent) { ?>
							<li>
								<span class="__title">Количество страниц</span>
								<span class="__val" title="<?=$model->page_extent?>"><?=$model->page_extent?></span>
							</li>
						<? } ?>
						<? if ($model->binding) { ?>
							<li>
								<span class="__title">Формат</span>
								<span class="__val" title="<?=$model->binding?>"><?=$model->binding?></span>
							</li>
						<? } ?>
						<? if ($model->year) { ?>
							<li>
								<span class="__title">Год</span>
								<span class="__val"><?=$model->year?></span>
							</li>
						<? } ?>
						<? if ($model->ISBN) { ?>
							<li>
								<span class="__title">ISBN</span>
								<span class="__val" title="<?=$model->ISBN?>">
								<?
									$isbn_arr = explode(",", $model->ISBN);
									echo trim($isbn_arr[0]);
								?>
								</span>
							</li>
						<? } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="ads-horizont">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- bookone горизонтальный -->
				<ins class="adsbygoogle"
				     style="display:inline-block;width:728px;height:90px"
				     data-ad-client="ca-pub-9040033498726551"
				     data-ad-slot="2202570029"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<div class="product-view-review">
				<a name="review"></a>
				<div class="review-tab">
					<ul>
						<li class="__active" data-id="description">Аннотация</li>
						<li class="__review" data-id="review">Отзывы читателей</li>
						<li class="review-top-click-mark">Добавить отзыв</li>
					</ul>
				</div>
				<div class="product-review-list-wrapper __description __active">
					<div class="product-view-bookone">
						<div class="product-view-desc-content">
							<p><?= $model->description ?></p>
						</div>
					</div>
				</div>
				<div class="product-review-list-wrapper __review">
				<?
					$class = (!count($model->review) && $model->count_reviews)
						? '__load'
						: (count($model->review) ? '__load_on_active' : '');
				?>
					<div class="product-review-list <?=$class?>">
					<?
						if (!count($model->review) && !$model->count_reviews)
							echo '<div class="product-review-list-none">Пока нет ни одного отзыва</div>';
					?>
					</div>
					<input type="hidden" name="review_count" id="review_count" value="<?=count($model->review)?>" />
					<div class="review-pages <?=(count($model->review) ? '' : '__hidden')?>">
						<div class="review-pages-see">Показано <?=(count($model->review) < 10 ? count($model->review) : 10)?> из <?=count($model->review)?></div>
						<div class="review-pages-more <?=(count($model->review) < 10 ? '__hidden' : '')?>"><span>Показать еще!</span></div>
					</div>
					<div class="review-click-mark">
						<span>Добавить отзыв</span>
					</div>
				</div>
			</div>
			<div class="product-view-online">
				<h3>Online магазины книг с доставкой в город <?=$this->city->gorod?></h3>
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
			<div class="product-view-recommend">
				<h3>Рекомендуем также</h3>
				<div class="product-recommend-wrapper">
					<div class="product-recommend-window">
						<div class="product-recommend-list">
							<?
								$i = 0;
								foreach ($books as $row)
								{
									if ($row->id != $model->id)
									{
							?>
								<a href="/book/<?=$row->id?>/<?=$row->url?>" title="<?=str_replace('"', '', $row->name)?>">
									<div class="product-recommend-item <?=($row->picture_my ? '' : '__load')?>" id="start_<?=$row->id?>">
										<div class="recommend-item-img">
										<? if ($row->picture_my) { ?>
											<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$row->picture_my?>" alt="<?=str_replace('"', '', $row->name)?>">
										<? }else{ ?>
											<img data-url="<?=str_replace('http://static.ozone.ru/multimedia/books_covers','',$row->picture)?>" src="#" alt="<?=str_replace('"', '', $row->name)?>">
										<? } ?>
										</div>
										<div class="recommend-item-title">
											<?=$row->name?>
										</div>
										<div class="recommend-item-author" title="<?=$row->author?>">
											<?=$row->author?>
										</div>
										<div class="recommend-item-price">
										<? if ($row->baseprice > $row->price) { ?>
											<div class="recommend-item-price-old"><?=number_format($row->baseprice, 0, ',', ' ')?> руб.</div>
										<? } ?>
											<div class="recommend-item-price-val"><span><?=number_format($row->price, 0, ',', ' ')?></span> руб.</div>
										</div>
										<div class="products-item-label <?=(($row->diff > 0 && $row->is_bestseller) ? '__best' : ($row->is_bestseller ? '__bestseller' : ($row->diff > 0 ? '__discount' : '')))?>"></div>
									</div>
								</a>
							<?
										$i++;
										if ($i >= 10) break;
									}
								}
							?>
						</div>
					</div>
					<div class="product-recommend-control __back __block"></div>
					<div class="product-recommend-control __next"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="book_id" value="<?=$model->id?>" />

<div class="popup_out_review __hidden">
	<div class="review_form">
		<div class="review_form_close"></div>
		<div class="review_field">
			<div class="review_field_title">
				Оценка
			</div>
			<div class="review_field_input">
				<div class="review_field_rating">
					<ul>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ul>
				</div>
				<input type="hidden" name="review_mark" id="review_mark" value="0" />
				<div class="review_field_input_error">Выберите звездочку</div>
			</div>
		</div>
		<div class="review_field">
			<div class="review_field_title">
				Ваше имя
			</div>
			<div class="review_field_input">
				<input type="text" name="review_name" placeholder="ФИО (возраст)" id="review_name" />
				<div class="review_field_input_error">Ошибка</div>
			</div>
		</div>
		<div class="review_field __none_border">
			<div class="review_field_title">
				Отзыв
			</div>
			<div class="review_field_input">
				<textarea name="review_message" placeholder="Текст отзыва" id="review_message"></textarea>
				<div class="review_field_input_error">Ошибка</div>
			</div>
		</div>
		<div class="review_submit">
			<span>Добавить</span>
		</div>
	</div>
	<div class="review_create_success __hidden">
		<p>Отзыв успешно добавлен</p>
		<div class="review_create_success_button">
			Закрыть
		</div>
	</div>
</div>

<div class="popup_out_link __hidden">
	<div class="out_link_content">
		<div class="out_link_close"></div>
		<div class="out_link_inner"></div>
	</div>
</div>