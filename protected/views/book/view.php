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
						<li class="__active" data-id="bookone">Отзыв о книге от BOOKONE</li>
						<li data-id="description">Аннотация</li>
						<li class="__review" data-id="review">Отзывы читателей</li>
						<li class="review-top-click-mark">Добавить отзыв</li>
					</ul>
				</div>
				<div class="product-review-list-wrapper __bookone __active">
					<div class="product-view-bookone">
					<?php
						if ($model->my_about) {
							echo '<div class="product-bookone-myabout">'.$model->my_about.'</div>';
						} else {
					?>
						<div class="product-bookone-myabout __save">
							<?
							$category_arr = array();
							foreach ($model->category_book as $row)
							{
								$category = $row->category;
								if (!in_array('<a href="/category/'.$category->url.'">'.mb_strtolower($category->name, "UTF-8").'</a>', $category_arr))
									$category_arr[] = '<a href="/category/'.$category->url.'">'.mb_strtolower($category->name, "UTF-8").'</a>';
								while ($category->to_parent)
								{
									$category = $category->to_parent;
									if (!in_array('<a href="/category/'.$category->url.'">'.mb_strtolower($category->name, "UTF-8").'</a>', $category_arr))
										$category_arr[] = '<a href="/category/'.$category->url.'">'.mb_strtolower($category->name, "UTF-8").'</a>';
								}
							}
							shuffle($category_arr);

							$sentence_1_arr = array();
							$sentence_2_arr = array();
							$sentence_3_arr = array();
							$category_desc_arr = array (
								'Книга включена в следующие категории: '.implode(', ', $category_arr).'.', 
								'Книга размещена в каталогах: '.implode(', ', $category_arr).'.', 
								'Содержание книги соответствует следующим жанрам: '.implode(', ', $category_arr).'.'
							);
							$author_arr_yes = array(
								'Книга была создана '.(count(explode(",", $model->author)) > 1 ? 'писателями' : 'писателем').' '.$model->author.'.',
								(count(explode(",", $model->author)) > 1 ? 'Создателями' : 'Создателем').' книги '.(count(explode(",", $model->author)) > 1 ? 'являются писатели' : 'является писатель').' '.$model->author.'.',
								(count(explode(",", $model->author)) > 1 ? 'Авторами' : 'Автором').' книги '.(count(explode(",", $model->author)) > 1 ? 'являются' : 'является').' '.$model->author.'.'
							);
							$author_arr_no = array(
								'Книга '.$model->name.' публикуется под единой редакцией без указания авторов.',
								'Авторы книги '.$model->name.' не указаны.'
							);
							$author_arr = $model->author ? $author_arr_yes : $author_arr_no;
							$bestseller_arr_yes = array(
								'Книга '.$model->name.' получила признание широких читательских масс и по праву считается бестселлером.',
								'На сегодняшний день книга '.$model->name.' является бестселлером с тиражом более '.number_format(rand(200000, 500000), 0, ',', ' ').' экземпляров.',
								'На данный момент книга '.$model->name.' считается бестселлером с объемом продаж более '.number_format(rand(50000, 130000), 0, ',', ' ').' штук.',
							);
							$bestseller_arr_no = array(
								'Книга '.$model->name.' не является бестселлером, в интернет магазинах присутствует в ограниченном количестве, не более '.rand(5, 30).' экземпляров.',
								'На текущий момент книга '.$model->name.' не пользуется широким спросом, и ее можно преобрести с хорошей скидкой до '.rand(5, 15).'%.',
								'Книга '.$model->name.' на данный момент продается малыми тиражами (до '.rand(5, 30).' штук) и не входит в список самых покупаемых книг.',
							);
							$bestseller_arr = $model->is_bestseller ? $bestseller_arr_yes : $bestseller_arr_no;
							$mark_reviews_arr_yes = array(
								'Книга удостоина положительными рецензиями современных критиков. Отзывы читатей о книге '.$model->name.' так же подтверждают, что это одно из лучших произведений категории '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").', которое займет почетное место в Вашей личной библиотеке.',
								'Большинство отзывов о книге '.$model->name.' положительны, и данная книга рекомендуется к прочтению всем любителям жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.',
								'Отзывы читатей книги и рецензии современных критиков сходятся на том, что книга '.$model->name.' является хорошим представителем жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").', и вызывает особый интерес у любителей книг '.mb_strtolower(strip_tags($category_arr[1]), "UTF-8").'.',
							);
							$mark_reviews_arr_no = array(
								'Отзывы о книге '.$model->name.' не однозначны, имеются как ее сторонники, так и противники. Поэтому сделать свой выбор можно лишь ознакомившись с данным произведением самостоятельно. Уверены, что оно не оставит равнодушыми всех любителей жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.',
								'Мнения читатей о книге '.$model->name.' не однозначны. Кто-то убежден, что суть ее расскрывается слишком долго, и книга не интересна любителям жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").', а часть отзывов наоборот хвалит автора за блестящее произведение. Но не смотря на это, мы рекомендуем ознакомиться с данным произведением.',
								'Отзывов о книге '.$model->name.' на данный момент не так много, чтобы сделать однозначный выбор "рекомендовать" или "не рекомендовать" ее читателям книг из жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'. Однако если Вы любите категорию '.mb_strtolower(strip_tags($category_arr[1]), "UTF-8").', то книга Вам будет интересна.',
							);
							$mark_reviews_arr = $model->mark_reviews >= 4 ? $mark_reviews_arr_yes : $mark_reviews_arr_no;
							$year_arr = array(
								'Печатный экземпляр издан в '.$model->year.' году.',
								'Предлагаемый к покупке экземпляр вышел в '.$model->year.' году.',
								'В продаже имеется экземпляр '.$model->year.' года.'
							);
							$year_arr_2015_yes = array(
								'Является новым изданием в категории '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.',
								'Абсолютно новое издание в категории '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.',
								'Является новинкой среди книг жанра '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.'
							);
							$year_arr_2015_no = array(
								'Ограниченное предложение данного экземпляра в категории '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").'.',
								'В каталоге '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").' осталось ограниченное количество книг указанного года издания.',
								'Данный экземпляр содержится в категории '.mb_strtolower(strip_tags($category_arr[0]), "UTF-8").' и продается с '.date("Y").' года.'
							);
							$year_arr_2015 = $model->year >= 2015 ? $year_arr_2015_yes : $year_arr_2015_no;
							$publisher_arr = array(
								'Книга '.$model->name.' выходит под издательством '.$model->publisher.($model->type_book == 'audiobook' ? ' в формате аудиокниги.' : '.'),
								'Публикация книги '.$model->name.' осуществляется издательством '.$model->publisher.'.',
								'Имеющийся в продаже экземпляр книги '.$model->name.' опубликован издательством '.$model->publisher.'.',
							);
							$page_extent_arr = array(
								'Состоит из '.$model->page_extent.' страниц'.($model->binding ? ' формата '.$model->binding.'.' : '.'),
								'Содержит '.$model->page_extent.' страниц'.($model->binding ? ' формата '.$model->binding.'.' : '.'),
								'Объем книги '.$model->page_extent.' страниц'.($model->binding ? ' формата '.$model->binding.'.' : '.'),
							);
							if ($model->ISBN)
							{
								$isbn_part_arr = explode(",", $model->ISBN);
								$ISBN_arr = array(
									'Книге '.$model->name.' присвоен международный стандартный книжный номер (ISBN) '.trim($isbn_part_arr[0]).'.',
									trim($isbn_part_arr[0]).' - ISBN книги '.$model->name.'.',
									'Международный стандартный книжный номер у книги '.$model->name.' - '.trim($isbn_part_arr[0]).'.',
								);
							}
							$language_arr = array(
								'Язык текста представленной книги - '.mb_strtolower($model->language, "UTF-8").'.',
								'Язык содержания данной книги - '.mb_strtolower($model->language, "UTF-8").'.',
								'Язык повествования книги - '.mb_strtolower($model->language, "UTF-8").'.',
							);
							$price_arr = array(
								'Оптимальная цена книги '.$model->name.' '.$model->price.' рублей от магазина OZON.RU по партнерской программе. Стоимость доставки в указанную сумму не входит. Срок доставки от '.rand(1, 3).' до '.rand(4, 7).' недель после передачи заказа в службу рассылки.',
								'Приобрести книгу '.$model->name.' возможно в магазине OZON по выгодной цене '.$model->price.' рублей за экземпляр без учета доставки. Стоимость доставки книги зависит от места назначения и составляет от '.rand(1, 3).' до '.rand(4, 7).' недель со дня отправки.',
								'Минимальную стоимость книги '.$model->name.' предлагает магазин OZON, цена покупки будет составлять '.$model->price.' рублей. Доставка осуществляется в течение '.rand(1, 3).' - '.rand(4, 7).' недель в зависимости от места назначения.',
							);
							$litres_load_arr_yes = array(
								'Скачать книгу '.$model->name.' и прочесть ее отрывки онлайн возможно на сайте Litres.ru.',
								'Если вы хотите получить электронный вариант книги '.$model->name.', то скачать его можно на Litres.ru. На данном сайте так же возможно подробнее ознакомиться с содержанием книги, прочитав отрывки, цитаты и рецензии.',
								'Чтобы скачать электронный вариант книги '.$model->name.', необходимо пройти на сайт Litres.ru и ознакомиться с условиями приобретения. На данном сайте так же имеется бесплатный доступ к наиболее ярким и запоминающимся отрывкам произведения.',
							);
							$litres_load = $litres_load_arr_yes;
						?>
							<p>
							<?
								$sentence_1_arr[] = $category_desc_arr[rand(0, count($category_desc_arr)-1)];
								$sentence_1_arr[] = $author_arr[rand(0, count($author_arr)-1)];
								$sentence_1_arr[] = $bestseller_arr[rand(0, count($bestseller_arr)-1)];
								$sentence_1_arr[] = $mark_reviews_arr[rand(0, count($mark_reviews_arr)-1)];
								shuffle($sentence_1_arr);
								echo implode(' ', $sentence_1_arr);
							?>
							</p>
							<p>
							<?
								if ($model->publisher)
									$sentence_2_arr[] = $publisher_arr[rand(0, count($publisher_arr)-1)];
								$sentence_2_arr[] = $year_arr[rand(0, count($year_arr)-1)];
								$sentence_2_arr[] = $year_arr_2015[rand(0, count($year_arr_2015)-1)];
								if ($model->page_extent)
									$sentence_2_arr[] = $page_extent_arr[rand(0, count($page_extent_arr)-1)];
								if ($model->ISBN)
									$sentence_2_arr[] = $ISBN_arr[rand(0, count($ISBN_arr)-1)];
								if ($model->language)
									$sentence_2_arr[] = $language_arr[rand(0, count($language_arr)-1)];
								if ($model->price)
									$sentence_2_arr[] = $price_arr[rand(0, count($price_arr)-1)];
								shuffle($sentence_2_arr);
								echo implode(' ', $sentence_2_arr);
							?>
							</p>
							<p>
							<?
								echo $litres_load[rand(0, count($litres_load)-1)];
							?>
							</p>
						</div>
					<?php } ?>
						<div class="product-view-bookone-update">
						<?
							$date=explode(".",date('d.m.Y', time() - 86400*rand(1,5)));
							switch ($date[1]){
								case 1: $m='января'; break;
								case 2: $m='февраля'; break;
								case 3: $m='марта'; break;
								case 4: $m='апреля'; break;
								case 5: $m='мая'; break;
								case 6: $m='июня'; break;
								case 7: $m='июля'; break;
								case 8: $m='августа'; break;
								case 9: $m='сентября'; break;
								case 10: $m='октября'; break;
								case 11: $m='ноября'; break;
								case 12: $m='декабря'; break;
							}
						?>
							Информация обновлена <?=($date[0]*1)?> <?=$m?> <?=$date[2]?> года
						</div>
					</div>
				</div>
				<div class="product-review-list-wrapper __description">
					<div class="product-view-bookone">
						<div class="product-view-desc-content __load">
							<p></p>
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