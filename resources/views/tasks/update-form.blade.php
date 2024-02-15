<x-layout>
    <div class="container">
        <h1>Update Task</h1>
        <form method="POST" action="{{ route('tasks.update') }}">
            @method('PUT')
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Task Name:</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" maxlength="255" required value="{{ $task->name }}">
                @if ($errors->has('name'))
                    <span class="invalid-name" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" id="priority" name="priority" required value="{{ $task->priority }}">
                @if ($errors->has('priority'))
                    <span class="invalid-name" role="alert">
                    <strong>{{ $errors->first('priority') }}</strong>
                </span>
                @endif
            </div>

            <input type="hidden" name="id" value="{{ $task->id }}"/>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
</x-layout>
