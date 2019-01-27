import {EventBusSingleton as events} from "light-event-bus"
import http from "./http"
import uniqid from 'uniqid'
import Noty from 'noty'

class Tab {
    element = null
    closeCallback = function(){}
    failCallback = function(){}
    loadCallback = function(){}
    id = ''
    addfailureNotification

    constructor () {
        this.id = 'tab-' + uniqid()
        events.publish('page:tab:register', this)
        this.addfailureNotification = new Noty({
            type: 'error',
            text: 'Oops.. the tab failed to load.'
        })
    }

    load({path, params = {}, headers = {}}) {
        headers['x-layout'] = 'page-tab'
        http.get(path, {
            params,
            headers
        })
            .then(this.success.bind(this))
            .catch(this.failure.bind(this))
    }

    success({data: html}) {
        this.element = document.createElement("div")
        this.element.id = this.id
        this.element.dataset.target = "page-tabs.tab"
        this.element.innerHTML = html
        this.loadCallback(this)
    }

    failure(e) {
        this.addfailureNotification.show();
        this.failCallback(e)
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

export default Tab
