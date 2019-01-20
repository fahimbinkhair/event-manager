<?php
/**
 * controls all activities related to the event e.g. add event, view events, etc
 *
 * @author Md Fahim Uddin <visionq9@gmail.com>
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Event;
use App\Http\Constants;
use App\Http\CustomFunctions\CFDate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    /**
     * display the form to add a new event
     *
     * @return View
     */
    public function displayAddEventForm(): View
    {
        return view('events.frmAddEvent');
    }

    /**
     * save a new event submitted via add-event form
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function addNewEvent(Request $request): RedirectResponse
    {
        $request->validate([
            'event' => 'required|max:256',
            'eventDate' => 'sometimes|nullable|date|date_format:m/d/Y',
        ]);

        $event = new Event([
            'event' => $request->get('event'),
            'description' => $request->get('description'),
            'event_date' => CFDate::dateConvertFormat('m/d/Y', 'Y-m-d', $request->get('eventDate')),
            'status' => Constants::STATUS_ACTIVE,
        ]);

        $event->save();

        return redirect(route('display-form-to-add-event'))->with('success', 'Event has been added successfully');
    }

    /**
     * display the form to add a new event
     *
     * @param int $id
     *
     * @return View
     */
    public function displayEditEventForm(int $id): View
    {
        $event = Event::findOrFail($id);

        return view('events.frmEditEvent', compact('event'));
    }

    /**
     * update an existing via update-event form
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function updateEvent(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'event' => 'required|max:256',
            'eventDate' => 'sometimes|nullable|date|date_format:m/d/Y',
        ]);

        $event = Event::findOrFail($request->get('id'));
        $event->event = $request->get('event');
        $event->description = $request->get('description');
        $event->event_date = CFDate::dateConvertFormat('m/d/Y', 'Y-m-d', $request->get('eventDate'));
        $event->save();

        return redirect(route('view-events', ['status' => $request->get('status')]))
            ->with('success', 'Event has been added successfully');
    }

    /**
     * @param string $status expected one of [Constants::STATUS_*]
     *
     * @return View
     */
    public function viewEvents(string $status): View
    {
        $events = Event::where('status', $status)->get();
        return view('events.viewEvents', compact('events'));
    }

    /**
     * update db.event.status = $status
     *
     * @param int $id
     * @param string $status
     *
     * @return RedirectResponse
     */
    public function changeEventStatus(int $id, string $status): RedirectResponse
    {
        $event = Event::findOrFail($id);
        $event->status = $status;
        $event->save();

        return redirect(route('view-events', ['status' => Constants::STATUS_ACTIVE]))
            ->with('success', "Event has been {$status} successfully");
    }
}