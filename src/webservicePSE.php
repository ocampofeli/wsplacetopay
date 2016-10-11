<?php

/*
 * @utor Brayan Felipe Ocampo Galeano
 * ocampofeli@gmail.com
 * movil: 301 393 8052
 */

require_once (dirname(dirname(__FILE__)) . '/vendor/autoload.php');
require_once (dirname(__FILE__) . '/authenticationPSE.php');

class webservicePSE {

    private $ambiente = 0;
    //PSE
    private $webservicePSE_test = 'https://test.placetopay.com/soap/pse/?wsdl';
    private $webservicePSE_prod = 'https://placetopay.com/soap/pse/?wsdl';

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
     *
     * @var type 
     */
    public $ipAddress;
    public $userAgent;

    /**
     * @var type 
     */
    private $client = null;

    /*
     * class Adionales
     */
    private $authentication;

    public function __construct() {

        $this->webservicePSE_paramsClient();
        $this->authentication = new authenticationPSE();
    }

    /**
     * 
     */
    private function webservicePSE_paramsClient() {

        switch ($this->ambiente) {

            case 0: //PlacetoPay Test 
                $this->client['webservicePSE'] = $this->webservicePSE_test;
                break;

            case 1: // PlacetoPay Prod 
                $this->client['webservicePSE'] = $this->webservicePSE_prod;
                break;
        }
    }

    /**
     * @param type $metodo
     * @param type $params
     * @return type
     */
    private function webservicePSE_service($metodo, $params) {

        $PlacetoPayPSE = $this->client['webservicePSE'];

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
                'login' => $this->authentication->login,
                'tranKey' => $this->authentication->tranKey,
                'seed' => $this->authentication->seed
        ));
        return $this->webservicePSE_service($metodo, $params);
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
                'login' => $this->authentication->login,
                'tranKey' => $this->authentication->tranKey,
                'seed' => $this->authentication->seed),
            'transactionID' => $transactionID);
        return $this->webservicePSE_service($metodo, $params);
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function webservicePSE_infoPlayer() {

        $params = array(
            'documentType' => $this->playerDocumentType,
            'document' => $this->playerDocument,
            'firstName' => $this->playerFirstName,
            'lastName' => $this->playerLastName,
            'company' => $this->playerCompany,
            'emailAddress' => $this->playerEmailAddress,
            'address' => $this->playerAddress,
            'city' => $this->playerCity,
            'province' => $this->playerProvince,
            'country' => $this->playerCountry,
            'phone' => $this->playerPhone,
            'mobile' => $this->playerMobile,
        );

        return $params;
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function webservicePSE_infoBuyer() {

        $params = array(
            'documentType' => $this->buyerDocumentType,
            'document' => $this->buyerDocument,
            'firstName' => $this->buyerFirstName,
            'lastName' => $this->buyerLastName,
            'company' => $this->buyerCompany,
            'emailAddress' => $this->buyerEmailAddress,
            'address' => $this->buyerAddress,
            'city' => $this->buyerCity,
            'province' => $this->buyerProvince,
            'country' => $this->buyerCountry,
            'phone' => $this->buyerPhone,
            'mobile' => $this->buyerMobile,
        );

        return $params;
    }

    /**
     * 
     * @return array
     * @throws Exception
     */
    private function webservicePSE_infoShipping() {

        $params = array(
            'documentType' => $this->shippingDocumentType,
            'document' => $this->shippingDocument,
            'firstName' => $this->shippingFirstName,
            'lastName' => $this->shippingLastName,
            'company' => $this->shippingCompany,
            'emailAddress' => $this->shippingEmailAddress,
            'address' => $this->shippingAddress,
            'city' => $this->shippingCity,
            'province' => $this->shippingProvince,
            'country' => $this->shippingCountry,
            'phone' => $this->shippingPhone,
            'mobile' => $this->shippingMobile,
        );

        return $params;
    }

    /**
     * 
     */
    public function webservicePSE_setPayment() {

        $metodo = 'createTransaction';

        $params = array(
            'auth' =>
            array(
                'login' => $this->authentication->login,
                'tranKey' => $this->authentication->tranKey,
                'seed' => $this->authentication->seed),
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
                'payer' => $this->webservicePSE_infoPlayer(),
                'buyer' => $this->webservicePSE_infoBuyer(),
                'shipping' => $this->webservicePSE_infoShipping(),
                'ipAddress' => $this->ipAddress,
                'userAgent' => $this->userAgent,
        ));

        $data = $this->webservicePSE_service($metodo, $params);

        if (isset($data['createTransactionResult'])) {
            $this->webservicePSE_responseCreateTransaction($data);
        } else {
            echo $data['faultstring'];
        }
    }

    /**
     * 
     * @param type $param
     */
    private function webservicePSE_responseCreateTransaction($param) {

        $response = $param['createTransactionResult'];

        /*
         * Información para guardar en Base de datos y mantener la sesion activa
         * 
         * array (
          'returnCode' => 'SUCCESS',
          'bankURL' => 'XXX',
          'trazabilityCode' => 'XXX',
          'transactionCycle' => 'XXX',
          'transactionID' => 'XXX',
          'sessionID' => 'XXX',
          'bankCurrency' => 'COP',
          'bankFactor' => '1',
          'responseCode' => '3',
          'responseReasonCode' => '?-',
          'responseReasonText' => 'Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.',
          )
         */

        if (isset($response['returnCode'])) {

            header("Location:" . $response['bankURL']);
        }
    }

}
