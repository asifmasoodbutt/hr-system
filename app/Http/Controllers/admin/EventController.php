<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\AddEventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events()
    {
        return view("main.events");
    }

    public function getEvents(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 10); // Default: 10 items per page
            $page = $request->input('page', 1); // Default: Page 1

            $events = Event::with(['eventType:id,name', 'manager:id,first_name,last_name'])
                ->orderByRaw("FIELD(is_active, 'true') DESC")
                ->orderBy("created_at", "desc")
                ->paginate($perPage, ['*'], 'page', $page);

            $message = 'No events found!';
            if ($events->isNotEmpty()) {
                $message = 'Events fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($events, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);

        } catch (\Exception $e) {
            return throwException($e, 'getEvents', $request->api_request_id);
        }
    }

    public function addEvent(AddEventRequest $request)
    {
        try {
            $event = Event::create([
                'title' => $request->title,
                'event_type_id' => $request->event_type_id,
                'from_date' => $request->from_date,
                'to_date' => $request->to_date,
                'manager_id' => $request->manager_id
            ]);

            $message = 'New event added successfully!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success($event, $message);

        } catch (\Exception $e) {
            return throwException($e, 'addEvent', $request->api_request_id);
        }
    }
}