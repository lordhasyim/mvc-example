<?php
declare(strict_types=1);

namespace Demo\Domain;

use League\OAuth2\Client\Provider\Github;

class FetchFollowersHandler
{
    /**
     * @var Github
     */
    private $github;

    public function __construct(Github $github)
    {
        $this->github = $github;
    }

    public function handle(FetchFollowersCommand $command): array
    {
        $request = $this->github->getAuthenticatedRequest(
            $this->method(),
            $this->url(),
            $command->token()
        );

        $response = $this->github->getParsedResponse($request);

        return $response;
    }

    private function method(): string
    {
        return 'GET';
    }

    private function url(): string
    {
        // https://developer.github.com/v3/users/followers/
        return $this->github->apiDomain . '/user/followers';
    }
}
