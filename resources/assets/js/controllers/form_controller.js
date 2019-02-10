import {Controller} from "stimulus"
import http from '../http'
import {nextTick} from "../helpers"
import {EventBusSingleton as events} from "light-event-bus"

export default class extends Controller
{
    static targets = ['submitButton', 'errorAlert', 'successAlert']

    /**
     * Get the form submission payload.
     * @returns {FormData}
     */
    get payload()
    {
        return new FormData(this.element)
    }

    /**
     * Get the form submit url from the form element
     * @returns {string}
     */
    get action()
    {
        return this.element.getAttribute("action")
    }

    get method()
    {
        return this.element.hasAttribute("method") ? this.element.getAttribute("method") : 'POST'
    }

    get fieldErrorElements()
    {
        return this.element.querySelectorAll('.invalid-feedback')
    }

    get formControlElements()
    {
        return this.element.querySelectorAll('.form-control')
    }

    get ctx() {
        let overlay = this.element.closest("div[data-controller=overlay]");
        if (overlay) {
            return overlay.parentElement.getAttribute('id')
        }
    }

    /**
     * Submit the form
     * @param event
     * @returns {Promise<void>}
     */
    async submit(event)
    {
        event.preventDefault()
        this.beforeSubmission()

        await http({
            method: this.method,
            url: this.action,
            data: this.payload
        }).then(this.handleSuccess)
            .catch(this.handleError)
            .finally(this.afterSubmission)
    }

    async startPreloader()
    {
        this.submitButtonTarget.disabled = true
        this.submitButtonTarget.classList.add('loading')

        //If we don't already have a preloader, add one.
        if (this.loadingTarget === undefined)
        {
            this.loadingTarget = document.createElement('span')
            this.loadingTarget.classList.add('loader')
            this.loadingTarget.classList.add('icon')
            this.loadingTarget.classList.add('fa')
            this.loadingTarget.classList.add('sync-alt')
            this.submitButtonTarget.append(this.loadingTarget)
        }
    }

    hideLoader()
    {
        this.submitButtonTarget.classList.remove('loading')
        this.submitButtonTarget.disabled = false
    }

    async beforeSubmission()
    {
        this.successAlertTarget.classList.add('d-none')
        this.errorAlertTarget.classList.add('d-none')
        this.fieldErrorElements.forEach((el) => el.style.display = 'none')
        this.formControlElements.forEach((el) => el.classList.remove('is-invalid'))
        this.startPreloader()
    }

    handleError = ({response}) =>
    {
        let message = 'Whoops. Something went wrong...'
        if (response && response.data.errors) {
            message = Object.values(response.data.errors)[0]
            this.showFieldErrors(response.data.errors)
        }
        if (response && response.data.message) {
            message = response.data.message
        }
        this.errorAlertTarget.innerHTML = message
        this.errorAlertTarget.classList.remove('d-none')
        this.errorAlertTarget.scrollIntoView()
    }

    showFieldErrors(errors)
    {
        Object.entries(errors).forEach(([name, messages]) => {
            let fieldErrorElement = this.element.querySelector(`.invalid-feedback[data-validation-name=${name}]`)
            let fieldElement = this.element.querySelector(`.form-control[data-validation-name=${name}]`)
            if (fieldElement && fieldErrorElement) {
                fieldElement.classList.add('is-invalid')
                fieldErrorElement.innerText = messages[0]
                fieldErrorElement.style.display = 'inline-block'
            }
        })
    }

    handleSuccess = (response) =>
    {
        let data = response.data

        if (this.data.get('shouldRedirect')) {
            if (data.redirect) {
                window.location = data.redirect
                return
            }
        }

        if (data.message) {
            this.successAlertTarget.innerText = data.message
        }

        this.successAlertTarget.classList.remove('d-none')
        this.successAlertTarget.scrollIntoView()
        this.submitButtonTarget.disabled = false
        this.errorAlertTarget.classList.add('d-none')

        nextTick(() => {
            events.publish('form:submitted', {
                response,
                ctx: this.ctx
            })
        })
    }

    afterSubmission = () =>
    {
        this.hideLoader()
    }
}
