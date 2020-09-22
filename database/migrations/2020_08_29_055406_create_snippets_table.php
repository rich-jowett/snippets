<?php

/**
 * 2020_08_29_055406_create_snippets_table.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateSnippetsTable
 *
 * @author Rich Jowett <rich@jowett.me>
 */
class CreateSnippetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('snippets', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('code');
            $table->foreignUuid('created_by')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('snippets');
    }
}
