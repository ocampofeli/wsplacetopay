<?php

/*
 * @utor Brayan Felipe Ocampo Galeano
 * ocampofeli@gmail.com
 * movil: 301 393 8052
 */

require_once (dirname(__FILE__) . '/authenticationPSE.php');
require_once (dirname(__FILE__) . '/webservicePSE.php');

class validatorPSE {

    //class Adionales
    private $wspse;

    public function __construct() {

        $this->wspse = new webservicePSE();
    }

    /**
     * 
     * @param type $pol
     */
    public function validatorPSE_data($pol) {


        $this->wspse->bankCode = (isset($pol['bankCode']) ? $pol['bankCode'] : '');
        $this->wspse->bankInterface = (isset($pol['bankInterface']) ? $pol['bankInterface'] : '');
        $this->wspse->returnURL = (isset($pol['returnURL']) ? $pol['returnURL'] : '');
        $this->wspse->reference = (isset($pol['reference']) ? $pol['reference'] : '');
        $this->wspse->description = (isset($pol['description']) ? $pol['description'] : 'Pago PSE por la plataforma ' . $_SERVER["SERVER_NAME"]);
        $this->wspse->language = (!empty($pol['language']) ? strtoupper($pol['language']) : 'ES');
        $this->wspse->currency = (!empty($pol['currency']) ? strtoupper($pol['currency']) : 'COP');
        $this->wspse->totalAmount = (isset($pol['totalAmount']) ? $pol['totalAmount'] : '');
        $this->wspse->taxAmount = (isset($pol['taxAmount']) ? $pol['taxAmount'] : '');
        $this->wspse->devolutionBase = (isset($pol['devolutionBase']) ? $pol['devolutionBase'] : '');
        $this->wspse->tipAmount = (isset($pol['tipAmount']) ? $pol['tipAmount'] : '');



        /**
         * Player Place to Pay PSE
         * Datos del Pagador
         */
        $this->wspse->playerDocumentType = (!empty($pol['playerDocumentType']) ? $pol['playerDocumentType'] : '');
        $this->wspse->playerDocument = (!empty($pol['playerDocument']) ? $this->num($pol['playerDocument']) : '');
        $this->wspse->playerFirstName = (!empty($pol['playerFirstName']) ? $this->string($pol['playerFirstName']) : '');
        $this->wspse->playerLastName = (!empty($pol['playerLastName']) ? $this->string($pol['playerLastName']) : '');
        $this->wspse->playerCompany = (!empty($pol['playerCompany']) ? $pol['playerCompany'] : '');
        $this->wspse->playerEmailAddress = (!empty($pol['playerEmailAddress']) ? $pol['playerEmailAddress'] : '');
        $this->wspse->playerAddress = (!empty($pol['playerAddress']) ? $pol['playerAddress'] : '');
        $this->wspse->playerCity = (!empty($pol['playerCity']) ? $this->string($pol['playerCity']) : '');
        $this->wspse->playerProvince = (!empty($pol['playerProvince']) ? $this->string($pol['playerProvince']) : '');
        $this->wspse->playerCountry = (!empty($pol['playerCountry']) ? strtoupper($this->string($pol['playerCountry'])) : '');
        $this->wspse->playerPhone = (!empty($pol['playerPhone']) ? $this->num($pol['playerPhone']) : '');
        $this->wspse->playerMobile = (!empty($pol['playerMobile']) ? $this->num($pol['playerMobile']) : '');


        /**
         * Buyer Place to Pay PSE
         * Datos del comprador
         */
        $this->wspse->buyerDocumentType = (!empty($pol['buyerDocumentType']) ? $pol['buyerDocumentType'] : '');
        $this->wspse->buyerDocument = (!empty($pol['buyerDocument']) ? $this->num($pol['buyerDocument']) : '');
        $this->wspse->buyerFirstName = (!empty($pol['buyerFirstName']) ? $this->string($pol['buyerFirstName']) : '');
        $this->wspse->buyerLastName = (!empty($pol['buyerLastName']) ? $this->string($pol['buyerLastName']) : '');
        $this->wspse->buyerCompany = (!empty($pol['buyerCompany']) ? $pol['buyerCompany'] : '');
        $this->wspse->buyerEmailAddress = (!empty($pol['buyerEmailAddress']) ? $pol['buyerEmailAddress'] : '');
        $this->wspse->buyerAddress = (!empty($pol['buyerAddress']) ? $pol['buyerAddress'] : '');
        $this->wspse->buyerCity = (!empty($pol['buyerCity']) ? $this->string($pol['buyerCity']) : '');
        $this->wspse->buyerProvince = (!empty($pol['buyerProvince']) ? $this->string($pol['buyerProvince']) : '');
        $this->wspse->buyerCountry = (!empty($pol['buyerCountry']) ? strtoupper($this->string($pol['buyerCountry'])) : '');
        $this->wspse->buyerPhone = (!empty($pol['buyerPhone']) ? $this->num($pol['buyerPhone']) : '');
        $this->wspse->buyerMobile = (!empty($pol['buyerMobile']) ? $this->num($pol['buyerMobile']) : '');

        /**
         * Shipping Place to Pay PSE
         * Datos de facturacion
         */
        $this->wspse->shippingDocumentType = (!empty($pol['shippingDocumentType']) ? $pol['shippingDocumentType'] : '');
        $this->wspse->shippingDocument = (!empty($pol['shippingDocument']) ? $this->num($pol['shippingDocument']) : '');
        $this->wspse->shippingFirstName = (!empty($pol['shippingFirstName']) ? $this->string($pol['shippingFirstName']) : '');
        $this->wspse->shippingLastName = (!empty($pol['shippingLastName']) ? $this->string($pol['shippingLastName']) : '');
        $this->wspse->shippingCompany = (!empty($pol['shippingCompany']) ? $pol['shippingCompany'] : '');
        $this->wspse->shippingEmailAddress = (!empty($pol['shippingEmailAddress']) ? $pol['shippingEmailAddress'] : '');
        $this->wspse->shippingAddress = (!empty($pol['shippingAddress']) ? $pol['shippingAddress'] : '');
        $this->wspse->shippingCity = (!empty($pol['shippingCity']) ? $this->string($pol['shippingCity']) : '');
        $this->wspse->shippingProvince = (!empty($pol['shippingProvince']) ? $this->string($pol['shippingProvince']) : '');
        $this->wspse->shippingCountry = (!empty($pol['shippingCountry']) ? strtoupper($this->string($pol['shippingCountry'])) : '');
        $this->wspse->shippingPhone = (!empty($pol['shippingPhone']) ? $this->num($pol['shippingPhone']) : '');
        $this->wspse->shippingMobile = (!empty($pol['shippingMobile']) ? $this->num($pol['shippingMobile']) : '');

        $this->wspse->ipAddress = $this->validatorPSE_detectIp();
        $this->wspse->userAgent = $this->validatorPSE_detectBrowser();

        $this->validatorPSE_valOpcional();
        
        $this->wspse->webservicePSE_setPayment();
    }

    /**
     * 
     * @throws Exception
     */
    private function validatorPSE_valOpcional() {

        /**
         * Player
         */
        if (!empty($this->wspse->playerDocumentType) && !in_array($this->wspse->playerDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Comprador no es soportado' . $this->wspse->playerDocumentType);
        }
        if (!empty($this->wspse->playerDocument) && (strlen($this->wspse->playerDocument) > 12)) {
            throw new Exception('El número de documento del Comprador no puede exceder los 12 caracteres');
        }
        if (!empty($this->wspse->playerEmailAddress)) {
            if (filter_var($this->wspse->playerEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Comprador no es soportado' . $this->wspse->playerEmailAddress);
            }
        }

        /**
         * Buyer
         */
        if (!empty($this->wspse->buyerDocumentType) && !in_array($this->wspse->buyerDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Comprador no es soportado' . $this->wspse->buyerDocumentType);
        }
        if (!empty($this->wspse->buyerDocument) && (strlen($this->wspse->buyerDocument) > 12)) {
            throw new Exception('El número de documento del Comprador no puede exceder los 12 caracteres');
        }
        if (!empty($this->wspse->buyerEmailAddress)) {
            if (filter_var($this->wspse->buyerEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Comprador no es soportado' . $this->wspse->buyerEmailAddress);
            }
        }


        /**
         * Shipping
         */
        if (!empty($this->wspse->shippingDocumentType) && !in_array($this->wspse->shippingDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Facturador no es soportado' . $this->shippingDocumentType);
        }
        if (!empty($this->wspse->shippingDocument) && (strlen($this->wspse->shippingDocument) > 12)) {
            throw new Exception('El número de documento del Facturador no puede exceder los 12 caracteres');
        }
        if (!empty($this->wspse->shippingEmailAddress)) {
            if (filter_var($this->wspse->shippingEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Facturador no es soportado' . $this->wspse->shippingEmailAddress);
            }
        }
    }

    /**
     * 
     * @param type $str
     * @return type
     */
    private function num($str) {

        return trim(ereg_replace("[^0-9]", '', $str));
    }

    /**
     * 
     * @param type $str
     * @return type
     */
    private function string($str) {

        return trim(preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $str)));
    }

    /**
     * 
     * @param type $text
     * @return type
     */
    public function validatorPSE_check_plain($text) {
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $textplain = $this->validatorPSE_htmlentities($text);
        return $textplain;
    }

    /**
     * 
     * @param type $text
     * @return type
     */
    private function validatorPSE_htmlentities($text) {

        $ALLOWED_TAGS = '';
        $text = str_replace("\'", "'", strip_tags($text, $ALLOWED_TAGS));
        $text = htmlentities(addslashes($text));
        return $text;
    }

    /**
     * 
     * @return type
     */
    private function validatorPSE_detectIp() {

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }

        return $ipAddress;
    }

    /**
     * 
     * @return type
     */
    private function validatorPSE_detectBrowser() {

        $browser = array("IE", "OPERA", "MOZILLA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME");
        $os = array("WIN", "MAC", "LINUX");

        $info['browser'] = "OTHER";
        $info['os'] = "OTHER";

        foreach ($browser as $parent) {
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/', '', $version);
            if ($s) {
                $info['browser'] = $parent;
                $info['version'] = $version;
            }
        }

        foreach ($os as $val) {
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false)
                $info['os'] = $val;
        }

        return $info['browser'] . ' ' . $info['version'];
    }

}
