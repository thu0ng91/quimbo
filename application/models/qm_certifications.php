<?php

/**
 *
 * Administra datos para la digitación para las certificaciones laboral, comercial y de vecindad
 *
 * @category    Data
 * @package     Model
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       File available since Release 1.0
 * @author      Juan Camilo Martinez Morales <juan.martinez@mggroup.com.co>
 * @link        http://twitter.com/xogost/
 */
class QM_Certifications extends CI_Model {

    private $arrayProperties = array();
    private $arrayPropertiesFechasN = array();
    private $arrayPropertiesVeredasN = array();

    /**
     * Constructor de la Clase
     */
    public function __construct() {
        parent::__construct();
    }

    /*
     * Set properties for this model
     */

    public function do_setProperties($arrayDataFromView) {

        $this->arrayProperties = array(
            'a14Codigo' => (isset($arrayDataFromView['txtCodigo'])) ? $arrayDataFromView['txtCodigo'] : null,
            'a14Identificador' => (isset($arrayDataFromView['txtIdentificador'])) ? $arrayDataFromView['txtIdentificador'] : null,
            'a14FechaExpedicion' => (isset($arrayDataFromView['txtFechaExpedicion'])) ? $arrayDataFromView['txtFechaExpedicion'] : null,
            'a14MunicipioExpedicion' => (isset($arrayDataFromView['txtMunicipioExpedicion'])) ? $arrayDataFromView['txtMunicipioExpedicion'] : null,
            'a14VeredaCertificacion' => (isset($arrayDataFromView['txtVeredaCertificacion'])) ? $arrayDataFromView['txtVeredaCertificacion'] : null,
            'a14PredioCertificacion' => (isset($arrayDataFromView['txtPredioCertificacion'])) ? $arrayDataFromView['txtPredioCertificacion'] : null,
            'a14Cargo' => (isset($arrayDataFromView['txtCargo'])) ? $arrayDataFromView['txtCargo'] : null,
            'a14FechaSuministrada' => (isset($arrayDataFromView['txtFechaSuministrada'])) ? $arrayDataFromView['txtFechaSuministrada'] : null,
            'a14FechaInicio' => (isset($arrayDataFromView['txtFechaInicio'])) ? $arrayDataFromView['txtFechaInicio'] : null,
            'a14FechaFin' => (isset($arrayDataFromView['txtFechaFin'])) ? $arrayDataFromView['txtFechaFin'] : null,
            'a14TipoPersonaJuridica' => (isset($arrayDataFromView['txtTipoPersonaJuridica'])) ? $arrayDataFromView['txtTipoPersonaJuridica'] : null,
            'a14NombrePersonaJuridica' => (isset($arrayDataFromView['txtNombrePersonaJuridica'])) ? $arrayDataFromView['txtNombrePersonaJuridica'] : null,
            'a14NITPersonaJuridica' => (isset($arrayDataFromView['txtNITPersonaJuridica'])) ? $arrayDataFromView['txtNITPersonaJuridica'] : null,
            'a14DocumentoIdentificacion' => (isset($arrayDataFromView['txtDocumentoIdentificacion'])) ? $arrayDataFromView['txtDocumentoIdentificacion'] : null,
            'a14NombreEmpresa' => (isset($arrayDataFromView['txtNombreEmpresa'])) ? $arrayDataFromView['txtNombreEmpresa'] : null,
            'a14NITEmpresa' => (isset($arrayDataFromView['txtNITEmpresa'])) ? $arrayDataFromView['txtNITEmpresa'] : null,
            'a14DescripcionRelacion' => (isset($arrayDataFromView['txtDescripcionRelacion'])) ? $arrayDataFromView['txtDescripcionRelacion'] : null,
            'a14ValoresCertificados' => (isset($arrayDataFromView['txtValoresCertificados'])) ? $arrayDataFromView['txtValoresCertificados'] : null,
            'a14Unidades' => (isset($arrayDataFromView['txtUnidades'])) ? $arrayDataFromView['txtUnidades'] : null,
            'a14Cantidad' => (isset($arrayDataFromView['txtCantidad'])) ? $arrayDataFromView['txtCantidad'] : null,
            'a14DescripcionUnidades' => (isset($arrayDataFromView['txtDescripcionUnidades'])) ? $arrayDataFromView['txtDescripcionUnidades'] : null,
            'a14DireccionCertificacion' => (isset($arrayDataFromView['txtDireccionCertificacion'])) ? $arrayDataFromView['txtDireccionCertificacion'] : null,
            'a14Zona' => (isset($arrayDataFromView['txtZona'])) ? $arrayDataFromView['txtZona'] : null,
            'a14Barrio' => (isset($arrayDataFromView['txtBarrio'])) ? $arrayDataFromView['txtBarrio'] : null,
            'a14OtroMunicipio' => (isset($arrayDataFromView['txtOtroMunicipio'])) ? $arrayDataFromView['txtOtroMunicipio'] : null,
            'a14OtraVereda' => (isset($arrayDataFromView['txtOtraVereda'])) ? $arrayDataFromView['txtOtraVereda'] : null,
            'a14OtroPredio' => (isset($arrayDataFromView['txtOtroPredio'])) ? $arrayDataFromView['txtOtroPredio'] : null,
            'a14TipoCertificacion' => (isset($arrayDataFromView['txtTipoCertificacion'])) ? $arrayDataFromView['txtTipoCertificacion'] : null,
            'a14OtraDescripcionUnidades' => (isset($arrayDataFromView['txtOtraDescripcionUnidades'])) ? $arrayDataFromView['txtOtraDescripcionUnidades'] : null,
            'a14PersonaNoFigura' => (isset($arrayDataFromView['txtPersonaNoFigura'])) ? $arrayDataFromView['txtPersonaNoFigura'] : null,
            'a14NombrePersonaFirma' => (isset($arrayDataFromView['txtNombrePersonaFirma'])) ? $arrayDataFromView['txtNombrePersonaFirma'] : null,
            'a14CargoPersonaFirma' => (isset($arrayDataFromView['txtCargoPersonaFirma'])) ? $arrayDataFromView['txtCargoPersonaFirma'] : null,
            'a14Observaciones' => (isset($arrayDataFromView['txtObservaciones'])) ? $arrayDataFromView['txtObservaciones'] : null
        );
    }

    /*
     * Insert information into table t14web_certificaciones_detalle
     */

    public function do_insert() {
        try {
            $this->db->insert('t14web_certificaciones_detalle', $this->arrayProperties);
            $query = $this->db->query('SELECT max(a14Codigo) as id from t14web_certificaciones_detalle');
            $row = $query->row_array();
            return $row['id'];
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Update information for the table t14web_certificaciones_detalle
     */

    public function do_update() {
        try {
            $this->arrayProperties["a14FechaUltimaActualizacion"] = date("Y-m-d H:i:s");
            $this->db->where("a14Codigo", $this->arrayProperties["a14Codigo"]);
            $this->db->update('t14web_certificaciones_detalle', $this->arrayProperties);
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Delete information from table t14web_certificaciones_detalle
     */

    public function do_delete($code) {
        try {
            $this->db->where("a17Certificacion", (int)$code);
            $this->db->delete('t17web_nveredascertificaciones');
            
            $this->db->where("a16Certificacion", (int)$code);
            $this->db->delete('t16web_nfechascertificaciones');
            
            $this->db->where("a14Codigo", $code);
            $this->db->delete('t14web_certificaciones_detalle');
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Get information from table t14web_certificaciones_detalle by a14Codigo as Primary Key
     */

    public function get_DataTableByCode($code) {
        try {
            $this->db->where("a14Codigo", $code);
            $dataTable = $this->db->get('t14web_certificaciones_detalle');

            return $dataTable->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Get information from table t14web_certificaciones_detalle by a14Identificador
     */

    public function get_DataTableByForm($formCode) {
        try {
            $this->db->where("a14Identificador", $formCode);
            $dataTable = $this->db->get('t14web_certificaciones_detalle');

            return $dataTable->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /*
     * Get information from table t14web_certificaciones_detalle by a14Identificador
     */

    public function get_FechasN($code) {
        try {
            $SQLResult = $this->db->query("SELECT a16FechaInicio as FechaInicio, a16FechaFin as FechaFin FROM t16web_nfechascertificaciones WHERE a16Certificacion = $code");
            $dataArray = $SQLResult->result();

            return $dataArray;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    /*
     * Set properties for this model t16web_nfechascertificaciones
     */
    public function do_setPropertiesNFechas($arrayDataFechasN) {

        $this->arrayPropertiesFechasN = array(
            'a16Codigo' => (isset($arrayDataFechasN['txtCodigo'])) ? $arrayDataFechasN['txtCodigo'] : null,
            'a16Certificacion' => (isset($arrayDataFechasN['txtCertificacion'])) ? $arrayDataFechasN['txtCertificacion'] : null,
            'a16FechaInicio' => (isset($arrayDataFechasN['txtFechaInicio'])) ? $arrayDataFechasN['txtFechaInicio'] : null,
            'a16FechaFin' => (isset($arrayDataFechasN['txtFechaFin'])) ? $arrayDataFechasN['txtFechaFin'] : null,
        );
    }

    /*
     * Insert information into table t16
     */
    public function do_insert_fechasn() {
        try {
            $this->db->trans_start();
            $this->db->insert('t16web_nfechascertificaciones', $this->arrayPropertiesFechasN);
            $this->db->trans_complete();
            return $this->db->trans_status();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /*
     * Delete information for table t16 by code certification
     */
    public function do_delete_fechasn($code) {
        try {
            $this->db->where("a16Certificacion", (int)$code);
            $this->db->delete('t16web_nfechascertificaciones');
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /* Get information from model t17 */
    public function get_VeredasN($code){
        try{
            $SQLResult = $this->db->query("select vc.a17Municipio as Municipio, vc.a17Vereda as Vereda, vc.a17Predio as Predio, vc.a17OtroMun as OtroMun, vc.a17OtraVda as OtraVda, vc.a17OtroPredio as OtroPredio, m.a06Nombre as NMunicipio, v.a10Nombre as NVereda, p.a15Predio as NPredio from t17web_nveredascertificaciones vc left join t06web_municipios m on vc.a17Municipio = m.a06DANE left join t10web_veredas v on vc.a17Vereda = v.a10Codigo left join t15web_predios p on vc.a17Predio = p.a15Codigo WHERE vc.a17Certificacion = $code union select vc.a17Municipio as Municipio, vc.a17Vereda as Vereda, vc.a17Predio as Predio, vc.a17OtroMun as OtroMun, vc.a17OtraVda as OtraVda, vc.a17OtroPredio as OtroPredio, m.a06Nombre as NMunicipio, v.a10Nombre as NVereda, p.a15Predio as NPredio from t17web_nveredascertificaciones vc right join t06web_municipios m on vc.a17Municipio = m.a06DANE right join t10web_veredas v on vc.a17Vereda = v.a10Codigo right join t15web_predios p on vc.a17Predio = p.a15Codigo WHERE vc.a17Certificacion = $code");
            

            $dataArray = $SQLResult->result();
            return $dataArray;

        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /* Properties for model t17 */
    public function do_setPropertiesNVeredas($arrayDataPropertiesVeredasN){
        $this->arrayPropertiesVeredasN = array(
            'a17Codigo' =>(isset($arrayDataPropertiesVeredasN['txtCodigo'])) ? $arrayDataPropertiesVeredasN['txtCodigo'] : null, 
            'a17Certificacion' =>(isset($arrayDataPropertiesVeredasN['txtCertificacion'])) ? $arrayDataPropertiesVeredasN['txtCertificacion'] : null,
            'a17Municipio' => (isset($arrayDataPropertiesVeredasN['txtMunicipio'])) ? $arrayDataPropertiesVeredasN['txtMunicipio'] : null,
            'a17Vereda' => (isset($arrayDataPropertiesVeredasN['txtVereda'])) ? $arrayDataPropertiesVeredasN['txtVereda'] : null,
            'a17Predio' => (isset($arrayDataPropertiesVeredasN['txtPredio'])) ? $arrayDataPropertiesVeredasN['txtPredio'] : null,
            'a17OtroMun' => (isset($arrayDataPropertiesVeredasN['txtOtroMun'])) ? $arrayDataPropertiesVeredasN['txtOtroMun'] : null,
            'a17OtraVda' => (isset($arrayDataPropertiesVeredasN['txtOtraVda'])) ? $arrayDataPropertiesVeredasN['txtOtraVda'] : null,
            'a17OtroPredio' => (isset($arrayDataPropertiesVeredasN['txtOtroPredio'])) ? $arrayDataPropertiesVeredasN['txtOtroPredio'] : null,
        );
    }

    /* Insert info into table t17*/
    public function do_insert_veredasn() {
        try{
            $this->db->trans_start();
            $this->db->insert('t17web_nveredascertificaciones', $this->arrayPropertiesVeredasN);
            $this->db->trans_complete();
            return $this->db->trans_status();
        }catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /* Delete information for table t17 by certification code */
    public function do_delete_veredasn($code){
        try{
            $this->db->where("a17Certificacion", (int)$code);
            $this->db->delete('t17web_nveredascertificaciones');
            return true;
        } catch (Exception $exc){
            echo $exc->getTraceAsString();
        }
    }

}

?>
