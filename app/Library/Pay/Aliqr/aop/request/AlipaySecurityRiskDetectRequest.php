<?php
class AlipaySecurityRiskDetectRequest { private $buyerAccountNo; private $buyerBindBankcard; private $buyerBindBankcardType; private $buyerBindMobile; private $buyerGrade; private $buyerIdentityNo; private $buyerIdentityType; private $buyerRealName; private $buyerRegDate; private $buyerRegEmail; private $buyerRegMobile; private $buyerSceneBankcard; private $buyerSceneBankcardType; private $buyerSceneEmail; private $buyerSceneMobile; private $currency; private $envClientBaseBand; private $envClientBaseStation; private $envClientCoordinates; private $envClientImei; private $envClientImsi; private $envClientIosUdid; private $envClientIp; private $envClientMac; private $envClientScreen; private $envClientUuid; private $itemQuantity; private $itemUnitPrice; private $jsTokenId; private $orderAmount; private $orderCategory; private $orderCredateTime; private $orderItemCity; private $orderItemName; private $orderNo; private $partnerId; private $receiverAddress; private $receiverCity; private $receiverDistrict; private $receiverEmail; private $receiverMobile; private $receiverName; private $receiverState; private $receiverZip; private $sceneCode; private $sellerAccountNo; private $sellerBindBankcard; private $sellerBindBankcardType; private $sellerBindMobile; private $sellerIdentityNo; private $sellerIdentityType; private $sellerRealName; private $sellerRegDate; private $sellerRegEmail; private $sellerRegMoile; private $transportType; private $apiParas = array(); private $terminalType; private $terminalInfo; private $prodCode; private $apiVersion = '1.0'; private $notifyUrl; private $returnUrl; private $needEncrypt = false; public function setBuyerAccountNo($sp2d5c48) { $this->buyerAccountNo = $sp2d5c48; $this->apiParas['buyer_account_no'] = $sp2d5c48; } public function getBuyerAccountNo() { return $this->buyerAccountNo; } public function setBuyerBindBankcard($sp6910da) { $this->buyerBindBankcard = $sp6910da; $this->apiParas['buyer_bind_bankcard'] = $sp6910da; } public function getBuyerBindBankcard() { return $this->buyerBindBankcard; } public function setBuyerBindBankcardType($spa8186f) { $this->buyerBindBankcardType = $spa8186f; $this->apiParas['buyer_bind_bankcard_type'] = $spa8186f; } public function getBuyerBindBankcardType() { return $this->buyerBindBankcardType; } public function setBuyerBindMobile($spc96123) { $this->buyerBindMobile = $spc96123; $this->apiParas['buyer_bind_mobile'] = $spc96123; } public function getBuyerBindMobile() { return $this->buyerBindMobile; } public function setBuyerGrade($spd0e909) { $this->buyerGrade = $spd0e909; $this->apiParas['buyer_grade'] = $spd0e909; } public function getBuyerGrade() { return $this->buyerGrade; } public function setBuyerIdentityNo($sp82a92c) { $this->buyerIdentityNo = $sp82a92c; $this->apiParas['buyer_identity_no'] = $sp82a92c; } public function getBuyerIdentityNo() { return $this->buyerIdentityNo; } public function setBuyerIdentityType($sp833821) { $this->buyerIdentityType = $sp833821; $this->apiParas['buyer_identity_type'] = $sp833821; } public function getBuyerIdentityType() { return $this->buyerIdentityType; } public function setBuyerRealName($spdad890) { $this->buyerRealName = $spdad890; $this->apiParas['buyer_real_name'] = $spdad890; } public function getBuyerRealName() { return $this->buyerRealName; } public function setBuyerRegDate($sp303068) { $this->buyerRegDate = $sp303068; $this->apiParas['buyer_reg_date'] = $sp303068; } public function getBuyerRegDate() { return $this->buyerRegDate; } public function setBuyerRegEmail($spebec05) { $this->buyerRegEmail = $spebec05; $this->apiParas['buyer_reg_email'] = $spebec05; } public function getBuyerRegEmail() { return $this->buyerRegEmail; } public function setBuyerRegMobile($sp6a4d8a) { $this->buyerRegMobile = $sp6a4d8a; $this->apiParas['buyer_reg_mobile'] = $sp6a4d8a; } public function getBuyerRegMobile() { return $this->buyerRegMobile; } public function setBuyerSceneBankcard($sp315d42) { $this->buyerSceneBankcard = $sp315d42; $this->apiParas['buyer_scene_bankcard'] = $sp315d42; } public function getBuyerSceneBankcard() { return $this->buyerSceneBankcard; } public function setBuyerSceneBankcardType($spd00aa3) { $this->buyerSceneBankcardType = $spd00aa3; $this->apiParas['buyer_scene_bankcard_type'] = $spd00aa3; } public function getBuyerSceneBankcardType() { return $this->buyerSceneBankcardType; } public function setBuyerSceneEmail($spd95497) { $this->buyerSceneEmail = $spd95497; $this->apiParas['buyer_scene_email'] = $spd95497; } public function getBuyerSceneEmail() { return $this->buyerSceneEmail; } public function setBuyerSceneMobile($sp3ac79d) { $this->buyerSceneMobile = $sp3ac79d; $this->apiParas['buyer_scene_mobile'] = $sp3ac79d; } public function getBuyerSceneMobile() { return $this->buyerSceneMobile; } public function setCurrency($spe60820) { $this->currency = $spe60820; $this->apiParas['currency'] = $spe60820; } public function getCurrency() { return $this->currency; } public function setEnvClientBaseBand($sp6e06ef) { $this->envClientBaseBand = $sp6e06ef; $this->apiParas['env_client_base_band'] = $sp6e06ef; } public function getEnvClientBaseBand() { return $this->envClientBaseBand; } public function setEnvClientBaseStation($speefc6e) { $this->envClientBaseStation = $speefc6e; $this->apiParas['env_client_base_station'] = $speefc6e; } public function getEnvClientBaseStation() { return $this->envClientBaseStation; } public function setEnvClientCoordinates($sp1815f4) { $this->envClientCoordinates = $sp1815f4; $this->apiParas['env_client_coordinates'] = $sp1815f4; } public function getEnvClientCoordinates() { return $this->envClientCoordinates; } public function setEnvClientImei($sp8988c9) { $this->envClientImei = $sp8988c9; $this->apiParas['env_client_imei'] = $sp8988c9; } public function getEnvClientImei() { return $this->envClientImei; } public function setEnvClientImsi($sp0b3012) { $this->envClientImsi = $sp0b3012; $this->apiParas['env_client_imsi'] = $sp0b3012; } public function getEnvClientImsi() { return $this->envClientImsi; } public function setEnvClientIosUdid($spdb8f22) { $this->envClientIosUdid = $spdb8f22; $this->apiParas['env_client_ios_udid'] = $spdb8f22; } public function getEnvClientIosUdid() { return $this->envClientIosUdid; } public function setEnvClientIp($sp4ee512) { $this->envClientIp = $sp4ee512; $this->apiParas['env_client_ip'] = $sp4ee512; } public function getEnvClientIp() { return $this->envClientIp; } public function setEnvClientMac($sp25f2c6) { $this->envClientMac = $sp25f2c6; $this->apiParas['env_client_mac'] = $sp25f2c6; } public function getEnvClientMac() { return $this->envClientMac; } public function setEnvClientScreen($spc54cb5) { $this->envClientScreen = $spc54cb5; $this->apiParas['env_client_screen'] = $spc54cb5; } public function getEnvClientScreen() { return $this->envClientScreen; } public function setEnvClientUuid($sp6ae387) { $this->envClientUuid = $sp6ae387; $this->apiParas['env_client_uuid'] = $sp6ae387; } public function getEnvClientUuid() { return $this->envClientUuid; } public function setItemQuantity($spd22be7) { $this->itemQuantity = $spd22be7; $this->apiParas['item_quantity'] = $spd22be7; } public function getItemQuantity() { return $this->itemQuantity; } public function setItemUnitPrice($spe0d254) { $this->itemUnitPrice = $spe0d254; $this->apiParas['item_unit_price'] = $spe0d254; } public function getItemUnitPrice() { return $this->itemUnitPrice; } public function setJsTokenId($sp25c639) { $this->jsTokenId = $sp25c639; $this->apiParas['js_token_id'] = $sp25c639; } public function getJsTokenId() { return $this->jsTokenId; } public function setOrderAmount($spf88a63) { $this->orderAmount = $spf88a63; $this->apiParas['order_amount'] = $spf88a63; } public function getOrderAmount() { return $this->orderAmount; } public function setOrderCategory($spf9457b) { $this->orderCategory = $spf9457b; $this->apiParas['order_category'] = $spf9457b; } public function getOrderCategory() { return $this->orderCategory; } public function setOrderCredateTime($sp6aee2c) { $this->orderCredateTime = $sp6aee2c; $this->apiParas['order_credate_time'] = $sp6aee2c; } public function getOrderCredateTime() { return $this->orderCredateTime; } public function setOrderItemCity($spb6ad4b) { $this->orderItemCity = $spb6ad4b; $this->apiParas['order_item_city'] = $spb6ad4b; } public function getOrderItemCity() { return $this->orderItemCity; } public function setOrderItemName($sp9dc743) { $this->orderItemName = $sp9dc743; $this->apiParas['order_item_name'] = $sp9dc743; } public function getOrderItemName() { return $this->orderItemName; } public function setOrderNo($sp882a5c) { $this->orderNo = $sp882a5c; $this->apiParas['order_no'] = $sp882a5c; } public function getOrderNo() { return $this->orderNo; } public function setPartnerId($spc0673e) { $this->partnerId = $spc0673e; $this->apiParas['partner_id'] = $spc0673e; } public function getPartnerId() { return $this->partnerId; } public function setReceiverAddress($sp13d1ef) { $this->receiverAddress = $sp13d1ef; $this->apiParas['receiver_address'] = $sp13d1ef; } public function getReceiverAddress() { return $this->receiverAddress; } public function setReceiverCity($sp70ed69) { $this->receiverCity = $sp70ed69; $this->apiParas['receiver_city'] = $sp70ed69; } public function getReceiverCity() { return $this->receiverCity; } public function setReceiverDistrict($sp6a83cf) { $this->receiverDistrict = $sp6a83cf; $this->apiParas['receiver_district'] = $sp6a83cf; } public function getReceiverDistrict() { return $this->receiverDistrict; } public function setReceiverEmail($sp21ca4c) { $this->receiverEmail = $sp21ca4c; $this->apiParas['receiver_email'] = $sp21ca4c; } public function getReceiverEmail() { return $this->receiverEmail; } public function setReceiverMobile($sp8ef146) { $this->receiverMobile = $sp8ef146; $this->apiParas['receiver_mobile'] = $sp8ef146; } public function getReceiverMobile() { return $this->receiverMobile; } public function setReceiverName($spd2c7ba) { $this->receiverName = $spd2c7ba; $this->apiParas['receiver_name'] = $spd2c7ba; } public function getReceiverName() { return $this->receiverName; } public function setReceiverState($sp0c300e) { $this->receiverState = $sp0c300e; $this->apiParas['receiver_state'] = $sp0c300e; } public function getReceiverState() { return $this->receiverState; } public function setReceiverZip($sp7438a0) { $this->receiverZip = $sp7438a0; $this->apiParas['receiver_zip'] = $sp7438a0; } public function getReceiverZip() { return $this->receiverZip; } public function setSceneCode($spc40249) { $this->sceneCode = $spc40249; $this->apiParas['scene_code'] = $spc40249; } public function getSceneCode() { return $this->sceneCode; } public function setSellerAccountNo($sp26cade) { $this->sellerAccountNo = $sp26cade; $this->apiParas['seller_account_no'] = $sp26cade; } public function getSellerAccountNo() { return $this->sellerAccountNo; } public function setSellerBindBankcard($spd99e46) { $this->sellerBindBankcard = $spd99e46; $this->apiParas['seller_bind_bankcard'] = $spd99e46; } public function getSellerBindBankcard() { return $this->sellerBindBankcard; } public function setSellerBindBankcardType($spf112c9) { $this->sellerBindBankcardType = $spf112c9; $this->apiParas['seller_bind_bankcard_type'] = $spf112c9; } public function getSellerBindBankcardType() { return $this->sellerBindBankcardType; } public function setSellerBindMobile($spf95995) { $this->sellerBindMobile = $spf95995; $this->apiParas['seller_bind_mobile'] = $spf95995; } public function getSellerBindMobile() { return $this->sellerBindMobile; } public function setSellerIdentityNo($spbeda9e) { $this->sellerIdentityNo = $spbeda9e; $this->apiParas['seller_identity_no'] = $spbeda9e; } public function getSellerIdentityNo() { return $this->sellerIdentityNo; } public function setSellerIdentityType($spa77abf) { $this->sellerIdentityType = $spa77abf; $this->apiParas['seller_identity_type'] = $spa77abf; } public function getSellerIdentityType() { return $this->sellerIdentityType; } public function setSellerRealName($spb87987) { $this->sellerRealName = $spb87987; $this->apiParas['seller_real_name'] = $spb87987; } public function getSellerRealName() { return $this->sellerRealName; } public function setSellerRegDate($sp918809) { $this->sellerRegDate = $sp918809; $this->apiParas['seller_reg_date'] = $sp918809; } public function getSellerRegDate() { return $this->sellerRegDate; } public function setSellerRegEmail($sp9a2692) { $this->sellerRegEmail = $sp9a2692; $this->apiParas['seller_reg_email'] = $sp9a2692; } public function getSellerRegEmail() { return $this->sellerRegEmail; } public function setSellerRegMoile($sp445f2d) { $this->sellerRegMoile = $sp445f2d; $this->apiParas['seller_reg_moile'] = $sp445f2d; } public function getSellerRegMoile() { return $this->sellerRegMoile; } public function setTransportType($sp1f5416) { $this->transportType = $sp1f5416; $this->apiParas['transport_type'] = $sp1f5416; } public function getTransportType() { return $this->transportType; } public function getApiMethodName() { return 'alipay.security.risk.detect'; } public function setNotifyUrl($speb4f8d) { $this->notifyUrl = $speb4f8d; } public function getNotifyUrl() { return $this->notifyUrl; } public function setReturnUrl($spb43228) { $this->returnUrl = $spb43228; } public function getReturnUrl() { return $this->returnUrl; } public function getApiParas() { return $this->apiParas; } public function getTerminalType() { return $this->terminalType; } public function setTerminalType($spbed0e7) { $this->terminalType = $spbed0e7; } public function getTerminalInfo() { return $this->terminalInfo; } public function setTerminalInfo($spc510db) { $this->terminalInfo = $spc510db; } public function getProdCode() { return $this->prodCode; } public function setProdCode($sp0605e4) { $this->prodCode = $sp0605e4; } public function setApiVersion($sp6872c2) { $this->apiVersion = $sp6872c2; } public function getApiVersion() { return $this->apiVersion; } public function setNeedEncrypt($spac9c83) { $this->needEncrypt = $spac9c83; } public function getNeedEncrypt() { return $this->needEncrypt; } }