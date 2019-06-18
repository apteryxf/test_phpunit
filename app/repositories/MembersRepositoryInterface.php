<?php
declare(strict_types=1);

namespace App\Repositories;

interface MembersRepositoryInterface
{
    public function all(): array;

    public function get(int $id): array;

    public function insert(string $name): void;

    public function update(int $id, string $name): void;

    public function delete(int $id): void;
}
