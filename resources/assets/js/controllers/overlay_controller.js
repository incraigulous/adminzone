import { Controller } from "stimulus"
import {EventBusSingleton as events} from "light-event-bus"

export default class extends Controller {
    inClass = 'overlay-stack__overlay-container--in'

    connect() {
        setTimeout(() => this.element.classList.add(this.inClass), 50);
    }

    close() {
        this.element.classList.remove(this.inClass)
        events.publish('overlay:close', this.element.parentElement.id)
    }

}
