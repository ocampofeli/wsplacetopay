<?php
echo "<pre>";
require_once (dirname(__FILE__) . '/wsplacetopay.php');

$wsplacetopay = new wsplacetopay();
    
$listaBancos = $wsplacetopay->getBankList();
var_export($listaBancos);

$transactionID = '1442580951';
$responseTransactionID = $wsplacetopay->getTransactionInformation($transactionID);
//var_export($responseTransactionID);


echo "</pre>"
?>

<!--
<form method="post" action="wsplacetopay.php">
bankCode
<input type="text" name="bankCode">
<br/><br/>
bankInterface
<input type="text" name="bankInterface">
<br/><br/>  
returnURL
<input type="text" name="returnURL">
<br/><br/>
reference
<input type="text" name="reference">
<br/><br/>
description
<input type="text" name="description">
<br/><br/> 
language
<input type="text" name="language">
<br/><br/> 
currency
<input type="text" name="currency">
<br/><br/> 
totalAmount
<input type="text" name="totalAmount">
<br/><br/>
taxAmount
<input type="text" name="taxAmount">
<br/><br/> 
devolutionBase
<input type="text" name="devolutionBase">
<br/><br/>
tipAmount
<input type="text" name="tipAmount">
<br/><br/>
 <br/><br/>   
<br/><br/>
PLAYER
<br/><br/>
Tipo Documento
<input type="text" name="playerDocumentType">
<br/><br/>
Documento
<input type="text" name="playerDocument">
<br/><br/>
Primer Nombre
<input type="text" name="playerFirstName">
<br/><br/>
Segundo Nombre
<input type="text" name="playerLastName">
<br/><br/>
Compañia
<input type="text" name="playerCompany">
<br/><br/>
Email 
<input type="text" name="playerEmailAddress">
<br/><br/>
Dirección
<input type="text" name="playerAddress">
<br/><br/>
Ciudad
<input type="text" name="playerCity">
<br/><br/>
Provincia
<input type="text" name="playerProvince">
<br/><br/>
Pais
<input type="text" name="playerCountry">
<br/><br/>
Telefono
<input type="text" name="playerPhone">
<br/><br/>
Celular
<input type="text" name="playerMobile">    
<br/><br/>
BUYER
<br/><br/>
Tipo Documento
<input type="text" name="buyerDocumentType">
<br/><br/>
Documento
<input type="text" name="buyerDocument">
<br/><br/>
Primer Nombre
<input type="text" name="buyerFirstName">
<br/><br/>
Segundo Nombre
<input type="text" name="buyerLastName">
<br/><br/>
Compañia
<input type="text" name="buyerCompany">
<br/><br/>
Email 
<input type="text" name="buyerEmailAddress">
<br/><br/>
Dirección
<input type="text" name="buyerAddress">
<br/><br/>
Ciudad
<input type="text" name="buyerCity">
<br/><br/>
Provincia
<input type="text" name="buyerProvince">
<br/><br/>
Pais
<input type="text" name="buyerCountry">
<br/><br/>
Telefono
<input type="text" name="buyerPhone">
<br/><br/>
Celular
<input type="text" name="buyerMobile">
<br/><br/>
SHIPPING
<br/><br/>
Tipo Documento
<input type="text" name="shippingDocumentType">
<br/><br/>
Documento
<input type="text" name="shippingDocument">
<br/><br/>
Primer Nombre
<input type="text" name="shippingFirstName">
<br/><br/>
Segundo Nombre
<input type="text" name="shippingLastName">
<br/><br/>
Compañia
<input type="text" name="shippingCompany">
<br/><br/>
Email 
<input type="text" name="shippingEmailAddress">
<br/><br/>
Dirección
<input type="text" name="shippingAddress">
<br/><br/>
Ciudad
<input type="text" name="shippingCity">
<br/><br/>
Provincia
<input type="text" name="shippingProvince">
<br/><br/>
Pais
<input type="text" name="shippingCountry">
<br/><br/>
Telefono
<input type="text" name="shippingPhone">
<br/><br/>
Celular
<input type="text" name="shippingMobile">
<br/><br/>
<input type="submit" value="click">
</form>