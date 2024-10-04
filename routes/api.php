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
    Route::post('/connection', [AuthControler::class, 'login']);
    Route::get('/register', [AuthControler::class, 'register']);
    Route::get('/users/{id}', [AuthControler::class, 'findUser']);
    Route::put('/users/{id}', [AuthControler::class, 'UpdateUser']);
    Route::delete('/users/{id}', [AuthControler::class, 'deleteUser']);
    Route::post('/sign-up', [AuthControler::class, 'createUserAccount']);
    Route::get('/accounts', [AccountsController::class, 'getAccounts']);
    Route::get('/transactions', [TransactionController::class, 'getAllTransactions']);
    Route::post('/accounts/{userId}', [TransactionController::class, 'doTransaction']);
    Route::post('/trans-accounts/{userId}', [TransactionController::class, 'transferFunds']);
    
    

