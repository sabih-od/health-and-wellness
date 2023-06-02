<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('company_name')->nullable();
            $table->text('logo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no_1')->nullable();
            $table->string('phone_no_2')->nullable();
            $table->text('address')->nullable();
            $table->text('facebook')->nullable();
            $table->text('tweeter')->nullable();
            $table->text('linkedIn')->nullable();
            $table->text('instagram')->nullable();
            $table->decimal('shipping_rate')->nullable();
            $table->enum('paypal_env', ['Live', 'Testing'])->nullable();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_secret_key')->nullable();
            $table->enum('stripe_env', ['Live', 'Testing'])->nullable();
            $table->string('stripe_publishable_key')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->enum('authorize_env', ['Live', 'Testing'])->nullable();
            $table->string('authorize_merchant_login_id')->nullable();
            $table->string('authorize_merchant_transaction_key')->nullable();
            $table->string('paypal_check')->nullable();
            $table->string('stripe_check')->nullable();
            $table->string('authorize_check')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('paypal_testing_client_id')->nullable();
            $table->string('paypal_testing_secret_key')->nullable();
            $table->string('stripe_testing_publishable_key')->nullable();
            $table->string('stripe_testing_secret_key')->nullable();
            $table->string('tax_rate')->nullable();
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
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
