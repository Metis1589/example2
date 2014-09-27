<?php
/* @var $this TodolistController */
/* @var $model Todo */

$this->breadcrumbs=array(
	Yii::t('main','Tasks')=>array('admin'),
	Yii::t('main','Task').' #'.$model->id
);

$this->menu=array(
	array('label'=>Yii::t('main','Manage tasks'), 'url'=>array('admin')),
	array('label'=>Yii::t('main','Create task'), 'url'=>array('create')),
	array('label'=>Yii::t('main','Update task'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('main','Delete task'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1><?php echo Yii::t('main','View task #{id}',array('{id}'=>$model->id)) ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
                array(
                    'name'  => 'category',
                    'value' => Lookup::item("task_category",$model->category)
                ),
                array(
                    'name'  => 'is_complted',
                    'value' => $model->is_complted ? Yii::t('main','Complited') : Yii::t('main','In progress')
                ),
		'priority',
		'date_create',
		'date_update',
	),
)); ?>
<br>
