<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use App\Models\User;
class UserRepository implements Readable
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getAll(): array
	{
		return $this->user->with(['states' => function ($query) {
			return $query->select('id', 'state');
		}])->select('id', 'user_name', 'email', 'state_id')->get()->toArray();
	}
}