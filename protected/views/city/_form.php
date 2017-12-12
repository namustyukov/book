<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gorod'); ?>
		<?php echo $form->textField($model,'gorod',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorod'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'goroda'); ?>
		<?php echo $form->textField($model,'goroda',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'goroda'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gorode'); ?>
		<?php echo $form->textField($model,'gorode',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gorodu'); ?>
		<?php echo $form->textField($model,'gorodu',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'gorodu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakih'); ?>
		<?php echo $form->textField($model,'kakih',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakih'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakie'); ?>
		<?php echo $form->textField($model,'kakie',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakie'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakimi'); ?>
		<?php echo $form->textField($model,'kakimi',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakimi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakuyu'); ?>
		<?php echo $form->textField($model,'kakuyu',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakuyu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakoy'); ?>
		<?php echo $form->textField($model,'kakoy',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakoy'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakom'); ?>
		<?php echo $form->textField($model,'kakom',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kakaya'); ?>
		<?php echo $form->textField($model,'kakaya',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'kakaya'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'simbol_name'); ?>
		<?php echo $form->textField($model,'simbol_name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'simbol_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region_id'); ?>
		<?php echo $form->textField($model,'region_id'); ?>
		<?php echo $form->error($model,'region_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donor_url'); ?>
		<?php echo $form->textField($model,'donor_url',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'donor_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'koord_x'); ?>
		<?php echo $form->textField($model,'koord_x',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'koord_x'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'koord_y'); ?>
		<?php echo $form->textField($model,'koord_y',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'koord_y'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_modify'); ?>
		<?php echo $form->textField($model,'date_modify'); ?>
		<?php echo $form->error($model,'date_modify'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->