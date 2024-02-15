<x-layout>

    <div class="justify-center mt-16 px-0 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left  mt-16 bg-gray-500 dark:bg-gray-500 m-10 p-10">
            <div class="items-center gap-4" id="tasks">
                <label>
                    Tasks:
                    <a href="{{ route('task.form', $projectId) }}">➕Add</a>
                </label>
                <ul id="tasks-list">
                    @foreach ($tasks as $task)
                        <li data-id="{{ $task->id }}">
                            <a href="{{ route('tasks.form', $task->id) }}">{{ $task->name }}</a>
                            <a href="{{ route('tasks.delete', $task->id) }}" onclick="return confirm('Are you sure?')" title="Delete">X</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const el = document.getElementById('tasks-list');
            const sortable = Sortable.create(el, {
                onSort: function (e) {
                    let ids = []
                    el.querySelectorAll('li').forEach(li => {
                        ids.push(li.dataset.id)
                    })

                    fetch('/tasks/sort', {
                        method: 'POST',
                        body: JSON.stringify({ids}),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')

                        }
                    })
                },
            });
        });
    </script>
</x-layout>
