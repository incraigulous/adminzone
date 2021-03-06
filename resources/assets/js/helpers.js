export const nextTick = function(callback) {
    Promise.resolve().then(() => {
        callback()
    })
}

export const parseResponseError = function(error) {
    let message = null
    try {
        if (error.message) {
            message = error.message
        } else {
            message = error.response.data.message
        }
    } catch (e) {}
    return message
}

export const parseResponse = function({data}) {
    if (data.data) {
        data = data.data
    }
    return data

}
