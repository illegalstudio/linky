<?php

use Illegal\Linky\Models\Content;
use Illegal\Linky\Models\Contentable\Collection;
use Illegal\Linky\Models\Contentable\Link;
use Illegal\Linky\Models\Contentable\Page;
use Illegal\Linky\Models\Statistics\Hit;
use Illegal\Linky\Repositories\CollectionRepository;
use Illegal\Linky\Repositories\LinkRepository;
use Illegal\Linky\Repositories\PageRepository;
use Illuminate\Support\Facades\Schema;

test('table prefixes work across migrations, repository joins and relationships', function (string $prefix) {
    config(['linky.db.prefix' => $prefix, 'linky.auth.multi_tenant' => false]);

    if (! Schema::hasTable(Content::getTableName())) {
        foreach (glob(__DIR__.'/../../database/migrations/*.php') as $file) {
            $migration = require $file;
            $migration->up();
        }
    }

    foreach ([Content::class => 'contents', Collection::class => 'collections', Link::class => 'links', Page::class => 'pages', Hit::class => 'hits'] as $model => $table) {
        expect($model::getTableName())->toBe($prefix.$table)
            ->and($model::getField('id'))->toBe($prefix.$table.'.id')
            ->and(Schema::hasTable($prefix.$table))->toBeTrue();
    }

    $linkRepository = app(LinkRepository::class);
    $pageRepository = app(PageRepository::class);
    $collectionRepository = app(CollectionRepository::class);

    $link = $linkRepository->create(['url' => 'https://example.com'], true, 'prefix-link');
    $page = $pageRepository->create(['body' => 'Example page'], true, 'prefix-page');
    $collection = $collectionRepository->create([], true, 'prefix-collection');
    $collection->contentable->contents()->attach($link, ['position' => 1]);
    $link->hits()->save((new Hit)->forceFill(['url' => 'https://example.com']));

    expect($linkRepository->paginateWithContent()->total())->toBe(1)
        ->and($pageRepository->paginateWithContent()->total())->toBe(1)
        ->and($collectionRepository->paginateWithContent()->total())->toBe(1)
        ->and($page->fresh()->contentable->body)->toBe('Example page')
        ->and($collection->contentable->contents()->first()->id)->toBe($link->id)
        ->and($link->collections()->first()->id)->toBe($collection->contentable->id)
        ->and($link->hits()->count())->toBe(1);

    $link->delete();
    expect(Link::count())->toBe(0)
        ->and(Hit::count())->toBe(0)
        ->and($collection->contentable->contents()->count())->toBe(0);

})->with(['default' => 'linky_', 'custom' => 'custom_', 'empty' => '']);

test('existing models keep their cached table while new models use the current prefix', function () {
    $content = new Content;
    expect($content->getTable())->toBe('linky_contents');

    config(['linky.db.prefix' => 'changed_']);

    expect($content->getTable())->toBe('linky_contents')
        ->and(Content::getTableName())->toBe('changed_contents');
});
