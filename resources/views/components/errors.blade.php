@if ($errors->any())
    <div class="rounded-md bg-red-100 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-linky::icons.x-circle class="h-5 w-5 text-red-400"/>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    {{__('There were :errorCount errors with your submission', ['errorCount' => count($errors->all())])}}
                </h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul role="list" class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
