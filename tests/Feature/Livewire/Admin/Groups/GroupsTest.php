<?php

namespace Tests\Feature\Livewire\Admin\Groups;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        $user = User::factory()->create();
        $group = Role::create(['name' => 'Super Admin']);
        $user->assignRole($group);

        $this->actingAs($user)->get(route('admin.groups'))
            ->assertStatus(200);
    }
}
