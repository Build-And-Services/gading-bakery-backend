<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        //BAKERY
        $img1 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Lemper Ayam',
            'image' => url("/images/products/{$img1}"),
            'product_code' => 'BAKERY-001',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img2 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Komo',
            'image' => url("/images/products/{$img2}"),
            'product_code' => 'BAKERY-002',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 1
        ]);

        $img3 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Keju Misis',
            'image' => url("/images/products/{$img3}"),
            'product_code' => 'BAKERY-003',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 1
        ]);

        $img4 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Selai Anggur',
            'image' => url("/images/products/{$img4}"),
            'product_code' => 'BAKERY-004',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img5 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Sosis',
            'image' => url("/images/products/{$img5}"),
            'product_code' => 'BAKERY-005',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img6 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Madu',
            'image' => url("/images/products/{$img6}"),
            'product_code' => 'BAKERY-006',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img7 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Pisang Coklat',
            'image' => url("/images/products/{$img7}"),
            'product_code' => 'BAKERY-007',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img8 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Selai Nanas',
            'image' => url("/images/products/{$img8}"),
            'product_code' => 'BAKERY-008',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img9 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Merah',
            'image' => url("/images/products/{$img9}"),
            'product_code' => 'BAKERY-009',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img10 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Abon',
            'image' => url("/images/products/{$img10}"),
            'product_code' => 'BAKERY-010',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 1
        ]);

        $img11 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Sisir Besar',
            'image' => url("/images/products/{$img11}"),
            'product_code' => 'BAKERY-011',
            'purchase_price' => 6500,
            'selling_price' => 6500,
            'category_id' => 1
        ]);

        $img12 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Sisir Mini',
            'image' => url("/images/products/{$img12}"),
            'product_code' => 'BAKERY-012',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img13 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Matahari Besar',
            'image' => url("/images/products/{$img13}"),
            'product_code' => 'BAKERY-013',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 1
        ]);

        $img14 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Matahari Mini',
            'image' => url("/images/products/{$img14}"),
            'product_code' => 'BAKERY-014',
            'purchase_price' => 10500,
            'selling_price' => 10500,
            'category_id' => 1
        ]);

        $img15 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery TopJu Jumbo',
            'image' => url("/images/products/{$img15}"),
            'product_code' => 'BAKERY-015',
            'purchase_price' => 14000,
            'selling_price' => 14000,
            'category_id' => 1
        ]);

        $img16 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Ring Besar',
            'image' => url("/images/products/{$img16}"),
            'product_code' => 'BAKERY-016',
            'purchase_price' => 9500,
            'selling_price' => 9500,
            'category_id' => 1
        ]);

        $img17 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Ijo Besar',
            'image' => url("/images/products/{$img17}"),
            'product_code' => 'BAKERY-017',
            'purchase_price' => 8000,
            'selling_price' => 8000,
            'category_id' => 1
        ]);

        $img18 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Top 3 Jumbo',
            'image' => url("/images/products/{$img18}"),
            'product_code' => 'BAKERY-018',
            'purchase_price' => 13000,
            'selling_price' => 13000,
            'category_id' => 1
        ]);

        $img19 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Mahkota Pandan',
            'image' => url("/images/products/{$img19}"),
            'product_code' => 'BAKERY-019',
            'purchase_price' => 11000,
            'selling_price' => 11000,
            'category_id' => 1
        ]);

        $img20 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kasur',
            'image' => url("/images/products/{$img20}"),
            'product_code' => 'BAKERY-020',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 1
        ]);

        $img21 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Ijo Besar',
            'image' => url("/images/products/{$img21}"),
            'product_code' => 'BAKERY-021',
            'purchase_price' => 8000,
            'selling_price' => 8000,
            'category_id' => 1
        ]);

        $img22 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Keju',
            'image' => url("/images/products/{$img22}"),
            'product_code' => 'BAKERY-022',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img23 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Keju Jumbo',
            'image' => url("/images/products/{$img23}"),
            'product_code' => 'BAKERY-023',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 1
        ]);

        $img24 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Pisang Coklat Jumbo',
            'image' => url("/images/products/{$img24}"),
            'product_code' => 'BAKERY-024',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 1
        ]);

        $img25 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery 3 in 1',
            'image' => url("/images/products/{$img25}"),
            'product_code' => 'BAKERY-025',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 1
        ]);

        $img26 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kepang',
            'image' => url("/images/products/{$img26}"),
            'product_code' => 'BAKERY-026',
            'purchase_price' => 13000,
            'selling_price' => 13000,
            'category_id' => 1
        ]);

        $img27 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coco Pandan',
            'image' => url("/images/products/{$img27}"),
            'product_code' => 'BAKERY-027',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img28 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Selai Vanilla',
            'image' => url("/images/products/{$img28}"),
            'product_code' => 'BAKERY-028',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img29 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Selai Durian',
            'image' => url("/images/products/{$img29}"),
            'product_code' => 'BAKERY-029',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img30 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Selai Strawberry',
            'image' => url("/images/products/{$img30}"),
            'product_code' => 'BAKERY-030',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img31 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Pisang Vanila',
            'image' => url("/images/products/{$img31}"),
            'product_code' => 'BAKERY-031',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);

        $img32 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Kacang',
            'image' => url("/images/products/{$img32}"),
            'product_code' => 'BAKERY-032',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 1
        ]);


        //KUE BASAH
        $img33 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Cake Strawberry',
            'image' => url("/images/products/{$img33}"),
            'product_code' => 'KUEBASAH-001',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 2
        ]);

        $img34 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Roll Gulung Keju',
            'image' => url("/images/products/{$img34}"),
            'product_code' => 'KUEBASAH-002',
            'purchase_price' => 70000,
            'selling_price' => 70000,
            'category_id' => 2
        ]);

        $img35 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'CL5',
            'image' => url("/images/products/{$img35}"),
            'product_code' => 'KUEBASAH-003',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 2
        ]);

        $img36 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Roti Kering',
            'image' => url("/images/products/{$img36}"),
            'product_code' => 'KUEBASAH-004',
            'purchase_price' => 12000,
            'selling_price' => 12000,
            'category_id' => 2
        ]);

        $img37 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Pastel',
            'image' => url("/images/products/{$img37}"),
            'product_code' => 'KUEBASAH-005',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 2
        ]);

        $img38 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Risoles Ayam',
            'image' => url("/images/products/{$img38}"),
            'product_code' => 'KUEBASAH-006',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 2
        ]);


        //CAKE
        $img39 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Cake Cappucino',
            'image' => url("/images/products/{$img39}"),
            'product_code' => 'CAKE-001',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 3
        ]);

        $img40 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Cake Lemon Strawberry',
            'image' => url("/images/products/{$img40}"),
            'product_code' => 'CAKE-002',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 3
        ]);

        $img41 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Cake Coklat Kacang',
            'image' => url("/images/products/{$img41}"),
            'product_code' => 'CAKE-003',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 3
        ]);


        // DONUTS
        $img42 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Glaze',
            'image' => url("/images/products/{$img42}"),
            'product_code' => 'DONUTS-001',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img43 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat 1 Muka Misis',
            'image' => url("/images/products/{$img43}"),
            'product_code' => 'DONUTS-002',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 4
        ]);

        $img44 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat 2 Muka Misis',
            'image' => url("/images/products/{$img44}"),
            'product_code' => 'DONUTS-003',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 4
        ]);

        $img45 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Siram Coklat',
            'image' => url("/images/products/{$img45}"),
            'product_code' => 'DONUTS-004',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img46 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Siram Kacang',
            'image' => url("/images/products/{$img46}"),
            'product_code' => 'DONUTS-005',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img47 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Keju',
            'image' => url("/images/products/{$img47}"),
            'product_code' => 'DONUTS-006',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img48 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Siram Bunga',
            'image' => url("/images/products/{$img48}"),
            'product_code' => 'DONUTS-007',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img49 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Stik Misis',
            'image' => url("/images/products/{$img49}"),
            'product_code' => 'DONUTS-008',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 4
        ]);

        $img50 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Salju',
            'image' => url("/images/products/{$img50}"),
            'product_code' => 'DONUTS-009',
            'purchase_price' => 3500,
            'selling_price' => 3500,
            'category_id' => 4
        ]);


        //MENU UTAMA
        $img51 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Biskuit',
            'image' => url("/images/products/{$img51}"),
            'product_code' => 'BAKERY-033',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img52 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Jala',
            'image' => url("/images/products/{$img52}"),
            'product_code' => 'BAKERY-034',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img53 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kurma',
            'image' => url("/images/products/{$img53}"),
            'product_code' => 'BAKERY-035',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img54 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kasur Cocopandan',
            'image' => url("/images/products/{$img54}"),
            'product_code' => 'BAKERY-036',
            'purchase_price' => 14000,
            'selling_price' => 14000,
            'category_id' => 1
        ]);

        $img55 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kasur Jumbo',
            'image' => url("/images/products/{$img55}"),
            'product_code' => 'BAKERY-037',
            'purchase_price' => 13000,
            'selling_price' => 13000,
            'category_id' => 1
        ]);

        $img56 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Tawar 3 Keju',
            'image' => url("/images/products/{$img56}"),
            'product_code' => 'BAKERY-038',
            'purchase_price' => 13000,
            'selling_price' => 13000,
            'category_id' => 1
        ]);

        $img57 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Moza',
            'image' => url("/images/products/{$img57}"),
            'product_code' => 'BAKERY-039',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img58 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Ijo Kecil',
            'image' => url("/images/products/{$img58}"),
            'product_code' => 'BAKERY-040',
            'purchase_price' => 4000,
            'selling_price' => 4000,
            'category_id' => 1
        ]);

        $img60 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Sosis',
            'image' => url("/images/products/{$img60}"),
            'product_code' => 'DONUTS-010',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 4
        ]);

        $img61 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Donat Abon',
            'image' => url("/images/products/{$img61}"),
            'product_code' => 'DONUTS-011',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 4
        ]);

        $img62 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Chochocips',
            'image' => url("/images/products/{$img62}"),
            'product_code' => 'BAKERY-041',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img63 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Kacang Cha',
            'image' => url("/images/products/{$img63}"),
            'product_code' => 'BAKERY-042',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img64 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Plunter Kacang',
            'image' => url("/images/products/{$img64}"),
            'product_code' => 'BAKERY-043',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img65 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Chochocips',
            'image' => url("/images/products/{$img65}"),
            'product_code' => 'BAKERY-044',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img66 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery 2 Rasa',
            'image' => url("/images/products/{$img66}"),
            'product_code' => 'BAKERY-045',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img67 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Kismis',
            'image' => url("/images/products/{$img67}"),
            'product_code' => 'BAKERY-046',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img68 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Morin Coklat',
            'image' => url("/images/products/{$img68}"),
            'product_code' => 'BAKERY-047',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img69 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Coklat Misis',
            'image' => url("/images/products/{$img69}"),
            'product_code' => 'BAKERY-048',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img70 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Vla Coklat Strawberry',
            'image' => url("/images/products/{$img70}"),
            'product_code' => 'BAKERY-049',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);

        $img71 = $faker->image('public/images/products', 640, 480, null, false);
        Product::create([
            'name' => 'Bakery Daging',
            'image' => url("/images/products/{$img71}"),
            'product_code' => 'BAKERY-050',
            'purchase_price' => 5000,
            'selling_price' => 5000,
            'category_id' => 1
        ]);
    }
}
