<?php

declare(strict_types=1);

namespace App\Service\Correct;

use App\Entity\Post;
use App\Entity\User;

class ContentAuthorizer
{
    public function canViewPost(Post $post, User $viewer): bool
    {
        // The Fix: Override rules (like blocklist) must be checked first
        if ($viewer->isBlocked()) {
            return false;
        }

        if ($post->isPublic() || $viewer->isFriend()) {
            return true;
        }

        return false;
    }
}
