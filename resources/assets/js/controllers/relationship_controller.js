import { Controller } from "stimulus"
import Overlay from '../Overlay'
import http from "../http"
import Notification from "../Notification"
import {EventBusSingleton as events} from "light-event-bus"


export default class extends Controller {
    overlay
    static targets = ['field']

    get value() {
        if (this.hasFieldTarget) {
            return this.fieldTarget.value
        }
        return null
    }

    get name() {
        if (this.hasFieldTarget) {
            return this.fieldTarget.name
        }
        return null
    }

    get id() {
        return this.data.get('id')
    }

    initialize() {
        this.overlay = new Overlay()
        this.overlay.onSubmit(this.handleSubmit.bind(this))
        events.subscribe(this.overlay.id + ":entry:select", this.handleEntrySelect.bind(this))
    }

    openNew() {
        this.overlay.load({
            path: route('adminzone::resource.create', {'slug': this.data.get('related-slug')})
        })
    }

    remove() {
        this.fieldTarget.value = null
        this.fetch()
    }

    openExisting() {
        this.overlay.load({
            path: route('adminzone::resource.relationships.index', {'slug': this.data.get('related-slug')})
        })
    }

    handleEntrySelect({id}) {
        this.fieldTarget.value = id
        this.fetch()
        this.overlay.close()
    }

    openRelationship() {
        this.overlay.load({
            path: route('adminzone::resource.edit', {'slug': this.data.get('related-slug'), 'id': this.id})
        })
    }

    handleSubmit({data}) {
        if (data.data) {
            data = data.data
        }
        if (data.id) {
            this.fieldTarget.value = data.id
        }
        this.fetch()
        this.overlay.close()
    }

    fetch() {
        let url = route('adminzone::resource.field.show', {
            'slug': this.data.get('slug'),
            'id': this.data.get('id') ? this.data.get('id') : 'new'
        });
        http.get(url, {
            params: {
                'value': this.value,
                'name': this.name
            }
        })
            .then(this.handleFetchSuccess.bind(this))
            .catch(this.handleFetchFailure.bind(this))
    }

    handleFetchSuccess({data: html}) {
        const temp = document.createElement("div")
        temp.innerHTML = html
        this.element.innerHTML = temp.querySelector('[data-controller=relationship]').innerHTML
    }

    handleFetchFailure(error) {
        let message = null
        try {
            if (error.message) {
                message = error.message
            } else {
                message = error.response.data.message
            }
        } catch (e) {}
        new Notification({
            type: 'error',
            text: message ? message : 'Oops.. could not update field.'
        }).show();
    }
}
