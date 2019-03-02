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


<style><!--input {	max-width: 200px;}--></style>
<div class="box top-buffer">
	<div class="box-header">
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
				<a href="#list" data-toggle="tab"><i	class="icon-align-justify"></i> <?php echo ucfirst($component).' List';?></a>
			</li>
			<li>
				<a onMouseOver="this.style.color='#000'" onMouseOut="this.style.color='#999'" style="float: left; color: #999" href="<?php echo base_url($addmodifyAction);?>"><i class="icon-plus"></i>&nbsp;<?php echo 'Add '.ucfirst($component);?></a>
			</li>
		</ul>
		<!-- CONTROL TABS END -->
	</div>
	<div class="box-content padded">
		<div class="tab-content">
			<!-- TABLE LISTING STARTS -->
			<div class="tab-pane box active" id="list">
				<div class="container">
			<?php

$attributes = array(
    'name' => 'searchform'
);

echo form_open($searchAction, $attributes);

$hdnCnt = 0;
foreach ($inputs as $inp) :
    if ($inp['type'] == 'hidden') {
        echo form_hidden($inp['fielddata']['name'], $inp['fielddata']['value']);
        $hdnCnt ++;
    }
endforeach
;

$cnt = 0;

foreach ($inputs as $inp) :
    if ($inp['type'] != 'hidden') {
        if ($cnt % 3 == 0) {
            ?>
				<div class="row top-buffer">
<?php 	}?>
						<div class="col-md-1 right">
							<label> <?php echo $inp['label'];?> </label>
						</div>
						<div class="col-md-3"> 
<?php
           
           if ($inp['type'] == 'textfield') {
              // $inp['fielddata']['class'] = "form-control";
               echo form_input($inp['fielddata']);
        } 
        elseif ($inp['type'] == 'dropdown') {
            echo form_dropdown($inp['fielddata']['name'], $inp['fielddata']['options'], $inp['fielddata']['value'], 'class="form-control"');
        } 
        else
            echo 'Type<>field map does not exist for type ' . $inp['type'];
        ?>
						</div>
				<?php if($cnt%3==2 || $cnt == count($inputs) - $hdnCnt-1){?>
				</div>
				<?php }?>
			<?php
        $cnt ++;
    }
endforeach
;

?>
			<div class="row  top-buffer" id="btnsearch">
						<div class="col-md-4">
							<input type="button" class="btn btn-default" onclick="this.form.pageNo.value=1;this.form.submit();" value="Search">
						</div>
					</div>
			<?php echo form_close();?>
			</div>
<?php

$searchText = '';

$resultCount = 0;

$arr = $searchData;

$lastPage = 1;

if ($arr != null) 
{
    
    $resultCount = count($arr);
}

$from = ($pageNo - 1) * $limit + 1;

$to = $pageNo * $limit;

if ($resultCount < $limit) 
{
    
    $to = $to - ($limit - $resultCount);
}

$lastPage = (int) $total / $limit;

$nextUrl = $searchAction . '?search=' . $searchText . '&pageNo=' . ($pageNo + 1);

$prevUrl = $searchAction . '?search=' . $searchText . '&pageNo=' . ($pageNo - 1);

$colCount = count($propertyArr);

?>

<div id="search_result">


					<div class="row">


						<div class="col-md-12" style="text-align: right;">
		<?php

$paginationRow = '';

if ($pageNo > 1) 
{
?>
    	<button class="btn btn-default"  onclick="document.searchform.pageNo.value=1;document.searchform.submit();"> <span class="glyphicon glyphicon-step-backward"></span> </button>
    	<button class="btn btn-default"  onclick="document.searchform.pageNo.value=document.searchform.pageNo.value-1;document.searchform.submit();"> <span class="glyphicon glyphicon-chevron-left"></span>  </button>
<?php  
}
?>
<span><b><?php echo $from;?> - <?php echo $to;?></b> of <?php echo $total;?></span>
<?php 
if ($pageNo < $lastPage) 
{
?>
    <button class="btn btn-default"  onclick="document.searchform.pageNo.value=document.searchform.pageNo.value-(-1);document.searchform.submit();"> <span class="glyphicon glyphicon-chevron-right"></span> </button>
    <button class="btn btn-default"  onclick="document.searchform.pageNo.value=<?php echo $lastPage;?>;document.searchform.submit();"> <span class="glyphicon glyphicon-step-forward"></span> </button>
    	
<?php
}
?>
			<label><?php echo $paginationRow;?></label>


						</div>


					</div>

					<table class="table table-hover">

<?php


$columHeaderRow = '<tr>';

foreach ($propertyArr as $prop => $value) 
{
    
    $columHeaderRow .= '<th>' . $value . '</th>';
}

$columHeaderRow .= '</tr>';

echo $columHeaderRow;

/**
 * ************End Column Header Row **********
 */

if ($arr != null && count($arr) > 0) 
{
    
    foreach ($arr as $value) 
    {
        
        $modifylnk = '<a href="' . base_url($addmodifyAction) . '/' . $value->componentId . '">';
        
        $dataRow = '<tr>';
        
        foreach ($propertyArr as $prop => $name) 
        {
            
            $displayText = $value->{$prop};
            if(isset($typeArr[$prop]) && $typeArr[$prop]== Applicationconst::DATA_TYPE_MONEY){
                $dataRow .='<td style="text-align:right;">' . $modifylnk . Applicationconst::convertWord($displayText) . '</a></td>';
            }else if(isset($typeArr[$prop]) && $typeArr[$prop]== Applicationconst::DATA_TYPE_DATE){
            	$dataRow .='<td style="text-align:right;">' . $modifylnk . Applicationconst::convertDate($displayText) . '</a></td>';
            }else{
                $dataRow .= '<td style="text-align:left;">' . $modifylnk .$displayText . '</a></td>';
            }
        }
        
        $dataRow .= '</tr>';
        
        echo $dataRow;
    }
}

?>

	

</table>





					<div class="row top-buffer">


						<div class="col-md-4">


							<input type="button" class="btn btn-default"
								value="Print search Result" onclick="printDiv('search_result');" />


						</div>





					</div>





				</div>











			</div>





			<!----TABLE LISTING ENDS--->





			<!----CREATION FORM STARTS---->





			<div class="tab-pane box" id="add" style="padding: 5px">





				<div class="box-content">





					&nbsp;&nbsp;&nbsp; <a style="color: #0000FF"
						href="<?php echo base_url($addmodifyAction);?>"><?php echo 'Add New';?></a>


				</div>





			</div>





			<!-- CREATION FORM ENDS -->





		</div>





	</div>











</div>


<hr />








<iframe name="print_frame" width="0" height="0" frameborder="0"
	src="about:blank"></iframe>











<script type="text/javascript">

<!--

printDivCSS = new String ('<link href="myprintstyle.css" rel="stylesheet" type="text/css">')

            function printDiv(divId) {

                window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML;

                window.frames["print_frame"].window.focus();

                window.frames["print_frame"].window.print();

            }
//-->

</script>





