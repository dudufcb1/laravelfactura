<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data.
     */
    public function run(): void
    {
        // Limpiar datos existentes
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Company::truncate();
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Crear usuario administrador (Eduardo González)
        $adminUser = User::create([
            'name' => 'Eduardo González',
            'email' => 'admin@laravelfactura.com',
            'password' => Hash::make('admin123'),
            'role' => 'administrador'
        ]);

        $contadorUser = User::create([
            'name' => 'Juan Contador',
            'email' => 'contador@laravelfactura.com',
            'password' => Hash::make('contador123'),
            'role' => 'contador'
        ]);

        // 2. Crear empresa principal
        $empresa = Company::create([
            'name' => 'DevActivo.com',
            'default' => true,
            'owner_name' => 'Eduardo González',
            'phones' => '+52 55 1234 5678',
            'address' => 'Ciudad de México, México',
            'ruc' => 'GOXE850101ABC',
            'services' => 'Desarrollo web, consultoría IT y soluciones digitales',
            'logo_path' => 'company-logos/devactivo-logo.png',
            'invoice_series' => 'DA',
            'last_invoice_number' => 0
        ]);

        // 3. Crear categorías básicas
        $categorias = [
            ['name' => 'Desarrollo de Software'],
            ['name' => 'Consultoría IT'],
            ['name' => 'Soporte Técnico'],
            ['name' => 'Hardware'],
            ['name' => 'Licencias de Software'],
            ['name' => 'Mantenimiento']
        ];

        foreach ($categorias as $categoria) {
            Category::create($categoria);
        }

        echo "✅ Seeder de demo ejecutado exitosamente!\n";
        echo "📊 Datos creados:\n";
        echo "   👤 Eduardo González (administrador)\n";
        echo "   👥 Juan Contador (contador)\n";
        echo "   🏢 DevActivo.com (empresa)\n";
        echo "   📁 6 categorías de productos\n";
        echo "\n🔑 Credenciales de acceso:\n";
        echo "   Administrador: admin@laravelfactura.com / admin123\n";
        echo "   Contador: contador@laravelfactura.com / contador123\n";
        echo "\n💡 Empresa: DevActivo.com - Desarrollo web y soluciones digitales!\n";
    }
}
