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
                'icon_url'=>env('APP_URL').'/images/mhada.png',
                'large_icon'=>env('APP_URL').'/images/MHADA_large.png'
            ],
            [
                'name' => 'MHADB',
                'description' => 'Mumbai Board',
                'icon_url'=>env('APP_URL').'/images/MHADB.png',
                'large_icon'=>env('APP_URL').'/images/MHADB_large.png'
            ],
            [
                'name' => 'MBRRB',
                'description' => 'RR Board',
                'icon_url'=>env('APP_URL').'/images/MBRRB.png',
                'large_icon'=>env('APP_URL').'/images/MBRRB_large.png'
            ],
            [
                'name' => 'AHADB',
                'description' => 'Amaravati Board',
                'icon_url'=>env('APP_URL').'/images/AHADB.png',
                'large_icon'=>env('APP_URL').'/images/AHADB_large.png'
            ],
            [
                'name' => 'MSIB',
                'description' => 'Slum Board',
                'icon_url'=>env('APP_URL').'/images/MSIB.png',
                'large_icon'=>env('APP_URL').'/images/MSIB_large.png'
            ],
            [
                'name' => 'KHADB',
                'description' => 'Konkan Board',
                'icon_url'=>env('APP_URL').'/images/KHADB.png',
                'large_icon'=>env('APP_URL').'/images/KHADB_large.png'
            ],
            [
                'name' => 'PHADB',
                'description' => 'Pune Board',
                'icon_url'=>env('APP_URL').'/images/PHADB.png',
                'large_icon'=>env('APP_URL').'/images/PHADB_large.png'
            ],
            [
                'name' => 'NHADB',
                'description' => 'Nagpur Board',
                'icon_url'=>env('APP_URL').'/images/NHADB-1.png',
                'large_icon'=>env('APP_URL').'/images/NHADB_large.png'
            ],
            [
                'name' => 'AHADB-2',
                'description' => 'Aurangabad Board',
                'icon_url'=>env('APP_URL').'/images/ahadbimg.png',
                'large_icon'=>env('APP_URL').'/images/AHADB-2_large.png'
            ],
            [
                'name' => 'NHADB-2',
                'description' => 'Nashik Board',
                'icon_url'=>env('APP_URL').'/images/NHADB.png',
                'large_icon'=>env('APP_URL').'/images/NHADB-2_large.png'
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
                $board_add->large_icon= $board['large_icon'];
                $board_add->save();
            }else{
                $board_add->icon_url = $board['icon_url'];
                $board_add->large_icon= $board['large_icon'];
                $board_add->save();
            }
        }
    }
}
