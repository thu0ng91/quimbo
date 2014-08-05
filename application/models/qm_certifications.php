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
            'a14Codigo' => isset($arrayDataFromView['a14Codigo']) ? $arrayDataFromView['txtCodigo'] : null,
            'a14Identificador' => isset($arrayDataFromView['a14Identificador']) ? $arrayDataFromView['txtIdentificador'] : null,
            'a14FechaExpedicion' => isset($arrayDataFromView['a14FechaExpedicion']) ? $arrayDataFromView['txtFechaExpedicion'] : null,
            'a14MunicipioExpedicion' => isset($arrayDataFromView['a14MunicipioExpedicion']) ? $arrayDataFromView['txtMunicipioExpedicion'] : null,
            'a14VeredaCertificacion' => isset($arrayDataFromView['a14VeredaCertificacion']) ? $arrayDataFromView['txtVeredaCertificacion'] : null,
            'a14PredioCertificacion' => isset($arrayDataFromView['a14PredioCertificacion']) ? $arrayDataFromView['txtPredioCertificacion'] : null,
            'a14Cargo' => isset($arrayDataFromView['a14Cargo']) ? $arrayDataFromView['txtCargo'] : null,
            'a14FechaSuministrada' => isset($arrayDataFromView['a14FechaSuministrada']) ? $arrayDataFromView['txtFechaSuministrada'] : null,
            'a14FechaInicio' => isset($arrayDataFromView['a14FechaInicio']) ? $arrayDataFromView['txtFechaInicio'] : null,
            'a14FechaFin' => isset($arrayDataFromView['a14FechaFin']) ? $arrayDataFromView['txtFechaFin'] : null,
            'a14TipoPersonaJuridica' => isset($arrayDataFromView['a14TipoPersonaJuridica']) ? $arrayDataFromView['txtTipoPersonaJuridica'] : null,
            'a14NombrePersonaJuridica' => isset($arrayDataFromView['a14NombrePersonaJuridica']) ? $arrayDataFromView['txtNombrePersonaJuridica'] : null,
            'a14NITPersonaJuridica' => isset($arrayDataFromView['a14NITPersonaJuridica']) ? $arrayDataFromView['txtNITPersonaJuridica'] : null,
            'a14DocumentoIdentificacion' => isset($arrayDataFromView['a14DocumentoIdentificacion']) ? $arrayDataFromView['txtDocumentoIdentificacion'] : null,
            'a14NombreEmpresa' => isset($arrayDataFromView['a14NombreEmpresa']) ? $arrayDataFromView['txtNombreEmpresa'] : null,
            'a14NITEmpresa' => isset($arrayDataFromView['a14NITEmpresa']) ? $arrayDataFromView['txtNITEmpresa'] : null,
            'a14DescripcionRelacion' => isset($arrayDataFromView['a14DescripcionRelacion']) ? $arrayDataFromView['txtDescripcionRelacion'] : null,
            'a14ValoresCertificados' => isset($arrayDataFromView['a14ValoresCertificados']) ? $arrayDataFromView['txtValoresCertificados'] : null,
            'a14Unidades' => isset($arrayDataFromView['a14Unidades']) ? $arrayDataFromView['txtUnidades'] : null,
            'a14Cantidad' => isset($arrayDataFromView['a14Cantidad']) ? $arrayDataFromView['txtCantidad'] : null,
            'a14DescripcionUnidades' => isset($arrayDataFromView['a14DescripcionUnidades']) ? $arrayDataFromView['txtDescripcionUnidades'] : null,
            'a14DireccionCertificacion' => isset($arrayDataFromView['a14DireccionCertificacion']) ? $arrayDataFromView['txtDireccionCertificacion'] : null,
            'a14Zona' => isset($arrayDataFromView['a14Zona']) ? $arrayDataFromView['txtZona'] : null,
            'a14Barrio' => isset($arrayDataFromView['a14Barrio']) ? $arrayDataFromView['txtBarrio'] : null,
            'a14OtroMunicipio' => isset($arrayDataFromView['a14OtroMunicipio']) ? $arrayDataFromView['txtOtroMunicipio'] : null,
            'a14OtraVereda' => isset($arrayDataFromView['a14OtraVereda']) ? $arrayDataFromView['txtOtraVereda'] : null,
            'a14OtroPredio' => isset($arrayDataFromView['a14OtroPredio']) ? $arrayDataFromView['txtOtroPredio'] : null
        );
    }

    /*
     * Insert information into table t14web_certificaciones_detalle
     */

    public function do_insert() {
        try {
            $this->db->insert('t14web_certificaciones_detalle', $this->arrayProperties);
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Update information for the table t14web_certificaciones_detalle
     */

    public function do_update() {
        try {
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

    public function do_delete() {
        try {
            $this->db->where("a14Codigo", $this->arrayProperties["a14Codigo"]);
            $this->db->delete('t14web_certificaciones_detalle');
            return true;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Get information from table t14web_certificaciones_detalle by a14Codigo as Primary Key
     */

    public function get_DataTableByCode() {
        try {
            $this->db->where("a14Codigo", $this->arrayProperties["a14Codigo"]);
            $dataTable = $this->db->select('t14web_certificaciones_detalle');

            return $dataTable;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*
     * Get information from table t14web_certificaciones_detalle by a14Identificador
     */

    public function get_DataTableByForm() {
        try {
            $this->db->where("a14Identificador", $this->arrayProperties["a14Identificador"]);
            $dataTable = $this->db->select('t14web_certificaciones_detalle');

            return $dataTable;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>
