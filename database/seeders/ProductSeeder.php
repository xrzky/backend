<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'iPhone 14 Pro',
            'price' => '20000000',
            'stock' => '25',
            'storage' => '256 GB',
            'image' => 'https://cdn.eraspace.com/media/catalog/product/i/p/iphone_14_pro_deep_purple_1_6.jpg',
            'image2' => 'https://cdn.eraspace.com/media/catalog/product/i/p/iphone_14_pro_deep_purple_2_9.jpg',
            'image3' => 'https://cdn.eraspace.com/media/catalog/product/i/p/iphone_14_pro_deep_purple_3_9.jpg',
            'image4' => 'https://cdn.eraspace.com/media/catalog/product/i/p/iphone_14_pro_deep_purple_5_9.jpg',
            'description' => 'iPhone 14 Pro. Memotret detail menakjubkan dengan kamera Utama 48 MP. Nikmati iPhone dalam cara yang sepenuhnya baru dengan layar yang Selalu Aktif dan Dynamic Island. Deteksi Tabrakan, sebuah fitur keselamatan baru, memanggil bantuan saat Anda tak bisa.'
        ]);

        Product::create( [
            'name' => 'Samsung S23 Ultra',
            'price' => '20499000',
            'stock' => '25',
            'storage' => '256 GB',
            'image' => 'https://images.samsung.com/is/image/samsung/p6pim/id/2302/gallery/id-galaxy-s23-s918-sm-s918bzkqxid-thumb-534862994?imwidth=480',
            'image2' => 'https://images.samsung.com/is/image/samsung/p6pim/id/2302/gallery/id-galaxy-s23-s918-sm-s918bzkqxid-thumb-534862975?imwidth=480',
            'image3' => 'https://images.samsung.com/is/image/samsung/p6pim/id/2302/gallery/id-galaxy-s23-s918-sm-s918bzkqxid-thumb-534862978?imwidth=480',
            'image4' => 'https://images.samsung.com/is/image/samsung/p6pim/id/2302/gallery/id-galaxy-s23-s918-sm-s918bzkqxid-thumb-534862980?imwidth=480',
            'description' => 'Ukuran layar: 6.8 inch, 3088 x 1440 pixels, Dynamic AMOLED 2X, 120Hz, HDR10+, 1750 nits
            Memori: RAM 12 GB, ROM 512 GB
            Sistem operasi: Android 13, One UI 5.1
            CPU: Qualcomm SM8550-AC Snapdragon 8 Gen 2 (4 nm), Octa-core'
        ]);

        Product::create( [
            'name' => 'OPPO Find N3',
            'price' => '29999000',
            'stock' => '25',
            'storage' => '256 GB',
            'image' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202311/20/JKfVqfYLwVMXdQx5.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image2' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202311/20/YzBA8C0U2RdMyEpx.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image3' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202311/20/rolTiYnQlXReu8xq.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image4' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202311/20/xlj9Erx0u1atO5uG.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'description' => '16GB RAM + 512GB ROM, 67W SUPERVOOC 4805mAh Large Battery, 7.8" Large Screen, Vitality Imaging Triple Camera System'
        ]);

        Product::create( [
            'name' => 'OPPO Find N3 Flip',
            'price' => '15999000',
            'stock' => '25',
            'storage' => '256 GB',
            'image' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202310/18/JOX4qCnih7rTMLe8.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image2' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202310/18/UNsxOTtEMxHrdIPA.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image3' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202310/18/8e3r5f4Vey1thrOf.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'image4' => 'https://opss-imgcdn-gl.heytapimg.com/epb/202310/18/KoLlYSwGjVtIeFDv.jpg?x-amz-process=image/format,webp/quality,Q_80',
            'description' => '12GB RAM + 256GB ROM, 44W SUPERVOOC 4300mAh Large Battery, 6.8" Large Screen, Vitality Imaging Triple Camera System'
        ]);

        Product::create( [
            'name' => 'iPhone 15 Pro Max',
            'price' => '24999000',
            'stock' => '25',
            'storage' => '512 GB',
            'image' => 'https://cdn.eraspace.com/media/catalog/product/a/p/apple_iphone_15_pro_max_natural_titanium_1_1_5.jpg',
            'image2' => 'https://cdn.eraspace.com/media/catalog/product/a/p/apple_iphone_15_pro_max_natural_titanium_2_1_5.jpg',
            'image3' => 'https://cdn.eraspace.com/media/catalog/product/a/p/apple_iphone_15_pro_max_natural_titanium_3_1_5.jpg',
            'image4' => 'https://cdn.eraspace.com/media/catalog/product/a/p/apple_iphone_15_pro_max_natural_titanium_5_1_5.jpg',
            'description' => 'iPhone 15 Pro Max. Lahir dari titanium dan dilengkapi chip A17 Pro terobosan, tombol Tindakan yang dapat disesuaikan, dan sistem kamera iPhone paling andal yang pernah ada.'
        ]);
    }
}
