<?php
/**
 * Archivo de la Clase QM_Form
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
class QM_Form extends CI_Model {
    /**
     * Constructor de la Clase
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Metodo get_form
     *
     * Método que Obtiene los Datos del formulario
     *
     * @return string
     */
    public function get_form($inRFormID = null) {
        if (is_null($inRFormID)) {
            $inRFormID = $this->session->userdata("inRFormID");
        }

        $this->db->where("a07Codigo", $inRFormID);
        $this->db->join("t05web_departamentos", "a07Departamento = a05Codigo");
        $this->db->join("t06web_municipios", "a07Municipio = a06Codigo");
        $this->db->join("t08web_usuario_respuestas", "a07Codigo = a08Formulario", "LEFT");
        $SQLResult = $this->db->get("t07web_formularios");

        if ($SQLResult->num_rows() == 1) {
            $arrLForms = $SQLResult->row_array();
            $this->db->where("a09Formulario", $inRFormID);
            $this->db->where("a09Pregunta", "CP019");
            $this->db->select_sum("a09O02", "a07Folios");
            $SQLResult = $this->db->get("t09web_usuario_respuestasn");
            $arrLDocs = $SQLResult->row_array();

            if (is_null($arrLDocs["a07Folios"])) {
                $arrLDocs["a07Folios"] = 0;
            }

            $arrLForms["a07Folios"] = $arrLDocs["a07Folios"];

            $this->db->where("a09Formulario", $inRFormID);
            $SQLResult = $this->db->get("t09web_usuario_respuestasn");
            $arrLAnswersN = $SQLResult->result_array();
/*
            foreach ($arrLAnswersN as $inLKey => $arrLAnswerN) {
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O01"] = $arrLAnswerN["a09O01"];
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O02"] = $arrLAnswerN["a09O02"];
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O03"] = $arrLAnswerN["a09O03"];
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O04"] = $arrLAnswerN["a09O04"];
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O05"] = $arrLAnswerN["a09O05"];
                $arrLForms["a08".$arrLAnswerN["a09Pregunta"]."O06"] = $arrLAnswerN["a09O06"];
            }
*/
            return $arrLForms;
        }

        return false;
    }
    /**
     * Metodo get_chapters
     *
     * Método que Obtiene los Capitulos del Formulario
     *
     * @param string $stRChapter Letra del Capitulo
     * @return array
     */
    public function get_chapters($stRChapter = null) {
        if (!is_null($stRChapter)) {
            $this->db->where("a02Letra", $stRChapter);
        }

        $SQLResult = $this->db->get("t02web_capitulos");

        if (!is_null($stRChapter)) {
            $arrLChapter = $SQLResult->row_array();
            $arrLChapter["a02Siguiente"] = $this->get_next_chapter($arrLChapter["a02Codigo"]);
            $arrLChapter["arrRQuestions"] = $this->get_questions($stRChapter, $arrLChapter["a02Codigo"]);

            return $arrLChapter;
        }

        return $SQLResult->result_array();
    }

    /* Obtener archivos relacionados con la certificacion*/
    public function get_CertFiles($code){
        try {
            //Generamos el query
            $query = $this->db->query("SELECT * FROM t18web_scanner WHERE a18codigo = '$code' ORDER BY a18TipoArchivo DESC" );
            $dataArray = $query->result();
            return $dataArray;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    }

    /**
     * Metodo get_next_chapter
     *
     * Método que Obtiene el Proximo Capitulo
     *
     * @param string $inRChapter ID del Capitulo
     * @return string
     */
    public function get_next_chapter($inRChapter) {
        if (is_numeric($inRChapter)) {
            $this->db->where("a02Codigo", ++$inRChapter);
        }
        else {
            $this->db->where("a02Letra", ++$inRChapter);
        }

        $SQLResult = $this->db->get("t02web_capitulos");
        $arrLNextChapter = $SQLResult->row_array();

        if ($SQLResult->num_rows() == 1) {
            return $arrLNextChapter["a02Letra"];
        }
    }
    /**
     * Metodo get_search
     *
     * Método que Obtiene los datos de la busqueda
     *
     * @return array|boolean
     */
    public function get_search() {
        $inRSearch = $this->session->userdata("inRSearch");

        if (is_numeric($inRSearch)) {
            $this->db->where("a11Codigo", $inRSearch);
            $SQLResult = $this->db->get("t11web_busqueda");

            if ($SQLResult->num_rows() == 1) {
                $arrLSearch = $SQLResult->row_array();

                print_r($arrLSearch);

                $arrLResult["a08AP01"] = $arrLSearch["a11Nombres"];
                $arrLResult["a08AP02"] = $arrLSearch["a11Apellidos"];
                $arrLResult["a08AP03O02"] = $arrLSearch["a11Lugar"];
                $arrLResult["a08AP04"] = $arrLSearch["a11Direccion"];
                $arrLResult["a08AP06"] = $arrLSearch["a11Telefono"];
                $arrLResult["a08AP08O01"] = $arrLSearch["a11TipoDoc"];
                $arrLResult["a08AP08O02"] = $arrLSearch["a11NoDoc"];
                $arrLResult["a08AP013"] = $arrLSearch["a11Sexo"];
                $arrLResult["a08AP014O01"] = $arrLSearch["a11EstadoCivil"];
                $arrLResult["a08Formulario"] = $arrLSearch["a08Formulario"];

                return $arrLResult;
            }
        }
        else {
            $this->session->set_userdata("bolRIsNewFormat", true);
            $this->session->set_userdata("inRFormID", $inRSearch);
            return $this->get_form($inRSearch);
        }

        return false;
    }
    /**
     * Metodo get_next_chapter
     *
     * Método que Obtiene las Preguntas del Capitulo
     *
     * @param string $inRChapter ID del Capitulo
     * @return string
     */
    public function get_questions($stRChapter, $inRChapter) {
        $arrLQuestions = array();
        $this->db->order_by("a03Numero, a03Posicion");
        $this->db->where("a03Capitulo", $inRChapter);
        $SQLResult = $this->db->get("t03web_capitulo_preguntas");
        $arrLAllQuestions = $SQLResult->result_array();

        foreach ($arrLAllQuestions as $inLKey => $arrLQuestion) {
            $stLInput = "TxtForm".$stRChapter."P0".$arrLQuestion["a03Numero"];
            $stLField = "a08".$stRChapter."P0".$arrLQuestion["a03Numero"];
            $arrLQuestion["a03Input"] = $stLInput;
            $arrLQuestion["a03Field"] = $stLField;

            if ($arrLQuestion["a03Tipo"] == "C" || $arrLQuestion["a03Tipo"] == "M") {
                $this->db->where("a04Pregunta", $arrLQuestion["a03Codigo"]);
                $SQLResult = $this->db->get("t04web_pregunta_respuestas");
                $arrLQuestion["arrRAnswers"] = $SQLResult->result_array();
            }
            if (is_null($arrLQuestion["a03Posicion"])) {
                $arrLQuestions[$arrLQuestion["a03Numero"]] = $arrLQuestion;
            }
            else {
                $arrLQuestion["a03Input"] .= "O0".$arrLQuestion["a03Posicion"];
                $arrLQuestion["a03Field"] .= "O0".$arrLQuestion["a03Posicion"];
                $arrLQuestions[$arrLQuestion["a03Numero"]][$arrLQuestion["a03Posicion"]] = $arrLQuestion;
            }

        }

        return $arrLQuestions;
    }
    /**
     * Método get_uuid
     *
     * Método que Obtiene un UUID de MySQL
     *
     * @return string
     */
    private function _get_uuid() {
        $SQLResult = $this->db->query("SELECT UUID() as a07Codigo");
        $arrLCode = $SQLResult->row_array();

        return $arrLCode["a07Codigo"];
    }
    
    /**
     * Método get_uuid
     *
     * Método que Obtiene un UUID de MySQL
     *
     * @return string
     */
    public function get_files($codeForm) {
        $SQLResult = $this->db->query("SELECT a13Identificador, a13Tipo, a13Documento FROM t13web_usuario_docs WHERE a13Identificador = '$codeForm'");
        $dataArray = $SQLResult->result();

        return $dataArray;
    }

    /*Metodo get_pqr
        metodo que obtiene los pqr por numero de cedula*/
    public function get_pqr($cedula){
    try {
            //Generamos el query
        $SQLResult = $this->db->query("SELECT año, tipo, path, radicado FROM t21web_pqr WHERE cedula = '$cedula'");
        //$SQLResult = $this->db->query("SELECT numero_proceso, temas, path FROM t19web_tutelas WHERE cedula = '$cedula'");
        $dataArray = $SQLResult->result();

        return $dataArray;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /*Metodo get_tutelas
      metodo que obtiene las tutelas por numero de cedula*/
      public function get_tutelas($cedula){
        $SQLResult = $this->db->query("SELECT numero_proceso, temas, path FROM t19web_tutelas WHERE cedula = '$cedula'");
        $dataArray = $SQLResult->result();

        return $dataArray;
      }

    /**
     * Método do_search
     *
     * Método que Busca los Datos principales del formulario
     * y/o persona
     *
     * @param array $arrRFormData Datos del formulario
     * @return array
     */
    public function do_search($arrRFormData) {
        $arrLResponse = array("found" => false);
        $arrLResults = array();

        /*Busqueda general*/
        /*Busqueda por numero de form*/

        if (!empty($arrRFormData["TxtFormNo"])) {
            // if (strlen($arrRFormData["TxtFormNo"]) <= 7) {

            //     $this->db->where("a11Encuesta", $arrRFormData["TxtFormNo"]);
            //     $SQLResult = $this->db->get("t11web_busqueda");

            //                     if ($SQLResult->num_rows() > 0) {
            //         $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            //     }

            //     $this->db->where("a07Identificador", $arrRFormData["TxtFormNo"]);
            //     $SQLResult = $this->db->get("t07web_formularios");

            //     if ($SQLResult->num_rows() > 0) {
            //         $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            //     }

            // }
            // else {
            //     $this->db->where("a07Codigo", $arrRFormData["TxtFormNo"]);
            //     $this->db->join("t08web_usuario_respuestas", "a07Codigo = a08Formulario");
            //     $SQLResult = $this->db->get("t07web_formularios");

            //     if ($SQLResult->num_rows() > 0) {
            //         $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            //     }
            // }
            
            $SQLResult = $this->db->query("SELECT * FROM v01web_union_busqueda where form = '$arrRFormData[TxtFormNo]' ");
            $SQLDT = $SQLResult->result();

            if (sizeof($SQLDT) > 0) {
                $arrLResults = array_merge($arrLResults, $SQLDT);
            }

        }

        /*Busqueda por documento de identificacion*/

        if (!empty($arrRFormData["TxtPersonIdentity"])) {
            // $this->db->select("t11web_busqueda.*");
            // $this->db->where("a11NoDoc", $arrRFormData["TxtPersonIdentity"]);
            // $this->db->join("t08web_usuario_respuestas", "a11NoDoc != a08AP08O02");
            // $this->db->group_by("a11Encuesta");
            // $SQLResult = $this->db->get("t11web_busqueda");

            // if ($SQLResult->num_rows() > 0) {
            //     $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            // }

            // $this->db->where("a08AP08O02", $arrRFormData["TxtPersonIdentity"]);
            // $this->db->join("t07web_formularios", "a07Codigo = a08Formulario");
            // $SQLResult = $this->db->get("t08web_usuario_respuestas");

            // if ($SQLResult->num_rows() > 0) {
            //     $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            // }

            $SQLResult = $this->db->query("SELECT * FROM v01web_union_busqueda where cc = '$arrRFormData[TxtPersonIdentity]' ");
            $SQLDT = $SQLResult->result();

            if (sizeof($SQLDT) > 0) {
                $arrLResults = array_merge($arrLResults, $SQLDT);
            }

        }

        /*Busqueda por nombres/apellidos*/

        if (!empty($arrRFormData["TxtPersonName"])) {
            // $this->db->select("t11web_busqueda.*");
            // $this->db->join("t08web_usuario_respuestas", "a11NoDoc != a08AP08O02");
            // $this->db->like("a11Nombres", $arrRFormData["TxtPersonName"]);
            // $this->db->or_like("a11Apellidos", $arrRFormData["TxtPersonName"]);
            // $this->db->group_by("a11NoDoc");
            // $SQLResult = $this->db->get("t11web_busqueda");

            // if ($SQLResult->num_rows() > 0) {
            //     $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            // }

            // $this->db->like("a08AP01", $arrRFormData["TxtPersonName"]);
            // $this->db->or_like("a08AP02", $arrRFormData["TxtPersonName"]);
            // $this->db->join("t07web_formularios", "a07Codigo = a08Formulario");
            // $SQLResult = $this->db->get("t08web_usuario_respuestas");

            // if ($SQLResult->num_rows() > 0) {
            //     $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            // }
            
            //$SQLResult = $this->db->query("SELECT * FROM v01web_union_busqueda where nombresapellidos = '$arrRFormData[TxtPersonName]' ");
            $SQLResult = $this->db->query("SELECT * FROM v01web_union_busqueda where nombresapellidos like('%".str_replace(" ", "%') OR nombresapellidos LIKE('%", $arrRFormData["TxtPersonName"])."%')");
            $SQLDT = $SQLResult->result();

            if (sizeof($SQLDT) > 0) {
                $arrLResults = array_merge($arrLResults, $SQLDT);
            }

        }

        if (count($arrLResults) > 0) {
            $arrLResponse["found"] = true;
            $arrLResponse["results"] = $arrLResults;
        }

        return $arrLResponse;
    }
    /**
     * Método do_form
     *
     * Método que Guarda los Datos principales del formulario
     *
     * @param array $arrRFormData Datos del formulario
     * @return array
     */
    public function do_form($arrRFormData) {
        $inRUserID = $this->session->userdata("inRUserID");
        $inLSearch = null;

        if ($this->session->userdata("inRSearch")) {
            $inLSearch = $this->session->userdata("inRSearch");
        }

        $stLCode = $this->_get_uuid();
        $this->session->set_userdata("inRFormID", $stLCode);

        $arrLForm = array(  "a07Codigo" => $stLCode,
                            "a07Usuario" => $inRUserID,
                            "a07Departamento" => $arrRFormData["TxtFormState"],
                            "a07Municipio" => $arrRFormData["TxtFormTown"],
                            "a07Busqueda" => $inLSearch,
                            "a07Aplica" => date("Y-m-d", strtotime($arrRFormData["TxtFormDate"])),
                            "a07Lugar" => $arrRFormData["TxtFormPlace"],
                            "a07Fecha" => date("Y-m-d H:i:s"),
                            "a07Estado" => "P");

        $this->db->trans_start();
        $this->db->insert("t07web_formularios", $arrLForm);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    /**
     * Método do_chapter
     *
     * Método que Guarda los Datos del capitulo
     *
     * @param array $arrRFormData Datos del capitulo
     * @return array
     */
    public function do_chapter($arrRFormData) {
        $inRFormID = $this->session->userdata("inRFormID");
        $arrLChaptersN = array();
        $arrLChapterN = array();

        if ($this->session->userdata("inRSearch") &&
                !$this->session->userdata("bolRIsNewFormat")) {
            $arrLFormData = array(  "TxtFormNo" => $this->session->userdata("inRSearch"),
                                    "TxtFormState" => $arrRFormData["TxtFormAP03O01"],
                                    "TxtFormTown" => $arrRFormData["TxtFormAP03O02"],
                                    "TxtFormDate" => date("Y-m-d H:i:s"),
                                    "TxtFormPlace" => "N/A");
            $this->do_form($arrLFormData);
            $inRFormID = $this->session->userdata("inRFormID");
        }

        if ($arrRFormData["TxtChapter"] == "A") {
            if (!$this->session->userdata("bolRIsNewFormat")) {
                $stLCode = $this->_get_uuid();
                $bolLInsert = true;
                $arrLChapter = array(   "a08Codigo" => $stLCode,
                                        "a08Formulario" => $inRFormID,
                                        "a08Fecha" => date("Y-m-d H:i:s"),
                                        "a08Estado" => "P");
            }
            else {
                $bolLInsert = false;
            }
        }
        else {
            $arrLChapter = array();
            $bolLInsert = false;
        }

        foreach ($arrRFormData as $stRKey => $stLData) {
            if (strpos($stRKey, "TxtForm") !== false &&
                    strpos($stRKey, "BP08") === false && strpos($stRKey, "CP08") === false &&
                    strpos($stRKey, "CP018") === false && strpos($stRKey, "CP019") === false &&
                    strpos($stRKey, "CP09O02") === false && strpos($stRKey, "CP015O01") === false) {
                $stLKey = str_replace("TxtForm", "a08", $stRKey);
                $arrLChapter[$stLKey] = trim($stLData);
            }
            else if (strpos($stRKey, "BP08") !== false) {
                $arrLData = $stLData;                
                
                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = str_replace("TxtFormBP08", "a09", $stRKey);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[$inLNKey][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[$inLNKey]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[$inLNKey]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[$inLNKey]["a09Estado"] = "P";
                        $arrLChapterN[$inLNKey]["a09Pregunta"] = "BP08";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["BP08"] = $arrLChapterN;
                }
            }
            else if (strpos($stRKey, "CP08") !== false) {
                $arrLData = $stLData;

                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = str_replace("TxtFormCP08", "a09", $stRKey);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[$inLNKey][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[$inLNKey]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[$inLNKey]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[$inLNKey]["a09Estado"] = "P";
                        $arrLChapterN[$inLNKey]["a09Pregunta"] = "CP08";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["CP08"] = $arrLChapterN;
                }
            }
            else if (strpos($stRKey, "CP018") !== false) {
                $arrLData = $stLData;

                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = str_replace("TxtFormCP018", "a09", $stRKey);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[$inLNKey][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[$inLNKey]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[$inLNKey]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[$inLNKey]["a09Estado"] = "P";
                        $arrLChapterN[$inLNKey]["a09Pregunta"] = "CP018";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["CP018"] = $arrLChapterN;
                }
            }
            else if (strpos($stRKey, "CP019") !== false) {
                $arrLData = $stLData;
                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = str_replace("TxtFormCP019", "a09", $stRKey);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[$inLNKey][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[$inLNKey]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[$inLNKey]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[$inLNKey]["a09Estado"] = "P";
                        $arrLChapterN[$inLNKey]["a09Pregunta"] = "CP019";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["CP019"] = $arrLChapterN;
                }
            }
            else if (strpos($stRKey, "CP09O02") !== false) {
                $arrLData = $stLData;

                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = "a09O0".($inLNKey + 1);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[0][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[0]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[0]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[0]["a09Estado"] = "P";
                        $arrLChapterN[0]["a09Pregunta"] = "CP09";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["CP09"] = $arrLChapterN;
                }
            }
            else if (strpos($stRKey, "CP015O01") !== false) {
                $arrLData = $stLData;

                foreach ($arrLData as $inLNKey => $stLNData) {
                    $stLBNKey = "a09O0".($inLNKey + 1);
                    $stLTrimData = trim($stLNData);

                    if (!empty($stLTrimData)) {
                        $arrLChapterN[0][$stLBNKey] = trim($stLNData);
                        $arrLChapterN[0]["a09Formulario"] = $inRFormID;
                        $arrLChapterN[0]["a09Fecha"] = date("Y-m-d H:i:s");
                        $arrLChapterN[0]["a09Estado"] = "P";
                        $arrLChapterN[0]["a09Pregunta"] = "CP015";
                    }
                }

                if (isset($arrLChapterN)) {
                    $arrLChaptersN["CP015"] = $arrLChapterN;
                }
            }
        }

        $this->db->trans_start();

        if ($bolLInsert) {
            $this->db->insert("t08web_usuario_respuestas", $arrLChapter);
        }
        else {
            $arrLUpdate = array("a08Formulario" => $inRFormID);
            $this->db->update("t08web_usuario_respuestas", $arrLChapter, $arrLUpdate);
        }
        if (isset($arrLChaptersN)) {
            foreach ($arrLChaptersN as $arrLChapterN) {
                foreach ($arrLChapterN as $arrLChapter) {
                    $this->db->insert("t09web_usuario_respuestasn", $arrLChapter);
                }
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    /**
     * Método do_finish
     *
     * Método que Guarda los Datos finales del formulario
     *
     * @param array $arrRFormData Datos del formulario
     * @return array
     */
    public function do_finish($arrRFormData) {
        $inRFormID = $this->session->userdata("inRFormID");
        $arrLForm = array(  "a07CodigoBarras" => $arrRFormData["TxtBarCode"]);

        if (!empty($arrRFormData["TxtFormVideo"])) {
            $arrLForm["a07Video"] = $arrRFormData["TxtFormVideo"];
        }
        if (!empty($arrRFormData["TxtFormImage"])) {
            $arrLForm["a07Imagen"] = $arrRFormData["TxtFormImage"];
        }

        $this->db->trans_start();
        $this->db->where("a07Codigo", $inRFormID);
        $this->db->update("t07web_formularios", $arrLForm);
        $this->db->trans_complete();

        //$this->do_sync();

        return $this->db->trans_status();
    }
    /**
     * Método do_finish
     *
     * Método que Guarda los Datos finales del formulario
     *
     * @param array $arrRFormData Datos del formulario
     * @return array
     */
    public function do_uploads($arrRFiles) {
        $this->db->trans_start();

        foreach ($arrRFiles as $arrLFile) {
            $this->db->where("a13Identificador", $arrLFile["a13Identificador"]);
            $this->db->where("a13Tipo", $arrLFile["a13Tipo"]);
            $this->db->from("t13web_usuario_docs");

            if ($this->db->count_all_results() >= 1) {
                $SQLWhere = array(  "a13Identificador" => $arrLFile["a13Identificador"],
                                    "a13Tipo" => $arrLFile["a13Tipo"]);

                $this->db->update("t13web_usuario_docs", $arrLFile, $SQLWhere);
            }
            else {
                $this->db->insert("t13web_usuario_docs", $arrLFile);
            }
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }
    /**
     * Método do_sync
     *
     * Método que Sincroniza los formularios
     *
     * @return array
     */
    public function do_sync($bolRFiles = false) {
        $objLSync = $this->load->database("sync", true);
        $bolLConnect = $objLSync->initialize();
        $arrLResponse = array();

        if ($bolLConnect) {
            $this->db->trans_start();
            $objLSync->trans_start();

            $this->db->where("a07Estado", "P");
            $SQLResult = $this->db->get("t07web_formularios");
            $inLForms = 0;
            $inLFiles = 0;

            if ($SQLResult->num_rows() > 0) {
                $arrLFormsToSync = $SQLResult->result_array();

                foreach ($arrLFormsToSync as $arrLFormToSync) {
                    $bolLSyncForm = $objLSync->insert("t07web_formularios", $arrLFormToSync);

                    if ($bolLSyncForm) {
                        $inLForms++;
                        $arrLUpdateForm = array("a07Estado" => "S");
                        $this->db->update("t07web_formularios", $arrLUpdateForm, $arrLFormToSync);
                        $objLSync->update("t07web_formularios", $arrLUpdateForm, $arrLFormToSync);
                    }
                    if ($bolRFiles) {
                        if ($this->do_upload($arrLFormToSync["a07Imagen"])) {
                            $inLFiles++;
                        }
                        if (!empty($arrLFormToSync["a07Video"]) && $this->do_upload($arrLFormToSync["a07Video"])) {
                            $inLFiles++;
                        }
                    }
                }
            }

            $this->db->where("a08Estado", "P");
            $SQLResult = $this->db->get("t08web_usuario_respuestas");
            $inLAnswers = 0;

            if ($SQLResult->num_rows() > 0) {
                $arrLAnswersToSync = $SQLResult->result_array();

                foreach ($arrLAnswersToSync as $arrLAnswerToSync) {
                    $bolLSyncAnswers = $objLSync->insert("t08web_usuario_respuestas", $arrLAnswerToSync);

                    if ($bolLSyncAnswers) {
                        $inLAnswers++;
                        $arrLUpdateAnswers = array("a08Estado" => "S");
                        $this->db->update("t08web_usuario_respuestas", $arrLUpdateAnswers, $arrLAnswerToSync);
                        $objLSync->update("t08web_usuario_respuestas", $arrLUpdateAnswers, $arrLAnswerToSync);
                    }
                }
            }

            $this->db->where("a09Estado", "P");
            $SQLResult = $this->db->get("t09web_usuario_respuestasn");
            $inLAnswersN = 0;

            if ($SQLResult->num_rows() > 0) {
                $arrLAnswersNToSync = $SQLResult->result_array();

                foreach ($arrLAnswersNToSync as $arrLAnswerNToSync) {
                    $bolLSyncAnswersN = $objLSync->insert("t09web_usuario_respuestasn", $arrLAnswerNToSync);

                    if ($bolLSyncAnswersN) {
                        $inLAnswersN++;
                        $arrLUpdateAnswersN = array("a09Estado" => "S");
                        $this->db->update("t09web_usuario_respuestasn", $arrLUpdateAnswersN, $arrLAnswerNToSync);
                        $objLSync->update("t09web_usuario_respuestasn", $arrLUpdateAnswersN, $arrLAnswerNToSync);
                    }
                }
            }

            $objLSync->where("a01Sincro", "P");
            $SQLResult = $objLSync->get("t01web_usuarios");
            $inLUsers = 0;

            if ($SQLResult->num_rows() > 0) {
                $arrLUsersToSync = $SQLResult->result_array();

                foreach ($arrLUsersToSync as $arrLUserToSync) {
                    $this->db->where("a01Codigo", $arrLUserToSync["a01Codigo"]);
                    $SQLResult = $this->db->get("t01web_usuarios");

                    if ($SQLResult->num_rows() == 0) {
                        $bolLSyncUsers = $this->db->insert("t01web_usuarios", $arrLUserToSync);

                        if ($bolLSyncUsers) {
                            $inLUsers++;
                            $arrLUpdateUsers = array("a01Sincro" => "S");
                            $this->db->update("t01web_usuarios", $arrLUpdateUsers, $arrLUserToSync);
                            $objLSync->update("t01web_usuarios", $arrLUpdateUsers, $arrLUserToSync);
                        }
                    }
                }
            }

            $arrLResponse["forms"] = $inLForms;
            $arrLResponse["answers"] = $inLAnswers;
            $arrLResponse["answers-n"] = $inLAnswersN;
            $arrLResponse["users"] = $inLUsers;
            $arrLResponse["ftp"] = $inLFiles;

            $this->db->trans_complete();
            $objLSync->trans_complete();

            return $arrLResponse;
        }

        return $bolLConnect;
    }
    /**
     * Método do_upload
     *
     * Método que Sincroniza los archivos
     *
     * @return array
     */
    public function do_upload($stRFile) {
        $this->load->library("ftp");
        $this->ftp->connect();

        if (!empty($stRFile) && file_exists("public/uploads/".$stRFile)) {
            $this->ftp->upload(FCPATH."public/uploads/".$stRFile, $stRFile);
        }

        $this->ftp->close();

        return true;
    }
}