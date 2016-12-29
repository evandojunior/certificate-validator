<?php
namespace EvandoJunior;

class CertificateValidator {

    /**
     * Extrai as principais informacoes contidas no certificado digital
     * @author Evando Junior
     * @param string $file  = path/do/certificado.pfx
     * @param string $pass = senha do certificado digital
     * @param string $return_type = voce quer um JSON ou ARRAY?
     * @return array com as informações lindas :)
     */
    public static function validate($file, $pass, $return_type = "array"){
        try {

            $certs = [];

            if ( !$file = file_get_contents($file) ) {
               throw new \Exception("O certificado digital não foi localizado", 1);
            }

            if( !openssl_pkcs12_read($file, $certs, $pass) ) {
                throw new \Exception("Falha ao abrir certificado digital", 1);
            }

            $content = openssl_x509_parse( openssl_x509_read($certs['cert']) );
            
            $info = [
            'model' => $content['subject']['OU'][1],
            'company_owner' => explode(':', $content['subject']['CN'])[0],
            'cnpj' => explode(':', $content['subject']['CN'])[1],
            'company_issuer' => $content['subject']['OU'][2],
            'agency' => $content['issuer']['CN'],
            'city' => $content['subject']['L'],
            'state' => $content['subject']['ST'],
            'country' => $content['subject']['C'],
            'creation_date' => date('Y-m-d', $content['validFrom_time_t']),
            'due_date' => date('Y-m-d', $content['validTo_time_t']),
            'expired'=> $content['validTo_time_t'] > strtotime(date('Y-m-d')) ? false : true
            ];
            
            return ($return_type == "json") ? json_encode($info) : $info;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
