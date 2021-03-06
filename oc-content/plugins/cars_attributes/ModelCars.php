<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either fvehic 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    /**
     * Model database for Car Attributes tables
     * 
     * @package OSClass
     * @subpackage Model
     * @since 3.0
     */
    class ModelCars extends DAO
    {
        /**
         * It references to self object: ModelCars.
         * It is used as a singleton
         * 
         * @access private
         * @since 3.0
         * @var ModelCars
         */
        private static $instance ;

        /**
         * It creates a new ModelCars object class ir if it has been created
         * before, it return the previous object
         * 
         * @access public
         * @since 3.0
         * @return ModelCars
         */
        public static function newInstance()
        {
            if( !self::$instance instanceof self ) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        /**
         * Construct
         */
        function __construct()
        {
            parent::__construct();
        }
        
        /**
         * Return table name car attributes
         * @return string
         */
        public function getTable_CarAttr()
        {
            return DB_TABLE_PREFIX.'t_item_car_attr';
        }
        
        /**
         * Return table name car make attributes
         * @return string
         */
        public function getTable_CarMake()
        {
            return DB_TABLE_PREFIX.'t_item_car_make_attr';
        }
        
        /**
         * Return table name car model attributes
         * @return string
         */
        public function getTable_CarModel()
        {
            return DB_TABLE_PREFIX.'t_item_car_model_attr';
        }
        
        /**
         * Return table name car vehicle type attributes
         * @return string
         */
        public function getTable_CarVehicleType()
        {
            return DB_TABLE_PREFIX.'t_item_car_vehicle_type_attr2';
        }
        
        /**
         * Import sql file
         * @return type $file 
         */
        public function import($file)
        {
            $path = osc_plugin_resource($file) ;
            $sql = file_get_contents($path);

            if(! $this->dao->importSQL($sql) ){
                throw new Exception( "Error importSQL::ModelCars<br>".$file ) ;
            }
        }
                
        /**
         * Remove data and tables related to the plugin.
         */
        public function uninstall()
        {
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTable_CarAttr()) ) ;
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTable_CarModel()) ) ;
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTable_CarMake()) ) ;
            $this->dao->query(sprintf('DROP TABLE %s', $this->getTable_CarVehicleType()) ) ;
        }
        
        /**
         * Get Car attributes given a item id
         *
         * @param int $itemId
         * @return array 
         */
        public function getCarAttr($itemId)
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarAttr());
            $this->dao->where('fk_i_item_id', $itemId);

            $result = $this->dao->get();
            if( !$result ) {
                return array() ;
            }

            return $result->row();
        }
        
        /**
         * Get all car makes 
         *
         * @return array 
         */
        public function getCarMakes()
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarMake() ) ;
            $this->dao->orderBy('s_name', 'ASC') ;

            $results = $this->dao->get();
            if( !$results ) {
                return array() ;
            }

            return $results->result();
        }
        
        /**
         * Get Make attributes given a make id
         *
         * @param int $id 
         * @return array
         */
        public function getCarMakeById( $id )
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarMake());
            $this->dao->where('pk_i_id', $id );
            
            $result = $this->dao->get();
            if( !$result ) {
                return array() ;
            }

            return $result->row();
        }
        
        /**
         * Get all car models given a make id
         *
         * @param int $makeId
         * @return array
         */
        public function getCarModels( $makeId )
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarModel() ) ;
            $this->dao->where('fk_i_make_id', $makeId) ;
            $this->dao->orderBy('s_name', 'ASC') ;
            
            $results = $this->dao->get();
            if( !$results ) {
                return array() ;
            }

            return $results->result();
        }
        
        /**
         * Get Model attributes given a model id
         *
         * @param int $id 
         * @return array
         */
        public function getCarModelById( $id )
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarModel());
            $this->dao->where('pk_i_id', $id );
            
            $result = $this->dao->get();

            if( !$result ) {
                return array() ;
            }

            return $result->row();
        }
        
        /**
         * Get all vehicle types, if locale is set, results are filtered by given locale
         *
         * @param string $locale
         * @return array
         */
        public function getVehiclesType( $modelId )
        {
            $this->dao->select() ;
            $this->dao->from( $this->getTable_CarVehicleType() ) ;
             $this->dao->where('fk_i_model_id', $modelId) ;
            $this->dao->orderBy('s_name', 'A1') ;
            
            $results = $this->dao->get();
            if( !$results ) {
                return array() ;
            }

            return $results->result();
        }
        
        /**
         * Get Vehicle type attributes given a Vehicle type id
         *
         * @param int $id 
         * @return array
         */
        public function getVehicleTypeById( $id )
        {
            $this->dao->select();
            $this->dao->from( $this->getTable_CarVehicleType());
            $this->dao->where('pk_i_id', $id );
            $result = $this->dao->get();

            if( !$result ) {
                return array() ;
            }

            return $result->row();
        }
        
        /**
         * Get all vehicle types, if locale is set, results are filtered by given locale
         *
         * @param string $locale
         * @return array
         */
        public function getLastVehicleTypeId()
        {
            $this->dao->select('pk_i_id');
            $this->dao->from($this->getTable_CarVehicleType()) ;
            $this->dao->orderBy('pk_i_id', 'DESC') ;
            $this->dao->limit(1) ;
            
            $result = $this->dao->get() ;
            if( !$result ) {
                return array() ;
            }

            $aux = $result->row();
            return $aux['pk_i_id']; 
        }
        
        /**
         * Insert Car attributes 
         * 
         * @param array $arrayInsert 
         */
        public function insertCarAttr( $arrayInsert, $itemId )
        {
            $aSet = $this->toArrayInsert($arrayInsert);
            $aSet['fk_i_item_id'] = $itemId;
            
            return $this->dao->insert( $this->getTable_CarAttr(), $aSet) ;
        }
        
        /**
         * Insert a Make
         *
         * @param string $name 
         */
        public function insertMake( $name )
        {
            return $this->dao->insert($this->getTable_CarMake(), array('s_name' => $name)) ;
        }
        
        /**
         * Insert a Model given Make id 
         *
         * @param int $makeId
         * @param string $name 
         */
        public function insertModel( $makeId, $name )
        {
            $aSet = array(
                'fk_i_make_id'  => $makeId,
                's_name'        => $name
            );
            return $this->dao->insert($this->getTable_CarModel(), $aSet );
        }
        
        /**
         * Insert a Vehicle type
         *
         * @param int $typeId
         * @param string $locale
         * @param string $name 
         */
        public function insertVehicleType($modelId, $name)
        {
            $aSet = array(
                
                'fk_i_model_id'      => $modelId,
                's_name'            => $name
            );
            return $this->dao->insert($this->getTable_CarVehicleType(), $aSet);
        }
        
        /**
         * Update Car attributes given a item id
         * 
         * @param type $arrayUpdate 
         */
        public function updateCarAttr( $arrayUpdate, $itemId )
        {
            $aUpdate = $this->toArrayInsert($arrayUpdate) ;
            return $this->_update( $this->getTable_CarAttr(), $aUpdate, array('fk_i_item_id' => $itemId));
        }
        
        /**
         * Update Make attributes
         *
         * @param int $makeId
         * @param string $name 
         */
        public function updateMake( $makeId, $name )
        {
            return $this->_update( $this->getTable_CarMake(), array('s_name' => $name), array('pk_i_id' => $makeId)) ;
        }
        
        /**
         * Update Model attributes
         *
         * @param int $modelId
         * @param string $makeId
         * @param string $name 
         */
        public function updateModel( $modelId, $makeId, $name )
        {
            return $this->_update($this->getTable_CarModel(), array('s_name' => $name), array('pk_i_id' => $modelId, 'fk_i_make_id' => $makeId));
        }
        
        /**
         * Update Vehicle type attributes
         *
         * @param int $typeId
         * @param string $locale
         * @param string $name 
         */
        public function updateVehicleType($typeId, $makeId, $name)
        {
         return $this->_update($this->getTable_CarVehicleType(), array('s_name' => $name), array('pk_i_id' => $typeId, 'fk_i_model_id' => $modelId));
        }
        
        /**
         * Delete Car attributes given a item id
         * 
         * @param int $itemId 
         */
        public function deleteCarAttr( $itemId )
        {
            return $this->dao->delete( $this->getTable_CarAttr(), array('fk_i_item_id' => $itemId));
        }
        
        /**
         * Delete a Make given a id
         * 
         * @param int $makeId 
         */
        public function deleteMake( $makeId )
        {
            $this->dao->delete( $this->getTable_CarModel(), array('fk_i_make_id' => $makeId)) ;
            return $this->dao->delete( $this->getTable_CarMake() , array('pk_i_id' => $makeId)) ;
        }
        
        /**
         * Delete a Model given a id
         * 
         * @param int $modelId 
         */
        public function deleteModel( $modelId )
        {
            return $this->dao->delete( $this->getTable_CarModel(), array('pk_i_id' => $modelId) ) ;
        }
        
        /**
         * Delete a Vehicle type given a id
         *
         * @param int $typeId 
         */
        public function deleteVehicleType( $typeId )
        {
            return $this->dao->delete($this->getTable_CarVehicleType(), array('pk_i_id' => $typeId));
        }
        
        /**
         * Delete vehicle type given a locale.
         * 
         * @param type $locale 
         */
        //public function deleteLocale( $locale )
        //{
         //   return $this->dao->delete($this->getTable_CarVehicleType(), array('fk_c_locale_code' => $locale));
        //}
        
        /**
         * Return an array, associates field name in database with the value
         * @param type $arrayInsert
         * @return type 
         */
        private function toArrayInsert( $arrayInsert )
        {
            $array = array(
                'i_year'            => $arrayInsert['year'],
                'i_year_fabricado'  => $arrayInsert['year_fabricado'],             
                'i_seats'           => $arrayInsert['seats'],   
                'e_transmission'    => $arrayInsert['transmission'],
                'e_fuel'            => $arrayInsert['fuel'],
                'e_km'          => $arrayInsert['km'],
                'b_warranty'        => $arrayInsert['warranty'],
                'b_new'             => $arrayInsert['new'],
                'b_ipva'            => $arrayInsert['ipva'],
                'b_licenciado'      => $arrayInsert['licenciado'],
                'b_adaptado' => $arrayInsert['adaptado'],
                
                'b_blindado' => $arrayInsert['blindado'],

                'b_ar_condicionado' => $arrayInsert['ar_condicionado'],
                'b_teto_solar' => $arrayInsert['teto_solar'],
                'b_direcao_hidraulica' => $arrayInsert['direcao_hidraulica'],
                'b_trio_eletrico' => $arrayInsert['trio_eletrico'],
                'b_bancos_couro' => $arrayInsert['bancos_couro'],
                'b_insulfilm' => $arrayInsert['insulfilm'],
                'b_roda_liga' => $arrayInsert['roda_liga'],
                'b_piloto' => $arrayInsert['piloto'],

                'b_airbag' => $arrayInsert['airbag'],
                'b_freios_abs' => $arrayInsert['freios_abs'],
                'b_controle_tracao' => $arrayInsert['controle_tracao'],
                'b_quatro' => $arrayInsert['quatro'],
                'b_computador_bordo' => $arrayInsert['computador_bordo'],
                'b_bluetooth' => $arrayInsert['bluetooth'],
                'b_entrada_mp3' => $arrayInsert['entrada_mp3'],
                'b_gps' => $arrayInsert['gps'],
                'b_inspecao' => $arrayInsert['inspecao'],




                   
                'fk_i_make_id'      => $arrayInsert['make'],
                'fk_i_model_id'     => $arrayInsert['model'],
                'fk_i_vehicle_type_id'=> $arrayInsert['type']
            );
            return $array;
        }
        
        // update
        function _update($table, $values, $where)
        {
            $this->dao->from($table) ;
            $this->dao->set($values) ;
            $this->dao->where($where) ;
            return $this->dao->update() ;
        }
    }

?>