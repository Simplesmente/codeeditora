<?php

namespace CodeEduBook\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use CodeEduUser\Entities\User;
use CodeEduBook\Entities\Book;


class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Undocumented function
     *
     * @param User $user
     * @param Book $book
     * @return boolean
     */
    public function update(User $user, Book $book): bool
    {
        return (boolean) $user->id == $book->author_id;
    }
}