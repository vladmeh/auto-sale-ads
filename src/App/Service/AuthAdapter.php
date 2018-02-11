<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 11.02.2018
 * Time: 2:50
 */

namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;

class AuthAdapter implements AdapterInterface
{
    /**
     * E-mail пользователя.
     * @var string
     */
    private $email;

    /**
     * Пароль.
     * @var string
     */
    private $password;

    /**
     * Менеджер сущностей.
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Конструктор.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function authenticate()
    {
        // Проверяем, есть ли в базе данных пользователь с таким адресом.
        /** @var User $user */
        $user = $this->entityManager->getRepository(User::class)
            ->findOneByEmail($this->email);

        // Если такого пользователя нет, возвращаем статус 'Identity Not Found'.
        if ($user == null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']);
        }

        // Если пользователь с таким адресом существует, необходимо проверить, активен ли он.
        // Неактивные пользователи не могут входить в систему.
        if ($user->getStatus()== 0) {
            return new Result(
                Result::FAILURE,
                null,
                ['User is retired.']);
        }

        // Теперь необходимо вычислить хэш на основе введенного пользователем пароля и сравнить его
        // с хэшем пароля из базы данных.
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($this->password, $passwordHash)) {
            // Отлично! Хэши паролей совпадают. Возвращаем личность пользователя (эл. адрес) для
            // хранения в сессии с целью последующего использования.
            return new Result(
                Result::SUCCESS,
                $this->email,
                ['Authenticated successfully.']);
        }

        // Если пароль не прошел проверку, возвращаем статус ошибки 'Invalid Credential'.
        return new Result(
            Result::FAILURE_CREDENTIAL_INVALID,
            null,
            ['Invalid credentials.']);
    }
}