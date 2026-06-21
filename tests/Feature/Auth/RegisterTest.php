<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('User can register with valid data', function () {
    $response = $this->postJson('/api/auth/register', [
        'user_name' => 'testUser',
        'name' => 'testName',
        'email' => 'test@email.com',
        'password' => 'password123'
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true
        ])->assertJsonStructure([
                'success',
                'message',
                'data',
                'error'
            ]);

    $this->assertDatabaseHas('users', [
        'user_name' => 'testUser',
        'email' => 'test@email.com'
    ]);

    $this->assertAuthenticated();
    // check password hashed or not
    $user = User::firstOrFail();

    $this->assertTrue(Hash::check('password123',$user->password));
});

test('register validation errors', function () {
    $response = $this->postJson('/api/auth/register', []);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors([
            'user_name',
            'name',
            'email',
            'password'
        ]);
});

test('user cannot register with duplicate user name', function () {
    $user = User::factory()->create([
        'user_name' => 'user1'
    ]);


    $response = $this->postJson('/api/auth/register', [
        'user_name' => 'user1',
        'name' => 'name1',
        'email' => 'user1@email.com',
        'password' => 'password123'
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors(['user_name']);

});

test('user cannot register with duplicate email', function () {
    User::factory()->create([
        'email' => 'user1@email.com'
    ]);

    $response = $this->postJson('/api/auth/register', [
        'user_name' => 'user1',
        'name' => 'name1',
        'email' => 'user1@email.com',
        'password' => 'password123'
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('password must be at least 6 characters', function () {
    $response = $this->postJson('/api/auth/register', [
        'user_name' => 'user1',
        'name' => 'name1',
        'email' => 'user1@email.com',
        'password' => '123'
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors(['password']);
});