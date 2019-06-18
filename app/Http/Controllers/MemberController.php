<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MembersRepositoryInterface AS MembersRepository;

class MemberController extends Controller
{
    protected $member;

    public function __construct(MembersRepository $member)
    {
        $this->member = $member;
    }

    public function index()
    {
        $members = $this->member->all();
        return view('members.index', compact('members'));
    }
        // $this->member->get(1);
        // $this->member->insert('member_011');
        // $this->member->update(11, 'member_11');
        // $this->member->delete(11);
}