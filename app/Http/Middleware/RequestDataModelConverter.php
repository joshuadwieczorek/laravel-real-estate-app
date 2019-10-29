<?php

namespace App\Http\Middleware;
use Closure;
use App\Contracts\DataModelContract;

class RequestDataModelConverter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	if($request != null
	       && $request->route() != null
	       && $request->route()->action != null
	       && is_array($request->route()->action)
	       && isset($request->route()->action['data.model']))
	    {
	    	$dataModelClassNameString = $request->route()->action['data.model'];
	    	$classPath = "App\Models\\$dataModelClassNameString";
	    	if(class_exists($classPath))
		    {
		    	$dataModelObject = new $classPath();
		    	if($dataModelObject instanceof DataModelContract)
			    {
			    	$dataModel = $dataModelObject->FromRequest($request);
			    	request()->request->add(['data.model'=>$dataModel]);
			    }
		    }
	    }

        return $next($request);
    }
}