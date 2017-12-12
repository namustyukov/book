<?php
/* @var $this BookController */
/* @var $model Book */
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
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description_short'); ?>
		<?php echo $form->textArea($model,'description_short',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_book'); ?>
		<?php echo $form->textField($model,'type_book',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type_book_id'); ?>
		<?php echo $form->textField($model,'type_book_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'baseprice'); ?>
		<?php echo $form->textField($model,'baseprice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'picture'); ?>
		<?php echo $form->textField($model,'picture',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'language_id'); ?>
		<?php echo $form->textField($model,'language_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>300)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publisher_id'); ?>
		<?php echo $form->textField($model,'publisher_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'page_extent'); ?>
		<?php echo $form->textField($model,'page_extent',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ISBN'); ?>
		<?php echo $form->textField($model,'ISBN',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_new'); ?>
		<?php echo $form->textField($model,'is_new'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'is_bestseller'); ?>
		<?php echo $form->textField($model,'is_bestseller'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'like_count'); ?>
		<?php echo $form->textField($model,'like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'not_like_count'); ?>
		<?php echo $form->textField($model,'not_like_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mark_reviews'); ?>
		<?php echo $form->textField($model,'mark_reviews'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_sync'); ?>
		<?php echo $form->textField($model,'date_sync'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'donor_url'); ?>
		<?php echo $form->textField($model,'donor_url',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'donor_id'); ?>
		<?php echo $form->textField($model,'donor_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->