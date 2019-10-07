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
                'description' => 'Authority',
                'icon_url'=>env('APP_URL').'/images/mhada.png'
            ],
            [
                'name' => 'MHADB',
                'description' => 'Mumbai Board',
                'icon_url'=>env('APP_URL').'/images/MHADB.png'
            ],
            [
                'name' => 'MBRRB',
                'description' => 'RR Board',
                'icon_url'=>env('APP_URL').'/images/MBRRB.png'
            ],
            [
                'name' => 'AHADB',
                'description' => 'Amaravati Board',
                'icon_url'=>env('APP_URL').'/images/AHADB.png'
            ],
            [
                'name' => 'MSIB',
                'description' => 'Slum Board',
                'icon_url'=>env('APP_URL').'/images/MSIB.png'
            ],
            [
                'name' => 'KHADB',
                'description' => 'Konkan Board',
                'icon_url'=>env('APP_URL').'/images/KHADB.png'
            ],
            [
                'name' => 'PHADB',
                'description' => 'Pune Board',
                'icon_url'=>env('APP_URL').'/images/PHADB.png'
            ],
            [
                'name' => 'NHADB',
                'description' => 'Nagpur Board',
                'icon_url'=>env('APP_URL').'/images/NHADB-1.png'
            ],
            [
                'name' => 'AHADB-2',
                'description' => 'Aurangabad Board',
                'icon_url'=>env('APP_URL').'/images/ahadbimg.png'
            ],
            [
                'name' => 'NHADB-2',
                'description' => 'Nashik Board',
                'icon_url'=>env('APP_URL').'/images/NHADB.png'
            ],
     
        ];
        Board::truncate();
        foreach ($boards as $board) {
            $board_add = Board::where(['name' => $board['name']])->first();
            if ($board_add == null) {
                $board_add = new Board;
                $board_add->name = $board['name'];
                $board_add->description = $board['description'];
                $board_add->icon_url = $board['icon_url'];
                $board_add->save();
            }else{
                $board_add->icon_url = $board['icon_url'];
                $board_add->save();
            }
        }
    }
}
