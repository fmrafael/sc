<div class="row">
    <div class="col-md-6">
<h2><?php _e('Car details', 'cars_attributes') ; ?></h2></div>
  <div class="col-md-6">
    <h2 class="text-left"><?php _e('Principais opcionais e itens de série', 'cars_attributes') ; ?></h2>
</div>

<div class="row">
    <div class="col-md-4">
<table style="margin-left: 20px;">
    <?php if( !empty($detail['s_make']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Make', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo @$detail['s_make']; ?></td>
    </tr>
    <?php } ?>
    <?php if( !empty($detail['s_model']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Model', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo @$detail['s_model']; ?></td>   
    </tr>
    <?php } ?>
   
    <?php if( !empty($detail['fk_i_vehicle_type_id']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Car type', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo @$detail['s_car_type']; ?></td>
    </tr>
    <?php } ?>
    <?php if( !empty($detail['i_year']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Ano do Modelo', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo $detail['i_year']; ?></td>
    </tr>
    <?php } ?>
    <?php if( !empty($detail['i_year_fabricado']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Ano Fabricação', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo $detail['i_year_fabricado']; ?></td>
    </tr>
    <?php } ?>
    
    <?php if( !empty($detail['i_seats']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('Seats', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo @$detail['i_seats']; ?></td>
    </tr>
    <?php } ?>
    
    
    <?php if( !empty($detail['e_transmission']) ) { ?>
    <tr>
        <?php $transmission = array('MANUAL' => __('Manual', 'cars_attributes'), 'AUTO' => __('Auto', 'cars_attributes')); ?>
        <td width="150px"><label><?php _e('Transmission', 'cars_attributes'); ?></label></td>
        <td width="150px"><label><?php echo $transmission[$detail['e_transmission']]; ?></td>
    </tr>
    <?php } ?>
    <?php if( !empty($detail['e_fuel']) ) { ?>
    <tr>
        <?php $fuel = array('DIESEL'          => __('Diesel', 'cars_attributes')
                           ,'GASOLINE'        => __('Gasoline', 'cars_attributes')
                           ,'ELECTRIC-HIBRID' => __('Electric-hibrid', 'cars_attributes')
                           ,'OTHER'           => __('Other', 'cars_attributes'));
        ?>
        <td width="150px"><label><?php _e('Fuel', 'cars_attributes'); ?></label></td>
        <td width="150px"><label><?php echo $fuel[$detail['e_fuel']]; ?></td>
    </tr>
    <?php } ?>
    <?php if( !empty($detail['e_km']) ) { ?>
    <tr>
        <td width="150px"><label><?php _e('KM', 'cars_attributes'); ?></label></td>
        <td width="150px"><?php echo @$detail['e_km']; ?></td>
    </tr>
    <?php } ?>
    

</table>

</div>
  
<div class="col-md-4">
    <table style="margin-left: 20px;">




    <tr>
        <td width="150px"><label><?php _e('Garantia Fábrica', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_warranty'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('IPVA', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_ipva'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Licenciado', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_licenciado'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
<tr>
        <td width="150px"><label><?php _e('Adaptado Deficiente', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_adaptado'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
<tr>
        <td width="150px"><label><?php _e('Blindado', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_blindado'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>



  <tr>
        <td width="150px"><label><?php _e('Revendedor', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_new'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
   <tr>
        <td width="150px"><label><?php _e('Ar Condicionado', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_ar_condicionado'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Teto Solar', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_teto_solar'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Direção Hidráulica', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_direcao_hidraulica'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Trio Elétrico', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_trio_eletrico'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Bancos de Couro', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_bancos_couro'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
</table>
</div>
<div class="col-md-4">
    <table style="margin-left: 20px;">
<tr>
        <td width="150px"><label><?php _e('InsulFilm', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_insulfilm'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Roda LigaLeve', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_roda_liga'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Piloto automático', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_piloto'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>

  <tr>
        <td width="150px"><label><?php _e('Airbag', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_airbag'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
   <tr>
        <td width="150px"><label><?php _e('Freios ABS', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_freios_abs'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Controle de Tração', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_controle_tracao'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('4x4', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_quatro'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Computador Bordo', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_computador_bordo'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Bluetooth', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_bluetooth'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('Entrada MP3', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_entrada_mp3'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
    <tr>
        <td width="150px"><label><?php _e('GPS', 'cars_attributes'); ?>: </label></td>
        <td width="150px"><?php echo @$detail['b_gps'] ? '<strong>' . __('Yes', 'cars_attributes') . '</strong>' : __('No', 'cars_attributes'); ?></td>
    </tr>
</table>
</div>
</div>
</div>