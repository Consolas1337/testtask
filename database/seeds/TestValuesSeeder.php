<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestValuesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $comment = DB::table('comments')->insertGetId([
      'likes' => '11',
      'text' => 'подумал, что наконец обратили внимание на баг с невозможностью применения песчаного ландшафта',
      'user' => 'Jenny Wilson',
    ]);

    $comment1 = DB::table('comments')->insertGetId([
      'parent_id' => $comment,
      'likes' => '-1',
      'text' => 'Когда сажаешь дома на рассаду, никогда не "чикаешь" макушку, но они такими лианами не вырастают никогда, просто аккуратные кустики. Все-таки этот наверное не просто перец, а с чем-то скрещен.',
      'user' => 'Brooklyn Simmons',
    ]);

    $comment2 = DB::table('comments')->insertGetId([
      'parent_id' => $comment1,
      'likes' => '0',
      'text' => 'Если воду настаивать в банке с мелко порубленной кожурой банана, и этим поливать, то вообще кучеряво будет.',
      'user' => 'Robert Fox',
    ]);
  }
}
