<?php
namespace App\Library\Pay\Youzan\Open; class Protocol { const SIGN_KEY = 'sign'; const VERSION_KEY = 'v'; const APP_ID_KEY = 'app_id'; const METHOD_KEY = 'method'; const FORMAT_KEY = 'format'; const TOKEN_KEY = 'access_token'; const TIMESTAMP_KEY = 'timestamp'; const SIGN_METHOD_KEY = 'sign_method'; const ALLOWED_DEVIATE_SECONDS = 600; const ERR_SYSTEM = -1; const ERR_INVALID_APP_ID = 40001; const ERR_INVALID_APP = 40002; const ERR_INVALID_TIMESTAMP = 40003; const ERR_EMPTY_SIGNATURE = 40004; const ERR_INVALID_SIGNATURE = 40005; const ERR_INVALID_METHOD_NAME = 40006; const ERR_INVALID_METHOD = 40007; const ERR_INVALID_TEAM = 40008; const ERR_PARAMETER = 41000; const ERR_LOGIC = 50000; public static function sign($sp24e1f1, $spf44b7f, $sp1ebc2f = 'md5') { if (!is_array($spf44b7f)) { $spf44b7f = array(); } ksort($spf44b7f); $sp1ca772 = ''; foreach ($spf44b7f as $sp1e32fe => $sp398610) { $sp1ca772 .= $sp1e32fe . $sp398610; } return self::hash($sp1ebc2f, $sp24e1f1 . $sp1ca772 . $sp24e1f1); } private static function hash($sp1ebc2f, $sp1ca772) { switch ($sp1ebc2f) { case 'md5': default: $sp16bfba = md5($sp1ca772); break; } return $sp16bfba; } public static function allowedSignMethods() { return array('md5'); } public static function allowedFormat() { return array('json'); } }