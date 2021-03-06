<?php
/* @var $this BorrowLineController */
/* @var $model BorrowLine */

$this->breadcrumbs=array(
	'Borrow Lines'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BorrowLine', 'url'=>array('index')),
	array('label'=>'Create BorrowLine', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#borrow-line-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Borrow Lines</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'borrow-line-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'site_id',
		'user_id',
		'name',
		'status',
		'order',
		/*
		'hits',
		'litpic',
		'flag',
		'type',
		'borrow_use',
		'borrow_qixian',
		'province',
		'city',
		'area',
		'account',
		'content',
		'pawn',
		'tel',
		'sex',
		'xing',
		'verify_user',
		'verify_time',
		'verify_remark',
		'addtime',
		'addip',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
