<?php

declare(strict_types=1);

namespace App\Tests\Flawed;

use App\Entity\Post;
use App\Entity\User;
use App\Service\Flawed\ContentAuthorizer;
use PHPUnit\Framework\TestCase;

class ContentAuthorizerTest extends TestCase
{
    public function testCanViewPost_FLAWED(): void
    {
        $authorizer = new ContentAuthorizer();

        // 1. Stranger views a public post
        $stranger = new User('user-1');
        $publicPost = new Post('post-1', true);
        $this->assertTrue($authorizer->canViewPost($publicPost, $stranger));

        // 2. Friend views private post
        $friend = new User('user-2', isFriend: true);
        $privatePost = new Post('post-2', false);
        $this->assertTrue($authorizer->canViewPost($privatePost, $friend));
    }
}
