import { Controller } from "stimulus"
import http from "../http"
import Notification from "../Notification"
import { parseResponseError } from "../helpers"
import {EventBusSingleton as events} from "light-event-bus"

export default class extends Controller {
    static targets = [ "field", 'pagination' ]
    pageLinkSelector = 'a[class=page-link]'

    connect() {
        this.initPagination()
    }

    initPagination() {
        this.paginationTarget.querySelectorAll(this.pageLinkSelector).forEach((a) => {
            a.addEventListener('click', this.handlePage.bind(this))
        })
    }

    tearDownPagination() {
        this.paginationTarget.querySelectorAll(this.pageLinkSelector).forEach((a) => {
            a.removeEventListener('click', this.handlePage.bind(this))
        })
    }

    handlePage(e) {
        e.preventDefault()
        this.fetch(e.currentTarget.href)
    }

    search() {
        this.fetch(route('adminzone::resource.relationships.index', {'slug': this.data.get('slug')}))
    }

    select(e) {
        e.preventDefault(e.currentTarget.dataset)
        events.publish(this.data.get('ctx') + ':entry:select',
            {
                id: e.currentTarget.dataset.id,
                slug: this.data.get('slug')
            })
    }

    fetch(url) {
        http.get(url, {
            params: {
                'q': this.fieldTarget.value
            },
            headers: {
                'x-ctx': this.data.get('ctx'),
                'x-layout': 'ajax'
            }
        })
            .then(this.handleSuccess.bind(this))
            .catch(this.handleFailure.bind(this))
    }

    handleSuccess({data: html}) {
        this.tearDownPagination()
        const temp = document.createElement("div")
        temp.innerHTML = html
        this.element.innerHTML = temp.firstChild.innerHTML
        this.initPagination()
    }

    handleFailure(error) {
        let message = parseResponseError(error)
        new Notification({
            type: 'error',
            text: message ? message : 'Oops... an unexpected error occurred.'
        }).show();
    }

    disconnect() {
        this.tearDownPagination()
    }
}
