<?php

use App\Mail\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('requires name email and message', function () {
    Mail::fake();

    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);

    Mail::assertNothingSent();
});

it('sends a mail when form is valid', function () {
    Mail::fake();

    $this->post('/contact', [
        'name' => 'Alice',
        'email' => 'alice@example.com',
        'message' => 'Hello there',
    ])->assertRedirect()
        ->assertSessionHas('success');

    Mail::assertSent(ContactMessage::class, function ($mail) {
        return $mail->name === 'Alice' &&
               $mail->email === 'alice@example.com' &&
               $mail->message === 'Hello there';
    });
});
