@php
    $previousEnd = null;
@endphp

<table id="tblexchangelist" class="table table-bordered table-striped table-hover tblexchangelist">
    <thead style="text-align:center;">
        <tr>
            <th>NO</th>
            <th>ID</th>
            <th>User</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Page Duration</th>
            <th>RankTime</th>
            <th>URL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $pt)
            @php
                $rankTime = '';
                $longTime = '';

                $start = \Carbon\Carbon::parse($pt->started_at);

                // calculate RankTime (gap with previous row)
                if ($previousEnd) {
                    $rankTime = $start->diff(\Carbon\Carbon::parse($previousEnd))
                                      ->format('%H:%I:%S');
                }

                // calculate LongTime (only if ended_at not null)
                if ($pt->ended_at) {
                    $longTime = \Carbon\Carbon::parse($pt->ended_at)
                                ->diff($start)
                                ->format('%H:%I:%S');
                    $previousEnd = $pt->ended_at; // update only if we have end time
                } else {
                    $longTime = '-';   // show dash if no end
                    $previousEnd = null; // don’t use this for next row
                }
            @endphp

            <tr>
                <td style="text-align:center;" class="kh14-b">{{ ++$key }}</td>
                <td class="kh14-b" style="text-align:center;">{{ $pt->id }}</td>
                <td class="kh14-b" style="text-align:center;">{{ $pt->user->name }}</td>
                <td class="kh14-b" style="text-align:center;">{{ date('d-m-Y',strtotime($pt->started_at)) }}</td>
                <td class="kh14-b" style="text-align:center;">
                    {{ $pt->ended_at ? date('d-m-Y',strtotime($pt->ended_at)) : '-' }}
                </td>
                <td class="kh14-b" style="text-align:center;">{{ date('H:i:s',strtotime($pt->started_at)) }}</td>
                <td class="kh14-b" style="text-align:center;">
                    {{ $pt->ended_at ? date('H:i:s',strtotime($pt->ended_at)) : '-' }}
                </td>
                <td class="kh14-b" style="text-align:center;">{{ $longTime }}</td>
                <td class="kh14-b" style="text-align:center;color:red;">{{ $rankTime }}</td>
                <td class="kh14-b" style="text-align:center;">{{ $pt->url }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
