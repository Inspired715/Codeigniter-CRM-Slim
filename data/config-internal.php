<?php
return [
  'database' => [
    'host' => 'localhost',
    'port' => '',
    'charset' => NULL,
    'dbname' => 'crm',
    'user' => 'root',
    'password' => '',
    'driver' => 'pdo_mysql',
    'platform' => 'Mysql'
  ],
  'smtpPassword' => 'QWEASDQWEASD',
  'logger' => [
    'path' => 'data/logs/espo.log',
    'level' => 'WARNING',
    'rotation' => true,
    'maxFileNumber' => 30,
    'printTrace' => false
  ],
  'restrictedMode' => false,
  'webSocketMessager' => 'ZeroMQ',
  'clientSecurityHeadersDisabled' => false,
  'clientCspDisabled' => false,
  'clientCspScriptSourceList' => [
    0 => 'https://maps.googleapis.com'
  ],
  'isInstalled' => true,
  'microtimeInternal' => 1695414460.203788,
  'passwordSalt' => '086879e53126e36b',
  'cryptKey' => 'ae39f24507bd79c982461cc1f3fac13e',
  'hashSecretKey' => '248f3adb5e86fe7ae67f517b0659e613',
  'actualDatabaseType' => 'mariadb',
  'actualDatabaseVersion' => '10.4.24'
];
