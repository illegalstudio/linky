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

test('link page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.index'))
        ->assertStatus(302)
        ->assertRedirect('/login')
        ->assertSessionDoesntHaveErrors();
});

test('link page is accessible with auth', function () {
    $this->actingAs(Authenticated::user())
        ->get(route('linky.admin.link.index'))
        ->assertStatus(200);
});

test('link create page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.create'))
        ->assertStatus(302)
        ->assertRedirect('/login')
        ->assertSessionDoesntHaveErrors();
});

test('link create page is accessible with auth', function () {
    $this->actingAs(Authenticated::user())
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
    $response = $this->actingAs(Authenticated::user())
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->text(200),
            'url'    => $this->faker->url()
        ]);
    $response->assertStatus(302);
    $response->assertRedirect(route('linky.admin.link.index'));
    $response->assertSessionDoesntHaveErrors();
});

test('link without `public` returns a validation error', function () {
    $response = $this->actingAs(Authenticated::user())
        ->post(route('linky.admin.link.store'), [
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('link without `url` returns a validation error', function () {
    $response = $this->actingAs(Authenticated::user())
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

test('link with name length gt 255 returns a validation error', function () {
    $response = $this->actingAs(Authenticated::user())
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'name'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});

test('lin with slug length gt 255 returns a validation error', function () {
    $response = $this->actingAs(Authenticated::user())
        ->post(route('linky.admin.link.store'), [
            'public' => $this->faker->boolean(),
            'slug'   => $this->faker->realTextBetween(256,300),
            'url'    => $this->faker->url()
        ]);
    $response->assertSessionHasErrors();
});
