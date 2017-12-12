<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$this->pageTitle?></title>
	<meta name="description" content="<?=$this->meta_d?>">
	<meta name="keywords" content="<?=$this->meta_k?>">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font_2.css" rel="stylesheet" type="text/css">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
	<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<?if (Yii::app()->user->isGuest):?>
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
	<?endif?>
</head>
<body>
<?if (!Yii::app()->user->isGuest):?>
	<div class="menu_admin">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Book', 'url'=>array('book/admin')),
				array('label'=>'Category', 'url'=>array('category/admin')),
				array('label'=>'Review', 'url'=>array('review/admin')),
				array('label'=>'CategoryBook', 'url'=>array('categoryBook/admin')),
				array('label'=>'Shop online', 'url'=>array('shopOnline/admin')),
				array('label'=>'Company', 'url'=>array('company/admin')),
				array('label'=>'Library', 'url'=>array('library/admin')),
				array('label'=>'City', 'url'=>array('city/admin')),
				/*array('label'=>'Parse category', 'url'=>array('parse/category')),
				array('label'=>'Parse book', 'url'=>array('parse/book')),*/
				array('label'=>'Login', 'url'=>array('site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div>
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
<?endif?>
	<div class="header">
		<div class="top-menu">
			<div class="top-menu-in">
				<ul>
					<li><a href="/">Главная</a></li>
					<li><a href="/category/kinoromany">Бестселлеры</a></li>
					<li><a href="/category/iskusstvo-kultura">Новинки</a></li>
					<li><a href="/category/predprinimatelstvo-otraslevoy-biznes">Акции</a></li>
				</ul>
			</div>
		</div>
		<div class="header-body">
			<div class="header-body-in">
				<a href="/" class="header-logo">
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/logo_big.png" width="190" height="151" alt="BOOKONE.RU - книжный портал">
				</a>
				<div class="header-about">
					<p>Более 550 000 книг из 2 300 категорий</p>
					<p>Свыше 150 000 ссылок на электронные книги</p>
					<p>Крупнейший партнер интернет-магазинов:</p>
					<p>OZON, ЛитРес, Лабиринт, Read</p>
				</div>
				<div class="header-city">
					<p>Выбранный город</p>
					<div class="header-city-current">
						<span><?= $this->city->gorod ?></span>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom-wrapper">
			<div class="header-bottom">
				<div class="header-bottom-form">
					<div class="header-bottom-form_left __category">
						<select id="category">
							<option value="-100" selected="selected">Все категории</option>
							<option value="1137234">Бизнес-книги</option>
							<option value="1137436">Детям и родителям</option>
							<option value="1139697">Учебная литература</option>
							<option value="1140879">Художественная литература</option>
							<option value="1137924">Нехудожественная литература</option>
							<option value="1132527">Литература на иностранных языках</option>
						</select>
					</div>
					<div class="header-bottom-form_left __category_sub __hidden">
						<select id="category_sub">
							<option value="-100" selected="selected">Все подкатегории</option>
						</select>
					</div>
					<div class="header-bottom-form_left __text">
						<input type="text" id="search_text" placeholder="Название книги, автор" />
						<div class="text-search-help-close __hidden"></div>
					</div>
				</div>
				<div class="text-search-help-wrapper __hidden">
					<div class="text-search-help-overflow">
						<div class="text-search-help-inner">
							<div class="text-search-help">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php echo $content; ?>
	
	<div class="ads-footer">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- bookone большой прямоугольник -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:336px;height:280px"
		     data-ad-client="ca-pub-9040033498726551"
		     data-ad-slot="5156036423"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<a class="to-top"><span>Наверх</span></a>
	<div class="footer">
		<div class="footer-in">
			<div class="footer-middle">
				<div class="footer-middle-left">
					<h4>Свяжитесь с нами</h4>
					<div class="contacts-feedback"><span>Обратная связь</span></div>
					<div class="contacts-email">bookoneru@mail.ru</div>
				</div>
				<div class="footer-middle-left">
					<h4>Категории</h4>
					<ul>
						<li><a href="/category/detyam-i-roditelyam">Детям и родителям</a></li>
						<li><a href="/category/uchebnaya-literatura">Учебная литература</a></li>
						<li><a href="/category/biznes-knigi">Бизнес-литература</a></li>
						<li><a href="/category/hudozhestvennaya-literatura">Художественная литература</a></li>
						<li><a href="/category/nehudozhestvennaya-literatura">Нехудожественная литература</a></li>
					</ul>
				</div>
				<div class="footer-middle-left">
					<h4>Смотрите также</h4>
					<ul>
						<li><a href="/category/poznavatelnaya-i-spravochnaya-literatura">Познавательная и справочная литература для детей</a></li>
						<li><a href="/category/shkolnikam-i-abiturientam">Школьникам и абитуриентам</a></li>
						<li><a href="/category/mba-biznes-kurs">Бизнес-курсы</a></li>
						<li><a href="/category/lyubovnye-romany">Любовные романы</a></li>
						<li><a href="/category/religii-mira">Религии мира</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="footer-copyright">BOOKONE.RU - быстрый поиск и покупка книги по выгодной цене в крупнейших книжных интернет магазинах</div>
			</div>
		</div>
	</div>

	<div class="popup_out_message __hidden">
		<div class="message_form">
			<div class="message_form_close"></div>
			<div class="message_field">
				<div class="message_field_title">
					Ваше имя
				</div>
				<div class="message_field_input">
					<input type="text" name="message_name" id="message_name" />
					<div class="message_field_input_error">Ошибка</div>
				</div>
			</div>
			<div class="message_field">
				<div class="message_field_title">
					E-mail
				</div>
				<div class="message_field_input">
					<input type="text" name="message_email" id="message_email" />
					<div class="message_field_input_error">Ошибка</div>
				</div>
			</div>
			<div class="message_field __none_border">
				<div class="message_field_title">
					Сообщение
				</div>
				<div class="message_field_input">
					<textarea name="message_message" id="message_message"></textarea>
					<div class="message_field_input_error">Ошибка</div>
				</div>
			</div>
			<div class="message_submit">
				<span>Отправить</span>
			</div>
		</div>
		<div class="message_create_success __hidden">
			<p>Сообщение успешно отправлено</p>
			<div class="message_create_success_button">
				Закрыть
			</div>
		</div>
	</div>

	<div class="popup_out_city __hidden">
		<div class="city_popup">
			<div class="city_popup_close"></div>
			<div class="city_popup_content"></div>
		</div>
	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter34187905 = new Ya.Metrika({
						id:34187905,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});
	
			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";
	
			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/34187905" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</body>
</html>