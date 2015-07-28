
    <?php if( !empty($detail['s_make']) ) { ?>
    <div class="row">
    	<div class="col-md-4">        
        <label width="200px"><?php echo @$detail['s_make']; ?></label>
    </div>
    <?php } ?>
    <?php if( !empty($detail['s_model']) ) { ?>
    <div class="col-md-4 offset">        
        <label width="100px"><?php echo @$detail['s_model']; ?></label>
 
    <?php } ?>
    <?php $locale = osc_current_user_locale(); ?>
    <?php if( !empty($detail['locale'][$locale]['s_car_type']) ) { ?>
    <div class="col-md-2">        
        <label width="100px"><?php echo @$detail['locale'][$locale]['s_car_type']; ?></label>
	</div>	
    <?php } ?>
    
