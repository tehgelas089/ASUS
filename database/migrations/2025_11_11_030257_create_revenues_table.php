use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('revenues', function (Blueprint $table) {
$table->id();
$table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
$table->integer('income');
$table->timestamps();
});

Schema::create('revenue_histories', function (Blueprint $table) {
$table->id();
$table->date('date');
$table->integer('total_income');
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('revenue_histories');
Schema::dropIfExists('revenues');
}
};