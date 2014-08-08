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
     * Metodo get_locations
     *
     * Método que Obtiene los Preduos para la
     * Vereda solicitado
     *
     * @param string $inRTown ID de la vereda
     */
    public function get_locations($inRTown, $bolRStatus = false) {
        $this->load->model("qm_api", "api", true);

        $arrLResponse = $this->api->get_locations($inRTown, $bolRStatus);
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

        $arrLResponse = $this->form->do_sync(false); // false = no se actualizan los archivos FTP
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
            $stLCommit = trim($stLCommit);

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

            if (!empty($arrLContent) || !is_null($arrLContent)) {
                $arrLContent = reset(json_decode($arrLContent));
                $stLLastCommit = $arrLContent->sha;

                if ($stLLastCommit !== $stLCommit) {
                    $stLPull = shell_exec("git pull 2>&1");

                    echo "Actualizado!,<br>".$stLPull;
                }
                else {
                    echo "No hay Actualizaciones disponibles!";
                }
            }
            else {
                echo "Imposible Conectar";
            }

            exit();
        }

        redirect("/");
    }
}