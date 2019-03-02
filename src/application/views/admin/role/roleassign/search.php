<?php echo form_open($searchAction);?><div id="content">

<div class="row">
	<div class="col-md-2 text-right">	<label>Select user: </label></div>
	<div class="col-md-4">
		<?php echo form_dropdown('userId',$user, $userId," class=\"form-control\" onchange=\"this.form.submit();\"");?>
	</div>
</div>
	
<div class="row">
	<div class="col-md-2 text-right">
		Select Role
	</div>		
	<div class="col-md-4">
		<ul class="list-group">
				<?php
				$cnt = 0;
				if($searchData != null && count($searchData) > 0){
					foreach ($searchData as $value ){
						$cnt++				
				?>							
				<li class="list-group-item"><input type="checkbox" id="role<?php echo $cnt;?>" <?php echo $value->assigned!=0?"checked":"";?> name="roles[]" value="<?php echo $value->componentId;?>"/> &nbsp;&nbsp;<label style="display: inline;" for="role<?php echo $cnt;?>"><?php echo $value->uniqueCode;?></label></li>				
				<?php 
					}
				}
				?>
		</ul>	
		<br/>				
		<button type="submit" class="btn btn-primary" name="assign">Assign</button>
		<button type="button" class="btn btn-warning" name="cancel">Cancel</button>
	</div>
</div>
<?php echo form_close();?>
