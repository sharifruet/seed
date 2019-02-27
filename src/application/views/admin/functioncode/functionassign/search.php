<?php

/*
 * This is generic search page. It uses '$searchAction', '$addmodifyAction', $searchDisplayTxt and $propertyArr
 * it calls getObjectPropertyValue($obj, $property) to get the display text from the object It will be varied based on various search page
 * For custom search we need to implement by own
 *
 * @author Sharif Uddin
 * @since March 16, 2016
 */
?>

<div class="container">
		<div class="col-md-2 col-sm-12 text-right">
			<label>Select role </label>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php echo form_dropdown('roleId',$role, $roleId," class=\"form-control\" onchange=\"this.form.submit();\"");?>
			<br/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
                				<?php
                                $cnt = 0;
                    
                                if ($searchData != null && count($searchData) > 0) {
                                    foreach ($searchData as $value) {
                                        $cnt ++;
                                ?>							
                        				<li class="list-group-item">
                        					<input type="checkbox" id="function<?php echo $cnt;?>" <?php echo $value->assigned !=0 ?"checked":"";?> name="functions[]" value="<?php echo $value->componentId;?>" /> &nbsp;&nbsp;
                        					<label style="display: inline;" for="function<?php echo $cnt;?>"><?php echo $value->displayName;?></label>
                        				</li>				
                            	<?php
                                        }
                                    }
                                 ?>
        						</ul>			
        						<button type="submit" class="btn btn-primary" name="assign" value="assign">Assign</button>		
        					</div>
        	</div>
    	</div>
    </div>
<?php echo form_close();?>