<?php

namespace App\Services\AdminPanel\Reviews;

use App\Http\Resources\AdminPanel\Review\ReviewCommentResource;
use App\Http\Resources\AdminPanel\Review\ReviewsResource;
use App\Models\AdminPanel\Review\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewsService
{
    public function createReview($data): JsonResponse|RedirectResponse
    {
        try {
            $review = Review::create(array_merge($data, ['writer_id' => Auth::user()->id]));

            if ($review) {
                return redirect()->route('showReview', ['review' => $review->id])
                    ->withSuccess('Вы успешно создали обзор!');
            } else {
                return redirect()->back()->withErrors('Ошибка создания обзора');
            }

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при создании обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }

    public function editReview($review, $data): JsonResponse|RedirectResponse
    {
        try {
            if ($review->update($data)) {
                return redirect()->route('showReview', ['review' => $review->id])
                    ->withSuccess('Вы успешно обновили этот обзор!');
            } else {
                return redirect()->back()->withErrors('Ошибка обновления обзора!');

            }

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при редактировании обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }


    public function deleteReview($review): array
    {
        try {
            if(Db::table('main_page_reviews')->where('review_id', $review->id)->exists()) {
                return [
                    'error' => 'Невозможно удалить обзор, он расположен на главной странице сайта.',
                    'status' => 400,
                ];
            }
            $review->delete();

            return [
                'message' => 'Вы успешно удалили обзор!',
                'status' => 200,
            ];
        } catch (\Throwable $e) {
            return [
                'error' => 'Произошла ошибка при удалении обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e->getMessage(),
                'status' => 400,
            ];
        }
    }


    public function deleteComment($comment): ReviewCommentResource|JsonResponse
    {
        try {
            $deletedModel = $comment;
            $comment->delete();

            return (new ReviewCommentResource($deletedModel))
                ->additional([
                    'message' => 'Вы успешно удалили этот комментарий! Если вы хотите восстановить его, то воспользуйтесь корзиной.',
                    'status' => 200,
                ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при удалении комментария обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }
}
