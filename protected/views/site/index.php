<div class="start-bestseller">
	<a href="/category/molodezhnaya-literatura">
		<div class="start-bestseller-content">
			<div class="start-bestseller-content-title">Бестселлеры месяца</div>
			<div class="start-bestseller-content-rect __first"></div>
			<div class="start-bestseller-content-rect __second"></div>
			<div class="start-bestseller-content-rect __third"></div>
		</div>
	</a>
</div>
<div class="main">
	<div class="start-category">
		<h1>BOOKONE.RU - быстрый поиск и покупка книги</h1>
		<div class="start-category-list">
			<a href="/category/izuchenie-yazykov-mira" class="__new">Новинки</a>
			<a href="/category/finansy-bankovskoe-delo-investicii" class="__bestseller">Бестселлеры</a>
			<a href="/category/geroi-multfilmov-i-filmov" class="__promo">Акции</a>
			<a href="/category/detyam-i-roditelyam" class="__child">Детям и родителям</a>
			<a href="/category/uchebnaya-literatura" class="__pupil">Учебная литература</a>
			<a href="/category/biznes-knigi" class="__business">Бизнес-литература</a>
			<a href="/category/hudozhestvennaya-literatura" class="__hudozh">Художественная литература</a>
			<a href="/category/nehudozhestvennaya-literatura" class="__not-hudozh">Нехудожественная литература</a>
			<a href="/category/literatura-na-inostrannyh-yazykah" class="__english">Литература на иностранных языках</a>
		</div>
	</div>
	<div class="ads-horizont __start">
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
	<div class="start-products">
	<?
		$months = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
		$m = date('m');
	?>
		<h2><?=$months[$m - 1]?> - месяц художественной литературы! <span>Скидки до 30%</span></h2>
		<div class="start-products-list">
		<?
			if ($category_text)
				echo $category_text->text;
			else
			{
		?>
			<? foreach ($books as $row) { ?>
				<a href="/book/<?=$row->id?>/<?=$row->url?>">
					<div class="products-item <?=($row->picture_my ? '' : '__load')?>" id="start_<?=$row->id?>">
						<div class="products-item-img">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/<?=$row->picture_my?>" alt="<?=$row->name?>">
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
		<div class="start-products-more"><span>Показать еще!</span></div>
	</div>
	<div class="start-description">
		<h3>Вас приветствует книжный интернет-портал БУКОН.РУ.</h3>
		<p>Нет способа удобнее, чем купить книгу через интернет. И для многих данный способ покупки книги стал предпочтительнее визита в книжный магазин, поскольку вы не ограничены рамками поиска нужного вам издания. В вашем распоряжении имеется все многообразие книжной продукции различной тематики. На сегодняшний день в интернет-пространстве представлено множество книжных магазинов. Однако как не запутаться в этом многообразии и найти то, что действительно нужно? Можно посмотреть новинки, обратиться за советом к друзьям или продавцам. К сожалению, даже в этом случае не всегда удается отыскать подходящую книгу.</p>
		<p>Выбор книжного интернет-магазина базируется на нескольких факторах:</p>
			<ul>
				<li>
					&ndash; наличие интересующего Вас произведения;
				</li>
				<li>
					&ndash; приемлемая цена;
				</li>
				<li>
					&ndash; надежность оплаты и доставки книг.
				</li>
			</ul>
		<p>БУКОН.РУ позволяет учесть данные факты и предоставляет Вам удобный инструмент поиска книги, оценки стоимости ее в нескольких интернет-магазина, оформление покупки книги. База книг БУКОНа насчитывает более 550 тыс. изданий, среди которых печатные издания, аудиокниги, электронные книги. У Вас не останется больше вопросов где купить книгу.</p>
		<p>Желаем приятного прочтения, уважаемый читатель. Мы очень рады, что Вы посетили наш сайт и самое главное с пользой провели время.</p>
	</div>
</div>