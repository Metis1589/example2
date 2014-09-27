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
<?php echo CHtml::image(Yii::app()->getBaseUrl().'/img/icon/tasks_16.png').' '.CHtml::link(Yii::t('main','All tasks'),Yii::app()->createUrl('/todo/todolist/admin')) ?><br>
<?php echo CHtml::image(Yii::app()->getBaseUrl().'/img/icon/tick_16.png').' '.CHtml::link(Yii::t('main','Complited tasks'),Yii::app()->createUrl('/todo/todolist/admin',array('show'=>'complited'))) ?><br>
<?php echo CHtml::image(Yii::app()->getBaseUrl().'/img/icon/inprogress_16.png').' '.CHtml::link(Yii::t('main','In progress tasks'),Yii::app()->createUrl('/todo/todolist/admin',array('show'=>'inprogress'))) ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'todo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        //'ajaxUpdate' => false,
	'columns'=>array(
		array(
                    'name'=>'id',
                    'htmlOptions' => array('style'=>'width:30px;'),
                    'sortable' => false
                ),
                array
                (
                    'name'=>'description',
                    'value'=>'$data->description',
                    'sortable' => false
		),
		array
                (
                    'name'=>'category',
                    'value'=>'Lookup::item("task_category",$data->category)',
                    'filter'=>Lookup::items("task_category"),
                    'sortable' => false
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{complite}{restore}{view}{update}{delete}',
                        'htmlOptions' => array('style'=>'width:80px;text-align: center'),
			'buttons'=>array
                        (
                            'complite'=> array
                            (
                                //'url'=>'Yii::app()->createUrl("todo/todolist/complite", array("id"=>$data["id"]))',
                                'imageUrl'=>'/img/icon/inprogress_16.png',
                                'visible'=>'!$data->is_complted',
                                'options'=>array('style'=>'margin-right:3px;','title'=>Yii::t('main','Mark as complited'),'class'=>'restore')
                            ),
                            'restore'=> array
                            (
                                //'url'=>'Yii::app()->createUrl("todo/todolist/restore", array("id"=>$data["id"]))',
                                'imageUrl'=>'/img/icon/tick_16.png',
                                'visible'=>'$data->is_complted',
                                'options'=>array('style'=>'margin-right:3px;','title'=>Yii::t('main','Restore task'),'class'=>'complite')
                            ),
		     ),
		),
	),
)); ?>

<?php
Yii::app()->clientScript->registerScript('status_update',
'
$("#content").on("click","a.complite",function(){
    var id = $(this).closest("tr").find("td:first").html();
    $.ajax({
        type: "POST",
        dataType : "json",
        url: "'.Yii::app()->getBaseUrl(true).'/todo/todolist/restore/id/"+id,
        success: function( data ) {
            if(data.result){
                var target = $("td").filter(function() {
                    return $(this).text() == data.id;
                }).closest("tr");
                target.find("td:last .complite img").attr("src","'.Yii::app()->getBaseUrl(true).'/img/icon/inprogress_16.png");
                target.find("td:last a.complite").addClass("restore");
                target.find("td:last a.restore").removeClass("complite");
                target.find("td:last a.restore").attr("title","'.Yii::t('main','Mark as complited').'");
            }
        },
    });
    return false;
});
$("#content").on("click","a.restore",function(){
    var id = $(this).closest("tr").find("td:first").html();
    $.ajax({
        type: "POST",
        dataType : "json",
        url: "'.Yii::app()->getBaseUrl(true).'/todo/todolist/complite/id/"+id,
        success: function( data ) {
            if(data.result){
                var target = $("td").filter(function() {
                    return $(this).text() == data.id;
                }).closest("tr");      
                target.find("td:last .restore img").attr("src","'.Yii::app()->getBaseUrl(true).'/img/icon/tick_16.png");
                target.find("td:last a.restore").addClass("complite");            
                target.find("td:last a.complite").removeClass("restore");
                target.find("td:last a.complite").attr("title","'.Yii::t('main','Restore task').'");
            }
        },
    });
    return false;
});
');                     	
?>