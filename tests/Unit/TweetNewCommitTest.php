<?php

namespace Tests\Unit;

use App\Jobs\TweetNewCommit;
use App\Models\Pipeline;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class TweetNewCommitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pipeline_should_ignore_dependabot()
    {
        $payload = include 'tests/payloads/dependabot.php';

        $job = new TweetNewCommit(Pipeline::factory()->make(), $payload);
        $this->assertTrue($job->isPusherABot());
    }

    /** @test */
    public function pipeline_should_ignore_dependabot_with_commits()
    {
        $payload = include 'tests/payloads/dependabot_with_commits.php';

        $job = new TweetNewCommit(Pipeline::factory()->make(), $payload);
        $this->assertTrue($job->isPusherABot());
    }
}
