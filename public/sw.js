//@ts-nocheck

self.addEventListener("push", function (event) {
    event.waitUntil(
        self.registration.showNotification("laravel sent a notification", {
            body: "yippie a notification",
        })
    );
});
