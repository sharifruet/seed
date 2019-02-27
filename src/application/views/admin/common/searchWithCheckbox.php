<?php
/*
 * This is generic search page. It uses '$searchAction', '$addmodifyAction', $searchDisplayTxt and $propertyArr
 * it calls getObjectPropertyValue($obj, $property) to get the display text from the object It will be varied based on various search page
 *
 * For custom search we need to implement by own
 *
 * Created on
 * Created by Sharif Uddin
 */
?>

<div >
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">List <?php echo ucfirst($component);?> for payble entry</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <?php $this->load->view('common/searchform.php');?>
       <?php echo form_open($saveAction);
       foreach ($inputs as $inp) :
       if ($inp['type'] == 'hidden') {
           echo form_hidden($inp['fielddata']['name'], $inp['fielddata']['value']);
       }
       endforeach;
       
      	$this->load->view('common/resultonlywithcheckbox.php');?>
      	<br/>
      	<button type="submit" class="btn btn-primary">Enter Payables</button>
      <?php echo form_close();?>
    </div>
  </div>
</div>



