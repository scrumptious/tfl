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
        border: 1px solid black;
        padding: 0 20px 30px;
        background-color: lightgray;
    }
    table {
        width: 100%;
    }
    table th {
        width: 30%;
    }
    p.status {
        width: 60%;
        margin: 4vh auto;
    }
    div.container div {
        display: flex;
    }
    div.container div p {
        width: 30%;
    }
    div.container a:last-child {
        display: block;
        text-align: center;
    }

</style>


<h1 class="lead">Travel Widget</h1>

<div class="container">
    <div>
        <p>Last Updated: {{ $updated }}</p>
        <h3>{{ $line->name }}</h3>
    </div>
    <p class="status">
        @if ($line->lineStatuses[0]->statusSeverityDescription === "Good Service")
            There are currently no reported disruptions on the {{ $line->name }} line.
        @else
            {{ $line->lineStatuses[0]->reason }}
        @endif
    </p>
    <p>
        <a href="{{ url()->previous() }}">Go Back</a>
    </p>

            {{-- <tr>
                <td>{{ $line->name }}</td>
                <td>{{ $line->lineStatuses[0]->statusSeverityDescription }}</td>
                <td><a href="/travel/{{ $line->id }}">View More</a></td>
            </tr> --}}
</div>
