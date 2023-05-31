<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Accountant;

class ResetAccesses extends Command
{
    protected $signature = 'reset:accesses';

    protected $description = 'Zera o número de acessos de todos os links';

    public function handle()
    {
        Accountant::query()->update(['quantity' => 0]);

        $this->info('Número de acessos zerado com sucesso!');
    }
}
