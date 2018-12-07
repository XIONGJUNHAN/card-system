<?php
class AlipayEbppBillSearchRequest { private $billKey; private $chargeInst; private $chargeoffInst; private $companyId; private $extend; private $orderType; private $subOrderType; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setBillKey($sp95cb93) { $this->billKey = $sp95cb93; $this->apiParas['bill_key'] = $sp95cb93; } public function getBillKey() { return $this->billKey; } public function setChargeInst($sp0b4d0a) { $this->chargeInst = $sp0b4d0a; $this->apiParas['charge_inst'] = $sp0b4d0a; } public function getChargeInst() { return $this->chargeInst; } public function setChargeoffInst($sp1fda63) { $this->chargeoffInst = $sp1fda63; $this->apiParas['chargeoff_inst'] = $sp1fda63; } public function getChargeoffInst() { return $this->chargeoffInst; } public function setCompanyId($spe71059) { $this->companyId = $spe71059; $this->apiParas['company_id'] = $spe71059; } public function getCompanyId() { return $this->companyId; } public function setExtend($sp2df1ed) { $this->extend = $sp2df1ed; $this->apiParas['extend'] = $sp2df1ed; } public function getExtend() { return $this->extend; } public function setOrderType($sp9b1cc2) { $this->orderType = $sp9b1cc2; $this->apiParas['order_type'] = $sp9b1cc2; } public function getOrderType() { return $this->orderType; } public function setSubOrderType($sp8bfa17) { $this->subOrderType = $sp8bfa17; $this->apiParas['sub_order_type'] = $sp8bfa17; } public function getSubOrderType() { return $this->subOrderType; } public function getApiMethodName() { return 'alipay.ebpp.bill.search'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }