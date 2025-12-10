@extends('layouts.app')

@section('content')
<h1>Task Done per Month</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Year</th>
            <th>Month</th>
            <th>Total Done</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stats as $stat)
        <tr>
            <td>{{ $stat->year }}</td>
            <td>{{ \Carbon\Carbon::create()->month($stat->month)->format('F') }}</td>
            <td>{{ $stat->total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
