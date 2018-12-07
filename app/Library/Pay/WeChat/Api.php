<?php
namespace App\Library\Pay\WeChat; use App\Library\Helper; use App\Library\Pay\ApiInterface; use Illuminate\Support\Facades\Log; class Api implements ApiInterface { private $url_notify = ''; private $url_return = ''; public function __construct($sp3a2be3) { $this->url_notify = SYS_URL_API . '/pay/notify/' . $sp3a2be3; $this->url_return = SYS_URL . '/pay/return/' . $sp3a2be3; } function goPay($sp45b2a0, $spd184e1, $sp873da9, $sp33eb4d, $sp521b2c) { $sp983f6f = $sp521b2c; $sp1cc6bf = strtoupper($sp45b2a0['payway']); $this->defineWxConfig($sp45b2a0); require_once __DIR__ . '/lib/WxPay.Api.php'; require_once 'WxPay.NativePay.php'; require_once 'wxLog.php'; $spe754f9 = new \NativePay(); $sp11f4cb = new \WxPayUnifiedOrder(); $sp11f4cb->SetBody($sp873da9); $sp11f4cb->SetAttach($spd184e1); $sp11f4cb->SetOut_trade_no($spd184e1); $sp11f4cb->SetTotal_fee($sp983f6f); $sp11f4cb->SetTime_start(date('YmdHis')); $sp11f4cb->SetTime_expire(date('YmdHis', time() + 600)); $sp11f4cb->SetGoods_tag('pay'); $sp11f4cb->SetNotify_url($this->url_notify); $sp11f4cb->SetTrade_type($sp1cc6bf); if ($sp1cc6bf === 'MWEB') { $sp11f4cb->SetScene_info('{"h5_info": {"type":"Wap","wap_url": "' . SYS_URL . '","wap_name": "发卡平台"}}'); } $sp11f4cb->SetProduct_id($spd184e1); $sp11f4cb->SetSpbill_create_ip(Helper::getIP()); function getResultUrl($spd184e1, $spcc4042, $spa8a71b) { if (!isset($spcc4042[$spa8a71b])) { Log::error('Pay.WeChat.goPay, order_no:' . $spd184e1 . ', error:' . json_encode($spcc4042)); if (isset($spcc4042['err_code_des'])) { throw new \Exception($spcc4042['err_code_des']); } if (isset($spcc4042['return_msg'])) { throw new \Exception($spcc4042['return_msg']); } throw new \Exception('获取支付数据失败'); } return $spcc4042[$spa8a71b]; } if ($sp1cc6bf === 'NATIVE') { $spcc4042 = $spe754f9->GetPayUrl($sp11f4cb); $sp7a0d0d = getResultUrl($spd184e1, $spcc4042, 'code_url'); header('location: /qrcode/pay/' . $spd184e1 . '/wechat?url=' . urlencode($sp7a0d0d)); } elseif ($sp1cc6bf === 'MWEB') { $spcc4042 = $spe754f9->GetH5PayUrl($sp11f4cb); $sp7a0d0d = getResultUrl($spd184e1, $spcc4042, 'mweb_url'); echo view('utils.redirect', array('url' => $sp7a0d0d)); } die; } private function defineWxConfig($sp45b2a0) { if (!defined('wx_APPID')) { define('wx_APPID', $sp45b2a0['APPID']); } if (!defined('wx_MCHID')) { define('wx_MCHID', $sp45b2a0['MCHID']); } if (!defined('wx_KEY')) { define('wx_KEY', $sp45b2a0['KEY']); } if (!defined('wx_APPSECRET')) { define('wx_APPSECRET', $sp45b2a0['APPSECRET']); } } function verify($sp45b2a0, $spf85c0e) { $sp5c8ce2 = isset($sp45b2a0['isNotify']) && $sp45b2a0['isNotify']; $this->defineWxConfig($sp45b2a0); require_once __DIR__ . '/lib/WxPay.Api.php'; require_once 'wxLog.php'; if ($sp5c8ce2) { return (new PayNotifyCallBack($spf85c0e))->Handle(false); } else { $spd184e1 = @$sp45b2a0['out_trade_no']; $sp11f4cb = new \WxPayOrderQuery(); $sp11f4cb->SetOut_trade_no($spd184e1); $spcc4042 = \WxPayApi::orderQuery($sp11f4cb); if (array_key_exists('trade_state', $spcc4042) && $spcc4042['trade_state'] == 'SUCCESS') { call_user_func_array($spf85c0e, array($spcc4042['out_trade_no'], $spcc4042['total_fee'], $spcc4042['transaction_id'])); return true; } else { return false; } } } }