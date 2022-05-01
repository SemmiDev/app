<?php

namespace Modules\Session\Repository;

use Modules\Role\Repository\RoleRepository;
use Modules\Session\Entity\SessionEntity;
use Modules\User\Entity\UserEntity;
use Modules\User\Entity\UserEntityDetails;
use Modules\User\Repository\UserRepository;

class SessionService
{

    public static string $COOKIE_NAME = "X-APP-SESSION";

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;
    private RoleRepository $roleRepository;

    public function __construct(
        SessionRepository $sessionRepository,
        UserRepository $userRepository,
        RoleRepository $roleRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function create(string $userId): SessionEntity
    {
        $session = new SessionEntity();
        $session->id = uniqid();
        $session->userId = $userId;

        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 30), "/");

        return $session;
    }

    public function destroy()
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->sessionRepository->deleteById($sessionId);

        setcookie(self::$COOKIE_NAME, '', 1, "/");
    }

    public function current(): ?UserEntityDetails
    {
        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';

        $session = $this->sessionRepository->findById($sessionId);
        if($session == null){
            return null;
        }

        $user = $this->userRepository->findById($session->userId);
        $role = $this->roleRepository->findById($user->idRole);
        $details = new UserEntityDetails($user, $role);
        $details->id = $user->id;
        return $details;
    }
}