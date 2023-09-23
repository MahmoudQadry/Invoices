<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_no");
            $table->string("product_id");
            $table->string("section_id");
            $table->string("discount");
            $table->string("rate_vat");
            $table->enum("status",["not paid","partial paid","paid"])->default("not paid");
            $table->text("note")->nullable();
            $table->decimal("value_vat",8,2);
            $table->decimal("commission_amount",8,2);
            $table->decimal("collection_amount",8,2);
            $table->decimal("total",8,2);
            $table->enum("value_status",[1,2,3])->default(1);
            $table->string("user");
            $table->date("invoice_date");
            $table->date("payment_date")->nullable();
            $table->date("due_date");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
