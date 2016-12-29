<?php

require_once 'vendor/autoload.php';

use EvandoJunior\CertificateValidator;

$certificate = "path/of/certificate.pfx";

$certificado = CertificateValidator::validate($certificate, "password_of_certificate" , "json/array");

var_dump($certificado);
