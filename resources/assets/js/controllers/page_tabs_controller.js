import { Controller } from "stimulus"
import { EventBusSingleton as events } from "light-event-bus"

export default class extends Controller {
    static targets = [ "tab", "tabset"]
    tabs = []

    initialize() {
        console.log('init')
    }
    connect() {
        console.log('connect')

        events.subscribe('page:tab:register', this.register.bind(this))
    }

    disconnect() {
        events.unsubscribe('page:tab:register', this.register.bind(this))
    }

    register(tab) {
        tab.onLoad(this.handleLoad.bind(this))
    }

    tabOpen(tab) {
        return !! this.tabTargets.find((target) => {
            return target.id === tab.id
        })
    }

    handleLoad(tab) {
        if (!this.tabOpen(tab)) {
            this.element.appendChild(tab.element)
        }
    }


}
