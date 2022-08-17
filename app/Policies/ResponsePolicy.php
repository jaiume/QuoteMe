<?php

namespace App\Policies;

use App\Models\Response;
use App\Models\Supplier;
use App\Models\User;
use App\Utils\PermissionUtils;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ResponsePolicy
 * @package App\Policies
 */
class ResponsePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param Response $response
     * @return bool
     */
    public function view(User $user, Response $response): bool
    {
        try {
            $supplier = Supplier::findOrFail($user->id);
            return optional($response->supplier)->id === $supplier->id;
        } catch (ModelNotFoundException $e) {
            // Do nothing
        }

        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return false;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        return false;
    }
}
