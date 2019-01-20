import { Controller } from "stimulus"
import Chart from 'chart.js'

export default class extends Controller {
    static targets = [ "canvas" ]

    chart
    connect() {
        let ctx = this.canvasTarget.getContext('2d')
        this.chart = new Chart(ctx, {
            type: this.data.get("type"),
            data: JSON.parse(this.data.get("data")),
            options: JSON.parse(this.data.get("options"))
        })
    }
}
