<?php
namespace App\Repositories;
use App\Repositories\{Readable, Writetable};
use App\Models\User;
use App\Exceptions\UserException;
use Illuminate\Http\Request;
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

	public function store(Request $request): array
	{
		$data = $request->all();
		array_walk($data, function ($value, $key) use ($request) {
			$this->user->$key = $request->input($key);
		});
		$response = $this->user->save();

        if (!$response) {
            throw new UserException('Ha ocurrido un error', 500);
        }

		return [
			"id" => $this->user->id,
			"user_name" => $this->user->user_name,
			"email" => $this->user->email
		];
	}

	public function update(Request $request, int $id): array
	{
		$record = $this->user->find($id);

		if ($record === null) {
			throw new UserException('El registro no existe', 404);
		}

		$data = $request->all();

		array_walk($data, function ($value, $key) use ($record, $request) {
			$record->$key = (!empty($request->input($key))) ? $request->input($key) : $record->$key;
		});

		$response = $record->save();

        if (!$response) {
            throw new UserException('Ha ocurrido un error', 500);
        }

		return [
			"id" => $record->id,
			"user_name" => $record->user_name,
			"email" => $record->email
		];
	}

	public function delete(int $id): bool
	{
		$record = $this->user->find($id);

		if ($record === null) {
			throw new UserException('El registro no existe', 404);
		}

		$response = $record->delete();

		if (!$response) {
            throw new UserException('Ha ocurrido un error', 500);
        }

		return true;
	}

	//

	public function byEmailAndUserName(?string $email, ?string $userName): array
	{
		return $this->user->where('email', '=', $email)
                    ->orWhere('user_name', '=', $userName)
                    ->select('user_name', 'email', 'password')
                    ->get()
                    ->makeVisible('password')
                    ->toArray();
	}
}