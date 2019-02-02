import { Controller } from "stimulus"
import Overlay from "../Overlay"

export default class extends Controller {
    inClass = 'overlay-stack__overlay-container--in'

    connect() {
        setTimeout(() => this.element.classList.add(this.inClass), 50);
    }

    close() {
        this.element.classList.remove(this.inClass)

        this.element.addEventListener("transitionend", this.remove.bind(this), true);
    }

    remove() {
        this.element.remove()
    }
}
