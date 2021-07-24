<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
	private $data = [];

	public function __construct()
	{
		$this->data = [
			'user_name' => 'default',
			'first_name'=> 'default',
			'second_name'=> 'default',
			'first_last_name'=> 'default',
			'second_last_name'=> 'default',
			'email'=> 'default@default.com',
			'cellphone'=> '1234567890',
			'password' => 'default',
			'state_id'=> 2,
			'created_at'=> Carbon::now(),
			'updated_at'=> Carbon::now()
		];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('users')->insert($this->data);
    }
}
