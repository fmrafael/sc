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
<div class="row">
    <div class="row">
    <div class="col-sm-4" >
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
    <div class="col-sm-4">
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

    <div class="col-sm-4">
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
            </div>
        <?php } ?>
    </div>
    <div class="row">
    <div class="col-sm-4">
        <?php
            if( Session::newInstance()->_getForm('pc_year') != '' ) {
                $detail['i_year'] = Session::newInstance()->_getForm('pc_year');
            }
        ?>
        <label><?php _e('Year', 'cars_attributes'); ?></label>
        <select name="year" id="year">
        <option value=""><?php _e('Select num. of year', 'cars_attributes'); ?></option>
        <?php foreach(range(1999, 2015) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_year'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
        <?php } ?>
        </select>

    </div>

<div class="col-sm-4">
        <?php
            if( Session::newInstance()->_getForm('pc_year_fabricado') != '' ) {
                $detail['i_year_fabricado'] = Session::newInstance()->_getForm('pc_year_fabricado');
            }
        ?>
        <label><?php _e('Ano Fabricação', 'cars_attributes'); ?></label>
        <select name="year_fabricado" id="year_fabricado">
        <option value=""><?php _e('Ano de Fabricação', 'cars_attributes'); ?></option>
        <?php foreach(range(1999, 2015) as $n) { ?>
            <option value="<?php echo $n; ?>" <?php if(@$detail['i_year_fabricado'] == $n) { echo 'selected'; } ?>><?php echo $n; ?></option>
        <?php } ?>
        </select>

    </div>

    
    <div class="col-sm-4">
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
</div>
<div class="row">
    <div class="col-sm-4">
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


    <div class="col-sm-4">
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
    <div class="col-sm-4">
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
</div>

<label><?php _e('Principais opcionais e itens de série', 'cars_attributes'); ?></label>
<div class="row">
    <div class="col-sm-4">
        <label>Documentação</label>

        <?php
            if( Session::newInstance()->_getForm('pc_warranty') != '' ) {
                $detail['b_warranty'] = Session::newInstance()->_getForm('pc_warranty');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="warranty" id="warranty" value="1" <?php if(@$detail['b_warranty'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Garantia de Fábrica', 'cars_attributes'); ?></label>
        </div>
        <?php
            if( Session::newInstance()->_getForm('pc_ipva') != '' ) {
                $detail['b_ipva'] = Session::newInstance()->_getForm('pc_ipva');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="ipva" id="ipva" value="1" <?php if(@$detail['b_ipva'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('IPVA', 'cars_attributes'); ?></label>
    </div>


        <?php
            if( Session::newInstance()->_getForm('pc_licenciado') != '' ) {
                $detail['b_licenciado'] = Session::newInstance()->_getForm('pc_licenciado');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="licenciado" id="licenciado" value="1" <?php if(@$detail['b_licenciado'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Licenciado', 'cars_attributes'); ?></label>
</div>
       <?php
            if( Session::newInstance()->_getForm('pc_garantia_fabrica') != '' ) {
                $detail['b_garantia_fabrica'] = Session::newInstance()->_getForm('pc_garantia_fabrica');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="garantia_fabrica" id="garantia_fabrica" value="1" <?php if(@$detail['b_garantia_fabrica'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Adaptado Deficiente', 'cars_attributes'); ?></label>
</div>
        <?php
            if( Session::newInstance()->_getForm('pc_blindado') != '' ) {
                $detail['b_blindado'] = Session::newInstance()->_getForm('pc_blindado');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="blindado" id="blindado" value="1" <?php if(@$detail['b_blindado'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('blindado', 'cars_attributes'); ?></label>
</div>
        <?php
            if( Session::newInstance()->_getForm('pc_new') != '' ) {
                $detail['b_new'] = Session::newInstance()->_getForm('pc_new');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="new" id="new" value="1" <?php if(@$detail['b_new'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Único Dono', 'cars_attributes'); ?></label>
        </div>

        </div>

<div class="col-sm-4">
        <label>Conforto</label>

<?php
            if( Session::newInstance()->_getForm('pc_ar_condicionado') != '' ) {
                $detail['b_ar_condicionado'] = Session::newInstance()->_getForm('pc_ar_condicionado');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="ar_condicionado" id="ar_condicionado" value="1" <?php if(@$detail['b_ar_condicionado'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Ar Condicionado', 'cars_attributes'); ?></label>
</div>

<?php
            if( Session::newInstance()->_getForm('pc_teto_solar') != '' ) {
                $detail['b_teto_solar'] = Session::newInstance()->_getForm('pc_teto_solar');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="teto_solar" id="teto_solar" value="1" <?php if(@$detail['b_teto_solar'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Teto Solar', 'cars_attributes'); ?></label>
</div>

<?php
            if( Session::newInstance()->_getForm('pc_direcao_hidraulica') != '' ) {
                $detail['b_direcao_hidraulica'] = Session::newInstance()->_getForm('pc_direcao_hidraulica');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="direcao_hidraulica" id="direcao_hidraulica" value="1" <?php if(@$detail['b_direcao_hidraulica'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Direção Hidráulica', 'cars_attributes'); ?></label>
</div>

<?php
            if( Session::newInstance()->_getForm('pc_trio_eletrico') != '' ) {
                $detail['b_trio_eletrico'] = Session::newInstance()->_getForm('pc_trio_eletrico');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="trio_eletrico" id="trio_eletrico" value="1" <?php if(@$detail['b_trio_eletrico'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Trio Elétrico', 'cars_attributes'); ?></label>
</div>

<?php
            if( Session::newInstance()->_getForm('pc_bancos_couro') != '' ) {
                $detail['b_bancos_couro'] = Session::newInstance()->_getForm('pc_bancos_couro');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="bancos_couro" id="bancos_couro" value="1" <?php if(@$detail['b_bancos_couro'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Bancos de Couro', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_insulfilm') != '' ) {
                $detail['b_insulfilm'] = Session::newInstance()->_getForm('pc_insulfilm');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="insulfilm" id="insulfilm" value="1" <?php if(@$detail['b_insulfilm'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Insulfilm', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_roda_liga') != '' ) {
                $detail['b_roda_liga'] = Session::newInstance()->_getForm('pc_roda_liga');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="roda_liga" id="roda_liga" value="1" <?php if(@$detail['b_roda_liga'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Roda de Liga Leve', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_piloto') != '' ) {
                $detail['b_piloto'] = Session::newInstance()->_getForm('pc_piloto');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="piloto" id="piloto" value="1" <?php if(@$detail['b_piloto'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Piloto Automático', 'cars_attributes'); ?></label>
</div>

        </div>

<div class="col-sm-4">
        <label>Segurança e Multimídia</label>
<?php
            if( Session::newInstance()->_getForm('pc_airbag') != '' ) {
                $detail['b_airbag'] = Session::newInstance()->_getForm('pc_airbag');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="airbag" id="airbag" value="1" <?php if(@$detail['b_airbag'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Airbag', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_freios_abs') != '' ) {
                $detail['b_freios_abs'] = Session::newInstance()->_getForm('pc_freios_abs');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="freios_abs" id="freios_abs" value="1" <?php if(@$detail['b_freios_abs'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Freios ABS', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_controle_tracao') != '' ) {
                $detail['b_controle_tracao'] = Session::newInstance()->_getForm('pc_controle_tracao');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="controle_tracao" id="controle_tracao" value="1" <?php if(@$detail['b_controle_tracao'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Controle de tração', 'cars_attributes'); ?></label>
</div>



<?php
            if( Session::newInstance()->_getForm('pc_quatro') != '' ) {
                $detail['b_quatro'] = Session::newInstance()->_getForm('pc_quatro');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="quatro" id="quatro" value="1" <?php if(@$detail['b_quatro'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('4x4', 'cars_attributes'); ?></label>
</div>



<?php
            if( Session::newInstance()->_getForm('pc_computador_bordo') != '' ) {
                $detail['b_computador_bordo'] = Session::newInstance()->_getForm('pc_computador_bordo');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="computador_bordo" id="commputador_bordo" value="1" <?php if(@$detail['b_computador_bordo'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Computador Bordo', 'cars_attributes'); ?></label>
</div>



<?php
            if( Session::newInstance()->_getForm('pc_bluetooth') != '' ) {
                $detail['b_bluetooth'] = Session::newInstance()->_getForm('pc_bluetooth');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="bluetooth" id="bluetooth" value="1" <?php if(@$detail['b_bluetooth'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('bluetooth', 'cars_attributes'); ?></label>
</div>



<?php
            if( Session::newInstance()->_getForm('pc_entrada_mp3') != '' ) {
                $detail['b_entrada_mp3'] = Session::newInstance()->_getForm('pc_entrada_mp3');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="entrada_mp3" id="entrada_mp3" value="1" <?php if(@$detail['b_entrada_mp3'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('Entrada MP3', 'cars_attributes'); ?></label>
</div>


<?php
            if( Session::newInstance()->_getForm('pc_gps') != '' ) {
                $detail['b_gps'] = Session::newInstance()->_getForm('pc_gps');
            }
        ?>
        <div class="checkbox">
        <input type="checkbox" name="gps" id="gps" value="1" <?php if(@$detail['b_gps'] == 1) { echo 'checked="yes"'; } ?> /> <label><?php _e('GPS', 'cars_attributes'); ?></label>
</div>


</div>



    </div>

<script type="text/javascript">
    tabberAutomatic();
</script>
