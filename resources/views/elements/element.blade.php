@if($element->getType() === 'field')
    @include($element->getView(), ['field' => $element])
@elseif($element->getType() === 'section')
    @include($element->getView(), ['section' => $element])
@endif

