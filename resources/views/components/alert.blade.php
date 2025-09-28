@if(session('success'))
    <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-green-100 rounded-md p-1.5 text-green-500 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-100 focus:ring-green-600" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-red-100 rounded-md p-1.5 text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-100 focus:ring-red-600" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-400"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-red-800">There were some errors with your submission</h4>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" class="inline-flex bg-red-100 rounded-md p-1.5 text-red-500 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-100 focus:ring-red-600" onclick="this.parentElement.parentElement.parentElement.parentElement.remove()">
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif