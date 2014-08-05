<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * Administra modulo de digitación para las certificaciones laboral, comercial y de vecindad
 *
 * @category    Application
 * @package     Controllers
 * @version     CVS: $Id:$
 * @version     PHP: 5.x
 * @since       File available since Release 1.0
 * @author      Juan Camilo Martinez Morales <juan.martinez@mggroup.com.co>
 * @link        http://twitter.com/xogost/
 */
class QC_Certifications extends QC_Controller {

    /**
     * Function index
     *
     * Show admin page
     */
    public function index() {
        $this->admin();
    }

    /**
     * Function admin
     *
     * Show admin page
     */
    public function admin() {
        $this->display_page("admin", "certifications");
    }

    /**
     * Function form
     *
     * Show form page
     */
    public function form() {
        $this->display_page("form", "certifications");
    }

    /**
     * Function form
     *
     * Show form page
     */
    public function do_saveForm() {
        $this->load->model("qm_certifications", "certificationsModel", false);
        $arrayData = array();
        if (!empty($_POST["dataForm"])) {
            $arraDataFromView = json_decode($_POST["dataForm"]);
            foreach ($arraDataFromView as $itemKey => $itemValue) {
                $arrayData[$itemValue->name] = $itemValue->value;
            }
        }
        $arrayData["txtCodigo"] = $_POST["code"];
        $arrayData["txtIdentificador"] = $_POST["formCode"];
        $this->certificationsModel->do_setProperties($arrayData);
        if ($arrayData["txtCodigo"] == "0") {
            $resultDoInsert = $this->certificationsModel->do_insert();
        } else {
            $resultDoInsert = $this->certificationsModel->do_update();
        }
        if ($resultDoInsert)
            echo "ok";
        else
            echo $resultDoInsert;
    }

}