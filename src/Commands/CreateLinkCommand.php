<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Repositories\LinkRepository;
use Illuminate\Console\Command;

class CreateLinkCommand extends Command
{
    /**
     * @var string $signature The signature of the console command.
     */
    protected $signature = 'linky:create:link';

    /**
     * @var string The description of the console command.
     */
    protected $description = 'Create a new link';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new link');

        $url = $this->ask('What is the URL of the link?');

        /**
         * Create the link.
         */
        LinkRepository::create([
            'url' => $url
        ]);
    }
}
