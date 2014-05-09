<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Archivo de la Clase QC_API
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
class QC_API extends QC_Controller {
    /**
     * Metodo get_towns
     *
     * Método que Obtiene los Municipios para el
     * Departamento solicitado
     *
     * @param string $inRState ID del Departamento
     */
    public function get_towns($inRState, $bolRStatus = false) {
        $this->load->model("qm_api", "api", true);

        $arrLResponse = $this->api->get_towns($inRState, $bolRStatus);
        $this->output->set_content_type("application/json");
        echo json_encode($arrLResponse);
    }
    /**
     * Metodo get_cities
     *
     * Método que Obtiene las Veredas para el
     * Municipio solicitado
     *
     * @param string $inRTown ID del Municipio
     */
    public function get_cities($inRTown, $bolRStatus = false) {
        $this->load->model("qm_api", "api", true);

        $arrLResponse = $this->api->get_cities($inRTown, $bolRStatus);
        $this->output->set_content_type("application/json");
        echo json_encode($arrLResponse);
    }
    /**
     * Método sync
     *
     * Método que Sincroniza los Formularios
     */
    public function sync() {
        $this->load->model("qm_form", "form", true);

        $arrLResponse = $this->form->do_sync(true);
        $this->output->set_content_type("application/json");
        echo json_encode($arrLResponse);
    }
    /**
     * Método update
     *
     * Método que Actualiza la aplicacion desde Github
     */
    public function update() {
        if ($this->session->userdata("isLoggedIn")) {
            $stLCommit = shell_exec("git rev-parse HEAD 2>&1");

            $objLCURLSession = curl_init();
            curl_setopt($objLCURLSession, CURLOPT_URL,"https://api.github.com/repos/MGGRoup/quimbo/commits");

            $arrLHeaders = array(	'Accept: application/json',
                                    'Content-Type: application/json',
                                    'User-Agent: QUIMBO');
            curl_setopt($objLCURLSession, CURLOPT_HTTPHEADER, $arrLHeaders);
            curl_setopt($objLCURLSession, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($objLCURLSession, CURLOPT_SSL_VERIFYPEER, false);

            $arrLContent = curl_exec($objLCURLSession);
            curl_close($objLCURLSession);

            $arrLContent = reset(json_decode($arrLContent));
            $stLLastCommit = $arrLContent->sha;

            if (!strcmp($stLLastCommit, $stLCommit)) {
                $stLPull = shell_exec("git pull");

                echo "Actualizado!";
            }
            else {
                echo "No hay Actualizaones disponibles!";
            }
        }

        redirect("/");
    }
}