<?php

use Illegal\Linky\Http\Middleware\EncryptCookies;
use Illegal\Linky\Http\Middleware\VerifyCsrfToken;
use Illegal\Linky\Tests\Authenticated;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

beforeEach(function () {
    $this->withoutVite();
    $this->withoutMiddleware([
        AddQueuedCookiesToResponse::class,
        EncryptCookies::class,
        VerifyCsrfToken::class,
    ]);
});

test('link page is accessible without auth', function () {
    $this->get(route('linky.admin.link.index'))
        ->assertStatus(200);
});

test('link create page is accesible without auth', function () {
    $this->get(route('linky.admin.link.create'))
        ->assertStatus(200);
});

/*--------------------------------------------------------------------------------
 * STORE
 * - store a link
 * - validation tests
 * -------------------------------------------------------------------------------
 */
test('post a link without auth', function () {
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->text(200),
            'url'    => $this->faker->url()
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('linky.admin.link.index'));
    $response->assertSessionDoesntHaveErrors();
});

test('post a link without `public` returns a validation error', function () {
    $response = $this->post(route('linky.admin.link.store'), [
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('post a link without `url` returns a validation error', function () {
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
        ]);
    $response->assertSessionHasErrors();
});

test('link slug must be unique and return a validation error', function () {
    //create first link
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'url'    => $this->faker->url(),
            'slug' => 'test-slug-1'
        ]);

    $response->assertStatus(302);
    $response->assertRedirect(route('linky.admin.link.index'));
    $response->assertSessionDoesntHaveErrors();

    //create second link with same slug
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'url'    => $this->faker->url(),
            'slug' => 'test-slug-1'
        ]);
    //we expect validation error
    $response->assertSessionHasErrors();
});

test('post a link with name length gt 255 returns a validation error', function () {
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('post a link with slug length gt 255 returns a validation error', function () {
    $response = $this->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'slug'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});
