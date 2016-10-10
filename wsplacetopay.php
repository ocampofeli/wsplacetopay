<?php

/*
 * @utor Brayan Felipe Ocampo Galeano
 * ocampofeli@gmail.com
 * movil: 301 393 8052
 * 
 */

/**
 * NOTA: esta clase no esta desarrollada para pagos Multicreditos
 */
//Agregar todos los Web Services
require_once (dirname(__FILE__) . '/src/class.mainpse.php');

class wsplacetopay {

    /**
     * Class
     * @var type 
     */
    public $wsmainpse;

    /**
     * 
     */
    public function __construct() {

        $this->wsmainpse = new wsmainpse();
    }

    /**
     * 
     * @return type
     */
    public function getBankList() {

        return $this->wsmainpse->getBankList();
    }

    /**
     * 
     * @param type $transactionID
     * @return type
     */
    public function getTransactionInformation($transactionID) {

        return $this->wsmainpse->getTransactionInformation($transactionID);
    }

}

$pse_p2p = new wsmainpse();
$wsplacetopay = new wsplacetopay();

/*
 * Transaction Place to Pay PSE
 */

$pse_p2p->bankCode = (isset($_POST['bankCode']) ? $_POST['bankCode'] : '');
$pse_p2p->bankInterface = (isset($_POST['bankInterface']) ? $_POST['bankInterface'] : '');
$pse_p2p->returnURL = (isset($_POST['returnURL']) ? $_POST['returnURL'] : 'http://' . $_SERVER["SERVER_NAME"]);
$pse_p2p->reference = (isset($_POST['reference']) ? $_POST['reference'] : '');
$pse_p2p->description = (isset($_POST['description']) ? $_POST['description'] : 'Pago PSE por la plataforma ' . $_SERVER["SERVER_NAME"]);
$pse_p2p->language = (!empty($_POST['language']) ? $_POST['language'] : 'ES');
$pse_p2p->currency = (!empty($_POST['currency']) ? $_POST['currency'] : 'COP');

$pse_p2p->totalAmount = (isset($_POST['totalAmount']) ? $_POST['totalAmount'] : '');
$pse_p2p->taxAmount = (isset($_POST['taxAmount']) ? $_POST['taxAmount'] : '');
$pse_p2p->devolutionBase = (isset($_POST['devolutionBase']) ? $_POST['devolutionBase'] : '');
$pse_p2p->tipAmount = (isset($_POST['tipAmount']) ? $_POST['tipAmount'] : '');



/**
 * Player Place to Pay PSE
 * Datos del Pagador
 */
$pse_p2p->playerDocumentType = (!empty($_POST['playerDocumentType']) ? $_POST['playerDocumentType'] : '');
$pse_p2p->playerDocument = (!empty($_POST['playerDocument']) ? $_POST['playerDocument'] : '');
$pse_p2p->playerFirstName = (!empty($_POST['playerFirstName']) ? $_POST['playerFirstName'] : '');
$pse_p2p->playerLastName = (!empty($_POST['playerLastName']) ? $_POST['playerLastName'] : '');
$pse_p2p->playerCompany = (!empty($_POST['playerCompany']) ? $_POST['playerCompany'] : '');
$pse_p2p->playerEmailAddress = (!empty($_POST['playerEmailAddress']) ? $_POST['playerEmailAddress'] : '');
$pse_p2p->playerAddress = (!empty($_POST['playerAddress']) ? $_POST['playerAddress'] : '');
$pse_p2p->playerCity = (!empty($_POST['playerCity']) ? $_POST['playerCity'] : '');
$pse_p2p->playerProvince = (!empty($_POST['playerProvince']) ? $_POST['playerProvince'] : '');
$pse_p2p->playerCountry = (!empty($_POST['playerCountry']) ? $_POST['playerCountry'] : '');
$pse_p2p->playerPhone = (!empty($_POST['playerPhone']) ? $_POST['playerPhone'] : '');
$pse_p2p->playerMobile = (!empty($_POST['playerMobile']) ? $_POST['playerMobile'] : '');


/**
 * Buyer Place to Pay PSE
 * Datos del comprador
 */
$pse_p2p->buyerDocumentType = (!empty($_POST['buyerDocumentType']) ? $_POST['buyerDocumentType'] : '');
$pse_p2p->buyerDocument = (!empty($_POST['buyerDocument']) ? $_POST['buyerDocument'] : '');
$pse_p2p->buyerFirstName = (!empty($_POST['buyerFirstName']) ? $_POST['buyerFirstName'] : '');
$pse_p2p->buyerLastName = (!empty($_POST['buyerLastName']) ? $_POST['buyerLastName'] : '');
$pse_p2p->buyerCompany = (!empty($_POST['buyerCompany']) ? $_POST['buyerCompany'] : '');
$pse_p2p->buyerEmailAddress = (!empty($_POST['buyerEmailAddress']) ? $_POST['buyerEmailAddress'] : '');
$pse_p2p->buyerAddress = (!empty($_POST['buyerAddress']) ? $_POST['buyerAddress'] : '');
$pse_p2p->buyerCity = (!empty($_POST['buyerCity']) ? $_POST['buyerCity'] : '');
$pse_p2p->buyerProvince = (!empty($_POST['buyerProvince']) ? $_POST['buyerProvince'] : '');
$pse_p2p->buyerCountry = (!empty($_POST['buyerCountry']) ? $_POST['buyerCountry'] : '');
$pse_p2p->buyerPhone = (!empty($_POST['buyerPhone']) ? $_POST['buyerPhone'] : '');
$pse_p2p->buyerMobile = (!empty($_POST['buyerMobile']) ? $_POST['buyerMobile'] : '');

/**
 * Shipping Place to Pay PSE
 * Datos de facturacion
 */
$pse_p2p->shippingDocumentType = (!empty($_POST['shippingDocumentType']) ? $_POST['shippingDocumentType'] : '');
$pse_p2p->shippingDocument = (!empty($_POST['shippingDocument']) ? $_POST['shippingDocument'] : '');
$pse_p2p->shippingFirstName = (!empty($_POST['shippingFirstName']) ? $_POST['shippingFirstName'] : '');
$pse_p2p->shippingLastName = (!empty($_POST['shippingLastName']) ? $_POST['shippingLastName'] : '');
$pse_p2p->shippingCompany = (!empty($_POST['shippingCompany']) ? $_POST['shippingCompany'] : '');
$pse_p2p->shippingEmailAddress = (!empty($_POST['shippingEmailAddress']) ? $_POST['shippingEmailAddress'] : '');
$pse_p2p->shippingAddress = (!empty($_POST['shippingAddress']) ? $_POST['shippingAddress'] : '');
$pse_p2p->shippingCity = (!empty($_POST['shippingCity']) ? $_POST['shippingCity'] : '');
$pse_p2p->shippingProvince = (!empty($_POST['shippingProvince']) ? $_POST['shippingProvince'] : '');
$pse_p2p->shippingCountry = (!empty($_POST['shippingCountry']) ? $_POST['shippingCountry'] : '');
$pse_p2p->shippingPhone = (!empty($_POST['shippingPhone']) ? $_POST['shippingPhone'] : '');
$pse_p2p->shippingMobile = (!empty($_POST['shippingMobile']) ? $_POST['shippingMobile'] : '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($pse_p2p->login) && empty($pse_p2p->seed) && empty($pse_p2p->tranKey)) {

        $pse_p2p->placetopay_wspse_setPayment();
    } else {
        header('Location: ' . 'http://' . $_SERVER["SERVER_NAME"]);
    }
}
?>