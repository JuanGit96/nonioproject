<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::create([
            'name' 			=>	'Agricultura, ganadería, caza, silvicultura y pesca',
            'beta_desapalancado' 			=>	'0.86',
        ]);

        Sector::create([
            'name' 			=>	'Explotación de minas y canteras',
            'beta_desapalancado' 			=>	'0.38',
        ]);

        Sector::create([
            'name' 			=>	'Industrias manufactureras',
            'beta_desapalancado' 			=>	'1.1',
        ]);
        Sector::create([
            'name' 			=>	'Suministro de electricidad, gas, vapor y aire acondicionado',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Distribución de agua; evacuación y tratamiento de aguas residuales, gestión de desechos y actividades',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Construcción',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Comercio al por mayor y al por menor; reparación de vehículos automotores y motocicletas',
            'beta_desapalancado' 			=>	'0.38',

        ]);
        Sector::create([
            'name' 			=>	'Transporte y almacenamiento',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Alojamiento y servicios de comida',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Información y comunicaciones',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Actividades financieras y de seguros',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Actividades inmobiliarias',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Actividades profesionales, científicas y técnicas',
            'beta_desapalancado' 			=>	'0.91',
        ]);

        Sector::create([
            'name' 			=>	'Actividades de servicios administrativos y de apoyo',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Administración pública y defensa planes de seguridad social de afiliación obligatoria',
            'beta_desapalancado' 			=>	'0.35',
        ]);
        Sector::create([
            'name' 			=>	'Educación',
            'beta_desapalancado' 			=>	'0.9',
        ]);
        Sector::create([
            'name' 			=>	'Actividades de atención de la salud humana y de asistencia social',
            'beta_desapalancado' 			=>	'0.7',
        ]);
        Sector::create([
            'name' 			=>	'Actividades artísticas, de entretenimiento y recreación',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Otras actividades de servicios',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Actividades de los hogares en calidad de empleadores; actividades no diferenciadas de los hogares individuales como productores de bienes y servicios para uso propio',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Actividades de organizaciones y entidades extraterritoriales',
            'beta_desapalancado' 			=>	'0.38',
        ]);
        Sector::create([
            'name' 			=>	'Otras actividades no incluidas en el listado',
            'beta_desapalancado' 			=>	'0.38',
        ]);
    }
}
