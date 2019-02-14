import { Controller } from "stimulus"

export default class extends Controller {
    activeClass = 'active'

    get isActive() {
        return this.element.classList.contains(this.activeClass)
    }

    toggle() {
        if (this.isActive) {
            this.activate()
        } else {
            this.deactivate()
        }
    }

    activate() {
        this.element.classList.add(this.activeClass)
    }

    deactivate() {
        this.element.classList.remove(this.activeClass)
    }
}
