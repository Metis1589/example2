<?php
/* @var $this TodolistController */
/* @var $model Todo */

$this->breadcrumbs=array(
	Yii::t('main','Tasks')=>array('admin'),
	Yii::t('main','Create task')
);
?>

<h1><?php echo Yii::t('main','Create task') ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>