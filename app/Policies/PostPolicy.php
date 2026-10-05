<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /** Semua user login boleh melihat daftar post. */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /** Hanya admin & editor yang boleh membuat post. */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isEditor();
    }

    /** Admin: semua post. Editor: hanya post miliknya. User biasa: tidak boleh. */
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || ($user->isEditor() && $user->id === $post->user_id);
    }

    /** Aturan delete sama dengan update. */
    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}