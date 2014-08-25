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
     * Function do_saveForm
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
            /* Nuevo registro */
            $arrayData["txtCodigo"] = null;
            $this->certificationsModel->do_setProperties($arrayData);
            $resultDoInsert = $this->certificationsModel->do_insert();
            $arrayFechasN = json_decode($_POST["fechasN"]);
            $arrayVeredasN = json_decode($_POST["veredasN"]);
            foreach ($arrayFechasN as $item => $valueItem) {
                $arrayFechasNLocal = array( "txtCertificacion" => $resultDoInsert, "txtFechaInicio" => $valueItem->FechaInicio, "txtFechaFin" => $valueItem->FechaFin );
                $this->certificationsModel->do_setPropertiesNFechas($arrayFechasNLocal);
                $this->certificationsModel->do_insert_fechasn();
            }
            foreach ($arrayVeredasN as $vereda => $valueItem) {
                $arrayVeredasNLocal = array( "txtCertificacion" => $resultDoInsert, "txtMunicipio" => $valueItem->Municipio, "txtVereda" => $valueItem->Vereda, "txtPredio" => $valueItem->Predio, "txtOtroMun" => $valueItem->OtroMun, "txtOtraVda" => $valueItem->OtraVda, "txtOtroPredio" => $valueItem->OtroPredio);
                $this->certificationsModel->do_setPropertiesNVeredas($arrayVeredasNLocal);
                $this->certificationsModel->do_insert_veredasn();
            }
        } else {
            /* Edicion */
            $this->certificationsModel->do_setProperties($arrayData);
            $resultDoInsert = $this->certificationsModel->do_update();
            $arrayFechasN = json_decode($_POST["fechasN"]);
            $arrayVeredasN = json_decode($_POST["veredasN"]);
            $this->certificationsModel->do_delete_fechasn($arrayData["txtCodigo"]);
            $this->certificationsModel->do_delete_veredasn($arrayData["txtCodigo"]);
            foreach ($arrayFechasN as $item => $valueItem) {
                $arrayFechasNLocal = array( "txtCertificacion" => $arrayData["txtCodigo"], "txtFechaInicio" => $valueItem->FechaInicio, "txtFechaFin" => $valueItem->FechaFin );
                $this->certificationsModel->do_setPropertiesNFechas($arrayFechasNLocal);
                $this->certificationsModel->do_insert_fechasn();
            }
            foreach ($arrayVeredasN as $vereda => $valueItem) {
                $arrayVeredasNLocal = array( "txtCertificacion" => $arrayData["txtCodigo"], "txtMunicipio" => $valueItem->Municipio, "txtVereda" => $valueItem->Vereda, "txtPredio" => $valueItem->Predio, "txtOtroMun" => $valueItem->OtroMun, "txtOtraVda" => $valueItem->OtraVda, "txtOtroPredio" => $valueItem->OtroPredio);
                $this->certificationsModel->do_setPropertiesNVeredas($arrayVeredasNLocal);
                $this->certificationsModel->do_insert_veredasn();
            }
        }
        if ($resultDoInsert > 0)
            echo "ok";
        else
            echo $resultDoInsert;
    }
    
    /*
     * Function do_deleteCertification
     * 
     * Call do_delete function from qm_certifications
     */
    public function do_deleteCertification($code){
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->do_delete($code));
    }

    /*
     * Function get_DataCertificationByCode
     * 
     * Call do_delete function from qm_certifications
     */
    public function get_DataCertificationByCode($code) {
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_DataTableByCode($code));
    }
    /*
     * Function get_DataCertificationByForm
     * 
     * Call get_DataTableByForm function from qm_certifications
     */
    public function get_DataCertificationByForm($formCode) {
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_DataTableByForm($formCode));
    }
    
    /*
     * Function get_FechasN
     * 
     * Call get_FechasN function from qm_certifications
     */
    public function get_FechasN($code) {
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_FechasN($code));
    }

    /* Call get_VeredasN from model*/
    public function get_VeredasN($code){
        $this->load->model("qm_certifications", "certificationsModel", true);
        echo json_encode($this->certificationsModel->get_VeredasN($code));
    }

}