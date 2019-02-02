<az-form :method="$method" :action="$action" enctype="multipart/form-data">
    @include('adminzone::elements.sections.section',
        [
            'section' => $form->getMain()
        ]
    )
    
    <az-card class="my-3 text-right" theme-color="white">
        <az-card-body>
            <az-button type="submit" size="lg">Save {{ $resource->getLabel() }}</az-button>
        </az-card-body>
    </az-card>
</az-form>


