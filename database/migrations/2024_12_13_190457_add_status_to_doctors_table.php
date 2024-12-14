<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            if (!Schema::hasColumn('doctors', 'status')) {
                $table->string('status')->default('active')->after('experience');
            }
        });
    }
    

    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('status'); 
        });
    }
};

