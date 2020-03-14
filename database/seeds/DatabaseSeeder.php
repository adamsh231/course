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

        $jml_siswa = $faker->numberBetween(15, 30);
        $jml_pertemuan = $faker->numberBetween(3, 6);
        $jml_max_kegiatan = $faker->numberBetween(3, 6);
        $jml_max_file = $faker->numberBetween(2, 6);
        $jml_soal = $faker->numberBetween(10, 30);


        DB::table('siswa')->insert([
            'id' => '100',
            'name' => 'Adam Syarif Hidayatullah',
            'username' => 'adamsh231',
            'password' => bcrypt('dayung231'),
            'email' => 'adamsyarif217@yahoo.com',
            'phone' => '082140320499',
            'pretest' => $faker->numberBetween(0, 100),
            'posttest' => $faker->numberBetween(0, 100),
        ]);

        for ($i = 1; $i <= $jml_siswa; $i++) {
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

        $id = ['presensi' => 1, 'file' => 1, 'detail' => 1];
        $kehadiran = ['Tidak Hadir', 'Hadir'];
        for ($i = 1; $i <= $jml_pertemuan; $i++) {
            DB::table('pertemuan')->insert([
                'id' => $i,
                'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                'judul' => $faker->sentence($nbWords = $faker->numberBetween(3, 5), $variableNbWords = true),
                // 'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'tanggal' => '2020-04-' . ($i * 4),
                'diskusi' => '/diskusi/' . $faker->word . '.pdf',
                'tugas' => '/tugas/' . $faker->word . '.pdf',
                'deskripsi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
            ]);
            for ($j = 1; $j <= $faker->numberBetween(2, $jml_max_kegiatan); $j++) {
                DB::table('detail')->insert([
                    'id' => $id['detail'],
                    'id_pertemuan' => $i,
                    'kegiatan' => $faker->sentence($nbWords = $faker->numberBetween(4, 8), $variableNbWords = true),
                    'deskripsi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
                    // 'mulai' => $faker->time($format = 'H:i:s', $max = 'now'),
                    // 'selesai' => $faker->time($format = 'H:i:s', $max = 'now'),
                    'mulai' => ($j * 2) . ':00:00',
                    'selesai' => (($j * 2) + 2) . ':00:00',
                ]);
                $id['detail']++;
            }
            for ($j = 1; $j <= $jml_siswa; $j++) {
                DB::table('presensi')->insert([
                    'id' => $id['presensi'],
                    'id_pertemuan' => $i,
                    'id_siswa' => $j,
                    'kehadiran' => $kehadiran[array_rand($kehadiran, 1)],
                ]);
                $id['presensi']++;
            }
            for ($j = 1; $j <= $faker->numberBetween(1, $jml_max_file); $j++) {
                if ($j % 2) {
                    DB::table('file')->insert([
                        'id' => $id['file'],
                        'id_pertemuan' => $i,
                        'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                        'path' => '/video/' . $faker->word . '.mp4',
                        'jenis' => 'Video',
                        'deskripsi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
                    ]);
                } else {
                    DB::table('file')->insert([
                        'id' => $id['file'],
                        'id_pertemuan' => $i,
                        'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                        'path' => '/materi/' . $faker->word . '.pdf',
                        'jenis' => 'Materi',
                        'deskripsi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
                    ]);
                }
                $id['file']++;
            }
        }

        $id_pertemuan_array = array_combine(range(1, $jml_pertemuan), range(1, $jml_pertemuan));
        $id_pertemuan_random = array_rand($id_pertemuan_array, count($id_pertemuan_array));
        $id_soal = 1;
        $jawaban = ['A', 'B', 'C', 'D'];
        for ($i = 1; $i <= $faker->numberBetween(2, $jml_pertemuan); $i++) {
            DB::table('kuis')->insert([
                'id' => $i,
                'id_pertemuan' => $id_pertemuan_random[($i-1)],
                'nama' => 'kuis' . $i,
                'jawaban' => '/jawaban/' . 'kuis' . $i . '.pdf',
            ]);
            for ($j = 1; $j <= $jml_soal; $j++) {
                DB::table('soal')->insert([
                    'id' => $id_soal,
                    'id_kuis' => $i,
                    'gambar' => '/kuis/' . $i . '/soal/' . $j . '.jpg',
                    'pertanyaan' => $faker->sentence($nbWords = $faker->numberBetween(10, 20), $variableNbWords = true) . '?',
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
