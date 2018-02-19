<?php

return array(
/** set your paypal credential **/
'client_id' =>'AcXLbwenDdgLjRCmVXNbn9tVX6jAWKfQlAvRSj2doQhPUPcD_avC7jskbB5qvyqYVyb_yzH0hUPMniUY',
'secret' => 'EBx-x92uUIxdz2s-bCNDqwiHxdfsJBLJzlNXqrOFfzfaffO0v37ly9hLFK0lixiRHS-fw8vdroZimxtH',
/**
* SDK configuration
*/
'settings' => array(
/**
* Available option 'sandbox' or 'live'
*/
'mode' => 'sandbox',
/**
* Specify the max request time in seconds
*/
'http.ConnectionTimeOut' => 1000,
/**
* Whether want to log to a file
*/
'log.LogEnabled' => true,
/**
* Specify the file that want to write on
*/
'log.FileName' => storage_path() . '/logs/paypal.log',
/**
* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
*
* Logging is most verbose in the 'FINE' level and decreases as you
* proceed towards ERROR
*/
'log.LogLevel' => 'FINE'
),
);