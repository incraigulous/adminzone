import {EventBusSingleton as events} from "light-event-bus"
import http from "./http"
import uniqid from 'uniqid'
import Notification from './Notification'

class Overlay {
    element = null
    closeCallback = function(){}
    failCallback = function(){}
    loadCallback = function(){}
    id = ''

    constructor () {
        this.id = 'overlay-' + uniqid()
        events.publish('overlay:register', this)
    }

    load({path, params = {}, headers = {}, direction = 'right'}) {
        headers['x-layout'] = 'overlay'
        headers['x-overlay-direction'] = direction
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

    close(data) {
        if (this.element) {
            this.element.remove()
            this.element = null
        }
        this.closeCallback(data)
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
}

export default Overlay
