import { Controller } from "stimulus"
import Tab from '../Tab'
export default class extends Controller {
    connect() {
        Promise.resolve().then(() => {
            this.tab = new Tab()
        })
    }

    submit(e) {
        e.preventDefault()
        const params = new URLSearchParams(new FormData(this.element))
        this.tab.load({
            path: route('adminzone::search') + '?' + params.toString()
        })
    }

    disconnect() {
        this.tab.close()
    }
}
