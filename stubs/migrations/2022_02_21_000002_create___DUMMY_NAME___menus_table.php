<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create__DUMMY_STUDLY_NAME__MenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('__DUMMY_NAME___menus', function (Blueprint $table) {
            $table->id();

            $table->nestedSet();

            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('path')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('sort')->default(0);
            $table->boolean('is_home')->default(false);
            $table->boolean('is_opened')->default(false);
            $table->boolean('status')->default(true);

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
        Schema::dropIfExists('__DUMMY_NAME___menus');
    }
}
