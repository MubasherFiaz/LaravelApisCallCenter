<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        // return true;
        if (
            Auth::attempt([
                'email' => request('email'),
                'password' => request('password'),
            ])
        ) {

            $user = Auth::user();
            $user['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(
                ['success' => $user],
                $this->successStatus
            );
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd("ads");
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'company_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        try {
            $user = User::create($input);
            $user['token'] = $user->createToken('MyApp')->accessToken;
            return $user;


        return response()->json(['response' => $user]);
    }
    catch (\Throwable $th) {
            return response()->json(['response' => 402]);
            //throw $th;
        }

   }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
