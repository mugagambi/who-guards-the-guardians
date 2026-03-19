<?php

declare(strict_types=1);

namespace App\Service\Flawed;

use App\Entity\Post;
use App\Entity\User;

class ContentAuthorizer
{
    public function canViewPost(Post $post, User $viewer): bool
    {
        // The bug: Blocked check falls through if the post is public or user is friend
        if ($post->isPublic() || $viewer->isFriend()) {
            return true;
        }

        if ($viewer->isBlocked()) {
            return false;
        }

        return false;
    }
}
