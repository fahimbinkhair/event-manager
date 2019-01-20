{{--
the form to add a new form

@author Md Fahim Uddin <visionq9@gmail.com>
--}}

@extends('template.master')

@section('title', 'Add event')

@section('body')
    <p class="h3 text-center">All {{ \App\Http\CustomFunctions\CFArray::getArrayValue(
                                        \App\Http\CustomFunctions\CFObject::objectToArray($events),
                                        '0->status'
                                    ) }} events</p>

    <table class="table table-striped">
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>
                    <p class="font-weight-bold">{{$event->event}}</p>

                    @if(!empty($event->description))
                        {{$event->description}}<br>
                    @endif

                    @if(!empty($event->event_date))
                        Date: {{$event->event_date}}<br>
                    @endif

                    <a href="{{ route(
                                'display-form-to-edit-event',
                                ['id' => $event->id])
                            }}"
                       class="badge badge-primary">Edit</a>

                    <a href="{{ route(
                                'change-event-status',
                                ['id' => $event->id, 'status' => \App\Http\Constants::STATUS_ARCHIVED])
                            }}"
                       class="badge badge-primary">Mark as done</a>
                    &nbsp;
                    <a href="{{ route(
                                'change-event-status',
                                ['id' => $event->id, 'status' => \App\Http\Constants::STATUS_DELETED])
                            }}"
                       class="badge badge-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
