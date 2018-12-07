<?php
namespace App\Http\Controllers\Merchant; use App\Library\Helper; use App\Library\Response; use App\System; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use voku\helper\AntiXSS; class Product extends Controller { function get(Request $sp845342) { $sp3eff46 = $this->authQuery($sp845342, \App\Product::class)->with(array('category' => function (Relation $sp3eff46) { $sp3eff46->select(array('id', 'name', 'password_open')); }))->with(array('cards' => function (Relation $sp3eff46) { $sp3eff46->whereRaw('`count_all`>`count_sold`')->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count`')->groupBy('product_id'); })); $sp9d8b43 = $sp845342->post('search', false); $sp752740 = $sp845342->post('val', false); if ($sp9d8b43 && $sp752740) { if ($sp9d8b43 == 'simple') { return Response::success($sp3eff46->where('category_id', $sp752740)->get(array('id', 'name'))); } elseif ($sp9d8b43 == 'id') { $sp3eff46->where('id', $sp752740); } else { $sp3eff46->where($sp9d8b43, 'like', '%' . $sp752740 . '%'); } } $sp68f2fa = (int) $sp845342->post('category_id'); if ($sp68f2fa > 0) { $sp3eff46->where('category_id', $sp68f2fa); } $spd36004 = $sp845342->post('enabled'); if (strlen($spd36004)) { $sp3eff46->whereIn('enabled', explode(',', $spd36004)); } $sp2d1093 = $sp845342->post('current_page', 1); $spfe0c85 = $sp845342->post('per_page', 20); $spd1b01a = $sp3eff46->orderBy('sort')->paginate($spfe0c85, array('*'), 'page', $sp2d1093); foreach ($spd1b01a->items() as $sp41d615) { $sp41d615->setAppends(array('count', 'url')); } return Response::success($spd1b01a); } function sort(Request $sp845342) { $sp3a2be3 = (int) $sp845342->post('id', -1); if (!$sp3a2be3) { return Response::forbidden(); } $sp41d615 = $this->authQuery($sp845342, \App\Product::class)->findOrFail($sp3a2be3); $sp41d615->sort = (int) $sp845342->post('sort', 1000); $sp41d615->save(); return Response::success(); } function category_edit(Request $sp845342) { $sp3a2be3 = (int) $sp845342->post('id'); $sp68f2fa = (int) $sp845342->post('category_id'); if (!$sp3a2be3 || !$sp68f2fa) { return Response::forbidden(); } $sp41d615 = $this->authQuery($sp845342, \App\Product::class)->findOrFail($sp3a2be3); $sp41d615->category_id = $sp68f2fa; $sp41d615->save(); return Response::success(); } function edit(Request $sp845342) { $sp3a2be3 = (int) $sp845342->post('id'); $sp68f2fa = (int) $sp845342->post('category_id'); $spe51eb0 = $sp845342->post('name'); $sp2d3764 = $sp845342->post('description'); $sp5a4753 = $sp845342->post('instructions'); $spd6bd85 = $sp845342->post('sort'); $spd6bd85 = $spd6bd85 === NULL ? 1000 : (int) $spd6bd85; $sp006219 = (int) $sp845342->post('count_warn', 0); $sp417948 = (int) $sp845342->post('buy_min', 0); $spc39721 = (int) $sp845342->post('buy_max', 0); $sp14b559 = $sp845342->post('support_coupon', 0) === 'true'; $spa65220 = $sp845342->post('password'); $spb1ada2 = $sp845342->post('password_open', 0) === 'true'; $sp5b7c9f = (int) ($sp845342->post('cost') * 100); $sp6e47a1 = (int) ($sp845342->post('price') * 100); $spf9ee14 = $sp845342->post('price_whole'); $spd36004 = (int) $sp845342->post('enabled'); if (System::_getInt('filter_words_open') === 1) { $sp20eee6 = explode('|', System::_get('filter_words')); if (($spec9b7c = Helper::filterWords($spe51eb0, $sp20eee6)) !== false) { return Response::fail('提交失败! 商品名称包含敏感词: ' . $spec9b7c); } if (($spec9b7c = Helper::filterWords($sp2d3764, $sp20eee6)) !== false) { return Response::fail('提交失败! 商品描述包含敏感词: ' . $spec9b7c); } if (($spec9b7c = Helper::filterWords($sp5a4753, $sp20eee6)) !== false) { return Response::fail('提交失败! 商品使用说明包含敏感词: ' . $spec9b7c); } } if ($sp417948 < 1 || $sp417948 > 10000) { return Response::fail('最小购买量不能超过10000'); } if ($spc39721 < 1 || $spc39721 > 10000) { return Response::fail('最大购买量不能超过10000'); } if ($sp006219 < 0 || $sp006219 > 10000000) { return Response::fail('库存预警需要在0-10000000之间'); } if ($spd6bd85 < 0 || $spd6bd85 > 10000000) { return Response::fail('排序需要在0-10000000之间'); } if ($sp5b7c9f > 1000000000 || $sp6e47a1 > 1000000000) { return Response::fail('商品价格不能超过10000000, 请重新输入'); } if ($sp5b7c9f < 0 || $sp6e47a1 < 0) { return Response::fail('价格不能为负数'); } $sp41d615 = $this->authQuery($sp845342, \App\Product::class)->find($sp3a2be3); if (!$sp41d615) { $sp41d615 = new \App\Product(); $sp41d615->count_sold = 0; $sp41d615->user_id = $this->getUserIdOrFail($sp845342); } else { if (\App\Card::whereProductId($sp41d615->id)->where('type', \App\Card::TYPE_REPEAT)->whereRaw('`count_all`>`count_sold`')->exists()) { if ($sp417948 !== 1) { return Response::fail('该商品含有重复售卖的卡密, 最小购买量必须为1件'); } if ($spc39721 !== 1) { return Response::fail('该商品含有重复售卖的卡密, 最大购买量必须为1件'); } } } $sp41d615->category_id = $sp68f2fa; $sp41d615->name = $spe51eb0; $spa95a11 = new AntiXSS(); $sp41d615->description = $spa95a11->xss_clean($sp2d3764); $sp41d615->instructions = $spa95a11->xss_clean($sp5a4753); $sp41d615->sort = $spd6bd85; $sp41d615->buy_min = $sp417948; $sp41d615->buy_max = $spc39721; $sp41d615->count_warn = $sp006219; $sp41d615->support_coupon = $sp14b559; $sp41d615->password = $spa65220; $sp41d615->password_open = $spb1ada2; $sp41d615->cost = $sp5b7c9f; $sp41d615->price = $sp6e47a1; $sp41d615->price_whole = $spf9ee14; $sp41d615->enabled = $spd36004; $sp41d615->saveOrFail(); return Response::success(); } function enable(Request $sp845342) { $sp35201d = $sp845342->post('ids', ''); if (strlen($sp35201d) < 1) { return Response::forbidden(); } $spd36004 = (int) $sp845342->post('enabled'); $this->authQuery($sp845342, \App\Product::class)->whereIn('id', explode(',', $sp35201d))->update(array('enabled' => $spd36004)); return Response::success(); } function delete(Request $sp845342) { $sp35201d = $sp845342->post('ids', ''); if (strlen($sp35201d) < 1) { return Response::forbidden(); } $this->authQuery($sp845342, \App\Product::class)->whereIn('id', explode(',', $sp35201d))->delete(); return Response::success(); } }