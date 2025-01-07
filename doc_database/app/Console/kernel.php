<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Os comandos Artisan fornecidos pelo aplicativo.
     *
     * @var array
     */
    protected $commands = [
        // Adicione aqui os comandos personalizados
        \App\Console\Commands\UpdateTimestampType::class,
    ];

    /**
     * Defina as tarefas agendadas para o aplicativo.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Adicione suas tarefas agendadas aqui, se necessário
    }

    /**
     * Registre os comandos Artisan para o aplicativo.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
