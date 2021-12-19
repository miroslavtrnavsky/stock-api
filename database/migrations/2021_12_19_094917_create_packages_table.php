<?php

use App\Enums\PackageStateEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_id')->constrained();
            $table->unsignedInteger('code')->unique();
            $table->string('position');
            $table->string('state');
            $table->timestamps();
        });

        DB::statement("
            ALTER TABLE packages
            ADD CONSTRAINT check_state
            CHECK (state IN (" . enum_to_string(PackageStateEnum::cases()) . "));
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
