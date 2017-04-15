<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserInterface;
use App\Mail\ForgotPassword;
use Auth;
use DateTime;
use Mail;

class UserRepository extends BaseRepository implements UserInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
    * function login.
     *
     * @return $result
     */
    public function login($request)
    {
        try {
            $user = $request->only('email', 'password');

            if (Auth::attempt($user)) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function logout.
     *
     * @return $result
     */
    public function logout($request)
    {
        try {
            Auth::guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return true;
        } catch (\Exception $e) {
            return true;
        }
    }

    /**
    * function change password.
     *
     * @return $result
     */
    public function changePassword($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->find(Auth::user()->id);
            $user->password = $request->password;
            $user->save();
            Auth::logout();
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function createSocialite($user, $provider)
     *
     * @return $result
     */
    public function createSocialite($user, $provider)
    {
        DB::beginTransaction();
        try {
            $authUser = $this->model->where('provider_id', $user->id)->first();

            if ($authUser) {
                return $authUser;
            }

            $result = parent::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'avatar' => config('setting.images.avatar'),
                'role' => config('setting.role.user'),
            ]);

            if ($request) {
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
    * function register
     *
     * @return $result
     */
    public function register($request, $role)
    {
        DB::beginTransaction();
        try {
            $input = $request->only(['name', 'email', 'password', 'address', 'phone_number']);
            $input['avatar'] = isset($request->file) ? parent::uploadAvatar(null, $request->file, null) : config('setting.images.avatar');
            $input['birthday'] = $request->birthday;
            $input['role'] = $role;
            $result = parent::create($input);

            if ($request) {
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function update
     *
     * @return $result
     */
    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->find($id);
            $input = $request->only(['name', 'email', 'address', 'phone_number']);
            $input['avatar'] = isset($request->file) ? parent::uploadAvatar($user->avatar, $request->file, config('setting.images.avatar')) : $user->avatar;
            $input['birthday'] = $request->birthday;
            $input['password'] = isset($request->password) ? $request->password : $user->password;
            $result = parent::update($input, $id);

            if ($request) {
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
    * function uploadImages.
     *
     * @return imageName
     */
    public function forgotPassword($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->where('email', $request->email)->first();
            if ($user) {
                $password = str_random(config('setting.numer_pass'));
                $user->password = $password;
                $data = [
                    'name' => $user->name,
                    'password' => $password,
                ];
                $this->model->save();
                Mail::to($user->email)->queue(new ForgotPassword($data));
                DB::commit();

                return true;
            }

            return false;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
