<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Repositories\PageRepository;
use Illuminate\Console\Command;

class CreatePageCommand extends Command
{
    /**
     * @var string $signature The signature of the console command.
     */
    protected $signature = 'linky:create:page';

    /**
     * @var string $description The description of the console command.
     */
    protected $description = 'Create a new page';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new page');

        $title = $this->ask('What is the title of the page?');
        $body  = $this->ask('What is the body of the page?');

        /**
         * Create the page.
         */
        PageRepository::create([
            'title' => $title,
            'body'  => $body
        ]);
    }
}
