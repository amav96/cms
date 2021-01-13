<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            
            $table->integer('status')->after('created_at');
            $table->string('name')->after('created_at');
            $table->string('slug')->after('created_at');
            $table->integer('category_id')->after('created_at');
            $table->string('image')->after('created_at');
            $table->decimal('price',11,2)->after('created_at');
            $table->integer('in_discount')->after('created_at');
            $table->integer('discount')->after('created_at');
            $table->text('content')->after('created_at');
            $table->softDeletes()->after('created_at');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
