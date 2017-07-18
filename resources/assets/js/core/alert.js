import Vue from 'vue'
import Notification from 'vue-bulma-notification'

const NotificationComponent = Vue.extend(Notification)

const openNotification = (propsData = {
    title: '',
    message: '',
    type: '',
    direction: '',
    duration: 4500,
    container: '.notifications'
}) => {
    return new NotificationComponent({
        el: document.createElement('div'),
        propsData
    })
}

class Alert {
    static success (message) {
        openNotification({
            title: 'Success!',
            message: message,
            type: 'success'
        })
    }
}

export default Alert 