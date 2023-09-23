<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit Data</h2>
            </div>
            <div>
                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back</a>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>Work Type</strong>
                            <select name="work_type" id="work_type" class="form-control" >
                                <option value="Development">Development</option>
                                <option value="Test">Test</option>
                                <option value="Document">Document</option>
                            @error('work_type')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>Work Name</strong>
                            <input type="text" name="work_name" value="{{ $task->work_name }}" class="form-control" >
                            @error('work_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>Start Time</strong>
                            <input type="time" name="start_time" value="{{ $task->start_time }}" class="form-control" >
                            @error('start_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>Finish Time</strong>
                            <input type="time" name="end_time" value="{{ $task->end_time }}" class="form-control" >
                            @error('end_time')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <strong>Work Type</strong>
                            <select name="status" id="status" class="form-control">
                                <option value="Pending">Pending</option>
                                <option value="Finished">Finished</option>
                                <option value="Canceled">Canceled</option>
                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            </select>
                        </div>
                    </div>
                    <div class="col-mt-12">
                        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>