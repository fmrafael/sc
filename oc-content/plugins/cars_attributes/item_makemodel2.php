
    <?php if( !empty($detail['s_make']) ) { ?>
    <div class="row">
    	<div class="col-md-4">        
        <label width="200px"><?php echo @$detail['s_make']; ?></label>
    </div>
    <?php } ?>
    <?php if( !empty($detail['s_model']) ) { ?>
    <div class="col-md-4 offset">        
        <label width="100px"><?php echo @$detail['s_model']; ?></label></div>
 
   <?php } ?>
    <?php if( !empty($detail['s_car_type']) ) { ?>
    <div class="col-md-4 offset">        
        <label width="100px"><?php echo @$detail['s_car_type']; ?></label>
	</div>
    </div>	
    <?php } ?>
    
