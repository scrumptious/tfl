<style>
    html, body {
        background-color: #fff;
        color: #000;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    h1 {
        width: 20vw;
        margin: 4vh auto;
    }
    .container {
        width: 60vw;
        margin: 4vh auto;
        padding: 0 20px 30px;
    }
    table {
        width: 100%;
    }
    table th {
        width: 30%;
    }
</style>
<h1 class="lead">Travel Widget</h1>

<div class="container">
    <p>Last Updated: {{ $updated }}</p>
    <table>
        <tr>
            <th>Line</th>
            <th>Status</th>
            <th></th>
        </tr>

        @foreach ($lines as $line)
            <tr>
                <td>{{ $line->name }}</td>
                <td>{{ $line->lineStatuses[0]->statusSeverityDescription }}</td>
                <td><a href="/travel/{{ $line->id }}">View More</a></td>
            </tr>
        @endforeach
    </table>
</div>
