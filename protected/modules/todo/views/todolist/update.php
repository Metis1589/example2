<?php
/* @var $this TodolistController */
/* @var $model Todo */

$this->breadcrumbs=array(
	Yii::t('main','Tasks')=>array('admin'),
	Yii::t('main','Task').' #'.$model->id=>array('view','id'=>$model->id),
	Yii::t('main','Update task #{id}',array('{id}'=>$model->id)),
);
?>

<h1><?php echo Yii::t('main','Update task #{id}',array('{id}'=>$model->id)) ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>