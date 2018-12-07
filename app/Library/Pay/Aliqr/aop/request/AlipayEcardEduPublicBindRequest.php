<?php
class AlipayEcardEduPublicBindRequest { private $agentCode; private $agreementId; private $alipayUserId; private $cardName; private $cardNo; private $publicId; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setAgentCode($sp5e5947) { $this->agentCode = $sp5e5947; $this->apiParas['agent_code'] = $sp5e5947; } public function getAgentCode() { return $this->agentCode; } public function setAgreementId($sp64c6d7) { $this->agreementId = $sp64c6d7; $this->apiParas['agreement_id'] = $sp64c6d7; } public function getAgreementId() { return $this->agreementId; } public function setAlipayUserId($spef4360) { $this->alipayUserId = $spef4360; $this->apiParas['alipay_user_id'] = $spef4360; } public function getAlipayUserId() { return $this->alipayUserId; } public function setCardName($spf0ec05) { $this->cardName = $spf0ec05; $this->apiParas['card_name'] = $spf0ec05; } public function getCardName() { return $this->cardName; } public function setCardNo($sp5cfbd8) { $this->cardNo = $sp5cfbd8; $this->apiParas['card_no'] = $sp5cfbd8; } public function getCardNo() { return $this->cardNo; } public function setPublicId($sp9ed196) { $this->publicId = $sp9ed196; $this->apiParas['public_id'] = $sp9ed196; } public function getPublicId() { return $this->publicId; } public function getApiMethodName() { return 'alipay.ecard.edu.public.bind'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }