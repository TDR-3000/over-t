<?php
namespace App\Repositories;
use App\Repositories\RepositoryInterface;
use App\Models\State;
class StateRepository implements Readable
{
	private $state;

	public function __construct(State $state)
	{
		$this->state = $state;
	}

	public function getAll(): array
	{
		return $this->state->with(['users' => function ($query) {
			return $query->select('id', 'user_name', 'state_id');
		}])->get()->toArray();
	}
}