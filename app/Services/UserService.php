<?php
namespace App\Services;

use Illuminate\Contracts\Mail\Mailer;
use App\Repositories\UserRepositoryInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /** @var UserRepositoryInterface */
    protected $user;

    /** @var UserRepositoryInterface */
    protected $mailer;

    /**
     * @param UserRepositoryInterface $user
     * @param Mailer $mailer
     */
    public function __construct(UserRepositoryInterface $user, Mailer $mailer)
    {
        $this->user = $user;
        $this->mailer = $mailer;
    }

    /**
     * @param array $params
     * @return \App\DataAccess\Eloquent\User
     */
    public function registerUser(array $params)
    {
        $user = $this->user->save($params);
        $this->mailer->send(
            'emails.register',
            ['user' => $user],
            function ($m) use ($user) {
                $m->sender('laravel-reference@example.com', 'Laravel リファレンス')
                    ->to($user->email, $user->name)
                    ->subject('ユーザー登録が完了しました');
            }
        );
    }
}