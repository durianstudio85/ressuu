<?php

use Illuminate\Database\Seeder;

class PortfolioCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('portfolio_cat')->count() == 0){

            DB::table('portfolio_cat')->insert([

                [ 'user_id' => 0, 'title' => 'Web' ],
               	[ 'user_id' => 0, 'title' => 'Mobile' ],
               	[ 'user_id' => 0, 'title' => 'Certificate' ],
               	[ 'user_id' => 0, 'title' => 'Infographics' ],
               	[ 'user_id' => 0, 'title' => 'Logo' ],
               	[ 'user_id' => 0, 'title' => 'Graphics' ],
               	[ 'user_id' => 0, 'title' => 'Print' ],
               	[ 'user_id' => 0, 'title' => 'Web Development' ],
               	[ 'user_id' => 0, 'title' => 'Design' ],
               	[ 'user_id' => 0, 'title' => 'Web Design & Development' ],
               	[ 'user_id' => 0, 'title' => 'Website' ],
               	[ 'user_id' => 0, 'title' => 'HTML' ],
               	[ 'user_id' => 0, 'title' => 'Web Develpoment' ]
            ]);

        } else { echo "\e[31mTable is not empty, therefore NOT "; }
    }
}
