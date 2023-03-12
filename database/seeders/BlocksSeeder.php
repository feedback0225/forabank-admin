<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Block::create([
            'name' => 'Карусель с карточками',
            'component' => 'slider-3-tabs',
            'iterable' => 1,
            'fields' => [
                'h1' => 'Заголовок Блока',
                'slide' => [
                    'name' => 'Название слайда',
                    'description' => 'Описание',
                    'name_link' => 'Текст ссылки',
                    'link' => 'Ссылка',
                ]
            ]
        ]);
    }
}
