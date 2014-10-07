<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Archivo de la Clase QC_Pages
 *
 * Controla el Aspecto Visual de las Paginas
 *
 * @category    Application
 * @package     Controllers
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       File available since Release 1.0
 * @author      Alvaro Montenegro <arthvrian@yahoo.com>
 * @link        http://www.arthvrian.org/
 */
/**
 * Asigna las Opciones del Módulo y Despliega la Vista
 *
 * @category    Application
 * @package     Controllers
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       Class available since Release 1.0
 * @author      Alvaro Montenegro <arthvrian@yahoo.com>
 * @link        http://www.arthvrian.org/
 */
class QC_Form extends QC_Controller {
    /**
     * Metodo index
     *
     * Método que Muestra la Pagina de Usuario solicitada
     */
    public function index() {
        if ($this->session->userdata("isLoggedIn")) {
            redirect("form/search");

            return;
        }

        redirect("/");
    }
    /* Formulario para consultar certificaciones*/
    public function files(){
        if ($this->session->userdata("isLoggedIn")) {
            $this->display_page("files", "form");
            return;
        }

        redirect("/");
    }

    /**
     * Metodo search
     *
     * Método que Muestra la Pagina de Busqueda
     */
    public function search() {
        if ($this->session->userdata("isLoggedIn")) {
            $this->session->unset_userdata("inRSearch");
            $this->session->unset_userdata("bolRSearch");
            $this->session->unset_userdata("inRFormID");
            $this->session->unset_userdata("stRFormID");
            $this->display_page("search", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Metodo start
     *
     * Método que Muestra la Pagina de Inicio de Registro
     */
    public function start() {
        if ($this->session->userdata("isLoggedIn")) {
            if (!$this->session->userdata("bolRSearch")) {
                redirect("form/search");
            }

            $this->load->model("qm_api", "api", true);
            $this->session->unset_userdata("inRSearch");
            $this->session->unset_userdata("inRFormID");
            $this->session->unset_userdata("stRFormID");
            $arrLPageData = array();

            $arrLPageData["arrRStates"] = $this->api->get_states(true);

            $this->load->vars($arrLPageData);
            $this->display_page("start", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Metodo chapter
     *
     * Método que Muestra el Capitulo a ingresar
     */
    public function chapter($stRChapter = null, $inRSearch = null) {
        if ($this->session->userdata("isLoggedIn")) {
            $this->load->model("qm_api", "api", true);
            $this->load->model("qm_form", "form", true);
            $arrLPageData = array();
            $arrLPageData["arrRSearch"] = $this->form->get_form();
            $arrLPageData["arrRTowns"] = $this->api->get_towns(13, false);

            if (is_null($stRChapter) ||
                    (is_null($inRSearch) && !$this->session->userdata("inRFormID"))) {
                redirect("form/search");
            }
            if (!is_null($inRSearch)) {
                $this->session->set_userdata("inRSearch", $inRSearch);
                $arrLSearch = $this->form->get_search();

                if ($arrLSearch) {
                    $arrLPageData["arrRSearch"] = $arrLSearch;
//                    $arrLPageData["arrRTowns"] = $this->api->get_towns($arrLSearch["a08AP09O02"], false);
                }
                else {
                    redirect("form/search");
                }
            }

            $arrLPageData["arrRCountries"] = $this->api->get_countries();
            $arrLPageData["arrRStates"] = $this->api->get_states();
            $arrLPageData["arrRChapters"] = $this->form->get_chapters();
            $arrLPageData["arrRChapter"] = $this->form->get_chapters($stRChapter);
            $arrLPageData["stRPageTitle"] = $stRChapter;
            $arrLPageData["inRSearch"] = $inRSearch;

            $this->load->vars($arrLPageData);
            $this->display_page("chapter", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Metodo done
     *
     * Método que Muestra la Pagina de Finalizacion
     */
    public function done($inRSearch = null) {
        if ($this->session->userdata("isLoggedIn")) {
            if (!is_null($inRSearch)) {
                $this->session->set_userdata("inRFormID", $inRSearch);
            }
            if ($this->session->userdata("inRFormID")) {
                $this->load->model("qm_form", "form", true);
                $arrLPageData = array();

                $arrLForm = $this->form->get_form();
                $arrLPageData["arrRForm"] = $arrLForm;

                $this->load->vars($arrLPageData);
                $this->display_page("done", "form");

                return;
            }
        }

        redirect("/");
    }
    /**
     * Metodo print_form
     *
     * Método que Muestra la Pagina de Impresion
     */
    public function print_form($inRSearch = null, $stRType = null) {
        if ($this->session->userdata("isLoggedIn")) {
            if (!is_null($inRSearch)) {
                $this->session->set_userdata("inRFormID", $inRSearch);
            }
            if ($this->session->userdata("inRFormID")) {
                $this->load->model("qm_form", "form", true);
                $this->load->model("qm_user", "user", true);
                $arrLPageData = array();

                $arrLForm = $this->form->get_form();
                $arrLPageData["arrRForm"] = $arrLForm;
                $arrLPageData["arrRChapter"] = $this->form->get_chapters("A");
                $arrLPageData["arrRAnswers"] = $this->user->get_answers();
                $arrLPageData["stRType"] = $stRType;

                $this->load->vars($arrLPageData);
                $this->display_page("print", "form", true);

                return;
            }
        }

        redirect("/");
    }

    /* Metodo full_form
        metodo que muestra la pagina alternativa de impresion*/
        public function print_full($inRSearch = null, $stRType = null){

            if ($this->session->userdata("isLoggedIn")) {

                if (!is_null($inRSearch)){
                    $this->session->set_userdata("inRFormID", $inRSearch);
                }

                if ($this->session->userdata("inRFormID")){

                    $this->load->model("qm_form", "form", true);
                    $this->load->model("qm_user", "user", true);
                    $arrLPageData = array();

                    /*Obtener los datos del formulario*/
                    $arrLForm = $this->form->get_form();
                    $arrLPageData["arrRForm"] = $arrLForm;
                    $arrLPageData["arrRChapter"] = $this->form->get_chapters("A");
                    $arrLPageData["arrRAnswers"] = $this->user->get_answers();
                    $arrLPageData["arrRChapterB"] = $this->form->get_chapterb($inRSearch);
                    $arrLPageData["arrRChapterC"] = $this->form->get_chapterc($inRSearch);
                    $arrLPageData["stRType"] = $stRType;
                    $this->load->vars($arrLPageData);
                    $this->display_page("print_full", "form", true);
                    return;

                }

            }

            redirect("/");

        }

    /**
     * Metodo view
     *
     * Método que Muestra el formulario seleccionado
     */
    public function view($stRFormID = null) {
        if ($this->session->userdata("isLoggedIn") && !is_null($stRFormID)) {
            $this->load->model("qm_form", "form", true);
            $arrLPageData = array();

            $arrLPageData["arrRForm"] = $this->form->get_form($stRFormID);

            $this->load->vars($arrLPageData);
            $this->display_page("view", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Método sync
     *
     * Método que Sincroniza los Formularios
     */
    public function sync() {
        if ($this->session->userdata("isLoggedIn")) {
            $this->display_page("sync", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Método upload
     *
     * Método que Sube los documentos del Formulario
     */
    public function upload($stRFormID = null) {
        if ($this->session->userdata("isLoggedIn") && $this->session->userdata("inRUserType") == 3) {
            $arrLPageData["stRFormID"] = $stRFormID;
            $this->load->vars($arrLPageData);

            $this->display_page("upload", "form");

            return;
        }

        redirect("/");
    }
    /**
     * Método do_search
     *
     * Método que Busca los Datos del Formulario y persona
     */
    public function do_search() {
        $arrLResponse = array();
        $this->load->model("qm_form", "form", true);

        $arrLFormData = $this->input->post();

        foreach ($arrLFormData as $stLKey => $stLData) {
            if (!is_array($arrLFormData[$stLKey])) {
                $arrLFormData[$stLKey] = trim($stLData);

                if (empty($arrLFormData[$stLKey])) {
                    $arrLFormData[$stLKey] = null;
                }
            }
        }

        $arrLSearch = $this->form->do_search($arrLFormData);
        $this->session->set_userdata("bolRSearch", true);

        if ($arrLSearch["found"]) {
            $arrLResponse["inRUserType"] = $this->session->userdata("inRUserType");
            $arrLResponse["TxtSuccessForm"] = true;
            $arrLResponse["TxtTitle"] = "Encontrado!";
            $arrLResponse["TxtSuccess"] = "Mostrando la lista de resultados ...";
            $arrLResponse["arrRResults"] = $arrLSearch["results"];
        }
        else {
            $arrLResponse["TxtErrorForm"] = true;
            $arrLResponse["TxtError"] = "Error NO se encontraron datos";
            $arrLResponse["TxtRedirect"] = true;
            $arrLResponse["TxtChapter"] = "chapter/A";
        }

        echo json_encode($arrLResponse);
    }
    /**
     * Método do_form
     *
     * Método que Guarda los Datos del Formulario
     */
    public function do_form() {
        $arrLResponse = array();
        $this->load->model("qm_form", "form", true);

        $arrLFormData = $this->input->post();

        if ($this->form->do_form($arrLFormData)) {
            $arrLResponse["TxtSuccessForm"] = true;
            $arrLResponse["TxtTitle"] = "Guardado!";
            $arrLResponse["TxtSuccess"] = "Preparando el primer capitulo ...";
            $arrLResponse["TxtRedirect"] = true;
            $arrLResponse["TxtIsChapter"] = true;
            $arrLResponse["TxtChapter"] = "chapter/A";
        }
        else {
            $arrLResponse["TxtErrorForm"] = true;
            $arrLResponse["TxtError"] = "Error Guardando el formulario";
        }

        echo json_encode($arrLResponse);
    }
    /**
     * Método do_chapter
     *
     * Método que Guarda los Datos del Capitulo
     */
    public function do_chapter() {
        $arrLResponse = array();
        $this->load->model("qm_form", "form", true);

        $arrLFormData = $this->input->post();

        foreach ($arrLFormData as $stLKey => $stLData) {
            if (!is_array($arrLFormData[$stLKey])) {
                $arrLFormData[$stLKey] = trim($stLData);

                if (!is_numeric($arrLFormData[$stLKey]) && empty($arrLFormData[$stLKey])) {
                    $arrLFormData[$stLKey] = null;
                }
            }
        }

        if ($this->form->do_chapter($arrLFormData)) {
            $this->load->model("qm_form", "form", true);

            $arrLResponse["TxtSuccessForm"] = true;
            $arrLResponse["TxtTitle"] = "Guardado!";
            $arrLResponse["TxtSuccess"] = "Preparando el siguiente capitulo ...";
            $arrLResponse["TxtRedirect"] = true;

            $stLNextChapter = $this->form->get_next_chapter($arrLFormData["TxtChapter"]);

            if (!is_null($stLNextChapter)) {
                $stLNextChapter = "chapter/".$stLNextChapter;
            }

            if (is_null($stLNextChapter) || $arrLFormData["TxtAction"] == "T") {
                $stLNextChapter = "done";
                $arrLResponse["TxtSuccess"] = "Preparando el cierre del formulario ...";
            }

            $arrLResponse["TxtChapter"] = $stLNextChapter;
        }
        else {
            $arrLResponse["TxtErrorForm"] = true;
            $arrLResponse["TxtError"] = "Error Guardando el formulario";
        }

        echo json_encode($arrLResponse);
    }
    /**
     * Método do_finish
     *
     * Método que Guarda la captura del formulario
     */
    public function do_finish() {
        $this->load->model("qm_form", "form", true);
        $inRFormID = $this->session->userdata("inRFormID");
        $arrLFormData = $this->input->post();
        $arrLResponse = array();

        if (isset($_FILES["TxtFormImage"])) {
            $this->load->library("upload");
            $config["upload_path"] = "public/uploads";
            $config["allowed_types"] = "gif|jpg|png|pdf";
            $config["overwrite"] = true;

            $stLFile = $_FILES["TxtFormImage"]["name"];
            $stLFileName = reset(explode(".", $stLFile));
            $stLFileExt = end(explode(".", $stLFile));
            $stLFileName = strtolower($stLFileName);

            $config["file_name"] = $inRFormID.".".$stLFileName.".".$stLFileExt;
            $arrLFormData["TxtFormImage"] = $inRFormID.".".$_FILES["TxtFormImage"]["name"];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("TxtFormImage")) {
                $arrLResponse["TxtErrorForm"] = true;
                $arrLResponse["TxtError"] = "Error guardando la imagen";

                echo json_encode($arrLResponse);
                return;
            }
        }
        if (isset($_FILES["TxtFormVideo"])) {
            $this->load->library("upload");
            $config["upload_path"] = "public/uploads";
            $config["allowed_types"] = "*";
            $config["overwrite"] = true;

            $stLFile = $_FILES["TxtFormVideo"]["name"];
            $stLFileName = reset(explode(".", $stLFile));
            $stLFileExt = end(explode(".", $stLFile));
            $stLFileName = strtolower($stLFileName);

            $config["file_name"] = $inRFormID.".".$stLFileName.".".$stLFileExt;
            $arrLFormData["TxtFormVideo"] = $inRFormID.".".$_FILES["TxtFormVideo"]["name"];
            $this->upload->initialize($config);

            if (!$this->upload->do_upload("TxtFormVideo")) {
                $arrLResponse["TxtErrorForm"] = true;
                $arrLResponse["TxtError"] = "Error guardando el video";

                echo json_encode($arrLResponse);
                return;
            }
        }

        if ($this->form->do_finish($arrLFormData)) {
            $arrLResponse["TxtSuccessForm"] = true;
            $arrLResponse["TxtTitle"] = "Guardado!";
            $arrLResponse["TxtSuccess"] = "Iniciando un nuevo formulario ...";
            $arrLResponse["TxtRedirect"] = true;
            $arrLResponse["TxtChapter"] = "";
            $this->session->unset_userdata("inRFormID");
        }
        else {
            $arrLResponse["TxtErrorForm"] = true;
            $arrLResponse["TxtError"] = "Error Guardando el formulario";
        }

        echo json_encode($arrLResponse);
    }

    /* Obtener listado de archivos por certificacion*/
    public function get_FilesN($code) {
        $this->load->model("qm_form", "form", true);
        echo json_encode($this->form->get_CertFiles($code));
    }

    /* Obtener listado de tutelas por numero de cedula*/
    public function get_Tutelas($cedula){
        $this->load->model("qm_form", "form", true);
        echo json_encode($this->form->get_tutelas($cedula));
    }

    /*Obtener listado de pqr por numero de cedula*/
    public function get_Pqr($cedula){
        $this->load->model("qm_form", "form", true);
        echo json_encode($this->form->get_pqr($cedula));
    }

    /**
     * Método do_finish
     *
     * Método que Guarda la captura del formulario
     */
    public function do_uploads() {
        $this->load->model("qm_form", "form", true);

        $arrLFormData = $this->input->post();
        $inRFormID = $arrLFormData["TxtFormID"];
        $arrLResponse = array();
        
        $this->load->library("upload");
        $config["upload_path"] = "public/uploads/".$inRFormID;
        $config["allowed_types"] = "*";
        $config["overwrite"] = true;
        $arrLFiles = array();
        $inLCount = 0;

        $this->upload->initialize($config);
        
        if (!file_exists(FCPATH."/public/uploads/".$inRFormID)
                && !is_dir(FCPATH."public/uploads/".$inRFormID)) {
            mkdir(FCPATH."/public/uploads/".$inRFormID, 0755, true);
        }
        
        foreach($_FILES as $stLKey => $arrLFile) {
            if ($this->upload->do_upload($stLKey)) {
                $inLKey = str_replace("File", "", $stLKey);
                
                $tipo = substr($inLKey, -2);
                
                $arrLFileData = $this->upload->data();
                $arrLFileInfo = array( 	"a13Identificador" => $inRFormID,
                                        //"a13Tipo" => ++$inLCount,
                                        "a13Tipo" => (int)$tipo,
                                        "a13Documento" => utf8_encode($arrLFileData["file_name"]),
                                        "a13Folios" => $arrLFormData[$inLKey],
                                        "a13Fecha" => date("Y-m-d H:i:s"),
                                        "a13Estado" => "P");

                array_push($arrLFiles, $arrLFileInfo);
            }
        }

        $bolLDocs = $this->form->do_uploads($arrLFiles);
        
        
        
        if ($bolLDocs) {
            $arrLResponse["TxtSuccessForm"] = true;
            $arrLResponse["TxtTitle"] = "Guardado!";
            $arrLResponse["TxtSuccess"] = "Se han guardado correctamente los documentos ...";
            $arrLResponse["TxtReload"] = true;
        }
        else {
            $arrLResponse["TxtErrorForm"] = true;
            $arrLResponse["TxtError"] = "NO se han podido guardar los documentos";
        }

        $this->output->set_content_type("application/json");
        echo json_encode($arrLResponse);
    }

    /**
     * Método do_getFilesPath
     *
     * Método que Obtiene la ruta de los archivos cargados por codifo de formulario
     */
    
    function do_getFilesPath($codeForm){
        $this->load->model("qm_form", "form", true);
        echo json_encode($this->form->get_files($codeForm));
    }
}