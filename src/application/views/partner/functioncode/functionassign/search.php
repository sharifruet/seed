<?php

/*
 * This is generic search page. It uses '$searchAction', '$addmodifyAction', $searchDisplayTxt and $propertyArr
 * it calls getObjectPropertyValue($obj, $property) to get the display text from the object It will be varied based on various search page
 * For custom search we need to implement by own
 *
 * @author Sharif Uddin
 * @since March 16, 2016
 */
?><style></style><?php echo form_open($searchAction);?>

<div class="container">	<div class="row">
		<div class="col-md-2 col-sm-12 text-right">
			<label>Select role </label>
		</div>
		<div class="col-md-3 col-sm-12">
			<?php echo form_dropdown('roleId',$role, $roleId," class=\"form-control\" onchange=\"this.form.submit();\"");?>
			<br/>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">        	<div class="box">        		<div class="box-header">            		<!------CONTROL TABS START------->            		<ul class="nav nav-tabs nav-tabs-left">            			<li class="active"><a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> <?php echo ucfirst($component).' List';?>2</a></li>            		</ul>            		<!------CONTROL TABS END------->            	</div>        		<div class="box-content padded">        			<div class="tab-content">        			<!----TABLE LISTING STARTS--->        				<div class="tab-pane box active" id="list">        					<div id="search_result">        						<ul class="list-group">
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
        					</div>        				</div>        			</div>        		</div>
        	</div>
    	</div>
    </div></div>
<?php echo form_close();?>
