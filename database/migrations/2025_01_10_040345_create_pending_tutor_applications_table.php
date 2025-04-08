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
            Schema::create('pending_tutor_applications', function (Blueprint $table) {
                $table->id();   
                $table->json('subjects')->nullable();
                $table->string('availability')->nullable();
                $table->string('description')->nullable();
                $table->string('phone_number');
                $table->string('experience')->nullable();
                $table->string('status')->default('Pending');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('pending_tutor_applications');
        }
    };
