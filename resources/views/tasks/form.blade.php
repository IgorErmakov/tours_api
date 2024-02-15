<x-layout>
    <div class="container">
        <h1>Create Task</h1>
        <form method="POST" action="{{ route('tasks.save') }}">
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
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" maxlength="255" required value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-name" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="number" class="form-control {{ $errors->has('priority') ? 'is-invalid' : '' }}" id="priority" name="priority" required value="{{ old('priority') }}">
                @if ($errors->has('priority'))
                    <span class="invalid-name" role="alert">
                    <strong>{{ $errors->first('priority') }}</strong>
                </span>
                @endif
            </div>

            <input type="hidden" name="project_id" value="{{ $projectId }}"/>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</x-layout>
