    			<?php include 'footer.php';?>				</div>			</div>		<?php include 'includes_bottom.php';?>
 		<?php include 'modal_hidden.php';?>		<iframe name="printframe" width="0" height="0" frameborder="0" src="about:blank"></iframe>		<script type="text/javascript">
	  		printDivCSS = new String ("<link rel=\"stylesheet\" href=\"<?php echo base_url();?>assets/css/printstyle.css\" type=\"text/css\"/>");
	            function printIt(divId) {	            	$('body', window.frames['printframe'].document).html(document.getElementById(divId).innerHTML);	            	$('head', window.frames['printframe'].document).append(printDivCSS);					//console.log(window.frames["printframe"].document.body.innerHTML);
	                window.frames["printframe"].window.focus();
	                window.frames["printframe"].window.print();
	            }	            JsBarcode(".barcode").init();
	 	</script>	</body></html>