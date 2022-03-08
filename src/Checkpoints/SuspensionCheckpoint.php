<?php namespace Cartalyst\Sentinel\Checkpoints;

use Cartalyst\Sentinel\Suspensions\SuspensionRepositoryInterface;
use Cartalyst\Sentinel\Users\UserInterface;

class SuspensionCheckpoint implements CheckpointInterface
{
    use AuthenticatedCheckpoint;

    protected $suspensions;

    public function __construct(SuspensionRepositoryInterface $suspensions)
    {
        $this->suspensions = $suspensions;
    }

    public function login(UserInterface $user): bool
    {
        return $this->checkSuspension($user);
    }


    public function check(UserInterface $user): bool
    {
        return $this->checkSuspension($user);
    }

    protected function checkSuspension(UserInterface $user): bool
    {
        $suspended = $this->suspensions->isSuspended($user);

        if ($suspended) {
            $exception = new SuspendedException('You have been suspended for ' . $this->suspensions->getSuspensionTime() .' minutes. There remains ' . $this->suspensions->getRemainingSuspensionTime($user) . ' minute(s).');
            $exception->setUser($user);

            throw $exception;
        }

        return true;
    }
}
