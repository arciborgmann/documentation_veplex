<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTimestampType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:timestamp-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza os tipos timestamp para o formato correto';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::table('campo')
            ->where('tipo', 'timestamp without time zone ')
            ->update(['tipo' => 'timestamp']);
            $this->info('Tipos atualizados com sucesso!');
        } catch (\Exception $e) {
            $this->error('Erro ao atualizar: ' . $e->getMessage());
        }

        return 0;
    }
}
