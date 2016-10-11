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
require_once (dirname(__FILE__) . '/src/webservicePSE.php');
require_once (dirname(__FILE__) . '/src/validatorPSE.php');

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

        $this->wsmainpse = new webservicePSE();
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

$pse_p2p = new validatorPSE();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    foreach ($_POST as $key => $value) {
        $pol[$key] = $pse_p2p->validatorPSE_check_plain($_POST[$key]);
    }

    if (!empty($pol)) {
        $pse_p2p->validatorPSE_data($pol);
    }
}


/**
  Información
  Enviar por POST o por GET los campos con los representativo nombre
  Transaction Place to Pay PSE
  @var type

  bankCode = Código de la entidad financiera con la cual realizar la transacción
  bankInterface = Tipo de interfaz del banco a desplegar [0 = PERSONAS, 1 = EMPRESAS]
  returnURL = URL de retorno especificada para la entidad financiera
  reference = Referencia única de pago
  description = Descripción del pago
  language = Idioma esperado para las transacciones acorde a ISO 631-1, mayúscula sostenida
  currency = Moneda a usar para el recaudo acorde a ISO 4217
  totalAmount = Valor total a recaudar
  taxAmount = Discriminación del impuesto aplicado
  devolutionBase = Base de devolución para el impuesto
  tipAmount = Propina u otros valores exentos de impuesto (tasa aeroportuaria) y que deben agregarse al valor total a pagar


  Player Place to Pay PSE
  @var type

  playerDocumentType = Número de identificación de la persona
  playerDocument =  Tipo de documento de identificación de la persona [CC, CE, TI, PPN].
  -------------------- CC = Cédula de ciudanía colombiana
  -------------------- CE = Cédula de extranjería
  -------------------- TI = Tarjeta de identidad
  -------------------- PPN = Pasaporte
  -------------------- NIT = Número de identificación tributaria
  -------------------- SSN = Social Security Number
  playerFirstName = Nombres
  playerLastName = Apellidos
  playerCompany = Nombre de la compañía en la cual labora o representa
  playerEmailAddress = Correo electrónico
  playerAddress = Dirección postal completa
  playerCity = Nombre de la ciudad coincidente con la dirección
  playerProvince = Nombre de la provincia o departamento coincidente con la dirección
  playerCountry = Código internacional del país que aplica a la dirección física acorde a ISO 3166-1, mayúscula sostenida.
  playerPhone = Número de telefonía fija
  playerMobile = Número de telefonía móvil o celular



  Buyer Place to Pay PSE
  @var type

  buyerDocumentType = Número de identificación de la persona
  buyerDocument =  Tipo de documento de identificación de la persona [CC, CE, TI, PPN].
  -------------------- CC = Cédula de ciudanía colombiana
  -------------------- CE = Cédula de extranjería
  -------------------- TI = Tarjeta de identidad
  -------------------- PPN = Pasaporte
  -------------------- NIT = Número de identificación tributaria
  -------------------- SSN = Social Security Number
  buyerFirstName = Nombres
  buyerLastName = Apellidos
  buyerCompany = Nombre de la compañía en la cual labora o representa
  buyerEmailAddress = Correo electrónico
  buyerAddress = Dirección postal completa
  buyerCity = Nombre de la ciudad coincidente con la dirección
  buyerProvince = Nombre de la provincia o departamento coincidente con la dirección
  buyerCountry = Código internacional del país que aplica a la dirección física acorde a ISO 3166-1, mayúscula sostenida.
  buyerPhone = Número de telefonía fija
  buyerMobile = Número de telefonía móvil o celular




  Shipping Place to Pay PSE
  @var type

  shippingDocumentType = Número de identificación de la persona
  shippingDocument =  Tipo de documento de identificación de la persona [CC, CE, TI, PPN].
  -------------------- CC = Cédula de ciudanía colombiana
  -------------------- CE = Cédula de extranjería
  -------------------- TI = Tarjeta de identidad
  -------------------- PPN = Pasaporte
  -------------------- NIT = Número de identificación tributaria
  -------------------- SSN = Social Security Number
  shippingFirstName = Nombres
  shippingLastName = Apellidos
  shippingCompany = Nombre de la compañía en la cual labora o representa
  shippingEmailAddress = Correo electrónico
  shippingAddress = Dirección postal completa
  shippingCity = Nombre de la ciudad coincidente con la dirección
  shippingProvince = Nombre de la provincia o departamento coincidente con la dirección
  shippingCountry = Código internacional del país que aplica a la dirección física acorde a ISO 3166-1, mayúscula sostenida.
  shippingPhone = Número de telefonía fija
  shippingMobile = Número de telefonía móvil o celular
 */
?>