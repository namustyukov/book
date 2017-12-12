<?php
/* @var $this CategoryBookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Category Books',
);

$this->menu=array(
	array('label'=>'Create CategoryBook', 'url'=>array('create')),
	array('label'=>'Manage CategoryBook', 'url'=>array('admin')),
);
?>

<h1>Category Books</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
