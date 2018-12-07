<?php
class AlipayEcapiprodCreditGetRequest { private $creditNo; private $entityCode; private $entityName; private $isvCode; private $orgCode; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setCreditNo($sp2dc033) { $this->creditNo = $sp2dc033; $this->apiParas['credit_no'] = $sp2dc033; } public function getCreditNo() { return $this->creditNo; } public function setEntityCode($sp35db6c) { $this->entityCode = $sp35db6c; $this->apiParas['entity_code'] = $sp35db6c; } public function getEntityCode() { return $this->entityCode; } public function setEntityName($sp34162a) { $this->entityName = $sp34162a; $this->apiParas['entity_name'] = $sp34162a; } public function getEntityName() { return $this->entityName; } public function setIsvCode($sp147567) { $this->isvCode = $sp147567; $this->apiParas['isv_code'] = $sp147567; } public function getIsvCode() { return $this->isvCode; } public function setOrgCode($sp805f44) { $this->orgCode = $sp805f44; $this->apiParas['org_code'] = $sp805f44; } public function getOrgCode() { return $this->orgCode; } public function getApiMethodName() { return 'alipay.ecapiprod.credit.get'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }