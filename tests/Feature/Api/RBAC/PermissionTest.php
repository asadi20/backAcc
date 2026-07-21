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
