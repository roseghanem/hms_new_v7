    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateDiseasesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('diseases', function (Blueprint $table) {
                $table->id();
                $table->text('ar_name')->nullable(false)->unique();
                $table->text('en_name')->nullable(false)->unique();
                $table->text('code')->nullable(false)->unique();
                $table->date('code_date')->nullable(false);
                $table->text('specifications')->nullable();
                $table->text('symptoms')->nullable();
                $table->text('drugs')->nullable();
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
            Schema::dropIfExists('diseases');
        }
    }
