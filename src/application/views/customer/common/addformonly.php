
<script type="text/javascript">
function prepareAction(formObj, action){
	if(formObj==null){
		alert('Undefined form');
		return;
	}
	if('delete' == action.toLowerCase()){
		if( confirm("Are you sure?")){
			formObj.action = '<?php echo base_url('index.php/'.$component.'/delete');?>';
		}else{
			return;
		}
	}else if('update' == action.toLowerCase()){
		formObj.action = '<?php echo base_url('index.php/'.$component.'/save');?>';
	}else  if('save' == action.toLowerCase()){
		formObj.action = '<?php echo base_url('index.php/'.$component.'/save');?>';
	}else  if('cancel' == action.toLowerCase()){
		formObj.action = '<?php echo base_url('index.php/'.$component.'/search');?>';
	}else{
		alert('Invalid action');
		return;
	}
	formObj.submit();
}
</script>
    echo form_open($component . '/save');
    $hdnCnt = 0;
    
    foreach ($inputs as $inp) :
        
        if ($inp['type'] == 'hidden') {
            
            $hdnCnt ++;
?>
<?php 
        }
    endforeach;
?>
	<br />
<?php
    $cnt = 0;
    foreach ($inputs as $inp) :
        if ($inp['type'] != 'hidden') {
            if ($cnt % 3 == 0) { 
 ?>
			<div class="row top-buffer">
<?php } ?>
<?php
            if ($inp['type'] == 'textfield') {
                    echo form_input($inp['fielddata']);
            } 
            elseif ($inp['type'] == 'dropdown') {
                 echo form_dropdown($inp['fielddata']['name'], $inp['fielddata']['options'], $inp['fielddata']['value'], 'class = "form-control"');
            }elseif ($inp['type'] == 'textarea') {
            else
                echo 'Type<>field map does not exist for type ' . $inp['type'];
            
  ?>
      $cnt ++;
 ?>

</div>
<?php echo form_close();?>