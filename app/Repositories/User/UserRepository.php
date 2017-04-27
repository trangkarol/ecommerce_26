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
use DB;

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
        try {
            $authUser = $this->model->where('provider_id', $user->id)->first();
            if ($authUser) {
                return $authUser;
            }

            return parent::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id,
                'avatar' => config('setting.images.avatar'),
                'role' => config('setting.role.user'),
            ]);
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
            $input['avatar'] = isset($request->file) ? parent::uploadImages(null, $request->file, null) : config('setting.images.avatar');
            $input['role'] = $role;
            $result = $this->model->create($input);
            DB::commit();

            return $result;
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
    public function updateProfile($request, $id, $role)
    {
        DB::beginTransaction();
        try {
            $user = $this->model->find($id);
            $input = $request->only(['name', 'email', 'address', 'phone_number']);
            $input['avatar'] = isset($request->file) ? parent::uploadImages($user->avatar, $request->file, config('setting.images.avatar')) : $user->avatar;
            $input['password'] = isset($request->password) ? $request->password : $user->password;
            DB::commit();

            return parent::update($input, $id);
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

                $result = $user->save();
                if ($result) {
                    Mail::to($user->email)->queue(new ForgotPassword($data));
                    DB::commit();

                    return true;
                }

            }

            return false;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
    * function getUsers.
     *
     * @return imageName
     */
    public function getUsers()
    {
        return $this->model->orderBy('created_at', 'desc')->paginate(config('setting.admin.paginate'));
    }

    /**
    * function delete.
     *
     * @return imageName
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $result = $this->model->find($id)->with('order', 'products', 'suggestProducts')->detach();
            dd($result);
            // $this->model->find($id)->with('products')->delete();
            // $this->model->find($id)->with('suggestProducts')->delete();
            // $result = $this->model->find($id)->delete();
            DB::commit();

            return false;
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();

            return false;
        }
    }

    /**
    * function delete.
     *
     * @return imageName
     */
    public function searchUser($input)
    {
        try {
            $users = $this->model;

            if (!is_null($input['name'])) {
                $users = $users->where('name', 'LIKE', '%' . $input['name'] . '%');
            }

            if (!is_null($input['email'])) {
                $users = $users->where('email', 'LIKE', '%' . $input['email'] . '%');
            }

            if ($input['role'] != config('setting.search_default')) {
                $users = $users->where('role', $input['role']);
            }

            // if ($input['active_members'] != config('setting.search_default')) {
            //     $users = $users->where('role', $input['role']);
            // }

            return $users->orderBy('created_at', 'desc')->paginate(config('setting.admin.paginate'));
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
