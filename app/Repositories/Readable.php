<?php
namespace App\Repositories;
interface Readable
{
	public function getAll(): array;

	public function getOne(int $id): array;
}