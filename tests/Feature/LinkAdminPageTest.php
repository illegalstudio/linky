<?php

use Illuminate\Foundation\Testing\WithFaker;

uses(WithFaker::class);

test('link page is not accessible without auth and redirect to login', function () {
    $this->get(route('linky.admin.link.index'))
        ->assertStatus(302)
        ->assertRedirect('/login')
        ->assertSessionDoesntHaveErrors();
});
