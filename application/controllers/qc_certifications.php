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
        $this->load->model("qm_certifications", "certificationsModel", true);
        $arrayData = array();
        if (!empty($_POST["dataForm"])) {
            $arraDataFromView = json_decode($_POST["dataForm"]);
            foreach ($arraDataFromView as $itemKey => $itemValue) {
                $arrayData[$itemValue->name] = $itemValue->value;
            }
        }

        $arrayData["txtIdentificador"] = $_POST["formCode"];
        $arrayData["txtCodigo"] = $_POST["code"];

        if ($arrayData["txtCodigo"] == "0") {
            $arrayData["txtCodigo"] = null;
            $this->certificationsModel->do_setProperties($arrayData);
            $resultDoInsert = $this->certificationsModel->do_insert();
        } else {
            $this->certificationsModel->do_setProperties($arrayData);
            $resultDoInsert = $this->certificationsModel->do_update();
        }
        if ($resultDoInsert)
            echo "ok";
        else
            echo $resultDoInsert;
    }
    
    /*
     * 
     * 
     * 
     */
    public function do_deleteCertification($code){
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->do_delete($code));
    }

    /*
     * 
     * 
     * 
     */
    public function get_DataCertificationByCode($code) {
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_DataTableByCode($code));
    }
    /*
     * 
     * 
     * 
     */
    public function get_DataCertificationByForm($formCode) {
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_DataTableByForm($formCode));
    }

}