<?php
class AlipayMemberCouponQuerylistRequest { private $merchantInfo; private $pageNo; private $pageSize; private $status; private $userInfo; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setMerchantInfo($spd40f86) { $this->merchantInfo = $spd40f86; $this->apiParas['merchant_info'] = $spd40f86; } public function getMerchantInfo() { return $this->merchantInfo; } public function setPageNo($spa46c83) { $this->pageNo = $spa46c83; $this->apiParas['page_no'] = $spa46c83; } public function getPageNo() { return $this->pageNo; } public function setPageSize($spfe0c85) { $this->pageSize = $spfe0c85; $this->apiParas['page_size'] = $spfe0c85; } public function getPageSize() { return $this->pageSize; } public function setStatus($sp406289) { $this->status = $sp406289; $this->apiParas['status'] = $sp406289; } public function getStatus() { return $this->status; } public function setUserInfo($spbe6c16) { $this->userInfo = $spbe6c16; $this->apiParas['user_info'] = $spbe6c16; } public function getUserInfo() { return $this->userInfo; } public function getApiMethodName() { return 'alipay.member.coupon.querylist'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }