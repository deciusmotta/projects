<?php

use Illuminate\Database\Seeder;
use DateTime;
class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            [ 'name' => 'GITHUB','api'=>'https://api.github.com', 'created_at'=> new DateTime(), 'updated_at'=> new DateTime()],
        ]);
    }
}
