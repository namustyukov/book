<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gorod'); ?>
		<?php echo $form->textField($model,'gorod',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'goroda'); ?>
		<?php echo $form->textField($model,'goroda',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gorode'); ?>
		<?php echo $form->textField($model,'gorode',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gorodu'); ?>
		<?php echo $form->textField($model,'gorodu',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakih'); ?>
		<?php echo $form->textField($model,'kakih',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakie'); ?>
		<?php echo $form->textField($model,'kakie',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakimi'); ?>
		<?php echo $form->textField($model,'kakimi',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakuyu'); ?>
		<?php echo $form->textField($model,'kakuyu',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakoy'); ?>
		<?php echo $form->textField($model,'kakoy',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakom'); ?>
		<?php echo $form->textField($model,'kakom',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kakaya'); ?>
		<?php echo $form->textField($model,'kakaya',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'simbol_name'); ?>
		<?php echo $form->textField($model,'simbol_name',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'donor_url'); ?>
		<?php echo $form->textField($model,'donor_url',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'koord_x'); ?>
		<?php echo $form->textField($model,'koord_x',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'koord_y'); ?>
		<?php echo $form->textField($model,'koord_y',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_modify'); ?>
		<?php echo $form->textField($model,'date_modify'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->