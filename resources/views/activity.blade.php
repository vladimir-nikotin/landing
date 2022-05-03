<h1>Activity</h1>

@if (count($activities) > 0)
    <table>
        <thead>
            <th>URL</th>
            <th>Количество визитов</th>
            <th>Последнее посещение</th>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>
                        <div>{{ $activity['url'] }}</div>
                    </td>
                    <td>
                        <div>{{ $activity['visit_count'] }}</div>
                    </td>
                    <td>
                        <div>{{ $activity['last_visited'] }}</div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $activities->links() }}
@endif