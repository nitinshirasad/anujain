<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
?>
<div class="headings">
<h2>Manage Advertisement</h2>
</div>
<?php if(isset($_POST['action_type']) && $_POST['action_type']=="multiple_delete") { $this->multipleDelete($_POST); } ?>
<?php if(isset($_POST['action_type']) && $_POST['action_type']=="multiple_publish") { $this->multiplePublish($_POST); } ?>
<?php if(isset($_POST['action_type']) && $_POST['action_type']=="multiple_unpublish") { $this->multipleUnpublish($_POST); } ?>

<form name="actionForm" id="actionForm" action="" method="post">
<div class="contentbox nopad" id="tabs-2">
<div style="color: #FF0000;"><?php if(isset($_GET['msg']) && !empty($_GET['msg'])) { echo $_GET['msg']; } ?>
</div>
<div align="right"><a href="javascript:void(0);" id="multiple_delete"> <img
	src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/mu_delete.png"
	title="Delete" /> </a> <a href="javascript:void(0);"
	id="multiple_publish"> <img
	src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/publish.png"
	title="Publish" /> </a> <a href="javascript:void(0);"
	id="multiple_unpublish"> <img
	src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/unpublish.png"
	title="Unpublish" /> </a> <a
	href="<?php echo Yii::app()->createUrl("/advertisement/create");?>"
	id="mul_add"> <img
	src="<?php echo Yii::app()->request->baseUrl;?>/img/icons/add.png"
	title="Add" alt="Add" /> </a></div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'cssFile'=>Yii::app()->request->baseUrl.'/css/gridview/styles.css',
	'id'=>'advertisement-grid',
	'dataProvider'=>$model->search(),
	'selectableRows'=>5,
	'filter'=>$model,
	'columns'=>array(				
					array(
						'class'=>'CCheckBoxColumn',
					),

					array(
						'name'=>'CustomerName',
						'value'=>'$data->CustomerName',
					),
					array(
						'name'=>'TitleName',
						'value'=>'$data->TitleName',
					),

					array(
						'name'=>'FooterDescription',
						'value'=>'$data->FooterDescription',
					),

					array(
						'name'=>'WebsiteLink',
						'value'=>'$data->WebsiteLink',
					),
					array(
						'name'=>'DateFrom',
						'value'=>'date("d M Y", strtotime($data->DateFrom))',
					),
					array(
						'name'=>'DateTo',
						'value'=>'date("d M Y", strtotime($data->DateTo))',
					),
					
					array(
						'name'=>'DateFrom',
						'value'=>'time()>=strtotime($data->DateFrom) && time()<=strtotime($data->DateTo) ? "Active" : "Expired"',
						'filter'=>false,
						'header'=> 'Active Status'
					),

					array(
						'name'=>'Add Type',
						'value'=>'$data->getAddType($data->AddType)',
						'filter'=>CHtml::dropDownList('Advertisement[AddType]', $model->AddType,  
									array('1'=>$model->getAddType(1),'2'=>$model->getAddType(2)),
									array('style'=>'width: 140px;')),
					),
					
					array(
						'name'=>'Status',
						'value'=>'$data->Status==1 ? "Published" : "Unpublished"',
						'filter'=>CHtml::dropDownList('Advertisement[Status]', $model->Status,  
									array('1'=>'Published','0'=>'Unpublished'),
									array('style'=>'width: 110px;')),
					),

					array(
						'class'=>'CButtonColumn',
						'htmlOptions' => array('style'=>'width:120px'),
						'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,15=>15,20=>20,30=>30,50=>50,100=>100,200=>200),array(
						// change 'user-grid' to the actual id of your grid!!
								'onchange'=>"$.fn.yiiGridView.update('advertisement-grid',{ data:{pageSize: $(this).val() }})",
						)),
						'buttons'=>array(
						  'up'=>array(
							  'label'=>'Publish',
							  'imageUrl'=>Yii::app()->request->baseUrl . '/img/icons/publish_small.png',
							  'url'=>'Yii::app()->createUrl("/advertisement/publish?id=$data->pkAddId")',
							),
						  'down'=>array(
							  'label'=>'Unpublish',
							  'imageUrl'=>Yii::app()->request->baseUrl . '/img/icons/unpublish_small.png',
							  'url'=>'Yii::app()->createUrl("/advertisement/unpublish?id=$data->pkAddId")',
							),
						),
						'viewButtonLabel'=>yii::t('core','View'),
						'updateButtonLabel'=>yii::t('core','Update'),
						'deleteButtonLabel'=>yii::t('core','Delete'),
						'template'=> '{up} {down} {view} {update} {delete}',
					),
			),
)); ?></div>
<input type="hidden" name="action_type" id="action_type" value="" /></form>