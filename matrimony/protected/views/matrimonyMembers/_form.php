<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.form.js"></script>
<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/Jcrop/jquery.Jcrop.min.js');
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/Jcrop/jquery.color.js');
		Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/Jcrop/jquery.Jcrop.css');
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'matrimony-members-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<div style="float:left;">
	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'MemberName'); ?></dt>
            <dd><?php echo $form->textField($model,'MemberName',array('size'=>45,'maxlength'=>45)); ?>
            	<?php echo $form->error($model,'MemberName'); ?>
            </dd>   
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Sex'); ?></dt>
            <dd><?php
                $sex = array('1'=>'Male', '0'=>'Female');
                echo $form->radioButtonList($model,'Sex',$sex,array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline')));
            ?>		
            <?php //echo $form->dropDownList($model,'Sex',array('MALE'=>'Male', 'FEMALE'=>'Female')); ?>
            <?php echo $form->error($model,'Sex'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>        
			<dt><?php echo $form->labelEx($model,'DOB'); ?></dt>
            <dd><?php echo $form->textField($model,'DOB'); ?>
           <?php /*
		   <?php 
                $day = array();
                for($i=1; $i<=31; $i++){
                    $j = $i;
                    if(strlen($i)==1){
                        $j = '0'.$i;
                    }
                    $day[$j] = $j;
                }
                echo CHtml::dropDownList('','', $day,array('prompt'=>'[Day]','id'=>'dayId'));
            ?>
            <?php 
                $month = array('01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'May', '06'=>'Jun', '07'=>'Jul', '08'=>'Aug', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Dec');
                echo CHtml::dropDownList('','', $month,array('prompt'=>'[Month]','id'=>'monthId'));
            ?>
            <?php 
                $currentYear = (int)date('Y');
                $year = array();
                for($i=($currentYear-18); $i>=($currentYear-70); $i--){
                    $year[$i] = $i;
                }
                echo CHtml::dropDownList('','', $year,array('prompt'=>'[Year]','id'=>'yearId'));
            ?>
            */?>
            <?php echo $form->error($model,'DOB'); ?>
            </dd>
    	</dl>        
	</div>
</div>
<div style="float: right;">
	<?php
		$imgPath = Yii::app()->request->baseUrl."/../images/blank_user.png";										
		if($model->MemberPhoto && trim($model->MemberPhoto)!=""){
			$imgPath = Yii::app()->request->baseUrl."/..". Yii::app()->params['matrimonyPath']."/".$model->MemberPhoto;
		}
	?>
	<div style="background: url(<?php echo $imgPath; ?>) center; width: 100px; height: 140px; border: solid 1px #CCCCCC;" ></div>
</div>
<div style="clear:both;"></div>

	<div class="row">
        <dl>
        	<dt><?php echo $form->labelEx($model,'MaritalStatus'); ?></dt>
            <dd> 
			<?php
			if(!$model->MaritalStatus){
				$model->MaritalStatus = '1';
			}
        	$maritalStatus = array('1'=>'Unmarried', '2'=>'Widow / Widower', '3'=>'Divorced', '4'=>'Separated');
            echo $form->radioButtonList($model,'MaritalStatus',$maritalStatus,array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline')));
			?>
			<?php echo $form->error($model,'MaritalStatus'); ?>
            </dd>
        </dl>
	</div>

	<div id="childs" class="row" style="display:none;">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Childrens'); ?></dt>
            <dd>
			<?php 
				$childs = array('0'=>'None','1'=>'1','2'=>'2','3'=>'3','4','3+');
				echo $form->dropDownList($model,'Childrens',$childs);
			?>
            <?php echo $form->error($model,'Childrens'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Height'); ?></dt>
            <dd>
            <?php
				$height = array();
				$initialValue = 119.38;
				for($i=4; $i<8; $i++){					
					for($j=0; $j<12; $j++){
						$initialValue = $initialValue + 2.54;						
						$key = number_format($initialValue,2);
						$value = $i.' feet'.(($j==0)?'':' '.$j.' inches');
						$height[$key]= $value; 
					}
				}
				
			?>
            <?php echo $form->dropDownList($model,'Height',$height, array('prompt'=>'--- Feet/Inches ---')); ?>			
            <?php echo $form->error($model,'Height'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkSect'); ?></dt>
            <dd><?php
                $sect = CHtml::listData(MatrimonySect::model()->findAll(array('order'=>' SectName ASC ')),'pkSectId','SectName');
                echo $form->dropDownList($model,'fkSect',$sect,array('prompt'=>'[Select Sect]'));
            ?>
            <?php echo $form->error($model,'fkSect'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkSubSect'); ?></dt>
            <dd><?php $subsect = array(); ?>
            <?php echo $form->dropDownList($model,'fkSubSect',$subsect,array('prompt'=>'[Select Sub Sect]'));?>
            <?php echo $form->error($model,'fkSubSect'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkCaste'); ?></dt>
            <dd><?php 
				$sql = "(SELECT pkCasteId as pkCasteId,CasteName as CasteName FROM matrimony_caste where pkCasteId not in(0,1,2) order by CasteName)
						union
						(SELECT pkCasteId as pkCasteId,CasteName as CasteName FROM matrimony_caste where pkCasteId in(0,1,2) order by pkCasteId)";
						$command=Yii::app()->db->createCommand($sql);
						$results=$command->queryAll();
				$caste = CHtml::listData($results,'pkCasteId','CasteName');
				//$caste = CHtml::listData(MatrimonyCaste::model()->findAll(array('order'=>' pkCasteId DESC ')),'pkCasteId','CasteName');
                echo $form->dropDownList($model,'fkCaste',$caste,array('prompt'=>'[Select Caste]'));
			?>
            <?php echo $form->textField($model,'OtherCaste',array('size'=>45,'maxlength'=>45, 'style'=>'display:none;')); ?>
            <?php echo $form->error($model,'fkCaste'); ?>
            </dd>
        </dl>
	</div>
	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkMotherTongue'); ?></dt>
            <dd>
			<?php
                $motherTongue = CHtml::listData(MatrimonyMotherTongue::model()->findAll(array('order'=>' TongueName ASC ')),'pkTongueId','TongueName');
                echo $form->dropDownList($model,'fkMotherTongue',$motherTongue,array('prompt'=>'[Select Tongue]'));
            ?>
            <?php echo $form->error($model,'fkMotherTongue'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkCountryLivingIn'); ?></dt>
            <dd>
            <?php
                $country = CHtml::listData(Country::model()->findAll(array('order'=>' CountryName ASC ')),'pkCountryId','CountryName');
                echo $form->dropDownList($model,'fkCountryLivingIn',$country,array('prompt'=>'[Select Country]'));
            ?>
			<?php echo $form->error($model,'fkCountryLivingIn'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'ContactNo'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'ContactNo',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'ContactNo'); ?>
            </dd>
        </dl>
	</div>

	<div class="row">
		<dl>
			<dt><?php echo $form->labelEx($model,'PhysicalStatus'); ?></dt>
			<dd>
				<?php
				if(!$model->PhysicalStatus){
					$model->PhysicalStatus = '0';
				}
                $physicalStatus = array('0'=>'Normal', '1'=>'Physically Challenged');
                echo $form->radioButtonList($model,'PhysicalStatus',$physicalStatus,array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline')));
               ?>	
				<?php echo $form->error($model,'PhysicalStatus'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkResidingState'); ?></dt>
			<dd>
				<?php
                $state = CHtml::listData(States::model()->findAll(array('order'=>' StateName ASC ')),'pkStateId','StateName');
                echo $form->dropDownList($model,'fkResidingState',$state,array('prompt'=>'[Select State]'));
               ?>
				<?php echo $form->error($model,'fkResidingState'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'ResidingCity'); ?></dt>
			<dd>	
				<?php echo $form->textField($model,'ResidingCity',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'ResidingCity'); ?>
            </dd>   
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'MarryInSameSubSect'); ?></dt>
			<dd>
				<?php
				if(!$model->MarryInSameSubSect){
					$model->MarryInSameSubSect = '2';
				}
                $marrySameSubSect = array('1'=>'Willing to marry from the same sub sect', '2'=>'Willing to marry from other sub sect also');
                echo $form->radioButtonList($model,'MarryInSameSubSect',$marrySameSubSect,array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline')));
               ?>	
				<?php echo $form->error($model,'MarryInSameSubSect'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'fkEducation'); ?></dt>
			<dd>
            	<?php 
					$sql = "SELECT mc.pkCourseId,mc.CourseName,mcg.GroupName FROM matrimony_course mc inner join matrimony_course_group mcg on (mc.fkCourseGroupId=mcg.pkCourseGroupId) order by mcg.GroupName,mc.CourseName";
					$command=Yii::app()->db->createCommand($sql);
					$allCourses = CHtml::listData($command->queryAll(),'pkCourseId','CourseName','GroupName');		
                	echo $form->dropDownList($model,'fkEducation',$allCourses,array('prompt'=>'[Select Course]'));
			    ?>
				<?php echo $form->error($model,'fkEducation'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'EmployedIn'); ?></dt>
			<dd>
				<?php
                $employementStatus = array('1'=>'Government', '2'=>'Defence', '3'=>'Private', '4'=>'Business', '5'=>'Self Employed', '6'=>'Not Working');
                echo $form->radioButtonList($model,'EmployedIn',$employementStatus,array('separator'=>' ', 'labelOptions'=>array('style'=>'display:inline')));
               ?>	
				<?php echo $form->error($model,'EmployedIn'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Occupation'); ?></dt>
			<dd>
            	<?php 
					$sql = "SELECT o.pkOccupationId,o.OccupationName,g.GroupName FROM occupation o inner join occupation_group g on (o.fkOccGroupId=g.pkOccGroupId) order by g.GroupName,o.OccupationName";
					$command=Yii::app()->db->createCommand($sql);
					$occupation = CHtml::listData($command->queryAll(),'pkOccupationId','OccupationName','GroupName');		
                	echo $form->dropDownList($model,'Occupation',$occupation,array('prompt'=>'[Select Occupation]'));
			    ?>
				<?php echo $form->error($model,'Occupation'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'IncomeAnnual'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'IncomeAnnual',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'IncomeAnnual'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'AboutMe'); ?></dt>
			<dd>
				<?php echo $form->textArea($model,'AboutMe',array('style'=>'width:400px;height:100px','maxlength'=>200)); ?>
                <?php echo $form->error($model,'AboutMe'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'AboutMyPartner'); ?></dt>
			<dd>
				<?php echo $form->textArea($model,'AboutMyPartner',array('style'=>'width:400px;height:100px','maxlength'=>200)); ?>
                <?php echo $form->error($model,'AboutMyPartner'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
		<dl>
			<dt><?php echo $form->labelEx($model,'Address1'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'Address1',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'Address1'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Address2'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'Address2',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'Address2'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Address3'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'Address3',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'Address3'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row">
    	<dl>
			<dt><?php echo $form->labelEx($model,'Email'); ?></dt>
			<dd>
				<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'Email'); ?>
            </dd>    
        </dl>
	</div>
    <?php 
		if($model->MemberCode){
	?>		
    <div class="row">
		<dl>
			<dt><?php echo $form->labelEx($model,'MemberCode'); ?></dt>
			<dd><?php echo $model->MemberCode; ?>
            </dd>    
        </dl>
	</div>
    <?php 
		}
    ?>
	<div class="row">
		<dl>
			<dt><?php echo $form->labelEx($model,'Status'); ?></dt>
			<dd>
				<?php echo $form->dropDownList($model,'Status',array('1'=>'Published', '0'=>'Un-Published')); ?>
				<?php echo $form->error($model,'Status'); ?>
            </dd>    
        </dl>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $previewWidth = 100; $previewHeight = 140; ?>
<div>
    <input type="hidden" id="cropID" name="cropID" value="0" />
    <input type="hidden" id="cropX" name="cropX" value="0" />
    <input type="hidden" id="cropY" name="cropY" value="0" />
    <input type="hidden" id="cropW" name="cropW" value="100" />
    <input type="hidden" id="cropH" name="cropH" value="100" />
</div>
<br /><br />
<div>
    <div id="uploadedImage" style="float: left;">
        
    </div>
	
    <div style="float: left; margin-left: 20px;">
    <h4>Preview of cropped image</h4>
    <div style="position:relative;  overflow:hidden; width:<?php echo $previewWidth;?>px; height:<?php echo $previewHeight;?>px; margin-top: 10px; margin-bottom: 10px;">
        <img id="preview" src="" style="width: 0px; height: 0px; margin-left: 0px; margin-top: 0px;">
    </div>
    </div>

</div>

<div style="clear:both;"></div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<br /><br />
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo Yii::app()->createUrl("/matrimonyMembers/uploadImg") ?>'>
	<label for="photoimg">Upload Member Photo</label>
	<input type="file" name="photoimg" id="photoimg"  />
    <input type="button" value="Cancel current crop" onclick="clearCoords();"  /> 
</form>

<script type="application/javascript">
	function updateCoords(c){
		$('#cropID').val('1');
		jQuery('#cropX').val(c.x);
		jQuery('#cropY').val(c.y);
		jQuery('#cropW').val(c.w);
		jQuery('#cropH').val(c.h);
		var rx = <?php echo $previewWidth; ?> / c.w;
		var ry = <?php echo $previewHeight; ?> / c.h;
		if ($('#preview') != undefined) {
			$('#preview').css({
				width: Math.round(rx * $('#prewImg').width() ) + 'px',
				height: Math.round(ry * $('#prewImg').height()) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			}); 
		}
	};
	
	function clearCoords(){
      $('#cropID').val('0');
	  $('#preview').css({
			width: '0px',
			height: '0px',
			marginLeft: '0px',
			marginTop: '0px'
		});
    }

var subSect = '<?php echo $model->fkSubSect; ?>';
function getSubSect(sectId){
	if(sectId!=""){
		$("#MatrimonyMembers_fkSubSect").attr("disabled",true);
		$.ajax({
			type: "POST",	
			url: '<?php echo Yii::app()->homeUrl.'/matrimonySubSect/getSubSects';?>',
			data: { sectId: sectId},
			success: function(data) {
				$("#MatrimonyMembers_fkSubSect option:not(:eq(0))").remove();
				$("#MatrimonyMembers_fkSubSect").append(data);
				$("#MatrimonyMembers_fkSubSect").val(subSect);
				$("#MatrimonyMembers_fkSubSect").attr("disabled",false);
			},
			error: function(msg){
				alert("Error:: "+msg);
				$("#MatrimonyMembers_fkSubSect").attr("disabled",false);
			}
		});
	}else{
		$("#MatrimonyMembers_fkSubSect option:not(:eq(0))").remove();
	}
}
$(document).ready(function(e) {
	var marStatus = "MatrimonyMembers[MaritalStatus]";
    $(":radio[name='"+marStatus+"']").change(function(e) {
        if($(this).val()!=1){
			$("#childs").show();
		}else{
			$("#childs").hide();
			$("#MatrimonyMembers_Childrens").val(0);
		}
    });
	
	$("#MatrimonyMembers_fkCaste").change(function(e) {
        if($(this).val()=='0'){
			$("#MatrimonyMembers_OtherCaste").show();
		}else{
			$("#MatrimonyMembers_OtherCaste").hide();
		}
    });
	
	var sect = $("#MatrimonyMembers_fkSect");
	if($.trim(subSect)!=""){
		getSubSect($.trim(sect.val()));
	}
	
	sect.change(function(e) {
		getSubSect($.trim($(this).val()));
	});
	
	$('#MatrimonyMembers_DOB')
		.datetimepicker({
			createButton:false, 
			startDate:'01/01/1900', 
			changeMonth: true, 
			changeYear: true, 
			yearRange: 'c-40:c',
			timeFormat: "hh:mm tt",
			hourGrid: 6,
			minuteGrid: 10
		});
	
	$('#photoimg').live('change', function(){ 
		$("#uploadedImage").html('');
		$("#uploadedImage").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/img/loading.gif" alt="Uploading...."/>');
		$("#imageform").ajaxForm({
			target: '#uploadedImage',
			success: function(){
				$("#preview").attr("src",$("#prewImg").attr("src"));
				$("#cropID").val(1);
				$('#uploadedImage').find("#prewImg").Jcrop({
					onChange:   updateCoords,
					onSelect:   updateCoords,
					aspectRatio: .714,
					boxWidth: 500,
					boxHeight: 500,
					bgFade: true,
					bgOpacity: .6,
					setSelect: [ 0, 0, 100, 140 ],
					onRelease:  clearCoords
				  });
			}
		}).submit();
	
	});
	
	/*$("#matrimony-members-form").submit(function(e) {
		var day = $("#dayId").val();
		var month = $("#monthId").val();
		var year = $("#yearId").val();
		if(day && month && year ){
			$("#MatrimonyMembers_DOB").val(month+"/"+day+"/"+year);
		}else{
			alert("Please select date of birth");
			return false;
		}
    });*/
	
});
</script>