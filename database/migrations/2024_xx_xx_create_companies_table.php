<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('role')->default('Member'); // SuperAdmin, Admin, Member, etc.

            $table->unsignedBigInteger('company_id')
                ->nullable()
                ->after('role');

            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn(['role', 'company_id']);
        });
    }
};
