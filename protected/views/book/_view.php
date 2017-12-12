<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description_short')); ?>:</b>
	<?php echo CHtml::encode($data->description_short); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_book')); ?>:</b>
	<?php echo CHtml::encode($data->type_book); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_book_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_book_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('baseprice')); ?>:</b>
	<?php echo CHtml::encode($data->baseprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('picture')); ?>:</b>
	<?php echo CHtml::encode($data->picture); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
	<?php echo CHtml::encode($data->language); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('language_id')); ?>:</b>
	<?php echo CHtml::encode($data->language_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher')); ?>:</b>
	<?php echo CHtml::encode($data->publisher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher_id')); ?>:</b>
	<?php echo CHtml::encode($data->publisher_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_extent')); ?>:</b>
	<?php echo CHtml::encode($data->page_extent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ISBN')); ?>:</b>
	<?php echo CHtml::encode($data->ISBN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_new')); ?>:</b>
	<?php echo CHtml::encode($data->is_new); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_bestseller')); ?>:</b>
	<?php echo CHtml::encode($data->is_bestseller); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('like_count')); ?>:</b>
	<?php echo CHtml::encode($data->like_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('not_like_count')); ?>:</b>
	<?php echo CHtml::encode($data->not_like_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mark_reviews')); ?>:</b>
	<?php echo CHtml::encode($data->mark_reviews); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_sync')); ?>:</b>
	<?php echo CHtml::encode($data->date_sync); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_url')); ?>:</b>
	<?php echo CHtml::encode($data->donor_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_id')); ?>:</b>
	<?php echo CHtml::encode($data->donor_id); ?>
	<br />

	*/ ?>

</div>