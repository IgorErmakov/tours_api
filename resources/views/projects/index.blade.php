<x-layout>
    <div class="justify-center mt-16 px-0 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left  mt-16 bg-gray-500 dark:bg-gray-500 m-10 p-10">
            <div class="flex items-center gap-4" id="projects">
                <label>Select project:</label>
                <ul class="m-10">
                    @foreach ($projects as $project)
                        <li>
                            <a href="{{ route('project.tasks', $project->id) }}">{{ $project->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layout>
