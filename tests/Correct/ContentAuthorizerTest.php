<?php

declare(strict_types=1);

namespace App\Tests\Correct;

use App\Entity\Post;
use App\Entity\User;
use App\Service\Correct\ContentAuthorizer;
use PHPUnit\Framework\TestCase;

class ContentAuthorizerTest extends TestCase
{
    public function testCanViewPost_CORRECT(): void
    {
        $authorizer = new ContentAuthorizer();

        // Blocklist rule overrides all!
        $blockedUser = new User('user-block', isBlocked: true);
        
        $publicPost = new Post('post-1', true);
        
        $this->assertFalse($authorizer->canViewPost($publicPost, $blockedUser));
    }
}
