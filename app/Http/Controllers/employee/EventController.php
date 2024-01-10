<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\ParticipateEventRequest;
use App\Models\Event;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function events()
    {
        return view("employee.events");
    }

    public function participatedEvents()
    {
        return view("employee.participated-events");
    }

    public function getEvents(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 10); // Default: 10 items per page
            $page = $request->input('page', 1); // Default: Page 1

            $events = Event::with(['eventType:id,name', 'manager:id,first_name,last_name'])
                ->where('is_active', 1)
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

    public function participateEvent(ParticipateEventRequest $request)
    {
        try {
            $participant_id = \Auth::id();
            $event = Event::where('id', $request->event_id)->first();

            if ($event->is_active == 1) {
                $eventParticipantCount = \DB::table('event_participant')
                    ->where('event_id', $request->event_id)
                    ->where('participant_id', $participant_id)
                    ->count();

                if ($eventParticipantCount > 0) {
                    $message = 'Already participated in this event!';
                    storeApiResponseData($request->api_request_id, ['message' => $message], 403, true);
                    return response()->error($message, 403);
                } else {
                    \DB::table('event_participant')->insert([
                        'event_id' => $request->event_id,
                        'participant_id' => $participant_id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);

                    $message = 'Participated in this event successfully!';
                    storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                    return response()->success([], $message);
                }
            }
            $message = 'This event is not active anymore!';
            storeApiResponseData($request->api_request_id, ['message' => $message], 403, true);
            return response()->error($message, 419);

        } catch (\Exception $e) {
            return throwException($e, 'participateEvent', $request->api_request_id);
        }
    }

    public function getParticipatedEvents(Request $request)
    {
        try {
            $perPage = $request->input('perPage', 10); // Default: 10 items per page
            $page = $request->input('page', 1); // Default: Page 1

            $events = DB::table('event_participant')
                ->where('participant_id', Auth::id())
                ->leftJoin('events', 'events.id', '=', 'event_participant.event_id')
                ->where('events.is_active', 1)
                ->orderBy("events.created_at", "desc")
                ->paginate($perPage, ['*'], 'page', $page);

            $message = 'No events found!';
            if ($events->isNotEmpty()) {
                $message = 'Your participated events fetched successfully!';
                storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
                return response()->success($events, $message);
            }
            storeApiResponseData($request->api_request_id, ['message' => $message], 200, true);
            return response()->success([], $message);

        } catch (\Exception $e) {
            return throwException($e, 'getParticipatedEvents', $request->api_request_id);
        }
    }
}