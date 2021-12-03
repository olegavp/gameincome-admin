<?php

use App\Http\Controllers\Admin\Appeals\Dispute\CloseDisputeAppealController;
use App\Http\Controllers\Admin\Appeals\Dispute\GetDisputeAppealController;
use App\Http\Controllers\Admin\Appeals\Dispute\GetDisputeMessagesController;
use App\Http\Controllers\Admin\Appeals\Dispute\OpenDisputeAppealController;
use App\Http\Controllers\Admin\Appeals\Dispute\SendDisputeMessageController;
use App\Http\Controllers\Admin\Appeals\General\CloseGeneralAppealController;
use App\Http\Controllers\Admin\Appeals\General\GetGeneralAppealController;
use App\Http\Controllers\Admin\Appeals\General\GetGeneralMessagesController;
use App\Http\Controllers\Admin\Appeals\General\OpenGeneralAppealController;
use App\Http\Controllers\Admin\Appeals\General\SendGeneralMessageController;
use App\Http\Controllers\Admin\Appeals\Partnership\ClosePartnershipAppealController;
use App\Http\Controllers\Admin\Appeals\Partnership\GetPartnershipAppealController;
use App\Http\Controllers\Admin\Appeals\Partnership\GetPartnershipMessagesController;
use App\Http\Controllers\Admin\Appeals\Partnership\OpenPartnershipAppealController;
use App\Http\Controllers\Admin\Appeals\Partnership\SendPartnershipMessageController;
use App\Http\Controllers\Admin\Appeals\Technical\CloseTechnicalAppealController;
use App\Http\Controllers\Admin\Appeals\Technical\GetTechnicalAppealController;
use App\Http\Controllers\Admin\Appeals\Technical\GetTechnicalMessagesController;
use App\Http\Controllers\Admin\Appeals\Technical\OpenTechnicalAppealController;
use App\Http\Controllers\Admin\Appeals\Technical\SendTechnicalMessageController;
use App\Http\Controllers\Admin\Employees\DeleteEmployeeController;
use App\Http\Controllers\Admin\Employees\EditEmployeesController;
use App\Http\Controllers\Admin\Employees\GetEmployeesController;
use App\Http\Controllers\Admin\Employees\RegistrationEmployeeController;
use App\Http\Controllers\Admin\Review\ReviewController;
use App\Http\Controllers\Admin\User\GetUsersController;
use App\Http\Controllers\Admin\User\UserInfoController;
use App\Http\Controllers\Admin\MainPage\CategoriesController;
use App\Http\Controllers\Admin\MainPage\HitsController;
use App\Http\Controllers\Admin\MainPage\InsertsController;
use App\Http\Controllers\Admin\MainPage\NoveltiesController;
use App\Http\Controllers\Admin\MainPage\RecommendationsController;
use App\Http\Controllers\Admin\MainPage\SaleOutController;
use App\Http\Controllers\Admin\MainPage\SliderController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\Product\PlatformsController;
use App\Http\Controllers\Admin\Product\ServicesController;
use App\Http\Controllers\Admin\PromoCode\PromoCodeController;
use App\Http\Controllers\Admin\Trash\TrashController;
use App\Http\Controllers\Admin\Review\TrashController as TrashReviewController;
use App\Http\Controllers\Admin\User\ProhibitionsController;
use App\Models\AdminPanel\Product\ItemToPlatform;
use App\Models\AdminPanel\Product\ItemToService;
use App\Models\AdminPanel\Product\Platform;
use App\Models\AdminPanel\Product\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes(['register' => false]);

Route::prefix('admin-panel')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('mainPage');

    Route::group(['middleware' => ['role:Администратор|Писатель новостей|Модератор']], function () {
        Route::prefix('/news')->group(function () {
            Route::get('/', [NewsController::class, 'newsPage'])->name('newsPage');
            Route::get('/small', [NewsController::class, 'smallNews'])->name('smallNews');
            Route::get('/big', [NewsController::class, 'bigNews'])->name('bigNews');
            Route::get('/{news}', [NewsController::class, 'showNews'])->name('toNews');
            Route::post('/create', [NewsController::class, 'createNews'])->name('createNews');
            Route::get('/create/small/news-page', [NewsController::class, 'createSmallNewsPage'])->name('createSmallNewsPage');
            Route::get('/create/big/news-page', [NewsController::class, 'createBigNewsPage'])->name('createBigNewsPage');
            Route::get('/edit/small/{news}/page', [NewsController::class, 'editSmallNewsPage'])->name('editSmallNewsPage');
            Route::get('/edit/big/{news}/page', [NewsController::class, 'editBigNewsPage'])->name('editBigNewsPage');
            Route::post('/edit/small/{news}', [NewsController::class, 'editSmallNews'])->name('editSmallNews');
            Route::post('/edit/big/{news}', [NewsController::class, 'editBigNews'])->name('editBigNews');
            Route::delete('/delete/news/{news}', [NewsController::class, 'deleteNews'])->name('deleteNews');
            Route::delete('/delete/comment/{newsComment}', [NewsController::class, 'deleteNewsComment'])->name('deleteNewsComment');
        });
    });

    Route::group(['middleware' => ['role:Администратор|Писатель обзоров|Модератор']], function () {
        Route::prefix('/reviews')->group(function () {
            Route::get('/', [ReviewController::class, 'reviewsPage'])->name('reviewsPage');
            Route::get('/all', [ReviewController::class, 'allReviewsPage'])->name('allReviewsPage');
            Route::get('/create', [ReviewController::class, 'createReviewPage'])->name('createReviewPage');
            Route::post('/create', [ReviewController::class, 'createReview'])->name('createReview');
            Route::get('/{review}', [ReviewController::class, 'showReview'])->name('showReview');
            Route::get('/edit/{review}', [ReviewController::class, 'editReviewPage'])->name('editReviewPage');
            Route::post('/edit/{review}', [ReviewController::class, 'editReview'])->name('editReview');
            Route::delete('/delete/reviews/{review}', [ReviewController::class, 'deleteReview'])->name('deleteReview');
            Route::delete('/delete/comment/{comment}', [ReviewController::class, 'deleteReviewComment'])->name('deleteReviewComment');
        });
    });

    Route::group(['middleware' => ['role:Администратор|Модератор']], function () {
        Route::prefix('user')->group(function () {
            Route::get('/to/{user}', [UserInfoController::class, 'index'])->name('toUser');
            Route::get('/to/{user}/comments', [UserInfoController::class, 'userComments'])->name('userComments');
            Route::get('/to/{user}/sessions', [UserInfoController::class, 'userSessions'])->name('userSessions');
            Route::delete('/sessions/{id}/delete', [UserInfoController::class, 'deleteUserSessions'])->name('deleteUserSessions');
            Route::get('/to/{user}/items-feedbacks', [UserInfoController::class, 'sellerFedbacks'])->name('sellersItemsFeedbacks');
            Route::post('/ban/{user}', [ProhibitionsController::class, 'ban'])->name('ban');
            Route::delete('/unban/{user}', [ProhibitionsController::class, 'unban'])->name('unban');

            Route::prefix('page')->group(function () {
                Route::prefix('search-user')->group(function () {
                    Route::get('/', [GetUsersController::class, 'index'])->name('getUserPage');
                });
            });

            Route::prefix('methods')->group(function () {
                Route::prefix('search-user')->group(function () {
                    Route::get('/', [GetUsersController::class, 'search'])->name('getUserMethod');
                });
            });
        });
    });


    Route::group(['middleware' => ['role:Администратор|Модератор']], function () {
        Route::prefix('promo-code')->group(function () {
            Route::get('/', [PromoCodeController::class, 'promoCodesPage'])->name('promoCodesPage');
            Route::get('/all/page', [PromoCodeController::class, 'allPromoCodesPage'])->name('allPromoCodesPage');
            Route::get('/create/page', [PromoCodeController::class, 'createPromoCodePage'])->name('createPromoCodePage');
            Route::post('/create', [PromoCodeController::class, 'createPromoCode'])->name('createPromoCode');
            Route::get('/edit/page/{promoCode}', [PromoCodeController::class, 'editPromoCodesPage'])->name('editPromoCodePage');
            Route::post('/edit/{promoCode}', [PromoCodeController::class, 'editPromoCode'])->name('editPromoCode');
            Route::delete('/delete/{promoCode}', [PromoCodeController::class, 'deletePromoCode'])->name('deletePromoCode');
        });
    });


//    Route::prefix('header')->group(function (){
//        Route::get('/', [HeaderController::class, 'allLinks']);
//        Route::post('/create', [HeaderController::class, 'createLink']);
//        Route::post('/edit/{header}', [HeaderController::class, 'editLink'])
//            ->missing(function (Request $request)
//            {
//                $id = explode('/', $request->getPathInfo())[5];
//                if (Header::withTrashed()->find($id))
//                {
//                    return response()->json(['error' => 'Данная ссылка находится в корзине.'], 200);
//                }
//                else
//                {
//                    return response()->json(['error' => 'Данной ссылки не существует!'], 404);
//                }
//            });
//        Route::delete('/delete/{header}', [HeaderController::class, 'deleteLink'])
//            ->missing(function (Request $request)
//            {
//                $id = explode('/', $request->getPathInfo())[4];
//                if (Header::withTrashed()->find($id))
//                {
//                    return response()->json(['error' => 'Данная ссылка находится в корзине.'], 200);
//                }
//                else
//                {
//                    return response()->json(['error' => 'Данной ссылки не существует!'], 404);
//                }
//            });
//    });

    Route::group(['middleware' => ['role:Администратор|Модератор']], function () {
        Route::prefix('main-page')->group(function () {
            Route::prefix('slider')->group(function () {
                Route::get('/', [SliderController::class, 'getSliderFramesPage'])->name('sliderPage');
                Route::get('/all-frames', [SliderController::class, 'getSliderFrames'])->name('sliderFrames');
                Route::get('/create/page', [SliderController::class, 'createSliderFramePage'])->name('createSliderFramePage');
                Route::post('/create', [SliderController::class, 'createSliderFrame'])->name('createSliderFrame');
                Route::get('/edit/{slider}/page', [SliderController::class, 'editSliderFramePage'])->name('editSliderFramePage');
                Route::post('/edit/{slider}', [SliderController::class, 'editSliderFrame'])->name('editSliderFrame');
                Route::delete('/delete/{slider}', [SliderController::class, 'deleteSliderFrame'])->name('deleteSliderFrame');
            });


            Route::prefix('inserts')->group(function () {
                Route::get('/', [InsertsController::class, 'insertsPage'])->name('insertsPage');
                Route::get('/all-inserts', [InsertsController::class, 'getInserts'])->name('getInserts');
                Route::get('/create/page', [InsertsController::class, 'createInsertPage'])->name('createInsertPage');
                Route::post('/create', [InsertsController::class, 'createInsert'])->name('createInsert');
                Route::delete('/delete/{insert}', [InsertsController::class, 'delete'])->name('deleteInsert');
            });


            Route::prefix('games')->group(function () {
                Route::get('/', function () {
                    return view('admin/main-page/games/index');
                })->name('main-page-games');

                Route::prefix('recommendations')->group(function () {
                    Route::get('/', function () {
                        return view('admin/main-page/games/recommendations/index');
                    })->name('recommendationsPage');
                    Route::get('/list', [RecommendationsController::class, 'all'])->name('recommendationsListPage');
                    Route::get('/create/page', function () {
                        $games = \App\Models\Product\Item\Game::query()->rightJoin('game_keys', 'game_keys.item_id', '=', 'games.id')->select('games.id', 'games.name')->distinct('id')->get();
                        $games = $games->map(function ($value) {
                            $serviceId = ItemToService::query()->where('item_id', $value->id)->select('service_id')->get();
                            $service = Service::query()->whereIn('id', $serviceId)->select('name')->first()->name;

                            $platformsId = ItemToPlatform::query()->where('item_id', $value->id)->select('platform_id')->get();
                            $platforms = Platform::query()->whereIn('id', $platformsId)->select('name')->get();
                            $platformString = null;
                            foreach ($platforms as $key => $platform) {
                                $platformString = $platformString . ', ' . $platform->name;
                            }
                            $platformString = substr($platformString, 2);
                            return array('name' => $value['name'] . ' ' . '(' . $service . ')' . ' ' . '(' . $platformString . ')', 'id' => $value['id']);
                        });

                        return view('admin/main-page/games/recommendations/create')->with(['games' => $games]);
                    })->name('createRecommendationPage');
                    Route::post('/create', [RecommendationsController::class, 'create'])->name('createRecommendation');
                    Route::delete('/delete/{recommendation}', [RecommendationsController::class, 'delete'])->name('recommendationDelete');
                });


                Route::prefix('hits')->group(function () {
                    Route::get('/', function () {
                        return view('admin/main-page/games/hits/index');
                    })->name('hitsPage');
                    Route::get('/list', [HitsController::class, 'all'])->name('hitsListPage');
                    Route::get('/create/page', function () {
                        $games = \App\Models\Product\Item\Game::query()->rightJoin('game_keys', 'game_keys.item_id', '=', 'games.id')->select('games.id', 'games.name')->distinct('id')->get();
                        $games = $games->map(function ($value) {
                            $serviceId = ItemToService::query()->where('item_id', $value->id)->select('service_id')->get();
                            $service = Service::query()->whereIn('id', $serviceId)->select('name')->first()->name;

                            $platformsId = ItemToPlatform::query()->where('item_id', $value->id)->select('platform_id')->get();
                            $platforms = Platform::query()->whereIn('id', $platformsId)->select('name')->get();
                            $platformString = null;
                            foreach ($platforms as $key => $platform) {
                                $platformString = $platformString . ', ' . $platform->name;
                            }
                            $platformString = substr($platformString, 2);
                            return array('name' => $value['name'] . ' ' . '(' . $service . ')' . ' ' . '(' . $platformString . ')', 'id' => $value['id']);
                        });

                        return view('admin/main-page/games/hits/create')->with(['games' => $games]);
                    })->name('createHitPage');
                    Route::post('/create', [HitsController::class, 'create'])->name('createHit');
                    Route::delete('/delete/{hit}', [HitsController::class, 'delete'])->name('hitDelete');
                });


                Route::prefix('novelties')->group(function () {
                    Route::get('/', function () {
                        return view('admin/main-page/games/novelties/index');
                    })->name('noveltiesPage');
                    Route::get('/list', [NoveltiesController::class, 'all'])->name('noveltiesListPage');
                    Route::get('/create/page', function () {
                        $games = \App\Models\Product\Item\Game::query()->rightJoin('game_keys', 'game_keys.item_id', '=', 'games.id')->select('games.id', 'games.name')->distinct('id')->get();
                        $games = $games->map(function ($value) {
                            $serviceId = ItemToService::query()->where('item_id', $value->id)->select('service_id')->get();
                            $service = Service::query()->whereIn('id', $serviceId)->select('name')->first()->name;

                            $platformsId = ItemToPlatform::query()->where('item_id', $value->id)->select('platform_id')->get();
                            $platforms = Platform::query()->whereIn('id', $platformsId)->select('name')->get();
                            $platformString = null;
                            foreach ($platforms as $key => $platform) {
                                $platformString = $platformString . ', ' . $platform->name;
                            }
                            $platformString = substr($platformString, 2);
                            return array('name' => $value['name'] . ' ' . '(' . $service . ')' . ' ' . '(' . $platformString . ')', 'id' => $value['id']);
                        });

                        return view('admin/main-page/games/novelties/create')->with(['games' => $games]);
                    })->name('createNoveltiesPage');
                    Route::post('/create', [NoveltiesController::class, 'create'])->name('createNovelty');
                    Route::delete('/delete/{novelty}', [NoveltiesController::class, 'delete'])->name('deleteNovelty');
                });


                Route::prefix('sale-out')->group(function () {
                    Route::get('/', function () {
                        return view('admin/main-page/games/sale-out/index');
                    })->name('saleOutPage');
                    Route::get('/list', [SaleOutController::class, 'all'])->name('saleOutsListPage');
                    Route::get('/create/page', function () {
                        $games = \App\Models\Product\Item\Game::query()->rightJoin('game_keys', 'game_keys.item_id', '=', 'games.id')->select('games.id', 'games.name')->distinct('id')->get();
                        $games = $games->map(function ($value) {
                            $serviceId = ItemToService::query()->where('item_id', $value->id)->select('service_id')->get();
                            $service = Service::query()->whereIn('id', $serviceId)->select('name')->first()->name;

                            $platformsId = ItemToPlatform::query()->where('item_id', $value->id)->select('platform_id')->get();
                            $platforms = Platform::query()->whereIn('id', $platformsId)->select('name')->get();
                            $platformString = null;
                            foreach ($platforms as $key => $platform) {
                                $platformString = $platformString . ', ' . $platform->name;
                            }
                            $platformString = substr($platformString, 2);
                            return array('name' => $value['name'] . ' ' . '(' . $service . ')' . ' ' . '(' . $platformString . ')', 'id' => $value['id']);
                        });

                        return view('admin/main-page/games/sale-out/create')->with(['games' => $games]);
                    })->name('createSaleOutPage');
                    Route::post('/create', [SaleOutController::class, 'create'])->name('createSaleOut');
                    Route::delete('/delete/{saleOut}', [SaleOutController::class, 'delete'])->name('deleteSaleOut');
                });
            });


            Route::prefix('categories')->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('categoriesPage');
                Route::get('/list', [CategoriesController::class, 'all'])->name('categoriesListPage');
                Route::get('/create/page', [CategoriesController::class, 'createPage'])->name('createCategoryPage');
                Route::post('/create', [CategoriesController::class, 'create'])->name('createCategory');
                Route::delete('/delete/{category}', [CategoriesController::class, 'delete'])->name('deleteCategory');
            });
        });


        Route::prefix('services')->group(function () {
            Route::get('/', [ServicesController::class, 'index'])->name('servicesPage');
            Route::get('/list', [ServicesController::class, 'all'])->name('servicesListPage');
            Route::get('/create/page', [ServicesController::class, 'createPage'])->name('serviceCreatePage');
            Route::post('/create', [ServicesController::class, 'create'])->name('serviceCreate');
            Route::get('/edit/{service}/page', [ServicesController::class, 'editPage'])->name('serviceEditPage');
            Route::post('/edit/{service}', [ServicesController::class, 'edit'])->name('serviceEdit');
            Route::delete('/delete/{service}', [ServicesController::class, 'delete'])->name('servicesDelete');
        });


        Route::prefix('platforms')->group(function () {
            Route::get('/', [PlatformsController::class, 'index'])->name('platformsPage');
            Route::get('/list', [PlatformsController::class, 'all'])->name('platformsListPage');
            Route::get('/create/page', [PlatformsController::class, 'createPage'])->name('platformsCreatePage');
            Route::post('/create', [PlatformsController::class, 'create'])->name('platformsCreate');
            Route::get('/edit/{platform}/page', [PlatformsController::class, 'editPage'])->name('platformEditPage');
            Route::post('/edit/{platform}', [PlatformsController::class, 'edit'])->name('platformEdit');
            Route::delete('/delete/{platform}', [PlatformsController::class, 'delete'])->name('deletePlatform');
        });


        Route::prefix('trash-box')->group(function () {
            Route::prefix('page')->group(function () {
                Route::get('/', [TrashController::class, 'index'])->name('trashBoxIndexPage');
                Route::prefix('news')->group(function () {
                    Route::get('/', [TrashController::class, 'newsList'])->name('trashBoxNewsPage');
                    Route::get('/{id}', [TrashController::class, 'toNews'])->name('trashBoxNewsToPage');
                });
                Route::prefix('news-comments')->group(function () {
                    Route::get('/', [TrashController::class, 'commentsList'])->name('trashBoxNewsCommentsPage');
                    Route::get('/{id}', [TrashController::class, 'toComment'])->name('trashBoxNewsCommentsToPage');
                });
                Route::prefix('reviews-comments')->group(function () {
                    Route::get('/', [TrashReviewController::class, 'commentsList'])->name('trashBoxReviewsCommentsPage');
                });
                Route::prefix('promo-codes')->group(function () {
                    Route::get('/', [TrashController::class, 'promoCodesList'])->name('trashBoxPromoCodesPage');
                });
                Route::prefix('user-banned')->group(function () {
                    Route::get('/', [TrashController::class, 'usersList'])->name('trashBoxBannedUsersPage');
                });
            });

            Route::prefix('methods')->group(function () {
                Route::prefix('news')->group(function () {
                    Route::post('/restore/{id}', [TrashController::class, 'restoreNews'])->name('trashBoxNewsRestore');
                });
                Route::prefix('news-comments')->group(function () {
                    Route::post('/restore/{id}', [TrashController::class, 'restoreComment'])->name('trashBoxNewsCommentRestore');
                });
                Route::prefix('promo-codes')->group(function () {
                    Route::post('/restore/{id}', [TrashController::class, 'restorePromoCode'])->name('trashBoxPromoCodeRestore');
                });
                Route::prefix('user-banned')->group(function () {
                    Route::post('/restore/{id}', [TrashController::class, 'unbanUser'])->name('trashBoxBannedUserRestore');
                });
                Route::prefix('review-comments')->group(function () {
                    Route::post('/restore/{id}', [TrashReviewController::class, 'restoreComment'])->name('trashBoxReviewCommentRestore');
                });
            });
        });
    });


    Route::group(['middleware' => ['role:Администратор']], function () {
        Route::prefix('employees')->group(function () {
            Route::prefix('page')->group(function () {
                Route::prefix('list')->group(function () {
                    Route::get('/', [GetEmployeesController::class, 'index'])->name('getEmployeesPage');
                });
                Route::prefix('registration')->group(function () {
                    Route::get('/', [RegistrationEmployeeController::class, 'index'])->name('registrationEmployeePage');
                });
                Route::prefix('edit')->group(function () {
                    Route::get('/{adminUser}', [EditEmployeesController::class, 'index'])->name('editEmployeePage');
                });
            });

            Route::prefix('methods')->group(function () {
                Route::post('/registration', [RegistrationEmployeeController::class, 'createEmployee'])->name('registrationEmployeeMethod');
                Route::delete('/delete/{adminUser}', [DeleteEmployeeController::class, 'deleteEmployee'])->name('deleteEmployeeMethod');
                Route::post('/edit/{adminUser}', [EditEmployeesController::class, 'edit'])->name('editEmployeeMethod');
            });
        });
    });

    Route::prefix('appeals')->group(function () {
        Route::group(['middleware' => ['role:Администратор|Модератор|Поддержка по вопросам споров']], function () {
            Route::prefix('dispute')->group(function () {
                Route::prefix('page')->group(function () {
                    Route::get('/', [GetDisputeAppealController::class, 'index'])->name('getDisputeAppealsPage');
                    Route::get('/open', [OpenDisputeAppealController::class, 'index'])->name('getOpenDisputeAppealsPage');
                    Route::get('/close', [CloseDisputeAppealController::class, 'index'])->name('getCloseDisputeAppealsPage');
                    Route::get('/to/{id}', [GetDisputeMessagesController::class, 'index'])->name('toDisputeAppealMessagesPage');
                });

                Route::prefix('methods')->group(function () {
                    Route::post('/send/{id}', [SendDisputeMessageController::class, 'send'])->name('sendDisputeAppealMessageMethod');
                    Route::get('/close/{id}', [CloseDisputeAppealController::class, 'closeAppeal'])->name('closeDisputeAppealMessageMethod');
                });
            });
        });
        Route::group(['middleware' => ['role:Администратор|Модератор|Поддержка по вопросам общего назначения']], function () {
            Route::prefix('general')->group(function () {
                Route::prefix('page')->group(function () {
                    Route::get('/', [GetGeneralAppealController::class, 'index'])->name('getGeneralAppealsPage');
                    Route::get('/open', [OpenGeneralAppealController::class, 'index'])->name('getOpenGeneralAppealsPage');
                    Route::get('/close', [CloseGeneralAppealController::class, 'index'])->name('getCloseGeneralAppealsPage');
                    Route::get('/to/{id}', [GetGeneralMessagesController::class, 'index'])->name('toGeneralAppealMessagesPage');
                });

                Route::prefix('methods')->group(function () {
                    Route::post('/send/{id}', [SendGeneralMessageController::class, 'send'])->name('sendGeneralAppealMessageMethod');
                    Route::get('/close/{id}', [CloseGeneralAppealController::class, 'closeAppeal'])->name('closeGeneralAppealMessageMethod');
                });
            });
        });
        Route::group(['middleware' => ['role:Администратор|Модератор|Поддержка по вопросам технической части']], function () {
            Route::prefix('technical')->group(function () {
                Route::prefix('page')->group(function () {
                    Route::get('/', [GetTechnicalAppealController::class, 'index'])->name('getTechnicalAppealsPage');
                    Route::get('/open', [OpenTechnicalAppealController::class, 'index'])->name('getOpenTechnicalAppealsPage');
                    Route::get('/close', [CloseTechnicalAppealController::class, 'index'])->name('getCloseTechnicalAppealsPage');
                    Route::get('/to/{id}', [GetTechnicalMessagesController::class, 'index'])->name('toTechnicalAppealMessagesPage');
                });

                Route::prefix('methods')->group(function () {
                    Route::post('/send/{id}', [SendTechnicalMessageController::class, 'send'])->name('sendTechnicalAppealMessageMethod');
                    Route::get('/close/{id}', [CloseTechnicalAppealController::class, 'closeAppeal'])->name('closeTechnicalAppealMessageMethod');
                });
            });
        });
        Route::group(['middleware' => ['role:Администратор|Модератор|Поддержка по вопросам сотрудничества']], function () {
            Route::prefix('partnership')->group(function () {
                Route::prefix('page')->group(function () {
                    Route::get('/', [GetPartnershipAppealController::class, 'index'])->name('getPartnershipAppealsPage');
                    Route::get('/open', [OpenPartnershipAppealController::class, 'index'])->name('getOpenPartnershipAppealsPage');
                    Route::get('/close', [ClosePartnershipAppealController::class, 'index'])->name('getClosePartnershipAppealsPage');
                    Route::get('/to/{id}', [GetPartnershipMessagesController::class, 'index'])->name('toPartnershipAppealMessagesPage');
                });

                Route::prefix('methods')->group(function () {
                    Route::post('/send/{id}', [SendPartnershipMessageController::class, 'send'])->name('sendPartnershipAppealMessageMethod');
                    Route::get('/close/{id}', [ClosePartnershipAppealController::class, 'closeAppeal'])->name('closePartnershipAppealMessageMethod');
                });
            });
        });
    });
});
    //Route::get('/get-steam-games', [SteamParsingController::class, 'getGamesInfo']);

Route::get('/home', function (){
    return redirect('admin-panel');
});
