<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validator = Validator::make($request->all(),[
            'lang' => ['required','string','exists:languages,lang']
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),400);
        }
        App::setLocale($request->lang);
        return $next($request);
    }
}
