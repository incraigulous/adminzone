import {EventBusSingleton as events} from "light-event-bus"
import http from "./http"
import uniqid from 'uniqid'
import Notification from './Notification'

class Overlay {
    element = null
    closeCallback = function(){}
    failCallback = function(){}
    loadCallback = function(){}
    submitCallback = function(){}
    id = ''

    constructor () {
        this.id = 'overlay-' + uniqid()
        events.publish('overlay:register', this)
        events.subscribe('overlay:close', this.handleClose.bind(this))
        events.subscribe('form:submitted', this.handleFormSubmitted.bind(this))
    }

    load({path, params = {}, headers = {}, direction = 'right'}) {
        headers['x-layout'] = 'overlay'
        headers['x-overlay-direction'] = direction
        headers['x-ctx'] = this.id

        http.get(path, {
            params,
            headers
        })
            .then(this.success.bind(this))
            .catch(this.failure.bind(this))
    }

    success({data: html}) {
        this.element = (this.element) ? this.element : document.createElement("div")
        this.element.id = this.id
        this.element.dataset.target = "overlay-stack.overlay"
        this.element.innerHTML = html
        this.loadCallback(this)
    }

    failure(error) {
        let message = null
        try {
             message = error.response.data.message
        } catch (e) {}
        new Notification({
            type: 'error',
            text: message ? message : 'Oops.. the overlay failed to load.'
        }).show();
        this.failCallback(error)
    }

    handleClose(id) {
        if (id === this.id) {
            this.close()
        }
    }

    close() {
        if (this.element) {
            this.element.remove()
            this.element = null
        }
        this.closeCallback()
    }

    onClose(callback) {
        this.closeCallback = callback
    }

    onFail(callback) {
        this.failCallback = callback
    }

    onLoad(callback) {
        this.loadCallback = callback
    }

    onSubmit(callback) {
        this.submitCallback = callback
    }

    handleFormSubmitted({response, ctx}) {
        if (ctx !== this.id) {
            return
        }

        this.submitCallback(response)
    }
}

export default Overlay
