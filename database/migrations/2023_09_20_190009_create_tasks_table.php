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
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->enum('work_type', ['Development', 'Test', 'Document']);
                $table->string('work_name');
                $table->time('start_time');
                $table->time('end_time');
                $table->enum('status', ['Pending', 'Finished', 'Canceled']);
                /*$table->timestamp(column: 'created_at')->useCurrent();*/
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {   
            Schema::dropIfExists('tasks');
        }
    };
