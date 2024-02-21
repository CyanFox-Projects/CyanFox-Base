<?php

namespace App\Console\Commands\Admin\Groups;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\multiselect;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateGroupCommand extends Command
{
    protected $signature = 'c:admin:groups.create';

    protected $description = 'Create a new group';

    public function handle(): void
    {

        $name = text(
            'What is the groups\'s name?',
            required: true,
            validate: fn($name) => Role::where('name', $name)->exists() ? 'Name already in use.' : null
        );
        $guardName = text(
            'What is the group\'s guard name?',
            placeholder: 'web',
            default: 'web',
            required: true
        );
        $permissions = multiselect(
            label: 'Select the group\'s permissions',
            options: Permission::all()->pluck('name')->toArray(),
        );

        $role = Role::create([
            'name' => $name,
            'guard_name' => $guardName
        ]);

        $role->syncPermissions($permissions);

        $this->info('Group created successfully.');
    }
}
