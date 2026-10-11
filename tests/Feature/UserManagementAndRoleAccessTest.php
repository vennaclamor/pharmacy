<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementAndRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_register_as_a_customer_and_reach_their_dashboard(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'New Customer',
            'email' => 'customer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $user = User::where('email', 'customer@example.com')->firstOrFail();

        $response->assertRedirect(route('dashboard', ['role' => 'customer']));
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseHas('users', [
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);
    }

    public function test_login_redirects_to_the_users_role_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'cashier-sales-staff']);

        $response = $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard', ['role' => 'cashier-sales-staff']));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_open_another_roles_dashboard(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get(route('dashboard', ['role' => 'administrator']));

        $response->assertForbidden();
    }

    public function test_each_proposal_role_has_its_own_dashboard_interface(): void
    {
        foreach (User::ROLES as $role) {
            $user = User::factory()->create(['role' => $role]);

            $response = $this->actingAs($user)->get(route('dashboard', ['role' => $role]));

            $response->assertOk();
            $response->assertViewIs('dashboards.'.$role);
            $welcomeLabels = [
                'administrator' => 'Administrator',
                'pharmacist-manager' => 'Pharmacist',
                'cashier-sales-staff' => 'Cashier',
                'customer' => 'Customer',
                'supplier-vendor' => 'Supplier',
            ];

            $response->assertSee('Welcome '.$welcomeLabels[$role].'!');
        }
    }

    public function test_friendly_role_dashboard_urls_use_the_correct_authorization(): void
    {
        $routes = [
            'pharmacist' => 'pharmacist-manager',
            'cashier' => 'cashier-sales-staff',
            'supplier' => 'supplier-vendor',
        ];

        foreach ($routes as $friendlyRole => $role) {
            $user = User::factory()->create(['role' => $role]);

            $response = $this->actingAs($user)->get('/dashboard/'.$friendlyRole);

            $response->assertOk();
            $response->assertSee('Welcome '.match ($role) {
                'pharmacist-manager' => 'Pharmacist',
                'cashier-sales-staff' => 'Cashier',
                'supplier-vendor' => 'Supplier',
            }.'!');
        }
    }

    public function test_administrator_can_create_update_and_delete_users(): void
    {
        $administrator = User::factory()->create(['role' => 'administrator']);

        $createResponse = $this->actingAs($administrator)->post(route('users.store'), [
            'name' => 'Maya Pharmacist',
            'email' => 'maya@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'pharmacist-manager',
        ]);

        $createResponse->assertRedirect(route('users.index'));
        $user = User::where('email', 'maya@example.com')->firstOrFail();
        $this->assertSame('pharmacist-manager', $user->role);

        $updateResponse = $this->actingAs($administrator)->put(route('users.update', $user), [
            'name' => 'Maya Manager',
            'email' => 'maya@example.com',
            'password' => '',
            'password_confirmation' => '',
            'role' => 'cashier-sales-staff',
        ]);

        $updateResponse->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Maya Manager',
            'role' => 'cashier-sales-staff',
        ]);

        $deleteResponse = $this->actingAs($administrator)->delete(route('users.destroy', $user));

        $deleteResponse->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_non_administrator_cannot_manage_users(): void
    {
        $user = User::factory()->create(['role' => 'supplier-vendor']);

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertForbidden();
    }
}
