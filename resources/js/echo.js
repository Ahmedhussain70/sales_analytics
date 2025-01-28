import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: '1150e14f8f9a6815987d',
    cluster: 'eu',
    forceTLS: true
});

useEffect(() => {
    echo.channel('orders')
        .listen('NewOrderEvent', (event) => {
            console.log('New Order:', event.order);
            // Update your state/UI with the new order
        });

    echo.channel('analytics')
        .listen('UpdatedAnalyticsEvent', (event) => {
            console.log('Updated Analytics:', event.analytics);
            // Update your state/UI with the latest analytics
        });

    return () => {
        echo.leaveChannel('orders');
        echo.leaveChannel('analytics');
    };
}, []);
