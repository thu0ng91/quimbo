<?php
/**
 * Archivo de la Clase QM_API
 *
 * Recupera Datos de la Base de Datos
 *
 * @category    Application
 * @package     Models
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       File available since Release 1.0
 * @author      Alvaro Montenegro <arthvrian@yahoo.com>
 * @link        http://www.arthvrian.org/
 */
/**
 * Realiza las labores de Consulta de los
 * a la Base de Datos
 *
 * @category    Application
 * @package     Models
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       Class available since Release 1.0
 * @author      Alvaro Montenegro <arthvrian@yahoo.com>
 * @link        http://www.arthvrian.org/
 */
class QM_API extends CI_Model {
    /**
     * Constructor de la Clase
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Metodo get_countries
     *
     * Método que Obtiene los Paises
     *
     * @return array
     */
    public function get_countries($bolRActive = false) {
        if ($bolRActive) {
            $this->db->where("a12Estado", "A");
        }

        $SQLResult = $this->db->get("t12web_paises");

        return $SQLResult->result_array();
    }
    /**
     * Metodo get_states
     *
     * Método que Obtiene los Departamentos
     *
     * @return array
     */
    public function get_states($bolRActive = false) {
        if ($bolRActive) {
            $this->db->where("a05Estado", "A");
        }

        $SQLResult = $this->db->get("t05web_departamentos");

        return $SQLResult->result_array();
    }
    /**
     * Metodo get_towns
     *
     * Método que Obtiene los Municipios para el
     * Departamento solicitado
     *
     * @param string $inRState ID del Departamento
     * @return array
     */
    public function get_towns($inRState, $bolRActive) {
        if ($bolRActive) {
            $this->db->where("a06Estado", "A");
        }

        $this->db->where("a06Departamento", $inRState);
        $SQLResult = $this->db->get("t06web_municipios");

        return $SQLResult->result_array();
    }
    /**
     * Metodo get_cities
     *
     * Método que Obtiene las Veredas para el
     * Municipio solicitado
     *
     * @param string $inRTown ID del Municipio
     * @return array
     */
    public function get_cities($inRTown, $bolRActive) {
        if ($bolRActive) {
            $this->db->where("a10Estado", "A");
        }

        $this->db->where("a10Municipio", $inRTown);
        $SQLResult = $this->db->get("t10web_veredas");

        return $SQLResult->result_array();
    }
    
    /**
     * Metodo get_locations
     *
     * Método que Obtiene los predios para la
     * Vereda solicitada
     *
     * @param string $inRTown ID de la vereda
     * @return array
     */
    public function get_locations($inRTown, $bolRActive) {
        if ($bolRActive) {
            $this->db->where("a15Estado", "A");
        }

        $this->db->where("a15Vereda", $inRTown);
        $SQLResult = $this->db->get("t15web_predios");

        return $SQLResult->result_array();
    }
}