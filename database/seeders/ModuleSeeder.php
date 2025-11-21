<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            [
                'title' => 'HTML Fundamental',
                'description' => 'Struktur dasar website',
                'icon' => '🏗️',
                'chapters' => [
                    [
                        'title' => 'Pengenalan HTML',
                        'description' => 'Memahami struktur dasar HTML dan tag-tag umum',
                        'youtube_url' => 'https://www.youtube.com/embed/UB3IbeQ0x5w',
                        'questions' => [
                            [
                                'question_text' => 'Tag mana yang merupakan root element dalam HTML?',
                                'type' => 'multiple_choice',
                                'choices' => ['<div>', '<html>', '<body>', '<head>'],
                                'correct_answer' => '<html>',
                                'points' => 10
                            ],
                            [
                                'question_text' => 'Jelaskan perbedaan antara tag <div> dan <span>!',
                                'type' => 'essay',
                                'points' => 20
                            ]
                        ]
                    ],
                    [
                        'title' => 'Semantic HTML',
                        'description' => 'Menggunakan tag semantic untuk struktur yang lebih baik',
                        'youtube_url' => 'https://www.youtube.com/embed/bOUhq46fd5g',
                        'questions' => [
                            [
                                'question_text' => 'Tag semantic mana yang digunakan untuk konten utama halaman?',
                                'type' => 'multiple_choice',
                                'choices' => ['<header>', '<main>', '<article>', '<section>'],
                                'correct_answer' => '<main>',
                                'points' => 10
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'CSS Styling & Layout',
                'description' => 'Desain tampilan website',
                'icon' => '🎨',
                'chapters' => [
                    [
                        'title' => 'CSS Dasar',
                        'description' => 'Selectors, Properties, dan Values',
                        'youtube_url' => 'https://www.youtube.com/embed/1Rs2ND1Kzhc',
                        'questions' => [
                            [
                                'question_text' => 'Sebutkan 3 cara menempatkan CSS dalam HTML!',
                                'type' => 'essay',
                                'points' => 15
                            ],
                            [
                                'question_text' => 'Mana yang merupakan selector class?',
                                'type' => 'multiple_choice',
                                'choices' => ['#myclass', '.myclass', ':myclass', '*myclass'],
                                'correct_answer' => '.myclass',
                                'points' => 10
                            ]
                        ]
                    ],
                    [
                        'title' => 'Flexbox Layout',
                        'description' => 'Membuat layout responsif dengan Flexbox',
                        'youtube_url' => 'https://www.youtube.com/embed/JJSoEo8JSnc',
                        'questions' => [
                            [
                                'question_text' => 'Apa fungsi property flex-direction?',
                                'type' => 'essay',
                                'points' => 15
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Responsive Design',
                'description' => 'Website adaptif di semua device',
                'icon' => '📱',
                'chapters' => [
                    [
                        'title' => 'Media Queries',
                        'description' => 'Membuat website responsif untuk berbagai ukuran layar',
                        'youtube_url' => 'https://www.youtube.com/embed/K24SGlJV0W4',
                        'questions' => [
                            [
                                'question_text' => 'Sintaks media query yang benar adalah?',
                                'type' => 'multiple_choice',
                                'choices' => ['@media (max-width: 600px)', '@screen (max-width: 600px)', '@query (max-width: 600px)', '@responsive (max-width: 600px)'],
                                'correct_answer' => '@media (max-width: 600px)',
                                'points' => 10
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'JavaScript Basics',
                'description' => 'Logika pemrograman web',
                'icon' => '⚙️',
                'chapters' => [
                    [
                        'title' => 'Variabel dan Tipe Data',
                        'description' => 'Memahami variabel, const, let, dan tipe data',
                        'youtube_url' => 'https://www.youtube.com/embed/9emXNzqCKyQ',
                        'questions' => [
                            [
                                'question_text' => 'Apa perbedaan var, let, dan const?',
                                'type' => 'essay',
                                'points' => 20
                            ],
                            [
                                'question_text' => 'Mana yang NOT tipe data primitif JavaScript?',
                                'type' => 'multiple_choice',
                                'choices' => ['number', 'string', 'object', 'boolean'],
                                'correct_answer' => 'object',
                                'points' => 10
                            ]
                        ]
                    ],
                    [
                        'title' => 'Function dan Scope',
                        'description' => 'Membuat dan memahami function dan scope',
                        'youtube_url' => 'https://www.youtube.com/embed/aiHUbNtXDos',
                        'questions' => [
                            [
                                'question_text' => 'Jelaskan apa itu closure dalam JavaScript!',
                                'type' => 'essay',
                                'points' => 20
                            ]
                        ]
                    ]
                ]
            ],
            [
                'title' => 'DOM Manipulation',
                'description' => 'Interaksi dinamis dengan HTML',
                'icon' => '🔧',
                'chapters' => [
                    [
                        'title' => 'Selecting Elements',
                        'description' => 'Cara memilih elemen DOM',
                        'youtube_url' => 'https://www.youtube.com/embed/FIORjGvIC34',
                        'questions' => [
                            [
                                'question_text' => 'Method mana yang mengembalikan NodeList?',
                                'type' => 'multiple_choice',
                                'choices' => ['getElementById', 'querySelector', 'querySelectorAll', 'getElementByClass'],
                                'correct_answer' => 'querySelectorAll',
                                'points' => 10
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($modules as $moduleData) {
            $module = Module::create([
                'title' => $moduleData['title'],
                'description' => $moduleData['description'],
                'icon' => $moduleData['icon'],
                'order' => array_search($moduleData, $modules)
            ]);

            foreach ($moduleData['chapters'] as $chapterIndex => $chapterData) {
                $chapter = Chapter::create([
                    'module_id' => $module->id,
                    'title' => $chapterData['title'],
                    'description' => $chapterData['description'],
                    'youtube_url' => $chapterData['youtube_url'],
                    'order' => $chapterIndex
                ]);

                foreach ($chapterData['questions'] as $questionIndex => $questionData) {
                    Question::create([
                        'chapter_id' => $chapter->id,
                        'question_text' => $questionData['question_text'],
                        'type' => $questionData['type'],
                        'choices' => isset($questionData['choices']) ? $questionData['choices'] : null,
                        'correct_answer' => isset($questionData['correct_answer']) ? $questionData['correct_answer'] : null,
                        'points' => $questionData['points'],
                        'order' => $questionIndex
                    ]);
                }
            }
        }
    }
}
