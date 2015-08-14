<h2><?php _e('Car details', 'cars_attributes') ; ?></h2>
    <?php if( !empty($detail['s_make']) ) { ?>
    <div class="row col-md-9">
    	<div class="col-md-2">        
        <label width="150px"><?php echo @$detail['s_make']; ?></label>
    </div>
    <?php } ?>
    <?php if( !empty($detail['s_model']) ) { ?>
    <div class="col-md-2">        
        <label width="150px"><?php echo @$detail['s_model']; ?></label></div>
 
    <?php } ?>
 
    <?php if( !empty($detail['s_car_type']) ) { ?>
    <div class="col-md-8">        
        <label width="150px"><?php echo @$detail['s_car_type']; ?></label>
	</div>	
    <?php } ?>
    
