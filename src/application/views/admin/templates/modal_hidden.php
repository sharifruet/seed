<!-----------HIDDEN MODAL FORM - COMMON IN ALL PAGES ------>
	document.getElementById('modal-body').innerHTML = 
		'<iframe id="frame1" src="<?php echo base_url();?>index.php?modal/popup/'+param1+'/'+param2+'/'+param3+'" width="100%" height="400" frameborder="0"></iframe>';
}
function modal_delete(param1){
	document.getElementById('delete_link').href = param1;
}

</script>