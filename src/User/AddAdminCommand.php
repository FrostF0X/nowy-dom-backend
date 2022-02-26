<?php

namespace App\User;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand('users:add:admin')]
class AddAdminCommand extends Command
{

    const ADMIN_MAIL = 'contact@etryvoga.com';

    public function __construct(private UserRepository $users, private UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
    }

    protected function configure()
    {
        parent::configure();
        $this->addArgument('password', InputArgument::REQUIRED);
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $this->users->findOneBy(['email' => self::ADMIN_MAIL]);
        if (!$user) {
            $user = new User();
        }
        $user->setEmail(self::ADMIN_MAIL);
        $user->setPassword($this->hasher->hashPassword($user, $input->getArgument('password')));
        $user->setRoles(['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        $this->users->save($user);
        return 0;
    }


}
