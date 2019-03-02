<div class="container" style="min-height: 400px;"><?php if($summery){?>	<div class="row">		<div class="col-lg-4 col-sm-12 col-md-6 text-center">			<div style="border: 1px solid blue;color:blue;">				<h2>Cash</h2><hr/>				<h3><?php echo Applicationconst::convertWord($cashToday);?> <small> [Today] </small></h3>				<h3><?php echo Applicationconst::convertWord($cash);?> <small> [All] </small></h3>							</div>		</div>		<div class="col-lg-4 col-sm-12 col-md-6 text-center">			<div style="border: 1px solid red;color:red;">				<h2>Expense</h2><hr/>				<h3><?php echo Applicationconst::convertWord($expenseToday);?> <small> [Today] </small></h3>				<h3><?php echo Applicationconst::convertWord($expense);?> <small> [All] </small></h3>							</div>		</div>				<div class="col-lg-4 col-sm-12 col-md-6 text-center">			<div style="border: 1px solid green;color: green;">				<h2>Income</h2><hr/>				<h3><?php echo Applicationconst::convertWord($revenueToday);?> <small> [Today] </small></h3>				<h3><?php echo Applicationconst::convertWord($revenue);?> <small> [All] </small></h3>							</div>		</div> 	</div>		<br/>	<br/><br/><hr/><?php } if($links){?>
    <div class="row">
    <?php
    foreach ( $menu as $k => $m ) :
    ?>
    	<div class="col-lg-2 col-md-4 col-sm-6">
    		<b><?php echo $k;?></b>
    			<?php 
    			foreach ($m as $r):
    				if($r->isMenu == 1){?>
    			<div class="row">	
    				<div class="col-md-12">	
    					<a href="<?php echo base_url();?>index.php/<?php echo $r->actionUrl;?>">
    						<i class="icon-lock"></i><span><?php echo $r->displayName;?></span>
    					</a>
    				</div> 
    			</div>
    			<?php }
    			endforeach;?>
    	</div>
    <?php endforeach;?>
    </div>        <?php }?></div>