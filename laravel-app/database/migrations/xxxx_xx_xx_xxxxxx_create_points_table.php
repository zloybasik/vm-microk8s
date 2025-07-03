public function up()
{
    Schema::create('points', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->double('latitude', 10, 6);
        $table->double('longitude', 10, 6);
        $table->timestamps();
    });
}
