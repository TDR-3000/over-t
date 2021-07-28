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
		}])->get()->toArray();
	}

	public function getOne(int $id): array
	{
		return $this->user->with(['states' => function ($query) {
			return $query->select('id', 'state');
		}])->where('id', $id)->get()->toArray();
	}
}