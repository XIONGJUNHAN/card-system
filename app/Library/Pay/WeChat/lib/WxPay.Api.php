<?php
require_once 'WxPay.Exception.php'; require_once 'WxPay.Config.php'; require_once 'WxPay.Data.php'; class WxPayApi { public static function unifiedOrder($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/unifiedorder'; if (!$spd32dc5->IsOut_trade_noSet()) { throw new WxPayException('缺少统一支付接口必填参数out_trade_no！'); } else { if (!$spd32dc5->IsBodySet()) { throw new WxPayException('缺少统一支付接口必填参数body！'); } else { if (!$spd32dc5->IsTotal_feeSet()) { throw new WxPayException('缺少统一支付接口必填参数total_fee！'); } else { if (!$spd32dc5->IsTrade_typeSet()) { throw new WxPayException('缺少统一支付接口必填参数trade_type！'); } } } } if ($spd32dc5->GetTrade_type() == 'JSAPI' && !$spd32dc5->IsOpenidSet()) { throw new WxPayException('统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！'); } if ($spd32dc5->GetTrade_type() == 'NATIVE' && !$spd32dc5->IsProduct_idSet()) { throw new WxPayException('统一支付接口中，缺少必填参数product_id！trade_type为JSAPI时，product_id为必填参数！'); } if (!$spd32dc5->IsNotify_urlSet()) { $spd32dc5->SetNotify_url(WxPayConfig::NOTIFY_URL); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function orderQuery($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/orderquery'; if (!$spd32dc5->IsOut_trade_noSet() && !$spd32dc5->IsTransaction_idSet()) { throw new WxPayException('订单查询接口中，out_trade_no、transaction_id至少填一个！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function closeOrder($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/closeorder'; if (!$spd32dc5->IsOut_trade_noSet()) { throw new WxPayException('订单查询接口中，out_trade_no必填！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function refund($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/secapi/pay/refund'; if (!$spd32dc5->IsOut_trade_noSet() && !$spd32dc5->IsTransaction_idSet()) { throw new WxPayException('退款申请接口中，out_trade_no、transaction_id至少填一个！'); } else { if (!$spd32dc5->IsOut_refund_noSet()) { throw new WxPayException('退款申请接口中，缺少必填参数out_refund_no！'); } else { if (!$spd32dc5->IsTotal_feeSet()) { throw new WxPayException('退款申请接口中，缺少必填参数total_fee！'); } else { if (!$spd32dc5->IsRefund_feeSet()) { throw new WxPayException('退款申请接口中，缺少必填参数refund_fee！'); } else { if (!$spd32dc5->IsOp_user_idSet()) { throw new WxPayException('退款申请接口中，缺少必填参数op_user_id！'); } } } } } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, true, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function refundQuery($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/refundquery'; if (!$spd32dc5->IsOut_refund_noSet() && !$spd32dc5->IsOut_trade_noSet() && !$spd32dc5->IsTransaction_idSet() && !$spd32dc5->IsRefund_idSet()) { throw new WxPayException('退款查询接口中，out_refund_no、out_trade_no、transaction_id、refund_id四个参数必填一个！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function downloadBill($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/downloadbill'; if (!$spd32dc5->IsBill_dateSet()) { throw new WxPayException('对账单接口中，缺少必填参数bill_date！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); if (substr($sp73b7ae, 0, 5) == '<xml>') { return ''; } return $sp73b7ae; } public static function micropay($spd32dc5, $sp799d90 = 10) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/pay/micropay'; if (!$spd32dc5->IsBodySet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数body！'); } else { if (!$spd32dc5->IsOut_trade_noSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数out_trade_no！'); } else { if (!$spd32dc5->IsTotal_feeSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数total_fee！'); } else { if (!$spd32dc5->IsAuth_codeSet()) { throw new WxPayException('提交被扫支付API接口中，缺少必填参数auth_code！'); } } } } $spd32dc5->SetSpbill_create_ip($_SERVER['REMOTE_ADDR']); $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function reverse($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/secapi/pay/reverse'; if (!$spd32dc5->IsOut_trade_noSet() && !$spd32dc5->IsTransaction_idSet()) { throw new WxPayException('撤销订单API接口中，参数out_trade_no和transaction_id必须填写一个！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, true, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function report($spd32dc5, $sp799d90 = 1) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/payitil/report'; if (!$spd32dc5->IsInterface_urlSet()) { throw new WxPayException('接口URL，缺少必填参数interface_url！'); } if (!$spd32dc5->IsReturn_codeSet()) { throw new WxPayException('返回状态码，缺少必填参数return_code！'); } if (!$spd32dc5->IsResult_codeSet()) { throw new WxPayException('业务结果，缺少必填参数result_code！'); } if (!$spd32dc5->IsUser_ipSet()) { throw new WxPayException('访问接口IP，缺少必填参数user_ip！'); } if (!$spd32dc5->IsExecute_time_Set()) { throw new WxPayException('接口耗时，缺少必填参数execute_time_！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetUser_ip($_SERVER['REMOTE_ADDR']); $spd32dc5->SetTime(date('YmdHis')); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); return $sp73b7ae; } public static function bizpayurl($spd32dc5, $sp799d90 = 6) { if (!$spd32dc5->IsProduct_idSet()) { throw new WxPayException('生成二维码，缺少必填参数product_id！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetTime_stamp(time()); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); return $spd32dc5->GetValues(); } public static function shorturl($spd32dc5, $sp799d90 = 6) { $sp7a0d0d = 'https://api.mch.weixin.qq.com/tools/shorturl'; if (!$spd32dc5->IsLong_urlSet()) { throw new WxPayException('需要转换的URL，签名用原串，传输需URL encode！'); } $spd32dc5->SetAppid(WxPayConfig::APPID); $spd32dc5->SetMch_id(WxPayConfig::MCHID); $spd32dc5->SetNonce_str(self::getNonceStr()); $spd32dc5->SetSign(); $sp9ae54f = $spd32dc5->ToXml(); $spf760a7 = self::getMillisecond(); $sp73b7ae = self::postXmlCurl($sp9ae54f, $sp7a0d0d, false, $sp799d90); $spcc4042 = WxPayResults::Init($sp73b7ae); self::reportCostTime($sp7a0d0d, $spf760a7, $spcc4042); return $spcc4042; } public static function notify($spd4a88f, &$sp3792af) { $sp9ae54f = file_get_contents('php://input'); try { $spcc4042 = WxPayResults::Init($sp9ae54f); } catch (WxPayException $sp805d3e) { $sp3792af = $sp805d3e->errorMessage(); return false; } return call_user_func($spd4a88f, $spcc4042); } public static function getNonceStr($sp287970 = 32) { $sp60da66 = 'abcdefghijklmnopqrstuvwxyz0123456789'; $spfcf742 = ''; for ($sp836a84 = 0; $sp836a84 < $sp287970; $sp836a84++) { $spfcf742 .= substr($sp60da66, mt_rand(0, strlen($sp60da66) - 1), 1); } return $spfcf742; } public static function replyNotify($sp9ae54f) { echo $sp9ae54f; } private static function reportCostTime($sp7a0d0d, $spf760a7, $sp38c5ae) { if (WxPayConfig::REPORT_LEVENL == 0) { return; } if (WxPayConfig::REPORT_LEVENL == 1 && array_key_exists('return_code', $sp38c5ae) && $sp38c5ae['return_code'] == 'SUCCESS' && array_key_exists('result_code', $sp38c5ae) && $sp38c5ae['result_code'] == 'SUCCESS') { return; } $spd926cb = self::getMillisecond(); $sp2722f5 = new WxPayReport(); $sp2722f5->SetInterface_url($sp7a0d0d); $sp2722f5->SetExecute_time_($spd926cb - $spf760a7); if (array_key_exists('return_code', $sp38c5ae)) { $sp2722f5->SetReturn_code($sp38c5ae['return_code']); } if (array_key_exists('return_msg', $sp38c5ae)) { $sp2722f5->SetReturn_msg($sp38c5ae['return_msg']); } if (array_key_exists('result_code', $sp38c5ae)) { $sp2722f5->SetResult_code($sp38c5ae['result_code']); } if (array_key_exists('err_code', $sp38c5ae)) { $sp2722f5->SetErr_code($sp38c5ae['err_code']); } if (array_key_exists('err_code_des', $sp38c5ae)) { $sp2722f5->SetErr_code_des($sp38c5ae['err_code_des']); } if (array_key_exists('out_trade_no', $sp38c5ae)) { $sp2722f5->SetOut_trade_no($sp38c5ae['out_trade_no']); } if (array_key_exists('device_info', $sp38c5ae)) { $sp2722f5->SetDevice_info($sp38c5ae['device_info']); } try { self::report($sp2722f5); } catch (WxPayException $sp805d3e) { } } private static function postXmlCurl($sp9ae54f, $sp7a0d0d, $sp0e2379 = false, $sp8b5ae8 = 30) { $spb70507 = curl_init(); curl_setopt($spb70507, CURLOPT_TIMEOUT, $sp8b5ae8); if (WxPayConfig::CURL_PROXY_HOST != '0.0.0.0' && WxPayConfig::CURL_PROXY_PORT != 0) { curl_setopt($spb70507, CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST); curl_setopt($spb70507, CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT); } curl_setopt($spb70507, CURLOPT_URL, $sp7a0d0d); curl_setopt($spb70507, CURLOPT_SSL_VERIFYPEER, TRUE); curl_setopt($spb70507, CURLOPT_SSL_VERIFYHOST, 2); curl_setopt($spb70507, CURLOPT_HEADER, FALSE); curl_setopt($spb70507, CURLOPT_RETURNTRANSFER, TRUE); if ($sp0e2379 == true) { curl_setopt($spb70507, CURLOPT_SSLCERTTYPE, 'PEM'); curl_setopt($spb70507, CURLOPT_SSLCERT, WxPayConfig::SSLCERT_PATH); curl_setopt($spb70507, CURLOPT_SSLKEYTYPE, 'PEM'); curl_setopt($spb70507, CURLOPT_SSLKEY, WxPayConfig::SSLKEY_PATH); } else { curl_setopt($spb70507, CURLOPT_SSL_VERIFYPEER, false); } curl_setopt($spb70507, CURLOPT_POST, TRUE); curl_setopt($spb70507, CURLOPT_POSTFIELDS, $sp9ae54f); $sp38c5ae = curl_exec($spb70507); if ($sp38c5ae) { curl_close($spb70507); return $sp38c5ae; } else { $spe85819 = curl_errno($spb70507); \Log::error('WxPat.Api.postXmlCurl Error: ' . curl_error($spb70507)); curl_close($spb70507); throw new WxPayException("curl出错，错误码: {$spe85819}"); } } private static function getMillisecond() { $sp930fdf = explode(' ', microtime()); $sp930fdf = $sp930fdf[1] . $sp930fdf[0] * 1000; $sp0da354 = explode('.', $sp930fdf); $sp930fdf = $sp0da354[0]; return $sp930fdf; } }