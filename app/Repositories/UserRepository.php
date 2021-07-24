<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use App\Models\User;
class UserRepository implements RepositoryInterface
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getAll(): array
	{
		return $this->user->get()->toArray();
	}
}