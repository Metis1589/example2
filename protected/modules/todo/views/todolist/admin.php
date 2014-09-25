<?php
/* @var $this TodolistController */
/* @var $model Todo */

$this->breadcrumbs=array(
	Yii::t('main','Tasks')
);

$this->menu=array(
	array('label'=>Yii::t('main','Create task'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#todo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('main','Manage tasks') ?></h1>

<div>
&nbsp;&nbsp;<?php echo CHtml::link(Yii::t('main','All tasks'),Yii::app()->createUrl('/todo/todolist/admin')) ?>
&nbsp;&nbsp;<?php echo CHtml::link(Yii::t('main','Complited tasks'),Yii::app()->createUrl('/todo/todolist/admin',array('show'=>'complited'))) ?>
&nbsp;&nbsp;<?php echo CHtml::link(Yii::t('main','In progress tasks'),Yii::app()->createUrl('/todo/todolist/admin',array('show'=>'inprogress'))) ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'todo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'ajaxUpdate' => false,
        //'template' => '<div style="float:right">{summary}</div>{items}{pager}',
	'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions' => array('style'=>'width:30px;')
                ),
		'description',
		array
                (
                    'name'=>'category',
                    'value'=>'Lookup::item("task_category",$data->category)',
                    'filter'=>Lookup::items("task_category"),
		),
                /*array
                (
                    'name'=>'is_complted',
                    'value'=>'$data->is_complted ? Yii::t("main","Complited") : Yii::t("main","In progress")',
                    'filter'=>array(0=>'In progress tasks',1=>'Complited tasks',),
		),
		'priority',
		array
                (
                    'name'=>'date_create',
                    'value'=>'Yii::app()->dateFormatter->format("dd.MM.yyyy HH:mm",$data->date_create)',
		),*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{complite}{restore}{view}{update}{delete}',
                        'htmlOptions' => array('style'=>'width:80px;text-align: center'),
			'buttons'=>array
                        (
                            'complite'=> array
                            (
                                'url'=>'Yii::app()->createUrl("todo/todolist/complite", array("id"=>$data["id"]))',
                                'imageUrl'=>'/img/icon/tick_16.png',
                                'visible'=>'!$data->is_complted',
                                'options'=>array('style'=>'margin-right:3px;','title'=>Yii::t('main','Mark as complited'))
                            ),
                            'restore'=> array
                            (
                                'url'=>'Yii::app()->createUrl("todo/todolist/restore", array("id"=>$data["id"]))',
                                'imageUrl'=>'/img/icon/inprogress_16.png',
                                'visible'=>'$data->is_complted',
                                'options'=>array('style'=>'margin-right:3px;','title'=>Yii::t('main','Restore task'))
                            ),
		     ),
		),
	),
)); ?>
