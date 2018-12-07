<?php
class AlipayAcquireCloseRequest { private $operatorId; private $outTradeNo; private $tradeNo; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setOperatorId($spb2beef) { $this->operatorId = $spb2beef; $this->apiParas['operator_id'] = $spb2beef; } public function getOperatorId() { return $this->operatorId; } public function setOutTradeNo($spa2e706) { $this->outTradeNo = $spa2e706; $this->apiParas['out_trade_no'] = $spa2e706; } public function getOutTradeNo() { return $this->outTradeNo; } public function setTradeNo($spef2c75) { $this->tradeNo = $spef2c75; $this->apiParas['trade_no'] = $spef2c75; } public function getTradeNo() { return $this->tradeNo; } public function getApiMethodName() { return 'alipay.acquire.close'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }