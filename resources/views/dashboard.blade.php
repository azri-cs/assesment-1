<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @session('error')
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium">{{__('Error')}}!</span> {{ session('error') }}
            </div>
            @endsession
            @session('success')
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{__('Success')}}!</span> {{ session('success') }}
            </div>
            @endsession

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div>
                            <label class="block mb-2 text-md font-medium text-gray-900 dark:text-white" for="file_input">{{__('Upload Excel File')}}</label>
                            <input class="block w-full text-md text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                   aria-describedby="file_input_help" name="excel_file" id="excel_file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{__('XLSX only')}}</p>
                        </div>


                        <div class="flex items-center justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{__('Upload')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
