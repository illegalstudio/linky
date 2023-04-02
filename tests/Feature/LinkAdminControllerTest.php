<?php

use Illegal\Linky\Tests\Authenticated;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\LivewireServiceProvider;

uses(WithFaker::class);

beforeEach(function () {
    $this->withoutVite();
    $this->withoutMiddleware([
        AddQueuedCookiesToResponse::class,
        EncryptCookies::class,
        VerifyCsrfToken::class,
    ]);
});

test('link page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.index'))
        ->assertStatus(302)
        ->assertRedirect('/linky/login')
        ->assertSessionDoesntHaveErrors();
});

test('link page is accessible with auth', function () {
    login()
        ->get(route('linky.admin.link.index'))
        ->assertStatus(200);
});

test('link create page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.create'))
        ->assertStatus(302)
        ->assertRedirect('/linky/login')
        ->assertSessionDoesntHaveErrors();
});

test('link create page is accessible with auth', function () {
    login()
        ->get(route('linky.admin.link.create'))
        ->assertStatus(200);
});

/*--------------------------------------------------------------------------------
 * STORE
 * - store a link
 * - validation tests
 * -------------------------------------------------------------------------------
 */
test('post a link with auth', function () {
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->text(200),
            'url'    => $this->faker->url()
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('linky.admin.link.index'));
    $response->assertSessionDoesntHaveErrors();
});

test('post a link without `public` returns a validation error', function () {
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('post a link without `url` returns a validation error', function () {
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
        ]);
    $response->assertSessionHasErrors();
});

test('link slug must be unique and return a validation error', function () {
    //create first link
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'url'    => $this->faker->url(),
            'slug' => 'test-slug-1'
        ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('linky.admin.link.index'));
    $response->assertSessionDoesntHaveErrors();

    //create second link with same slug
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'url'    => $this->faker->url(),
            'slug' => 'test-slug-1'
        ]);
    //we expect validation error
    $response->assertSessionHasErrors();
});

test('post a link with name length gt 255 returns a validation error', function () {
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('post a link with slug length gt 255 returns a validation error', function () {
    $response = login()
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'slug'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

/*--------------------------------------------------------------------------------
 * EDIT
 * - edit a link
 * - validation tests
 * -------------------------------------------------------------------------------
 */
test('link edit page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.edit', ['link' => 1]))
        ->assertStatus(302)
        ->assertRedirect('/linky/login')
        ->assertSessionDoesntHaveErrors();
});

test('link edit page is accessible with auth', function () {

    $linkRepository = app(\Illegal\Linky\Repositories\LinkRepository::class);

    $link = $linkRepository->create(
        ['url' => $this->faker->url()],
        $this->faker->boolean(),
        $this->faker->slug(),
        $this->faker->text(200),
        $this->faker->text(200)
    );

    login()
        ->get(route('linky.admin.link.edit', ['link' => 1]))
        ->assertStatus(200);

    $link->delete();
});

test('link edit page throw an exception if no link id provided', function () {
    expect(fn() => login()->get(route('linky.admin.link.edit' )))
        ->toThrow(\Illuminate\Routing\Exceptions\UrlGenerationException::class);
});

test('link edit page return 404 if no link found', function () {
    login()
        ->get(route('linky.admin.link.edit', ['link' => 1]))
        ->assertStatus(404);
});

