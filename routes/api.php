<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\CrimeApiController;
use App\Http\Controllers\Api\WebsiteApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\Api\SocialLinkApiController;
use App\Http\Controllers\Api\CrimeQuestionApiController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\NormalReviewApiController;
use App\Http\Controllers\Api\PollingReviewApiController;
use App\Http\Controllers\Api\PollingCategoryApiController;
use App\Http\Controllers\Api\PollingQuestionApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\SurvayApiController;
use App\Models\User;

// localhost/post
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//================== api route link

Route::get('/user', function (Request $request) {
    return User::all();
});

Route::post('/register', [LoginController::class, 'createUser']);
Route::post('/login',[LoginController::class,'loginUser']);
Route::post('/email-verification/{email}',[LoginController::class,'EmailVerificationSent']);
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    
    // profile route
    Route::get('/profile', [ProfileApiController::class, 'profile_index_api']);
    Route::post('/profile/image', [ProfileApiController::class, 'update_image_api']);
    Route::post('/profile/password/change', [ProfileApiController::class, 'profile_password_change_api']);
    Route::post('/profile/edit', [ProfileApiController::class, 'edit_profile_api']);


// survay route
Route::post('survay/answers/store', [SurvayApiController::class, 'survay_answer_store']);

});


Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [ForgotPasswordController::class, 'reset']);

//  category route
Route::apiResource('category', CategoryApiController::class);

// news route
Route::apiResource('news', NewsApiController::class);
Route::get('news/show/{slug}', [NewsApiController::class, 'show']);



// category wise news search 
Route::get('category/wise/news/{slug}', [NewsApiController::class, 'category_wise_news']);

// related category news search 
Route::get('related/category/news/{slug}', [NewsApiController::class, 'related_category_news']);


// crime route
Route::get('crime', [CrimeApiController::class, 'index']);
Route::post('crime',[ CrimeApiController::class, 'store']);
Route::put('crime',[ CrimeApiController::class, 'update']);

// crime Extra Question route
Route::apiResource('crime_question', CrimeQuestionApiController::class);


//Page Route
Route::apiResource('page', PageApiController::class);
Route::get('page/delete/{id}', [PageApiController::class, 'destroy'])->name('page.delete');
Route::get('page/details/show/{slug}', [PageApiController::class, 'page_details'])->name('page.details');


//Social Links Route
Route::apiResource('social_links', SocialLinkApiController::class);


//General-Website Settings Route
Route::apiResource('settings', WebsiteApiController::class);


//Polling Category Settings Route
Route::apiResource('polling_category', PollingCategoryApiController::class);

//Polling Question Settings Route
Route::apiResource('polling_question', PollingQuestionApiController::class);

// Question Option Settings Route
Route::apiResource('question_option', PollingQuestionApiController::class);


// Live
//Polling Review Route
Route::post('polling_review', [PollingReviewApiController::class, 'store'])->name('api_polling_review.store');
Route::get('polling_review', [PollingReviewApiController::class, 'index']);
Route::get('polling_options', [PollingReviewApiController::class, 'polling_options']);

// Normal
//Normal Review Route
Route::post('normal_review', [NormalReviewApiController::class, 'store'])->name('api_normal_review.store');
Route::get('normal_review', [NormalReviewApiController::class, 'index']);
Route::get('all/normal_voting', [NormalReviewApiController::class, 'all_normal_voting']);

Route::get('normal_voting/{topic}', [NormalReviewApiController::class, 'single_normal_voting']);

//Polling topics wise questions Route
Route::get('topic/wise/questions/{slug}', [PollingCategoryApiController::class, 'topic_wise_questions']);
// get all topics route 
Route::get('all/topics', [PollingCategoryApiController::class, 'all_topics']);


// normal voting api
Route::post('normal/topic', [NormalReviewApiController::class, 'normalTopicPost']);
Route::get('normal/topic/{slug}', [NormalReviewApiController::class, 'normal_topic']);

// servay questions api
Route::get('survay/questions/', [SurvayApiController::class, 'survay_question_api']);
Route::get('survay/answers/', [SurvayApiController::class, 'survay_answer_api']);
Route::post('survay/answers/store', [SurvayApiController::class, 'survay_answer_store']);


// get all countries route 
Route::get('all/countries', [PollingCategoryApiController::class, 'all_countries']);

Route::get('home/live/topic', [PollingCategoryApiController::class, 'home_live_topic']);




 



