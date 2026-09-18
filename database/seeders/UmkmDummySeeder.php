<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UmkmProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UmkmDummySeeder extends Seeder
{
    public function run(): void
    {
        $umkmUsers = User::whereIn('current_role_id', [101, 102])
            ->where('is_active', 1)
            ->get();

        if ($umkmUsers->isEmpty()) {
            $this->command->warn('Tidak ada UMKM aktif. Jalankan UsersSeeder terlebih dahulu.');
            return;
        }

        $sourceDir = public_path('assets/img/products');
        $productSourceDir = public_path('assets/img/ecommerce-images');
        $targetDir = storage_path('app/public/umkm-products');
        $profileSourceDir = public_path('assets/img/avatars');

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $availableImages = File::files($sourceDir);
        $profileImages = File::files($profileSourceDir);
        $imageIndex = 0;
        $profileImageIndex = 0;

        $peternakanProducts = [
            ['nama' => 'Daging Sapi Premium', 'satuan' => 'Kg', 'harga' => 185000, 'deskripsi' => 'Daging sapi segar berkualitas tinggi dari peternakan lokal Kabupaten Bogor.', 'gambar' => 'product-1.png'],
            ['nama' => 'Telur Ayam Ras', 'satuan' => 'Kg', 'harga' => 28000, 'deskripsi' => 'Telur ayam ras segar sehari-hari dengan kulit bersih dan berkualitas.', 'gambar' => 'product-2.png'],
            ['nama' => 'Susu Sapi Murni', 'satuan' => 'Liter', 'harga' => 35000, 'deskripsi' => 'Susu sapi murni langsung dari peternakan, tanpa pengawet.', 'gambar' => 'product-3.png'],
            ['nama' => 'Pakan Ayam Broiler', 'satuan' => 'Kg', 'harga' => 18000, 'deskripsi' => 'Pakan broiler campuran khusus untuk ayam pedaging.', 'gambar' => 'product-4.png'],
            ['nama' => 'Kambing Pedaging', 'satuan' => 'Ekor', 'harga' => 3200000, 'deskripsi' => 'Kambing pedaging sehat dan bertenaga, siap dipotong.', 'gambar' => 'product-5.png'],
            ['nama' => 'Sapi Brahman', 'satuan' => 'Ekor', 'harga' => 8500000, 'deskripsi' => 'Sapi Brahman Unggul dengan pertumbuhan optimal.', 'gambar' => 'product-6.png'],
            ['nama' => 'Kerbau Sido', 'satuan' => 'Ekor', 'harga' => 7500000, 'deskripsi' => 'Kerbau Sido unggulan untukolah tanah dan transportasi.', 'gambar' => 'product-7.png'],
            ['nama' => 'Ayam Buras', 'satuan' => 'Ekor', 'harga' => 45000, 'deskripsi' => 'Ayam buras jantan berkualitas untuk konsumsi.', 'gambar' => 'product-8.png'],
            ['nama' => 'Kelinci Breeding', 'satuan' => 'Ekor', 'harga' => 250000, 'deskripsi' => 'Kelinci breeding unggul untuk usaha pembibitan.', 'gambar' => 'product-9.png'],
            ['nama' => 'Itik Manila', 'satuan' => 'Ekor', 'harga' => 55000, 'deskripsi' => 'Itik Manila cepat tumbuh untuk usaha peternakan.', 'gambar' => 'product-10.png'],
        ];

        $perikananProducts = [
            ['nama' => 'Ikan Lele Segar', 'satuan' => 'Kg', 'harga' => 32000, 'deskripsi' => 'Lele segar hasil budidaya, siap diolah atau dikonsumsi.', 'gambar' => 'product-11.png'],
            ['nama' => 'Udang Vaname', 'satuan' => 'Kg', 'harga' => 65000, 'deskripsi' => 'Udang vaname frozen grade A, langsung dari tambak.', 'gambar' => 'product-12.png'],
            ['nama' => 'Nila Merah', 'satuan' => 'Kg', 'harga' => 27000, 'deskripsi' => 'Nila merah segar dengan daging padat dan tanpa amis.', 'gambar' => 'product-13.png'],
            ['nama' => 'Patin Super', 'satuan' => 'Kg', 'harga' => 38000, 'deskripsi' => 'Ikan patin super dengan tekstur daging lembut.', 'gambar' => 'product-14.png'],
            ['nama' => 'Bandeng Presto', 'satuan' => 'Kaleng', 'harga' => 25000, 'deskripsi' => 'Bandeng presto higienis, siap saji.', 'gambar' => 'product-15.png'],
            ['nama' => 'Pempek Ikan', 'satuan' => 'Pcs', 'harga' => 3000, 'deskripsi' => 'Pempek ikan tenggiri original dengan cita rasa authentic.', 'gambar' => 'product-16.png'],
            ['nama' => 'Cumi-cumi Beku', 'satuan' => 'Kg', 'harga' => 72000, 'deskripsi' => 'Cumi-cumi beku berkualitas tinggi untukolah rumahan.', 'gambar' => 'product-17.png'],
            ['nama' => 'Ikan Asin', 'satuan' => 'Kg', 'harga' => 40000, 'deskripsi' => 'Ikan asin pilihan dengan kadar asam yang pas.', 'gambar' => 'product-18.png'],
            ['nama' => 'Gurame Fillet', 'satuan' => 'Kg', 'harga' => 55000, 'deskripsi' => 'Gurame fillet tanpa duri, praktis untuk masak.', 'gambar' => 'product-19.png'],
            ['nama' => 'Rajungan Pasteurisasi', 'satuan' => 'Kg', 'harga' => 95000, 'deskripsi' => 'Rajungan pasteurisasi higienis, aman dikonsumsi.', 'gambar' => 'product-20.png'],
        ];

        $createdProducts = 0;

        $umkmUsers->each(function ($user) use ($peternakanProducts, $perikananProducts, $availableImages, $profileImages, &$imageIndex, &$profileImageIndex, $targetDir, &$createdProducts) {
            if ($user->users_kecamatan()->count() === 0) {
                $kecamatanList = \App\Models\MstKecamatan::inRandomOrder()->take(rand(1, 3))->get();
                
                foreach ($kecamatanList as $kecamatan) {
                    $user->users_kecamatan()->create([
                        'id_kecamatan' => $kecamatan->id,
                    ]);
                }
            }

            if (empty($user->nama_pemilik)) {
                $user->update(['nama_pemilik' => 'Pemilik ' . $user->name]);
            }

            if (empty($user->deskripsi)) {
                $roleName = $user->current_role_id == 101 ? 'Peternakan' : 'Perikanan';
                $user->update(['deskripsi' => "Usaha {$roleName} di Kabupaten Bogor. Menyediakan produk berkualitas untuk masyarakat."]);
            }

            if (empty($user->profile_photo)) {
                $profileImage = $profileImages[$profileImageIndex % count($profileImages)];
                $profileImageIndex++;
                $relativePath = 'assets/img/avatars/' . $profileImage->getFilename();
                $user->update(['profile_photo' => $relativePath]);
            }

            if (!$user->getFirstMedia('images')) {
                $profileImage = $profileImages[$profileImageIndex % count($profileImages)];
                $profileImageIndex++;
                $user->addMedia($profileImage->getRealPath())->usingName($user->name)->toMediaCollection('images');
            }

            $existingCount = $user->umkm_products()->count();
            if ($existingCount >= 2) {
                return;
            }

            if ($user->current_role_id == 101) {
                $products = [$peternakanProducts[array_rand($peternakanProducts)], $peternakanProducts[array_rand($peternakanProducts)]];
            } else {
                $products = [$perikananProducts[array_rand($perikananProducts)], $perikananProducts[array_rand($perikananProducts)]];
            }

            foreach ($products as $productData) {
                $imageFilename = $productData['gambar'];
                $sourceImagePath = $productSourceDir . '/' . $imageFilename;

                if (!File::exists($sourceImagePath)) {
                    $sourceImagePath = $sourceDir . '/' . $imageFilename;
                }

                if (!File::exists($sourceImagePath)) {
                    $sourceImagePath = $availableImages[$imageIndex % count($availableImages)];
                }

                $targetFileName = 'product_' . $user->id . '_' . time() . '_' . $imageFilename;
                File::copy($sourceImagePath, $targetDir . '/' . $targetFileName);

                UmkmProduct::create([
                    'user_id' => $user->id,
                    'nama_produk' => $productData['nama'],
                    'deskripsi' => $productData['deskripsi'],
                    'harga' => $productData['harga'],
                    'satuan' => $productData['satuan'],
                    'foto_produk' => $targetFileName,
                    'is_active' => 1,
                ]);

                $createdProducts++;
            }
        });

        $this->command->info('Dummy UMKM kecamatan assigned and products ensured: ' . $createdProducts);

        // Update existing products with correct images based on product name
        $this->updateExistingProductImages($productSourceDir, $targetDir);
    }

    private function updateExistingProductImages($productSourceDir, $targetDir): void
    {
        $allProducts = \App\Models\UmkmProduct::all();
        $peternakanNames = ['Daging Sapi Premium', 'Telur Ayam Ras', 'Susu Sapi Murni', 'Pakan Ayam Broiler', 'Kambing Pedaging', 'Sapi Brahman', 'Kerbau Sido', 'Ayam Buras', 'Kelinci Breeding', 'Itik Manila'];
        $perikananNames = ['Ikan Lele Segar', 'Udang Vaname', 'Nila Merah', 'Patin Super', 'Bandeng Presto', 'Pempek Ikan', 'Cumi-cumi Beku', 'Ikan Asin', 'Gurame Fillet', 'Rajungan Pasteurisasi'];

        $imageMap = [];
        foreach ($peternakanNames as $i => $name) {
            $imageMap[$name] = 'product-' . ($i + 1) . '.png';
        }
        foreach ($perikananNames as $i => $name) {
            $imageMap[$name] = 'product-' . ($i + 11) . '.png';
        }

        $updatedCount = 0;
        foreach ($allProducts as $product) {
            if (!isset($imageMap[$product->nama_produk])) {
                continue;
            }

            $imageFilename = $imageMap[$product->nama_produk];
            $sourcePath = $productSourceDir . '/' . $imageFilename;

            if (!File::exists($sourcePath)) {
                continue;
            }

            // Delete old product image if exists
            if ($product->foto_produk) {
                $oldPath = $targetDir . '/' . $product->foto_produk;
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Copy new image with unique suffix
            $targetFileName = 'product_' . $product->user_id . '_' . uniqid() . '_' . $imageFilename;
            File::copy($sourcePath, $targetDir . '/' . $targetFileName);

            // Update database
            $product->update(['foto_produk' => $targetFileName]);
            $updatedCount++;
        }

        if ($updatedCount > 0) {
            $this->command->info('Updated ' . $updatedCount . ' existing product images.');
        }
    }
}
