<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!app()->isLocal()) {
            $this->command->warn('本番環境では AdminSeeder の実行はスキップされました。');
            return;
        }

        Admin::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => '管理者',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
