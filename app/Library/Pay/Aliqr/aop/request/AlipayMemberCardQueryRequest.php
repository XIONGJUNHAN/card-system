<?php
class AlipayMemberCardQueryRequest { private $bizCardNo; private $cardMerchantInfo; private $cardUserInfo; private $extInfo; private $requestFrom; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setBizCardNo($spf736ac) { $this->bizCardNo = $spf736ac; $this->apiParas['biz_card_no'] = $spf736ac; } public function getBizCardNo() { return $this->bizCardNo; } public function setCardMerchantInfo($spbef472) { $this->cardMerchantInfo = $spbef472; $this->apiParas['card_merchant_info'] = $spbef472; } public function getCardMerchantInfo() { return $this->cardMerchantInfo; } public function setCardUserInfo($spa9de03) { $this->cardUserInfo = $spa9de03; $this->apiParas['card_user_info'] = $spa9de03; } public function getCardUserInfo() { return $this->cardUserInfo; } public function setExtInfo($sp68590a) { $this->extInfo = $sp68590a; $this->apiParas['ext_info'] = $sp68590a; } public function getExtInfo() { return $this->extInfo; } public function setRequestFrom($spb596ff) { $this->requestFrom = $spb596ff; $this->apiParas['request_from'] = $spb596ff; } public function getRequestFrom() { return $this->requestFrom; } public function getApiMethodName() { return 'alipay.member.card.query'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }