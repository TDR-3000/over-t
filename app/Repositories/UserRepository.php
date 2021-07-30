<?php
namespace App\Repositories;
use App\Repositories\{Readable, Writetable};
use App\Models\User;
use App\Exceptions\UserException;
class UserRepository implements Readable, Writetable
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
		$record = $this->user->with(['states' => function ($query) {
			return $query->select('id', 'state');
		}])->where('id', $id)->get()->toArray();

		if ($record === null) {
			throw new UserException('El registro no existe', 404);
		}

		return $record;
	}

	public function delete(int $id)
	{
		$record = $this->user->find($id);

		if ($record === null) {
			throw new UserException('El registro no existe', 404);
		}

		$record->state_id = 1;
		$response = $record->save();

		if (!$response) {
            throw new UserException('Ha ocurrido un error', 500);
        }

	}
}