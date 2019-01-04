<?php

use Illuminate\Database\Seeder;

class UsersGenerate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
			    [		'id' 			=> '1',
			    		'email' 		=> 'admin@admin.com',
			    		'password' 		=> bcrypt('kelinci24'),
			    		'permissions' 	=> '{"home.dashboard":true}',
			    		'first_name' 			=> 'Lia',
			    		'last_name' 		=> 'Siti',
              'status' 		=> '3',
              'created_by' 		=> '1',
              'updated_by' 		=> '1',
              'created_at'    =>'2017-07-16 18:01:00',
              'updated_at'    =>'2017-07-16 18:01:00'

			    ]

			]);
         DB::table('roles')->insert([
			    [
			    		'id'=>'1',
			    		'slug' 		=> 'admin',
			    		'name' 			=> 'Admin',
			    		'permissions' 	=> '{"password.request":true,"password.email":true,"password.reset":true,"home.dashboard":true,"user.index":true,"user.create":true,"user.store":true,"user.show":true,"user.edit":true,"user.update":true,"role.index":true,"role.create":true,"role.store":true,"role.edit":true,"role.update":true,"role.save":true,"role.show":true,"status.index":true,"status.create":true,"status.store":true,"status.edit":true,"status.update":true,"status.show":true,"sampah.index":true,"sampah.create":true,"sampah.store":true,"sampah.edit":true,"sampah.update":true,"sampah.show":true,"kategori.index":true,"log.index":true}',
			    ],
			    [
			    		'id'=>'2',
			    		'slug' 		=> 'client',
			    		'name' 			=> 'client',
			    		'permissions' 			=> '{"home.dashboard":true}',
			    ]
		 ]);
		 DB::table('role_users')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'role_id' 			=> '1',
			    ]
		 ]);
		 DB::table('activations')->insert([
			    [
			    		'user_id' 		=> '1',
			    		'code' 			=> '1S4u7lJzehk62xDm3DgYgXXYWtbHE6gSP',
			    		'completed' 			=> '1',
			    ]
		 ]);
    }
}
