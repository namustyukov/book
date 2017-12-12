<?php
/* @var $this ShopOnlineController */
/* @var $model ShopOnline */

$this->breadcrumbs=array(
	'Shop Onlines'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ShopOnline', 'url'=>array('index')),
	array('label'=>'Create ShopOnline', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#shop-online-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Shop Onlines</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'shop-online-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'url',
		'goods_type',
		'buy_condition',
		'delivery',
		/*
		'payment',
		'address',
		'worktime',
		'phone',
		'site',
		'delivery_out',
		'delivery_from',
		'rating',
		'logo',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
