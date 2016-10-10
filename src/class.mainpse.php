<?php

/*
 * @utor Brayan Felipe Ocampo Galeano
 * ocampofeli@gmail.com
 * movil: 301 393 8052
 */

require_once (dirname(dirname(__FILE__)) . '/vendor/autoload.php');

class wsmainpse {

    private $ambiente = 0; //Ambiente

    /**
     * @var type 
     */
    private $identificador = '6dd490faf9cb87a9862245da41170ff2';
    //Llave transaccional  
    private $tranKey = '024h1IlD';


    /* ----WSDL Soap */
    //PSE
    private $placetopay_wspse_test = 'https://test.placetopay.com/soap/pse/?wsdl';
    private $placetopay_wspse_prod = 'https://placetopay.com/soap/pse/?wsdl';

    /**
     * Accesos
     * @var type 
     */
    private $login;
    private $seed;

    /**
     * Transaction Place to Pay PSE
     * @var type 
     */
    public $bankCode;
    public $bankInterface;
    public $returnURL;
    public $reference;
    public $description;
    public $totalAmount;
    public $taxAmount;
    public $devolutionBase;
    public $tipAmount;

    /**
     *
     * @var type 
     */
    public $language;
    public $currency;

    /**
     * Player Place to Pay PSE
     * @var type 
     */
    public $playerDocumentType;
    public $playerDocument;
    public $playerFirstName;
    public $playerLastName;
    public $playerCompany;
    public $playerEmailAddress;
    public $playerAddress;
    public $playerCity;
    public $playerProvince;
    public $playerCountry;
    public $playerPhone;
    public $playerMobile;

    /**
     * Buyer Place to Pay PSE
     * @var type 
     */
    public $buyerDocumentType;
    public $buyerDocument;
    public $buyerFirstName;
    public $buyerLastName;
    public $buyerCompany;
    public $buyerEmailAddress;
    public $buyerAddress;
    public $buyerCity;
    public $buyerProvince;
    public $buyerCountry;
    public $buyerPhone;
    public $buyerMobile;

    /**
     * Shipping Place to Pay PSE
     * @var type 
     */
    public $shippingDocumentType;
    public $shippingDocument;
    public $shippingFirstName;
    public $shippingLastName;
    public $shippingCompany;
    public $shippingEmailAddress;
    public $shippingAddress;
    public $shippingCity;
    public $shippingProvince;
    public $shippingCountry;
    public $shippingPhone;
    public $shippingMobile;

    /**
     * @var type 
     */
    private $client = null;
    private $userAgent = null;
    private $ipAddress = null;
    public $response;

    public function __construct() {
        $this->client = array();
        $this->placetopay_paramsClient();

        $this->login = $this->identificador;
        $this->seed = date('c');
        $this->tranKey = sha1($this->seed . $this->tranKey, false);
    }

    /**
     * 
     */
    private function placetopay_paramsClient() {

        switch ($this->ambiente) {

            case 0: //PlacetoPay Test 
                $this->client['placetopay_wspse'] = $this->placetopay_wspse_test;
                break;

            case 1: // PlacetoPay Prod 
                $this->client['placetopay_wspse'] = $this->placetopay_wspse_prod;
                break;
        }
    }

    /**
     * @param type $metodo
     * @param type $params
     * @return type
     */
    private function placetopay_wspse_service($metodo, $params) {

        $PlacetoPayPSE = $this->client['placetopay_wspse'];

        try {
            ini_set("default_socket_timeout", "20");
            $client = new nusoap_client($PlacetoPayPSE, 'wsdl');
            return $client->call($metodo, $params);
        } catch (SoapFault $exception) {

            $detalle = $exception->faultcode . "-" . $exception->faultstring;
            throw new Exception('FailWS - placetoPay_PSE' . $detalle);
        }
    }

    /**
     * @param type $login
     * @param type $tranKey
     * @return type
     */
    public function getBankList() {

        $metodo = 'getBankList';
        $params = array(
            'auth' =>
            array(
                'login' => $this->login,
                'tranKey' => $this->tranKey,
                'seed' => $this->seed
        ));
        return $this->placetopay_wspse_service($metodo, $params);
    }

    /**
     * @param type $login
     * @param type $tranKey
     * @param type $transactionID
     * @return type
     */
    public function getTransactionInformation($transactionID) {

        $metodo = 'getTransactionInformation';
        $params = array(
            'auth' =>
            array(
                'login' => $this->login,
                'tranKey' => $this->tranKey,
                'seed' => $this->seed),
            'transactionID' => $transactionID);
        return $this->placetopay_wspse_service($metodo, $params);
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function placetopay_wspse_infoPlayer() {

        if (!empty($this->playerDocumentType) && !in_array($this->playerDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Comprador no es soportado' . $this->playerDocumentType);
        }
        if (!empty($this->playerDocument) && (strlen($this->playerDocument) > 12)) {
            throw new Exception('El número de documento del Comprador no puede exceder los 12 caracteres');
        }
        if (!empty($this->playerEmailAddress)) {
            if (filter_var($this->playerEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Comprador no es soportado' . $this->playerEmailAddress);
            }
        }

        $params = array(
            'documentType' => (empty($this->playerDocumentType) ? '' : $this->playerDocumentType),
            'document' => (empty($this->playerDocument) ? '' : ereg_replace("[^0-9]", '', $this->playerDocument)),
            'firstName' => (empty($this->playerFirstName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->playerFirstName))),
            'lastName' => (empty($this->playerLastName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->playerLastName))),
            'company' => (empty($this->playerCompany) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->playerCompany))),
            'emailAddress' => (empty($this->playerEmailAddress) ? '' : $this->playerEmailAddress),
            'address' => (empty($this->playerAddress) ? '' : $this->playerAddress),
            'city' => (empty($this->playerCity) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->playerCity))),
            'province' => (empty($this->playerProvince) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->playerProvince))),
            'country' => (empty($this->playerCountry) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->playerCountry))),
            'phone' => (empty($this->playerPhone) ? '' : ereg_replace("[^0-9]", '', $this->playerPhone)),
            'mobile' => (empty($this->playerMobile) ? '' : ereg_replace("[^0-9]", '', $this->playerMobile)),
        );

        return $params;
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function placetopay_wspse_infoBuyer() {

        if (!empty($this->buyerDocumentType) && !in_array($this->buyerDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Comprador no es soportado' . $this->buyerDocumentType);
        }
        if (!empty($this->buyerDocument) && (strlen($this->buyerDocument) > 12)) {
            throw new Exception('El número de documento del Comprador no puede exceder los 12 caracteres');
        }
        if (!empty($this->buyerEmailAddress)) {
            if (filter_var($this->buyerEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Comprador no es soportado' . $this->buyerEmailAddress);
            }
        }

        $params = array(
            'documentType' => (empty($this->buyerDocumentType) ? '' : $this->buyerDocumentType),
            'document' => (empty($this->buyerDocument) ? '' : ereg_replace("[^0-9]", '', $this->buyerDocument)),
            'firstName' => (empty($this->buyerFirstName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->buyerFirstName))),
            'lastName' => (empty($this->buyerLastName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->buyerLastName))),
            'company' => (empty($this->buyerCompany) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->buyerCompany))),
            'emailAddress' => (empty($this->buyerEmailAddress) ? '' : $this->buyerEmailAddress),
            'address' => (empty($this->buyerAddress) ? '' : $this->buyerAddress),
            'city' => (empty($this->buyerCity) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->buyerCity))),
            'province' => (empty($this->buyerProvince) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->buyerProvince))),
            'country' => (empty($this->buyerCountry) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->buyerCountry))),
            'phone' => (empty($this->buyerPhone) ? '' : ereg_replace("[^0-9]", '', $this->buyerPhone)),
            'mobile' => (empty($this->buyerMobile) ? '' : ereg_replace("[^0-9]", '', $this->buyerMobile)),
        );

        return $params;
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function placetopay_wspse_infoShipping() {

        //Validaciones

        if (!empty($this->shippingDocumentType) && !in_array($this->shippingDocumentType, array('CC', 'CE', 'TI', 'PPN', 'NIT', 'COD'))) {
            throw new Exception('El tipo de documento del Facturador no es soportado' . $this->shippingDocumentType);
        }
        if (!empty($this->shippingDocument) && (strlen($this->shippingDocument) > 12)) {
            throw new Exception('El número de documento del Facturador no puede exceder los 12 caracteres');
        }
        if (!empty($this->shippingEmailAddress)) {
            if (filter_var($this->shippingEmailAddress, FILTER_VALIDATE_EMAIL)) {
                
            } else {
                throw new Exception('El tipo de correo del Facturador no es soportado' . $this->shippingEmailAddress);
            }
        }

        $params = array(
            'documentType' => (empty($this->shippingDocumentType) ? '' : $this->shippingDocumentType),
            'document' => (empty($this->shippingDocument) ? '' : ereg_replace("[^0-9]", '', $this->shippingDocument)),
            'firstName' => (empty($this->shippingFirstName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->shippingFirstName))),
            'lastName' => (empty($this->shippingLastName) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->shippingLastName))),
            'company' => (empty($this->shippingCompany) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->shippingCompany))),
            'emailAddress' => (empty($this->shippingEmailAddress) ? '' : $this->shippingEmailAddress),
            'address' => (empty($this->shippingAddress) ? '' : $this->shippingAddress),
            'city' => (empty($this->shippingCity) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->shippingCity))),
            'province' => (empty($this->shippingProvince) ? '' : preg_replace('/[ ]+/', '', ereg_replace("[^A-Za-z]", ' ', $this->shippingProvince))),
            'country' => (empty($this->shippingCountry) ? '' : preg_replace('/[ ]+/', ' ', ereg_replace("[^A-Za-z]", ' ', $this->shippingCountry))),
            'phone' => (empty($this->shippingPhone) ? '' : ereg_replace("[^0-9]", '', $this->shippingPhone)),
            'mobile' => (empty($this->shippingMobile) ? '' : ereg_replace("[^0-9]", '', $this->shippingMobile)),
        );

        return $params;
    }

    public function placetopay_wspse_setPayment() {

        $this->placetopay_wspse_detectIp();
        $this->placetopay_wspse_detectBrowser();

        $metodo = 'createTransaction';
        $auth = array(
            'auth' =>
            array(
                'login' => $this->login,
                'tranKey' => $this->tranKey,
                'seed' => $this->seed
        ));

        $params = array(
            'auth' =>
            array(
                'login' => $this->login,
                'tranKey' => $this->tranKey,
                'seed' => $this->seed),
            'transaction' =>
            array(
                'bankCode' => $this->bankCode,
                'bankInterface' => $this->bankInterface,
                'returnURL' => $this->returnURL,
                'reference' => $this->reference,
                'description' => $this->description,
                'language' => $this->language,
                'currency' => $this->currency,
                'totalAmount' => $this->totalAmount,
                'taxAmount' => $this->taxAmount,
                'devolutionBase' => $this->devolutionBase,
                'tipAmount' => $this->tipAmount,
                'payer' => $this->placetopay_wspse_infoPlayer(),
                'buyer' => $this->placetopay_wspse_infoBuyer(),
                'shipping' => $this->placetopay_wspse_infoShipping(),
                'ipAddress' => $this->ipAddress,
                'userAgent' => $this->userAgent,
        ));

        $data = $this->placetopay_wspse_service($metodo, $params);
        echo "<pre>";
        var_export($data);
        echo "</pre>";
    }

    private function placetopay_wspse_detectIp() {
        
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $this->ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
    }

    private function placetopay_wspse_detectBrowser() {
        
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

        $this->userAgent = $info['browser'] . ' ' . $info['version'];
    }

}
