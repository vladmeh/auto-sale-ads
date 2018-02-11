<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.02.2018
 * Time: 0:40
 */

namespace App\Service;


use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;

class UserManager
{
    /**
     * Doctrine entity manager.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * This method adds a new user.
     * @param string[] $data
     * @return User
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function addUser($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['$email'] . " already exists");
        }

        // Create new User entity.
        $user = new User();
        $user->setEmail($data['email']);

        $role = $this->entityManager->getRepository(Role::class)
            ->find($data['role']);
        $user->setRole($role);

        $user->setName($data['name']);

        // Encrypt password and store the password in encrypted state.
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);

        $user->setStatus($data['status']);

        $currentDate = new \DateTime('now');
        $user->setDateCreate($currentDate);

        // Add the entity to the entity manager.
        $this->entityManager->persist($user);

        // Apply changes to database.
        $this->entityManager->flush();

        return $user;
    }

    /**
     * This method updates data of an existing user.
     * @param User $user
     * @param string[] $data
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateUser(User $user, $data)
    {
        // Do not allow to change user email if another user with such email already exits.
        if($user->getEmail()!=$data['email'] && $this->checkUserExists($data['email'])) {
            throw new \Exception("Another user with email address " . $data['email'] . " already exists");
        }

        $user->setEmail($data['email']);
        $user->setName($data['name']);
        $user->setStatus($data['status']);

        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }

    /**
     * This method checks if at least one user presents, and if not, creates
     * 'Admin' user with email 'admin@local.loc' and password 'admin'.
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createAdminUserIfNotExists()
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([]);
        if ($user==null) {
            $user = new User();
            $user->setEmail('admin@local.loc');
            $role = $this->entityManager->getRepository(Role::class)
                ->find(1);
            $user->setRole($role);

            $user->setName('Admin');
            $bcrypt = new Bcrypt();
            $passwordHash = $bcrypt->create('admin');
            $user->setPassword($passwordHash);
            $user->setStatus(1);
            $user->setDateCreate(new \DateTime('now'));

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
    }

    /**
     * Checks whether an active user with given email address already exists in the database.
     * @param string $email
     * @return bool
     */
    public function checkUserExists($email) {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($email);

        return $user !== null;
    }

    /**
     * Checks that the given password is correct.
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function validatePassword(User $user, $password)
    {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }

        return false;
    }

    /**
     * Generates a password reset token for the user. This token is then stored in database and
     * sent to the user's E-mail address. When the user clicks the link in E-mail message, he is
     * directed to the Set Password page.
     * @param User $user
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function generatePasswordResetToken(User $user)
    {
        // Generate a token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz');
        $user->setPwdResetToken($token);

        $currentDate = new \DateTime('now');
        $user->setPwdResetTokenCreateDate($currentDate);

        $this->entityManager->flush();

        $subject = 'Password Reset';

        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $passwordResetUrl = 'http://' . $httpHost . '/set-password?token=' . $token;

        $body = 'Please follow the link below to reset your password:\n';
        $body .= "$passwordResetUrl\n";
        $body .= "If you haven't asked to reset your password, please ignore this message.\n";

        // Send email to user.
        mail($user->getEmail(), $subject, $body);
    }

    /**
     * Checks whether the given password reset token is a valid one.
     * @param string $passwordResetToken
     * @return bool
     */
    public function validatePasswordResetToken($passwordResetToken)
    {
        /**@var User $user*/
        $user = $this->entityManager->getRepository(User::class)
            ->findOneByPwdResetToken($passwordResetToken);

        if($user==null) {
            return false;
        }

        $tokenCreationDate = $user->getPwdResetTokenCreateDate();
        $tokenCreationDate = strtotime($tokenCreationDate);

        $currentDate = strtotime('now');

        if ($currentDate - $tokenCreationDate > 24*60*60) {
            return false; // expired
        }

        return true;
    }

    /**
     * This method sets new password by password reset token.
     * @param string $passwordResetToken
     * @param string $newPassword
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function setNewPasswordByToken($passwordResetToken, $newPassword)
    {
        if (!$this->validatePasswordResetToken($passwordResetToken)) {
            return false;
        }

        /**@var User $user*/
        $user = $this->entityManager->getRepository(User::class)
            ->findOneByPwdResetToken($passwordResetToken);

        if ($user==null) {
            return false;
        }

        // Set new password for user
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);

        // Remove password reset token
        $user->setPwdResetToken(null);
        $user->setPwdResetTokenCreateDate(null);

        $this->entityManager->flush();

        return true;
    }

    /**
     * This method is used to change the password for the given user. To change the password,
     * one must know the old password.
     * @param User $user
     * @param $data
     * @return bool
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function changePassword(User $user, $data)
    {
        $oldPassword = $data['old_password'];

        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }

        $newPassword = $data['new_password'];

        // Check password length
        if (strlen($newPassword)<6 || strlen($newPassword)>64) {
            return false;
        }

        // Set new password for user
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);

        // Apply changes
        $this->entityManager->flush();
        return true;
    }
}