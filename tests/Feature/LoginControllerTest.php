<?php

namespace Tests\Feature;

use App\User;
use Faker\Provider\Address;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp():void
    {
        parent::setUp();
        Auth::logout();
    }


    /**
     * authenticate with valid credentials.
     *
     * @return void
     */
    public function testAuthenticateValid()
    {

        $validPassword = Str::random();
        $user = factory(User::class)->create([
            'password' => Hash::make($validPassword)
        ]);

        Auth::login($user);

        $data = [
            'email' => $user->email,
            'password' => $validPassword
        ];
        $response = $this->post('/api/login', $data);
        $response
            ->assertStatus(200)
            ->assertJson(['user' => Auth::user()->toArray()]);
    }

    /**
     *  authenticate with invalid email
     */
    public function testAuthenticateInvalidEmail()
    {
        $validPassword = Str::random();
        $user = factory(User::class)->create([
            'password' => Hash::make($validPassword)
        ]);

        /*
        *  Invalid email
        * */
        $data = [
            'email' => $user->email . 'rubbish',
            'password' => $validPassword
        ];
        $response = $this->post('/api/login', $data);
        $response
            ->assertStatus(200)
            ->assertJson(['user' => null]);
    }

    /**
     *  authenticate with invalid pass
     */
    public function testAuthenticateInvalidPassword()
    {
        $validPassword = Str::random();
        $user = factory(User::class)->create([
            'password' => Hash::make($validPassword)
        ]);

        /*
        *  Invalid pass
        * */
        $data = [
            'email' => $user->email,
            'password' => $validPassword . 'rubbish'
        ];
        $response = $this->post('/api/login', $data);
        $response
            ->assertStatus(200)
            ->assertJson(['user' => null]);
    }

    /**
     *  Logout using valid token
     */
    public function testLogoutWithToken()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        $response = $this->post('/api/logout');

        $response->assertOk();
        self::assertFalse(Auth::check());
    }
}
