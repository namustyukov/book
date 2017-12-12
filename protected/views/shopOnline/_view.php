<?php
/* @var $this ShopOnlineController */
/* @var $data ShopOnline */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goods_type')); ?>:</b>
	<?php echo CHtml::encode($data->goods_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('buy_condition')); ?>:</b>
	<?php echo CHtml::encode($data->buy_condition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery')); ?>:</b>
	<?php echo CHtml::encode($data->delivery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment')); ?>:</b>
	<?php echo CHtml::encode($data->payment); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('worktime')); ?>:</b>
	<?php echo CHtml::encode($data->worktime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_out')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_out); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_from')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	*/ ?>

</div>