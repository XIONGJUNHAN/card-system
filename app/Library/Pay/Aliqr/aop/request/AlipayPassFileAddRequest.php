<?php
class AlipayPassFileAddRequest { private $fileContent; private $recognitionInfo; private $recognitionType; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setFileContent($sp743496) { $this->fileContent = $sp743496; $this->apiParas['file_content'] = $sp743496; } public function getFileContent() { return $this->fileContent; } public function setRecognitionInfo($sp66001d) { $this->recognitionInfo = $sp66001d; $this->apiParas['recognition_info'] = $sp66001d; } public function getRecognitionInfo() { return $this->recognitionInfo; } public function setRecognitionType($sp113b04) { $this->recognitionType = $sp113b04; $this->apiParas['recognition_type'] = $sp113b04; } public function getRecognitionType() { return $this->recognitionType; } public function getApiMethodName() { return 'alipay.pass.file.add'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }