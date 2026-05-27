<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('section')->nullable()->after('title');
            $table->text('excerpt')->nullable()->after('section');
            $table->string('meta_title')->nullable()->after('content');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('featured_image')->nullable()->after('meta_description');
            $table->string('status')->default('draft')->after('featured_image');
            $table->boolean('is_homepage')->default(false)->after('status');
            $table->boolean('is_system')->default(false)->after('is_homepage');
            $table->unsignedInteger('sort_order')->default(0)->after('is_system');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'section',
                'excerpt',
                'meta_title',
                'meta_description',
                'featured_image',
                'status',
                'is_homepage',
                'is_system',
                'sort_order',
            ]);
        });
    }
};
