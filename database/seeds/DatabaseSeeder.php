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
        $jml_pertemuan = 6;

        $jml_max_kegiatan = 7;
        $jml_max_video = 10;
        $jml_max_soal = 30;


        DB::table('siswa')->insert([
            'id' => '100',
            'name' => 'Adam Syarif Hidayatullah',
            'username' => 'adamsh231',
            'password' => bcrypt('dayung231'),
            'email' => 'adamsyarif217@yahoo.com',
            'phone' => '082140320499',
            'status' => 1,
        ]);

        for ($i = 1; $i <= $jml_siswa; $i++) {
            DB::table('siswa')->insert([
                'id' => $i,
                'name' => $faker->name,
                'username' => $faker->userName,
                'password' => bcrypt('dayung231'),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
            ]);
        }

        $id = ['presensi' => 1, 'video' => 1, 'detail' => 1, 'deskripsi' => 1];
        $kehadiran = ['Tidak Hadir', 'Hadir'];
        for ($i = 1; $i <= $jml_pertemuan; $i++) {
            DB::table('pertemuan')->insert([
                'id' => $i,
                'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                'judul' => $faker->sentence($nbWords = $faker->numberBetween(3, 5), $variableNbWords = true),
                'tanggal' => $faker->date($format = 'Y-m-d', $max = 'now'),
                // 'tanggal' => '2020-04-' . ($i * 4),
                // 'diskusi' => '/diskusi/' . $faker->word . '.pdf',
                // 'tugas' => '/tugas/' . $faker->word . '.pdf',
                // 'materi' => '/materi/' . $faker->word . '.pdf',
                'kompetensi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
                'tujuan' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
            ]);
            for ($j = 1; $j <= $faker->numberBetween(2, $jml_max_kegiatan); $j++) {
                DB::table('detail')->insert([
                    'id' => $id['detail'],
                    'id_pertemuan' => $i,
                    'kegiatan' => $faker->sentence($nbWords = $faker->numberBetween(4, 8), $variableNbWords = true),
                    'mulai' => ($j * 2) . ':00:00',
                    'selesai' => (($j * 2) + 1) . ':'.$faker->numberBetween(0,5).$faker->numberBetween(0,5).':00',
                ]);
                for ($k=1; $k < $faker->numberBetween(2, 5); $k++) {
                    DB::table('deskripsi')->insert([
                        'id' => $id['deskripsi'],
                        'id_detail' => $id['detail'],
                        'teks' => $faker->sentence($nbWords = $faker->numberBetween(4, 8), $variableNbWords = true),
                    ]);
                    $id['deskripsi']++;
                }
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
            for ($j = 1; $j <= $faker->numberBetween(1, $jml_max_video); $j++) {
                DB::table('video')->insert([
                    'id' => $id['video'],
                    'id_pertemuan' => $i,
                    'nama' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    // 'path' => '/materi/' . $faker->word . '.mp4',
                    'deskripsi' => $faker->sentence($nbWords = $faker->numberBetween(20, 30), $variableNbWords = true),
                ]);
                $id['video']++;
            }
        }

        $id_pertemuan_array = array_combine(range(1, $jml_pertemuan), range(1, $jml_pertemuan));
        $id_pertemuan_random = array_rand($id_pertemuan_array, 3);
        $id_soal = 1;
        $jawaban = ['A', 'B', 'C', 'D'];
        for ($i = 1; $i <= 3; $i++) {
            DB::table('kuis')->insert([
                'id' => $i,
                'id_pertemuan' => $id_pertemuan_random[($i-1)],
                'nama' => 'kuis' . $i,
                // 'waktu' => $faker->numberBetween(20, 60),
                'aktif' => $faker->numberBetween(0, 1),
                // 'jawaban' => '/jawaban/' . 'kuis' . $i . '.pdf',
            ]);
            for ($j = 1; $j <= $faker->numberBetween(10, $jml_max_soal); $j++) {
                DB::table('soal')->insert([
                    'id' => $id_soal,
                    'id_kuis' => $i,
                    // 'gambar' => '/kuis/' . $i . '/soal/' . $j . '.jpg',
                    'pertanyaan' => $faker->sentence($nbWords = $faker->numberBetween(10, 20), $variableNbWords = true) . '?',
                    // 'A' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    // 'B' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    // 'C' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    // 'D' => $faker->sentence($nbWords = $faker->numberBetween(1, 3), $variableNbWords = true),
                    // 'jawaban' => $jawaban[array_rand($jawaban, 1)],
                ]);
                $id_soal++;
            }
        }
    }
}
