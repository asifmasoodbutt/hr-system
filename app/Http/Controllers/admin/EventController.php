<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\AddEventRequest;
use App\Http\Requests\Events\InactiveEventRequest;
use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function events()
    {
        return view("main.events");
    }

    public function getNewEvent()
    {
        return view("main.add-new-event");
    }

    public function getEventTypes(Request $request)
    {
        try {
            $event_types = EventType::get(['id', 'name']);
            $message = 'No event types found!';
            if ($event_types->isNotEmpty()) {
                $message = 'Event types fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($event_types, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, false);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'getEventTypes', $request->api_request_id);
        }
    }

    public function getUsers(Request $request)
    {
        try {
            $users = User::get(['id', 'first_name', 'last_name']);
            $message = 'No users found!';
            if ($users->isNotEmpty()) {
                $message = 'Users fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($users, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, false);
            return response()->success([], $message);
        } catch (\Exception $e) {
            return throwException($e, 'getUsers', $request->api_request_id);
        } 
    }

    public function getEvents(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 10); // Default: 10 items per page
            $page = $request->input('page', 1); // Default: Page 1

            $events = Event::with(['eventType:id,name', 'manager:id,first_name,last_name'])
                ->orderByRaw("FIELD(is_active, '1') DESC")
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
    public function inactiveEvent(InactiveEventRequest $request)
    {
        try {
            \DB::beginTransaction();
            $query = Event::where('id', $request->event_id);
            $event = $query->first();
            $query->update(['is_active' => false]);

            $message = $event->title . ' event has been inactivated!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            \DB::commit();

            return response()->success([], $message);

        } catch (\Exception $e) {
            \DB::rollBack();
            return throwException($e, 'inactiveEvent', $request->api_request_id);
        }
    }

    public function deleteEvent(InactiveEventRequest $request)
    {
        try {
            \DB::beginTransaction();
            $query = Event::where('id', $request->event_id);
            $event = $query->first();
            $query->delete();

            $message = $event->title . ' event has been deleted!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            \DB::commit();

            return response()->success([], $message);

        } catch (\Exception $e) {
            \DB::rollBack();
            return throwException($e, 'deleteEvent', $request->api_request_id);
        }
    }
}