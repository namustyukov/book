<?php
/* @var $this ShopOnlineController */
/* @var $model ShopOnline */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shop-online-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'goods_type'); ?>
		<?php echo $form->textField($model,'goods_type',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'goods_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'buy_condition'); ?>
		<?php echo $form->textField($model,'buy_condition',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'buy_condition'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery'); ?>
		<?php echo $form->textField($model,'delivery',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'delivery'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?php echo $form->textField($model,'payment',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'worktime'); ?>
		<?php echo $form->textField($model,'worktime',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'worktime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site'); ?>
		<?php echo $form->textField($model,'site',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'site'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_out'); ?>
		<?php echo $form->textField($model,'delivery_out',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'delivery_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_from'); ?>
		<?php echo $form->textField($model,'delivery_from',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'delivery_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'logo'); ?><br />
		<?php echo CHtml::activeFileField($model,'logo'); ?>
		<?php echo CHtml::error($model,'logo'); ?>
		<?
			if ($model->logo)
			{
				echo "<h4>Текущая картинка</h4>";
				echo '<img src="'.Yii::app()->request->baseUrl.'/img/'.$model->logo.'"';
			}
		?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->