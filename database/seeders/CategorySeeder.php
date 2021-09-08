<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('categories')->truncate();//migrate fresh edende bunu bagliyib sora aciriq
        $id=DB::table('categories')->insertGetId(['name'=>'Elektronika','slug'=>'elektronika' ]);//get id ile idsini aliriq
        DB::table('categories')->insert(['name'=>'Komputer/Tablet','slug'=>'komputer-tablet','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Telefon','slug'=>'telefon','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'TV ve Ses Sistemleri','slug'=>'tv-ses-sistemleri','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Komera','slug'=>'komera','ust_id'=>$id]);


       
        $id=DB::table('categories')->insertGetId(['name'=>'Kitab','slug'=>'kitab']);
        DB::table('categories')->insert(['name'=>'Edebiyyat','slug'=>'edebiyyat','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Usaqlar','slug'=>'Usaqlar','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'It ve Komputer','slug'=>'it-komputer','ust_id'=>$id]);
        DB::table('categories')->insert(['name'=>'Imtahan ve Hazirliq','slug'=>'imtahan-hazirliq','ust_id'=>$id]);


        DB::table('categories')->insert(['name'=>'Spor','slug'=>'spor' ]);
        DB::table('categories')->insert(['name'=>'Dergi','slug'=>'dergi' ]);
        DB::table('categories')->insert(['name'=>'Mebel','slug'=>'mebel' ]);
        DB::table('categories')->insert(['name'=>'Dekorasiya','slug'=>'dekorasiya' ]);
        DB::table('categories')->insert(['name'=>'Kosmetika','slug'=>'kosmetika' ]);
        DB::table('categories')->insert(['name'=>'Sexsi Baxim','slug'=>'sexsi-baxim' ]);
        DB::table('categories')->insert(['name'=>'Geyim ve Moda','slug'=>'geyim-ve-moda' ]);
        DB::table('categories')->insert(['name'=>'Ana ve Korpe','slug'=>'ana-ve-korpe' ]);
    }
}
