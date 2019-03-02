          <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <?php echo ucfirst($component)?> data list</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  	<?php foreach ($propertyArr as $prop => $value):?>
					<th><?php echo $value; ?></th>			
					<?php endforeach;?>
					<th></th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <?php foreach ($propertyArr as $prop => $value):?>
					<th><?php echo $value; ?></th>			
					<?php endforeach;?>
					<th></th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php 
                  if ($searchData != null && count($searchData) > 0): 
                  foreach ($searchData as $value):
                  ?>
                  <tr>
                  	<?php foreach ($propertyArr as $prop => $name):
        			 $displayText = $value->{$prop};
                     if(isset($typeArr[$prop]) && $typeArr[$prop]== Applicationconst::DATA_TYPE_MONEY){
                        $displayText = Applicationconst::convertWord($displayText);
                     }else if(isset($typeArr[$prop]) && $typeArr[$prop]== Applicationconst::DATA_TYPE_DATE){
                        $displayText = Applicationconst::convertDate($displayText);
                     }?>
                    <td><?php echo $displayText;?></td>
                    <?php endforeach;?>
                    <td> <a class="far fa-edit" href="<?php echo base_url($addmodifyAction.'/'.$value->componentId);?>"> </a></td>
                  </tr>
                  <?php 
                    endforeach;
                  endif;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
