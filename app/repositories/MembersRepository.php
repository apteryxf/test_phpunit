<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Member;

class MembersRepository implements MembersRepositoryInterface
{
    public function all(): array
    {
        return Member::all()->toArray();
    }

    public function get(int $id): array
    {
        return Member::where('id', $id)->first()->toArray();
    }

    public function insert(string $name): void
    {
        $member = new Member;
        $member->name = $name;
        $member->save();
    }

    public function update(int $id, string $name): void
    {
        $member = Member::find($id);
        $member->name = $name;
        $member->save();
    }

    public function delete(int $id): void
    {
        $member = Member::find($id);
        $member->delete();
    }
}
