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
        $this->db->join("t05web_Departamentos", "a07Departamento = a05Codigo");
        $this->db->join("t06web_Municipios", "a07Municipio = a06Codigo");
        $this->db->join("t08web_Usuario_Respuestas", "a07Codigo = a08Formulario", "LEFT");
        $SQLResult = $this->db->get("t07web_Formularios");

        if ($SQLResult->num_rows() == 1) {
            $arrLForms = $SQLResult->row_array();
            $this->db->where("a09Formulario", $inRFormID);
            $this->db->where("a09Pregunta", "CP019");
            $this->db->select_sum("a09O02", "a07Folios");
            $SQLResult = $this->db->get("t09web_Usuario_RespuestasN");
            $arrLDocs = $SQLResult->row_array();
            $arrLForms["a07Folios"] = $arrLDocs["a07Folios"];

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

        $SQLResult = $this->db->get("t02web_Capitulos");

        if (!is_null($stRChapter)) {
            $arrLChapter = $SQLResult->row_array();
            $arrLChapter["a02Siguiente"] = $this->get_next_chapter($arrLChapter["a02Codigo"]);
            $arrLChapter["arrRQuestions"] = $this->get_questions($stRChapter, $arrLChapter["a02Codigo"]);

            return $arrLChapter;
        }

        return $SQLResult->result_array();
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

        $SQLResult = $this->db->get("t02web_Capitulos");
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

        $this->db->where("a11Codigo", $inRSearch);
        $SQLResult = $this->db->get("t11web_Busqueda");

        if ($SQLResult->num_rows() == 1) {
            $arrLSearch = $SQLResult->row_array();

            $arrLResult["TxtFormAP01"] = $arrLSearch["a11Nombres"];
            $arrLResult["TxtFormAP02"] = $arrLSearch["a11Apellidos"];
            $arrLResult["TxtFormAP03O02"] = $arrLSearch["a11Lugar"];
            $arrLResult["TxtFormAP04"] = $arrLSearch["a11Direccion"];
            $arrLResult["TxtFormAP06"] = $arrLSearch["a11Telefono"];
            $arrLResult["TxtFormAP08O01"] = $arrLSearch["a11TipoDoc"];
            $arrLResult["TxtFormAP08O02"] = $arrLSearch["a11NoDoc"];
            $arrLResult["TxtFormAP013"] = $arrLSearch["a11Sexo"];
            $arrLResult["TxtFormAP014O01"] = $arrLSearch["a11EstadoCivil"];

            return $arrLResult;
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
        $SQLResult = $this->db->get("t03web_Capitulo_Preguntas");
        $arrLAllQuestions = $SQLResult->result_array();

        foreach ($arrLAllQuestions as $inLKey => $arrLQuestion) {
            $stLInput = "TxtForm".$stRChapter."P0".$arrLQuestion["a03Numero"];
            $arrLQuestion["a03Input"] = $stLInput;

            if ($arrLQuestion["a03Tipo"] == "C" || $arrLQuestion["a03Tipo"] == "M") {
                $this->db->where("a04Pregunta", $arrLQuestion["a03Codigo"]);
                $SQLResult = $this->db->get("t04web_Pregunta_Respuestas");
                $arrLQuestion["arrRAnswers"] = $SQLResult->result_array();
            }
            if (is_null($arrLQuestion["a03Posicion"])) {
                $arrLQuestions[$arrLQuestion["a03Numero"]] = $arrLQuestion;
            }
            else {
                $arrLQuestion["a03Input"] .= "O0".$arrLQuestion["a03Posicion"];
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

        if (!empty($arrRFormData["TxtFormNo"])) {
            if (strlen($arrRFormData["TxtFormNo"]) <= 7) {
                $this->db->where("a11Encuesta", $arrRFormData["TxtFormNo"]);
                $SQLResult = $this->db->get("t11web_Busqueda");

                if ($SQLResult->num_rows() > 0) {
                    $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
                }

                $this->db->where("a07Identificador", $arrRFormData["TxtFormNo"]);
                $SQLResult = $this->db->get("t07web_Formularios");

                if ($SQLResult->num_rows() > 0) {
                    $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
                }
            }
            else {
                $this->db->where("a07Codigo", $arrRFormData["TxtFormNo"]);
                $this->db->join("t08web_Usuario_Respuestas", "a07Codigo = a08Formulario");
                $SQLResult = $this->db->get("t07web_Formularios");

                if ($SQLResult->num_rows() > 0) {
                    $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
                }
            }
        }
        if (!empty($arrRFormData["TxtPersonIdentity"])) {
            $this->db->where("a11NoDoc", $arrRFormData["TxtPersonIdentity"]);
            $SQLResult = $this->db->get("t11web_Busqueda");

            if ($SQLResult->num_rows() > 0) {
                $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            }

            $this->db->where("a08AP08O02", $arrRFormData["TxtPersonIdentity"]);
            $this->db->join("t07web_Formularios", "a07Codigo = a08Formulario");
            $SQLResult = $this->db->get("t08web_Usuario_Respuestas");

            if ($SQLResult->num_rows() > 0) {
                $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            }
        }
        if (!empty($arrRFormData["TxtPersonName"])) {
            $this->db->select("t11web_Busqueda.*");
            $this->db->join("t08web_Usuario_Respuestas", "a11nodoc != a08ap08o02");
            $this->db->like("a11Nombres", $arrRFormData["TxtPersonName"]);
            $this->db->or_like("a11Apellidos", $arrRFormData["TxtPersonName"]);
            $this->db->group_by("a11NoDoc");
            $SQLResult = $this->db->get("t11web_Busqueda");

            if ($SQLResult->num_rows() > 0) {
                $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
            }

            $this->db->like("a08AP01", $arrRFormData["TxtPersonName"]);
            $this->db->or_like("a08AP02", $arrRFormData["TxtPersonName"]);
            $this->db->join("t07web_Formularios", "a07Codigo = a08Formulario");
            $SQLResult = $this->db->get("t08web_Usuario_Respuestas");

            if ($SQLResult->num_rows() > 0) {
                $arrLResults = array_merge($arrLResults, $SQLResult->result_array());
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

        $arrLForm = array(	"a07Codigo" => $stLCode,
                            "a07Usuario" => $inRUserID,
                            "a07Departamento" => $arrRFormData["TxtFormState"],
                            "a07Municipio" => $arrRFormData["TxtFormTown"],
                            "a07Busqueda" => $inLSearch,
                            "a07Aplica" => date("Y-m-d", strtotime($arrRFormData["TxtFormDate"])),
                            "a07Lugar" => $arrRFormData["TxtFormPlace"],
                            "a07Fecha" => date("Y-m-d H:i:s"),
                            "a07Estado" => "P");

        $this->db->trans_start();
        $this->db->insert("t07web_Formularios", $arrLForm);
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

        if ($this->session->userdata("inRSearch")) {
            $arrLFormData = array(	"TxtFormNo" => $this->session->userdata("inRSearch"),
                                    "TxtFormState" => $arrRFormData["TxtFormAP03O01"],
                                    "TxtFormTown" => $arrRFormData["TxtFormAP03O02"],
                                    "TxtFormDate" => date("Y-m-d H:i:s"),
                                    "TxtFormPlace" => "N/A");
            $this->do_form($arrLFormData);
            $inRFormID = $this->session->userdata("inRFormID");
        }

        if ($arrRFormData["TxtChapter"] == "A") {
            $stLCode = $this->_get_uuid();
            $bolLInsert = true;

            $arrLChapter = array(	"a08Codigo" => $stLCode,
                                    "a08Formulario" => $inRFormID,
                                    "a08Fecha" => date("Y-m-d H:i:s"),
                                    "a08Estado" => "P");
        }
        else {
            $arrLChapter = array();
            $bolLInsert = false;
        }

        foreach ($arrRFormData as $stRKey => $stLData) {
            if (strpos($stRKey, "TxtForm") !== false &&
                    strpos($stRKey, "BP08") === false && strpos($stRKey, "CP08") === false &&
                    strpos($stRKey, "CP018") === false && strpos($stRKey, "CP019") === false) {
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
        }

        $this->db->trans_start();

        if ($bolLInsert) {
            $this->db->insert("t08web_Usuario_Respuestas", $arrLChapter);
        }
        else {
            $arrLUpdate = array("a08Formulario" => $inRFormID);
            $this->db->update("t08web_Usuario_Respuestas", $arrLChapter, $arrLUpdate);
        }
        if (isset($arrLChaptersN)) {
            foreach ($arrLChaptersN as $arrLChapterN) {
                foreach ($arrLChapterN as $arrLChapter) {
                    $this->db->insert("t09web_Usuario_RespuestasN", $arrLChapter);
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
        $arrLForm = array(	"a07Video" => $arrRFormData["TxtFormVideo"],
                            "a07Imagen" => $arrRFormData["TxtFormImage"]);

        $this->db->trans_start();
        $this->db->where("a07Codigo", $inRFormID);
        $this->db->update("t07web_Formularios", $arrLForm);
        $this->db->trans_complete();

        $this->do_sync();

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
            $this->db->where("a07Estado", "P");
            $SQLResult = $this->db->get("t07web_Formularios");
            $arrLFormsToSync = $SQLResult->result_array();
            $inLForms = 0;
            $inLFiles = 0;

            foreach ($arrLFormsToSync as $arrLFormToSync) {
                $bolLSyncForm = $objLSync->insert("t07web_Formularios", $arrLFormToSync);

                if ($bolLSyncForm) {
                    $inLForms++;
                    $arrLUpdateForm = array("a07Estado" => "S");
                    $this->db->update("t07web_Formularios", $arrLUpdateForm, $arrLFormToSync);
                    $objLSync->update("t07web_Formularios", $arrLUpdateForm, $arrLFormToSync);
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

            $this->db->where("a08Estado", "P");
            $SQLResult = $this->db->get("t08web_Usuario_Respuestas");
            $arrLAnswersToSync = $SQLResult->result_array();
            $inLAnswers = 0;

            foreach ($arrLAnswersToSync as $arrLAnswerToSync) {
                $bolLSyncAnswers = $objLSync->insert("t08web_Usuario_Respuestas", $arrLAnswerToSync);

                if ($bolLSyncAnswers) {
                    $inLAnswers++;
                    $arrLUpdateAnswers = array("a08Estado" => "S");
                    $this->db->update("t08web_Usuario_Respuestas", $arrLUpdateAnswers, $arrLAnswerToSync);
                    $objLSync->update("t08web_Usuario_Respuestas", $arrLUpdateAnswers, $arrLAnswerToSync);
                }
            }

            $this->db->where("a09Estado", "P");
            $SQLResult = $this->db->get("t09web_Usuario_RespuestasN");
            $arrLAnswersNToSync = $SQLResult->result_array();
            $inLAnswersN = 0;

            foreach ($arrLAnswersNToSync as $arrLAnswerNToSync) {
                $bolLSyncAnswersN = $objLSync->insert("t09web_Usuario_RespuestasN", $arrLAnswerNToSync);

                if ($bolLSyncAnswersN) {
                    $inLAnswersN++;
                    $arrLUpdateAnswersN = array("a09Estado" => "S");
                    $this->db->update("t09web_Usuario_RespuestasN", $arrLUpdateAnswersN, $arrLAnswerNToSync);
                    $objLSync->update("t09web_Usuario_RespuestasN", $arrLUpdateAnswersN, $arrLAnswerNToSync);
                }
            }

            $objLSync->where("a01Sincro", "P");
            $SQLResult = $objLSync->get("t01web_Usuarios");
            $arrLUsersToSync = $SQLResult->result_array();
            $inLUsers = 0;

            foreach ($arrLUsersToSync as $arrLUserToSync) {
                $this->db->where("a01Codigo", $arrLUserToSync["a01Codigo"]);
                $SQLResult = $this->db->get("t01web_Usuarios");

                if ($SQLResult->num_rows() == 0) {
                    $bolLSyncUsers = $this->db->insert("t01web_Usuarios", $arrLUserToSync);

                    if ($bolLSyncUsers) {
                        $inLUsers++;
                        $arrLUpdateUsers = array("a01Sincro" => "S");
                        $this->db->update("t01web_Usuarios", $arrLUpdateUsers, $arrLUserToSync);
                        $objLSync->update("t01web_Usuarios", $arrLUpdateUsers, $arrLUserToSync);
                    }
                }
            }

            $arrLResponse["forms"] = $inLForms;
            $arrLResponse["answers"] = $inLAnswers;
            $arrLResponse["answers-n"] = $inLAnswersN;
            $arrLResponse["users"] = $inLUsers;
            $arrLResponse["ftp"] = $inLFiles;

            $this->db->trans_complete();

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
