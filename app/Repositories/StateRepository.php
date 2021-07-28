<?php
namespace App\Repositories;

use App\Models\State;
use App\Exceptions\StateException;

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

	public function getOne(int $id): array
	{
		return $this->state->with(['users' => function ($query) {
			return $query->select('id', 'user_name', 'state_id');
		}])->where('id', $id)->get()->toArray();
	}
}