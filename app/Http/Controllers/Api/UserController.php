<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function data(Request $request)
    {
        $users = User::orderBy('full_name', 'ASC');

        if ($request->has('search') && $request->get('search')['value'] !== null) {
            $search = $request->get('search');
            $keyword = $search['value'];

            $users->where('username', 'LIKE', $keyword . '%')
                ->orWhere('full_name', 'LIKE', $keyword . '%')
                ->orWhere('email', 'LIKE', $keyword . '%');
        }

        if($request->has('level') && $request->get('level') !== null && strtolower($request->get('level')) !== 'all') {
            $users->where('level', $request->get('level'));
        }

        $users->get();

        return datatables()->of($users)
            ->editColumn('full_name', function ($user) {
                return showName($user->full_name);
            })
            ->editColumn('avatar', function ($user) {
                $avatarPath = $user->avatar !== '' && Storage::exists($user->avatar)
                    ? Storage::url($user->avatar)
                    : asset('media/avatars/avatar7.jpg');
                return "<img class='img-avatar img-avatar48' src='" . $avatarPath . "' alt='User picture'>";
            })
            ->editColumn('level', function ($user) {
                return userBadge($user->level);
            })
            ->addColumn('action', function ($user) {
                return "<div class='btn-group'>
                    <a href='" . route('users.edit', $user->id) . "' class='btn btn-primary btn-sm'>
                        <i class='fa fa-pencil-alt'></i>
                    </a>
                    <button type='button' class='btn btn-danger btn-sm'
                        onclick='confirmDelete(`academic-staff/user`, `" . $user->id . "`)'>
                        <i class='fa fa-fw fa-trash'></i>
                    </button>
                </div>";
            })
            ->rawColumns(['avatar', 'level', 'action'])
            ->toJson();
    }
}
