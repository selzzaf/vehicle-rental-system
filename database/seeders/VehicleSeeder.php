<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            [
                'marque' => 'Dacia',
                'model' => 'Duster Journey+ 2022',
                'description' => 'SUV robuste et économique, parfaite pour les routes urbaines et les escapades en pleine nature. Équipée de technologies modernes et d\'un intérieur spacieux.',
                'prix' => 400.00,
                'license_plate' => 'DC-101-AA',
                'status' => 'available',
                'image_path' => 'Noua Dacia Duster.jpeg',
            ],
            [
                'marque' => 'Peugeot',
                'model' => '3008 GT 2023',
                'description' => 'SUV moderne avec un design audacieux et des technologies de pointe. Intérieur premium et conduite dynamique pour une expérience de conduite exceptionnelle.',
                'prix' => 550.00,
                'license_plate' => 'PG-202-BB',
                'status' => 'available',
                'image_path' => 'Peugeot 3008.jpeg',
            ],
            [
                'marque' => 'Renault',
                'model' => 'Clio E-Tech 2024',
                'description' => 'Citadine élégante et dynamique avec un nouveau design moderne. Technologie hybride pour une conduite économique et respectueuse de l\'environnement.',
                'prix' => 370.00,
                'license_plate' => 'RN-303-CC',
                'status' => 'available',
                'image_path' => 'Renault Clio 2024.jpeg',
            ],
            [
                'marque' => 'Tesla',
                'model' => 'Model 3 Performance 2023',
                'description' => 'Berline électrique offrant performance et autonomie exceptionnelle. Accélération de 0 à 100 km/h en 3.3 secondes et autonomie de 500+ km.',
                'prix' => 800.00,
                'license_plate' => 'TS-404-DD',
                'status' => 'available',
                'image_path' => 'Tesla unveils.jpeg',
            ],
            [
                'marque' => 'Citroën',
                'model' => 'C5 Aircross 2023',
                'description' => 'SUV confortable et spacieux, parfait pour les longs trajets. Suspension hydraulique progressive pour un confort de conduite optimal.',
                'prix' => 600.00,
                'license_plate' => 'CT-505-EE',
                'status' => 'available',
                'image_path' => 'Citroen C5 Aircross 2023.jpeg',
            ],
            [
                'marque' => 'BMW',
                'model' => 'X3 xDrive30e 2023',
                'description' => 'SUV premium hybride rechargeable combinant luxe, performance et efficacité. Intérieur sophistiqué avec technologies BMW les plus récentes.',
                'prix' => 950.00,
                'license_plate' => 'BM-606-FF',
                'status' => 'available',
                'image_path' => null,
            ],
            [
                'marque' => 'Mercedes',
                'model' => 'Classe A 250 AMG 2023',
                'description' => 'Berline compacte sportive avec finitions AMG. Design agressif et performances dynamiques pour une conduite sportive.',
                'prix' => 750.00,
                'license_plate' => 'MC-707-GG',
                'status' => 'reserved',
                'image_path' => null,
            ],
            [
                'marque' => 'Audi',
                'model' => 'Q5 TDI quattro 2023',
                'description' => 'SUV premium avec transmission intégrale quattro. Moteur diesel performant et technologies Audi connectées pour une expérience premium.',
                'prix' => 850.00,
                'license_plate' => 'AU-808-HH',
                'status' => 'available',
                'image_path' => null,
            ]
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
} 