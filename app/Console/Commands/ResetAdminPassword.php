<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset admin password to default (admin123)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $admin = User::where('email', 'admin@laravelfactura.com')->first();

            if ($admin) {
                $admin->password = Hash::make('admin123');
                $admin->save();

                $this->info('✅ Contraseña del admin restablecida exitosamente');
                $this->info('📧 Email: admin@laravelfactura.com');
                $this->info('🔑 Password: admin123');
            } else {
                $this->error('❌ Usuario admin no encontrado');
                $this->info('💡 Ejecuta: php artisan db:seed para crear los usuarios demo');
            }
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            $this->info('💡 Verifica que la base de datos esté disponible');
        }
    }
}
