{{--
the form to add a new form

@author Md Fahim Uddin <visionq9@gmail.com>
--}}

@extends('template.master')

@section('title', 'Add event')

@section('body')
    <p class="h3 text-center">Edit event</p>

    <form method="post" action="{{ route('update-an-event') }}">
        @csrf
        <div class="form-group">
            <label for="event">Event</label>
            <input type="text"
                   class="form-control"
                   id="event"
                   name="event"
                   placeholder="e.g. Doctor appointment"
                   value="{{ old('event', $event->event) }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control"
                      id="description"
                      name="description">{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="eventDate">Date</label>
            <input type="text"
                   class="date form-control"
                   id="eventDate"
                   name="eventDate"
                   placeholder="mm/dd/yyyy"
                   readonly="readonly"
                   value="{{ old(
                                'eventDate',
                                \App\Http\CustomFunctions\CFDate::dateConvertFormat('Y-m-d', 'm/d/Y', $event->event_date))
                            }}">
        </div>

        <input type="hidden" name="id" value="{{ old('id', $event->id) }}">
        <input type="hidden" name="status" value="{{ old('status', $event->status) }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        $('#eventDate').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection
