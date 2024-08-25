<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('users')->get()->each(function($user) {
            $config = json_decode($user->config, true);
            $config['version'] = '1.0';
            DB::table('users')->where('id', $user->id)->update([
                'config' => json_encode($config),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->get()->each(function ($user) {
            $config = json_decode($user->config, true);
            unset($config['version']);
            DB::table('users')->where('id', $user->id)->update([
                'config' => json_encode($config),
            ]);
        });
    }
};
