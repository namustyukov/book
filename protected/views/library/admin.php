<?php
/* @var $this LibraryController */
/* @var $model Library */

$this->breadcrumbs=array(
	'Libraris'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Library', 'url'=>array('index')),
	array('label'=>'Create Library', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#library-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Library</h1>

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
	'id'=>'library-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'full_name',
		'address',
		'phone',
		'email',
		'url',
		/*
		'site',
		'worktime',
		'rating',
		'online',
		'date_found',
		'certificate',
		'guarantee',
		'payment',
		'price',
		'promo',
		'production_way',
		'about',
		'logo',
		'city_id',
		'category_id',
		'donor_site',
		'koord_x',
		'koord_y',
		'date_modify',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
