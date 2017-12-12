<?php
/* @var $this CategoryBookController */
/* @var $model CategoryBook */

$this->breadcrumbs=array(
	'Category Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CategoryBook', 'url'=>array('index')),
	array('label'=>'Manage CategoryBook', 'url'=>array('admin')),
);
?>

<h1>Create CategoryBook</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>