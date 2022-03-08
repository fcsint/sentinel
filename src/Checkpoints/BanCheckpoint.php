<?php namespace Cartalyst\Sentinel\Checkpoints;

use Cartalyst\Sentinel\Bans\BanRepositoryInterface;
use Cartalyst\Sentinel\Users\UserInterface;

class BanCheckpoint implements CheckpointInterface
{
    use AuthenticatedCheckpoint;

    protected $bans;

    public function __construct(BanRepositoryInterface $bans)
    {
        $this->bans = $bans;
    }

    public function login(UserInterface $user): bool
    {
        return $this->checkBan($user);
    }

    public function check(UserInterface $user): bool
    {
        return $this->checkBan($user);
    }

    protected function checkBan(UserInterface $user): bool
    {
        $isBanned = $this->bans->isBanned($user);

        if ($isBanned) {
            $exception = new BannedException('You are banned.');

            $exception->setUser($user);

            throw $exception;
        }

        return true;
    }
}
