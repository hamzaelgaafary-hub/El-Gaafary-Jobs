<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('stores locale in session when switching language', function (): void {
    $response = $this->get(route('filament-language-switcher.switch', ['code' => 'ar']));

    $response->assertRedirect();

    $this->assertEquals('ar', session('locale'));

    $response->assertCookie('filament_language_switcher_locale');
});
