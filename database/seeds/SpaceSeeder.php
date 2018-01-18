<?php

use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('spaces')->insert(
            [ 'name' => '客厅', 'slug' => 'living', 'user_id' => 0 ],
            [ 'name' => '卧室', 'slug' => 'bedroom', 'user_id' => 0 ],
            [ 'name' => '餐厅', 'slug' => 'dining', 'user_id' => 0 ],
            [ 'name' => '厨房', 'slug' => 'kitchen', 'user_id' => 0 ],
            [ 'name' => '厕所', 'slug' => 'toilet', 'user_id' => 0 ],
            [ 'name' => '洗漱间', 'slug' => 'powder', 'user_id' => 0 ],
            [ 'name' => '洗衣间', 'slug' => 'laundry', 'user_id' => 0 ],
            [ 'name' => '浴室', 'slug' => 'bathroom', 'user_id' => 0 ],
            [ 'name' => '阳台', 'slug' => 'balcony', 'user_id' => 0 ]
        );
    }
}
