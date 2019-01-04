<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('statuses')->insert([
           [
               'id' 		    => '1',
               'parent_id' 	=> null,
               'lft'  => '1',
               'rgt'  => '6',
               'depth'  => '0',
               'name'  => 'Activation',
               'desc'  => 'Activation',
               'status'  => '3',
               'created_by' 		=> '1',
               'updated_by' 		=> '1',
               'created_at' 		=> '2017-07-13 05:53:22',
               'updated_at' 		=> '2017-07-13 05:53:22',
           ],
           [
               'id' 		    => '2',
               'parent_id' 	=> 1,
               'lft'  => '2',
               'rgt'  => '3',
               'depth'  => '1',
               'name'  => 'Inactive',
               'desc'  => 'Inactive',
               'status'  => '3',
               'created_by' 		=> '1',
               'updated_by' 		=> '1',
               'created_at' 		=> '2017-07-13 05:53:22',
               'updated_at' 		=> '2017-07-13 05:53:22',
           ],
           [
               'id' 		    => '3',
               'parent_id' 	=> 1,
               'lft'  => '4',
               'rgt'  => '5',
               'depth'  => '1',
               'name'  => 'Active',
               'desc'  => 'Active',
               'status'  => '3',
               'created_by' 		=> '1',
               'updated_by' 		=> '1',
               'created_at' 		=> '2017-07-13 05:53:22',
               'updated_at' 		=> '2017-07-13 05:53:22',
           ]
           , [
                'id' 		    => '9',
                'parent_id' 	=> null,
                'lft'  => '7',
                'rgt'  => '14',
                'depth'  => '0',
                'name'  => 'Condition',
                'desc'  => 'Condition',
                'status'  => '3',
                'created_by' 		=> '1',
                'updated_by' 		=> '1',
                'created_at' 		=> '2017-07-13 05:53:22',
                'updated_at' 		=> '2017-07-13 05:53:22',
            ],
            [
                 'id' 		    => '10',
                 'parent_id' 	=> '9',
                 'lft'  => '8',
                 'rgt'  => '9',
                 'depth'  => '1',
                 'name'  => 'Good',
                 'desc'  => '',
                 'status'  => '3',
                 'created_by' 		=> '1',
                 'updated_by' 		=> '1',
                 'created_at' 		=> '2017-07-13 05:53:22',
                 'updated_at' 		=> '2017-07-13 05:53:22',
             ],
             [
                  'id' 		    => '11',
                  'parent_id' 	=> '9',
                  'lft'  => '10',
                  'rgt'  => '11',
                  'depth'  => '1',
                  'name'  => 'Broken',
                  'desc'  => '',
                  'status'  => '3',
                  'created_by' 		=> '1',
                  'updated_by' 		=> '1',
                  'created_at' 		=> '2017-07-13 05:53:22',
                  'updated_at' 		=> '2017-07-13 05:53:22',
              ]
               

      ]);
    }
}
