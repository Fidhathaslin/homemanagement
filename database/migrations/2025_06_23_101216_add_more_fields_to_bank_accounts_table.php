<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
        $table->string('account_name')->nullable()->after('id');
        $table->string('swift_code')->nullable()->after('iban');
        $table->string('address')->nullable()->after('bank_name');
        $table->string('city')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
             $table->dropColumn(['account_name', 'swift_code', 'address', 'city']);
        });
    }
};
