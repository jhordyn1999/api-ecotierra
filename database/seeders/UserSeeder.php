<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $records=[
            [
                'name' => 'Jhordyn',
                'last_name' => 'Montenegro',
                'email' => 'jhordynalexander10@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test 1',
                'last_name' => 'example',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Test 2',
                'last_name' => 'Example 2',
                'email' => 'test2@gmail.com',
                'password' => Hash::make('password'),
            ]
        ];
        foreach ($records as $record) {
            $this->attemptInsertion($record);
        }
    }
    /**
     * insert a register
     *
     * @param array{name:string,last_name:string,email:string,password:string} $record
     * @return void
     **/
    private function attemptInsertion(array $record):void
    {
        try {
            DB::table('users')->insert($record);
        } catch (Exception $exception) {
            dump(sprintf('success %s', $record['id']));
        }
    }


}
