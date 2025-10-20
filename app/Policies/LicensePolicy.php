<?php

namespace App\Policies;

use App\Models\User;
use App\Models\License;

class LicensePolicy
{
    public function view(User $user, License $license)
    {
        // Exemplo: verificar permissão spatie ou se usuário está relacionado ao projeto
        return $user->hasPermissionTo('view licenses') || $user->projects()->where('id', $license->project_id)->exists();
    }

    public function manage(User $user, License $license)
    {
        return $user->hasPermissionTo('manage licenses');
    }

    // Compatibility with authorizeResource: map create/update/delete to manage
    public function create(User $user)
    {
        return $user->hasPermissionTo('manage licenses');
    }

    public function update(User $user, License $license)
    {
        return $this->manage($user, $license);
    }

    public function delete(User $user, License $license)
    {
        return $this->manage($user, $license);
    }
}
