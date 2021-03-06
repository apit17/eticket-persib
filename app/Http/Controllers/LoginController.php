<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use Sentry;
use Redirect;
use App\Models\User;


class LoginController extends Controller
{
    /*
     * Login index
     */
    public function index()
    {
        return View::make('backend.login');
    }

    /*
     * Dashboard page
     */
    public function dashboard()
    {
        if (Sentry::check()) {
            $admin = Sentry::getUser();
            return View::make('backend.dashboard')->withAdmin($admin);
        } else {
            return Redirect::to('/');
        }
    }

    /*
     * Setting Admin Page
     */
    public function setting()
    {
        $admin = Sentry::getUser();
        return View::make('backend.setting')->withAdmin($admin);
    }

    /*
     * Update Admin Account
     */
    public function updateAdmin(Request $request)
    {
        $post = $request->all();
        $admin = Sentry::getUser();
        $admin->first_name = $post['first_name'];
        $admin->last_name = $post['last_name'];

        if ($admin->save()) {
            session()->flash('flash_message', 'Account has been updated');
            return Redirect::back();
        } else {
            session()->flash('flash_message_error', 'Failed to update account');
            return Redirect::back();
        }
    }

    /*
     * Login function
     */
    public function login(Request $request)
    {
        $data = $request->all();
        try
            {
                $admin = Sentry::findUserByLogin($data['email']);
                $group = User::join('users_groups', 'users_groups.user_id', '=', 'users.id')->where('users_groups.user_id', $admin['id'])->select('users_groups.group_id')->first();
                if($group['group_id'] == 1) {
                    // Login credentials
                    $credentials = array(
                        'email'    => $data['email'],
                        'password' => $data['password'],
                    );

                    $admin = Sentry::findUserByLogin($data['email']);
                    $group = User::join('users_groups', 'users_groups.user_id', '=', 'users.id')->where('users_groups.user_id', $admin['id'])->select('users_groups.group_id')->first();

                    if(isset($data['rememberme'])){
                        Sentry::authenticateAndRemember($credentials);
                    }

                    // Authenticate the user
                    $user = Sentry::authenticate($credentials, false);

                    return Redirect::to('admin/statistic')->with('flash_message', 'Welcome '.ucwords($admin->first_name.' '.$admin->last_name).' to E-Ticket Persib ♥♥♥');
                } else {
                    session()->flash('flash_message_error', 'You Did Not Have Permissions to Logged in');
                    return Redirect::back();
                }
            }
            catch (\Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                session()->flash('flash_message_error', 'Login field is required.');
                return Redirect::back();
            }
            catch (\Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                session()->flash('flash_message_error', 'Password field is required.');
                return Redirect::back();
            }
            catch (\Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                session()->flash('flash_message_error', 'Wrong password, try again.');
                return Redirect::back();
            }
            catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                session()->flash('flash_message_error', 'User was not found.');
                return Redirect::back();
            }
            catch (\Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                session()->flash('flash_message_error', 'User is not activated.');
                return Redirect::back();
            }

            // The following is only required if the throttling is enabled
            catch (\Cartalyst\Sentry\Throttling\UserSuspendedException $e)
            {
                session()->flash('flash_message_error', 'User is suspended.');
                return Redirect::back();
            }
            catch (\Cartalyst\Sentry\Throttling\UserBannedException $e)
            {
                session()->flash('flash_message_error', 'User is banned.');
                return Redirect::back();
            }
    }

    /*
     * Logout function
     */
    public function logout()
    {
        session()->flush();
        Sentry::logout();
        return Redirect::to('/')->with('flash_message_error', 'You successfully logout ♥♥♥');
    }

}
