<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Archivo de la Clase QC_Controller
 *
 * Controlador Base
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
class QC_Controller extends CI_Controller {
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $arrLPageData = array();

        $arrLPageData["bolRIsLoggenIn"] = false;

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");

        if ($this->session->userdata("isLoggedIn")) {
            $this->check_session();
            $arrLPageData["bolRIsLoggenIn"] = true;
        }
        else {
            $this->load->helper("cookie");
            delete_cookie("dtRTime");
        }

        $this->load->vars($arrLPageData);
    }
    /**
     * Metodo check_session
     *
     * Comprueba la sesion del Usuario
     */
    private function check_session() {
        $this->load->helper("cookie");

        $arrLTime = array(	"name"   => "dtRTime",
                            "value"  => time(),
                            "expire" => "86500");

        if (!get_cookie("dtRTime")) {
            set_cookie($arrLTime);
        }
        else {
            $inLSessionTime = time() - 3600;
            $inLSessionStart = get_cookie("dtRTime");

            if ($inLSessionStart < $inLSessionTime) {
                $this->session->sess_destroy();
                delete_cookie("dtRTime");

                redirect("/");
                exit();
            }
            else {
                set_cookie($arrLTime);
            }
        }
    }
    /**
     * Metodo display_page
     *
     * Metodo que Muestra la Pagina Solicitada
     *
     * @param string $stRPage Pagina Solicitada
     * @param string $stRView Vista Solicitada
     * @param string $bolRHTML HTML solamente
     */
    protected function display_page($stRPage, $stRView = "pages", $bolRHTML = false) {
        $this->load->model("qm_user", "user", true);
        $arrLPageData = array();

        if (!file_exists("application/views/".$stRView."/".$stRPage.".php")) {
            show_404();
        }

        $arrLPage = explode("/", $stRPage);
        $stLPage = array_shift($arrLPage);

        $arrLPageData["stRPage"]  = $stRPage;
        $arrLPageData["stRView"]  = $stRView;
        $stRPageTitle = ucfirst($this->lang->line("TxtPage".ucfirst($stLPage)));

        if (!is_null($this->load->get_var("stRPageTitle"))) {
            $stRPageTitle .= " ".$this->load->get_var("stRPageTitle");
        }

        $arrLPageData["stRPageTitle"] = $stRPageTitle;
        $arrLPageData["stRUsername"] = $this->session->userdata("stRUsername");
        $arrLPageData["inRFormID"] = $this->session->userdata("inRFormID");
        $arrLPageData["inRUserType"] = $this->session->userdata("inRUserType");

        if (!$bolRHTML) {
            $this->load->view("layouts/header", $arrLPageData);
            $this->load->view("layouts/menu", $arrLPageData);

            if ($this->session->userdata("isLoggedIn")) {
                //$arrLPageData["stRChapters"] = $this->load->view("layouts/chapters", $arrLPageData, true);

                if ($this->user->get_account("a01Estado") == "I") {
                    redirect("user/do_logout");
                }
            }

            $this->load->view($stRView."/".$stRPage, $arrLPageData);
            $this->load->view("layouts/footer", $arrLPageData);
        }
        else {
            $this->load->view($stRView."/".$stRPage, $arrLPageData);
        }
    }
}
