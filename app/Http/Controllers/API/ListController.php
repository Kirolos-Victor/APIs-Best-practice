<?php

namespace App\Http\Controllers\API;

use App\Actions\CheckTimezone;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditListRequest;
use App\Http\Requests\FilterListRequest;
use App\Http\Requests\IndexListRequest;
use App\Http\Requests\StoreListRequest;
use App\Models\UserList;
use Carbon\Carbon;

class ListController extends Controller
{

    public function index(IndexListRequest $request, CheckTimezone $checkTimezone)
    {
        $checkTimezone->execute($request);
        $data = UserList::paginate(10);
        return responseJson(200, 'success', $data);
    }


    public function store(StoreListRequest $request)
    {
        $request->merge(['user_id' => Auth()->id()]);
        $data = UserList::create($request->all());

        return responseJson(200, 'success', $data);
    }

    public function update(EditListRequest $request, UserList $list)
    {
        $user = Auth()->user();

        $list->update([
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => Carbon::now()->timezone($user->timezone)->toDateTimeString()
        ]);
        return responseJson(200, 'updated successfully', $list);
    }


    public function destroy(UserList $list)
    {
        try {
            $list->delete();
        } catch (\Exception $e) {
            return responseJson(404, 'error: ' . $e);
        }
        return responseJson(200, 'deleted successfully');
    }

    public function filterLists(FilterListRequest $request)
    {
        $user = Auth()->user();

        $data = UserList::where('title', '=', $request->title)
            ->whereDate('created_at', '=', Carbon::today()->timezone($user->timezone))
            ->first();
        if ($data == null) {
            return responseJson(404, 'Not found');
        }

        return responseJson(200, 'success', $data);
    }
}
