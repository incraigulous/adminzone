import { Controller } from "stimulus"
import { throttle } from 'throttle-debounce';
import {nextTick} from '../helpers'

export default class extends Controller {
    sidebarOpenClass = 'sidebar-open'
    static targets = ['topbar', 'sidebar', 'footer', 'gutter']

    initialize() {
        window.addEventListener('resize',
            throttle(300, this.setCSSVariables.bind(this))
        )
        nextTick(() => {
            this.setCSSVariables()
        })
    }

    get topbarHeight() {
        return this.hasTopbarTarget ? this.topbarTarget.offsetHeight : 0
    }

    get footerHeight() {
        return this.hasFooterTarget ? this.footerTarget.offsetHeight : 0
    }

    get sidebarWidth() {
        return this.hasSidebarTarget ? this.sidebarTarget.offsetWidth : 0
    }

    get gutterWidth() {
        return this.hasGutterTarget ? this.gutterTarget.offsetWidth : 0
    }

    get isSidebarOpen() {
        return  document.body.classList.contains(this.sidebarOpenClass)
    }

    toggleSidebar() {
        if (this.isSidebarOpen) {
            this.closeSidebar()
        } else {
            this.openSidebar()
        }
    }

    openSidebar() {
        document.body.classList.add(this.sidebarOpenClass)
    }

    closeSidebar() {
        document.body.classList.remove(this.sidebarOpenClass)
    }


    setCSSVariables() {
        document.documentElement.style.setProperty("--dashboard-topbar-height", this.topbarHeight + 'px')
        document.documentElement.style.setProperty("--dashboard-footer-height", this.footerHeight + 'px')
        document.documentElement.style.setProperty("--dashboard-sidebar-width", this.sidebarWidth + 'px')
        document.documentElement.style.setProperty("--dashboard-gutter-width", this.gutterWidth + 'px')
    }
}
