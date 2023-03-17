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
                'slides' => [
                    [
                        'name' => 'Заголовок слайда',
                        'description' => 'Описание',
                        'name_link' => 'Текст ссылки',
                        'link' => 'Ссылка'
                    ],
                    [
                        'name' => 'Заголовок слайда',
                        'description' => 'Описание',
                        'name_link' => 'Текст ссылки',
                        'link' => 'Ссылка'
                    ],
                    [
                        'name' => 'Заголовок слайда',
                        'description' => 'Описание',
                        'name_link' => 'Текст ссылки',
                        'link' => 'Ссылка'
                    ],
                ]
            ]
        ]);

        Block::create([
            'name' => 'Маленький баннер со ссылкой',
            'component' => 'mini-banner-with-link',
            'iterable' => 0,
            'fields' => [
                'h1' => 'Заголовок Блока',
                'link' => 'Ссылка',
                'name_link' => 'Текст ссылки',
            ]
        ]);

        Block::create([
            'name' => 'Большой главный баннер-карусель',
            'component' => 'big-banner-carousel',
            'iterable' => 1,
            'fields' => [
                'slides' => [
                    [
                        'name' => 'Заголовок слайда',
                        'description' => 'Описание',
                        'name_red_link' => 'Текст красной ссылки',
                        'red_link' => 'Красная Ссылка',
                        'name_trans_link' => 'Текст прозрачной ссылки',
                        'trans_link' => 'Прозрачная Ссылка'
                    ],
                    [
                        'name' => 'Заголовок слайда',
                        'description' => 'Описание',
                        'name_red_link' => 'Текст красной ссылки',
                        'red_link' => 'Красная Ссылка',
                        'name_trans_link' => 'Текст прозрачной ссылки',
                        'trans_link' => 'Прозрачная Ссылка'
                    ],
                ]
            ]
        ]);
    }
}
