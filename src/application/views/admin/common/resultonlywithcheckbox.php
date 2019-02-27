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
    
    $paginationRow .= '<a href="#" onclick="document.searchform.pageNo.value=1;document.searchform.submit();">First</a>&nbsp;';
    
    $paginationRow .= '<a href="#" onclick="document.searchform.pageNo.value=document.searchform.pageNo.value-1;document.searchform.submit();">Prev</a>&nbsp;';
}

$paginationRow .= '&nbsp;&nbsp;<b>' . $from . '-' . $to . '</b> of <b>' . $total . '</b>&nbsp;&nbsp;';

if ($pageNo < $lastPage) 
{
    
    $paginationRow .= '<a href="#" onclick="document.searchform.pageNo.value=document.searchform.pageNo.value-(-1);document.searchform.submit();">Next</a>&nbsp;';
    
    $paginationRow .= '<a href="#" onclick="document.searchform.pageNo.value=' . $lastPage . ';document.searchform.submit();">Last</a>&nbsp;';
}

?>


			<label><?php echo $paginationRow;?></label>
		</div>
	</div>
	<table>
<?php
$columHeaderRow = '<tr> <th><input type="checkbox" id="checkAll"/></th>';
foreach ($propertyArr as $prop => $value) {
    $columHeaderRow .= '<th>' . $value . '</th>';
}

$columHeaderRow .= '</tr>';

echo $columHeaderRow;

/**
 * ************End Column Header Row **********
 */

if ($arr != null && count($arr) > 0) {
    foreach ($arr as $value) {
        
        $modifylnk = '<a href="' . base_url($addmodifyAction) . '/' . $value->componentId . '">';
        $chkStr = '&nbsp;';
        if($value->isCheckable < 1)
            $chkStr = '<input type="checkbox" class="indv-checkbox" value="'.$value->componentId.'" name="selectedIds[]"/>';
		$dataRow = '<tr style="background-color:white;"><td>&nbsp;'.$chkStr.'</td>';
        
        foreach ($propertyArr as $prop => $name) 
        {
            
            $displayText = $value->{$prop};
            $dataRow .= '<td><b>' . $modifylnk . Applicationconst::checkAndConv($displayText) . '</b></a></td>';
        }
        
        $dataRow .= '</tr>';
        
        echo $dataRow;
    }
}

?>
</table>
</div>

<script type="text/javascript">
	$("#checkAll").click(function(){
		$(".indv-checkbox").prop('checked', $(this).is(':checked'));
		
	});

</script>