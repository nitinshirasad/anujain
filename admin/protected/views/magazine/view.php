<div class="headings">
<h2 class="left">View Magazine # <?php echo CHtml::encode($model->pkMagazineId); ?></h2>
</div>
<div class="contentbox nopad" id="tabs-2">
<div class="content">
	<?php $this->renderPartial('_view', array(
		'data'=>$model,)); 
	?> 
</div>
</div>