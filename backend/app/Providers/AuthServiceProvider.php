<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public static function checkAuth($token)
    {
        $response = Http::retry(3, 100)
            ->withHeaders([
                "Authorization" => $token,
            ])
            ->get(config("auth.check_auth_url"));

        return json_decode($response->body(), true);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest("url", function (Request $request) {
            $token = $request->header("Authorization");

            if (!$token) {
                return null;
            }

            try {
                $response = self::checkAuth($token);

                $data = $response["data"];
                $id = $data["id"];

                $user = User::find($id);

                if (!isset($user)) {
                    $user = User::forceCreate(["id" => $id, "info" => $data]);
                    $user = User::find($id);
                } else {
                    $user->forceFill(["info" => $data]);
                }

                return $user;
            } catch (\Exception $e) {
                return null;
            }
        });
    }
}
