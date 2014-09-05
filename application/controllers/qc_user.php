<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Archivo de la Clase QC_User
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
class QC_User extends QC_Controller {
    /**
     * Metodo index
     *
     * Método que Muestra la Pagina de Usuario solicitada
     *
     * @param string $stRPage Página a mostrar
     */
    public function index($stRPage = "home") {
        if ($this->session->userdata("isLoggedIn")) {
            redirect("form/search");
        }

        $this->display_page($stRPage);
    }
    /**
     * Método do_login
     *
     * Método que Ejecuta el Login del Usuario
     */
    public function do_login() {
        try{
            $arrLResponse = array();
            $this->load->model("qm_user", "user", true);

            $stRUsername = $this->input->post("TxtUsername");
            $stRPassword = md5($this->input->post("TxtPassword"));

            $arrLUserData = $this->user->do_login($stRUsername, $stRPassword);

            if (isset($arrLUserData["a01Codigo"])) {
                $stLFullName = trim($arrLUserData["a01Nombres"]." ".$arrLUserData["a01Apellidos"]);

                $this->session->set_userdata("isLoggedIn", true);
                $this->session->set_userdata("inRUserID", $arrLUserData["a01Codigo"]);
                $this->session->set_userdata("inRUserType", $arrLUserData["a01Tipo"]);
                $this->session->set_userdata("stRUsername", $stLFullName);

                $arrLResponse["TxtSuccessForm"] = true;
                $arrLResponse["TxtTitle"] = "Identificado!";
                $arrLResponse["TxtSuccess"] = "Ingresando al Aplicativo ...";
                $arrLResponse["TxtReload"] = true;
            }
            else {
                $arrLResponse["TxtErrorForm"] = true;
                $arrLResponse["TxtError"] = "Usuario NO encontrado";
            }

            echo json_encode($arrLResponse);
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
    /**
     * Metodo do_logout
     *
     * Metodo que Cierra la Sesion del Usuario
     */
    public function do_logout() {
        $this->session->unset_userdata("isLoggedIn");
        $this->session->unset_userdata("inRUserID");

        $this->session->sess_destroy();

        redirect("/");
    }
}