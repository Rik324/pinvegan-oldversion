@props(['action', 'method' => 'POST', 'enctype' => false])

<form action="{{ $action }}" method="{{ strtolower($method) === 'get' ? 'get' : 'post' }}" 
    @if($enctype) enctype="{{ $enctype }}" @endif
    class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    @csrf
    
    @if(strtolower($method) !== 'get' && strtolower($method) !== 'post')
        @method(strtoupper($method))
    @endif
    
    <div class="space-y-6">
        {{ $slot }}
    </div>
    
    <div class="mt-8 flex justify-end space-x-3">
        {{ $actions ?? '' }}
    </div>
</form>
