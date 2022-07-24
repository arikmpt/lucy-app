<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cluster;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cluster::firstOrCreate([
            'name' => 'Payakumbuh'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec Payakumbuh'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Lareh Sago Halaban'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Luak'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Situjuah'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec Harau'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Mungka'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Guguak'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Akabiluru'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Suliki'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Gunuang Omeh'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Bukit Barisan'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Pangkalan'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Kec.Kapur IX'
        ]);

        Cluster::firstOrCreate([
            'name' => 'Luar PALIKO'
        ]);
    }
}
