<?php
namespace LRC\Http\Controllers\Auth;

use Illuminate\Http\Request;
use LRC\Data\Users\UserRepository;
use LRC\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use LRC\Services\Registrar;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;


		private $userRepository;

	 /**
		* @param Registrar $registrar
		* @param UserRepository $userRepository
		*/
	 function __construct(Registrar $registrar,UserRepository $userRepository)
	 {
			 $this->registrar = $registrar;
			 $this->userRepository = $userRepository;
			 $this->middleware('guest',['except'=>'postChange']);
	 }


	 public function postChange($userId, Request $request)
   {

        $user = $this->userRepository->findOrFail($userId);

        $validator = $this->registrar->passwordValidator($request->all());

        if ( $validator->fails() )
        {
            return redirect()->back()->with('failure', 'Password update failed')->with('failure_msg', "Passwords do not match");
        }

        $this->registrar->updatePassword($request->all(),$user);

        return redirect()->back()->with('success', 'Password updated Successfully.');

    }
}
