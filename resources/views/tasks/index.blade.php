<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-12">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Example</h2>
                <hr>
            </div>
           
                <div class="row pb-3">
                    <div class="col-md-1 pt-4">
                        <a href="{{ route('tasks.index') }}" class="btn btn-success">Index</a>
                    </div>

                    <div class="col-md-5 pt-4">
                        <a href="{{ route('tasks.create') }}" class="btn btn-success">Create</a>
                    </div>
                    {{-- <div class="col-md-6"> --}}
                        {{-- date --}}
                        <form method="GET" action="/filter" class="col-md-3">
                            <div class="form-group">
                                <label>Search By Date</label>   
                                <input type="date" name="select_date" class="">
                                <button type="submit" value="date" class="btn btn-primary">date</button>
                            </div>
                        </form>
                        
                        {{-- month --}}
                        <form method="GET" action="/filter_month" class="col-md-3">    
                            <div class="form-group">
                                <label>Search By Month</label>
                                <input type="month" name="select_month" class="">
                                <button type="submit" value="month" class="btn btn-primary">month</button>
                            </div>    
                        </form>
                    {{-- </div> --}}
                    @if ($message = Session::get('success'));
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                </div>
            
           <table class="table table-bordered">
                <tr>
                    <th>Work Type</th>
                    <th>Work Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Created Time</th>
                    <th>Update Time</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach($task as $tasks) <!-- data as folder -->
                <tr>
                    <td>{{ $tasks->work_type }}</td>
                    <td>{{ $tasks->work_name }}</td>
                    <td>{{ $tasks->start_time }}</td>
                    <td>{{ $tasks->end_time }}</td>
                    <td>{{ $tasks->status }}</td>
                    <td>{{ $tasks->created_at }}</td>
                    <td>{{ $tasks->updated_at }}</td>
                    <td>
                        {{-- delete button --}}
                        <form action="{{ route('tasks.destroy', $tasks->id) }}" method="POST"> 
                            <a href="{{ route('tasks.edit', $tasks->id) }}"class="btn btn-warning" style="font-size:18px"><span class="glyphicon glyphicon-edit"></span></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="font-size:18px"><i class="fa fa-trash-o"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>   
            {!!$task->links('pagination::bootstrap-5')!!} 
        {{-- <div>
            @php
            $PendingStatus = 0;
            $FinishedStatus = 0;
            $CanceledStatus = 0;
            @endphp 
            @foreach($task as $tasks)
                @php
                
                    if($tasks->status=='Pending'){
                        
                        $PendingStatus++;

                    }else if($tasks->status=='Finished') {

                        $FinishedStatus++;
                    
                    }else if($tasks->status=='Canceled'){

                        $CanceledStatus++;
                    }
                @endphp

            @endforeach

            <div>
                <p>Pending Status: {{ $PendingStatus }}</p>
                <p>Finished Status: {{ $FinishedStatus }}</p>
                <p>Canceled Status: {{ $CanceledStatus }}</p>
            </div>
        </div> --}}
        @if (isset($statusSummary) && !empty($statusSummary))
            <h4>Status Summary for {{ date('F Y', strtotime($select_month)) }}</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Status</th>
                    <th>Status Count</th>
                </tr>
                @foreach ($statusSummary as $status => $count)
                    <tr>
                        <td>{{ $status }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No data found for the selected month.</p>
        @endif
        </div>
    </div>
</body>
</html>