<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Payment webhooks
         * Moyasar uses webhooks to notify your application every time payment
         * reaches its final state (paid or failed) in your account. The notification
         * is an asynchronous request which means you don’t have to trigger it.
         * After a successful or a failed payment Moyasar will POST its details
         * to the endpoint URL you may have configured.
         *
         *
         * To enable it, you can set up the payment webhooks and add your endpoint
         * URL via the Dashboard. The endpoint should be able to accept HTTP POST
         * requests in order to receive notification from API as a JSON payload.
         *
         *
         * Webhook secrets To secure the payment webhooks, you must assign a secret token for your
         * endpoint which will be added within your URL as a query string to verify that the request comes from Moyasar.
         *  */
        Schema::create('webhooks', function (Blueprint $table) {
            $table->id();
            // The event’s unique ID.
            $table->string('payment_id')->unique();
            // name of the event type (payment_failed or payment_paid).
            $table->string('type');
            // endpoint’s secret assigned by customer to secure the webhook.
            $table->string('secret_token');
            // name of the account in which the event occurred.
            $table->string('account_name');
            // true if the payment is in live mode or false if it is in test mode.
            $table->string('account_name');
            // payment payload associated with the event.
            $table->text('data');
            // time the webhook object was created.
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
        Schema::dropIfExists('webhooks');
    }
}
