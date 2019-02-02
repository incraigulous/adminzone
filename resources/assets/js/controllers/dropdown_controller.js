import { Controller } from "stimulus"

export default class extends Controller {
    static targets = [ "menu" ]

    shownClass = 'show'

    get isOpen() {
        return this.menuTarget.classList.contains(this.shownClass)
    }

    toggle() {
        if (this.isOpen) {
            this.close()
        } else {
            this.open()
        }
    }

    open() {
        this.menuTarget.classList.add(this.shownClass)
        this.element.classList.add(this.shownClass)
    }

    close() {
        this.menuTarget.classList.remove(this.shownClass)
        this.element.classList.remove(this.shownClass)
    }
}
