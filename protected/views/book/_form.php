<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description_short'); ?>
		<?php echo $form->textArea($model,'description_short',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description_short'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_book'); ?>
		<?php echo $form->textField($model,'type_book',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'type_book'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_book_id'); ?>
		<?php echo $form->textField($model,'type_book_id'); ?>
		<?php echo $form->error($model,'type_book_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'baseprice'); ?>
		<?php echo $form->textField($model,'baseprice'); ?>
		<?php echo $form->error($model,'baseprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language_id'); ?>
		<?php echo $form->textField($model,'language_id'); ?>
		<?php echo $form->error($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'publisher'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'publisher_id'); ?>
		<?php echo $form->textField($model,'publisher_id'); ?>
		<?php echo $form->error($model,'publisher_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_extent'); ?>
		<?php echo $form->textField($model,'page_extent',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'page_extent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ISBN'); ?>
		<?php echo $form->textField($model,'ISBN',array('size'=>60,'maxlength'=>300)); ?>
		<?php echo $form->error($model,'ISBN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_new'); ?>
		<?php echo $form->textField($model,'is_new'); ?>
		<?php echo $form->error($model,'is_new'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_bestseller'); ?>
		<?php echo $form->textField($model,'is_bestseller'); ?>
		<?php echo $form->error($model,'is_bestseller'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'like_count'); ?>
		<?php echo $form->textField($model,'like_count'); ?>
		<?php echo $form->error($model,'like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'not_like_count'); ?>
		<?php echo $form->textField($model,'not_like_count'); ?>
		<?php echo $form->error($model,'not_like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mark_reviews'); ?>
		<?php echo $form->textField($model,'mark_reviews'); ?>
		<?php echo $form->error($model,'mark_reviews'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_sync'); ?>
		<?php echo $form->textField($model,'date_sync'); ?>
		<?php echo $form->error($model,'date_sync'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donor_url'); ?>
		<?php echo $form->textField($model,'donor_url',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'donor_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'donor_id'); ?>
		<?php echo $form->textField($model,'donor_id'); ?>
		<?php echo $form->error($model,'donor_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->