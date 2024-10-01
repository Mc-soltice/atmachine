    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\AuthControler;
    use App\Http\Controllers\Api\AccountsController;
    use App\Http\Controllers\Api\TransactionController;

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    Route::get('/', function () {
        return view('authentication/sign-in/basic');
    });
    Route::get('/sing-in', [AuthControler::class, 'signIn']);
    Route::get('/users', [AuthControler::class, 'getUsers']);
    Route::get('/register', [AuthControler::class, 'register']);
    Route::get('/users/{id}', [AuthControler::class, 'findUser']);
    Route::put('/users/{id}', [AuthControler::class, 'UpdateUser']);
    Route::delete('/users/{id}', [AuthControler::class, 'deleteUser']);
    Route::post('/sign-up', [AuthControler::class, 'createUserAccount']);
    
    
    
    Route::group(['middleware' => 'auth'], function(){
        Route::post('/connection', [AuthControler::class, 'login']);
        Route::post('/cash-in', [TransactionController::class, 'deposit']);
        Route::post('/cash-out', [TransactionController::class, 'withdraw']);
        Route::get('/accounts', [AccountsController::class, 'getAccounts']);
    });
    
    