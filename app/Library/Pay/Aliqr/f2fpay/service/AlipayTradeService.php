<?php
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . './../../AopSdk.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . './../model/result/AlipayF2FPayResult.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../model/result/AlipayF2FQueryResult.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../model/result/AlipayF2FRefundResult.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../model/result/AlipayF2FPrecreateResult.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../model/builder/AlipayTradeQueryContentBuilder.php'; require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '../model/builder/AlipayTradeCancelContentBuilder.php'; require dirname(__FILE__) . DIRECTORY_SEPARATOR . '../config/config.php'; class AlipayTradeService { public $gateway_url = 'https://openapi.alipay.com/gateway.do'; public $notify_url; public $sign_type; public $alipay_public_key; public $private_key; public $appid; public $charset = 'UTF-8'; public $token = NULL; private $MaxQueryRetry; private $QueryDuration; public $format = 'json'; function __construct($sp751298) { $this->gateway_url = $sp751298['gatewayUrl']; $this->appid = $sp751298['app_id']; $this->sign_type = $sp751298['sign_type']; $this->private_key = $sp751298['merchant_private_key']; $this->alipay_public_key = $sp751298['alipay_public_key']; $this->charset = $sp751298['charset']; $this->MaxQueryRetry = $sp751298['MaxQueryRetry']; $this->QueryDuration = $sp751298['QueryDuration']; $this->notify_url = $sp751298['notify_url']; if (empty($this->appid) || trim($this->appid) == '') { throw new Exception('appid should not be NULL!'); } if (empty($this->private_key) || trim($this->private_key) == '') { throw new Exception('private_key should not be NULL!'); } if (empty($this->alipay_public_key) || trim($this->alipay_public_key) == '') { throw new Exception('alipay_public_key should not be NULL!'); } if (empty($this->charset) || trim($this->charset) == '') { throw new Exception('charset should not be NULL!'); } if (empty($this->QueryDuration) || trim($this->QueryDuration) == '') { throw new Exception('QueryDuration should not be NULL!'); } if (empty($this->gateway_url) || trim($this->gateway_url) == '') { throw new Exception('gateway_url should not be NULL!'); } if (empty($this->MaxQueryRetry) || trim($this->MaxQueryRetry) == '') { throw new Exception('MaxQueryRetry should not be NULL!'); } if (empty($this->sign_type) || trim($this->sign_type) == '') { throw new Exception('sign_type should not be NULL'); } } function AlipayWapPayService($sp751298) { $this->__construct($sp751298); } public function barPay($sp16ff63) { $spa2e706 = $sp16ff63->getOutTradeNo(); $sp336810 = $sp16ff63->getBizContent(); $sp5325c3 = $sp16ff63->getAppAuthToken(); $this->writeLog($sp336810); $sp845342 = new AlipayTradePayRequest(); $sp845342->setBizContent($sp336810); $sp73b7ae = $this->aopclientRequestExecute($sp845342, NULL, $sp5325c3); $sp73b7ae = $sp73b7ae->alipay_trade_pay_response; $spcc4042 = new AlipayF2FPayResult($sp73b7ae); if (!empty($sp73b7ae) && '10000' == $sp73b7ae->code) { $spcc4042->setTradeStatus('SUCCESS'); } elseif (!empty($sp73b7ae) && '10003' == $sp73b7ae->code) { $sp06dceb = new AlipayTradeQueryContentBuilder(); $sp06dceb->setOutTradeNo($spa2e706); $sp06dceb->setAppAuthToken($sp5325c3); $spad9a83 = $this->loopQueryResult($sp06dceb); return $this->checkQueryAndCancel($spa2e706, $sp5325c3, $spcc4042, $spad9a83); } elseif ($this->tradeError($sp73b7ae)) { $sp06dceb = new AlipayTradeQueryContentBuilder(); $sp06dceb->setOutTradeNo($spa2e706); $sp06dceb->setAppAuthToken($sp5325c3); $sp75f8bd = $this->query($sp06dceb); return $this->checkQueryAndCancel($spa2e706, $sp5325c3, $spcc4042, $sp75f8bd); } else { $spcc4042->setTradeStatus('FAILED'); } return $spcc4042; } public function queryTradeResult($sp16ff63) { $sp73b7ae = $this->query($sp16ff63); $spcc4042 = new AlipayF2FQueryResult($sp73b7ae); if ($this->querySuccess($sp73b7ae)) { $spcc4042->setTradeStatus('SUCCESS'); } elseif ($this->tradeError($sp73b7ae)) { $spcc4042->setTradeStatus('UNKNOWN'); } else { $spcc4042->setTradeStatus('FAILED'); } return $spcc4042; } public function refund($sp16ff63) { $sp336810 = $sp16ff63->getBizContent(); $this->writeLog($sp336810); $sp845342 = new AlipayTradeRefundRequest(); $sp845342->setBizContent($sp336810); $sp73b7ae = $this->aopclientRequestExecute($sp845342, NULL, $sp16ff63->getAppAuthToken()); $sp73b7ae = $sp73b7ae->alipay_trade_refund_response; $spcc4042 = new AlipayF2FRefundResult($sp73b7ae); if (!empty($sp73b7ae) && '10000' == $sp73b7ae->code) { $spcc4042->setTradeStatus('SUCCESS'); } elseif ($this->tradeError($sp73b7ae)) { $spcc4042->setTradeStatus('UNKNOWN'); } else { $spcc4042->setTradeStatus('FAILED'); } return $spcc4042; } public function qrPay($sp16ff63) { $sp336810 = $sp16ff63->getBizContent(); $this->writeLog($sp336810); $sp845342 = new AlipayTradePrecreateRequest(); $sp845342->setBizContent($sp336810); $sp845342->setNotifyUrl($this->notify_url); $sp73b7ae = $this->aopclientRequestExecute($sp845342, NULL, $sp16ff63->getAppAuthToken()); $sp73b7ae = $sp73b7ae->alipay_trade_precreate_response; $spcc4042 = new AlipayF2FPrecreateResult($sp73b7ae); if (!empty($sp73b7ae) && '10000' == $sp73b7ae->code) { $spcc4042->setTradeStatus('SUCCESS'); } elseif ($this->tradeError($sp73b7ae)) { $spcc4042->setTradeStatus('UNKNOWN'); } else { $spcc4042->setTradeStatus('FAILED'); } return $spcc4042; } public function query($sp06dceb) { $sp8fa80a = $sp06dceb->getBizContent(); $this->writeLog($sp8fa80a); $sp845342 = new AlipayTradeQueryRequest(); $sp845342->setBizContent($sp8fa80a); $sp73b7ae = $this->aopclientRequestExecute($sp845342, NULL, $sp06dceb->getAppAuthToken()); return $sp73b7ae->alipay_trade_query_response; } protected function loopQueryResult($sp06dceb) { $sp552970 = NULL; for ($sp836a84 = 1; $sp836a84 < $this->MaxQueryRetry; $sp836a84++) { try { sleep($this->QueryDuration); } catch (Exception $sp805d3e) { print $sp805d3e->getMessage(); die; } $sp75f8bd = $this->query($sp06dceb); if (!empty($sp75f8bd)) { if ($this->stopQuery($sp75f8bd)) { return $sp75f8bd; } $sp552970 = $sp75f8bd; } } return $sp552970; } protected function stopQuery($sp73b7ae) { if ('10000' == $sp73b7ae->code) { if ('TRADE_FINISHED' == $sp73b7ae->trade_status || 'TRADE_SUCCESS' == $sp73b7ae->trade_status || 'TRADE_CLOSED' == $sp73b7ae->trade_status) { return true; } } return false; } private function checkQueryAndCancel($spa2e706, $sp5325c3, $spcc4042, $sp75f8bd) { if ($this->querySuccess($sp75f8bd)) { $spcc4042->setTradeStatus('SUCCESS'); $spcc4042->setResponse($sp75f8bd); return $spcc4042; } elseif ($this->queryClose($sp75f8bd)) { $spcc4042->setTradeStatus('FAILED'); return $spcc4042; } $spffe356 = new AlipayTradeCancelContentBuilder(); $spffe356->setAppAuthToken($sp5325c3); $spffe356->setOutTradeNo($spa2e706); $sp7b5755 = $this->cancel($spffe356); if ($this->tradeError($sp7b5755)) { $spcc4042->setTradeStatus('UNKNOWN'); } else { $spcc4042->setTradeStatus('FAILED'); } return $spcc4042; } protected function querySuccess($sp75f8bd) { return !empty($sp75f8bd) && $sp75f8bd->code == '10000' && ($sp75f8bd->trade_status == 'TRADE_SUCCESS' || $sp75f8bd->trade_status == 'TRADE_FINISHED'); } protected function queryClose($sp75f8bd) { return !empty($sp75f8bd) && $sp75f8bd->code == '10000' && $sp75f8bd->trade_status == 'TRADE_CLOSED'; } protected function tradeError($sp73b7ae) { return empty($sp73b7ae) || $sp73b7ae->code == '20000'; } public function cancel($spffe356) { $sp8fa80a = $spffe356->getBizContent(); $this->writeLog($sp8fa80a); $sp845342 = new AlipayTradeCancelRequest(); $sp845342->setBizContent($sp8fa80a); $sp73b7ae = $this->aopclientRequestExecute($sp845342, NULL, $spffe356->getAppAuthToken()); return $sp73b7ae->alipay_trade_cancel_response; } private function aopclientRequestExecute($sp845342, $sp91a438 = NULL, $sp5325c3 = NULL) { $spd00f44 = new AopClient(); $spd00f44->gatewayUrl = $this->gateway_url; $spd00f44->appId = $this->appid; $spd00f44->signType = $this->sign_type; $spd00f44->rsaPrivateKey = $this->private_key; $spd00f44->alipayrsaPublicKey = $this->alipay_public_key; $spd00f44->apiVersion = '1.0'; $spd00f44->postCharset = $this->charset; $spd00f44->format = $this->format; $spd00f44->debugInfo = true; $spcc4042 = $spd00f44->execute($sp845342, $sp91a438, $sp5325c3); return $spcc4042; } function writeLog($sp1ca772) { file_put_contents(dirname(__FILE__) . '/../log/log.txt', date('Y-m-d H:i:s') . '  ' . $sp1ca772 . '
', FILE_APPEND); } function create_erweima($spdf4cae, $sp74dd26 = '200', $sp450d19 = 'L', $sp5b2950 = '0') { $spdf4cae = urlencode($spdf4cae); $spdd1fb2 = '<img src="http://chart.apis.google.com/chart?chs=' . $sp74dd26 . 'x' . $sp74dd26 . '&amp;cht=qr&chld=' . $sp450d19 . '|' . $sp5b2950 . '&amp;chl=' . $spdf4cae . '"  widht="' . $sp74dd26 . '" height="' . $sp74dd26 . '" />'; return $spdd1fb2; } function create_erweima_url($spdf4cae, $sp74dd26 = '200', $sp450d19 = 'L', $sp5b2950 = '0') { $spdf4cae = urlencode($spdf4cae); $spdd1fb2 = 'http://chart.apis.google.com/chart?chs=' . $sp74dd26 . 'x' . $sp74dd26 . '&amp;cht=qr&chld=' . $sp450d19 . '|' . $sp5b2950 . '&amp;chl=' . $spdf4cae; return $spdd1fb2; } }