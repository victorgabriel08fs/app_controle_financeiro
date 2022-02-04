<?php

namespace App\Console\Commands;

use App\Models\Taxa;
use App\Models\User;
use Illuminate\Console\Command;

class Admin extends Command
{
    protected $signature = 'admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera o usuário administrador';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('cpf', '01974867625')->get()->first();
        if ($user) {
            $user->is_admin = true;
            $user->save();
            Taxa::create(['user_id' => $user->id, 'taxa' => 0.01]);
            echo ' ------ Usuário administrador gerado e taxa gerada ------ ';
        } else {
            echo ' ------ Usuário administrador não foi criado ainda ------ ';
        }

        return Command::SUCCESS;
    }
}
