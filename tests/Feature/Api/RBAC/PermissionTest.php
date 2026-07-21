<?php
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns all permissions', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    Permission::create([
        'name' => 'users-view',
        'guard_name' => 'api'
    ]);

    Permission::create([
        'name' => 'users-create',
        'guard_name' => 'api'
    ]);

    $response = $this->getJson('/api/rbac/permissions');

    $response->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'All permissions retrieved successfully.',
        ])
        ->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'guard_name',
                    'created_at',
                    'updated_at',
                ]
            ],
            'message'
        ])
        ->assertJsonCount(2, 'data')
        ->assertJsonFragment([
            'name' => 'users-view',
            'guard_name' => 'api'
        ])
        ->assertJsonFragment([
            'name' => 'users-create',
            'guard_name' => 'api'
        ]);
});

it('can store a new permission with valid data', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $payload = [
        'name' => 'users-delete',
        'guard_name' => 'api'
    ];

    $response = $this->postJson('/api/rbac/permissions', $payload);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'data' => [
                'name' => 'users-delete',
                'guard_name' => 'api',
            ],
            'message' => 'a permission created successfully.'
        ])
        ->assertJsonStructure([
            'success',
            'data' => ['id', 'name', 'guard_name', 'created_at', 'updated_at'],
            'message'
        ]);

    $this->assertDatabaseHas('permissions', [
        'name' => 'users-delete',
        'guard_name' => 'api'
    ]);
});

it('prevents guests storing a permission', function () {
    $payload = [
        'name' => 'users-delete',
        'guard_name' => 'api'
    ];

    $response = $this->postJson('/api/rbac/permissions', $payload);

    $response->assertStatus(401); // unauthorized

    $this->assertDatabaseMissing('permissions', [
        'name' => 'users-delete'
    ]);
});

it('validates required fields when creating a permission', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    // send empty payload
    $response = $this->postJson('/api/rbac/permissions', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'guard_name']);
});
