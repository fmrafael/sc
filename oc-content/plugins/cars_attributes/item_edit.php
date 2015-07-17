<script type="text/javascript">
    $(document).ready(function(){
        $("#make").change(function(){
            var make_id = $(this).val();
            var url = '<?php echo osc_ajax_plugin_url('cars_attributes/ajax.php') . '&makeId='; ?>' + make_id;
            var result = '';
            if(make_id != '') {
                $("#model").attr('disabled',false);
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    success: function(data){
                        var length = data.length;
                        if(length > 0) {
                            result += '<option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>';
                            for(key in data) {
                                result += '<option value="' + data[key].pk_i_id + '">' + data[key].s_name + '</option>';
                            }
                        } else {
                            result += '<option value=""><?php _e('No results', 'cars_attributes'); ?></option>';
                        }
                        $("#model").html(result);
                    }
                 });
             } else {
                result += '<option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>';
                $("#model").attr('disabled',true);
                $("#model").html(result);
             }
        });
    });
</script>
<h2><?php _e('Car details', 'cars_attributes') ; ?></h2>
<div>
    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_make') != '' ) {
                $detail['fk_i_make_id'] = Session::newInstance()->_getForm('pc_make');
            }
        ?>
        <label><?php _e('Make', 'cars_attributes'); ?></label>
        <select name="make" id="make" >
            <option value=""><?php _e('Select a make', 'cars_attributes'); ?></option>
            <?php foreach($makes as $a){ ?>
            <option value="<?php echo $a['pk_i_id']; ?>" <?php if(@$detail['fk_i_make_id'] == $a['pk_i_id']) { echo 'selected'; } ?>><?php echo $a['s_name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_model') != '' ) {
                $detail['fk_i_model_id'] = Session::newInstance()->_getForm('pc_model');
            }
        ?>
        <label><?php _e('Model', 'cars_attributes'); ?></label>
        <select name="model" id="model">
            <option value="" selected><?php _e('Select a model', 'cars_attributes'); ?></option>
            <?php foreach($models as $a) { ?>
            <option value="<?php echo $a['pk_i_id']; ?>" <?php if(@$detail['fk_i_model_id'] == $a['pk_i_id']) { echo 'selected'; } ?>><?php echo $a['s_name']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row _200">
        <?php $locales = osc_get_locales();
        if( Session::newInstance()->_getForm('pc_car_type') != '' ) {
            $detail['fk_vehicle_type_id'] = Session::newInstance()->_getForm('pc_car_type');
        }
        if(count($locales)==1) {
            $locale = $locales[0]; ?>
            <p>
                <label><?php _e('Car type', 'cars_attributes'); ?></label>
                <select name="car_type" id="car_type">
                    <option value="" selected><?php _e('Select a car type', 'cars_attributes'); ?></option>
                    <?php foreach($car_types[$locale['pk_c_code']] as $k => $v) { ?>
                    <option value="<?php echo  $k; ?>" <?php if(@$detail['fk_vehicle_type_id'] == $k) { echo 'selected'; } ?>><?php echo @$v; ?></option>
                    <?php } ?>
                </select>
            </p>
        <?php } else { ?>
            <div class="tabber">
            <?php foreach($locales as $locale) {?>
                <div class="tabbertab">
                    <h2><?php echo $locale['s_name']; ?></h2>
                    <p>
                        <label><?php _e('Car type', 'cars_attributes'); ?></label>
                        <select name="car_type" id="car_type">
                            <option value="" selected><?php _e('Select a car type', 'cars_attributes'); ?></option>
                            <?php foreach($car_types[$locale['pk_c_code']] as $k => $v) { ?>
                            <option value="<?php echo  $k; ?>" <?php if(@$detail['fk_vehicle_type_id'] == $k) { echo 'selected'; } ?>><?php echo @$v; ?></option>
                            <?php } ?>
                        </select>
                    </p>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_year') != '' ) {
                $detail['i_year'] = Session::newInstance()->_getForm('pc_year');
            }
        ?>
        <label><?php _e('Year', 'cars_attributes'); ?></label>
        <select name="doors" id="doors">
        <option value=""><?php _e('Select num. of year', 'cars_attributes'); ?></option>
        <?php foreach(range(1999, 2015) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_doors'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
        <?php } ?>
        </select>

    </div>
    
    <div class="row auto">
        <?php
            if( Session::newInstance()->_getForm('pc_seats') != '' ) {
                $detail['i_seats'] = Session::newInstance()->_getForm('pc_seats');
            }
        ?>
        <label><?php _e('Seats', 'cars_attributes'); ?></label>
        <select name="seats" id="seats">
		<option value=""><?php _e('Select num. of seats', 'cars_attributes'); ?></option>
            <?php foreach(range(0, 9) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_seats'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_transmission') != '' ) {
                $detail['e_transmission'] = Session::newInstance()->_getForm('pc_transmission');
            }
        ?>
        <label><?php _e('Transmission', 'cars_attributes'); ?></label>
        <select name="transmission" id="transmission">
            <option value="MANUAL" <?php if(@$detail['e_transmission'] == 'MANUAL') { echo 'selected'; } ?>><?php _e('Manual', 'cars_attributes'); ?></option>
            <option value="AUTO" <?php if(@$detail['e_transmission'] == 'AUTO') { echo 'selected'; } ?>><?php _e('Auto', 'cars_attributes'); ?></option>
        </select>
    </div>
    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_fuel') != '' ) {
                $detail['e_fuel'] = Session::newInstance()->_getForm('pc_fuel');
            }
        ?>
        <label><?php _e('Fuel', 'cars_attributes'); ?></label>
        <select name="fuel" id="fuel">
            <option value="DIESEL" <?php if(@$detail['e_fuel'] == 'DIESEL') { echo 'selected'; } ?>><?php _e('Diesel', 'cars_attributes'); ?></option>
            <option value="GASOLINE" <?php if(@$detail['e_fuel'] == 'GASOLINE') { echo 'selected'; } ?>><?php _e('Gasoline', 'cars_attributes'); ?></option>
            <option value="ELECTRIC-HIBRID" <?php if(@$detail['e_fuel'] == 'ELECTRIC-HIBRID') { echo 'selected'; } ?>><?php _e('Electric-hibrid', 'cars_attributes'); ?></option>
            <option value="OTHER" <?php if(@$detail['e_fuel'] == 'OTHER') { echo 'selected'; } ?>><?php _e('Other', 'cars_attributes'); ?></option>
        </select>
    </div>
    <div class="row _200">
        <?php
            if( Session::newInstance()->_getForm('pc_seller') != '' ) {
                $detail['e_seller'] = Session::newInstance()->_getForm('pc_seller');
            }
        ?>
        <label><?php _e('Seller', 'cars_attributes'); ?></label>
        <select name="seller" id="seller">
            <option value="DEALER" <?php if(@$detail['e_seller'] == 'DEALER') { echo 'selected'; } ?>><?php _e('Dealer', 'cars_attributes'); ?></option>
            <option value="OWNER" <?php if(@$detail['e_seller'] == 'OWNER') { echo 'selected'; } ?>><?php _e('Owner', 'cars_attributes'); ?></option>
        </select>
    </div>
    <label><?php _e('Opcionais', 'cars_attributes'); ?></label>
    <div class="row _20">
        <?php
            if( Session::newInstance()->_getForm('pc_warranty') != '' ) {
                $detail['b_warranty'] = Session::newInstance()->_getForm('pc_warranty');
            }
        ?>
        <input type="checkbox" name="warranty" id="warranty" value="1" <?php if(@$detail['b_warranty'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Warranty', 'cars_attributes'); ?></label>
        <?php
            if( Session::newInstance()->_getForm('pc_ipva') != '' ) {
                $detail['b_ipva'] = Session::newInstance()->_getForm('pc_ipva');
            }
        ?>
        <input type="checkbox" name="ipva" id="ipva" value="1" <?php if(@$detail['b_ipva'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('IPVA', 'cars_attributes'); ?></label>
    

        <?php
            if( Session::newInstance()->_getForm('pc_licenciado') != '' ) {
                $detail['b_licenciado'] = Session::newInstance()->_getForm('pc_licenciado');
            }
        ?>
        <input type="checkbox" name="licenciado" id="licenciado" value="1" <?php if(@$detail['b_licenciado'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Licenciado', 'cars_attributes'); ?></label>

       <?php
            if( Session::newInstance()->_getForm('pc_garantia_fabrica') != '' ) {
                $detail['b_garantia_fabrica'] = Session::newInstance()->_getForm('pc_garantia_fabrica');
            }
        ?>
        <input type="checkbox" name="garantia_fabrica" id="garantia_fabrica" value="1" <?php if(@$detail['b_garantia_fabrica'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Garantia de Fábrica', 'cars_attributes'); ?></label>

        <?php
            if( Session::newInstance()->_getForm('pc_blindado') != '' ) {
                $detail['b_blindado'] = Session::newInstance()->_getForm('pc_blindado');
            }
        ?>
        <input type="checkbox" name="blindado" id="blindado" value="1" <?php if(@$detail['b_blindado'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('blindado', 'cars_attributes'); ?></label>



        <?php
            if( Session::newInstance()->_getForm('pc_new') != '' ) {
                $detail['b_new'] = Session::newInstance()->_getForm('pc_new');
            }
        ?>
        <input type="checkbox" name="new" id="new" value="1" <?php if(@$detail['b_new'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('New', 'cars_attributes'); ?></label>
    </div>
   
   
</div>
<script type="text/javascript">
    tabberAutomatic();
</script>
