<form class="form-inline search" data-controller="search" data-action="submit->search#submit">
    <div data-controller="dropdown" class="dropdown">
        <az-input-group>
            <slot name="before">
                <az-button theme="secondary" element="a" data-action="click->dropdown#toggle" data-target="dashboard.gutter">Filter</az-button>
                <div class="dropdown-menu" data-target="dropdown.menu">
                    @foreach($resources as $item)
                        <az-dropdown-item data-action="click->search#handleFilterClick">
                            <div class="form-check justify-content-start">
                                <input type="checkbox" name="filter[]" class="form-check-input no-pointer-events" value="{{ $item->getSlug() }}">
                                <label class="form-check-label pl-2">
                                    {{ $item->getCollectionLabel() }}
                                </label>
                            </div>
                        </az-dropdown-item>
                    @endforeach
                </div>
            </slot>
            <input type="text" class="form-control" type="search" placeholder="Search" name="q" />
            <slot name="after">
                <az-button theme="primary" type="submit">Search</az-button>
            </slot>
        </az-input-group>
        <div class="dropdown-backdrop" data-target="dropdown.backdrop" data-action="click->dropdown#close"></div>
    </div>
</form>
