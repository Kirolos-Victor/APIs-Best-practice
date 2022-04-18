<?php

namespace App\Actions;

class CheckTimezone
{
    public function execute($request)
    {
        $user=Auth()->user();
        if ($request->has('timezone') && $request->timezone != $user->timezone) {
          $user->update([
                'timezone' => $request->timezone
            ]);
        }
    }

}
