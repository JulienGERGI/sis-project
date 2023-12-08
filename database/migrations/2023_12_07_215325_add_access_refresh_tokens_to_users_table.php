<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccessRefreshTokensToUsersTable extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::table('users', function (Blueprint $table) {
$table->string('accessToken', 500)->nullable();
$table->string('refreshToken')->nullable();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::table('users', function (Blueprint $table) {
$table->dropColumn('accessToken');
$table->dropColumn('refreshToken');
});
}
}
