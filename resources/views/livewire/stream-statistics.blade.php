<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4 shadow text-center text-info bg-dark rounded">Statistics</h1>
        <div class="row shadow rounded bg-light p-3">
            <div class="col-12  shadow border rounded border-info p-2">
                <h2 class="text-center text-dark">Up Time: <b class="text-success">{{ $stream_details['uptime'] }}</b>
                </h2>
            </div>
            <div class="col-md-6 shadow border rounded border-success p-2">
                <h4>Bytes In</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-dark progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $stream_details['bytesIn'] == 0 ? "2":$stream_details['bytesIn'] }}%">
                        <b>{{ $stream_details['bytesIn'] == 0 ? "0":$stream_details['bytesIn'] }}</b></div>
                </div>
                <br>
                <h4>Bytes Out</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $stream_details['bytesOut'] == 0 ? "2":$stream_details['bytesOut'] }}%">
                        <b>{{ $stream_details['bytesOut'] == 0 ? "0":$stream_details['bytesOut'] }}</b></div>
                </div>
                <br>
            </div>
            <div class="col-md-6 shadow border rounded border-success p-2">
                <h4>Bytes-In Rate</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-dark progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $stream_details['bytesInRate']== 0 ? "2":$stream_details['bytesInRate'] }}%">
                        <b>{{ $stream_details['bytesInRate']== 0 ? "0":$stream_details['bytesInRate'] }} }}</b></div>
                </div>
                <br>

                <h4>Bytes-Out Rate</h4>
                <div class="progress shadow">
                    <div class="progress-bar  bg-warning progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuemin="0" aria-valuemax="100" style="width: {{ $stream_details['bytesOutRate']== 0 ? "2":$stream_details['bytesOutRate'] }}%">
                        <b>{{ $stream_details['bytesOutRate']== 0 ? "0":$stream_details['bytesOutRate'] }} }}</b></div>
                </div>
                <br>
            </div>
            <div class="col-12  shadow border rounded border-info p-2">
                <h2 class="text-center text-dark">Total Connections: <b
                        class="text-success">{{ $stream_details['totalConnections'] }}</b> </h2>
            </div>
            <hr>
            <br>
            <h1 class="text-dark border-bottom text-center border-info">Connection Count</h1>
            <div class="col-md-6 border rounded border-info p-2 shadow ">
                <h4>RTMP : <b class="text-success">{{ $stream_details['connectionCount']['RTMP'] }}</b></h4>
                <hr>
                <h4>MPEGDASH : <b class="text-success">{{ $stream_details['connectionCount']['MPEGDASH'] }}</b>
                </h4>
                <hr>
                <h4>CUPERTINO : <b class="text-success">{{ $stream_details['connectionCount']['CUPERTINO'] }}</b>
                </h4>
                <hr>
            </div>
            <div class="col-md-6 border rounded border-info p-2 shadow">
                <h4>SANJOSE : <b class="text-success">{{ $stream_details['connectionCount']['SANJOSE'] }}</b></h4>
                <hr>

                <h4>SMOOTH : <b class="text-success">{{ $stream_details['connectionCount']['SMOOTH'] }}</b></h4>
                <hr>

                <h4>RTP : <b class="text-success">{{ $stream_details['connectionCount']['RTP'] }}</b></h4>
                <hr>
            </div>
        </div>
    </div>
</main>
