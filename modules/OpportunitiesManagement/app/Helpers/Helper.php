<?php

namespace Modules\OpportunitiesManagement\app\Helpers;

class Helper
{
    public static function replaceEnum($args, $request = null)
    {
        if (!$request) {
            foreach ($args as $key => $enums) {
                if (request()->has($key)) {
                    if (is_array(request($key))) {
                        $temp = [];
                        foreach (request($key) as $item) {
                            if (isset($enums[$item])) $temp[] = $enums[$item];
                        }
                        request()->merge([$key => $temp]);
                    } elseif (isset($enums[request($key)])) {
                        request()->merge([$key => $enums[request($key)]]);
                    }
                }
            }
            return request();
        } else {
            foreach ($args as $key => $enums) {
                if (isset($request[$key])) {
                    if (is_array($request[$key])) {
                        $temp = [];
                        foreach ($request[$key] as $item) {
                            if (isset($enums[$item])) $temp[] = $enums[$item];
                        }
                        $request[$key] = $temp;
                    } elseif (isset($enums[$request[$key]])) {
                        $request[$key] = $enums[request($key)];
                    }
                }
            }
            return $request;
        }

    }

}
