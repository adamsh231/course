<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 20; $i++) {
            DB::table('siswa')->insert([
                'id' => $i,
                'name' => $faker->name,
                'username' => $faker->userName,
                'password' => bcrypt('dayung231'),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'pretest' => $faker->numberBetween(0, 100),
                'posttest' => $faker->numberBetween(0, 100),
            ]);
        }

        $id = ['presensi' => 1, 'file' => 1];
        $kehadiran = ['Tidak Hadir', 'Hadir'];
        for ($i = 1; $i <= 3; $i++) {
            DB::table('pertemuan')->insert([
                'id' => $i,
                'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'diskusi' => '/diskusi/' . $faker->word . '.pdf',
                'tugas' => '/tugas/' . $faker->word . '.pdf',
            ]);
            for ($j = 1; $j <= 20; $j++) {
                DB::table('presensi')->insert([
                    'id' => $id['presensi'],
                    'id_pertemuan' => $i,
                    'id_siswa' => $j,
                    'kehadiran' => $kehadiran[array_rand($kehadiran, 1)],
                ]);
                $id['presensi']++;
            }
            for ($j = 1; $j <= rand(2, 15); $j++) {
                if ($j % 2) {
                    DB::table('file')->insert([
                        'id' => $id['file'],
                        'id_pertemuan' => $i,
                        'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                        'path' => '/video/' . $faker->word . '.mp4',
                        'jenis' => 'Video',
                    ]);
                } else {
                    DB::table('file')->insert([
                        'id' => $id['file'],
                        'id_pertemuan' => $i,
                        'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                        'path' => '/materi/' . $faker->word . '.pdf',
                        'jenis' => 'Materi',
                    ]);
                }
                $id['file']++;
            }
        }

        $nama_soal = ['Pre Test', 'Post Test'];
        $id_soal = 1;
        $jawaban = ['A','B','C','D'];
        for ($i = 1; $i <= 2; $i++) {
            DB::table('kuis')->insert([
                'id' => $i,
                'nama' => $nama_soal[$i - 1],
                'jawaban' => '/jawaban/' . $nama_soal[$i - 1] . '.pdf',
            ]);
            for ($j = 1; $j <= 10; $j++) {
                DB::table('soal')->insert([
                    'id' => $id_soal,
                    'id_kuis' => $i,
                    'gambar' => '/soal/' . $nama_soal[$i - 1] . '.jpg',
                    'pertanyaan' => $faker->sentence($nbWords = $faker->numberBetween(5, 10), $variableNbWords = true) . '?',
                    'A' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    'B' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    'C' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    'D' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    'jawaban' => $jawaban[array_rand($jawaban, 1)],
                ]);
                $id_soal++;
            }
        }
    }
}
