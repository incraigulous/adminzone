import { Controller } from "stimulus"
import { EventBusSingleton as events } from "light-event-bus"

export default class extends Controller {
    static targets = [ "overlay", "stack"]

    connect() {
        events.subscribe('overlay:register', this.register.bind(this))
    }

    disconnect() {
        events.unsubscribe('overlay:register', this.register.bind(this))
    }

    register(overlay) {
        overlay.onLoad(this.handleLoad.bind(this))
    }

    overlayOpen(overlay) {
        return !! this.overlayTargets.find((target) => {
            return target.id === overlay.id
        })
    }

    handleLoad(overlay) {
        if (!this.overlayOpen(overlay)) {
            this.element.appendChild(overlay.element)
        }
    }


}
