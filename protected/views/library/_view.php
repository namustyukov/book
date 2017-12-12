<?php
/* @var $this LibraryController */
/* @var $data Library */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('full_name')); ?>:</b>
	<?php echo CHtml::encode($data->full_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('worktime')); ?>:</b>
	<?php echo CHtml::encode($data->worktime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('online')); ?>:</b>
	<?php echo CHtml::encode($data->online); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_found')); ?>:</b>
	<?php echo CHtml::encode($data->date_found); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('certificate')); ?>:</b>
	<?php echo CHtml::encode($data->certificate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('guarantee')); ?>:</b>
	<?php echo CHtml::encode($data->guarantee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment')); ?>:</b>
	<?php echo CHtml::encode($data->payment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('promo')); ?>:</b>
	<?php echo CHtml::encode($data->promo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('production_way')); ?>:</b>
	<?php echo CHtml::encode($data->production_way); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('about')); ?>:</b>
	<?php echo CHtml::encode($data->about); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_site')); ?>:</b>
	<?php echo CHtml::encode($data->donor_site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('koord_x')); ?>:</b>
	<?php echo CHtml::encode($data->koord_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('koord_y')); ?>:</b>
	<?php echo CHtml::encode($data->koord_y); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_modify')); ?>:</b>
	<?php echo CHtml::encode($data->date_modify); ?>
	<br />

	*/ ?>

</div>