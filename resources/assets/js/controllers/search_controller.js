import { Controller } from "stimulus"
import Overlay from '../Overlay'
import {nextTick} from '../helpers'

export default class extends Controller {
    connect() {
        nextTick(() => {
            this.overlay = new Overlay()
        })
    }

    submit(e) {
        e.preventDefault()
        const params = new URLSearchParams(new FormData(this.element))
        this.overlay.load({
            path: route('adminzone::search') + '?' + params.toString(),
            direction: 'top'
        })
    }

    handleFilterClick(e) {
        e.preventDefault()
        let checkbox = e.currentTarget.querySelector('input[type=checkbox]')
        checkbox.checked = !checkbox.checked
    }

    disconnect() {
        this.tab.close()
    }
}
