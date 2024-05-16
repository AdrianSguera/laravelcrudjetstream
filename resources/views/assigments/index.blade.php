<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assigments List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">

                    <div class="mb-4">
                        <a href="{{ route('assigments.create') }}" class="bg-cyan-500 dark:bg-cyan-700 hover:bg-cyan-600 dark:hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded">Create Assigment</a>
                    </div>

                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">ID</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Name</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Subjects</th>
                                <th class="px-4 py-2 text-gray-900 dark:text-white text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assigments as $assigment)
                            <tr>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $assigment->id }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">{{ $assigment->name }}</td>
                                <td class="border px-4 py-2 text-gray-900 dark:text-white text-center">
                                    <button type="button" class="bg-blue-500 dark:bg-blue-700 hover:bg-blue-600 dark:hover:bg-blue-800 text-white font-bold py-2 px-4 rounded" onclick="toggleSubjects('{{ $assigment->id }}')">Show Subjects</button>
                                    <ul id="subjects-{{ $assigment->id }}" class="hidden mt-2">
                                        @foreach($assigment->subjects as $subject)
                                            <li class="text-gray-900 dark:text-white">{{ $subject->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center">
                                        <a href="{{ route('assigments.edit', $assigment->id) }}" class="bg-violet-500 dark:bg-violet-700 hover:bg-violet-600 dark:hover:bg-violet-800 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                        <button type="button" class="bg-pink-400 dark:bg-pink-600 hover:bg-pink-500 dark:hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" onclick="confirmDelete('{{ $assigment->id }}')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleSubjects(id) {
        let subjectsList = document.getElementById('subjects-' + id);
        if (subjectsList.classList.contains('hidden')) {
            subjectsList.classList.remove('hidden');
        } else {
            subjectsList.classList.add('hidden');
        }
    }

    function confirmDelete(id) {
        alertify.confirm("¿Confirm delete record?",
        function(){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/assigments/' + id;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
            alertify.success('Ok');
        },
        function(){
            alertify.error('Cancel');
        });
    }
</script>
