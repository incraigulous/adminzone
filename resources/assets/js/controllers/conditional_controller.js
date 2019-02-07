import {Controller} from "stimulus"
import http from "../http"

export default class extends Controller
{
    inClass = 'overlay-stack__overlay-container--in'
    listenerCallback = function(){}

    get payload()
    {
        let payload = new FormData(this.form)
        payload.append(
            'section_id', this.data.get('section-id')
        )
        return payload
    }

    connect()
    {
        this.form = this.element.closest('form')
        this.listenerCallback = this.handleFormChange.bind(this)
        this.listen()
    }

    listen() {
        this.form.addEventListener(
            'change',
            this.listenerCallback
        )
    }

    handleFormChange()
    {
        this.refresh()
    }

    refresh() {
        let url = route('adminzone::resource.section.show', {
            'slug': this.data.get('slug'),
            'id': this.data.get('id') ? this.data.get('id') : 'new'
        });
        http.get(url, {
            params: new URLSearchParams(this.payload)
        })
            .then(this.handleSuccess.bind(this))
    }

    handleSuccess({data: html}) {
        this.stopListening()
        const temp = document.createElement("div")
        temp.innerHTML = html
        this.element.innerHTML = temp.firstChild.innerHTML
        this.listen()
    }

    stopListening() {
        this.form.removeEventListener(
            'change',
            this.listenerCallback
        )
    }

    disconnect() {
        this.stopListening()
    }
}
