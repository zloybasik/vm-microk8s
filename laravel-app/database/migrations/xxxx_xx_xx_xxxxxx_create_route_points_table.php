public function up()
{
    Schema::create('route_points', function (Blueprint $table) {
        $table->id();
        $table->foreignId('route_id')->constrained('routes')->onDelete('cascade');
        $table->foreignId('point_id')->constrained('points')->onDelete('cascade');
        $table->integer('seq')->comment('Порядок точки в маршруте');
        $table->timestamps();
    });
}
