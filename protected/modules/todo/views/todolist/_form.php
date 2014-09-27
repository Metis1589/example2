<?php
/* @var $this TodolistController */
/* @var $model Todo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'todo-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('main','Fields with <span class="required">*</span> are required.') ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'style'=>'width: 100%')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->dropDownList($model,'category',Lookup::items('task_category'),array('style'=>'width: 100%')); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->numberField($model,'priority',array('style'=>'width: 100%')); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>
        
        <?php if(!$model->getIsNewRecord()): ?>
        <div class="row">
		<?php echo $form->labelEx($model,'is_complted'); ?>
		<?php echo $form->checkBox($model,'is_complted'); ?>
		<?php echo $form->error($model,'is_complted'); ?>
	</div>
        <?php endif; ?>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('main','Create') : Yii::t('main','Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->