<az-form class="form-inline">
    <div data-controller="dropdown">
        <az-input-group>
            <slot name="before">
                <az-button theme="secondary" element="button" data-action="click->dropdown#toggle">Filter</az-button>
                <az-button theme="secondary" element="button" class="dropdown-toggle dropdown-toggle-split" data-action="click->dropdown#toggle"></az-button>
                <div class="dropdown-menu" data-target="dropdown.menu">
                    @foreach($resources as $item)
                        <az-dropdown-item>{{ $item->label }}</az-dropdown-item>
                    @endforeach
                </div>
            </slot>
            <input type="text" class="form-control" type="search" placeholder="Search" name="search" />
            <slot name="after">
                <az-button theme="primary" type="submit" element="button">Search</az-button>
            </slot>
        </az-input-group>
    </div>
</az-form>
