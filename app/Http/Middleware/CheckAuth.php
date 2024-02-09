<?php

namespace App\Http\Middleware;

use App\Models\Firebase\FirebaseDb;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;

class CheckAuth
{

    protected $auth, $database;

    public function __construct()
    {
        $this->auth = (new FirebaseDb)->getAuth();
        $this->database = (new FirebaseDb)->getDatabase();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$Roles)
    {
        if (isset($request->session()->all()['firebaseUserId']) && isset($request->session()->all()['idToken'])) {
            $dataRef = $this->database->getReference('tbl_user/' . $request->session()->all()['firebaseUserId'])->getSnapshot();
            if ($dataRef->exists() && in_array($dataRef->getValue()['tipe_user'], $Roles)) {
                return $next($request);
            }
        }
        return redirect()->route('landing./');
    }
}
