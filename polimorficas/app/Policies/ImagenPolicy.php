<?php

namespace App\Policies;

use App\Models\Imagen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ImagenPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Imagen $imagen): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Imagen $imagen): Response
    {
        return $user->name == 'admin' || $user->id === $imagen->user_id
            ? Response::allow()
            : Response::deny("El usuario no es el creador de la imagen.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Imagen $imagen): Response
    {
        return $user->name == 'admin' || $user->id === $imagen->user_id
            ? Response::allow()
            : Response::deny("El usuario no es el creador de la imagen.");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Imagen $imagen): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Imagen $imagen): bool
    {
        return false;
    }
}
