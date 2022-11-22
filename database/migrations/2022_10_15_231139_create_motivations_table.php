<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motivations', function (Blueprint $table) {
            // $uuid = DB::raw('select UUID()');
            // $table->uuid('id')->default(\Illuminate\Support\Str::uuid())->primary();
            $table->id();
            $table->string('motivation');
            $table->foreignId('user_id')->constrained();
            // $table->foreignUuid('user_id')->constrained('users');
            // $table->uuid('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivations');
    }
};
