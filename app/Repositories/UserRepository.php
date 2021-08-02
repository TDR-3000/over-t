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
		$this->user->user_name = $request->input('user_name');
    	$this->user->first_name = $request->input('first_name');
    	$this->user->second_name = $request->input('second_name');
    	$this->user->first_last_name = $request->input('first_last_name');
		$this->user->second_last_name = $request->input('second_last_name');
		$this->user->email = $request->input('email');
		$this->user->cellphone = $request->input('cellphone');
		$this->user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
		$this->user->state_id = $request->input('state_id');
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

	public function delete(int $id)
	{
		$record = $this->user->find($id);

		if ($record === null) {
			throw new UserException('El registro no existe', 404);
		}

		$response = $record->delete();

		if (!$response) {
            throw new UserException('Ha ocurrido un error', 500);
        }

	}
}