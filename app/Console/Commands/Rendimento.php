<?php

namespace App\Console\Commands;

use App\Models\Taxa;
use App\Models\User;
use Illuminate\Console\Command;

class Rendimento extends Command
{
    protected $signature = 'rendimento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Acrescenta o rendimento às poupanças';

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
        $users = User::all();
        $taxa = Taxa::all();
        $taxa = $taxa->last();
        if ($taxa) {
            foreach ($users as $user) {
                foreach ($user->contas as $conta) {
                    if ($conta->tipo == 0) {
                        $conta->saldo = bcadd($conta->saldo, (bcmul($taxa->taxa, $conta->saldo, 2)), 2);
                        $conta->save();
                    }
                }
            }
        } else
            return Command::SUCCESS;
    }
}
