<?php
/* @var $this CityController */
/* @var $data City */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gorod')); ?>:</b>
	<?php echo CHtml::encode($data->gorod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goroda')); ?>:</b>
	<?php echo CHtml::encode($data->goroda); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gorode')); ?>:</b>
	<?php echo CHtml::encode($data->gorode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gorodu')); ?>:</b>
	<?php echo CHtml::encode($data->gorodu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakih')); ?>:</b>
	<?php echo CHtml::encode($data->kakih); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakie')); ?>:</b>
	<?php echo CHtml::encode($data->kakie); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('kakimi')); ?>:</b>
	<?php echo CHtml::encode($data->kakimi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakuyu')); ?>:</b>
	<?php echo CHtml::encode($data->kakuyu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakoy')); ?>:</b>
	<?php echo CHtml::encode($data->kakoy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakom')); ?>:</b>
	<?php echo CHtml::encode($data->kakom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kakaya')); ?>:</b>
	<?php echo CHtml::encode($data->kakaya); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('simbol_name')); ?>:</b>
	<?php echo CHtml::encode($data->simbol_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('region_id')); ?>:</b>
	<?php echo CHtml::encode($data->region_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('donor_url')); ?>:</b>
	<?php echo CHtml::encode($data->donor_url); ?>
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