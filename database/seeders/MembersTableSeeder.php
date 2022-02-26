<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('members')->delete();
        
        \DB::table('members')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Jung Jaehyun',
                'username' => 'user',
                'email' => 'user@mail.com',
                'email_verified_at' => NULL,
                'username' => 'user',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'created_at' => '2022-02-23 05:26:24',
                'updated_at' => '2022-02-24 02:19:18',
            ),
        ));
        
        
    }
}