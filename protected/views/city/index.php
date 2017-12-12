<?php
/* @var $this CityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cities',
);

$this->menu=array(
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Manage City', 'url'=>array('admin')),
);
?>

<div class="main">
	<div class="main-in">
		<div class="breadcrumbs">
			<ul>
				<li><a href="/">Главная</a></li>
				<!-- <li><a href="/<?= $this->city->simbol_name ?>/online/list">Онлайн магазины в городе <?= $this->city->gorod ?></a></li> -->
				<li>Список городов</li>
			</ul>
		</div>
		<h1>Список городов книжного портала bookone.ru</h1>
		<div class="middle-menu">
			<div class="ads-sidebar mt-0">
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
		<div class="city-list">
			<div class="city-list-content">
			<?php
				$html = '
					<div class="city-list-row">
						<div class="city-list-letter">A</div>
						<div class="city-list-items">
				';
				$currentLetter = 'А';

				foreach ($list as $key => $item) {
					$checkLetter = mb_strtoupper(mb_substr($item->gorod, 0, 1, 'UTF-8'), 'UTF-8');

					if ($checkLetter != $currentLetter) {
						$currentLetter = $checkLetter;
						$html .= '
								</div>
							</div>
							<div class="city-list-row">
								<div class="city-list-letter">'.$currentLetter.'</div>
								<div class="city-list-items">
						';
					}

					$html .= '<a href="/'.$item->simbol_name.'">'.$item->gorod.'</a>';
				}

				$html .= '
						</div>
					</div>
				';
			?>
				<?= $html ?>
			</div>
		</div>
	</div>
</div>