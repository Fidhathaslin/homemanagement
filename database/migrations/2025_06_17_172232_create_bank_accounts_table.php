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
        Schema::create('bank_accounts', function (Blueprint $table) {
        $table->id();
       $table->string('company_name')->nullable();
        $table->string('bank_name');
        $table->string('account_number');
        
        // Qatar passbook details
        $table->string('passbook_number')->nullable();
        $table->string('branch_name')->nullable();
        $table->string('iban')->nullable();
        $table->string('currency')->default('QAR');
        $table->string('account_type')->nullable(); // e.g. savings/current
        $table->date('passbook_issue_date')->nullable();
        $table->decimal('balance', 15, 2)->default(0);;
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
