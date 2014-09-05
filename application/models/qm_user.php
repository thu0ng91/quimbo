<?php
/**
 * Archivo de la Clase QM_User
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
class QM_User extends CI_Model {
    /**
     * Constructor de la Clase
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Metodo get_account
     *
     * Metodo que Obtiene los Datos o Dato especifico de la
     * Cuenta de Usuario
     *
     * @param string $stROption Opcion a recuperar
     *
     * return mixed array|string
     */
    public function get_account($stROption = null) {
        $inRUserID = $this->session->userdata("inRUserID");

        $this->db->where("a01Codigo", $inRUserID);
        $SQLResult = $this->db->get("t01web_usuarios");
        $arrLAccount = $SQLResult->row_array();

        if (!is_null($stROption)) {
            return $arrLAccount[$stROption];
        }

        return $arrLAccount;
    }
    /**
     * Método do_login
     *
     * Método que Realiza la Verificacion de los Datos del Usuario
     *
     * @param string $stRUsername Nombre del Usuario
     * @param string $stRPassword Contraseña del Usuario
     * @return array
     */
    public function do_login($stRUsername, $stRPassword) {
        $SQLWhere = array(	"a01Usuario" => $stRUsername,
                            "a01Clave" => $stRPassword);

        $SQLResult = $this->db->get_where("t01web_usuarios", $SQLWhere);
        return $SQLResult->row_array();    
    }
    /**
     * Método get_answers
     *
     * Método que Obtiene los Datos del capitulo
     *
     * @return array
     */
    public function get_answers() {
        $inRFormID = $this->session->userdata("inRFormID");

        $this->db->where("a08Formulario", $inRFormID);
        $SQLResult = $this->db->get("t08web_usuario_respuestas");
        $arrLAnswers = $SQLResult->row_array();

        foreach ($arrLAnswers as $stLKey => $stLAnswer) {
            switch ($stLKey) {
                case "a08AP09O01":
                    $this->db->where("a12Codigo", $stLAnswer);
                    $SQLResult = $this->db->get("t12web_paises");
                    $arrLAnswer = $SQLResult->row_array();
                    $arrLAnswers[$stLKey] = $arrLAnswer["a12Nombre"];
                    break;
                case "a08AP03O01":
                case "a08AP09O02":
                    $this->db->where("a05Codigo", $stLAnswer);
                    $SQLResult = $this->db->get("t05web_departamentos");
                    $arrLAnswer = $SQLResult->row_array();
                    $arrLAnswers[$stLKey] = $arrLAnswer["a05Nombre"];
                    break;
                case "a08AP03O02":
                case "a08AP09O03":
                    $this->db->where("a06Codigo", $stLAnswer);
                    $SQLResult = $this->db->get("t06web_municipios");
                    $arrLAnswer = $SQLResult->row_array();
                    $arrLAnswers[$stLKey] = $arrLAnswer["a06Nombre"];
                    break;
                case "a08AP08O01":
                case "a08AP013":
                case "a08AP014O01":
                case "a08AP017":
                case "a08AP018O01":
                case "a08AP019O01":
                    if (!empty($stLAnswer)) {
                        $this->db->where("a04Codigo", $stLAnswer);
                        $SQLResult = $this->db->get("t04web_pregunta_respuestas");
                        $arrLAnswer = $SQLResult->row_array();
                        $arrLAnswers[$stLKey] = $arrLAnswer["a04Respuesta"];
                    }
                    break;
            }
        }

        return $arrLAnswers;
    }
}
