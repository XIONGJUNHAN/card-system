<?php
namespace App\Http\Controllers\Shop; use App\Card; use App\Category; use App\Library\FundHelper; use App\Library\Helper; use App\Product; use App\Order; use App\Library\Response; use App\Library\Pay\Pay as PayApi; use App\Library\Geetest; use App\Mail\OrderShipped; use App\Mail\ProductCountWarn; use App\System; use Carbon\Carbon; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use Illuminate\Support\Facades\Cookie; class Pay extends Controller { public function __construct() { define('SYS_NAME', config('app.name')); define('SYS_URL', config('app.url')); define('SYS_URL_API', config('app.url_api')); } private $payApi = null; public function goPay($sp845342, $spae7e02, $sp998c5c, $sp1cc6bf, $spab4502) { try { (new PayApi())->goPay($sp1cc6bf, $spae7e02, $sp998c5c, $sp998c5c, $spab4502); return self::renderResult($sp845342, array('success' => false, 'title' => '请稍后', 'msg' => '支付方式加载中，请稍后')); } catch (\Exception $sp805d3e) { return self::renderResult($sp845342, array('msg' => $sp805d3e->getMessage())); } } function buy(Request $sp845342) { if ((int) System::_get('vcode_shop_buy') === 1) { $spec9b7c = Geetest\API::verify($sp845342->input('geetest_challenge'), $sp845342->input('geetest_validate'), $sp845342->input('geetest_seccode')); if (!$spec9b7c) { return self::renderResult($sp845342, array('msg' => '系统无法接受您的验证结果，请刷新页面后重试。')); } } $spf10c9d = Cookie::get('customer'); if (strlen($spf10c9d) !== 32) { return self::renderResult($sp845342, array('msg' => '请返回页面重新下单')); } $sp68f2fa = (int) $sp845342->input('category_id'); $sp3c4c73 = (int) $sp845342->input('product_id'); $spda0d90 = (int) $sp845342->input('count'); $sp05f0f3 = $sp845342->input('coupon'); $sp77dac0 = $sp845342->input('email'); $sp1bd511 = (int) $sp845342->input('pay_id'); if (!$sp68f2fa || !$sp3c4c73) { return self::renderResult($sp845342, array('msg' => '请选择商品')); } if (strlen($sp77dac0) < 1) { return self::renderResult($sp845342, array('msg' => '请输入邮箱')); } $sp6680bb = Category::findOrFail($sp68f2fa); if ($sp6680bb->password_open) { if ($sp6680bb->password !== $sp845342->input('category_password')) { return Response::fail('分类密码输入错误'); } } $sp41d615 = Product::where('id', $sp3c4c73)->where('category_id', $sp68f2fa)->where('enabled', 1)->with(array('cards' => function (Relation $sp3eff46) { $sp3eff46->whereRaw('`count_all`>`count_sold`')->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count`')->groupBy('product_id'); }))->first(); if ($sp41d615 == null || $sp41d615->user == null) { return self::renderResult($sp845342, array('msg' => '该商品未找到，请重新选择')); } if ($sp41d615->password_open) { if ($sp41d615->password !== $sp845342->input('product_password')) { return Response::fail('分类密码输入错误'); } } if ($spda0d90 < $sp41d615->buy_min) { return self::renderResult($sp845342, array('msg' => '该商品最少购买' . $sp41d615->buy_min . '件，请重新选择')); } if ($spda0d90 > $sp41d615->buy_max) { return self::renderResult($sp845342, array('msg' => '该商品限购' . $sp41d615->buy_max . '件，请重新选择')); } $sp41d615->setAttribute('count', count($sp41d615->cards) ? $sp41d615->cards[0]->count : 0); if ($sp41d615->count < $spda0d90) { return self::renderResult($sp845342, array('msg' => '该商品库存不足')); } $sp14dff9 = \App\Pay::find($sp1bd511); if ($sp14dff9 == null || !$sp14dff9->enabled) { return self::renderResult($sp845342, array('msg' => '支付方式未找到，请重新选择')); } $sp9522e0 = $sp41d615->price; if ($sp41d615->price_whole) { $spf9ee14 = json_decode($sp41d615->price_whole, true); for ($sp836a84 = count($spf9ee14) - 1; $sp836a84 >= 0; $sp836a84--) { if ($spda0d90 >= (int) $spf9ee14[$sp836a84][0]) { $sp9522e0 = (int) $spf9ee14[$sp836a84][1]; break; } } } $sp6e47a1 = $spda0d90 * $sp9522e0; $spab4502 = $sp6e47a1; $sp25ffe2 = null; if ($sp41d615->support_coupon && strlen($sp05f0f3) > 0) { $sp79854d = \App\Coupon::where('user_id', $sp41d615->user_id)->where('coupon', $sp05f0f3)->where('expire_at', '>', Carbon::now())->whereRaw('`count_used`<`count_all`')->get(); foreach ($sp79854d as $sp994dfa) { if ($sp994dfa->category_id === -1 || $sp994dfa->category_id === $sp68f2fa && ($sp994dfa->product_id === -1 || $sp994dfa->product_id === $sp3c4c73)) { if ($sp994dfa->discount_type === \App\Coupon::DISCOUNT_TYPE_AMOUNT && $spab4502 > $sp994dfa->discount_val) { $sp25ffe2 = $sp994dfa; $spab4502 = $spab4502 - $sp994dfa->discount_val; break; } if ($sp994dfa->discount_type === \App\Coupon::DISCOUNT_TYPE_PERCENT) { $sp25ffe2 = $sp994dfa; $spab4502 = $spab4502 - intval($spab4502 * $sp994dfa->discount_val / 100); break; } } } } if ($sp25ffe2) { $sp25ffe2->status = \App\Coupon::STATUS_USED; $sp25ffe2->count_used++; $sp25ffe2->save(); } $spddfa01 = (int) round($spab4502 * $sp14dff9->fee_system); $spcd4895 = $spab4502 - $spddfa01; $spae7e02 = date('YmdHis') . str_random(5); while (Order::whereOrderNo($spae7e02)->exists()) { $spae7e02 = date('YmdHis') . str_random(5); } Order::insert(array('user_id' => $sp41d615->user_id, 'order_no' => $spae7e02, 'product_id' => $sp3c4c73, 'count' => $spda0d90, 'email' => $sp77dac0, 'ip' => Helper::getIP(), 'customer' => $spf10c9d, 'email_sent' => false, 'cost' => $spda0d90 * $sp41d615->cost, 'price' => $sp6e47a1, 'discount' => $sp6e47a1 - $spab4502, 'paid' => $spab4502, 'pay_id' => $sp14dff9->id, 'fee' => $spddfa01, 'system_fee' => $spddfa01, 'income' => $spcd4895, 'status' => Order::STATUS_UNPAY, 'created_at' => Carbon::now())); $sp998c5c = $spae7e02; return $this->goPay($sp845342, $spae7e02, $sp998c5c, $sp14dff9, $spab4502); } function pay(Request $sp845342, $spae7e02) { $spc9222b = Order::whereOrderNo($spae7e02)->first(); if ($spc9222b == null) { return self::renderResult($sp845342, array('msg' => '订单未找到，请重试')); } if ($spc9222b->status !== \App\Order::STATUS_UNPAY) { return redirect('/pay/result/' . $spae7e02); } $sp4676b9 = 'pay: ' . $spc9222b->pay_id; $sp1cc6bf = $spc9222b->pay; if (!$sp1cc6bf) { \Log::error($sp4676b9 . ' cannot find Pay'); return $this->renderResult($sp845342, array('msg' => '支付方式未找到')); } $sp4676b9 .= ',' . $sp1cc6bf->driver; $sp45b2a0 = json_decode($sp1cc6bf->config, true); $sp45b2a0['payway'] = $sp1cc6bf->way; $sp45b2a0['out_trade_no'] = $spae7e02; try { $this->payApi = PayApi::getDriver($sp1cc6bf->id, $sp1cc6bf->driver); } catch (\Exception $sp805d3e) { \Log::error($sp4676b9 . ' cannot find Driver: ' . $sp805d3e->getMessage()); return $this->renderResult($sp845342, array('msg' => '支付驱动未找到')); } if ($this->payApi->verify($sp45b2a0, function ($spae7e02, $sp983f6f, $spe14c4a) use($sp845342) { try { $this->shipOrder($sp845342, $spae7e02, $sp983f6f, $spe14c4a, FALSE); } catch (\Exception $sp805d3e) { $this->renderResult($sp845342, array('success' => false, 'msg' => $sp805d3e->getMessage())); } })) { \Log::notice($sp4676b9 . ' already success' . '

'); return redirect('/pay/result/' . $spae7e02); } $sp41d615 = Product::where('id', $spc9222b->product_id)->where('enabled', 1)->with(array('cards' => function (Relation $sp3eff46) { $sp3eff46->whereRaw('`count_all`>`count_sold`')->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count`')->groupBy('product_id'); }))->first(); if ($sp41d615 == null) { return self::renderResult($sp845342, array('msg' => '该商品已下架')); } $sp41d615->setAttribute('count', count($sp41d615->cards) ? $sp41d615->cards[0]->count : 0); if ($sp41d615->count < $spc9222b->count) { return self::renderResult($sp845342, array('msg' => '该商品库存不足')); } $sp998c5c = $spae7e02; return $this->goPay($sp845342, $spae7e02, $sp998c5c, $sp1cc6bf, $spc9222b->paid); } function qrcode(Request $sp845342, $spae7e02, $spd9ea2b) { $spc9222b = Order::whereOrderNo($spae7e02)->with('product')->first(); if ($spc9222b == null) { return self::renderResult($sp845342, array('msg' => '订单未找到，请重试')); } if ($spc9222b->product_id !== \App\Product::ID_API && $spc9222b->product == null) { return self::renderResult($sp845342, array('msg' => '商品未找到，请重试')); } $spe14f1b = $sp845342->get('url'); return view('pay/' . $spd9ea2b, array('pay_id' => $spc9222b->pay_id, 'name' => $spc9222b->product_id === \App\Product::ID_API ? $spc9222b->api_out_no : $spc9222b->product->name, 'qrcode' => $spe14f1b, 'id' => $spae7e02)); } function qrQuery(Request $sp845342, $sp1bd511) { $spf7a3d5 = $sp845342->input('id', ''); return self::payReturn($sp845342, $sp1bd511, $spf7a3d5); } function payReturn(Request $sp845342, $sp1bd511, $spd184e1 = '') { $sp4676b9 = 'payReturn: ' . $sp1bd511; \Log::debug($sp4676b9); $sp1cc6bf = \App\Pay::where('id', $sp1bd511)->first(); if (!$sp1cc6bf) { return $this->renderResult($sp845342, array('success' => 0, 'msg' => '支付方式错误')); } $sp4676b9 .= ',' . $sp1cc6bf->driver; if (strlen($spd184e1) > 0) { $spc9222b = Order::whereOrderNo($spd184e1)->first(); if ($spc9222b && ($spc9222b->status === Order::STATUS_PAID || $spc9222b->status === Order::STATUS_SUCCESS)) { \Log::notice($sp4676b9 . ' already success' . '

'); if ($sp845342->ajax()) { return self::renderResult($sp845342, array('success' => 1, 'data' => '/pay/result/' . $spd184e1), array('order' => $spc9222b)); } else { return redirect('/pay/result/' . $spd184e1); } } } try { $this->payApi = PayApi::getDriver($sp1cc6bf->id, $sp1cc6bf->driver); } catch (\Exception $sp805d3e) { \Log::error($sp4676b9 . ' cannot find Driver: ' . $sp805d3e->getMessage()); return $this->renderResult($sp845342, array('success' => 0, 'msg' => '支付驱动未找到')); } $sp45b2a0 = json_decode($sp1cc6bf->config, true); $sp45b2a0['out_trade_no'] = $spd184e1; $sp45b2a0['payway'] = $sp1cc6bf->way; \Log::debug($sp4676b9 . ' will verify'); if ($this->payApi->verify($sp45b2a0, function ($spae7e02, $sp983f6f, $spe14c4a) use($sp845342, $sp4676b9, &$spd184e1) { $spd184e1 = $spae7e02; try { \Log::debug($sp4676b9 . " shipOrder start, order_no: {$spae7e02}, amount: {$sp983f6f}, trade_no: {$spe14c4a}"); $this->shipOrder($sp845342, $spae7e02, $sp983f6f, $spe14c4a, FALSE); \Log::debug($sp4676b9 . ' shipOrder end, order_no: ' . $spae7e02); } catch (\Exception $sp805d3e) { \Log::error($sp4676b9 . ' shipOrder Exception: ' . $sp805d3e->getMessage()); } })) { \Log::debug($sp4676b9 . ' verify finished: 1' . '

'); if ($sp845342->ajax()) { return self::renderResult($sp845342, array('success' => 1, 'data' => '/pay/result/' . $spd184e1)); } else { return redirect('/pay/result/' . $spd184e1); } } else { \Log::debug($sp4676b9 . ' verify finished: 0' . '

'); return $this->renderResult($sp845342, array('success' => 0, 'msg' => '支付验证失败，您可以稍后查看支付状态。')); } } function payNotify(Request $sp845342, $sp1bd511) { $sp4676b9 = 'payNotify pay_id: ' . $sp1bd511; \Log::debug($sp4676b9); $sp1cc6bf = \App\Pay::where('id', $sp1bd511)->first(); if (!$sp1cc6bf) { \Log::error($sp4676b9 . ' cannot find PayModel'); echo 'fail'; die; } $sp4676b9 .= ',' . $sp1cc6bf->driver; try { $this->payApi = PayApi::getDriver($sp1cc6bf->id, $sp1cc6bf->driver); } catch (\Exception $sp805d3e) { \Log::error($sp4676b9 . ' cannot find Driver: ' . $sp805d3e->getMessage()); echo 'fail'; die; } $sp45b2a0 = json_decode($sp1cc6bf->config, true); $sp45b2a0['payway'] = $sp1cc6bf->way; $sp45b2a0['isNotify'] = true; \Log::debug($sp4676b9 . ' will verify'); $spec9b7c = $this->payApi->verify($sp45b2a0, function ($spae7e02, $sp983f6f, $spe14c4a) use($sp845342, $sp4676b9) { try { \Log::debug($sp4676b9 . " shipOrder start, order_no: {$spae7e02}, amount: {$sp983f6f}, trade_no: {$spe14c4a}"); $this->shipOrder($sp845342, $spae7e02, $sp983f6f, $spe14c4a, FALSE); \Log::debug($sp4676b9 . ' shipOrder end, order_no: ' . $spae7e02); } catch (\Exception $sp805d3e) { \Log::error($sp4676b9 . ' shipOrder Exception: ' . $sp805d3e->getMessage()); } }); \Log::debug($sp4676b9 . ' notify finished: ' . (int) $spec9b7c . '

'); die; } function result(Request $sp845342, $spae7e02) { $spc9222b = Order::whereOrderNo($spae7e02)->first(); if ($spc9222b == null) { return self::renderResult($sp845342, array('msg' => '订单未找到，请重试')); } if ($spc9222b->status === Order::STATUS_PAID) { $sp19ef8d = $spc9222b->user->qq; $sp3792af = '商家库存不足，因此卡密没有自动发货，请联系商家客服发货'; if ($sp19ef8d) { $sp3792af .= '<br><a href="http://wpa.qq.com/msgrd?v=3&uin=' . $sp19ef8d . '&site=qq&menu=yes" target="_blank">商家客服QQ:' . $sp19ef8d . '</a>'; } return self::renderResult($sp845342, array('success' => false, 'title' => '订单已支付', 'msg' => $sp3792af), array('order' => $spc9222b)); } elseif ($spc9222b->status === Order::STATUS_SUCCESS) { return $this->shipOrder($sp845342, $spc9222b->order_no, $spc9222b->paid, 0, TRUE); } return self::renderResult($sp845342, array('success' => false, 'msg' => $spc9222b->remark ? '失败原因:<br>' . $spc9222b->remark : '订单支付失败，请重试'), array('order' => $spc9222b)); } function renderResult(Request $sp845342, $spcc4042, $sp868d2c = array()) { if ($sp845342->ajax()) { if (@$spcc4042['success']) { return Response::success($spcc4042['data']); } else { return Response::fail('error', $spcc4042['msg']); } } else { return view('pay.result', array_merge(array('result' => $spcc4042, 'data' => $sp868d2c), $sp868d2c)); } } function shipOrder($sp845342, $spae7e02, $sp983f6f, $spe14c4a, $sp463082 = true) { $spc9222b = Order::whereOrderNo($spae7e02)->first(); if ($spc9222b === null) { \Log::error('shipOrder: No query results for model [App\\Order:' . $spae7e02 . ',trade_no:' . $spe14c4a . ',amount:' . $sp983f6f . ']. die(\'success\');'); die('success'); } if ($spc9222b->paid > $sp983f6f) { \Log::alert('shipOrder, price may error, order_no:' . $spae7e02 . ', paid:' . $spc9222b->paid . ', $amount get:' . $sp983f6f); $spc9222b->remark = '支付金额(' . sprintf('%0.2f', $sp983f6f / 100) . ') 小于 订单金额(' . sprintf('%0.2f', $spc9222b->paid / 100) . ')'; $spc9222b->save(); throw new \Exception($spc9222b->remark); } $sp7c7b9e = array(); $sp0f05cd = '订单#' . $spae7e02 . '&nbsp;已支付，卡号列表：'; $spaeb82d = ''; $sp41d615 = null; $spfe9b2a = $spc9222b->status === Order::STATUS_UNPAY; $sp743c65 = $spfe9b2a && System::_getInt('mail_send_order') === 1 && filter_var($spc9222b->email, FILTER_VALIDATE_EMAIL); if ($spfe9b2a) { \Log::debug('shipOrder.first_process:' . $spae7e02); $sp027e12 = $spc9222b->id; if (FundHelper::orderSuccess($spc9222b, function () use($sp027e12, $spe14c4a, &$sp7c7b9e, &$spaeb82d) { $spc9222b = Order::where('id', $sp027e12)->lockForUpdate()->firstOrFail(); if ($spc9222b->status !== Order::STATUS_UNPAY) { \Log::debug('shipOrder.first_process:' . $spc9222b->order_no . ' already processed!'); return -999; } $sp41d615 = $spc9222b->product()->lockForUpdate()->firstOrFail(); $sp41d615->count_sold += $spc9222b->count; $sp41d615->saveOrFail(); $spc9222b->pay_trade_no = $spe14c4a; $spc9222b->paid_at = Carbon::now(); $sp7c7b9e = Card::where('product_id', $spc9222b->product_id)->whereRaw('`count_sold`<`count_all`')->take($spc9222b->count)->lockForUpdate()->get(); if (count($sp7c7b9e) !== $spc9222b->count) { \Log::alert('订单:' . $spc9222b->order_no . ', 购买数量:' . $spc9222b->count . ', 卡数量:' . count($sp7c7b9e) . ' 卡密不足(已支付 未发货)'); $spc9222b->status = Order::STATUS_PAID; $spc9222b->saveOrFail(); return Order::STATUS_PAID; } else { $spc9222b->status = Order::STATUS_SUCCESS; $spc9222b->saveOrFail(); $spa6b16b = array(); foreach ($sp7c7b9e as $spcee439) { $spaeb82d .= $spcee439->card . '<br>'; $spa6b16b[] = $spcee439->id; } $spc9222b->cards()->attach($spa6b16b); Card::whereIn('id', $spa6b16b)->update(array('status' => Card::STATUS_SOLD, 'count_sold' => \DB::raw('`count_sold`+1'))); return Order::STATUS_SUCCESS; } })) { $sp41d615 = Product::where('id', $spc9222b->product_id)->with(array('cards' => function (Relation $sp3eff46) { $sp3eff46->whereRaw('`count_all`>`count_sold`')->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count`')->groupBy('product_id'); }))->first(); if ($sp41d615) { $spda0d90 = count($sp41d615->cards) ? $sp41d615->cards[0]->count : 0; $sp41d615->setAttribute('count', $spda0d90); if ($sp41d615->count_warn > 0 && $spda0d90 < $sp41d615->count_warn) { try { \Mail::to($spc9222b->user->email)->Queue(new ProductCountWarn($sp41d615, $spda0d90)); } catch (\Exception $sp805d3e) { \App\Library\LogHelper::setLogFile('mail'); \Log::error('shipOrder.count_warn error, product_id:' . $spc9222b->product_id . ', email:' . $spc9222b->user->email . ', Exception:' . $sp805d3e); \App\Library\LogHelper::setLogFile('card'); } } } } else { \Log::error('shipOrder.first_process error, order_no:' . $spae7e02 . ',trade_no:' . $spe14c4a); throw new \Exception('merchant operate exception!'); } } elseif ($sp463082) { $sp7c7b9e = $spc9222b->cards; $sp41d615 = $spc9222b->product; foreach ($sp7c7b9e as $spcee439) { $spaeb82d .= $spcee439->card . '
'; } } if ($sp463082 || $sp743c65) { if (count($sp7c7b9e) < $spc9222b->count) { if (count($sp7c7b9e)) { $sp0f05cd = '目前库存不足，您还有' . ($spc9222b->count - count($sp7c7b9e)) . '张卡密未发货，请联系商家客服发货<br>已发货卡密见下方：<br>'; } else { $sp0f05cd = '目前库存不足，您购买的' . ($spc9222b->count - count($sp7c7b9e)) . '张卡密未发货，请联系商家客服发货<br>'; } $sp19ef8d = $spc9222b->user->qq; if ($sp19ef8d) { $sp0f05cd .= '<a href="http://wpa.qq.com/msgrd?v=3&uin=' . $sp19ef8d . '&site=qq&menu=yes" target="_blank">商家客服QQ:' . $sp19ef8d . '</a><br>'; } } } if ($sp743c65) { $sp3bcdc1 = str_replace('
', '<br>', $spaeb82d); try { \Mail::to($spc9222b->email)->Queue(new OrderShipped($spc9222b, $sp0f05cd, $sp3bcdc1)); $spc9222b->email_sent = true; $spc9222b->saveOrFail(); } catch (\Exception $sp805d3e) { \App\Library\LogHelper::setLogFile('mail'); \Log::error('shipOrder.need_mail error, order_no:' . $spae7e02 . ', email:' . $spc9222b->email . ', cards:' . $sp3bcdc1 . ', Exception:' . $sp805d3e->getMessage()); \App\Library\LogHelper::setLogFile('card'); } } if ($sp463082) { return self::renderResult($sp845342, array('success' => true, 'msg' => $sp0f05cd), array('card_txt' => $spaeb82d, 'order' => $spc9222b, 'product' => $sp41d615)); } return FALSE; } }