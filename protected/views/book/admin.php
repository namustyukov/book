<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Books</h1>

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
	'id'=>'book-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'author',
		'description',
		'description_short',
		'type_book',
		'is_bestseller',
		'mark_reviews',
		'count_reviews',
		/*
		'type_book_id',
		'price',
		'baseprice',
		'picture',
		'language',
		'language_id',
		'publisher',
		'publisher_id',
		'page_extent',
		'ISBN',
		'year',
		'is_new',
		'like_count',
		'not_like_count',
		'mark_reviews',
		'url',
		'date_sync',*/
		'donor_url',
		'donor_id',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
