<?php
require_once 'qpayMchUtil.class.php'; class QpayMchAPI { protected $url; protected $isSSL; protected $timeout; public function __construct($sp7a0d0d, $sp02d665, $spb1eeef = 5) { $this->url = $sp7a0d0d; $this->isSSL = $sp02d665; $this->timeout = $spb1eeef; } public function notify_params() { $sp9ae54f = file_get_contents('php://input'); return QpayMchUtil::xmlToArray($sp9ae54f); } public function notify_verify($spf44b7f, $sp45b2a0) { if (!isset($spf44b7f['sign'])) { return false; } $sp885ea3 = QpayMchUtil::getSign($spf44b7f, $sp45b2a0['mch_key']); return $sp885ea3 === $spf44b7f['sign']; } public function req($spf44b7f, $sp45b2a0) { $spec9b7c = array(); $spf44b7f['mch_id'] = $sp45b2a0['mch_id']; $spf44b7f['nonce_str'] = QpayMchUtil::createNoncestr(); $spf44b7f['sign'] = QpayMchUtil::getSign($spf44b7f, $sp45b2a0['mch_key']); $sp9ae54f = QpayMchUtil::arrayToXml($spf44b7f); if (isset($this->isSSL)) { $spec9b7c = QpayMchUtil::reqByCurlSSLPost($sp9ae54f, $this->url, $this->timeout); } else { $spec9b7c = QpayMchUtil::reqByCurlNormalPost($sp9ae54f, $this->url, $this->timeout); } return $spec9b7c; } }