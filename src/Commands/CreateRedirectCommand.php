<?php

namespace Illegal\Linky\Commands;

use Illegal\Linky\Repositories\RedirectRepository;
use Illuminate\Console\Command;

class CreateRedirectCommand extends Command
{
    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'linky:create:redirect';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Create a new redirect';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->info('Create a new redirect');

        /**
         * Create the redirect.
         */
        RedirectRepository::create();
    }
}
