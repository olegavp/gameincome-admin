<?php

namespace App\Services\AdminPanel\Reviews;

use App\Http\Resources\AdminPanel\Review\ReviewCommentResource;
use App\Http\Resources\AdminPanel\Review\ReviewsResource;
use App\Models\AdminPanel\Review\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReviewsService
{
    public function createReview($data): JsonResponse|RedirectResponse
    {
        try {
            $review = Review::create($data);

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


    public function deleteReview($review): ReviewsResource|JsonResponse
    {
        try {
            $deletedModel = $review;
            $review->delete();

            return (new ReviewsResource($deletedModel))
                ->additional([
                    'message' => 'Вы успешно удалили обзор! Если вы хотите его восстановить, то воспользуйтесь корзиной.',
                    'status' => 200,
                ]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при удалении обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
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
