<?php
use Illuminate\Database\Seeder; class ProductsSeeder extends Seeder { public function run() { $spfedf4e = \App\User::first()->id; $sp6680bb = new \App\Category(); $sp6680bb->user_id = $spfedf4e; $sp6680bb->name = '测试分组'; $sp6680bb->enabled = true; $sp6680bb->save(); $sp6680bb = new \App\Category(); $sp6680bb->user_id = $spfedf4e; $sp6680bb->name = '这里是一个啦啦啦啦啦啦超级无敌爆炸螺旋长的商品类别标题'; $sp6680bb->enabled = true; $sp6680bb->save(); $sp6680bb = new \App\Category(); $sp6680bb->user_id = $spfedf4e; $sp6680bb->name = '密码123456'; $sp6680bb->enabled = true; $sp6680bb->password = '123456'; $sp6680bb->password_open = true; $sp6680bb->save(); $sp41d615 = new \App\Product(); $sp41d615->user_id = $spfedf4e; $sp41d615->category_id = 1; $sp41d615->name = '测试商品'; $sp41d615->description = '这里是测试商品的一段简短的描述, 可以插入html文本'; $sp41d615->price = 1; $sp41d615->enabled = true; $sp41d615->support_coupon = true; $sp41d615->save(); $sp41d615 = new \App\Product(); $sp41d615->user_id = $spfedf4e; $sp41d615->category_id = 1; $sp41d615->name = '这个商品有密码123456'; $sp41d615->description = '<h2>商品描述</h2>所十二星座运势查询,提前预测2016年十二星座运势内容,让你能够占卜吉凶;2016年生肖运势测算,生肖开运,周易风水。'; $sp41d615->count_warn = 10; $sp41d615->password = '123456'; $sp41d615->password_open = true; $sp41d615->support_coupon = true; $sp41d615->price = 10; $sp41d615->price_whole = '[["2","8"],["10","5"]]'; $sp41d615->enabled = true; $sp41d615->save(); $sp41d615 = new \App\Product(); $sp41d615->user_id = $spfedf4e; $sp41d615->category_id = 2; $sp41d615->name = '测试商品_2'; $sp41d615->description = '这里是测试商品的一段简短的描述, 可以插入html文本'; $sp41d615->price = 1; $sp41d615->enabled = true; $sp41d615->save(); $sp41d615 = new \App\Product(); $sp41d615->user_id = $spfedf4e; $sp41d615->category_id = 3; $sp41d615->name = '测试商品_3'; $sp41d615->description = '这里是测试商品的一段简短的描述, 可以插入html文本'; $sp41d615->price = 1; $sp41d615->enabled = true; $sp41d615->save(); } }