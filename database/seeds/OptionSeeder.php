<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = json_encode(
                [
                    'favicon' => '/public/backend/images/logo_default.png',
                    'logo' => '/public/backend/images/logo_default.png',
                    'title' => 'Admin',
                    'title_login' => 'Login'
                ]
            );
        DB::table('options')->insert([
            [
                'type' => 'dev-config',
                'content' => $content
            ],
            ['type' => 'general','content' => ''],
            ['type' => 'color_setting','content' => ''],
            ['type' => 'css-js-config','content' => ''],
            ['type' => 'smtp-config','content' => ''],
        ]);
    }
}
