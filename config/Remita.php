<?php



return [
    'MERCHANTID' => getenv('MERCHANTID'),
    'GATEWAYURL' => getenv('GATEWAYURL'),
    "SERVICETYPEID" => getenv('SERVICETYPEID'),
    "ACCEPTANCEID" => getenv('ACCEPTANCEID'),
    "APIKEY" => getenv('APIKEY'),
    "SCREENING_FEES" => getenv('SCREENING_FEES'),
    "AMNESTY_FEES" => getenv('AMNESTY_FEES'),
    "AMNESTY_DESCRIPTION" => getenv('AMNESTY_DESCRIPTION'),
    "PATH" => 'https://' . $_SERVER['HTTP_HOST'],

    "CHECKSTATUSURL" => getenv('CHECKSTATUSURL'),
    "DESCRIPTION" => getenv('DESCRIPTION'),
    "ACCEPTANCE_FEES" => getenv('ACCEPTANCE_FEES'),

];
