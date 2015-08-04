<?php
/*
Plugin Name: Cars attributes
Plugin URI: http://www.osclass.org/
Description: This plugin extends a category of items to store cars attributes such as model, year, brand, color, accessories, and so on.
Version: 3.0.4
Author: OSClass
Author URI: http://www.osclass.org/
Short Name: cars_plugin
Plugin update URI: cars-attributes
*/
    require_once 'ModelCars.php' ;

    // Adds some plugin-specific search conditions
    function cars_search_conditions($params) {
        // we need conditions and search tables (only if we're using our custom tables)
        $has_conditions = false ;
        foreach($params as $key => $value) {
            // we may want to have param-specific searches
            switch($key) {
                case 'type':
                    if( is_numeric($value) ) {
                        Search::newInstance()->addConditions(sprintf("%st_item_car_attr.fk_i_vehicle_type_id = %d", DB_TABLE_PREFIX, $value));
                        $has_conditions = true;
                    }
                break;
                case 'make':
                    if( is_numeric($value) ) {
                        Search::newInstance()->addConditions(sprintf("%st_item_car_attr.fk_i_make_id = %d", DB_TABLE_PREFIX, $value));
                        $has_conditions = true;
                    }
                break;
                case 'model':
                    if( is_numeric($value) ) {
                        Search::newInstance()->addConditions(sprintf("%st_item_car_attr.fk_i_model_id = %d", DB_TABLE_PREFIX, $value));
                        $has_conditions = true;
                    }
                break;
                case 'transmission':
                    if( $value == 'AUTO' || $value == 'MANUAL' ) {
                        Search::newInstance()->addConditions(sprintf("%st_item_car_attr.e_transmission = '%s'", DB_TABLE_PREFIX, $value));
                        $has_conditions = true;
                    }
                break;
                default:
                break;
            }
        }

        // Only if we have some values at the params we add our table and link with the ID of the item.
        if($has_conditions) {
            Search::newInstance()->addConditions(sprintf("%st_item.pk_i_id = %st_item_car_attr.fk_i_item_id ", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
            Search::newInstance()->addTable(sprintf("%st_item_car_attr", DB_TABLE_PREFIX));
        }
    }

    function cars_call_after_install() {
        // create a table to store the cars attributes
        ModelCars::newInstance()->import('cars_attributes/struct.sql');
        ModelCars::newInstance()->import('cars_attributes/basic_data.sql');
    }

    function cars_call_after_uninstall() {
        // remove the table we created to store cars attributes
        ModelCars::newInstance()->uninstall();
    }

    function cars_form($catID = '') {
        // We received the categoryID
        if($catID == '') {
            return false;
        }
        
        // check if the category is the same as our plugin
        if( osc_is_this_category('cars_plugin', $catID) ) {
            $makes = ModelCars::newInstance()->getCarMakes();
            //$data  = ModelCars::newInstance()->getVehiclesType();
            
            //foreach($data as $d) {
              //  $car_types[$d['fk_vehicle_type_id']][$d['pk_i_id']] = $d['s_name'];
           // } 
           // unset($data);
            $models = array();
            if(Session::newInstance()->_getForm('pc_make') != '') {
                $models = ModelCars::newInstance()->getCarModels(Session::newInstance()->_getForm('pc_make'));
            }

$car_types = array();
            if(Session::newInstance()->_getForm('pc_model') != '') {
                $car_types = ModelCars::newInstance()->getVehiclesType(Session::newInstance()->_getForm('pc_model'));
            }

            require_once 'item_edit.php';
        }
    }

    function cars_search_form($catID = null) {
        // we received the categoryID
        if($catID == null) {
            return false;
        }
        
        // we check if the category is the same as our plugin
        foreach($catID as $id) {
            if( osc_is_this_category('cars_plugin', $id) ) {
                include_once 'search_form.php';
                break;
            }
        }
    }

    function cars_form_post($item) {
        $catID = isset($item['fk_i_category_id'])?$item['fk_i_category_id']:null;
        $itemID = isset($item['pk_i_id'])?$item['pk_i_id']:null;
        // we received the categoryID and the Item ID
        if($catID == null) {
            return false;
        }
        
        // We check if the category is the same as our plugin
        if( osc_is_this_category('cars_plugin', $catID) && $itemID != null ) {
            $arrayInsert = _getCarParameters();
            // Insert the data in our plugin's table
            ModelCars::newInstance()->insertCarAttr($arrayInsert, $itemID);
        }
    }

    // self-explanatory
    function cars_item_detail() {
        if( osc_is_this_category('cars_plugin', osc_item_category_id()) ) {
            $detail   = ModelCars::newInstance()->getCarAttr(osc_item_id()) ;

            if( count($detail) == 0 ) {
                return ;
            }

            $make     = ModelCars::newInstance()->getCarMakeById( $detail['fk_i_make_id'] );
            $model    = ModelCars::newInstance()->getCarModelById( $detail['fk_i_model_id'] );
            $car_type = ModelCars::newInstance()->getVehicleTypeById($detail['fk_i_vehicle_type_id']);

            $detail['s_make'] = '' ;
            if( array_key_exists('s_name', $make) ) {
                $detail['s_make']  = $make['s_name'];
            }
            $detail['s_model'] = '' ;
            if( array_key_exists('s_name', $model) ) {
                $detail['s_model']  = $model['s_name'];
            }
            $detail['s_car_type'] = '' ;
            if( array_key_exists('s_name', $car_type) ) {
                $detail['s_car_type']  = $car_type['s_name'];
            }

            require_once 'item_detail.php' ;
        }
    }

function cars_makemodel() {
        if( osc_is_this_category('cars_plugin', osc_item_category_id()) ) {
            $detail   = ModelCars::newInstance()->getCarAttr(osc_item_id()) ;

            if( count($detail) == 0 ) {
                return ;
            }

            $make     = ModelCars::newInstance()->getCarMakeById( $detail['fk_i_make_id'] );
            $model    = ModelCars::newInstance()->getCarModelById( $detail['fk_i_model_id'] );
            $car_type = ModelCars::newInstance()->getVehicleTypeById($detail['fk_i_vehicle_type_id']);

            $detail['s_make'] = '' ;
            if( array_key_exists('s_name', $make) ) {
                $detail['s_make']  = $make['s_name'];
            }
            $detail['s_model'] = '' ;
            if( array_key_exists('s_name', $model) ) {
                $detail['s_model']  = $model['s_name'];
            }
            $detail['s_car_type'] = '' ;
            if( array_key_exists('s_name', $car_type) ) {
                $detail['s_car_type']  = $car_type['s_name'];
            }

            require_once 'item_makemodel.php' ;
        }
    }     

    function cars_makemodel2() {
        if( osc_is_this_category('cars_plugin', osc_item_category_id()) ) {
            $detail   = ModelCars::newInstance()->getCarAttr(osc_item_id()) ;

            if( count($detail) == 0 ) {
                return ;
            }

            $make     = ModelCars::newInstance()->getCarMakeById( $detail['fk_i_make_id'] );
            $model    = ModelCars::newInstance()->getCarModelById( $detail['fk_i_model_id'] );
            $car_type = ModelCars::newInstance()->getVehicleTypeById($detail['fk_i_vehicle_type_id']);

            $detail['s_make'] = '' ;
            if( array_key_exists('s_name', $make) ) {
                $detail['s_make']  = $make['s_name'];
            }
            $detail['s_model'] = '' ;
            if( array_key_exists('s_name', $model) ) {
                $detail['s_model']  = $model['s_name'];
            }
            $detail['s_car_type'] = '' ;
            if( array_key_exists('s_name', $car_type) ) {
                $detail['s_car_type']  = $car_type['s_name'];
            }

            require_once 'item_makemodel2.php' ;
        }
    }     


    // Self-explanatory
    function cars_item_edit($catID = null, $itemID = null) {
        if(osc_is_this_category('cars_plugin', $catID)) {
            $detail = ModelCars::newInstance()->getCarAttr($itemID);
            $makes  = ModelCars::newInstance()->getCarMakes();
            $models = array() ;
            if( array_key_exists('fk_i_make_id', $detail) ) {
                $models = ModelCars::newInstance()->getCarModels( $detail['fk_i_make_id'] );
            }
            $car_types = array() ;
            if( array_key_exists('fk_i_model_id', $detail) ) {
                $car_types = ModelCars::newInstance()->getVehiclesType( $detail['fk_i_model_id'] );
            }

            require_once 'item_edit.php';
        }
    }

    function cars_item_edit_post($item) {
        $catID = isset($item['fk_i_category_id'])?$item['fk_i_category_id']:null;
        $itemID = isset($item['pk_i_id'])?$item['pk_i_id']:null;
        // We received the categoryID and the Item ID
        if($catID == null) {
            return false;
        }

        // We check if the category is the same as our plugin
        if( osc_is_this_category('cars_plugin', $catID) ) {
            $arrayUpdate = _getCarParameters();
            ModelCars::newInstance()->updateCarAttr($arrayUpdate, $itemID);
        }
    }

    function cars_admin_menu() {
        if(osc_version()<320) {
            echo '<h3><a href="#">Cars plugin</a></h3>
            <ul>
                <li><a href="'.osc_admin_configure_plugin_url("cars_attributes/index.php").'">&raquo; '.__('Configure plugin', 'cars_attributes').'</a></li>
                <li><a href="'.osc_admin_render_plugin_url("cars_attributes/conf.php").'?section=makes">&raquo; '.__('Manage makes', 'cars_attributes').'</a></li>
                <li><a href="'.osc_admin_render_plugin_url("cars_attributes/conf.php").'?section=models">&raquo; '.__('Manage models', 'cars_attributes').'</a></li>
                <li><a href="'.osc_admin_render_plugin_url("cars_attributes/conf.php").'?section=types">&raquo; '.__('Manage vehicle types', 'cars_attributes').'</a></li>
            </ul>';
        } else {
            osc_add_admin_submenu_divider('plugins', __('Cars plugin', 'cars_attributes'), 'cars_attributes_divider', 'administrator');
            osc_add_admin_submenu_page('plugins', __('Configure plugin', 'cars_attributes'), osc_admin_configure_plugin_url("cars_attributes/index.php"), 'cars_attributes_settings', 'administrator');
            osc_add_admin_submenu_page('plugins', __('Manage makes', 'cars_attributes'), osc_route_admin_url('cars-admin-conf', array('section' => 'makes')), 'cars_attributes_makes', 'administrator');
            osc_add_admin_submenu_page('plugins', __('Manage models', 'cars_attributes'), osc_route_admin_url('cars-admin-conf', array('section' => 'models')), 'cars_attributes_models', 'administrator');
            osc_add_admin_submenu_page('plugins', __('Manage vehicle types', 'cars_attributes'), osc_route_admin_url('cars-admin-conf', array('section' => 'types')), 'cars_attributes_types', 'administrator');
        }
    }

    function cars_delete_locale($locale) {
        ModelCars::newInstance()->deleteLocale($locale);
    }

    function cars_delete_item($item_id) {
        ModelCars::newInstance()->deleteCarAttr($item_id);
    }

    function cars_admin_configuration() {
        // standard configuration page for plugin which extend item's attributes
        osc_plugin_configure_view(osc_plugin_path(__FILE__));
    }

    function cars_pre_item_post() {
        $warranty = (Params::getParam("warranty") != '') ? 1 : 0 ;
        $new      = (Params::getParam("new") != '') ? 1 : 0 ;
        $ipva = (Params::getParam("ipva") != '') ? 1 : 0 ;
        $licenciado = (Params::getParam("licenciado") != '') ? 1 : 0 ;
        $adaptado = (Params::getParam("adaptado") != '') ? 1 : 0 ;
        
        $blindado = (Params::getParam("blindado") != '') ? 1 : 0 ;

        $ar_condicionado = (Params::getParam("ar_condicionado") != '') ? 1 : 0 ;
        $teto_solar = (Params::getParam("teto_solar") != '') ? 1 : 0 ;
        $direcao_hidraulica = (Params::getParam("direcao_hidraulica") != '') ? 1 : 0 ;
        $trio_eletrico = (Params::getParam("trio_eletrico") != '') ? 1 : 0 ;
        $bancos_couro = (Params::getParam("bancos_couro") != '') ? 1 : 0 ;
        $insulfilm = (Params::getParam("insulfilm") != '') ? 1 : 0 ;
        $roda_liga = (Params::getParam("roda_liga") != '') ? 1 : 0 ;
        $piloto = (Params::getParam("piloto") != '') ? 1 : 0 ;



        $airbag = (Params::getParam("ar_condicionado") != '') ? 1 : 0 ;
        $freios_abs = (Params::getParam("teto_solar") != '') ? 1 : 0 ;
        $controle_tracao = (Params::getParam("direcao_hidraulica") != '') ? 1 : 0 ;
        $quatro = (Params::getParam("quatro") != '') ? 1 : 0 ;
        $computador_bordo = (Params::getParam("computador_bordo") != '') ? 1 : 0 ;
        $bluetooth = (Params::getParam("bluetooth") != '') ? 1 : 0 ;
        $entrada_mp3 = (Params::getParam("entrada_mp3") != '') ? 1 : 0 ;
        $gps = (Params::getParam("gps") != '') ? 1 : 0 ;
        $inspecao = (Params::getParam("inspecao") != '') ? 1 : 0 ;




        


        Session::newInstance()->_setForm('pc_year', Params::getParam("year"));
        Session::newInstance()->_setForm('pc_year_fabricado', Params::getParam("year_fabricado"));      
        Session::newInstance()->_setForm('pc_seats', Params::getParam("seats"));
      
       
       
        Session::newInstance()->_setForm('pc_transmission', Params::getParam("transmission"));
        Session::newInstance()->_setForm('pc_fuel', Params::getParam("fuel"));
        Session::newInstance()->_setForm('pc_km', Params::getParam("km"));
        Session::newInstance()->_setForm('pc_warranty', $warranty);
        Session::newInstance()->_setForm('pc_ipva', $ipva);
        Session::newInstance()->_setForm('pc_new', $new);
        Session::newInstance()->_setForm('pc_licenciado', $licenciado);
        Session::newInstance()->_setForm('pc_adaptado', $adaptado);
        Session::newInstance()->_setForm('pc_blindado', $blindado);

        Session::newInstance()->_setForm('pc_ar_condicionado', $ar_condicionado);
        Session::newInstance()->_setForm('pc_teto_solar', $teto_solar);
        Session::newInstance()->_setForm('pc_direcao_hidraulica', $direcao_hidraulica);
        Session::newInstance()->_setForm('pc_trio_eletrico', $trio_eletrico);
        Session::newInstance()->_setForm('pc_bancos_couro', $bancos_couro);
        Session::newInstance()->_setForm('pc_insulfilm', $insulfilm);
        Session::newInstance()->_setForm('pc_roda_liga', $roda_liga);
        Session::newInstance()->_setForm('pc_piloto', $piloto);

        Session::newInstance()->_setForm('pc_airbag', $ar_condicionado);
        Session::newInstance()->_setForm('pc_freios_abs', $teto_solar);
        Session::newInstance()->_setForm('pc_controle_tracao', $direcao_hidraulica);
        Session::newInstance()->_setForm('pc_quatro', $trio_eletrico);
        Session::newInstance()->_setForm('pc_computador_bordo', $bancos_couro);
        Session::newInstance()->_setForm('pc_bluetooth', $insulfilm);
        Session::newInstance()->_setForm('pc_entrada_mp3', $roda_liga);
        Session::newInstance()->_setForm('pc_gps', $gps);
        Session::newInstance()->_setForm('pc_inspecao', $inspecao);




       
        Session::newInstance()->_setForm('pc_make', Params::getParam("make"));
        Session::newInstance()->_setForm('pc_model', Params::getParam("model"));
        Session::newInstance()->_setForm('pc_car_type', Params::getParam("car_type"));
        // keep values on session
        Session::newInstance()->_keepForm('pc_year');
        Session::newInstance()->_keepForm('pc_year_fabricado');
       
        Session::newInstance()->_keepForm('pc_seats');
       
      
       
        Session::newInstance()->_keepForm('pc_transmission');
        Session::newInstance()->_keepForm('pc_fuel');
        Session::newInstance()->_keepForm('pc_km');
        Session::newInstance()->_keepForm('pc_warranty');
        Session::newInstance()->_keepForm('pc_ipva');
        Session::newInstance()->_keepForm('pc_new');
        Session::newInstance()->_keepForm('pc_licenciado');
        Session::newInstance()->_keepForm('pc_adaptado');
        Session::newInstance()->_keepForm('pc_blindado');

        Session::newInstance()->_keepForm('pc_ar_condicionado');
        Session::newInstance()->_keepForm('pc_teto_solar');
        Session::newInstance()->_keepForm('pc_direcao_hidraulica');
        Session::newInstance()->_keepForm('pc_trio_eletrico');
        Session::newInstance()->_keepForm('pc_bancos_couro');
        Session::newInstance()->_keepForm('pc_insulfilm');
        Session::newInstance()->_keepForm('pc_roda_liga');
        Session::newInstance()->_keepForm('pc_piloto');


        Session::newInstance()->_keepForm('pc_airbag');
        Session::newInstance()->_keepForm('pc_freios_abs');
        Session::newInstance()->_keepForm('pc_controle_tracao');
        Session::newInstance()->_keepForm('pc_quatro');
        Session::newInstance()->_keepForm('pc_computador_bordo');
        Session::newInstance()->_keepForm('pc_bluetooth');
        Session::newInstance()->_keepForm('pc_entrada_mp3');
        Session::newInstance()->_keepForm('pc_gps');
        Session::newInstance()->_keepForm('pc_inspecao');



       
        Session::newInstance()->_keepForm('pc_make');
        Session::newInstance()->_keepForm('pc_model');
        Session::newInstance()->_keepForm('pc_car_type');
    }
    
    function _getCarParameters() {
        $make     = (Params::getParam("make") == '') ? null : Params::getParam("make");
        $model    = (Params::getParam("model") == '') ? null : Params::getParam("model");
        $car_type = (Params::getParam("car_type") == '') ? null : Params::getParam("car_type");
       
       
       
        $year     = (Params::getParam("year") == '') ? null : Params::getParam("year");
        $year_fabricado     = (Params::getParam("year_fabricado") == '') ? null : Params::getParam("year_fabricado");
        $warranty = (Params::getParam("warranty")!='') ? 1 : 0;
        $ipva = (Params::getParam("ipva")!='') ? 1 : 0;
        $licenciado = (Params::getParam("licenciado")!='') ? 1 : 0;
        $adaptado = (Params::getParam("adaptado")!='') ? 1 : 0;
        $blindado = (Params::getParam("blindado")!='') ? 1 : 0;

        $ar_condicionado = (Params::getParam("ar_condicionado")!='') ? 1 : 0;
        $teto_solar = (Params::getParam("teto_solar")!='') ? 1 : 0;
        $direcao_hidraulica = (Params::getParam("direcao_hidraulica")!='') ? 1 : 0;
        $trio_eletrico = (Params::getParam("trio_eletrico")!='') ? 1 : 0;
        $bancos_couro = (Params::getParam("bancos_couro")!='') ? 1 : 0;
        $insulfilm = (Params::getParam("insulfilm")!='') ? 1 : 0;
        $roda_liga = (Params::getParam("roda_liga")!='') ? 1 : 0;
        $piloto = (Params::getParam("piloto")!='') ? 1 : 0;


        $airbag = (Params::getParam("airbag")!='') ? 1 : 0;
        $freios_abs = (Params::getParam("freios_abs")!='') ? 1 : 0;
        $controle_tracao = (Params::getParam("controle_tracao")!='') ? 1 : 0;
        $quatro = (Params::getParam("quatro")!='') ? 1 : 0;
        $computador_bordo = (Params::getParam("computador_bordo")!='') ? 1 : 0;
        $bluetooth = (Params::getParam("bluetooth")!='') ? 1 : 0;
        $entrada_mp3 = (Params::getParam("entrada_mp3")!='') ? 1 : 0;
        $gps = (Params::getParam("gps")!='') ? 1 : 0;
        $inspecao = (Params::getParam("inspecao")!='') ? 1 : 0;






        $new      = (Params::getParam("new")!='') ? 1 : 0;        
        $array = array(
       
            'seats'         => Params::getParam("seats"),
            'year'          => $year,
            'year_fabricado'   => $year_fabricado,
            'transmission'  => Params::getParam("transmission"),
            'fuel'          => Params::getParam("fuel"),
            'km'        => Params::getParam("km"),
            'warranty'      => $warranty,
            'ipva'          => $ipva,
            'licenciado'    => $licenciado,
            'adaptado'    => $adaptado,
            'blindado'            => $blindado,
            'ar_condicionado'     => $ar_condicionado,
            'teto_solar'          => $teto_solar,
            'direcao_hidraulica'  => $direcao_hidraulica,
            'trio_eletrico'       => $trio_eletrico,
            'bancos_couro'        => $bancos_couro,
            'insulfilm'           => $insulfilm,
            'roda_liga'           => $roda_liga,
            'piloto'              => $piloto,

            'airbag'     => $airbag,
            'freios_abs'          => $freios_abs,
            'controle_tracao'  => $controle_tracao,
            'quatro'       => $quatro,
            'computador_bordo'        => $computador_bordo,
            'bluetooth'           => $bluetooth,
            'entrada_mp3'           => $entrada_mp3,
            'gps'              => $gps,
            'inspecao'              => $inspecao,


            'new'           => $new,           
            'make'          => $make,
            'model'         => $model,
            'type'          => $car_type
        );

        return $array;
    }

    if(osc_version()>=320) {
        osc_add_route('cars-admin-conf', 'cars-conf/(.+)', 'cars-conf/{section}', osc_plugin_folder(__FILE__).'admin/conf.php');
    }
    
    // This is needed in order to be able to activate the plugin
    osc_register_plugin(osc_plugin_path(__FILE__), 'cars_call_after_install');
    // This is a hack to show a Configure link at plugins table (you could also use some other hook to show a custom option panel)
    osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'cars_admin_configuration');
    // This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
    osc_add_hook(osc_plugin_path(__FILE__) . "_uninstall", 'cars_call_after_uninstall');

    // When publishing an item we show an extra form with more attributes
    osc_add_hook('item_form', 'cars_form');
    // To add that new information to our custom table
    osc_add_hook('posted_item', 'cars_form_post');

    // When searching, display an extra form with our plugin's fields
    osc_add_hook('search_form', 'cars_search_form');
    // When searching, add some conditions
    osc_add_hook('search_conditions', 'cars_search_conditions');

    // show an item special attributes
    osc_add_hook('item_detail', 'cars_item_detail');

    // edit an item special attributes
    osc_add_hook('item_edit', 'cars_item_edit');
    // edit an item special attributes POST
    osc_add_hook('edited_item', 'cars_item_edit_post');

    if(osc_version()<320) {
        osc_add_hook('admin_menu', 'cars_admin_menu');
    } else {
        osc_add_hook('admin_menu_init', 'cars_admin_menu');
    }

    // delete locale
    osc_add_hook('delete_locale', 'cars_delete_locale');
    //delete item
    osc_add_hook('delete_item', 'cars_delete_item');
    // previous to insert item
    osc_add_hook('pre_item_post', 'cars_pre_item_post') ;

?>
