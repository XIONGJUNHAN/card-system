<?php
namespace App\Http\Controllers\Shop; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use App\Library\Response; class Product extends Controller { function get(Request $sp845342) { $sp68f2fa = (int) $sp845342->post('category_id'); if (!$sp68f2fa) { return Response::forbidden('请选择商品分类'); } $sp6680bb = \App\Category::where('id', $sp68f2fa)->first(); if (!$sp6680bb) { return Response::forbidden('商品分类未找到'); } if ($sp6680bb->password_open && $sp845342->post('password') !== $sp6680bb->password) { return Response::fail('分类密码输入错误'); } $spabb398 = \App\Product::where('category_id', $sp68f2fa)->where('enabled', 1)->with(array('cards' => function (Relation $sp3eff46) { $sp3eff46->whereRaw('`count_all`>`count_sold`')->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count`')->groupBy('product_id'); }))->orderBy('sort')->get(); foreach ($spabb398 as $sp41d615) { $sp41d615->setAttribute('count', count($sp41d615->cards) ? $sp41d615->cards[0]->count : 0); $sp41d615->setVisible(array('id', 'name', 'description', 'count', 'buy_min', 'buy_max', 'support_coupon', 'password_open', 'price', 'price_whole')); } return Response::success($spabb398); } function verifyPassword(Request $sp845342) { $sp3c4c73 = (int) $sp845342->post('product_id'); if (!$sp3c4c73) { return Response::forbidden('请选择商品'); } $sp41d615 = \App\Product::where('id', $sp3c4c73)->first(); if (!$sp41d615) { return Response::forbidden('商品未找到'); } if ($sp41d615->password_open && $sp845342->post('password') !== $sp41d615->password) { return Response::fail('商品密码输入错误'); } return Response::success(); } }