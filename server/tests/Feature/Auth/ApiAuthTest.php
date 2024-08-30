<?php

namespace Tests\Feature\Auth;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{

    use DatabaseTransactions;

    public function validPayload($overrides = [])
    {
        return array_merge([
            'name' => "houssem",
            'email' => "houssem@gmail.com",
            'password' => "Ho123456*",
        ], $overrides);
    }



    /**
     * 
     */
    public function test_that_it_validate_required_fields_for_register(): void
    {
        $this->updateLocale('foo');

        $this->postJson(route('auth.register'), $this->validPayload([
            'name' => '',
            'email' => '',
            'password' => '',
        ]))->assertJsonFragment([
            'name' => ['validation.required'],
            'email' => ['validation.required'],
            'password' => ['validation.required'],
        ]);
    }

    public function test_that_it_validate_email_is_valid_for_register(): void
    {
        $this->updateLocale('foo');

        $this->postJson(route('auth.register'), $this->validPayload([
            'email' => 'email.gmailcom'
        ]))->assertJsonFragment([
            'email' => ['validation.email']
        ]);
    }

    public function test_validate_password_is_valid_for_register(): void
    {
        $this->updateLocale('foo');

        $this->postJson(route('auth.register'), $this->validPayload([
            'password' => '12345'
        ]))->assertJsonFragment([
            'password' => ["validation.password.mixed", "validation.password.symbols"]
        ]);
    }

    public function test_send_queuedEmail_for_register(): void
    {
        Mail::fake();

        $user = User::make($this->validPayload());

        Mail::to($user->email)->queue(new WelcomeEmail($user));

        Mail::assertQueued(WelcomeEmail::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
