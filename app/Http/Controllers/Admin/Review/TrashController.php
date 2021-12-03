<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Review\Review;
use App\Models\AdminPanel\Review\ReviewComment;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\Factory;
use Illuminate\View\View;

class TrashController extends Controller
{
    public function commentsList(): View|Factory|JsonResponse|Application
    {
        try {
            $comments = ReviewComment::query()->onlyTrashed()->orderBy('created_at', 'DESC')->paginate(15);

            return view('admin.trash-box.review-comments.index')->with(['comments' => $comments]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }

    public function restoreComment($id): JsonResponse|RedirectResponse
    {
        try {
            ReviewComment::query()->onlyTrashed()->where('id', $id)->restore();

            return redirect()->back()->withSuccess('Вы успешно восстановили комментарий к обзору!');
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }
}
