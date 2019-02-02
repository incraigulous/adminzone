@foreach($elements as $element)
    @include('adminzone::elements.element', compact('element'))
@endforeach
