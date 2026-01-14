<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderFooterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_footer', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('header_title')->nullable(); // Header title
            $table->text('footer_content')->nullable(); // Footer content
            $table->text('facebook_link')->nullable(); // Facebook link
            $table->text('twitter_link')->nullable(); // Twitter link
            $table->text('linkedin_link')->nullable(); // LinkedIn link
            $table->text('youtube_link')->nullable(); // YouTube link
            $table->string('footer_title', 250)->nullable(); // Footer title
            $table->string('footer_contact_title', 250)->nullable(); // Footer contact title
            $table->text('insta_link')->nullable(); // Instagram link
            $table->string('email', 250)->nullable(); // Email address
            $table->string('address', 250)->nullable(); // Address
            $table->string('mobile_no', 250)->nullable(); // Mobile number
            $table->timestamps(); // created_at and updated_at timestamps
            $table->string('home_meta_title')->nullable(); // Meta title for home page
            $table->text('home_meta_keywords')->nullable(); // Meta keywords for home page
            $table->string('home_meta_description')->nullable(); // Meta description for home page
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_footer'); // Drop the table if it exists
    }
}
