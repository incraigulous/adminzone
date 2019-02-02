import { Controller } from "stimulus"

export default class extends Controller {
    confirmation

    initialize() {
        this.listen()
    }
    listen() {
        this.element.addEventListener('submit', this.handleSubmit.bind(this))
    }
    stopListening() {
        this.element.removeEventListener('submit', this.handleSubmit.bind(this))
    }
    submit() {
        console.log('here')
        this.element.submit()
    }
    handleSubmit(e) {
        return confirm("Are you sure?")
    }
    disconnect() {
       this.stopListening()
    }
}
