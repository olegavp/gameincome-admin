<?php

namespace App\Http\Controllers\Admin\Review;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Review\CreateReviewRequest;
use App\Http\Requests\AdminPanel\Review\EditReviewRequest;
use App\Models\AdminPanel\Review\Review;
use App\Models\AdminPanel\Review\ReviewComment;
use App\Services\AdminPanel\Reviews\ReviewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    private ReviewsService $reviewsService;

    public function __construct(ReviewsService $reviewsService)
    {
        $this->reviewsService = $reviewsService;
    }

    public function reviewsPage(): Factory|View|Application
    {
        return view('admin.reviews.index');
    }

    public function allReviewsPage(): View|Factory|JsonResponse|Application
    {
        try {
            $reviews = Review::query()
                ->orderBy('created_at', 'DESC')
                ->paginate(8);

            return view('admin.reviews.list')->with(['reviews' => $reviews]);
        } catch (\Throwable $e) {
            return response()->json(
                [
                    'error' => 'Произошла ошибка при загрузке страницы списка обзоров, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                    'status' => 400,
                ], 400);
        }
    }

    public function createReviewPage(): View|Factory|JsonResponse|Application
    {
        try {
            $model = new Review();

            return view('admin.reviews.create', ['model' => $model]);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Произошла ошибка при загрузке страницы: ' . $e->getMessage()]);
        }
    }

    public function showReview(Review $review): View|Factory|JsonResponse|Application
    {
        try {
            $comments = ReviewComment::query()
                ->where('review_id', $review->id)
                ->orderBy('created_at', 'DESC')
                ->withTrashed()
                ->paginate(10);

            return view('admin.reviews.show')
                ->with(['review' => $review, 'comments' => $comments]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при переходе на обзор, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e->getMessage(),
                'status' => 400,
            ], 400);
        }

    }

    public function editReviewPage(Review $review): View|Factory|JsonResponse|Application
    {
        try {
            return view('admin.reviews.create')->with(['model' => $review]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при редактировании обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }

    public function createReview(CreateReviewRequest $request): JsonResponse|RedirectResponse
    {
        try {
            return $this->reviewsService->createReview($request->validated());
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при создании обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }

    public function editReview(Review $review, EditReviewRequest $request): JsonResponse|RedirectResponse
    {
        try {
            return $this->reviewsService->editReview($review, $request->validated());
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при редактировании обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }

    public function deleteReview($review): RedirectResponse|JsonResponse
    {
        try {
            $response = $this->reviewsService->deleteReview($review);

            if (isset($response->additional) && $response->additional['status'] === 200) {
                return redirect()->back()
                    ->withSuccess('Вы успешно удалили обзор! Если вы хотите восстановить его, то воспользуйтесь корзиной.');
            } else {
                return redirect()->back()
                    ->withErrors('Обзор не был удален! ' . $response['error']);
            }
        } catch (\Throwable $e) {

            return response()->json([
                'error' => 'Произошла ошибка при удалении обзора, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }

    }

    public function deleteReviewComment(ReviewComment $comment): JsonResponse|RedirectResponse
    {
        try {
            $response = $this->reviewsService->deleteComment($comment);

            if (isset($response->additional) && $response->additional['status'] === 200) {
                return redirect()->back()
                    ->withSuccess('Вы успешно удалили этот комментарий! Если вы хотите восстановить его, то воспользуйтесь корзиной.');
            } else {
                return redirect()->back()
                    ->withErrors('Комментарий не был удален! ' . $response['error']);
            }

        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Произошла ошибка при удалении комментария новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400,
            ], 400);
        }
    }
}
