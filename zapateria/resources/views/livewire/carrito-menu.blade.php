<div class="flex justify-center items-center mt-10">
    <a href="{{ route('carritos.ver') }}"
       class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">
        @if(auth()->check())
            🛒 Ver carrito ({{ $cantidadTotal }})
        @else
            🚫 Sin carrito
        @endif
    </a>
</div>
