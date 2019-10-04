<?php

use App\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boards = [
            [
                'name' => 'MHADA',
                'description' => 'MHADA',
                'icon_url'=>env('APP_URL').'/images/mhada.png'
            ],
            [
                'name' => 'MHADB',
                'description' => 'MHADB',
                'icon_url'=>env('APP_URL').'/images/MHADB.png'
            ],
            [
                'name' => 'MBRRB',
                'description' => 'MBRRB',
                'icon_url'=>env('APP_URL').'/images/MBRRB.png'
            ],
            [
                'name' => 'AHADB',
                'description' => 'AHADB',
                'icon_url'=>env('APP_URL').'/images/AHADB.png'
            ],
            [
                'name' => 'MSIB',
                'description' => 'MSIB',
                'icon_url'=>env('APP_URL').'/images/MSIB.png'
            ],
            [
                'name' => 'KHADB',
                'description' => 'KHADB',
                'icon_url'=>env('APP_URL').'/images/KHADB.png'
            ],
            [
                'name' => 'PHADB',
                'description' => 'PHADB',
                'icon_url'=>env('APP_URL').'/images/PHADB.png'
            ],
            [
                'name' => 'NHADB',
                'description' => 'NHADB',
                'icon_url'=>env('APP_URL').'/images/NHADB-1.png'
            ],
            [
                'name' => 'AHADB',
                'description' => 'AHADB',
                'icon_url'=>env('APP_URL').'/images/AHADB.png'
            ],
     
        ];

        foreach ($boards as $board) {
            $board_add = Board::where(['name' => $board['name']])->first();
            if ($board_add == null) {
                $board_add = new Board;
                $board_add->name = $board['name'];
                $board_add->description = $board['description'];
                $board_add->save();
            }else{
                $board_add->icon_url = $board['icon_url'];
                $board_add->save();
            }
        }
    }
}
