<?php
require_once 'ContentBuilder.php'; class AlipayTradeRefundContentBuilder extends ContentBuilder { private $tradeNo; private $outTradeNo; private $refundAmount; private $outRequestNo; private $refundReason; private $storeId; private $operatorId; private $terminalId; private $bizContentarr = array(); private $bizContent = NULL; public function getBizContent() { if (!empty($this->bizContentarr)) { $this->bizContent = json_encode($this->bizContentarr, JSON_UNESCAPED_UNICODE); } return $this->bizContent; } public function setTradeNo($spef2c75) { $this->tradeNo = $spef2c75; $this->bizContentarr['trade_no'] = $spef2c75; } public function getTradeNo() { return $this->tradeNo; } public function setOutTradeNo($spa2e706) { $this->outTradeNo = $spa2e706; $this->bizContentarr['out_trade_no'] = $spa2e706; } public function getOutTradeNo() { return $this->outTradeNo; } public function setOperatorId($spb2beef) { $this->operatorId = $spb2beef; $this->bizContentarr['operator_id'] = $spb2beef; } public function getOperatorId() { return $this->operatorId; } public function setOutRequestNo($sp4bd328) { $this->outRequestNo = $sp4bd328; $this->bizContentarr['out_request_no'] = $sp4bd328; } public function getOutRequestNo() { return $this->outRequestNo; } public function setRefundAmount($spfe9ffc) { $this->refundAmount = $spfe9ffc; $this->bizContentarr['refund_amount'] = $spfe9ffc; } public function getRefundAmount() { return $this->refundAmount; } public function setRefundReason($spd18526) { $this->refundReason = $spd18526; $this->bizContentarr['refund_reason'] = $spd18526; } public function getRefundReason() { return $this->refundReason; } public function setStoreId($sp8ce52d) { $this->storeId = $sp8ce52d; $this->bizContentarr['store_id'] = $sp8ce52d; } public function getStoreId() { return $this->storeId; } public function setTerminalId($sp2f3cab) { $this->terminalId = $sp2f3cab; $this->bizContentarr['terminal_id'] = $sp2f3cab; } public function getTerminalId() { return $this->terminalId; } }