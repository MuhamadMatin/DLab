<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
  use RefreshDatabase;
  public function test_index_returns_20_users_per_page_by_default()
  {
    // Create 25 users
    User::factory()->count(25)->create();

    // Call the index method
    $response = $this->getJson('/api/users');

    // Assert the response status is 200
    $response->assertStatus(200);

    // Assert the response structure
    $response->assertJsonStructure([
      'status',
      'users' => [
        'current_page',
        'data',
        'first_page_url',
        'from',
        'last_page',
        'last_page_url',
        'links',
        'next_page_url',
        'path',
        'per_page',
        'prev_page_url',
        'to',
        'total',
      ],
    ]);

    // Assert that the status is true
    $response->assertJson(['status' => true]);

    // Assert that 20 users are returned
    $response->assertJsonCount(20, 'users.data');

    // Assert that the per_page value is 20
    $response->assertJsonPath('users.per_page', 20);

    // Assert that the total number of users is 25
    $response->assertJsonPath('users.total', 25);
  }
  public function test_index_returns_paginated_users_when_users_exist()
  {
    // Create some test users
    User::factory()->count(25)->create();

    // Call the index method
    $response = $this->get('/api/users');

    // Assert the response status is 200
    $response->assertStatus(200);

    // Assert the response structure
    $response->assertJsonStructure([
      'status',
      'users' => [
        'current_page',
        'data',
        'first_page_url',
        'from',
        'last_page',
        'last_page_url',
        'links',
        'next_page_url',
        'path',
        'per_page',
        'prev_page_url',
        'to',
        'total',
      ],
    ]);

    // Assert that the status is true
    $response->assertJson(['status' => true]);

    // Assert that we have 20 users per page (as specified in the controller)
    $response->assertJsonCount(20, 'users.data');

    // Assert that the cache is working
    $this->assertTrue(Cache::has('users_index'));
  }
  public function test_index_returns_404_when_no_users()
  {
    // Ensure the database is empty
    User::truncate();

    // Clear the cache
    Cache::flush();

    $response = $this->getJson('/api/users');

    $response->assertStatus(404)
      ->assertJson([
        'status' => false,
        'error' => 'Users empty'
      ]);
  }
}
