import { Controller } from "stimulus"
import Overlay from '../Overlay'

export default class extends Controller {
    overlay

    initialize() {
        this.overlay = new Overlay()
        this.overlay.onClose(this.handleClose.bind(this))
    }

    openNew() {
        this.overlay.load({
            path: route('adminzone::resource.create', {'slug': this.data.get('slug')}),
            direction: 'top'
        })
    }

    openExisting() {
        this.overlay.load({
            path: route('adminzone::resource.select', {'slug': this.data.get('slug')}),
            direction: 'top'
        })
    }

    handleClose(result) {
    }
}
