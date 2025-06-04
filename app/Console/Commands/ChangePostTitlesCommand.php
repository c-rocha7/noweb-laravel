<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangePostTitlesCommand extends Command
{
    protected $signature = 'posts:change-titles';
    protected $description = 'Altera o título de todas as postagens para "noweb"';

    public function handle(): int
    {
        $this->info('Iniciando a alteração dos títulos das postagens para "noweb"...');

        $updatedCount = DB::table('posts')->update(['title' => 'noweb']);

        if ($updatedCount > 0) {
            $this->info("Títulos de {$updatedCount} postagens alterados para 'noweb' com sucesso!");
        } else {
            $this->info('Nenhuma postagem foi atualizada (sem postagens ou títulos já eram "noweb").');
        }

        return Command::SUCCESS;
    }
}
