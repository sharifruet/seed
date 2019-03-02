
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
</script><?php
    echo form_open($component . '/save');
    $hdnCnt = 0;
    
    foreach ($inputs as $inp) :
        
        if ($inp['type'] == 'hidden') {
            
            $hdnCnt ++;
?>			<input type="hidden" name="<?php echo $inp['fielddata']['name'];?>" id="<?php echo $inp['fielddata']['id'];?>" value="<?php echo $inp['fielddata']['value'];?>"/>
<?php 
        }
    endforeach;
?>
	<br />	<div class="container">
<?php
    $cnt = 0;
    foreach ($inputs as $inp) :
        if ($inp['type'] != 'hidden') {
            if ($cnt % 3 == 0) { 
 ?>
			<div class="row top-buffer">
<?php } ?>				<div class="col-md-1 right">					<label for="<?php echo $inp['fielddata']['name'];?>"><?php echo isset($inp['label'])?$inp['label']:$inp['fielddata']['name'];?></label>				</div>				<div class="col-md-3">
<?php
            if ($inp['type'] == 'textfield') {
                    echo form_input($inp['fielddata']);
            } 
            elseif ($inp['type'] == 'dropdown') {
                 echo form_dropdown($inp['fielddata']['name'], $inp['fielddata']['options'], $inp['fielddata']['value'], 'class = "form-control"');
            }elseif ($inp['type'] == 'textarea') {                echo form_textarea($inp['fielddata']);            }
            else
                echo 'Type<>field map does not exist for type ' . $inp['type'];
            
  ?>					</div><?php if($cnt%3 == 2 || $cnt == count($inputs) - 1 - $hdnCnt ){?>			</div><?php }
      $cnt ++;
 ?><?php }?><?php endforeach;?>
<?php $this->load->view('templates/buttonbar.php');?>
</div>
<?php echo form_close();?>