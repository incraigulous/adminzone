export const nextTick = function(callback) {
    Promise.resolve().then(() => {
        callback()
    })
}
