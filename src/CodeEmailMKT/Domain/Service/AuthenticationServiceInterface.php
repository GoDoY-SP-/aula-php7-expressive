<?php

namespace CodeEmailMKT\Domain\Service;


interface AuthenticationServiceInterface
{
    public function authenticate($login, $password);

    public function isAuth();

    public function getUser();

    public function destroy();
}