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
            ],
            [
                'name' => 'MHADB',
                'description' => 'MHADB',
            ],
            [
                'name' => 'MBRRB',
                'description' => 'MBRRB',
            ],
            [
                'name' => 'AHADB',
                'description' => 'AHADB',
            ],
            [
                'name' => 'MSIB',
                'description' => 'MSIB',
            ],
            [
                'name' => 'KHADB',
                'description' => 'KHADB',
            ],
            [
                'name' => 'PHADB',
                'description' => 'PHADB',
            ],
            [
                'name' => 'NHADB',
                'description' => 'NHADB',
            ],
            [
                'name' => 'AHADB',
                'description' => 'AHADB',
            ],
            [
                'name' => 'NHADB',
                'description' => 'NHADB',
            ],
        ];

        foreach ($boards as $board) {
            $board_add = Board::where(['name' => $board['name']])->first();
            if ($board_add == null) {
                $board_add = new Board;
                $board_add->name = $board['name'];
                $board_add->description = $board['description'];
                $board_add->save();
            }
        }
    }
}
