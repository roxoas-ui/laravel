<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user.{projectId}', function ($user, $projectId) {
    // Verificar associação do usuário com o projeto
    return $user->projects()->where('id', $projectId)->exists();
});
