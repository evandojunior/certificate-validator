# CertificateValidator

Uma solução para extrair os dados do certificado digital A1

# Modo de uso

```php
<?php
require_once vendor/autoload.php;

use EvandoJunior\CertificateValidator;

$certificate = "path/of/certificate.pfx";


$certificado = CertificateValidator::validate($certificate, "password_of_certificate", $return_type);

var_dump($certificado);

```

Você terá uma array com os indices:
```php
model =>  o modelo do certificado digital
company_owner =>  o dono do certificado digital,
cnpj =>  CNPJ da empresa dona do certificado,
company_issuer =>  empresa que emitiu o certificado,
agency => orgão homologador do certificado,
city => cidade,
state => estado,
country => país,
creation_date => data de criação no formato (Y-m-d),
due_date => data de vencimento no formato (Y-m-d),
expired=> booleano, se o certificado estiver vencido ou não
```

# JSON ou ARRAY
Caso você queira retornar um JSON 
é só passar uma string "json" no terceiro parametro
```php
<?php
CertificateValidator::validate($certificate, "password_of_certificate", "json");
```

### Espero que seja útil o quanto é para mim :)
