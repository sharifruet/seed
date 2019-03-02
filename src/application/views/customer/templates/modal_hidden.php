
<!-----------HIDDEN MODAL FORM - COMMON IN ALL PAGES ------>
<div id="modal-form" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div id="modal-tablesLabel" style="color:#fff; font-size:16px;">&nbsp; </div>
	</div>
    <div class="modal-body" id="modal-body">loading data..</div>
    <div class="modal-footer">
        <button class="btn btn-gray" onclick="custom_print('frame1')">Print</button>
        <button class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>
<!-----------HIDDEN MODAL DELETE CONFIRMATION - COMMON IN ALL PAGES ------>
<div id="modal-delete" class="modal hide fade" style="height:140px;">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h6 id="modal-tablesLabel"> <i class="icon-info-sign" style="color:#fff;"></i></h6>
	</div>
    <div class="modal-delete-body" id="modal-body-delete">Delete data ?</div>
    <div class="modal-footer">
    	<a href="" id="delete_link" class="btn btn-red" >Confirm</a>
        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
    </div>
</div>
	<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="itemHistoryModalLabel" aria-hidden="true">		<div class="modal-dialog" role="document">					<div class="modal-content">				<div class="modal-header">                	<button type="button" class="close" data-dismiss="modal">&times;</button>                	<h4 class="modal-title">Please Confirm</h4>            	</div>				<div class="modal-body">					<h4>Are you sure you want to delete this item?</h4>				</div>				<div class="modal-footer">					<form id="confirm-modal-form" method="post" action="">											<button type="button" class="btn btn-secondary" data-dismiss="modal"> Cancel </button>						<button type="submit" class="btn btn-primary" > Confirm </button>					</form>				</div>			</div>					</div>	</div>	<script type="text/javascript">    	$('.delBtn').on('click',function(event){        	$("#confirm-modal-form").attr('action', event.target.getAttribute('data-action'));    		$('#confirmationModal').modal({show:true});    	});
function modal(param1 ,param2 ,param3)
{
	document.getElementById('modal-body').innerHTML = 
		'<iframe id="frame1" src="<?php echo base_url();?>index.php?modal/popup/'+param1+'/'+param2+'/'+param3+'" width="100%" height="400" frameborder="0"></iframe>';

	document.getElementById('modal-tablesLabel').innerHTML = param1.replace("_"," ");
}

function modal_delete(param1)
{
	document.getElementById('delete_link').href = param1;
}

/////////////PRINT A DIV FUNCTION////////////////

function custom_print(div_id)
{
	var mywindow = window.open('', 'my div', 'height=400,width=600');
	mywindow.document.write(document.getElementById(div_id).contentWindow.document.body.innerHTML);
	mywindow.print();
	mywindow.close();
	return true;
}

</script>
