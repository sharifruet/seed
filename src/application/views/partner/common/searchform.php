<div class="container">
<?php
    $attributes = array('name' => 'searchform');
    echo form_open($searchAction, $attributes);

    $hdnCnt = 0;
    foreach ($inputs as $inp) :
        if ($inp['type'] == 'hidden') {
            echo form_hidden($inp['fielddata']['name'], $inp['fielddata']['value']);
            $hdnCnt ++;
        }
    endforeach;

    $cnt = 0;

    foreach ($inputs as $inp) :
        if ($inp['type'] != 'hidden') {
            if ($cnt % 3 == 0) {
?>
	<div class="row top-buffer">
<?php 	     }?>
		<div class="col-md-1 right">
			<label> <?php echo $inp['label'];?> </label>
		</div>
		<div class="col-md-3"> 
<?php 
            if ($inp['type'] == 'textfield') {
               echo form_input($inp['fielddata']);
            } 
            elseif ($inp['type'] == 'dropdown') {
                echo form_dropdown($inp['fielddata']['name'], $inp['fielddata']['options'], $inp['fielddata']['value'], 'class="form-control"');
            } 
            else
                echo 'Type<>field map does not exist for type ' . $inp['type'];
?>
		</div>
<?php 
            if($cnt%3==2 || $cnt == count($inputs) - $hdnCnt-1){
?>
	</div>
<?php       }   
            $cnt ++;
        }
    endforeach;

?>
	<div class="row  top-buffer" id="btnsearch">
		<div class="col-md-4">
			<input type="button" class="btn btn-primary" onclick="this.form.pageNo.value=1;this.form.submit();" value="Search" />
		</div>
	</div>
	<?php echo form_close();?>
</div>