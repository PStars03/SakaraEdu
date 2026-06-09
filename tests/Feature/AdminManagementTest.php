<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $superAdmin;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->superAdmin = User::factory()->create(['role' => 'super_admin', 'is_active' => true]);
        $this->admin = User::factory()->create(['role' => 'admin', 'is_active' => true]);
    }

    public function test_super_admin_can_view_admins_list()
    {
        $response = $this->actingAs($this->superAdmin)->get(route('super-admin.admins.index'));
        $response->assertStatus(200);
        $response->assertSee('Kelola Admin');
    }

    public function test_super_admin_can_create_admin()
    {
        $response = $this->actingAs($this->superAdmin)->post(route('super-admin.admins.store'), [
            'name' => 'New Admin',
            'email' => 'newadmin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('super-admin.admins.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'newadmin@test.com',
            'role' => 'admin',
        ]);
    }

    public function test_super_admin_can_update_admin()
    {
        $response = $this->actingAs($this->superAdmin)->put(route('super-admin.admins.update', $this->admin->id), [
            'name' => 'Updated Admin',
            'email' => 'updatedadmin@test.com',
        ]);

        $response->assertRedirect(route('super-admin.admins.index'));
        $this->assertDatabaseHas('users', [
            'id' => $this->admin->id,
            'name' => 'Updated Admin',
            'email' => 'updatedadmin@test.com',
        ]);
    }

    public function test_super_admin_can_delete_admin()
    {
        $response = $this->actingAs($this->superAdmin)->delete(route('super-admin.admins.destroy', $this->admin->id));

        $response->assertRedirect(route('super-admin.admins.index'));
        $this->assertDatabaseMissing('users', [
            'id' => $this->admin->id,
        ]);
    }

    public function test_admin_cannot_access_super_admin_management()
    {
        $response = $this->actingAs($this->admin)->get(route('super-admin.admins.index'));
        $response->assertStatus(403);
    }

    public function test_super_admin_can_toggle_admin_status()
    {
        $this->assertTrue($this->admin->is_active);

        \Livewire\Livewire::actingAs($this->superAdmin)
            ->test('admin-management-table')
            ->call('toggleStatus', $this->admin->id);

        $this->admin->refresh();
        $this->assertFalse($this->admin->is_active);

        \Livewire\Livewire::actingAs($this->superAdmin)
            ->test('admin-management-table')
            ->call('toggleStatus', $this->admin->id);

        $this->admin->refresh();
        $this->assertTrue($this->admin->is_active);
    }
}
