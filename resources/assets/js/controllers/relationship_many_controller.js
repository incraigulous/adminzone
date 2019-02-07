import { Controller } from "stimulus"
import Overlay from '../Overlay'
import http from "../http"
import Notification from "../Notification"
import {EventBusSingleton as events} from "light-event-bus"
import {parseResponse} from '../helpers'
import Sortable from 'sortablejs'

export default class extends Controller {
    overlay
    static targets = ['field', 'relationship', 'entries']

    get id() {
        return this.data.get('id')
    }

    get value() {
        return this.fieldTargets.map((el) => {
            return el.value
        })
    }

    get selectEventName() {
        return this.overlay.id + ":entry:select"
    }

    initialize() {
        this.overlay = new Overlay()
        this.overlay.onSubmit(this.handleSubmit.bind(this))
        events.subscribe(this.selectEventName, this.handleEntrySelect.bind(this))
        this.initSort()
    }

    initSort() {
        this.sortable = new Sortable(this.entriesTarget, {
            animation: 150,
            handle: '.relationship__entry__handle'
        });
    }

    tearDownSort() {
        this.sortable.destroy()
    }


    openNew() {
        this.overlay.load({
            path: route('adminzone::resource.create', {'slug': this.data.get('related-slug')})
        })
    }

    findRelationshipTarget(id) {
        return this.relationshipTargets.find((el) => {
            return el.dataset.id == id
        })
    }

    findFieldTarget(id) {
        return this.fieldTargets.find((el) => {
            return el.value == id
        })
    }

    idExists(id) {
        return !!this.findFieldTarget(id)
    }

    remove(e) {
        e.preventDefault()
        this.findRelationshipTarget(e.currentTarget.dataset.id).remove()
        this.fetch()
    }

    openExisting() {
        this.overlay.load({
            path: route('adminzone::resource.relationships.index', {'slug': this.data.get('related-slug')})
        })
    }

    handleEntrySelect({id}) {
        this.fetch(id)
        this.overlay.close()
    }

    openRelationship(e) {
        let id = e.currentTarget.dataset.id
        this.overlay.load({
            path: route('adminzone::resource.edit', {'slug': this.data.get('related-slug'), 'id': id})
        })
    }

    handleSubmit(response) {
        let data = parseResponse(response)
        if (this.idExists(data.id)) {
            this.fetch()
        } else {
            this.fetch(data.id)
        }
        this.overlay.close()
    }

    fetch(withId) {
        let url = route('adminzone::resource.field.show', {
            'slug': this.data.get('slug'),
            'id': this.data.get('id') ? this.data.get('id') : 'new'
        });

        let value = this.value

        if (withId && !value.includes(withId)) {
            value.push(withId)
        }

        http.get(url, {
            params: {
                value,
                'name': this.data.get('name')
            }
        })
            .then(this.handleFetchSuccess.bind(this))
            .catch(this.handleFetchFailure.bind(this))
    }

    handleFetchSuccess({data: html}) {
        this.tearDownSort()
        const temp = document.createElement("div")
        temp.innerHTML = html
        this.element.innerHTML = temp.querySelector('[data-controller=relationship-many]').innerHTML
        this.initSort()
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

    disconnect() {
        this.tearDownSort()
    }
}
